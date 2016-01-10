<?php

/**
 * Plugin Name: Event WP
 * Plugin URI: https://wparena.com
 * Description: Create and manage event extremely simple event. Including event widget.
 * Version: 1.0.0
 * Author: WPArena
 * Author URI: https://wparena.com
 * Requires at least: 4.1
 * Tested up to: 4.4
 *
 * Text Domain: easy_event
 *
 * @package  Easy_Event
 * @author   WPArena
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'EASY_EVENT_URI', untrailingslashit( plugins_url( '/', __FILE__ ) ) );
define( 'EASY_EVENT_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'EASY_EVENT_VERSION', '1.0.0' );

if ( ! class_exists( 'Easy_Event' ) ) :

	class Easy_Event {
		/**
		 * Easy_Event constructor.
		 */
		function __construct() {
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'widgets_init', array( $this, 'widget' ) );
		}

		/**
		 * Init Easy Events
		 */
		public function init() {
			do_action( 'before_easy_event_init' );

			$this->libraries();
			$this->includes();

			do_action( 'easy_event_init' );
		}

		/**
		 * Include libraries
		 */
		public function libraries() {
			require_once 'libraries/metaboxio/meta-box.php';
		}

		/**
		 * Include required core
		 */
		public function includes() {
			require_once 'includes/event-post-type.php';
			require_once 'includes/metabox.php';
		}

		/**
		 * Include Widgets
		 */
		public function widget() {
			require_once 'widget/functions.php';
			require_once 'widget/event-widget.php';
		}
	}

endif;

$easy_events = new Easy_Event();