<?php
/**
 * This controls the admin.
 *
 * @link       https://skoleredskaberne.dk
 * @since      1.0.0
 *
 * @package    WCPT
 * @subpackage WCPT/Includes
 */

/**
 * This controls the admin.
 *
 * @package    WCPT
 * @subpackage WCPT/Includes
 * @author     Emil Kjær Eriksen <emilxeriksen@gmail.com>
 */
class WCPT_Admin {

	/**
	 * Hook into the form_fields hook for each payment gateway.
	 */
	public static function payment_gateways_form_fields_hook() {

		$payment_gateways = WC()->payment_gateways()->payment_gateways();

		foreach ( $payment_gateways as $id => $gateway ) {
			add_filter( 'woocommerce_settings_api_form_fields_' . $id, array( __CLASS__, 'add_checkout_title_field' ) );
		}

	}

	/**
	 * Add the checkout_title field to form_fields.
	 *
	 * @param array $form_fields Form fields.
	 */
	public static function add_checkout_title_field( $form_fields ) {

		if ( isset( $form_fields['title'] ) ) {

			$form_fields = wcpt_array_insert_after( $form_fields, 'title', array(
				'checkout_title' => array(
					'title'       => 'Checkout title',
					'type'        => 'text',
					'description' => 'This controls the title which the user sees on the checkout page.',
					'desc_tip'    => true,
				),
			) );

		}

		return $form_fields;
	}

}
