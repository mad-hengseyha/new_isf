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
 * Class GFP_Currency_Selector
 *
 * Main plugin class
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector {

	/**
	 * Converter object
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var GFP_Currency_Selector_Converter
	 */
	private $converter = null;

	/**
	 * Processor object
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var GFP_Currency_Selector_Form_Processor
	 */
	private $form_processor = null;

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function __construct() {
	}

	/**
	 * Load WordPress functions
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function run() {

		add_action( 'gform_loaded', array( $this, 'gform_loaded' ) );

	}

	/**
	 * Create GF Add-On
	 *
	 * @since  1.1.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function gform_loaded() {

		if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {

			return;

		}

		GFForms::include_addon_framework();

		GFForms::include_feed_addon_framework();

		GFAddOn::register( 'GFP_Currency_Selector_Addon' );


		new GFP_Currency_Selector_Form_Editor();

		try {

			GF_Fields::register( new GF_Field_Currency() );

		}
		catch( Exception $e ){}

		new GFP_Currency_Selector_Form_Display();

		$this->form_processor = new GFP_Currency_Selector_Form_Processor();

		$this->converter = new GFP_Currency_Selector_Converter();

		new GFP_Currency_Selector_Integration_Stripe();

	}



	/**
	 * Return GF Add-On object
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return GFP_Currency_Selector_Addon
	 */
	public function get_addon_object() {

		return GFP_Currency_Selector_Addon::get_instance();

	}

	/**
	 * Return Converter
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return GFP_Currency_Selector_Converter
	 */
	public function get_converter() {

		return $this->converter;

	}

	/**
	 * Return Processor
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return GFP_Currency_Selector_Form_Processor
	 */
	public function get_form_processor() {

		return $this->form_processor;

	}

}