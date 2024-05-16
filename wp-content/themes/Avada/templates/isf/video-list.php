<?php
?>
<div class="col-md-4 col-sm-12 mb-40" data-aos="fade-up">
    <div class="col position-relative">
        <?php
        echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid img-border-radius'));
        ?>
        <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
            <div class="icon play-button" post-data="<?php echo get_the_ID(); ?>" data-bs-toggle="modal" data-bs-target="#videoModal">
                <svg class="" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M40 0.625031C32.2124 0.625031 24.5996 2.93433 18.1244 7.26091C11.6493 11.5875 6.60246 17.737 3.62226 24.9319C0.642061 32.1267 -0.137696 40.0437 1.3816 47.6817C2.90089 55.3197 6.65099 62.3357 12.1577 67.8423C17.6644 73.349 24.6803 77.0991 32.3183 78.6184C39.9563 80.1377 47.8733 79.358 55.0682 76.3778C62.263 73.3976 68.4125 68.3508 72.7391 61.8756C77.0657 55.4004 79.375 47.7877 79.375 40C79.375 29.5571 75.2266 19.5419 67.8423 12.1577C60.4581 4.77346 50.4429 0.625031 40 0.625031ZM60.9447 42.5172L27.1947 59.3922C26.7658 59.6065 26.2892 59.7076 25.8103 59.6859C25.3313 59.6643 24.8658 59.5205 24.4581 59.2683C24.0503 59.0161 23.7138 58.6638 23.4805 58.2449C23.2471 57.826 23.1248 57.3545 23.125 56.875V23.125C23.1253 22.6458 23.248 22.1746 23.4815 21.7561C23.715 21.3376 24.0516 20.9857 24.4592 20.7339C24.8669 20.482 25.3322 20.3384 25.811 20.3169C26.2897 20.2953 26.766 20.3964 27.1947 20.6107L60.9447 37.4856C61.4112 37.7195 61.8035 38.0785 62.0777 38.5225C62.3518 38.9666 62.497 39.4782 62.497 40C62.497 40.5219 62.3518 41.0335 62.0777 41.4775C61.8035 41.9216 61.4112 42.2806 60.9447 42.5144" fill="#FFFFF6"></path>
                </svg>
            </div>
        </div>
    </div>
    <h3 class="mt-20" id="title_<?php echo get_the_ID(); ?>">
        <?php
        echo get_the_title(get_the_ID());
        ?>
    </h3>

    <div id="iframe_<?php echo get_the_ID(); ?>" class="custom_video opacity-0 d-none position-absolute iframe_<?php echo get_the_ID(); ?>">
        <?php echo get_field('video_embed_code', get_the_ID()); ?>
    </div>

    <?php
    do_action('avada_blog_post_content');
    ?>
    <div class="d-flex justify-content-between">
        <div class="post-date">
            <?php echo get_the_date('d F Y', get_the_ID()); ?>
        </div>
    </div>
</div>