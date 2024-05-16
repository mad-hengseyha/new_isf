<?php
get_header("home");
$post_id = '';

// Render Related Posts. 
?>
<section class="section-padding">
    <div class="content section-adding-x col-12">
        <div class="fusion-row">
            <?php while (have_posts()) : ?>
                <?php
                the_post();
                $post_id = get_the_ID();
                ?>
                <article class="single-story m-auto" id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                    <div class="post-date">
                        <?php echo get_the_date('d F Y', get_the_ID()); ?>
                    </div>
                    <div class="description">
                        <?php
                        the_author_meta('description');
                        // do_action('avada_blog_post_content');
                        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius mb-40'));
                        echo the_content();
                        social_media_sharing_action(get_the_ID());
                        ?>
                    </div>
                </article>
            <?php
                wp_reset_postdata();
            endwhile;
            ?>
        </div>
    </div>
</section>
<?php

read_more_story(get_the_ID());

$post_id = 13897;
isf_video_sectioni_list($post_id, $bg = 'no');

// contribution_section_post
isf_contribution_section($post_id);

//section_form_id
sfi_subscription_section($post_id);

//secail_media_section_id
sfi_secail_media_section($post_id);

//Where our money goes
sfi_where_our_money_go_section($post_id);
get_footer();
?>