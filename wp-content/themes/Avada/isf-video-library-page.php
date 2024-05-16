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
    wp_reset_postdata();
    ?>

</section>
<section class="section-padding header-padding section-padding-mobile">
    <div class="content section-adding-x col-12">
        <div class="fusion-row">
            <div class="row">
                <?php
                $args = array(
                    'posts_per_page' =>  4,
                    'post_type' => 'post', //video-library
                    'post_status' => 'publish',
                );

                $posts = new WP_Query($args);
                // var_dump($posts->found_posts);
                $max_pages = $posts->found_posts;
                if ($posts->have_posts()) {
                    while ($posts->have_posts()) : $posts->the_post();
                        get_template_part('/templates/isf/video-list');
                    endwhile;
                    wp_reset_postdata();
                }
                ?>
            </div>

            <?php
            echo fusion_pagination($max_pages, Avada()->settings->get('pagination_range'));


            ?>

        </div>
</section>

<?php
// how_we_work_section($post_id, '', 'header-section');

// story section
// isf_story_section_list($post_id);

// isf_video_sectioni_list($post_id);

// isf_two_columns_section($post_id, '');

//football pitch schedule
// isf_football_shedule_section($post_id);

//Book ISF Sports Ground
// isf_book_sports_ground_section($post_id);

// map_section
// isf_map_section($post_id);

//Job Section
// isf_job_section($post_id);

//Education Programme
// isf_education_program_section($post_id);

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
