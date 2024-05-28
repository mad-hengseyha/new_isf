<?php

/**
 * Extra files & functions are hooked here.
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Avada
 * @subpackage Core
 * @since 1.0
 */

require __DIR__ . '/new_isf/functioins.php';

// function add_file_types_to_uploads($file_types)
// {
// 	$new_filetypes = array();
// 	$new_filetypes['svg'] = 'image/svg+xml';
// 	$file_types = array_merge($file_types, $new_filetypes);
// 	return $file_types;
// }
// add_filter('upload_mimes', 'add_file_types_to_uploads');

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}

if (!defined('AVADA_VERSION')) {
	define('AVADA_VERSION', '7.5');
}

if (!defined('AVADA_MIN_PHP_VER_REQUIRED')) {
	define('AVADA_MIN_PHP_VER_REQUIRED', '5.6');
}

if (!defined('AVADA_MIN_WP_VER_REQUIRED')) {
	define('AVADA_MIN_WP_VER_REQUIRED', '4.9');
}

// Developer mode.
if (!defined('AVADA_DEV_MODE')) {
	define('AVADA_DEV_MODE', false);
}

/**
 * Compatibility check.
 *
 * Check that the site meets the minimum requirements for the theme before proceeding.
 *
 * @since 6.0
 */
if (version_compare($GLOBALS['wp_version'], AVADA_MIN_WP_VER_REQUIRED, '<') || version_compare(PHP_VERSION, AVADA_MIN_PHP_VER_REQUIRED, '<')) {
	require_once get_template_directory() . '/includes/bootstrap-compat.php';
	return;
}

/**
 * Bootstrap the theme.
 *
 * @since 6.0
 */
require_once get_template_directory() . '/includes/bootstrap.php';

/* Omit closing PHP tag to avoid "Headers already sent" issues. */

//update_option( 'siteurl', 'https://isf.workwithmad.com' );
//update_option( 'home', 'https://isf.workwithmad.com' );

// MAD
if (!function_exists("mad_theme_styles")) {
	function mad_theme_styles()
	{
		// wp_register_style('style', get_template_directory_uri() . '/style.css', array(), null, 'all');
		// wp_enqueue_style('style');

		wp_register_style('isf-branding', get_template_directory_uri() . '/assets/css/isf/isf.css', array(), null, 'all');
		wp_enqueue_style('isf-branding');

		wp_register_style('isf-media-screen', get_template_directory_uri() . '/assets/css/isf/isf-media-screen.css', array(), null, 'all');
		wp_enqueue_style('isf-media-screen');

		wp_register_style('aos-animation', get_template_directory_uri() . '/assets/css/isf/aos.css', array(), null, 'all');
		wp_enqueue_style('aos-animation');

		wp_register_style('isf-mega-menu', get_template_directory_uri() . '/assets/css/isf/menu.css', array(), null, 'all');
		wp_enqueue_style('isf-mega-menu');

		wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/isf/bootstrap.min.css', array(), null, 'all');
		wp_enqueue_style('bootstrap');

		wp_register_style('slide-gallery', get_template_directory_uri() . '/assets/css/isf/slider.css', array(), null, 'all');
		wp_enqueue_style('slide-gallery');

		wp_register_style(
			'owl-carousel',
			get_template_directory_uri() . '/assets/css/isf/owl.carousel.min.css',
			array(),
			null,
			'all'
		);
		wp_enqueue_style('owl-carousel');

		wp_register_style(
			'owl-theme-default',
			get_template_directory_uri() . '/assets/css/isf/owl.theme.default.min.css',
			array(),
			null,
			'all'
		);
		wp_enqueue_style('owl-theme-default');

		wp_register_script(
			'bootstrap_js',
			get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
			array(),
			'1.0.0',
			true
		);
		wp_enqueue_script('bootstrap_js');

		wp_register_script(
			'aos-animation',
			get_template_directory_uri() . '/assets/js/aos.js',
			array(),
			'1.0.0',
			true
		);
		wp_enqueue_script('aos-animation');

		wp_register_script(
			'isf-js',
			get_template_directory_uri() . '/assets/js/isf.js',
			array(),
			'1.0.0',
			array(
				'strategy'  => 'defer',
			)
		);
		wp_enqueue_script('isf-js');

		wp_register_script(
			'isf-slide',
			get_template_directory_uri() . '/assets/js/slide.js',
			array(),
			'1.0.0',
			array(
				'strategy'  => 'defer',
			)
		);
		wp_enqueue_script('isf-slide');

		wp_register_script(
			'custom-vimeo',
			'https://player.vimeo.com/api/player.js',
			// get_template_directory_uri() . '/assets/js/player.js',
			array(),
			'1.0.0',
			array(
				'strategy'  => 'defer',
			)
		);

		wp_register_script(
			'isf-gsap',
			get_template_directory_uri() . '/assets/js/gsap.min.js',
			array(),
			'1.0.0',
			array(
				'strategy'  => 'defer',
			)
		);

		wp_enqueue_script('isf-gsap');

		wp_register_script(
			'isf-carousel',
			get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
			array(),
			'1.0.0',
			array(
				'strategy'  => 'defer',
			)
		);

		wp_enqueue_script('isf-carousel');

		wp_register_script(
			'isf-ScrollTrigger',
			get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js',
			array(),
			'1.0.0',
			array(
				'strategy'  => 'defer',
			)
		);
		wp_enqueue_script('isf-ScrollTrigger');

		wp_enqueue_script('custom-vimeo');
	}
}

