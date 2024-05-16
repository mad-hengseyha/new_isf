<?php
/*
 * @package   GFP_Currency_Selector\GFP_Currency_Selector_Addon
 * @copyright 2015-2021 gravity+
 * @license   GPL-2.0+
 * @since     1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Class GFP_Currency_Selector_Addon
 *
 * Adds a plugin settings page and form settings fields
 *
 * @since  1.0.0
 *
 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
 */
class GFP_Currency_Selector_Addon extends GFAddOn {

	/**
	 * @var string Version number of the Add-On
	 */
	protected $_version;

	/**
	 * @var string Gravity Forms minimum version requirement
	 */
	protected $_min_gravityforms_version;

	/**
	 * @var string URL-friendly identifier used for form settings, add-on settings, text domain localization...
	 */
	protected $_slug;

	/**
	 * @var string Relative path to the plugin from the plugins folder
	 */
	protected $_path;

	/**
	 * @var string Full path to the plugin. Example: __FILE__
	 */
	protected $_full_path;

	/**
	 * @var string URL to the App website.
	 */
	protected $_url;

	/**
	 * @var string Title of the plugin to be used on the settings page, form settings and plugins page.
	 */
	protected $_title;

	/**
	 * @var string Short version of the plugin title to be used on menus and other places where a less verbose string is useful.
	 */
	protected $_short_title;

	/**
	 * @var array Members plugin integration. List of capabilities to add to roles.
	 */
	protected $_capabilities = array();

	// ------------ Permissions -----------
	/**
	 * @var string|array A string or an array of capabilities or roles that have access to the settings page
	 */
	protected $_capabilities_settings_page = array();

	/**
	 * @var string|array A string or an array of capabilities or roles that have access to the form settings
	 */
	protected $_capabilities_form_settings = array();

	/**
	 * @var string|array A string or an array of capabilities or roles that can uninstall the plugin
	 */
	protected $_capabilities_uninstall = array();

	// ------------ Auto-Upgrades -----------
	/**
	 * @var GFP_Auto_Upgrader
	 *
	 * @since  1.1.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 */
	protected $_auto_upgrader;

	/**
	 * Add-On instance
	 *
	 * @since 1.1.0
	 *
	 * @var GFP_Currency_Selector_Addon
	 */
	private static $_instance = null;

	/**
	 * @see    parent
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $args
	 */
	function __construct( $args ) {

		$this->_version                    = $args[ 'version' ];
		$this->_slug                       = $args[ 'plugin_slug' ];
		$this->_min_gravityforms_version   = $args[ 'min_gf_version' ];
		$this->_path                       = $args[ 'path' ];
		$this->_full_path                  = $args[ 'full_path' ];
		$this->_url                        = $args[ 'url' ];
		$this->_title                      = $args[ 'title' ];
		$this->_short_title                = $args[ 'short_title' ];
		$this->_capabilities               = $args[ 'capabilities' ];
		$this->_capabilities_settings_page = $args[ 'capabilities_settings_page' ];
		$this->_capabilities_form_settings = $args[ 'capabilities_form_settings' ];
		$this->_capabilities_uninstall     = $args[ 'capabilities_uninstall' ];


		$is_gravityforms_supported = $this->is_gravityforms_supported( $this->_min_gravityforms_version );

		$license_key = trim( $this->get_plugin_setting( 'license_key' ) );

		$early_access = ( '1' == $this->get_plugin_setting( 'early_access' ) ) ? true : false;


		$this->_auto_upgrader = new GFP_Auto_Upgrader( $this->_slug,
			$this->_version,
			$this->_min_gravityforms_version,
			$this->_title,
			$this->_full_path,
			$this->_path,
			'https://gravityplus.pro/',
			$this->_url,
			$is_gravityforms_supported,
			array( 'license' => md5( $license_key ),
				'early_access' => $early_access ) );


		parent::__construct();

	}

	/**
	 * Needed for GF Add-On Framework functions
	 *
	 * @since 1.1.0
	 *
	 * @return GFP_Currency_Selector_Addon|null
	 */
	public static function get_instance(){

		if ( self::$_instance == null ) {

			self::$_instance = new self(
				array(
					'version'                    => GFP_CURRENCY_SELECTOR_CURRENT_VERSION,
					'min_gf_version'             => '2.5.0',
					'plugin_slug'                => GFP_CURRENCY_SELECTOR_SLUG,
					'path'                       => plugin_basename( GFP_CURRENCY_SELECTOR_FILE),
					'full_path'                  => GFP_CURRENCY_SELECTOR_FILE,
					'title'                      => 'Gravity Forms Currency Selector',
					'short_title'                => 'Currency Selector',
					'url'                        => 'https://gravityplus.pro/gravity-forms-currency-selector',
					'capabilities'               => array(
						'gravityplus-currency-selector_plugin_settings',
						'gravityplus-currency-selector_form_settings',
						'gravityplus-currency-selector_uninstall'
					),
					'capabilities_settings_page' => array( 'gravityplus-currency-selector_plugin_settings' ),
					'capabilities_form_settings' => array( 'gravityplus-currency-selector_form_settings' ),
					'capabilities_uninstall'     => array( 'gravityplus-currency-selector_uninstall' )
				) );

		}

		return self::$_instance;

	}

