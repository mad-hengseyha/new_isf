<?php
/*
 * @package   GFP_Currency_Selector\GFP_Currency_Selector_Converter
 * @copyright 2015-2021 gravity+
 * @license   GPL-2.0+
 * @since     1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class GFP_Currency_Selector_Converter
 *
 * Converts currencies
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector_Converter {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @author   Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var      object
	 */
	private static $_this = null;

	/**
	 * Rates table
	 *
	 * @since    1.0.0
	 *
	 * @author   Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var string
	 */
	private $rates = '';

	/**
	 * Constructor
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @uses      wp_die()
	 * @uses      __()
	 * @uses      register_activation_hook()
	 * @uses      add_action()
	 *
	 */
	function __construct() {

		if ( isset( self::$_this ) ) {

			wp_die( sprintf( __( 'There is already an instance of %s.',
			                     'gravityplus-currency-selector' ), get_class( $this ) ) );
		}

		self::$_this = $this;

	}

	/**
	 * Private clone method to prevent cloning of the instance of the *Singleton* instance.
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return void
	 */
	private function __clone() {
	}

	/**
	 * Private unserialize method to prevent unserializing of the *Singleton* instance.
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return void
	 */
	public function __wakeup() {
	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return GFP_Currency_Selector_Converter|null|object
	 */
	public static function this() {

		return self::$_this;

	}

	/**
	 * Get current rates from Open Exchange Rates API
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return array|mixed|object|string
	 */
	public function get_current_rates( $app_id = 0 ) {

		global $gravityplus_currency_selector;


		if ( ! empty( self::$_this->rates ) ) {

			$current_rates = self::$_this->rates;

		} else {

			$gravityplus_currency_selector->get_addon_object()->log_debug( __( 'Retrieving current conversion rates', 'gravityplus-currency-selector' ) );

			if ( empty( $app_id ) ) {

				$app_id = $gravityplus_currency_selector->get_addon_object()->get_plugin_setting( 'app_id' );

			}

			$api_url = "http://openexchangerates.org/api/latest.json?app_id={$app_id}";

			$response = wp_remote_post( $api_url, array( 'timeout' => 30 ) );

			$body     = wp_remote_retrieve_body( $response );

			if ( empty( $body ) ) {

				$gravityplus_currency_selector->get_addon_object()->log_error( __( 'Empty response', 'gravityplus-currency-selector' ) );

				return $body;

			}

			$current_rates = json_decode( $body, true );

			if ( ! empty( $current_rates[ 'error' ] ) ) {

				$gravityplus_currency_selector->get_addon_object()->log_error( "{$current_rates['message']} {$current_rates['description']}" );

				return '';

			}

			self::$_this->rates = $current_rates;

		}

		return $current_rates;
	}

	/**
	 * @param $number
	 */
	public function to_money( $number ) {
	}

	/**
	 * @param $money
	 */
	public function to_number( $money ) {
	}

	/**
	 * Convert amount from one currency to another
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $number
	 * @param $from_currency
	 * @param $to_currency
	 *
	 * @return float
	 */
	public function convert( $number, $from_currency, $to_currency ) {

		$rate = self::$_this->get_rate( $from_currency, $to_currency );

		if ( ! empty( $rate ) ) {

			$number = $number * $rate;

		}

		return $number;

	}

	/**
	 * Get conversion rate from one currency to another
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $from_currency
	 * @param $to_currency
	 *
	 * @return float
	 */
	private function get_rate( $from_currency, $to_currency ) {

		$current_rates = self::get_current_rates();

		if ( ! empty( $current_rates ) ) {

			if ( $current_rates[ 'base' ] == $from_currency ) {

				$rate = $current_rates[ 'rates' ][ $to_currency ];

			} else if ( $current_rates[ 'base' ] == $to_currency ) {

				$rate = 1 / $current_rates[ 'rates' ][ $from_currency ];

			} else {

				$rate = $current_rates[ 'rates' ][ $to_currency ] * ( 1 / $current_rates[ 'rates' ][ $from_currency ] );

			}

			return $rate;
		}

	}
} 