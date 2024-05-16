<?php
$parrams = $args['parrams'];
$col = $parrams['col'];
if ($col % 2) {
?>
    <div class="col-md-6 col-sm-12 p-0" data-aos="fade-up">
        <?php
        // Give the Post Thumbnail a class "alignleft".
        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius'));
        ?>
    </div>

    <div class="col-md-6 p-0 col-sm-12  meduim-mt-20 d-flex justify-content-end" data-aos="fade-left">
        <div class="ml-78">
            <h3>
                <?php
                echo get_the_title();
                ?>
            </h3>
            <?php
            echo '<div class="post-date d-none d-sm-block">' . get_the_date('d F Y', get_the_ID()) . ' </div>';
            the_excerpt();
            ?>
            <div class="d-flex justify-content-between">
                <div class="m-40 mb-0 isf-link-wraper">
                    <a class="isf-link" href="<?php echo the_permalink(); ?>">
                        <div class="slide-in-bottom">
                            <div class="" data-hover="Read the story">
                                Read the story
                            </div>
                            <div class=" custom-styles w-embed"></div>
                        </div>
                    </a>
                </div>
                <?php
                echo '<div class="post-date m-40 mb-0 d-block d-sm-none">' . get_the_date('d F Y', get_the_ID()) . ' </div>';
                ?>
            </div>
        </div>
    </div>

<?php
} else {
?>
    <div class="col-md-6 col-sm-12 p-0 d-block d-sm-none meduim-show" data-aos="fade-up">
        <?php
        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius'));
        ?>
    </div>
    <div class="col-md-6 col-sm-12  meduim-mt-20 p-0" data-aos="fade-right">
        <div class="mr-78">
            <h3>
                <?php
                echo get_the_title();
                ?>
            </h3>
            <?php
            echo '<div class="post-date d-none d-sm-block">' . get_the_date('d F Y', get_the_ID()) . ' </div>';
            the_excerpt();
            ?>
            <div class="d-flex justify-content-between">
                <div class="m-40 mb-0 isf-link-wraper">
                    <a class="isf-link" href="<?php echo the_permalink(); ?>">
                        <div class="slide-in-bottom">
                            <div class="" data-hover="Read the story">
                                Read the story
                            </div>
                            <div class=" custom-styles w-embed"></div>
                        </div>
                    </a>
                </div>
                <?php
                echo '<div class="post-date m-40 mb-0 d-block d-sm-none">' . get_the_date('d F Y', get_the_ID()) . ' </div>';
                ?>
            </div>
        </div>
    </div>
    <div class="d-none d-sm-block meduim-hide col-md-6 col-sm-12 p-0" data-aos="fade-up">
        <?php
        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius'));
        ?>
    </div>
<?php
}
?>