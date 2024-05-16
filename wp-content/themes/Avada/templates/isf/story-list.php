<?php
?>
<div class="col-md-4 col-sm-12 mb-40" data-aos="fade-up">
    <a class="feature-image" href="<?php echo the_permalink(); ?>">
        <div class="story-image-wrapper">
            <?php
            echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius story-image'));
            ?>
        </div>
    </a>
    <h3 class="mt-20">
        <?php
        echo get_the_title(get_the_ID());
        ?>
    </h3>
    <?php
    echo '<h4 class="title-and-p-padding">' . get_field('people_position', get_the_ID()) . ' </h4>';
    // the_excerpt();
    do_action('avada_blog_post_content');
    ?>
    <div class="d-flex justify-content-between">
        <div class="isf-link-wraper">
            <a class="isf-link" href="<?php echo the_permalink(); ?>">
                <div class="slide-in-bottom">
                    <div class="" data-hover="Read the Story">
                        Read the Story
                    </div>
                    <div class=" custom-styles w-embed"></div>
                </div>
            </a>
        </div>
        <div class="post-date">
            <?php echo get_the_date('d F Y', get_the_ID()); ?>
        </div>
    </div>
</div>