<?php 
/*
Plugin Name: WP Tarot Kickstarters
Plugin URI: https://github.com/adamjohnlea/wp-tarot-kickstaters
Description: Pulls 12 active tarot related Kickstarter projects, displays them in a widget
Version: 1.0
Contributors: adamjlea
Author: Adam John Lea
Author URI: https://wisdonforyourwalk.com
License: GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wpggr
*/

// Exit if accesed directly
if(!defined('ABSPATH')) {
    exit;
}

require_once(plugin_dir_path( __FILE__ ) . '/includes/wp-tarot-kickstarters-scripts.php');
require_once(plugin_dir_path( __FILE__ ) . '/includes/wp-tarot-kickstarters-class.php');

// Register Widget
function wpggr_register_widget() {
	register_widget('wp_tarot_kickstarters');
}

add_action('widgets_init', 'wpggr_register_widget');

