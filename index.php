<?php

/*
Plugin Name: ACF Flexible Utilities
Description: Allows you to add indicators for various states on ACF flexible content boxes.
Author: Ionuț Staicu
Version: 0.0.1
Author URI: http://ionutstaicu.com
*/

if ( !defined( 'ABSPATH' ) ) exit;

define( 'ACF_FLEXIBLE_UTILS_VERSION', '0.0.1' );

add_action('plugins_loaded', function () {
  load_plugin_textdomain( 'acf-flexible-utils', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
});

add_action('admin_init', function () {
  require_once 'inc/FlexibleContentProperties.php';
  new \ntz\acf\FlexibleContentProperties(__FILE__);
}, 0, 2);