	/**
	 * @since 1.4.0
	 */
	public function init(){

		parent::init();

		add_filter( 'gform_toolbar_menu', array( $this, 'gform_toolbar_menu' ), 10, 2 );

	}

	/**
	 * @since 1.4.0
	 *
	 * @return array|array[]
	 */
	public function styles() {

		$styles = array(
			array(
				'handle'  => 'gfp_currency_selector_style',
				'src'     => GFP_CURRENCY_SELECTOR_URL . 'includes/css/style.css',
				'version' => $this->_version,
				'enqueue' => array(
					array(
						'admin_page' => array( 'form_editor', 'form_settings', 'confirmation', 'notification_edit', 'notification_list', 'entry_list', 'entry_detail' ),
					),
				)
			),
		);

		return array_merge( parent::styles(), $styles );
	}

	/**
	 * @since 1.4.0
	 *
	 * @return false|string
	 */
	public function get_menu_icon(){

		return file_get_contents( GFP_CURRENCY_SELECTOR_PATH . 'includes/images/gravity_forms_multi_currency.svg' );

	}

	/**
	 * @since 1.4.0
	 *
	 * @param $menu_items
	 * @param $form_id
	 *
	 * @return mixed
	 */
	public function gform_toolbar_menu ( $menu_items, $form_id ) {

		foreach ( $menu_items['settings']['sub_menu_items'] as  &$menu ) {

			if( $menu['label'] === $this->get_short_title() ) {

				$menu['menu_class'] = 'gfp_currency_selector__menu_li';
				$menu['link_class'] = 'gfp_currency_selector__menu_a';

			}

		}

		return $menu_items;

	}

	/**
	 * @see    parent
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return array
	 */
	public function plugin_settings_fields() {

		$settings_fields = array();

		$settings_fields[ ] = array(
			'title'       => __( 'Updates and Support', 'gravityplus-currency-selector' ),
			'description' => sprintf( __( 'Enter your license key to receive updates and support for this plugin. If you don\'t have one, you can get one %shere%s.', 'gravityplus-currency-selector' ), '<a href="https://gravityplus.pro/gravity-forms-multi-currency-selector/">', '</a>' ),
			'fields'      => array(
				array(
					'name'                => 'license_key',
					'label'               => __( 'License Key', 'gravityplus-currency-selector' ),
					'type'                => 'text',
					'save_callback'       => array( $this, 'save_license_key' ),
					'feedback_callback' => array( $this, 'check_license_key' ),
				),
				array(
					'label'   => __( 'Get early access to new versions', 'gravityplus-currency-selector' ),
					'type'    => 'checkbox',
					'name'    => 'early_access_checkbox',
					'choices' => array(
						array(
							'name'          => 'early_access',
							'label'         => '',
							'default_value' => 1,
						)
					)
				)
			)
		);

		$settings_fields[ ] = array(
			'title'       => __( 'Open Exchange Rates API', 'gravityplus-currency-selector' ),
			'description' => sprintf( __( 'This connects your Open Exchange Rates account to provide automatic, real-time currency conversion. If you don\'t already have an Open Exchange Rates account, create a %sfree account%s.', 'gravityplus-currency-selector' ), '<a href="https://openexchangerates.org/signup/free">', '</a>' ),
			'fields'      => array(
				array(
					'name'                => 'app_id',
					'tooltip'             => sprintf( __( 'Enter your app ID found in your %saccount dashboard%s', 'gravityplus-currency-selector' ), '<a href="https://openexchangerates.org/account">', '</a>' ),
					'label'               => __( 'App ID', 'gravityplus-currency-selector' ),
					'type'                => 'text',
					'validation_callback' => array( $this, 'validate_app_id' ),
				)
			)
		);

		return $settings_fields;
	}

	/**
	 * Save license key
	 *
	 * @since  1.1.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $field
	 * @param $field_setting
	 *
	 * @return string
	 */
	public function save_license_key( $field, $field_setting ) {

		if ( ! empty( $field_setting ) ) {

			$field_setting = trim( $field_setting );

		}


		return $field_setting;
	}

	/**
	 * Check license key
	 *
	 * @since  1.1.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $license_key
	 * @param $field
	 *
	 * @return bool
	 */
	public function check_license_key( $license_key, $field ) {

		if ( empty( $license_key ) ) {

			return false;

		} else {

			$version_info = $this->_auto_upgrader->get_version_info( $this->_slug, md5( trim($license_key) ), $this->_version, ( '1' == $this->get_plugin_setting( 'early_access' ) ) ? true : false, false );


			return ( isset( $version_info[ 'is_valid_key' ] ) ? $version_info['is_valid_key'] : false );

		}

	}

