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
 * Class GFP_Currency_Selector_Form_Processor
 *
 * Handles processing the form
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector_Form_Processor {

	private $default_form_currency = '';

	private $submitted_form_currency = '';

	private $converted_fields = array();
	
	private $product_field_submissions_reset = false;

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

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function init() {

		add_filter( 'gform_currency', array( $this, 'gform_currency' ), 11 );

		add_filter( 'gform_field_validation', array( $this, 'gform_field_validation' ), 9, 4 );

		add_filter( 'gform_validation', array( $this, 'gform_validation' ) );
		
		add_filter( 'gform_save_field_value', array( $this, 'gform_save_field_value' ), 10, 5 );
		
		add_filter( 'gform_currency_pre_save_entry', array( $this, 'gform_currency_pre_save_entry' ), 10, 2 );

	}

	/**
	 * Get currency
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $currency
	 *
	 * @return string
	 */
	public function gform_currency( $currency ) {

		$trace = debug_backtrace();

		$check_for_form_currency = false;

		$trace_location = ( version_compare( PHP_VERSION, '7.0', '>=' ) ) ? 3 : 4;

		if ( 'js.php' === basename( $trace[$trace_location]['file'] ) ) {

			$check_for_form_currency = true;
			$form_id                 = rgget( 'id' );

		} else {

			$trace_location = ( version_compare( PHP_VERSION, '7.0', '>=' ) ) ? 4 : 5;

			switch ( $trace[$trace_location]['function'] ) {

				case 'gf_global':

					$check_for_form_currency = true;
					$form_id                 = IS_ADMIN ? rgget( 'id' ) : $trace[$trace_location]['args'][0]['id'];

					if ( empty( $form_id ) && in_array( $trace[$trace_location+1]['function'], array( 'enqueue_form_scripts', 'print_form_scripts', 'get_form_enqueue_assets' ) ) ) {

						$form_id = $trace[$trace_location+1]['args'][0]['id'];

					}

					break;

				case 'gf_vars':

					$check_for_form_currency = true;
					$form_id                 = rgget( 'id' );

					break;

				case 'get_number_formats_script':

					$check_for_form_currency = true;
					$form_id                 = $trace[$trace_location]['args'][0]['id'];

					break;

			}

			if ( ! $check_for_form_currency ) {

				$trace_location = ( version_compare( PHP_VERSION, '7.0', '>=' ) ) ? 5 : 6;

				if ( array_key_exists( $trace_location, $trace ) ) {

					switch ( $trace[$trace_location]['function'] ) {

						case 'sanitize_settings':

							if ( 'GF_Field_HiddenProduct' == $trace[$trace_location]['class'] ) {

								$check_for_form_currency = true;

								$form_id                 = rgget( 'id' );

							}

							break;

						case 'sanitize_settings_choices':

							if ( 'GF_Field' == $trace[$trace_location]['class'] ) {

								$check_for_form_currency = true;

								$form_id                 = rgget( 'id' );

							}

							break;

						case 'get_field_input':

							$check_for_form_currency = true;
							$form_id                 = IS_ADMIN ? rgget( 'id' ) : $trace[$trace_location]['args'][0]['id'];

							break;

						case 'get_select_choices':

							$check_for_form_currency = true;
							$form_id                 = IS_ADMIN ? rgget( 'id' ) : $trace[$trace_location]['args'][0]['formId'];

							break;

						case 'get_radio_choices':
						case 'get_checkbox_choices':

							$check_for_form_currency = true;
							$form_id                 = IS_ADMIN ? rgget( 'id' ) : $trace[$trace_location]['args'][2];

							break;

						case 'get_state':

							$check_for_form_currency = true;
							$form_id                 = IS_ADMIN ? rgget( 'id' ) : $trace[$trace_location]['args'][0]['id'];

							break;

						case 'get_product_fields':

							if ( ! empty( $this->submitted_form_currency ) ) {

								$currency = $this->submitted_form_currency;

							} else {

								$check_for_form_currency = true;
								$form_id                 = IS_ADMIN ? rgget( 'id' ) : $trace[$trace_location]['args'][0]['id'];

							}

							break;
						/**
						 * this needs to be the form currency & not chosen currency, because state is based on field as it is saved in the editor
						 */
						case 'failed_state_validation':

							$check_for_form_currency = true;
							$form_id                 = $trace[$trace_location]['args'][0];

							break;
						/**
						 * GF_Field_Price::validate()
						 *
						 * Don't need to check for submitted form currency here because it's just checking to make sure price isn't false or negative & not returning any value
						 */
						case 'validate':

							$check_for_form_currency = true;
							$form_id                 = $trace[$trace_location]['args'][1]['id'];

							break;

						/**
						 * prepare_value saved to lead, should be saved in converted value
						 */
						case 'prepare_value'://if GF_Field_Calculation, this should be submitted currency because value gets saved as money after calculation in get_value_save_entry

							if ( 'GF_Field_Calculation' == $trace[$trace_location - 1]['class'] && 'get_value_save_entry' == $trace[$trace_location-1]['function'] && ! empty( $this->submitted_form_currency ) ) {

								$currency = $this->submitted_form_currency;

							} else {

							$check_for_form_currency = true;
							$form_id                 = $trace[$trace_location]['args'][0]['id'];

							}

							break;
						/**
						 * used in sending notifications & get_calculation_value
						 *
						 * no longer necessary as of GF 2.1
						 *
						 */
						case 'get_submitted_pricing_fields':

							if ( ! empty( $this->submitted_form_currency ) ) {

								$currency = $this->submitted_form_currency;

							}
							else if ( ! empty( $trace[$trace_location]['args'][1]['currency'] )) {
								
								$currency = $trace[$trace_location]['args'][1]['currency'];
								
							}
							else {

								$check_for_form_currency = true;
								$form_id                 = $trace[$trace_location]['args'][0]['id'];

							}

							break;

						/**
						 * used for product fields that have choices, in conditional logic filter choices. Extremely messy.
						 * e.g. where ___ is $choice['value'] .= '|' . $price; outputting entry list table. this has to be form currency because submitted currency is only for an entry. if form currency, base prices are changed to form currency
						 * TODO
						 */
						case 'get_field_filter_settings':

								$check_for_form_currency = true;
								$form_id                 = $trace[$trace_location]['args'][0]['id'];


							break;

						case 'get_calculation_value':

							$form_id = $trace[$trace_location]['args'][1]['id'];

							$field = RGFormsModel::get_field( RGFormsModel::get_form_meta( $form_id ), $trace[$trace_location]['args'][0] );

							if ( ! empty( $this->submitted_form_currency ) ) {

								$currency = $this->submitted_form_currency;

							} else {

								$check_for_form_currency = true;

							}

							break;

						case 'get_total':

							if ( 'get_order_total' == $trace[$trace_location+1]['function'] ) {

								if ( ! empty( $this->submitted_form_currency ) ) {

									$currency = $this->submitted_form_currency;

								}
								else if ( ! empty( $trace[$trace_location+1]['args'][1]['currency'] )) {

									$currency = $trace[$trace_location+1]['args'][1]['currency'];

								}
								else {

									$check_for_form_currency = true;
									$form_id                 = $trace[$trace_location+1]['args'][0]['id'];

								}

							} else if ( 'gform_product_info' == $trace[$trace_location+1]['function'] ) {

								if ( ! empty( $this->submitted_form_currency ) ) {

									$currency = $this->submitted_form_currency;

								}
								else if ( ! empty( $trace[$trace_location+1]['args'][2]['currency'] )) {

									$currency = $trace[$trace_location+1]['args'][2]['currency'];

								} else {

									$check_for_form_currency = true;
									$form_id                 = $trace[$trace_location+1]['args'][1]['id'];

								}

							}

							break;

						case 'get_value_merge_tag':

							if ( 'GF_Field_Total' == $trace[$trace_location]['class'] ) {

								$currency = $trace[$trace_location]['args'][2]['currency'];

							}

							break;

						case 'lead_detail_grid':

							$currency = $trace[$trace_location]['args'][1]['currency'];

							break;

					}

				}

			}

		}

		if ( $check_for_form_currency && ! empty( $form_id ) ) {

			$form_currency = $this->get_default_form_currency( $form_id );

			if ( ! empty( $form_currency ) && $currency !== $form_currency ) {

				$currency = $form_currency;

			}

		}

		return $currency;
	}

	/**
	 * Try to validate hidden product fields and reset all product fields if one does not validate
	 *
	 * This needs to happen before other validation, so that they don't wrongly abort
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @see       GFFormDisplay::failed_state_validation
	 *
	 * @param $validation_result
	 * @param $value
	 * @param $form
	 * @param $field
	 *
	 * @return array
	 */
	public function gform_field_validation( $validation_result, $value, $form, $field ) {

		global $_gf_state;


		$is_valid = $validation_result['is_valid'];

		if ( $field->allowsPrepopulate ) {

			return $validation_result;

		}

		if ( GFP_Currency_Selector_Helper::has_currency_field( $form ) && ! $is_valid && GFCommon::is_product_field( $field->type ) ) {

			if ( 'hiddenproduct' == $field->inputType && isset( $_gf_state ) ) {

				$is_valid = $this->validate_hidden_product( $value, $form, $field );

				$validation_result['is_valid'] = $is_valid;

				if ( ! $is_valid ) {

					$validation_result['message'] = __( 'Please enter a valid value.', 'gravityforms' );

				}

			}

		}

		return $validation_result;
	}

	public function gform_validation( $validation_result ) {

		if ( GFP_Currency_Selector_Helper::has_currency_field( $validation_result['form'] ) && ! $validation_result['is_valid'] && ! $this->product_field_submissions_reset ) {

				$this->reset_product_field_values( $validation_result['form'] );

		}


		return $validation_result;
	}

	/**
	 * Convert hidden product back to form currency and recheck state validation
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $value
	 * @param $form
	 * @param $field
	 *
	 * @return bool
	 */
	private function validate_hidden_product( $value, $form, $field ) {

		global $_gf_state;

		if ( ! is_array( $value ) ) {

			$value = array( $field->id => $value );

		}

		foreach ( $value as $key => $input_value ) {

			$state = isset( $_gf_state[ $key ] ) ? $_gf_state[ $key ] : false;

			if ( $key == $field->id . '.2' ) {

				$input_value = GFCommon::to_number( $input_value, $this->get_submitted_currency( $form ) );

				$input_value = $this->convert_back_to_form_currency_value( $input_value, $form );

			}
			

			$adjustment_value = $this->get_adjustment_value( $form );
			
			if ( $this->fails_hash( $input_value, $state ) && $this->fails_hash( $input_value - $adjustment_value, $state ) && $this->fails_hash( $input_value + $adjustment_value, $state ) ) {

				$is_valid = false;

				break;

			}

			$is_valid = true;

		}


		return $is_valid;

	}

	private function fails_hash( $input_value, $state ) {

		$fail = false;

		$sanitized_input_value = wp_kses( $input_value, wp_kses_allowed_html( 'post' ) );

		$hash           = wp_hash( $input_value );
		$sanitized_hash = wp_hash( $sanitized_input_value );

		$fails_hash           = strlen( $input_value ) > 0 && $state !== false && ( ( is_array( $state ) && ! in_array( $hash, $state ) ) || ( ! is_array( $state ) && $hash != $state ) );
		$fails_sanitized_hash = strlen( $sanitized_input_value ) > 0 && $state !== false && ( ( is_array( $state ) && ! in_array( $sanitized_hash, $state ) ) || ( ! is_array( $state ) && $sanitized_hash != $state ) );

		if ( $fails_hash && $fails_sanitized_hash ) {

			$fail = true;
		}


		return $fail;
	}
	
	private function get_adjustment_value( $form ) {

		$adjustment_value = 0;
		
		$default_form_currency = ( ! empty( $form['currency'] ) ) ? $form['currency'] : GFCommon::get_currency();

		$form_currency_object = GFP_Currency_Selector_Helper::get_currency( $default_form_currency );

		$adjustment_value = ($form_currency_object->is_zero_decimal() ) ? 1 : 0.01;
		
		
		return $adjustment_value;
	}

	/**
	 * Empty submitted product field values
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 */
	private function reset_product_field_values( $form ) {

		$product_fields = GFCommon::get_fields_by_type( $form, array( 'option', /*'quantity',*/ 'product', 'total', 'shipping', 'calculation', 'price' ) );

		foreach ( $product_fields as $product_field ) {

			if ( 'hiddenproduct' == $product_field->inputType ) {

				continue;

			}
			else if ( 'checkbox' == $product_field->inputType ) {

				$number_of_choices = count( $product_field->inputs );

				for ( $i=1;$i<=$number_of_choices;$i++) {

					$choice = "input_{$product_field->id}_{$i}";

					if ( isset( $_POST[$choice] ) ) {

						$_POST[$choice] = '';

					}
				}

			}
			else if ( is_array( $product_field->inputs ) ) {

				$_POST[ 'input_' . $product_field->id . '_2' ] = '';

			}
			else {

				$_POST[ 'input_' . $product_field->id ] = '';

			}

		}
		
		$this->product_field_submissions_reset = true;

	}

	/**
	 * Convert calculation field value to submitted currency, if needed
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param string    $value
	 * @param string    $input_id   ID of current field in the calculation formula
	 * @param string    $match
	 * @param GF_Field  $field      calculation field object
	 * @param array     $form
	 * @param array     $lead
	 *
	 * @return mixed
	 */
	public function gform_merge_tag_value_pre_calculation( $value, $input_id, $match, $field, $form, $lead ) {

		if ( ! empty( $value ) && $this->field_needs_to_be_converted( $form, RGFormsModel::get_field( $form, $input_id ), $input_id, $lead ) ) {

			$value = $this->convert_to_submitted_currency( $value, $form );

		}


		return $value;

	}

	/**
	 * Convert product field value (not hidden or user-defined) to converted value before saving to DB
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $value
	 * @param $lead
	 * @param $field
	 * @param $form
	 * @param $input_id
	 *
	 * @return mixed
	 */
	public function gform_save_field_value( $value, $lead, $field, $form, $input_id ) {

		if ( ! empty( $value ) && $this->field_needs_to_be_converted( $form, $field, $input_id, $lead ) ) {

			$value = $this->convert_to_submitted_currency( $value, $form );

			$trace = debug_backtrace();

			$trace_location = ( version_compare( PHP_VERSION, '7.0', '>=' ) ) ? 7 : 7;

			if ( 'GFFormDisplay' == $trace[$trace_location]['class'] && 'handle_submission' == $trace[$trace_location]['function']) {

				$this->converted_fields[] = $field->id;

			}

		}

		return $value;
	}

	/**
	 * Convert submitted products to submitted currency
	 *
	 * Called in
	 * - GFCommon::get_order_total, only used during a form submission when saving a lead
	 * - GFCommon::get_submitted_pricing_fields, used in sending notifications & get_calculation_value which is only used
	 * when saving a lead
	 * - GFCommon::replace_field_variable, used in sending notifications at any time &
	 * get_calculation_value which is only used when saving a lead
	 * - GFEntryDetail::lead_detail_grid, anytime
	 *
	 * TODO only needed before lead is saved? Afterwards, lead values are in the correct currency?
	 * TODO test this for sending notification & lead_detail_grid
	 *
	 * @see       GFCommon::get_product_fields
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $product_info
	 * @param $form
	 * @param $lead
	 *
	 * @return mixed
	 */
	public function gform_product_info( $product_info, $form, $lead ) {

		global $gravityplus_currency_selector;


		if ( GFP_Currency_Selector_Helper::has_currency_field( $form ) && empty( $this->converted_fields ) ) {

			$submitted_currency = $this->get_submitted_currency( $form, $lead );

			if ( ! empty( $submitted_currency ) ) {

				GFP_Currency_Selector_Helper::include_rgcurrency();

				$default_form_currency = ( ! empty( $form['currency'] ) ) ? $form['currency'] : GFCommon::get_currency();

				if ( $default_form_currency !== $submitted_currency ) {

					foreach ( $product_info['products'] as $field_id => $product ) {

						if ( GFP_Currency_Selector_Helper::is_user_defined_product_field( $form, $field_id ) || GFP_Currency_Selector_Helper::is_hidden_product_field( $form, $field_id ) ) {

							$price = GFCommon::to_number( $product['price'], $submitted_currency );

						} else {

							$price = GFCommon::to_number( $product['price'], $default_form_currency );

							$price = $gravityplus_currency_selector->get_converter()->convert( $price, $default_form_currency, $submitted_currency );

						}

						if ( isset( $product['options'] ) && is_array( $product['options'] ) ) {

							foreach ( $product['options'] as $option_id => $option ) {

								$product_info['products'][ $field_id ]['options'][ $option_id ]['price'] = $gravityplus_currency_selector->get_converter()->convert( $option['price'], $default_form_currency, $submitted_currency );

							}

						}

						$product_info['products'][ $field_id ]['price'] = GFCommon::to_money( $price, $submitted_currency );

					}

					if ( ! empty( $product_info['shipping']['name'] ) ) {

						$product_info['shipping']['price'] = $gravityplus_currency_selector->get_converter()->convert( $product_info['shipping']['price'], $default_form_currency, $submitted_currency );

					}

				}

			}

		}

		return $product_info;
	}

	/**
	 * Save correct currency to entry
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $currency
	 * @param $form
	 *
	 * @return string
	 */
	public function gform_currency_pre_save_entry( $currency, $form ) {


		if ( empty( $this->submitted_form_currency ) ) {

			$this->get_submitted_currency( $form );

		}

		if ( ! empty( $this->submitted_form_currency ) ) {

			$currency = $this->submitted_form_currency;

		} else {

			if ( empty( $this->default_form_currency ) ) {

				$this->get_default_form_currency( $form['id'] );

			}

			if ( ! empty( $this->default_form_currency ) && $currency !== $this->default_form_currency ) {

				$currency = $this->default_form_currency;

			}

		}


		return $currency;

	}

	/**
	 * Get the currency that was submitted for the form
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 * @param $lead
	 *
	 * @return string
	 */
	public function get_submitted_currency( $form, $lead = array() ) {

		if ( empty( $this->submitted_form_currency ) ) {

			$currency_field_id = GFP_Currency_Selector_Helper::get_currency_field_id_from_form( $form );

			if ( ! empty( $currency_field_id ) ) {

				$currency_field = RGFormsModel::get_field( $form, $currency_field_id );

				$currency_field_value = empty( $lead ) ? RGFormsModel::get_field_value( $currency_field ) : RGFormsModel::get_lead_field_value( $lead, $currency_field );

				$this->submitted_form_currency = trim( strtoupper( $currency_field_value ) );

			}

		}

		return $this->submitted_form_currency;
	}

	/**
	 * Get the default form currency
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form_id
	 *
	 * @return string
	 */
	public function get_default_form_currency( $form_id ) {

		if ( empty( $this->default_form_currency ) ) {

			$this->default_form_currency = GFP_Currency_Selector_Helper::get_form_currency( $form_id );

		}

		if ( empty( $this->default_form_currency ) ) {

			$this->default_form_currency = GFCommon::get_currency();

		}

		return $this->default_form_currency;
	}

	/**
	 * Does field need to be converted
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param           $form
	 * @param GF_Field  $field
	 * @param           $input_id
	 * @param array     $lead
	 *
	 * @return bool
	 */
	private function field_needs_to_be_converted( $form, $field, $input_id, $lead = array() ) {

		$field_needs_to_be_converted = false;

		if ( ! in_array( $field->id, $this->converted_fields )
		     && GFP_Currency_Selector_Helper::has_currency_field( $form )
		     && GFCommon::is_product_field( $field->type )
		     && ! in_array( $field->type, array('quantity' ) )
		     && ! in_array( $field->get_input_type(), array('quantity', 'calculation', 'total', 'hiddenproduct', 'price' ) )
		     && (
		     ( false === strpos( $input_id, '.' ) )
		        || ( $input_id == $field->id . '.2' )
		        || ( 'option' == $field->type && 'checkbox' == $field->get_input_type() )
		     ) ) {

			$submitted_currency = $this->get_submitted_currency( $form, $lead );

			if ( ! empty( $submitted_currency ) ) {

				GFP_Currency_Selector_Helper::include_rgcurrency();

				$default_form_currency = ( ! empty( $form['currency'] ) ) ? $form['currency'] : GFCommon::get_currency();

				if ( $default_form_currency !== $submitted_currency ) {

					$field_needs_to_be_converted = true;

				}

			}

		}


		return $field_needs_to_be_converted;
	}

	/**
	 * Convert value to submitted currency
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $value
	 * @param $form
	 *
	 * @return float
	 */
	private function convert_to_submitted_currency( $value, $form ) {

		global $gravityplus_currency_selector;

		if ( false !== strpos( $value, '|' ) ) {

			list( $name, $price ) = explode( '|', $value );

		} else {

			$price = $value;

		}

		$value = GFCommon::to_number( $price, $this->get_default_form_currency( $form['id'] ) );

		if ( ! $value || ! is_numeric( $value ) ) {

			$value = 0;

		} else {

			$value = round( $gravityplus_currency_selector->get_converter()->convert( $value, $this->get_default_form_currency( $form['id'] ), $this->get_submitted_currency( $form ) ), 2 );

		}

		if ( ! empty( $name ) ) {

			$value = "{$name}|{$value}";

		}

		return $value;

	}

	/**
	 * Convert a product field value back to the form currency value after it's been converted to the currency field
	 * value
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $currency_field_value
	 * @param $form
	 *
	 * @return float
	 */
	private function convert_back_to_form_currency_value( $currency_field_value, $form ) {

		global $gravityplus_currency_selector;

		$form_currency_value = $currency_field_value;

		$submitted_currency = $this->get_submitted_currency( $form );

		if ( ! empty( $submitted_currency ) ) {

			GFP_Currency_Selector_Helper::include_rgcurrency();

			$default_form_currency = ( ! empty( $form['currency'] ) ) ? $form['currency'] : GFCommon::get_currency();

			if ( $default_form_currency !== $submitted_currency ) {

				$form_currency_value = round( $gravityplus_currency_selector->get_converter()->convert( $currency_field_value, $submitted_currency, $default_form_currency ), 2 );

			}

		}

		return $form_currency_value;
	}

}