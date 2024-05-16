<?php
/*
 * @package   GFP_Currency_Selector
 * @copyright 2015-2021 gravity+
 * @license   GPL-2.0+
 * @since     1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class GFP_Currency_Selector_Integration_Stripe
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector_Integration_Stripe {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function __construct() {
		
		add_action( 'init', array( $this, 'init' ) );

	}

	public function init() {

		add_filter( 'gfp_stripe_get_form_data', array( $this, 'gfp_stripe_get_form_data' ), 10, 5 );

	}

	/**
	 * @param $form_data
	 * @param $feed
	 * @param $products
	 *
	 * @param $form
	 * @param $tmp_lead
	 *
	 * @return mixed
	 */
	public function gfp_stripe_get_form_data( $form_data, $feed, $products, $form, $tmp_lead ) {

		global $gravityplus_currency_selector;

		
		$submitted_form_currency = $gravityplus_currency_selector->get_form_processor()->get_submitted_currency( $form, $tmp_lead );

		$default_form_currency = $gravityplus_currency_selector->get_form_processor()->get_default_form_currency( $form['id'] );
			
		if ( ! empty( $submitted_form_currency ) ) {

			$form_data[ 'currency' ] = $submitted_form_currency;

		} else if ( ! empty( $default_form_currency ) ) {

			$form_data[ 'currency' ] = $default_form_currency;

		} /*else if ( ! empty( $form[ 'currency' ] ) ) {

			$form_data[ 'currency' ] = self::$default_form_currency = $form[ 'currency' ];

		}*/

		return $form_data;
	}

}