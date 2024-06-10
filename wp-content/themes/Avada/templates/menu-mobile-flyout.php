<?php

/**
 * Mobile flyout menu template.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       https://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
?>
<div class="fusion-flyout-menu-icons fusion-flyout-mobile-menu-icons">
	<?php echo avada_flyout_menu_woo_cart(); // phpcs:ignore WordPress.Security.EscapeOutput 
	?>

	<?php if ('menu' === Avada()->settings->get('slidingbar_toggle_style') && Avada()->settings->get('mobile_slidingbar_widgets')) : ?>
		<?php $sliding_bar_label = esc_attr__('Toggle Sliding Bar', 'Avada'); ?>
		<div class="fusion-flyout-sliding-bar-toggle">
			<a href="#" class="fusion-toggle-icon fusion-icon fusion-icon-sliding-bar" aria-label="<?php echo esc_attr($sliding_bar_label); ?>"></a>
		</div>
	<?php endif; ?>
	<?php
	// donation button menu
	wp_nav_menu(
		array(
			'theme_location' => 'do_nation_menu',
			'menu_class' => 'mega-menu max-mega-menu mega-menu-horizontal d-block d-sm-none',
			'container' => 'donation-menu-button',
			'container_class' => '',
		)
	);
	?>
	<?php if (Avada()->settings->get('mobile_menu_search')) : ?>
		<?php
		$dblock = '';
		if (!is_home() || !is_front_page()) {
			$dblock = 'd-block';
		}
		?>
		<div class="fusion-flyout-search-toggle <?php echo $dblock; ?>">
			<!-- awb-icon-search -->
			<?php
			if (is_home() || is_front_page()) {
			?>
				<a class="search-icon-wrapper-close d-none" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Search', 'Avada'); ?>" href="#">
					<img class="close-search-icon search" src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu_close.svg'; ?>" />
				</a>
				<a class="search-icon-wrapper d-none searchbox" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Search', 'Avada'); ?>" href="#">
					<img class="search-icon search" src="<?php echo get_template_directory_uri() . '/assets/images/carbon_search.svg'; ?>" />
				</a>
			<?php
			} else {
			?>
				<a class="not-home-search-icon-wrapper-close d-none" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Search', 'Avada'); ?>" href="#">
					<img class="close-search-icon search" src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu_close.svg'; ?>" />
				</a>
				<a class="not-home-search-icon-wrapper d-none searchbox " aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Search', 'Avada'); ?>" href="#">
					<img class="search-icon search" src="<?php echo get_template_directory_uri() . '/assets/images/carbon_search.svg'; ?>" />
				</a>
			<?php
			}
			?>
		</div>
	<?php endif; ?>

	<?php
	// Make sure mobile menu toggle is not loaded when ubermenu is used. 
	?>
	<?php if (!function_exists('ubermenu_get_menu_instance_by_theme_location') || (function_exists('ubermenu_get_menu_instance_by_theme_location'))) : ?>
		<!-- menu iocon -->
		<?php
		$white_none = '';
		$blue_none = "";
		if (is_home() || is_front_page()) {
			$blue_none = "d-none";
		} else {
			$white_none = "d-none";
		}
		?>
		<?php
		if (is_home() || is_front_page()) {
		?>
			<a class="fusion-flyout-menu-toggle burger-menu-wrap-white <?php echo $white_none; ?>" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Menu', 'Avada'); ?>" href="#">
				<img class="menu-icon burger-menu white " src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu_white.svg'; ?>" />
			</a>
			<a class="fusion-flyout-menu-toggle burger-menu-wrap-close d-none" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Menu', 'Avada'); ?>" href="#">
				<img class="close-icon" src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu_close.svg'; ?>" />
			</a>
			<a class="fusion-flyout-menu-toggle burger-menu-wrap-blue <?php echo $blue_none; ?>" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Menu', 'Avada'); ?>" href="#">
				<img class="menu-icon burger-menu blue " src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu.svg'; ?>" />
			</a>
		<?php
		} else {
		?>
			<a class="fusion-flyout-menu-toggle not-home-burger-menu-wrap-close d-none" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Menu', 'Avada'); ?>" href="#">
				<img class="close-icon" src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu_close.svg'; ?>" />
			</a>
			<a class="fusion-flyout-menu-toggle not-home-burger-menu-wrap-blue <?php echo $blue_none; ?>" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Menu', 'Avada'); ?>" href="#">
				<img class="menu-icon burger-menu blue " src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu.svg'; ?>" />
			</a>
			<a class="fusion-flyout-menu-toggle not-home-burger-menu-wrap-blue-search d-none <?php echo $blue_none; ?>" aria-hidden="true" aria-label="<?php esc_attr_e('Toggle Menu', 'Avada'); ?>" href="#">
				<img class="menu-icon burger-menu blue " src="<?php echo get_template_directory_uri() . '/assets/images/carbon_menu.svg'; ?>" />
			</a>
		<?php
		}
		?>
	<?php endif; ?>
</div>

<?php if (Avada()->settings->get('mobile_menu_search')) : ?>
	<div class="fusion-flyout-search">
		<?php get_search_form(); ?>
	</div>
<?php endif; ?>
<?php

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
