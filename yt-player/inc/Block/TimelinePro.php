<?php
namespace YTP\Block; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedNamespaceFound

use YTP\Model\Presets;

class Timeline {

    public function register(){
        add_action('init', [$this, 'init']);
    }

    public function init(){
        register_block_type( YTP_DIR_PATH . '/blocks/timeline', [
            'editor_style'  => 'ytp-blocks',
            'render_callback' => [$this, 'render'],
        ]);

        wp_localize_script( 'yt-player-video-editor-script', 'ytpPlayer',[
            'ajaxURL' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce( 'wp_ajax' ),
            'is_premium' => (bool) ytp_fs()->can_use_premium_code(),
        ]);
        
    }

    public function render($attrs){
        if (!ytp_fs()->can_use_premium_code()) {
            return '<div style="display: flex; justify-content: center; padding: 50px 0;"><span style="padding: 12px 24px; background: #00b2ff; color: #fff; border-radius: 4px; font-size: 16px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">Sorry, it\'s a premium block</span></div>';
        }

        $presetModel = new Presets();
        extract($attrs);

        wp_enqueue_style('ytp-public');
        wp_enqueue_script('ytp-public');

        ob_start(); ?>

        <div class="timelineBlock" data-attributes="<?php echo esc_attr(wp_json_encode($attrs)) ?>">timelineBlock</div>

        <?php return ob_get_clean();
    }


   function dataParser($data){
        $tempData = $data ?? [];
        if (is_array($tempData)) {
          foreach($tempData as $key => $value){
            if(is_array($tempData[$key])){
                $tempData[$key] = $this->dataParser($tempData[$key]);
            }else {
                $tempData[$key] = $this->typeChecker($tempData[$key]);
            }
          }
        }
        return $tempData;
    }
      
    function typeChecker($value) {
        if ($value === "true") {
            return true;
        }
        if ($value === "false") {
            return false;
        }
        return $value;
    }
}
