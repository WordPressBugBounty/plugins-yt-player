<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (!function_exists('ytp_fs') || !ytp_fs()->can_use_premium_code()) {
    echo '<div style="display: flex; justify-content: center; padding: 50px 0;"><span style="padding: 12px 24px; background: #00b2ff; color: #fff; border-radius: 4px; font-size: 16px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">Sorry, it\'s a premium block</span></div>';
    return;
}
$id = wp_unique_id('timelineWrapper-');
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id='<?php echo esc_attr($id); ?>' data-attributes='<?php echo esc_attr(wp_json_encode($attributes)); ?>'></div>