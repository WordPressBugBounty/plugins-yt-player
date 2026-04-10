<?php

namespace YTP\PostType;

class YTPlayerPro
{
    protected static $_instance = null;
    protected $post_type = 'ytplayer';

    /**
     * construct function
     */
    public function register()
    {
        add_action('init', [$this, 'init']);
        if (is_admin()) {
            add_filter('post_row_actions', [$this, 'remove_row_actions'], 10, 2);
            add_action('edit_form_after_title', [$this, 'edit_form_after_title']);
            add_filter('manage_ytplayer_posts_columns', [$this, 'columns_head_only'], 10);
            add_action('manage_ytplayer_posts_custom_column', [$this, 'column_content'], 10, 2);
            add_filter('post_updated_messages', [$this, 'updated_messages']);

            add_action('admin_head-post.php', [$this, 'hide_publish_actions']);
            add_action('admin_head-post-new.php', [$this, 'hide_publish_actions']);
            add_filter('gettext', [$this, 'pdfp_change_publish_button'], 10, 2);

            // force gutenberg here
            add_filter('block_editor_meta_boxes', [$this, 'remove_metabox']);
            add_action('use_block_editor_for_post', [$this, 'forceGutenberg'], 10000, 2);

            add_action('add_meta_boxes', [$this, 'add_review_metabox']);

            add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);


            if (class_exists('\CSF')) {
                $prefix = '_ytp';
                \CSF::createMetabox($prefix, array(
                    'title' => 'Configure Your Video Player',
                    'post_type' => 'ytplayer',
                    // 'data_type' => 'unserialize',
                ));

                $this->configure($prefix);
            }
        }
    }


    public function enqueue_admin_scripts() {
        global $typenow;
        if ($typenow === 'ytplayer') { 
            wp_enqueue_script(
                'ytp-admin-copy',
                YTP_PLUGIN_DIR . '/dashboard/post.js',
                ['jquery'],
                '1.0',
                true
            );
        }
    }

    public function add_review_metabox() {
        add_meta_box(
            'ytp_review_box', // ID
            __('Please show some love', 'ytp'), // Title
            [$this, 'render_review_metabox'], // Callback
            $this->post_type, // Post Type
            'side', // Context
            'low' // Priority
        );
    }

    public function render_review_metabox($post) {
        $plugin_name = 'YT Player';
        $review_url = 'https://wordpress.org/support/plugin/yt-player/reviews/?filter=5#new-post';
        $feedback_url = 'https://bplugins.com/contact';
        ?>
        <div style="font-size: 20px; line-height: 1.6; color: #333;">
            <p style="margin-bottom: 16px;">
                <?php
                echo sprintf(
                    __('If you like <strong>%s</strong> Plugin, please leave us a <a href="%s" target="_blank" style="color: #0073aa; text-decoration: none;">★★★★★ rating</a>.', 'ytp'),
                    esc_html($plugin_name),
                    esc_url($review_url)
                );
                ?>
                <br><?php _e('Your review is very important to us as it helps us to grow more.', 'ytp'); ?>
            </p>
    
            <p>
                <?php _e('Need some improvement?', 'ytp'); ?>
                <?php
                echo sprintf(
                    '<a href="%s" target="_blank" style="color: #0073aa; text-decoration: none;">%s</a>',
                    esc_url($feedback_url),
                    __('Please let me know how I can improve the plugin.', 'ytp')
                );
                ?>
            </p>
        </div>
        <?php
    }

    /**
     * init
     */
    public function init()
    {
        register_post_type(
            'ytplayer',
            array(
                'label' => __('YT Player'),
                'labels' => array(
                    'name' => __('YT Players'),
                    'singular_name' => __('YT Player'),
                    'menu_name' => __('YT Player'),
                    'all_items' => __('ShortCode Generator'),
                    'add_new' => __('Add New ShortCode'),
                    'add_new_item' => __( 'Add new shortCode' ),
                    'edit_item' => __('Edit'),
                    'new_item' => __('New'),
                    'view_item' => __('View'),
                    'search_items'       => __('Search'),
                    'not_found' => __('Sorry, we couldn\'t find any item you are looking for.')
                ),
                'public' => false,
                'show_ui' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'menu_position' => 14,
                'menu_icon' => YTP_PLUGIN_DIR . 'img/icon.png',
                'show_in_rest' => true,
                'has_archive' => false,
                'hierarchical' => false,
                'supports' => array('title', 'editor'),
                'capability_type' => 'page',
                'rewrite' => array('slug' => 'ytplayer'),
                'template' => [
                    ['yt-player/parent']
                ],
                'template_lock' => 'all',
            )
        );
    }

    /**
     * Remove Row
     */
    function remove_row_actions($idtions)
    {
        global $post;
        if ($post->post_type == $this->post_type) {
            unset($idtions['view']);
            unset($idtions['inline hide-if-no-js']);
        }
        return $idtions;
    }

    function edit_form_after_title()
    {
        global $post;
        if ($post->post_type == $this->post_type) {
?>
            <div class="ytp_playlist_shortcode">
                <div class="shortcode-heading">
                    <div class="icon"><span class="dashicons dashicons-video-alt3"></span> <?php _e("WP Podcast", "ytp") ?></div>
                    <div class="text"> <a href="https://bplugins.com/support/" target="_blank"><?php _e("Supports", "ytp") ?></a></div>
                </div>
                <div class="shortcode-left">
                    <h3><?php _e("Shortcode", "ytp") ?></h3>
                    <p><?php _e("Copy and paste this shortcode into your posts, pages and widget:", "ytp") ?></p>
                    <div class="shortcode" selectable>[ytplayer id='<?php echo esc_attr($post->ID); ?>']</div>
                </div>
                <div class="shortcode-right">
                    <h3><?php _e("Template Include", "ytp") ?></h3>
                    <p><?php _e("Copy and paste the PHP code into your template file:", "ytp"); ?></p>
                    <div class="shortcode">&lt;?php echo do_shortcode('[ytplayer id="<?php echo esc_html($post->ID); ?>"]');
                        ?&gt;</div>
                </div>
            </div>
<?php
        }
    }

    // CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
    function columns_head_only($defaults)
    {
        unset($defaults['date']);
        $defaults['shortcode'] = 'ShortCode';
        $defaults['date'] = 'Date';
        return $defaults;
    }

