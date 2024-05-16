<?php

/**
 * Template Name: ISF Video library
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
global $wp_query;
$max_pages = $wp_query->max_num_pages;
get_header("home");
$post_id = 13897;

?>
<section class="section-padding header-padding section-padding-mobile">
    <div class="content section-adding-x col-12">
        <div class="fusion-row">
            <div class="row">
                <?php while (have_posts()) : ?>
                <?php
                    the_post();
                    get_template_part('/templates/isf/video-list');
                endwhile;
                wp_reset_postdata();
                echo fusion_pagination($max_pages, Avada()->settings->get('pagination_range'));
                ?>
            </div>
        </div>
    </div>
</section>
<?php

// story section
isf_remark_story_section($post_id, 'section-padding-top-mobile');

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
