<?php
/**
 * This controls the checkout_title display on the checkout page.
 *
 * @link       https://skoleredskaberne.dk
 * @since      1.0.0
 *
 * @package    WCPT
 * @subpackage WCPT/Includes
 */

/**
 * This controls the checkout_title display on the checkout page.
 *
 * @package    WCPT
 * @subpackage WCPT/Includes
 * @author     Emil Kjær Eriksen <emilxeriksen@gmail.com>
 */
class WCPT_Checkout {

	/**
	 * Filter the gateway title and show checkout_title if on checkout page.
	 *
	 * @param  string $title Gateway title
	 * @param  string $id    Gateway ID.
	 * @return string        Gateway title.
	 */
	public static function gateway_title( $title, $id ) {

		if ( ! is_checkout() || is_wc_endpoint_url() || did_action( 'woocommerce_checkout_process' ) ) {
			return $title;
		}

		$payment_gateways = WC()->payment_gateways()->payment_gateways();

		if ( isset( $payment_gateways[ $id ] ) ) {
			$gateway = $payment_gateways[ $id ];
		}

		if ( ! isset( $gateway ) || ! $checkout_title = $gateway->get_option( 'checkout_title' ) ) {
			return $title;
		}

		$title = $checkout_title;

		return $title;
	}

}
