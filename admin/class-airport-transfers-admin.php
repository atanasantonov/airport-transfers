<?php defined( 'ABSPATH' ) or die( 'I can\'t do anything alone! Sorry!' );

if( !class_exists('NS_Airport_Transfers_Admin') ):

class NS_Airport_Transfers_Admin {

	private static  $initiated   = FALSE;
	public static   $settings    = 'ns-airport-transfers-group';

	/**
	 * Init.
	 */
	public static function init() {
  		if( ! self::$initiated ) {
			self::init_hooks();
		}
	}


	/**
	 * Register hooks.
	 */
	private static function init_hooks() {
		add_action( 'admin_init', array( '\NS_Airport_Transfers_Admin', 'init' ) );
		add_action( 'admin_menu', array( '\NS_Airport_Transfers_Admin', 'admin_menu' ) );
		add_action( 'admin_init', array( '\NS_Airport_Transfers_Admin', 'register_settings' ) );

		self::$initiated = TRUE;
	}


	/**
	 * Admin menu.
	 */
	public static function admin_menu() {
		add_submenu_page(
			'options-general.php',
			'Airport Transfers',
			'Airport Transfers',
			'edit_posts',
			'ns-airport-transfers-settings',
			array( '\NS_Airport_Transfers_Admin', 'settings_page' ),
			100
		);
	}


	/**
	 * Register settings.
	 */
	public static function register_settings() {
		register_setting( self::$settings, 'ns-airport-transfers-admin-email' );
		register_setting( self::$settings, 'ns-airport-transfers-contact-email' );
		register_setting( self::$settings, 'ns-airport-transfers-contact-phone' );
		register_setting( self::$settings, 'ns-airport-transfers-country' );
		register_setting( self::$settings, 'ns-airport-transfers-resort' );
		register_setting( self::$settings, 'ns-airport-transfers-time-format' );
	}


	/**
	 * Settings page.
	 */
	public static function settings_page() {
		require_once( NS_AIRPORT_TRANSFERS_PATH . 'admin/views/settings-page.php' );
	}
}

endif;
