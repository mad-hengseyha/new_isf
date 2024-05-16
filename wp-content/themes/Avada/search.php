<?php

/**
 * Template for search results.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
get_header("home");
?>
<section id="content" <?php Avada()->layout->add_class('content_class'); ?> <?php Avada()->layout->add_style('content_style'); ?>>
	<section id="content" class="full-width section-padding header-padding section-padding-top-mobile section-padding-mobile">
		<div class="content section-adding-x">
			<div class="fusion-row">
				<h1>Search Results</h1>
			</div>
		</div>
	</section>
	<?php if (have_posts() && 0 !== strlen(trim(get_search_query()))) : ?>
		<section id="content" class="full-width col-12 section-padding section-padding-top-mobile section-padding-mobile">
			<div id="post">
				<div class="content section-adding-x">
					<div class="fusion-row">
						<?php if ('hidden' !== Avada()->settings->get('search_new_search_position')) : ?>
							<div class="search-page-search-form">
								<?php
								echo '<div class="mb-40">';
								echo '<h2 class="search-results"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
								echo '</div>';
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

	<?php else : ?>
		<section id="content" class="full-width col-12 section-padding section-padding-top-mobile section-padding-mobile">
			<div id="post">
				<div class="content section-adding-x">
					<div class="fusion-row">
						<div class="row text-center">
							<div class="error-message">404</div>
							<h4 class="mt-5">Sorry, Nothing found!</h4>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<section id="content" class="full-width col-12 section-padding section-padding-top-mobile section-padding-mobile">
		<div id="post">
			<div class="content section-adding-x">
				<div class="fusion-row">
					<?php
					echo avada_render_post_title(0, false, esc_html__('Need a new search?', 'Avada'), $title_size); // phpcs:ignore WordPress.Security.EscapeOutput
					?>
					<p>
						<?php esc_html_e('If you didn\'t find what you were looking for, try a new search!', 'Avada'); ?>
					</p>
					<?php
					get_search_form();
					?>
				</div>
			</div>
		</div>
	</section>
</section>
<?php get_footer(); ?>