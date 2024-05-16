<?php

/**
 * Header-v1 template.
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
<div class="fusion-header-sticky-height"></div>
<div class="fusion-header">
	<div class="fusion-row">
		<?php if ('flyout' === Avada()->settings->get('mobile_menu_design')) : ?>
			<div class="fusion-header-has-flyout-menu-content">
			<?php endif; ?>
			<div class="header-section-wraper d-flex justify-content-between align-items-center">
				<?php avada_logo(); ?>
				<?php avada_main_menu(); ?>
				<?php get_template_part('templates/menu-mobile-flyout'); ?>
				<?php custom_donation_menu(); ?>
				<?php avada_mobile_menu_search(); ?>
			</div>
			<?php if ('flyout' === Avada()->settings->get('mobile_menu_design')) : ?>
			</div>
		<?php endif; ?>

	</div>
	<div class="fusion-flyout-menu-bg"></div>
	<div>
		<?php
		display_mobile_menu();
		?>
	</div>
</div>