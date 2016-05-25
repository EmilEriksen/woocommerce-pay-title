<?php
/**
 * Plugin Name: WooCommerce Pay Title
 * Description: Display a custom payment gateway title only on the checkout page.
 * Version: 1.0.0
 * Author: Emil Kjær Eriksen
 * Requires at least: 4.5.2
 * Tested up to: 4.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WooCommerce_Pay_Title {

	/**
	 * The single instance of the class.
	 *
	 * @var WooCommerce_Pay_Title
	 */
	protected static $_instance = null;

	/**
	 * Main WooCommerce Pay Title Instance.
	 *
	 * Ensures only one instance of WooCommerce Pay Title is loaded or can be loaded.
	 *
	 * @return WooCommerce - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Setup everything.
	 */
	public function __construct() {
		$this->includes();
		$this->hooks();
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {
		include_once 'includes/wcpt-functions-utility.php';
		include_once 'includes/class-wcpt-autoloader.php';
	}

	private function hooks() {
		add_action( 'woocommerce_init', array( 'WCPT_Admin', 'payment_gateways_form_fields_hook' ) );

		add_filter( 'woocommerce_gateway_title', array( 'WCPT_Checkout', 'gateway_title' ), 10, 2 );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

}

/**
 * Main instance of WooCommerce Pay Title.
 *
 * Returns the main instance of WooCommerce Pay Title to prevent the need to use globals.
 *
 * @return WooCommerce_Pay_Title
 */
function WCPT() {
	return WooCommerce_Pay_Title::instance();
}

add_action( 'woocommerce_init', 'WCPT', 5 );
