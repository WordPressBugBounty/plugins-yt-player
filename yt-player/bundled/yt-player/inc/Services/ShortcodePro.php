<?php

namespace YTP\Services;

use YTP\Helper\Utils;


class ShortcodePro
{

    public function register()
    {
        add_shortcode('ytp', [$this, 'ytp']);
        add_shortcode('ytplayer', [$this, 'ytplayer']);
    }

    public function ytp($atts, $content)
    {
        extract(shortcode_atts(array(
            'url' => null,
            'autoplay' => false
        ), $atts));
        Ob_start();

        $content = str_replace(' ', '', $content);
        $id = str_replace('https://www.youtube.com/watch?v=', '', $content);
        $selector = uniqid();

        $width = Utils::getOptionDeep('ytp_option', 'width', ['width' => 100, 'unit' => '%']);
        $seekTime = Utils::getOptionDeep('ytp_option', 'seekTime', 10);
        $clickToPlay = Utils::getOptionDeep('ytp_option', 'clickToPlay');
        $disableContextMenu = Utils::getOptionDeep('ytp_option', 'disableContextMenu', '10');
        $hideControls = Utils::getOptionDeep('ytp_option', 'hideControls', '');

        $controls = Utils::getOptionDeep('ytp_option', 'controls', []);

    ?>
    
        <style>
            <?php echo esc_html("#player$selector") ?> {
                max-width: <?php echo esc_html($width['width'] . $width['unit']) ?>
                /* margin: 0 auto;  */
            }
        </style>
        <div>
            <div id="player<?php echo esc_attr($selector); ?>">
                <div class="plyr__video-embed embed-container player">
                    <iframe
                        src="https://www.youtube.com/embed/<?php echo esc_attr($id); ?>"
                        allowfullscreen
                        allowtransparency
                        allow="autoplay"></iframe>
                </div>
                <script type="text/javascript">
                    const player<?php echo esc_html($selector); ?> = new Plyr('#player<?php echo esc_html($selector); ?> .player', {
                        autoplay: <?php echo esc_html($autoplay ? 'true' : 'false'); ?>,
                        disableContextMenu: <?php echo esc_html($disableContextMenu == '0' ? 'false' : 'true'); ?>,
                        clickToPlay: <?php echo esc_html($clickToPlay == '0' ? 'false' : 'true'); ?>,
                        seekTime: <?php echo esc_html($seekTime); ?>,
                        hideControls: <?php echo esc_html($hideControls); ?>,
                        controls: <?php echo wp_json_encode(array_values($controls)) ?>,
                        resetOnEnd: true,
                        youtube: {
                            noCookie: false,
                            rel: 0,
                            showinfo: 0,
                            iv_load_policy: 3,
                            modestbranding: 1,
                            start: 0
                        }
                    });
                </script>
            </div>
        </div>

    <?php
        $output = ob_get_clean();
        return $output;
    }

    public function ytplayer($atts)
    {
        extract(shortcode_atts(array(
            'id' => null,
        ), $atts));

        

        $post = get_post($id);
        if (!$post) {
            return '';
        }
        if (post_password_required($post)) {
            return get_the_password_form($post);
        }
        switch ($post->post_status) {
            case 'publish':
                return $this->displayContent($id);
            case 'private':
                if (current_user_can('read_private_posts')) {
                    return $this->displayContent($id);
                }
                return '';
            case 'draft':
            case 'pending':
            case 'future':
                if (current_user_can('edit_post', $id)) {
                    return $this->displayContent($id);
                }
                return '';
            default:
                return '';
        }
    }

    function displayContent($id)
    {

        $isGutenberg = get_post_meta($id, 'isGutenberg', true);

        if ($isGutenberg) {
            $post_content = get_post_field('post_content', $id);
            $blocks = parse_blocks($post_content);
            return render_block($blocks[0]['innerBlocks'][0]);
        }

        // oi mama na please.
        $meta = $this->get_meta($id, '_ytp');

        // echo "<pre>";
        // print_r(get_post_meta($id, '_ytp', true));
        // echo "</pre>";

        require 'ytplayer_block_json.php';


        return render_block($block);
    }

    public function get_meta($id, $key)
    {
        $meta = get_post_meta($id, $key, true);
        return function ($key, $default = null, $isBoolean = false, $key2 = null) use (&$meta) {
            // If $key2 is provided, check for nested key
            if ($key2 !== null) {
                if (isset($meta[$key][$key2])) {
                    return $isBoolean ? (bool) $meta[$key][$key2] : $meta[$key][$key2];
                }
                return $default;
            }
            // If only $key is provided, check in $meta
            if (isset($meta[$key])) {
                return $isBoolean ? (bool) $meta[$key] : $meta[$key];
            }
            return $default;
        };
    }
}
