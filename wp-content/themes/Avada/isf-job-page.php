<?php

/**
 * Template Name: Jobs at ISF
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
<section id="content" class="full-width col-12">
    <?php while (have_posts()) : ?>
        <?php
        the_post();
        $post_id = get_the_ID();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post-content col-12">
                <?php
                the_content();
                ?>
            </div>
        </div>
    <?php
    endwhile;
    ?>
</section>
<?php
how_we_work_section($post_id, '', '', 'header-padding section-padding-mobile pb-40');

//Job Section
isf_job_section($post_id, 'section-padding-top-mobile section-padding-mobile pb-40 pt-40');

//Education Programme
isf_education_program_section($post_id, 'section-padding-top-mobile section-padding-mobile pt-40 pb-40');

// story section
isf_remark_story_section($post_id, 'section-padding-top-mobile pt-40');

// contribution_section_post
isf_contribution_section($post_id);

//section_form_id
sfi_subscription_section($post_id);

//secail_media_section_id
sfi_secail_media_section($post_id);

//Where our money goes
sfi_where_our_money_go_section($post_id);





//Various ways you can contribute
// isf_contribute_ways_section($post_id);

//partner ship section
// isf_partnership_section($post_id);

// // Our amazing fundraisers section
// isf_fundraisers_section($post_id);






// isf_sustainable_section($post_id);

// how we are run 
// how_we_are_run_section($post_id);

// Our impact and reach
// state_number_three_columns_section($post_id);

// how it start section
// isf_show_it_start_section($post_id);


// isf_education_program_impact_section($post_id);

// isf_two_columns_section($post_id, 'align-items-center mb-40');

//community_section_id
// isf_community_section($post_id);

//impact_section_id
// isf_impact_section($post_id);

//footbal_section_id
// isf_football_section($post_id);

// football_impage_section_id
// isf_football_impage_section($post_id);

// A child's journey at ISF Cambodia
// isf_four_columns_section($post_id);







get_footer();
