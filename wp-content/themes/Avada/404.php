<?php

/**
 * Template Name: ISF page
 *
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
?>
<?php
get_header("home");
$post_id = "";
?>
<section id="content" class="full-width col-12 section-padding">
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
<?php
// do_action("isf_custome_template_section", $post_id);
get_footer(); ?>