<?php

/**
 * Template Name: ISF page
 *
 *
 * @package Avada
 * @subpackage Templates
 */

?>

<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<?php
get_header("home");
$post_id = "";
?>
<section id="content" class=""></section>
<section class="section-padding header-padding">
    <div class="content section-adding-x">
        <div class="fusion-row">
            <?php while (have_posts()) : ?>
                <?php
                the_post();
                $post_id = get_the_ID();
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php avada_singular_featured_image(); ?>
                    <div class="post-content col-12">
                        <?php
                        isf_hero_section($post_id);
                        the_content();
                        ?>
                    </div>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    </div>
</section>
<?php
do_action("isf_custome_template_section", $post_id);
get_footer(); ?>