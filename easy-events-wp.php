<?php

/**
 * Plugin Name: Event WP
 * Plugin URI: https://wparena.com
 * Description: Best simple and useful WordPress Event Plugin.
 * Version: 1.1.6
 * Author: WPArena
 * Author URI: https://wparena.com
 * Requires at least: 4.1
 * Tested up to: 4.4.1
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
define( 'EASY_EVENT_VERSION', '1.1.6' );

if ( ! class_exists( 'Easy_Event' ) ) :

	class Easy_Event {
		/**
		 * Easy_Event constructor.
		 */
		function __construct() {
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'admin_init', array( $this, 'libraries_admin' ) );
			add_action( 'widgets_init', array( $this, 'widget' ) );
			add_action( 'activated_plugin', array( $this, 'install' ) );
		}

		/**
		 * Install
		 */
		public function install() {
			$content = file_get_contents( EASY_EVENT_DIR . '/templates-default/single-content.php' );
			update_option( 'easy_event_single_template', $content );
			update_option( 'easy_event_excerpt_length', 250 );
		}

		/**
		 * Init Easy Events
		 */
		public function init() {
			do_action( 'before_easy_event_init' );

			$this->libraries();
			$this->includes();
			$this->template_builder();

			do_action( 'easy_event_init' );
		}

		/**
		 * Include libraries
		 */
		public function libraries() {
			require_once 'libraries/metaboxio/meta-box.php';
		}

		/**
		 * Include libraries in admin area
		 */
		public function libraries_admin() {
		}

		/**
		 * Include required core
		 */
		public function includes() {
			require_once 'includes/event-post-type.php';
			require_once 'includes/metabox.php';
			require_once 'functions.php';
			require_once 'includes/setting-admin.php';
		}

		/**
		 * Template builder
		 */
		public function template_builder() {
			require_once 'template-builder/single.php';
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