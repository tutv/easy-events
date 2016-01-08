<?php

/**
 * Plugin Name: Easy Events
 * Plugin URI: http://www.woothemes.com/woocommerce/
 * Description: Make
 * Version: 1.0.0
 * Author: WPArena
 * Author URI: https://wparena.com
 * Requires at least: 4.1
 * Tested up to: 4.4
 *
 * Text Domain: easy-events
 *
 * @package  Easy_Event
 * @category Core
 * @author   WooThemes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Easy_Event' ) ) :

	class Easy_Event {
		/**
		 * @var string
		 */
		public $version = '1.0.0';

		function __construct() {

		}

		public function init() {

		}

		public function includes() {

		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}
	}

endif;

$easy_events = new Easy_Event();