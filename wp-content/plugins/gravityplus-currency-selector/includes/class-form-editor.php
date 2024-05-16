<?php
/** @package   GFP_Currency_Selector
 * @copyright 2015-2021 gravity+
 * @license   GPL-2.0+
 * @since     1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * GFP_Currency_Selector_Form_Editor Class
 *
 * Form editor
 *
 * @since 1.0.0
 *
 */
class GFP_Currency_Selector_Form_Editor {

	private static $_this = null;


	/**
	 * GFP_Currency_Selector_Form_Editor constructor.
	 */
	public function __construct() {

		self::$_this = $this;
		
		if ( 'gf_edit_forms' == GFForms::get( 'page' ) ) {

			add_filter( 'gform_predefined_choices', array( $this, 'gform_predefined_choices' ) );

		}
	}

	/**
	 * @param $predefined_choices
	 *
	 * @return mixed
	 */
	public function gform_predefined_choices( $predefined_choices ) {

		$available_currencies = RGCurrency::get_currencies();
		$choice_category      = __( 'Currencies', 'gravityplus-currency-selector' );

		$predefined_choices[ $choice_category ] = array_keys( $available_currencies );

		return $predefined_choices;
	}
	
}