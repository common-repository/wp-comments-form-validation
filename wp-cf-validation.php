<?php
/*
Plugin Name: Wordpress Comments Form Validation
Plugin URI: https://github.com/andy-saint/wp-cf-validation
Description: Wordpress Comments Form Validation is an open source plugin to add the jQuery Validation plugin functionality to the Wordpress comments form.
Version: 1.0.0
Author: Andrew Saint
Author URI: https://github.com/andy-saint
License: GPL2
 */

class WP_CF_Validation {

	// Plugin version
	const VERSION = '1.0.0';

	// Instance of this class.
	protected static $instance = null;

	/**
	 * Initialize the plugin.
	 * @since 1.0.0
	 */

	private function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Return an instance of this class.
	 * @since 1.0.0
	 * @return object
	 */

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Make plugin available for translation.
	 * @since 1.0.0
	 */

	public function i18n() {
		load_plugin_textdomain( 'wp-cf-validation', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 * @since 1.0.0
	 */

	public function enqueue_scripts() {

		wp_register_script( 'jquery-validation',
			'//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js', array( 'jquery' ), '1.13.0', true );

		wp_register_script( 'wp-cf-validation',
			plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery', 'jquery-validation' ), self::VERSION, true );

		wp_localize_script( 'wp-cf-validation', 'wp_cf_validation', array(
			'require_name_email' => (bool) get_option( 'require_name_email' ),
			'messages'           => array(
				'name'          => __( 'Your name is required.', 'wp-cf-validation' ),
				'email'         => __( 'Your email is required.', 'wp-cf-validation' ),
				'email_invalid' => __( 'Please enter a valid email address.', 'wp-cf-validation' ),
				'comment'       => __( 'Your comment is required.', 'wp-cf-validation' ),
				'minlength'     => sprintf( _x( 'At least %s characters required.', 'minimum characters required', 'wp-cf-validation' ), '{0}' )
			),
			'classes' => array(
				'error' => array( 'error' )
			)
		) );

		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'wp-cf-validation' );
		}

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 * @since 1.0.0
	 */

	public function enqueue_styles() {
		wp_enqueue_style( 'wp-cf-validation', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
	}

}

add_action( 'plugins_loaded', array( 'WP_CF_Validation', 'get_instance' ) );
