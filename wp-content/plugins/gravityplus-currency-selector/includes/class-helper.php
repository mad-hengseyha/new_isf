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
 * Class GFP_Currency_Selector_Helper
 *
 * Generally useful helper functions used by multiple objects
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector_Helper {

	/**
	 * Include Gravity Forms currency file
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public static function include_rgcurrency() {

		if ( ! class_exists( 'RGCurrency' ) ) {

			require_once( GFCommon::get_base_path() . '/currency.php' );

		}

	}

	/**
	 * Get all currencies
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return array
	 */
	public static function get_currencies() {

		self::include_rgcurrency();

		$currencies = array_keys( RGCurrency::get_currencies() );

		if ( is_array( $currencies ) ) {

			usort( $currencies, function( $a, $b ) { return strcmp($a, $b); });

		}

		return $currencies;
	}

	/**
	 * Retrieve the currency object for the specified currency code.
	 *
	 * @since 1.0.0
	 *        
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *        
	 * @param string $currency_code
	 *
	 * @return RGCurrency
	 */
	public static function get_currency( $currency_code ) {
		 
		self::include_rgcurrency();

		return new RGCurrency( $currency_code );
	}

	/**
	 * Get all currency field options for a dropdown, typically used to fill the options a feed
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 * @param $selected_field
	 *
	 * @return string
	 */
	public static function get_currency_fields( $form, $selected_field ) {

		$str    = "<option value=''>" . __( 'Select a field', 'gravitypus-currency-selector' ) . '</option>';
		$fields = GFCommon::get_fields_by_type( $form, array( 'currency' ) );

		foreach ( $fields as $field ) {

			$field_id    = $field['id'];
			$field_label = RGFormsModel::get_label( $field );

			$selected = $field_id == $selected_field ? "selected='selected'" : "";
			$str .= "<option value='" . $field_id . "' " . $selected . ">" . $field_label . '</option>';

		}


		return $str;
	}

	/**
	 * Builds a dropdown list of currencies
	 *
	 * Adapted from wp_dropdown_categories()
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param string $args
	 *
	 * @return string
	 */
	public static function dropdown_currencies( $args = '' ) {

		$defaults = array(
			'show_option_all'  => '',
			'show_option_none' => '',
			'exclude'          => '',
			'echo'             => 1,
			'selected'         => 0,
			'name'             => '',
			'id'               => '',
			'class'            => '',
			'tab_index'        => 0
		);

		$build_options = wp_parse_args( $args, $defaults );

		extract( $build_options );

		$tab_index_attribute = '';

		if ( (int) $tab_index > 0 ) {

			$tab_index_attribute = " tabindex=\"$tab_index\"";

		}

		$currencies = GFP_Currency_Selector_Helper::get_currencies();

		$name  = esc_attr( $name );
		$class = esc_attr( $class );
		$id    = $id ? esc_attr( $id ) : $name;

		if ( ! empty( $currencies ) ) {

			$output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";

		} else {

			$output = '';

		}

		if ( empty( $currencies ) && ! empty( $show_option_none ) ) {

			$output .= "\t<option value='-1' selected='selected'>$show_option_none</option>\n";

		}

		if ( ! empty( $currencies ) ) {

			if ( ! empty( $show_option_all ) ) {

				$selected = ( '0' === strval( $build_options['selected'] ) ) ? " selected='selected'" : '';

				$output .= "\t<option value='0'$selected>$show_option_all</option>\n";

			}

			if ( ! empty( $show_option_none ) ) {

				$selected = ( '-1' === strval( $build_options['selected'] ) ) ? " selected='selected'" : '';

				$output .= "\t<option value='-1'$selected>$show_option_none</option>\n";

			}

			foreach ( $currencies as $currency ) {

				$output .= "\t<option value=\"" . $currency . "\"";

				if ( $currency == $args['selected'] ) {

					$output .= ' selected="selected"';

				}

				$output .= '>';
				$output .= $currency;
				$output .= "</option>\n";

			}

		}

		if ( ! empty( $currencies ) ) {

			$output .= "</select>\n";

		}

		if ( $echo ) {

			echo $output;

		}

		return $output;
	}

	/**
	 * Check if form has a currency field
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 *
	 * @return bool
	 */
	public static function has_currency_field( $form ) {

		$currency_fields = GFCommon::get_fields_by_type( $form, array( 'currency' ) );

		return ! empty( $currency_fields );
	}

	/**
	 * Get currency code from a currency symbol
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $symbol
	 *
	 * @return string
	 */
	public static function get_currency_from_symbol( $symbol ) {

		GFP_Currency_Selector_Helper::include_rgcurrency();

		$currency = '';

		$currencies = RGCurrency::get_currencies();

		foreach ( $currencies as $currency_code => $currency_info ) {

			if ( ( $currency_info['symbol_left'] == $symbol )
			     || ( $currency_info['symbol_right'] == $symbol )
			     || ( html_entity_decode( $currency_info['symbol_left'], ENT_QUOTES, 'UTF-8' ) == $symbol )
			     || ( html_entity_decode( $currency_info['symbol_right'], ENT_QUOTES, 'UTF-8' ) == $symbol )
			) {
				$currency = $currency_code;

				break;

			}

		}

		return $currency;
	}

	/**
	 * Get currency symbol from a text string
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public static function get_currency_symbol_from_text( $text ) {

		$text = strval( $text );

		$text = preg_replace( "/&.*?;/", "", $text );

		$array           = str_split( $text );
		$currency_symbol = '';

		foreach ( $array as $key => $char ) {

			if ( ( ' ' !== $char ) && ( ! ctype_digit( $char ) ) && ( ',' !== $char ) ) {

				if ( ( '.' !== $char ) || ( ( ! ctype_digit( $array[ $key - 1 ] ) ) && ( ! ctype_digit( $array[ $key + 1 ] ) ) ) ) {

					$currency_symbol .= $char;

				}


			}
		}

		return $currency_symbol;
	}

	/**
	 * Get the currency field ID from a form object
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 *
	 * @return int
	 */
	public static function get_currency_field_id_from_form( $form ) {

		$currency_field_id = 0;
		$currency_fields   = GFCommon::get_fields_by_type( $form, array( 'currency' ) );

		if ( ! empty( $currency_fields ) ) {

			$currency_field_id = $currency_fields[0]['id'];

		}

		return $currency_field_id;
	}

	/**
	 * Detect user-defined product field
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 * @param $field_id
	 *
	 * @return bool
	 */
	public static function is_user_defined_product_field( $form, $field_id ) {

		$is_user_defined_product_field = false;

		$field = RGFormsModel::get_field( $form, $field_id );

		if ( 'price' == $field->inputType ) {

			$is_user_defined_product_field = true;

		}

		return $is_user_defined_product_field;
	}

	/**
	 * Detect hidden product field
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 * @param $field_id
	 *
	 * @return bool
	 */
	public static function is_hidden_product_field( $form, $field_id ) {

		$is_hidden_product_field = false;

		$field = RGFormsModel::get_field( $form, $field_id );

		if ( 'hiddenproduct' == $field->inputType ) {

			$is_hidden_product_field = true;


		}


		return $is_hidden_product_field;
	}

	/**
	 * @since 1.0.0
	 *
	 * @param $form_id
	 *
	 * @return string
	 */
	public static function get_form_currency( $form_id ) {

		$form_currency = '';

		$form = RGFormsModel::get_form_meta( $form_id );

		if ( ! empty( $form['currency'] ) ) {

			$form_currency = trim( strtoupper( $form['currency'] ) );

		}

		return $form_currency;
	}

	/**
	 * Does this site have minimum version of Gravity Forms to run this plugin
	 * 
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param string $min_gf_version
	 *
	 * @return bool
	 */
	public static function is_gravityforms_supported( $min_gf_version ) {

		$is_correct_version = false;

		if ( class_exists( 'GFCommon' ) ) {

			$is_correct_version = version_compare( GFCommon::$version, $min_gf_version, '>=' );

		}

		return $is_correct_version;
	}

}