add_action('wp_enqueue_scripts', 'mad_theme_styles');


add_action("gform_after_submission", "get_unique", 10, 2);
add_filter("gform_field_value_uuid", "get_unique");
function get_unique($entry, $form)
{
	// $gender = $entry["2"]; // Update Field ID of Gender Field
	// $year = $entry["3"]; // Update Field ID of Year of Registration Field
	// $prefix = "$gender$year"; // update the prefix here
	// do {
	// 	$unique = mt_rand();
	// 	$unique = substr($unique, 0, 5); // I changed this to 5 for your random 5 digits
	// 	$unique = $prefix . $unique;
	// } while (!check_unique($unique));
	// return $unique;
}
function check_unique($unique)
{
	global $wpdb;
	$table = $wpdb->prefix . 'rg_lead_detail';
	$form_id = 3; // update to the form ID your unique id field belongs to
	$field_id = 7; // update to the field ID your unique id is being prepopulated in
	$result = $wpdb->get_var("SELECT value FROM $table WHERE form_id = '$form_id' AND field_number = '$field_id' AND value = '$unique'");
	if (empty($result))
		return true;
	return false;
}

add_filter('http_request_args', 'http_request_args_basic_auth', 10, 2);
function http_request_args_basic_auth($args, $url)
{
	if (strpos($url, admin_url('admin-ajax.php')) === 0) {
		$args['headers']['Authorization'] = 'Basic ' . base64_encode('isfcambodiadev:isf@123');
	}

	return $args;
}

// add_filter('gform_currencies', function ($currencies) {
// 	$currencies['EUR'] = array(
// 		'name'               => esc_html__('Euro', 'gravityforms'),
// 		'symbol_left'        => '&#8364;',
// 		'symbol_right'       => '',
// 		'symbol_padding'     => ' ',
// 		'thousand_separator' => '.',
// 		'decimal_separator'  => ',',
// 		'decimals'           => 2,
// 	);
// 	return $currencies;
// });


// 2. Add existing taxonomies to post type
register_taxonomy('job_session', ['isf_job'], [
	'label' => __('Job Session', 'txtdomain'),
	'hierarchical' => true,
	'rewrite' => ['slug' => 'isf-job'],
	'show_admin_column' => true,
	'show_in_rest' => true,
	'labels' => [
		'singular_name' => __('Job', 'txtdomain'),
		'all_items' => __('All Jobs', 'txtdomain'),
		'edit_item' => __('Edit Job', 'txtdomain'),
		'view_item' => __('View Job', 'txtdomain'),
		'update_item' => __('Update Job', 'txtdomain'),
		'add_new_item' => __('Add New Job', 'txtdomain'),
		'new_item_name' => __('New Job Name', 'txtdomain'),
		'search_items' => __('Search Jobs', 'txtdomain'),
		'parent_item' => __('Parent Job', 'txtdomain'),
		'parent_item_colon' => __('Parent Job:', 'txtdomain'),
		'not_found' => __('No Jobs found', 'txtdomain'),
	]
]);
register_taxonomy_for_object_type('job_session', 'isf_job');

// 2. Add existing taxonomies to post type
register_taxonomy('people-category', ['people'], [
	'label' => __('Category', 'txtdomain'),
	'hierarchical' => true,
	'rewrite' => ['slug' => 'people-category'],
	'show_admin_column' => true,
	'show_in_rest' => true,
	'labels' => [
		'singular_name' => __('Category', 'txtdomain'),
		'all_items' => __('All Categories', 'txtdomain'),
		'edit_item' => __('Edit Category', 'txtdomain'),
		'view_item' => __('View Category', 'txtdomain'),
		'update_item' => __('Update Category', 'txtdomain'),
		'add_new_item' => __('Add New Category', 'txtdomain'),
		'new_item_name' => __('New Category Name', 'txtdomain'),
		'search_items' => __('Search Categories', 'txtdomain'),
		'parent_item' => __('Parent Category', 'txtdomain'),
		'parent_item_colon' => __('Parent Category:', 'txtdomain'),
		'not_found' => __('No Categorys found', 'txtdomain'),
	]
]);
register_taxonomy_for_object_type('people-category', 'people');


// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'fix_svg');
