<?php

/**
 * Template Name: ISF Australia page
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
<section id="content" class="full-width col-12">
    <?php while (have_posts()) : ?>
        <?php
        the_post();
        $post_id = get_the_ID();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
</section>
<?php
how_we_work_section($post_id, '', '', 'header-padding');

// how we are run 
how_we_are_run_section_post($post_id);

// two columns
isf_two_columns_section($post_id, '');


// story section
isf_remark_story_section($post_id);

// contribution_section_post
isf_contribution_section($post_id);

// More about isf australia

isf_more_about_isf_australia($post_id);

//section_form_id
sfi_subscription_section($post_id, 'section-padding-top-mobile');

//secail_media_section_id
sfi_secail_media_section($post_id);

//Where our money goes
sfi_where_our_money_go_section($post_id);


get_footer(); ?>