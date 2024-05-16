<?php
$parrams = $args['parrams'];
$wrapper = 'people-max-height';
?>
<div class="col-lg-3 col-md-12 col-sm-12 mb-40" data-aos="fade-up">
    <div class="profile-photo row">
        <div class="col-12 photo">
            <?php
            echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius'));
            ?>
        </div>
    </div>
    <h3 class="mb-10 mt-20 team-header">
        <?php
        echo get_the_title(get_the_ID());
        ?>
    </h3>
    <?php
    echo '<h4 class="mb-10">' . get_field('people_position', get_the_ID()) . ' </h4>';

    // the_excerpt();
    ?>
    <div class="more mb-20 <?php echo $wrapper; ?> post_id_<?php echo get_the_ID(); ?>">
        <?php the_content(); ?>
        <?php
        if (get_field('people_linkedin_url', get_the_ID())) {
        ?>
            <div class="col-12 d-flex linkedin-profile">
                <div class="linkedin-icon">
                    <img src="<?php echo get_field('people_linkedin_icon', get_the_ID()); ?> " />
                </div>
                <div class="linkedin-name">
                    <a target="_blank" class="" href="<?php echo get_field('people_linkedin_url', get_the_ID()); ?>"> <?php echo get_field('people_linkedin_name', get_the_ID()); ?></a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="d-flex justify-content-start">
        <div class="isf-link-wraper">
            <a class="isf-link isf-people-link" data-class="post_id_<?php echo get_the_ID(); ?>" href="<?php //echo the_permalink(); 
                                                                                                        ?>">
                <div class="slide-in-bottom">
                    <div class="learn_more" data-hover="Learn more">
                        Learn more
                    </div>
                    <div class=" custom-styles w-embed"></div>
                </div>
            </a>
        </div>
    </div>

</div>