	/**
	 * Validate Open Exchange Rates App ID
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $field
	 * @param $field_setting
	 */
	public function validate_app_id( $field, $field_setting ) {

		global $gravityplus_currency_selector;


		if ( ! empty( $field_setting ) ) {

			$current_rates = $gravityplus_currency_selector->get_converter()->get_current_rates( $field_setting );

			if ( empty( $current_rates ) ) {

				$this->set_field_error( $field, __( 'No response from Open Exchange Rates. Please try again.', 'gravityplus-currency-selector' ) );

			} else if ( ! empty( $current_rates[ 'error' ] ) ) {

				$this->set_field_error( $field, "{$current_rates['message']} {$current_rates['description']}" );

			}

		} else if ( empty( $field_setting ) ) {

			$this->set_field_error( $field, __( 'Please enter your Open Exchange Rates App ID', 'gravityplus-currency-selector' ) );

		}

	}

	//TODO some kind of note to let them know if they haven't put in their App ID
	
	
	/**
	 * @see    parent
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return array
	 */
	public function form_settings_fields( $form ) {

		return array(

			array(
				'title'  => 'Currency Settings',
				'fields' => array(
					array(
						'label'         => 'Form Currency',
						'type'          => 'select',
						'name'          => 'currency',
						'tooltip'       => 'Select the currency that will be used for this form. If no currency is selected, the Gravity Forms default currency will be used.',
						'choices'       => $this->get_currency_choices()
					)
				)
			)
		);
	}

	/**
	 * Get currency choices for form settings field
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @return array
	 */
	private function get_currency_choices() {

		$currency_choices = array();

		$currencies = GFP_Currency_Selector_Helper::get_currencies();

		$currency_choices[ ] = array(
			'label' => __( 'Select a Currency', 'gravityplus-currency-selector' ),
			'value' => ''
		);

		foreach ( $currencies as $currency ) {

			$currency_choices[ ] = array( 'label' => $currency, 'name' => $currency );

		}

		return $currency_choices;
	}

	/**
	 * @see    parent
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param array $form
	 * @param array $settings
	 *
	 * @return bool
	 */
	public function save_form_settings( $form, $settings ) {

		$new_currency     = $settings[ 'currency' ];
		
		$has_old_currency = ! empty( $form[ 'currency' ] );

		$updated_form = $form;

		if ( ! empty( $new_currency ) ) {

			if ( $has_old_currency && ( $form[ 'currency' ] !== $new_currency ) ) {

				$updated_form = $this->convert_field_base_prices( $form, $form[ 'currency' ], $new_currency );

			} else if ( ! $has_old_currency ) {

				$updated_form = $this->convert_field_base_prices( $form, GFCommon::get_currency(), $new_currency );

			}

		}

		$updated_form[ $this->_slug ] = $settings;

		$updated_form[ 'currency' ] = $new_currency;

		$result = GFFormsModel::update_form_meta( $form[ 'id' ], $updated_form );

		return ! ( false === $result );
	}

	/**
	 * Convert field base prices to another currency
	 *
	 * @since  1.0.0
	 *
	 * @author Naomi C. Bush for gravity+ <support@gravityplus.pro>
	 *
	 * @param $form
	 * @param $from_currency
	 * @param $to_currency
	 *
	 * @return mixed
	 */
	private function convert_field_base_prices( $form, $from_currency, $to_currency ) {

		global $gravityplus_currency_selector;


		$convert_base_price    = false;
		$convert_option_prices = false;

		foreach ( $form[ 'fields' ] as $field_key => &$field ) {

			if ( 'product' == $field[ 'type' ] || 'shipping' == $field[ 'type' ] ) {

				if ( ! empty( $field[ 'basePrice' ] ) ) {

					$convert_base_price = true;

				}

				if ( ! empty( $field[ 'choices' ] ) ) {

					$convert_option_prices = true;

				}

			} else if ( 'option' == $field[ 'type' ] ) {

				if ( ! empty( $field[ 'choices' ] ) ) {

					$convert_option_prices = true;

				}

			}

			if ( $convert_base_price ) {

				$basePrice = GFCommon::to_number( $field[ 'basePrice' ], $from_currency );
				$basePrice = $gravityplus_currency_selector->get_converter()->convert( $basePrice, $from_currency, $to_currency );

				$field[ 'basePrice' ] = GFCommon::to_money( $basePrice, $to_currency );

				$convert_base_price = false;

			}

			if ( $convert_option_prices ) {

				foreach ( $field->choices as $choice_key => $choice ) {

					if ( ! empty( $choice[ 'price' ] ) ) {

						$choice_price = GFCommon::to_number( $choice[ 'price' ], $from_currency );
						$choice_price = $gravityplus_currency_selector->get_converter()->convert( $choice_price, $from_currency, $to_currency );

						$field->choices[ $choice_key ][ 'price' ] = GFCommon::to_money( $choice_price, $to_currency );

					}

				}

				$convert_option_prices = false;

			}

		}

		return $form;
	}

	/**
	 * @since 1.4.0
	 */
	public function render_uninstall() {

		do_action( "gform_{$this->_slug}_render_uninstall", $this );

		echo "<span class='render-{$this->_slug}-uninstall'>";

		parent::render_uninstall();

		echo "</span>";

		echo "<script>

				jQuery(document).ready(function(){

					jQuery('span.render-{$this->_slug}-uninstall div.alert.error').addClass('inline');
					
				})
				
			</script>";

	}



}