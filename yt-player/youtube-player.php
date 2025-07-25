<?php

if (!class_exists('YTPPlugin')) {
    class YTPPlugin
    {
        function __construct()
        {
            add_action('enqueue_block_assets', [$this, 'enqueueBlockAssets']);
            add_action('init', [$this, 'onInit']);
        }

        function enqueueBlockAssets()
        {
            wp_register_script('plyrIoJS', YTP_PLUGIN_DIR . 'public/js/plyr.js', [], YTP_PLUGIN_VERSION);
            wp_register_style('plyrIoCSS', YTP_PLUGIN_DIR . 'public/css/plyr.css', [], YTP_PLUGIN_VERSION);
        }

        function onInit()
        {
            register_block_type(__DIR__ . '/build/blocks/youtube-player');
            register_block_type(__DIR__ . '/build/blocks/video');
            register_block_type(__DIR__ . '/build/blocks/timeline');
            register_block_type(__DIR__ . '/build/blocks/parent');

            wp_localize_script('yt-player-video-editor-script', 'ytpPlayer', [
                'ajaxURL' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('wp_ajax'),
                'is_premium' => (bool) ytp_fs()->can_use_premium_code(),
            ]);
        }
    }
    new YTPPlugin();
}
