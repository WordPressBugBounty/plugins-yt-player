<?php 

namespace YTP\Page; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound

class Settings {

    protected $prefix = 'ytp_option';
    
    public function register(){
        add_action('init', [ $this, 'action_init' ],0 );
        add_action('admin_head', [ $this, 'admin_head_css' ]);
    }

    public function admin_head_css() {
        $screen = get_current_screen();
        if ($screen && strpos($screen->id, 'ytp_options') !== false) {
            echo '<style>
                .bplugins-meta-readonly { opacity: 0.6; position: relative; } 
                .csf-field.bplugins-meta-readonly:hover::after { display: block; } 
                .csf-field.bplugins-meta-readonly::before { display: block; width: 100%; height: 100%; content: ""; position: absolute; z-index: 999; overflow: hidden; top: 0; left: 0; } 
                .csf-field.bplugins-meta-readonly::after { display: none; content: "The option is available in the pro version only"; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999999; font-size: 22px; background: #673ab7; color: #fff; padding: 10px 13px; border-radius: 3px; }
            </style>';
        }
    }

    function action_init() {
        if (class_exists('\CSF')) {
            \CSF::createOptions($this->prefix, array(
                'menu_title' => 'Settings',
                'menu_slug' => 'ytp_options',
                'menu_parent' => 'edit.php?post_type=ytplayer',
                'menu_type' => 'submenu',
                'theme' => 'light',
                // 'data_type' => 'unserialize',
                'show_all_options' => false,
                'save_defaults' => true,
                // 'framework_class' => 'ytp_options',
                'framework_title' => 'Settings',
                'show_bar_menu' => false,
                // 'menu_capability' => 'edit_posts'
            ));
                $this->quickPlayer();
                $this->branding();
                $this->shortcode();
        }
    }

    /**
     * Fires after WordPress has finished loading but before any headers are sent.
     *
     */
   

    function quickPlayer(){
        $is_pro = function_exists('ytp_fs') && ytp_fs()->can_use_premium_code();

        $seekTime_field = array(
            'id'      => $is_pro ? 'seekTime' : 'seekTime_ignore',
            'type'    => 'number',
            'title'   => 'Seek Time',
            'desc'    => 'The time, in seconds, to seek when a user hits fast forward or rewind. Default value is 10 Sec.',
            'default' => 10,
        );

        $hideControls_field = array(
            'id'      => $is_pro ? 'hideControls' : 'hideControls_ignore',
            'type'    => 'switcher',
            'title'   => 'Auto Hide Control',
            'desc'    => 'On if you want the controls (such as a play/pause button etc) hide automaticaly.',
            'default' => '1',
        );

        $hideYoutubeUI_field = array(
            'id'    => $is_pro ? 'hideYoutubeUI' : 'hideYoutubeUI_ignore',
            'type'  => 'switcher',
            'title' => 'Hide Youtube UI (Experimental, check it\'s working or not for you)'
        );

        if (!$is_pro) {
            $seekTime_field['class']      = 'bplugins-meta-readonly';
            $hideControls_field['class']  = 'bplugins-meta-readonly';
            $hideYoutubeUI_field['class'] = 'bplugins-meta-readonly';
        }

        \CSF::createSection($this->prefix, array(
            // 'parent' => 'ytp_playerio',
            'title' => 'Quick Player',
            'fields' => array(
                array(
                    'type' => 'content',
                    'content' => __('<div style="background-color: #e9eaec; padding: 15px 20px; margin-bottom: 20px; border-radius: 4px;">
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                <code id="ytp-quick-shortcode" style="background: #ffffff; padding: 6px 12px; border: 1px solid #3567d6; color: #3567d6; font-size: 14px; border-radius: 2px;">[ytp]Your Video URL[/ytp]</code>
                                <button type="button" style="background: transparent; border: none; cursor: pointer; padding: 0; color: #1e1e1e; display: flex; align-items: center;" onclick="var text = \'[ytp]Your Video URL[/ytp]\'; var codeEl = document.getElementById(\'ytp-quick-shortcode\'); var showFeedback = function(){ var oldText = codeEl.innerText; codeEl.innerText = \'Copied!\'; setTimeout(function(){ codeEl.innerText = oldText; }, 2000); }; if(navigator.clipboard && navigator.clipboard.writeText){ navigator.clipboard.writeText(text).then(showFeedback).catch(function(){ var ta = document.createElement(\'textarea\'); ta.value = text; document.body.appendChild(ta); ta.select(); document.execCommand(\'copy\'); document.body.removeChild(ta); showFeedback(); }); } else { var ta = document.createElement(\'textarea\'); ta.value = text; document.body.appendChild(ta); ta.select(); document.execCommand(\'copy\'); document.body.removeChild(ta); showFeedback(); }" title="Copy to clipboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                </button>
                            </div>
                            <span style="font-size: 14px; color: #3c434a; display: block;">Simply copy the shortcode above and place your YouTube video URL between the <strong>[ytp]</strong> and <strong>[/ytp]</strong> tags. You can paste it in any post or page.</span>
                        </div>', 'yt-player'),
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
                      'settings' => 'Setting Button',
                      'fullscreen' => 'Fullscreen'
                    ),
                    'default' => ['play-large', 'rewind', 'play', 'fast-forward', 'progress', 'duration', 'current-time','mute', 'volume', 'settings', 'fullscreen']
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
                $seekTime_field,
                $hideControls_field,
                $hideYoutubeUI_field
            ),
        ));
    }

    public function branding(){
        \CSF::createSection($this->prefix, array(
            // 'parent' => 'ytp_playerio',
            'title' => 'Branding',
            'fields' => array(
                array(
                    'id' => 'brandColor',
                    'type' => 'color',
                    'title' => 'Brand Color',
                    'default' => '#00AFFA'
                ),
            ),
        ));
    }
    
    public function shortcode(){
        \CSF::createSection($this->prefix, array(
            // 'parent' => 'ytp_playerio',
            'title' => 'Shortcode',
            'fields' => array(
                array(
                    'id' => 'gutenbergEnabled',
                    'type' => 'switcher',
                    'title' => 'Gutenberg Enabled for Shortcode Generator',
                    'default' => false
                ),
            ),
        ));
    }
}