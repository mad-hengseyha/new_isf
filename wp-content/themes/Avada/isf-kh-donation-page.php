<?php

/**
 * Template Name: ISF KH donation page
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
<section id="content" class="full-width col-12 md-margin-top">
    <?php
    while (have_posts()) :
    ?>
        <?php
        the_post();
        $post_id = get_the_ID();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <?php
                    avada_singular_featured_image(); ?>
                    <div class="post-content col-12">
                        <div class="w-778 m-auto text-center">
                            <?php
                            the_content();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
    ?>
</section>
<?php
// do_action("isf_custome_template_section", $post_id);
get_footer(); ?>