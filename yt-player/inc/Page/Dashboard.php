<?php
namespace YTP\Page;
class Dashboard{

  public function register(){
    add_action( 'admin_enqueue_scripts', [$this, 'dashboardEnqueueScripts'] );
      add_action('admin_menu', [$this, 'admin_menu']);
  }

  function dashboardEnqueueScripts( $hook ) {
  
    if( str_contains( $hook, 'ytplayer' ) ){
      wp_enqueue_style( 'yt-player-dashboard-style', YTP_PLUGIN_DIR . 'build/dashboard.css', [], YTP_PLUGIN_VERSION );

      wp_enqueue_script( 'yt-player-dashboard-script', YTP_PLUGIN_DIR . 'build/dashboard.js', [ 'react', 'react-dom',  'wp-components', 'wp-i18n', 'wp-api', 'wp-util' ,'lodash', 'wp-media-utils' ,'wp-data','wp-core-data','wp-api-request' ], YTP_PLUGIN_VERSION, true );
    }
  }

  public function admin_menu(){
      add_submenu_page( 'edit.php?post_type=ytplayer', 'Dashboard', 'Dashboard', 'manage_options', 'dashboard', [$this, 'dashboard_page_callback'],0 );
  }


  function dashboard_page_callback() {
      ?>
          <div id="ytplYtPlayerDashboard" data-ispremium="<?php echo ytp_fs()->can_use_premium_code()?>">

          </div>
      <?php
  }
}