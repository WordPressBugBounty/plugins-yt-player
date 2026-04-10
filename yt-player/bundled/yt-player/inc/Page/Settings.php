<?php 

namespace YTP\Page;

class Settings {

    protected $prefix = 'ytp_option';
    
    public function register(){
        add_action('init', [ $this, 'action_init' ],0 );
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
        \CSF::createSection($this->prefix, array(
            // 'parent' => 'ytp_playerio',
            'title' => 'Quick Player',
            'fields' => array(
                array(
                    'type' => 'heading',
                    'content' => __("[ytp] YouTube Video URL [/ytp]", "ytp"),
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
                    'desc' => 'On if you want the controls (such as a play/pause button etc) hide automaticaly.',
                    'default' => '1',
                ),
                array(
                    'id' => 'clickToPlay',
                    'type' => 'switcher',
                    'title' => 'Click To Play',
                    'default' => '1',
                ),
                array(
                    'id' => 'disableContextMenu',
                    'type' => 'switcher',
                    'title' => 'Disable Context Menu',
                    'default' => '1',
                ),
                array(
                    'id' => 'hideYoutubeUI',
                    'type' => 'switcher',
                    'title' => 'Hide Youtube UI (Experimental, check it\'s working or not for you)'
                )
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