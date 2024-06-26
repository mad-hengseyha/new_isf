<?php

/**
 * Adapted from WP Metadata API UI
 */
class GFP_Currency_Selector_Loader {

	private static $_autoload_classes = array(
		'GFP_Currency_Selector'                    => 'class-gfp-currency-selector.php',
		'GFP_Currency_Selector_Addon'              => 'class-addon.php',
		'GFP_Currency_Selector_Form_Editor'        => 'class-form-editor.php',
		'GF_Field_Currency'                        => 'class-gf-field-currency.php',
		'GFP_Currency_Selector_Form_Display'       => 'class-form-display.php',
		'GFP_Currency_Selector_Form_Processor'     => 'class-form-processor.php',
		'GFP_Currency_Selector_Converter'          => 'class-converter.php',
		'GFP_Currency_Selector_Helper'             => 'class-helper.php',
		'GFP_Currency_Selector_Integration_Stripe' => 'integrations/class-stripe.php',
		'GFP_Auto_Upgrader'                => 'class-auto-upgrader.php'
	);

	static function load() {
		spl_autoload_register( array( __CLASS__, '_autoloader' ) );
	}

	/**
	 * @param string $class_name
	 * @param string $class_filepath
	 *
	 * @return bool Return true if it was registered, false if not.
	 */
	static function register_autoload_class( $class_name, $class_filepath ) {

		if ( ! isset( self::$_autoload_classes[ $class_name ] ) ) {

			self::$_autoload_classes[ $class_name ] = $class_filepath;

			return true;

		}

		return false;

	}

	/**
	 * @param string $class_name
	 */
	static function _autoloader( $class_name ) {

		if ( isset( self::$_autoload_classes[ $class_name ] ) ) {

			$filepath = self::$_autoload_classes[ $class_name ];

			/**
			 * @todo This needs to be made to work for Windows...
			 */
			if ( '/' == $filepath[0] ) {

				require_once( $filepath );

			} else {

				require_once( dirname( __FILE__ ) . "/{$filepath}" );

			}

		}

	}
}