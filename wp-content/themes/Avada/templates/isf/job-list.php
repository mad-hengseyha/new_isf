<?php
$parrams = $args['parrams'];
?>
<div class="jobs col-md-6 col-sm-12 mb-sm-40" data-aos="fade-up">
    <div class="border-top pt-20">
        <h3>
            <?php
            echo get_the_title(get_the_ID());
            ?>
        </h3>
        <?php
        $expired_date = get_field('job_expired_date', get_the_ID());
        $commitment = get_field('job_commitment', get_the_ID());
        $position = get_field('job_position', get_the_ID());
        $area = get_field('job_area', get_the_ID());
        echo '<div class="title-and-p-padding">';
        if ($area) {
            echo '<div>';
            echo 'Area: <strong>' . $area . '</strong>';
            echo '</div>';
        }
        if ($position) {
            echo '<div>';
            echo 'Position: <strong>' . $position . '</strong>';
            echo '</div>';
        }
        if ($expired_date) {
            echo 'Apply before: <strong>' . $expired_date . '</strong>';
        }
        if ($commitment) {
            echo '<div>';
            echo 'Commitment: <strong>' . $commitment . '</strong>';
            echo '</div>';
        }
        echo '</div>';
        echo '<div class="">';
        the_excerpt();
        echo '</div>';
        ?>
        <div class="d-flex justify-content-start">
            <div class="m-40 mb-0 isf-link-wraper">
                <a class="isf-link" href="<?php echo the_permalink(); ?>">
                    <div class="slide-in-bottom">
                        <div class="" data-hover="Learn more">
                            Learn more
                        </div>
                        <div class=" custom-styles w-embed"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>