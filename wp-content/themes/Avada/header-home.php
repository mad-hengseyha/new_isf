<?php

/**
 * Header template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<!DOCTYPE html>
<html class="<?php avada_the_html_class(); ?>" <?php language_attributes(); ?>>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php Avada()->head->the_viewport(); ?>
    <?php wp_head(); ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2X4WTW1MTM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-2X4WTW1MTM');
    </script>
</head>

<?php
$object_id      = get_queried_object_id();
$c_page_id      = Avada()->fusion_library->get_page_id();
$wrapper_class  = 'fusion-wrapper';
$wrapper_class .= (is_page_template('home.php')) ? ' wrapper_blank home-header' : ' default-home';
?>

<body <?php body_class(); ?> <?php fusion_element_attributes('body'); ?>>
    <?php do_action('avada_before_body_content'); ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'Avada'); ?></a>
    <div id="boxed-wrapper" class="home_header">
        <div id="wrapper" class="<?php echo esc_attr($wrapper_class); ?>">
            <?php if (has_action('avada_render_header')) : ?>
                <?php
                do_action('avada_render_header');
                ?>
            <?php else : ?>

                <?php avada_header_template('below', (is_archive() || Avada_Helper::bbp_is_topic_tag()) && !(class_exists('WooCommerce') && is_shop())); ?>
                <?php if ('left' === fusion_get_option('header_position') || 'right' === fusion_get_option('header_position')) : ?>
                    <?php avada_side_header(); ?>
                <?php endif; ?>

                <?php avada_sliders_container(); ?>

                <?php avada_header_template('above', (is_archive() || Avada_Helper::bbp_is_topic_tag()) && !(class_exists('WooCommerce') && is_shop())); ?>

            <?php endif; ?>

            <?php
            avada_current_page_title_bar($c_page_id);
            ?>

            <?php
            $row_css    = '';
            $main_class = '';

            if (apply_filters('fusion_is_hundred_percent_template', false, $c_page_id)) {
                $row_css    = 'max-width:100%;';
                $main_class = 'width-100';
            }

            if (fusion_get_option('content_bg_full') && 'no' !== fusion_get_option('content_bg_full')) {
                $main_class .= ' full-bg';
            }
            do_action('avada_before_main_container');
            ?>
            <main id="main" class="clearfix <?php echo esc_attr($main_class); ?>">
                <div class="row">