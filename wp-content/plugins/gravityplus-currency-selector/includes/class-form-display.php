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
 * Class GFP_Currency_Selector_Form_Display
 *
 * Handles displaying the currency field on the form
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector_Form_Display {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );

		add_action( 'admin_init', array( $this, 'admin_init' ) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function init() {

		add_action( 'gform_enqueue_scripts', array( $this, 'gform_enqueue_scripts' ), 10, 2 );

		add_action( 'wp_ajax_gfp_currency_selector_get_currency', array( $this, 'get_currency' ) );

		add_action( 'wp_ajax_nopriv_gfp_currency_selector_get_currency', array( $this, 'get_currency' ) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function admin_init() {

		add_filter( 'gform_noconflict_scripts', array( $this, 'gform_noconflict_scripts' ) );

	}

	/**
	 * Allow JS to be used when Gravity Forms noconflict is turned on
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $noconflict_scripts
	 *
	 * @return array
	 */
	public function gform_noconflict_scripts( $noconflict_scripts ) {

		return array_merge( $noconflict_scripts, array(
			'gfp_currency_selector_field',
			'gfp_currency_selector_moneyjs'
		) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 * @param $ajax
	 */
	public function gform_enqueue_scripts( $form, $ajax ) {

		if ( GFP_Currency_Selector_Helper::has_currency_field( $form ) ) {

			$this->add_currency_field_js( $form );

		}

	}

	/**
	 * Add front-end JS
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 */
	private function add_currency_field_js( $form ) {

		global $gravityplus_currency_selector;

		$currency_field_vars = array();


		$current_rates = $gravityplus_currency_selector->get_converter()->get_current_rates();

		if ( ! empty( $current_rates ) ) {

			$currency_field_vars[ 'rates' ] = $current_rates[ 'rates' ];

			$currency_field_vars[ 'base' ] = $current_rates[ 'base' ];

			$currency_field_vars[ 'default_from' ] = ( ! empty( $form[ 'currency' ] ) ) ? $form[ 'currency' ] : GFCommon::get_currency();

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script( 'gfp_currency_selector_moneyjs', trailingslashit( GFP_CURRENCY_SELECTOR_URL ) . "includes/js/money{$suffix}.js", array( 'jquery' ), GFP_CURRENCY_SELECTOR_CURRENT_VERSION );

			wp_enqueue_script( 'gfp_currency_selector_field', trailingslashit( GFP_CURRENCY_SELECTOR_URL ) . "includes/js/currency_field{$suffix}.js", array(
				'gform_gravityforms',
				'gfp_currency_selector_moneyjs'
			), GFP_CURRENCY_SELECTOR_CURRENT_VERSION );

			/*$form_feeds                                 = GFP_Stripe_Data::get_feed_by_form( $form[ 'id' ], true );
			$currency_field_vars[ 'currency_field_id' ] = GFP_More_Stripe_Currency::get_currency_field_id_from_feed( $form_feeds[ 0 ] );*/
			$currency_field_vars[ 'currency_field_id' ] = GFP_Currency_Selector_Helper::get_currency_field_id_from_form( $form );

			$currency_field_vars[ 'nonce' ] = wp_create_nonce( 'gfp_currency_selector_get_currency' );

			$protocol                         = isset ( $_SERVER[ 'HTTPS' ] ) ? 'https://' : 'http://';
			$currency_field_vars[ 'ajaxurl' ] = admin_url( 'admin-ajax.php', $protocol );

			$currency_field_vars[ 'spinner_url' ] = apply_filters( "gform_ajax_spinner_url_{$form['id']}", apply_filters( "gform_ajax_spinner_url", GFCommon::get_base_url() . "/images/spinner.svg", $form ), $form );

			if ( ! empty( $_POST ) ) {

				$currency_field_vars[ 'is_postback' ] = true;

			}

			wp_localize_script( 'gfp_currency_selector_field', 'gf_currency', $currency_field_vars );

		} else {

			$gravityplus_currency_selector->get_addon_object()->log_error( __( 'Unable to add currency field JS', 'gravityplus-currency-selector' ) );

		}

	}

	public function get_currency() {

		check_ajax_referer( 'gfp_currency_selector_get_currency', 'gfp_currency_selector_get_currency' );

		$currency_code = rgpost( 'currency' );

		GFP_Currency_Selector_Helper::include_rgcurrency();

		$currency = RGCurrency::get_currency( $currency_code );

		if ( ! empty( $currency ) && is_array( $currency ) ) {

			$currency[ 'code' ] = $currency_code;

			wp_send_json_success( $currency );

		} else {

			wp_send_json_error();

		}

	}

}