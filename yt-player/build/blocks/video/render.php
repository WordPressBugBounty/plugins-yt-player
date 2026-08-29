<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use YTP\Model\Presets;

// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$ytp_preset = new Presets();
$id = wp_unique_id('ytPlayer-');

// echo "<pre>";
// print_r($preset->get($attributes['presetID']));
// echo "</pre>";

?>

<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id='<?php echo esc_attr($id); ?>' data-attributes='<?php echo esc_attr(wp_json_encode($attributes)); ?>' data-preset="<?php echo esc_attr(wp_json_encode($ytp_preset->get($attributes['presetID']))) ?>">
</div>