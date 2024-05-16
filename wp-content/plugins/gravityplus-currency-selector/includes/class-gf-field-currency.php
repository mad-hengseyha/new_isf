<?php
/*
 * @package   GFP_Currency_Selector\GF_Field_Currency
 * @copyright 2015-2021 gravity+
 * @license   GPL-2.0+
 * @since     1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class GF_Field_Currency
 *
 * Adds currency field to Gravity Forms
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GF_Field_Currency extends GF_Field {

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
	 * @since    1.0.0
	 *
	 * @author   Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var string
	 */
	private $field_type = '';

	/**
	 * @since    1.0.0
	 *
	 * @author   Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var string|void
	 */
	private $field_label = '';

	/**
	 * @since    1.0.0
	 *
	 * @author   Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @var string
	 */
	private $form_currency = '';

	public $type = 'currency';

	/**
	 * Initialize currency field settings
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

		parent::__construct();

		$this->field_type  = 'currency';
		$this->field_label = __( 'Currency', 'gravityplus-currency-selector' );

		add_action( 'init', array( $this, 'init' ) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function init() {

		add_action( 'admin_init', array( $this, 'admin_init' ) );

		add_action( 'wp_ajax_gfp_currency_selector_get_currency_values', array( $this, 'get_currency_values' ) );

		add_action( 'wp_ajax_nopriv_gfp_currency_selector_get_currency_values', array( $this, 'get_currency_values' ) );

		add_action( 'wp_ajax_gfp_currency_selector_get_currency', array( $this, 'get_currency' ) );

		add_action( 'wp_ajax_nopriv_gfp_currency_selector_get_currency', array( $this, 'get_currency' ) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function admin_init() {

		if ( 'gf_edit_forms' == GFForms::get( 'page' ) ) {

			add_action( 'gform_editor_js_set_default_values', array( $this, 'gform_editor_js_set_default_values' ) );

			add_action( 'gform_field_css_class', array( $this, 'gform_field_css_class' ), 10, 3 );

			add_action( 'gform_field_standard_settings', array( $this, 'gform_field_standard_settings' ), 10, 2 );

			add_action( 'gform_editor_js', array( $this, 'gform_editor_js' ) );

			wp_enqueue_style( 'gfp_form_editor_currency_css', trailingslashit( GFP_CURRENCY_SELECTOR_URL ) . 'includes/css/form_editor-currency.css', array(), GFP_CURRENCY_SELECTOR_CURRENT_VERSION );

			add_filter( 'gform_noconflict_styles', array( $this, 'gform_noconflict_styles' ) );

			add_filter( 'gform_noconflict_scripts', array( $this, 'gform_noconflict_scripts' ) );

		}

		add_filter( 'gform_tooltips', array( $this, 'gform_tooltips' ) );

	}

	/**
	 * @return string
	 */
	public function get_form_editor_field_title() {

		return esc_attr__( 'Currency', 'gravityplus-currency-selector' );

	}

	/**
	 * @return array
	 */
	public function get_form_editor_button() {

		return array(
			'group' => 'pricing_fields',
			'text'  => $this->get_form_editor_field_title(),
		);

	}

	/**
	 * @see parent
	 *
	 * @since 1.4.0
	 *
	 */
	public function get_form_editor_field_icon() {

		return GFP_CURRENCY_SELECTOR_URL . 'includes/images/gravity_forms_multi_currency.svg';

	}

	/**
	 * @return array
	 */
	public function get_form_editor_field_settings() {

		return array(
			'label_setting',
			'label_placement_setting',
			'currency_field_type_setting',
			'currency_checkbox_setting',
			'currency_initial_item_setting',
			'description_setting',
			'rules_setting',
			'placeholder_setting',
			'duplicate_setting',
			'admin_label_setting',
			'size_setting',
			'error_message_setting',
			'css_class_setting',
			'visibility_setting',
			'prepopulate_field_setting',
			'conditional_logic_field_setting'
		);

	}

	/**
	 * @return bool
	 */
	public function is_conditional_logic_supported() {

		return true;

	}

	/**
	 * Set default values
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function gform_editor_js_set_default_values() {

		$js = "case 'currency':
			field.label = '{$this->field_label}';
            field.inputs = null;
            field.choices = new Array();
            field.displayAllCurrencies = true;
            field.inputType = 'select';
            
            field = SetDefaultCurrencyChoices( field );
            
			break;";

		echo $js;
	}

	/**
	 * Add custom class
	 *
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $css_class
	 * @param $field
	 * @param $form
	 *
	 * @return string
	 */
	public function gform_field_css_class( $css_class, $field, $form ) {

		if ( $this->is_this_field_type( $field ) ) {

			$css_class .= " gfield_currency gfield_currency_{$form['id']}_{$field['id']}";

		}

		return $css_class;
	}

	/**
	 * @param array  $form
	 * @param string $value
	 * @param null   $entry
	 *
	 * @return string
	 */
	public function get_field_input( $form, $value = '', $entry = null ) {

		$field = $this;

		$form_id = $form['id'];

		$default_currency = ( ! empty( $form['currency'] ) ) ? $form['currency'] : GFCommon::get_currency();

		$field = $this->add_currencies_as_choices( $field, $value, $default_currency );

		if ( 1 == count( $field['choices'] ) && ! empty( $field['choices'][0]['value'] ) ) {

			$this->form_currency = $field['choices'][0]['value'];

		}

		$id = $field['id'];

		$field_id = ( IS_ADMIN || $form_id == 0 ) ? "input_{$id}" : "input_{$form_id}_{$id}";

		$class_suffix = GFForms::get( 'view' ) == 'entry' ? '_admin' : '';

		$class = rgar( $field, 'size' ) . $class_suffix;

		$disabled_text = ( IS_ADMIN && GFForms::get( 'view' ) != 'entry' ) ? "disabled='disabled'" : '';

		switch ( RGFormsModel::get_input_type( $field ) ) {

			case 'currency':

				if ( rgget( 'displayAllCurrencies', $field ) && ! IS_ADMIN ) {

					$selected = empty( $value ) ? $default_currency : $value;

					$args = array(
						'echo'     => 0,
						'selected' => $selected,
						'class'    => esc_attr( $class ) . ' gfield_currency gfield_select',
						'name'     => "input_{$id}"
					);

					if ( GFCommon::$tab_index > 0 ) {

						$args['tab_index'] = GFCommon::$tab_index ++;

					}


					$args['show_option_none'] = empty( $field['placeholder'] ) ? ' ' : $field['placeholder'];

					return "<div class='ginput_container'>" . GFP_Currency_Selector_Helper::dropdown_currencies( $args ) . '</div>';

				} else {

					$tabindex = GFCommon::get_tabindex();

					if ( is_array( rgar( $field, 'choices' ) ) ) {

						usort( $field['choices'], function( $a, $b ) { return strcmp($a['text'], $b['text']); } );

					}

					$choices = GFCommon::get_select_choices( $field, $value, false );


					if ( ! empty( $field['placeholder'] ) ) {

						$selected = empty( $value ) ? "selected='selected'" : '';

						$choices  = "<option value='-1' {$selected}>{$field['placeholder']}</option>" . $choices;

					}

					return sprintf( "<div class='ginput_container'><select name='input_%d' id='%s' class='%s gfield_currency gfield_select' {$tabindex} %s>%s</select></div>", $id, $field_id, esc_attr( $class ), $disabled_text, $choices );

				}

				break;

			case 'select' :

				$logic_event = $this->get_logic_event( $field, 'change' );

				$css_class = trim( esc_attr( $class ) . ' gfield_select' );

				$tabindex = GFCommon::get_tabindex();

				$choices = GFCommon::get_select_choices( $field, $value, false );


				if ( ! empty( $field['placeholder'] ) ) {

					$selected = empty( $value ) ? "selected='selected'" : '';

					$choices  = "<option value='-1' {$selected}>{$field['placeholder']}</option>" . $choices;

				}

				return sprintf( "<div class='ginput_container'><select name='input_%d' id='%s' $logic_event class='%s' $tabindex %s>%s</select></div>", $id, $field_id, $css_class, $disabled_text, $choices );

				break;

			case 'radio' :

				return sprintf( "<div class='ginput_container'><ul class='gfield_radio' id='%s'>%s</ul></div>", $field_id, GFCommon::get_radio_choices( $field, $value, $disabled_text ) );

				break;
		}

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $position
	 * @param $form_id
	 */
	public function gform_field_standard_settings( $position, $form_id ) {

		if ( 25 == $position ) {

			$form = RGFormsModel::get_form_meta( $form_id );

			$currency = ( ! empty( $form['currency'] ) ) ? $form['currency'] : GFCommon::get_currency();

			require_once( GFP_CURRENCY_SELECTOR_PATH . '/includes/views/field-setting-currency-settings.php' );

		}

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function gform_editor_js() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'gfp_form_editor_currency-field', GFP_CURRENCY_SELECTOR_URL . "/includes/js/form_editor-currency-field{$suffix}.js", array( 'gform_form_editor' ), GFP_CURRENCY_SELECTOR_CURRENT_VERSION );

		$this->set_initial_choices();

		$currency_field_vars = array(
			'select_currency_text'        => __( 'Select a currency', 'gravityplus-currency-selector' ),
			'multiple_fields_not_allowed' => __( 'Only one Currency field can be added to the form', 'gravityplus-currency-selector' ),
			'no_currencies_selected' => __('You must select at least one currency', 'gravityplus-currency-selector'),
			'choices' => $this->choices
		);

		wp_localize_script( 'gfp_form_editor_currency-field', 'currency_field_vars', $currency_field_vars );
	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $tooltips
	 *
	 * @return array
	 */
	public function gform_tooltips( $tooltips ) {

		$currency_field_tooltips = array(
			'form_field_currency'           => '<h6>' . __( 'Currency', 'gravityplus-currency-selector' ) . '</h6>' . __( 'Select the currency that will be used for the payments submitted by this form.', 'gravityplus-currency-selector' ),
			'form_field_currency_selection' => '<h6>' . __( 'Currency', 'gravityplus-currency-selector' ) . '</h6>' . __( 'Select which currencies are displayed. You can choose to display all of them or select individual ones.', 'gravityplus-currency-selector' ),
		);

		return array_merge( $tooltips, $currency_field_tooltips );
	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $noconflict_styles
	 *
	 * @return array
	 */
	public function gform_noconflict_styles( $noconflict_styles ) {

		return array_merge( $noconflict_styles, array( 'gfp_form_editor_currency_css' ) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $noconflict_scripts
	 *
	 * @return array
	 */
	public function gform_noconflict_scripts( $noconflict_scripts ) {

		return array_merge( $noconflict_scripts, array( 'gfp_form_editor_currency-field' ) );

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	public function get_currency_values() {

		$has_input_name = strtolower( rgpost( 'inputName' ) ) != 'false';

		$id = ! $has_input_name ? rgpost( 'objectType' ) . '_rule_value_' . rgpost( 'ruleIndex' ) : rgpost( 'inputName' );

		$selected = rgempty( 'selectedValue' ) ? 0 : rgpost( 'selectedValue' );

		$dropdown = GFP_Currency_Selector_Helper::dropdown_currencies( array(
			'class'    => 'gfield_rule_select gfield_rule_value_dropdown gfield_currency_dropdown',
			'id'       => $id,
			'name'     => $id,
			'selected' => $selected,
			'echo'     => false
		) );

		wp_send_json_success( $dropdown );

	}

	public function get_currency() {

		check_ajax_referer( 'gfp_currency_selector_get_currency', 'gfp_currency_selector_get_currency' );

		$currency_code = rgpost( 'currency' );

		GFP_Currency_Selector_Helper::include_rgcurrency();

		$currency = RGCurrency::get_currency( $currency_code );

		if ( ! empty( $currency ) && is_array( $currency ) ) {

			$currency['code'] = $currency_code;

			wp_send_json_success( $currency );

		} else {

			wp_send_json_error();

		}

	}

	private function set_initial_choices() {

		$default_currency = ( ! empty( $this->formId['currency'] ) ) ? $this->formId['currency'] : GFCommon::get_currency();

		$currencies = GFP_Currency_Selector_Helper::get_currencies();

		foreach ( $currencies as $currency ) {

			$selected = ( $default_currency == $currency );

			$choices[] = array( 'text' => $currency, 'value' => $currency, 'isSelected' => $selected );

		}

		if ( empty( $choices ) ) {

			$choices[] = array( 'text' => 'You must select at least one currency.', 'value' => '' );

		} else {

			usort( $choices, function( $a, $b ) { return strcmp($a['text'], $b['text']); } );

		}

		$this->choices = $choices;
	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $field
	 * @param $value
	 *
	 * @return mixed
	 */
	private function add_currencies_as_choices( $field, $value, $default_currency ) {

		$choices = $inputs = array();

		$is_post = isset( $_POST['gform_submit'] );


		$currencies = GFP_Currency_Selector_Helper::get_currencies();

		$display_all = rgar( $field, 'displayAllCurrencies' );

		if ( ! $display_all ) {

			foreach ( $field['choices'] as $field_choice_to_include ) {

				$included_currencies[] = $field_choice_to_include['value'];

			}

			$currencies = array_intersect( $currencies, $included_currencies );

		}


		foreach ( $currencies as $currency ) {

			if ( $display_all ) {

				$selected  = ( $value == $currency ) ||
				             ( empty( $value ) &&
				               $default_currency == $currency &&
				               RGFormsModel::get_input_type( $field ) == 'select' &&
				               ! $is_post /*&&
				               ! $has_placeholder*/ );
				$choices[] = array( 'text' => $currency, 'value' => $currency, 'isSelected' => $selected );

			} else {

				foreach ( $field['choices'] as $field_choice ) {

					if ( $field_choice['value'] == $currency ) {

						$choices[] = array( 'text' => $currency, 'value' => $currency );

						break;

					}

				}

			}

		}

		if ( empty( $choices ) ) {

			$choices[] = array( 'text' => 'You must select at least one currency.', 'value' => '' );

		}

		$field['choices'] = $choices;

		return $field;
	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $currencies
	 * @param $count
	 * @param $currency_rows
	 *
	 * @return string
	 */
	private function currency_rows( $currencies, $count, $currency_rows ) {

		$output = '';

		foreach ( $currencies as $currency ) {

			$output .= "
		        <tr valign='top'>
		            <th scope='row' class='check-column'>
		            <input type='checkbox' class='gfield_currency_checkbox' value='$currency' name='" . esc_attr( $currency ) . "' id='" . esc_attr( $currency ) . "'  onclick='SetSelectedCurrencies();' />
					<label for='" . esc_attr( $currency ) . "' >$currency</label>
					</th>
		        </tr>";

		}

		return $output;
	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $field
	 * @param $event
	 *
	 * @return string
	 */
	private function get_logic_event( $field, $event ) {

		if ( empty( $field["conditionalLogicFields"] ) || IS_ADMIN ) {

			return '';

		}

		switch ( $event ) {

			case 'keyup' :
				return "onchange='gf_apply_rules(" . $field["formId"] . "," . GFCommon::json_encode( $field["conditionalLogicFields"] ) . ");' onkeyup='clearTimeout(__gf_timeout_handle); __gf_timeout_handle = setTimeout(\"gf_apply_rules(" . $field["formId"] . "," . GFCommon::json_encode( $field["conditionalLogicFields"] ) . ")\", 300);'";

				break;

			case 'click' :

				return "onclick='gf_apply_rules(" . $field["formId"] . "," . GFCommon::json_encode( $field["conditionalLogicFields"] ) . ");'";

				break;

			case 'change' :

				return "onchange='gf_apply_rules(" . $field["formId"] . "," . GFCommon::json_encode( $field["conditionalLogicFields"] ) . ");'";

				break;

		}

	}

	/**
	 * @since     1.0.0
	 *
	 * @author    Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $field
	 *
	 * @return bool
	 */
	public function is_this_field_type( $field ) {

		return rgar( $field, 'type' ) == $this->field_type;

	}

}