function column_content($column_name, $post_ID)
{
    if ($column_name == 'shortcode') {
        echo '
        <div id="bPlAdminShortcode-' . esc_attr($post_ID) . '" class="ytp_front_shortcode" style="position: relative; display: inline-block;">
            <input 
                readonly 
                style="text-align: center; border: none; outline: none; background-color: #1e8cbe; color: #fff; padding: 4px 10px; border-radius: 3px; cursor: pointer;" 
                value="[ytplayer id=' . esc_attr($post_ID) . ']" 
                onclick="copyBPlAdminShortcode(' . esc_attr($post_ID) . ')" 
            />
            <span class="tooltip" style="position: absolute; top: -30px; left: 50%; transform: translateX(-50%); background: #000; color: #fff; padding: 3px 6px; border-radius: 3px; font-size: 12px; visibility: hidden; opacity: 0; transition: opacity 0.3s;">
                Copy to Clipboard
            </span>
        </div>';
    }
}

    

    function updated_messages($messages)
    {
        $messages[$this->post_type][1] = __('updated ');
        return $messages;
    }

    public function hide_publish_actions()
    {
        global $post;
        if ($post->post_type == $this->post_type) {
            echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                </style>
            ';
        }
    }

    function remove_metabox($metaboxs)
    {
        global $post;
        $screen = get_current_screen();

        if ($screen->post_type === $this->post_type) {
            return false;
        }
        return $metaboxs;
    }

    public function forceGutenberg($use, $post){
        if ($this->post_type !== $post->post_type) return $use;
    
        // CSF ফিল্ড save করার সময় auto-draft অথবা POST ID নেই
        if ($post->post_status === 'auto-draft' || empty($post->ID)) {
            remove_post_type_support($this->post_type, 'editor');
            return false; // Codestar active
        }
    
        // লাইসেন্স চেক
        $license_active = get_option('ytp_license_active', false);
    
        if ($license_active) {
            // Pro mode: Gutenberg disable CSF updates এ
            remove_post_type_support($this->post_type, 'editor');
            return false;
        } else {
            // Non-Pro: Codestar active
            remove_post_type_support($this->post_type, 'editor');
            return false;
        }
    
        return $use;
    }
    

    function pdfp_change_publish_button($translation, $text){
        if ($this->post_type == get_post_type())
            if ($text == 'Publish')
                return 'Save';
        return $translation;
    }
    

    public function configure($prefix){

        \CSF::createSection($prefix, array(
            // 'parent' => 'ytp_playerio',
            'title' => '',
            'fields' => array(
                array(
                    'id' => 'source',
                    'title' => 'Video URL/ID',
                    'type'  => 'text',
                    'desc' => 'Please submit here YouTube video URL or ID'
                ),
                array(
                    'id' => 'brandLogo',
                    'type' => 'switcher',
                    'title' => 'Enable Brand Logo',
                    'desc' => 'Turn On to display your brand logo in this video, enhancing brand visibility and recognition.',
                    'default' => '0',
                ),
                array(
                    'id' => 'logoSource',
                    'title' => 'Upload Brand Logo',
                    'type'  => 'upload',
                    'desc' => 'Upload here brand logo for show the display in this video',
                    'dependency' => array('brandLogo', '==', true),
                ),
                array(
                    'id' => 'brandSize',
                    'type' => 'dimensions',
                    'title' => 'Brand Logo Size',
                    'height' => false,
                    'default' => [
                        'unit' => 'px',
                        'width' => 100,
                    ],
                    'dependency' => array('brandLogo', '==', true),
                ),
                array(
                    'id' => 'radius',
                    'type' => 'dimensions',
                    'title' => 'Brand Logo Border Radius',
                    'height' => false,
                    'default' => [
                        'unit' => '%',
                        'width' => 50,
                    ],
                    'dependency' => array('brandLogo', '==', true),
                ),
                array(
                    'id'      => 'brandLogoPosition',
                    'type'    => 'select',
                    'title'   => 'Brand Logo Position',
                    'desc'    => 'Select the position for the brand logo overlay.',
                    'options' => array(
                      'top-left'      => 'Top Left',
                      'top-right'     => 'Top Right',
                      'bottom-left'   => 'Bottom Left',
                      'bottom-right'  => 'Bottom Right',
                      'center-center' => 'Center Center',
                    ),
                    'default'    => 'top-right',
                    'dependency' => array('brandLogo', '==', true),
                  ),
                array(
                    'id' => 'customThumbnail',
                    'type' => 'switcher',
                    'title' => 'Enable Custom Thumbnail',
                    'desc' => 'Turn On to display your custom thumbnail in this video, enhancing brand visibility and recognition.',
                    'default' => '0',
                ),
                array(
                    'id' => 'thumbnailSource',
                    'title' => 'Upload Custom Thumbnail',
                    'type'  => 'upload',
                    'desc' => 'Upload here thumbnail for show the display in this video',
                    'dependency' => array('customThumbnail', '==', true),
                ),
                array(
                    'id' => 'controls',
                    'type' => 'button_set',
                    'title' => 'Controls',
                    'multiple' => true,
                    'options' => array(
                        'play-large' => 'Play Large',
                        'restart' => 'Restart',
                        'rewind' => 'Rewind',
                        'play' => 'Play',
                        'fast-forward' => 'Fast Forwards',
                        'progress' => 'Progressbar',
                        'duration' => 'Duration',
                        'current-time' => 'Current Time',
                        'mute' => 'Mute Button',
                        'volume' => 'Volume Control',
                        'fullscreen' => 'Fullscreen',
                        'download' => 'Download',
                    ),
                    'default' => ['play-large', 'play', 'progress', 'duration', 'current-time', 'mute', 'volume', 'fullscreen']
                ),
                array(
                    'id' => 'loop',
                    'type' => 'switcher',
                    'title' => 'Repeat',
                    'desc' => 'On if you want the video play again after the finished duration',
                    'default' => '0',
                ),
                array(
                    'id' => 'muted',
                    'type' => 'switcher',
                    'title' => 'Muted',
                    'desc' => 'On if you want the video output should be muted',
                    'default' => '0',
                ),
                array(
                    'id' => 'autoplay',
                    'type' => 'switcher',
                    'title' => 'Auto Play',
                    'desc' => 'Turn On if you  want video will start playing as soon as it is ready. <a href="https://developers.google.com/web/updates/2017/09/autoplay-policy-changes">autoplay policy</a>',
                    'default' => '',
                ),
                array(
                    'id' => 'width',
                    'type' => 'dimensions',
                    'title' => 'Player Width',
                    'height' => false,
                    'default' => [
                        'unit' => '%',
                        'width' => 100,
                    ]
                ),
                array(
                    'id' => 'seekTime',
                    'type' => 'number',
                    'title' => 'Seek Time',
                    'desc' => 'The time, in seconds, to seek when a user hits fast forward or rewind. Default value is 10 Sec.',
                    'default' => 10,
                ),
                array(
                    'id' => 'hideControls',
                    'type' => 'switcher',
                    'title' => 'Auto Hide Control',
                    'desc' => 'On if you want the controls (such as a play/pause button etc) hide automatically.',
                    'default' => '1',
                ),
                array(
                    'id' => 'clickToPlay',
                    'type' => 'switcher',
                    'title' => 'Click To Play',
                    'default' => '0',
                ),
                array(
                    'id' => 'hideYoutubeUI',
                    'type' => 'switcher',
                    'title' => 'Hide Youtube UI (Experimental, check it\'s working or not for you)'
                ),
                array(
                    'id' => 'showThumbnailOnPause',
                    'type' => 'switcher',
                    'title' => 'Show Thumbnail On Pause',
                    'desc' => 'On if you want show the thumbnail when you video on pause.',
                    'default' => '0',
                ),
                array(
                    'id' => 'hideControlsWhenPause',
                    'type' => 'switcher',
                    'title' => 'Hide Controls in Pause',
                    'default' => '0',
                ),
                array(
                    'id' => 'roundCorner',
                    'type' => 'dimensions',
                    'title' => 'Video Player Corner',
                    'height' => false,
                    'desc' => 'You set here the round corner for the video player.',
                    'default' => [
                        'unit' => 'px',
                        'width' => 3,
                    ]
                ),
                array(
                    'id' => 'playButtonCorner',
                    'type' => 'dimensions',
                    'title' => 'Play Button Corner',
                    'height' => false,
                    'desc' => 'You set here the round corner for the play button.',
                    'default' => [
                        'unit' => '%',
                        'width' => 50,
                    ]
                ),
                array(
                    'id' => 'playButtonPadding',
                    'type' => 'dimensions',
                    'title' => 'Padding',
                    'height' => false,
                    'desc' => 'You set here the padding for the play button.',
                    'default' => [
                        'unit' => 'px',
                        'width' => 15,
                    ]
                ),
                array(
                    'id' => 'playIconSize',
                    'type' => 'dimensions',
                    'title' => 'Play Icon Size',
                    'height' => false,
                    'desc' => 'You set here the size of the play icon.',
                    'default' => [
                        'unit' => 'px',
                        'width' => 25,
                    ]
                ),
                array(
                    'id'    => 'background',
                    'type'  => 'color',
                    'title' => 'Play Button Background',
                ),
            )
        ));
    }
}
