<?php

add_action("isf_custome_template_section", "isf_custome_template_section_function");

function isf_custome_template_section_function($post_id)
{
    // how we work 
    how_we_work_section($post_id);

    isf_two_columns_section($post_id, 'defult');

    isf_sustainable_section($post_id);

    // how we are run 
    how_we_are_run_section_post($post_id);

    // Our impact and reach
    state_number_three_columns_section($post_id, 'section-padding-mobile pb-40', 'd-flex d-sm-none');

    // how it start section
    isf_show_it_start_section($post_id);

    //Education Programme
    isf_education_program_section($post_id);

    isf_education_program_impact_section($post_id);

    //community_section_id
    isf_community_section($post_id);

    //impact_section_id
    isf_impact_section($post_id);

    //footbal_section_id
    isf_football_section($post_id);

    // football_impage_section_id
    isf_football_impage_section($post_id);

    // A child's journey at ISF Cambodia
    isf_four_columns_section($post_id, 'section-padding-top-mobile pt-40');

    //partner ship section
    isf_partnership_section($post_id, '', '', '', 'ishome');

    // story section
    isf_remark_story_section($post_id);

    // contribution_section_post
    isf_contribution_section($post_id);

    //section_form_id
    sfi_subscription_section($post_id);

    //secail_media_section_id
    sfi_secail_media_section($post_id);

    //Where our money goes
    sfi_where_our_money_go_section($post_id);
}

function sponsor_football_section($post_id, $form = '', $class = '', $mobile_class = '')
{
    // how we work section
    $sponsor_football_title = get_field("sponsor_football_title", $post_id);
    $sponsor_football_description = get_field("sponsor_football_description", $post_id);
    $sponsor_football_button = get_field("sponsor_football_button", $post_id);
    $sponsor_football_button_link = get_field("sponsor_football_button_link", $post_id);
    $sponsor_football_button_color = get_field("sponsor_football_button_color", $post_id);
    $sponsor_football_button_icon = get_field("sponsor_football_button_icon", $post_id);
    $sponsor_football_video = get_field("sponsor_football_video", $post_id);
    $sponsor_football_video_icon = get_field("sponsor_football_video_icon", $post_id);
    $sponsor_football_video_thumbnail = get_field("sponsor_football_video_thumbnail", $post_id);
    $section_background = get_field("sponsor_football_section_background", $post_id);

    $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';

    //Learn more section
    $learn_more_section = get_field("learn_more_section", $post_id);

    $button_color = !$sponsor_football_button_color ? "primary-bg-orrange" : "";
    $custom_button = $sponsor_football_button_color ? 'style="background:' . $sponsor_football_button_color . '"' : '';

    if ($sponsor_football_button_color == '#05357b') {
        $button_color = 'primary-bg-blue';
        $custom_button = '';
    } else if ($sponsor_football_button_color == '#f25b2a') {
        $button_color = 'primary-bg-orrange';
        $custom_button = '';
    }
    $add_class = $class ? $class : 'align-items-center';
    if ($sponsor_football_title) {
?>
        <section class="section-padding sponsor-football <?php echo $mobile_class; ?>" <?php echo $section_background; ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="meduim-reverse flex-column-reverse flex-md-row gap-3 gap-sm-0 row <?php echo $add_class ?>">
                        <div class="col-md-5 col-sm-12 meduim-mt-20">
                            <h2 class="title-and-p-padding">
                                <?php echo $sponsor_football_title; ?>
                            </h2>

                            <?php echo $sponsor_football_description; ?>

                            <?php if ($sponsor_football_button) { ?>
                                <div class="d-flex mt-40">

                                    <a href="<?php echo $sponsor_football_button_link['url']; ?>" target="<?php echo $sponsor_football_button_link['target']; ?>" title="<?php echo $sponsor_football_button_link['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $sponsor_football_button_icon ? $sponsor_football_button_icon . '' : ''; ?> <?php echo $sponsor_football_button; ?>
                                    </a>
                                </div>
                                <?php
                            }
                            if ($learn_more_section) {
                                if ($learn_more_section['description']) {
                                    echo '<h5 class="title-and-p-padding learn-more-title">' . $learn_more_section['description'] . '</h5>';
                                }

                                if ($learn_more_section['button_actions']) {
                                    $button_color = '';
                                    for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                        $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                        $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                            "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";
                                        if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                            $button_color = 'primary-bg-blue';
                                            $custom_button = 'style="' . $text_color . '"';
                                        } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                            $button_color = 'primary-bg-orrange';
                                            $custom_button = 'style="' . $text_color . '"';
                                        }
                                ?>
                                        <div class="d-flex mt-40">
                                            <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                                <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] . '' : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                            }
                            if ($form && $form == "contact-form") {
                                //   do contact form here 
                                ?>
                                <h3>General inquiries</h3>
                                <div class="form-group">
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label for="first_name">Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Message</label>
                                            <textarea class="form-control" rows="5" name="message"></textarea>
                                        </div>

                                        <div class="m-auto d-flex mt-5 justify-content-center">
                                            <input type="submit" class="primary-button contact-form-btn" style="background:#F25B2A;color:#fff" value="Send">
                                        </div>

                                    </form>
                                </div>
                            <?php

                            }
                            ?>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6 col-sm-12">
                            <div class="col position-relative">

                                <?php if ($sponsor_football_video) {
                                    video_bg_autoplay(str_replace(" ", "", $sponsor_football_video), 'sponsor-football');
                                ?>
                                    <div id="sponsor_football_video" class="video-icon d-flex justify-content-center align-items-center">
                                        <div class="icon">
                                            <?php echo $sponsor_football_video_icon; ?>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $sponsor_football_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                <?php

                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if ($sponsor_football_video) {
                            echo video_component($sponsor_football_video, $section_video_id = "sponsor_football_video");
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}
function isf_more_about_isf_australia($post_id, $class = '')
{
    $about_isf_australia_section_title = get_field('about_isf_australia_section_title', $post_id);
    $sub_section_block = get_field('sub_section_block', $post_id);
    if ($about_isf_australia_section_title && $sub_section_block) {
    ?>
        <section class="section-padding more-about-isf pb-0">
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="col-12" data-aos="fade-up">
                        <h2 class="title-and-p-padding">
                            <?php echo $about_isf_australia_section_title; ?>
                        </h2>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <?php
                        for ($i = 0; $i < count($sub_section_block); $i++) {
                        ?>
                            <div class="col-md-6 col-sm-12 mb-40">
                                <div class="col-md-10 col-sm-12 p-0">
                                    <?php
                                    if ($sub_section_block[$i]['title']) {
                                    ?>
                                        <h4 class="title-and-p-padding heading-btn_<?php echo $i; ?>">
                                            <?php echo $sub_section_block[$i]['title']; ?>
                                        </h4>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($sub_section_block[$i]['type'] == 'Text') {
                                        echo $sub_section_block[$i]['body_text'];
                                    } else {
                                        $body_accordion
                                            = $sub_section_block[$i]['body_accordion'];
                                        isf_australia_team($body_accordion, '');
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}

function isf_australia_team($post_id, $section = 'isf-team')
{
    //section Field
    $accordion_title = get_field("accordion_title", $post_id);
    $accordion_description = get_field("accordion_description", $post_id);
    $accordion_list = get_field("accordion_list", $post_id);
    ?>
    <div class="col-12">
        <?php
        if ($accordion_title) {
        ?>
            <h3 class="title-and-p-padding">
                <?php echo $accordion_title; ?>
            </h3>
        <?php
        }
        ?>
        <?php
        echo $accordion_description;
        ?>
    </div>
    <div class="col-12">
        <!-- $accordion_list -->
        <?php
        if ($accordion_list) {
        ?>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php
                for ($i = 0; $i < count($accordion_list); $i++) {
                ?>
                    <div class="accordion-item accordion-spac">

                        <h4 class="accordion-header isf-australia-team" id="flush-heading<?php echo $i . $section; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i . $section; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $i . $section; ?>">

                                <?php echo $accordion_list[$i]['title']; ?>

                            </button>
                        </h4>
                        <div id="flush-collapse<?php echo $i . $section; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $i . $section; ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p>
                                    <?php echo $accordion_list[$i]['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
}

function isf_sponsor_football_team_faq($post_id, $mobile = "")
{
    $section_id = get_field('education_section_id', $post_id);
    if ($section_id) {
    ?>
        <section class="section-padding <?php echo $mobile == 'mobile-only' ? 'd-block d-sm-none' : ''; ?>">
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row">
                        <?php
                        sport_feild_accordian($section_id);
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}


function leave_a_legacy_section($post_id, $mobile_class = '')
{
    $text_block_section = get_field('text_block_section', $post_id);
    $section_id = get_field('education_section_id', $post_id);
    $section = 'education_section_id';

    ?>
    <section class="section-padding <?php echo $mobile_class; ?>">
        <div class="content section-adding-x col-12">
            <div class="fusion-row">
                <div class="row">
                    <div class="col-md-5 col-sm-12 custom-text-block mb-sm-40" data-aos="fade-right">
                        <?php
                        $text_block_section = get_field('text_block_section', $post_id);
                        echo $text_block_section;
                        ?>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-md-6 col-sm-12" data-aos="fade-up">
                        <?php
                        //accordion faq
                        sport_feild_accordian($section_id, $section);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}

function state_number_four_columns_section($post_id)
{
    $state_title = get_field("state_title", $post_id);
    $state_description = get_field("state_description", $post_id);
    $state_button = get_field("state_section_button_text", $post_id);
    $state_button_link = get_field("state_section_button_url", $post_id);
    $state_button_icon = get_field("state_section_button_icon", $post_id);
    $state_button_color = get_field("button_state_color", $post_id);
    $section_state_background = get_field("state_section_background_color", $post_id);

    $state_columns_1 = get_field("state_columns_1", $post_id);
    $state_columns_2 = get_field("state_columns_2", $post_id);
    $state_columns_3 = get_field("state_columns_3", $post_id);
    $state_columns_4 = get_field("state_columns_4", $post_id);
    $state_description_column = get_field("state_description_column", $post_id);
    $button_color = !$state_button_color ? "primary-bg-orrange" : "";
    $custom_button = $state_button_color ? 'style="background:' . $state_button_color . '"' : "";
    $column = $state_description_column > 1 ? 'col-12' : 'col-md-6 col-sm-12';
    $section_bg = $section_state_background ? 'style="background:' . $section_state_background . '"' : "";

    if ($state_button_color == '#05357b') {
        $button_color = 'primary-bg-blue';
        $custom_button = '';
    } else if ($state_button_color  == '#f25b2a') {
        $button_color = 'primary-bg-orrange';
        $custom_button = '';
    }
?>
    <section class="section-padding state-four-column" <?php echo $section_bg; ?>>
        <div class="content section-adding-x col-12">
            <div class="fusion-row">
                <div class="row state-wrapper">
                    <div class="col-12 mb-40" data-aos="fade-up">
                        <div class="<?php echo $column; ?>">
                            <h2 class="title-and-p-padding"><?php echo $state_title; ?></h2>
                            <div class="description<?php echo  $state_description_column > 1 ? '-2' : ''; ?> ">
                                <?php echo $state_description; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-lg-3 col-md-12 col-sm-12 d-flex item-wrap">
                            <?php if ($state_columns_1) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon d-sm-block d-flex align-items-center flex-wrap">
                                    <img class="img-fluid w-100" src="<?php echo $state_columns_1['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8 d-sm-block d-flex align-items-center flex-wrap">
                                    <h3 class="mb-2 mt-0"><?php echo $state_columns_1['number']; ?></h3>
                                    <p class="m-0"><?php echo $state_columns_1['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 d-flex item-wrap">
                            <?php if ($state_columns_2) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon d-sm-block d-flex align-items-center flex-wrap">
                                    <img class="img-fluid w-100" src="<?php echo $state_columns_2['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8 d-sm-block d-flex align-items-center flex-wrap">
                                    <h3 class="mb-2 mt-0"><?php echo $state_columns_2['number']; ?></h3>
                                    <p class="m-0"><?php echo $state_columns_2['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 d-flex item-wrap">
                            <?php if ($state_columns_3) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon d-sm-block d-flex align-items-center flex-wrap">
                                    <img class="img-fluid w-100" src="<?php echo $state_columns_3['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8 d-sm-block d-flex align-items-center flex-wrap">
                                    <h3 class="mb-2 mt-0"><?php echo $state_columns_3['number']; ?></h3>
                                    <p class="m-0"><?php echo $state_columns_3['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 d-flex item-wrap">
                            <?php if ($state_columns_4) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon d-sm-block d-flex align-items-center flex-wrap">
                                    <img class="img-fluid w-100" src="<?php echo $state_columns_4['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8 d-sm-block d-flex align-items-center flex-wrap">
                                    <h3 class="mb-2 mt-0"><?php echo $state_columns_4['number']; ?></h3>
                                    <p class="m-0"><?php echo $state_columns_4['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    if ($state_button) { ?>
                        <div class="isf-mt d-flex">
                            <a href="<?php echo $state_button_link['url']; ?>" target="<?php echo $state_button_link['target']; ?>" title="<?php echo $state_button_link['title']; ?>" class="m-auto primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                <?php echo $state_button_icon ? $state_button_icon . '' : ''; ?> <?php echo $state_button; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

function how_we_are_run_body_section($post_id)
{
    //how we are run
    $how_we_are_run_title = get_field("how_we_are_run_title", $post_id);
    $how_we_are_run_description = get_field("how_we_are_run_description", $post_id);
    $how_we_are_run_button = get_field("how_we_are_run_button", $post_id);
    $how_we_are_run_button_link = get_field("how_we_are_run_button_link", $post_id);
    $how_we_are_run_button_color = get_field("how_we_are_run_button_color", $post_id);
    $how_we_are_run_button_icon = get_field("how_we_are_run_button_icon", $post_id);
    $how_we_are_run_video = get_field("how_we_are_run_video", $post_id);
    $how_we_are_run_video_icon = get_field("how_we_are_run_video_icon", $post_id);
    $how_we_are_run_video_thumbnail = get_field("how_we_are_run_video_thumbnail", $post_id);
    $section_how_we_are_run_background = get_field("section_how_we_are_run_background", $post_id);
    $how_we_are_run_ceo = get_field("how_we_are_run_ceo", $post_id);
    $how_we_are_run_quot = get_field("how_we_are_run_quot", $post_id);

    $button_color = !$how_we_are_run_button_color ? "primary-bg-orrange" : "";
    $custom_button = $how_we_are_run_button_color ? 'style="background:' . $how_we_are_run_button_color . '"' : "";

    $section_how_we_are_run_background = $section_how_we_are_run_background ? 'style="background:' . $section_how_we_are_run_background . '"' : '';
    if ($how_we_are_run_button_color == '#05357b') {
        $button_color = 'primary-bg-blue';
        $custom_button = '';
    } else if ($how_we_are_run_button_color  == '#f25b2a') {
        $button_color = 'primary-bg-orrange';
        $custom_button = '';
    }
    if ($how_we_are_run_title) {
    ?>
        <section class="section-padding" <?php echo $section_how_we_are_run_background; ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row align-items-center">
                        <div class="col-md-5 col-sm-12">
                            <h2 class="title-and-p-padding">
                                <?php echo $how_we_are_run_title; ?>
                            </h2>

                            <?php echo $how_we_are_run_description; ?>

                            <?php if ($how_we_are_run_button_link) { ?>
                                <div class="d-flex mt-40">
                                    <a href="<?php echo $how_we_are_run_button_link['url']; ?>" target="<?php echo $how_we_are_run_button_link['target']; ?>" title="<?php echo $how_we_are_run_button_link['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>> <?php echo $how_we_are_run_button_icon . ''; ?> <?php echo $how_we_are_run_button; ?></a>
                                </div>
                            <?php
                            }
                            if ($how_we_are_run_video) {
                                echo video_component($how_we_are_run_video, $section_video_id = "how_we_are_run_video");
                            }
                            ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6 col-sm-12">
                            <div class="position-relative">
                                <?php
                                if ($how_we_are_run_video) {
                                    video_bg_autoplay(str_replace(" ", "", $how_we_are_run_video), 'how_we_run_mobile');
                                ?>
                                    <div id="how_we_are_run_video" class="video-icon d-flex justify-content-center align-items-center">
                                        <div class="icon">
                                            <?php echo $how_we_are_run_video_icon; ?>
                                        </div>
                                    </div>
                                    <?php } else {
                                    if ($how_we_are_run_video_thumbnail) {
                                    ?>
                                        <img src="<?php echo $how_we_are_run_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="quote">
                                <div class="d-flex mt-40">
                                    <span class="quote primary-orrange">“</span>
                                    <p class="quote-description">
                                        <?php echo $how_we_are_run_quot; ?>
                                    </p>
                                </div>
                                <p class="text-end m-0">
                                    <?php echo $how_we_are_run_ceo; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}

function how_we_are_run_header_section($post_id, $class = "", $header = "", $mobile_class = "")
{
    $how_we_are_run_section_post = get_field('how_we_are_run_section_post', $post_id);
    if ($how_we_are_run_section_post) {
        how_we_are_run_section_leave_legacy($how_we_are_run_section_post, $post_id, $header, $mobile_class);
    }
}


//how_we_are_run_section
function how_we_are_run_section_leave_legacy($post_id, $post, $header = '', $mobile_class = '')
{
    //how we are run
    $how_we_are_run_title = get_field("how_we_are_run_title", $post_id);
    $how_we_are_run_description = get_field("how_we_are_run_description", $post_id);
    $how_we_are_run_button = get_field("how_we_are_run_button", $post_id);
    $how_we_are_run_button_link = get_field("how_we_are_run_button_link", $post_id);
    $how_we_are_run_button_color = get_field("how_we_are_run_button_color", $post_id);
    $how_we_are_run_button_icon = get_field("how_we_are_run_button_icon", $post_id);
    $how_we_are_run_video = get_field("how_we_are_run_video", $post_id);
    $how_we_are_run_video_icon = get_field("how_we_are_run_video_icon", $post_id);
    $how_we_are_run_video_thumbnail = get_field("how_we_are_run_video_thumbnail", $post_id);
    $section_how_we_are_run_background = get_field("how_we_are_run_section_color", $post);
    $section_how_we_are_run_background = $section_how_we_are_run_background ? $section_how_we_are_run_background : get_field("section_how_we_are_run_background", $post_id);
    $how_we_are_run_ceo = get_field("how_we_are_run_ceo", $post_id);
    $how_we_are_run_quot = get_field("how_we_are_run_quot", $post_id);
    $button_color = !$how_we_are_run_button_color ? "primary-bg-orrange" : "";
    $custom_button = $how_we_are_run_button_color ? 'style="background:' . $how_we_are_run_button_color . '"' : "";
    $section_bg = $section_how_we_are_run_background
        ? 'style="background:' . $section_how_we_are_run_background . '"' : "";

    if ($how_we_are_run_button_color == '#05357b') {
        $button_color = 'primary-bg-blue';
        $custom_button = '';
    } else if ($how_we_are_run_button_color  == '#f25b2a') {
        $button_color = 'primary-bg-orrange';
        $custom_button = '';
    }

    if ($how_we_are_run_title) {
    ?>
        <section class="section-padding <?php echo $mobile_class; ?>" <?php echo $section_bg; ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row <?php echo $header ? '' : 'align-items-center'; ?>">
                        <div class="col-md-5 col-sm-12" data-aos="fade-right">
                            <h2 class="title-and-p-padding"><?php echo $how_we_are_run_title; ?></h2>
                            <?php
                            echo $how_we_are_run_description;
                            if ($how_we_are_run_button_link) {
                            ?>
                                <div class="d-flex mt-40">

                                    <a href="<?php echo $how_we_are_run_button_link['url']; ?>" target="<?php echo $how_we_are_run_button_link['target']; ?>" title="<?php echo $how_we_are_run_button_link['title']; ?>" class="d-none d-sm-block primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $how_we_are_run_button_icon . ''; ?> <?php echo $how_we_are_run_button; ?>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6 col-sm-12" data-aos="fade-up">
                            <div class="position-relative">
                                <?php
                                if ($how_we_are_run_video) {
                                    video_bg_autoplay(str_replace(" ", "", $how_we_are_run_video), 'leave_lagacy');
                                ?>
                                    <div id="how_we_are_run_video" class="video-icon d-flex justify-content-center align-items-center">
                                        <div class="icon">
                                            <?php echo $how_we_are_run_video_icon; ?>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $how_we_are_run_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            if ($how_we_are_run_quot) {
                            ?>
                                <div class="quote">
                                    <div class="d-flex mt-40">
                                        <span class="quote primary-orrange">“</span>
                                        <p class="quote-description">
                                            <?php echo $how_we_are_run_quot; ?>
                                        </p>
                                    </div>
                                    <p class="text-end m-0">
                                        <?php echo $how_we_are_run_ceo; ?>
                                    </p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        echo video_component($how_we_are_run_video, $section_video_id = "how_we_are_run_video");
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}

function read_more_story($post_id)
{
    ?>
    <section class="section-padding primary-bg-sand stories-list">
        <div class="content section-adding-x col-12">
            <div class="fusion-row">
                <div class="row">
                    <h2 class="title-and-p-padding">Read more stories</h2>
                    <?php
                    $args = array(
                        'posts_per_page' => 3,
                        'post__not_in' => array($post_id),
                        'post_type' => 'post',
                        'post_status' => 'publish',

                    );

                    $posts = new WP_Query($args);
                    if ($posts->have_posts()) {
                        while ($posts->have_posts()) : $posts->the_post();
                            get_template_part('/templates/isf/story-list');
                        endwhile;
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

function social_media_sharing_action($post_id)
{
    echo '<div class="mt-40">';
    include locate_template('templates/social-sharing.php');
    echo '</div>';
}
function isf_video_sectioni_list($post_id = '', $bg = '')
{

    $video_section_title = get_field('video_section_title', $post_id);
    $video_section_color = get_field('video_section_color', $post_id);
    $video_section_description = get_field('video_section_description', $post_id);
    $video_section_post_limit = get_field('video_section_post_limit', $post_id);
    $cate_id = get_field('post_list_type', $post_id);
    if ($video_section_title || $video_section_description) {
        $section_background = $video_section_color ? 'style="background:' . $video_section_color . '"' : '';
        if ($bg == 'no') {
            $section_background = '';
        }
    ?>
        <section class="section-padding" <?php echo $section_background; ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row mb-40">
                        <div class="col-md-5 col-sm-12" data-aos="fade-right">
                            <h2 class="title-and-p-padding">
                                <?php echo $video_section_title; ?>
                            </h2>
                            <?php echo $video_section_description; ?>
                        </div>
                        <div class="col-md-7 col-sm-12"></div>
                    </div>

                    <div class="row" id="videos-wrapper">
                        <?php
                        $per_page = $video_section_post_limit ? $video_section_post_limit : 6;
                        $args = array(
                            'posts_per_page' => $per_page,
                            'post_type' => 'video-library',
                            'post_status' => 'publish',
                        );

                        $posts = new WP_Query($args);
                        if ($posts->have_posts()) {
                            while ($posts->have_posts()) : $posts->the_post();
                                get_template_part('/templates/isf/video-list');
                            endwhile;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <?php
                    if ($per_page <= $posts->found_posts) {
                    ?>
                        <div class="mt-40 d-flex justify-content-center" data-aos="fade-up">
                            <a class="m-auto custom-btn primary-btn btn-read-more primary-bg-orrange" disabled="false" ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>' href="#" data-perpage="<?php echo $per_page; ?>" id="load-more-video">
                                See more video
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php
    }
}

function isf_story_section_list($post_id, $exclude = "")
{
    $cate_id = get_field('post_list_type', $post_id);
    if ($cate_id) {
        $post_list_type_limit = get_field('post_list_type_limit', $post_id);
    ?>
        <section class="pt-0 section-padding stories-list">
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row mb-20" id="stories-list-wrapper">
                        <?php
                        $per_page = $post_list_type_limit ? $post_list_type_limit : 6;
                        $args = array(
                            'posts_per_page' => $per_page,
                            'post_type' => 'post',
                            'post_status' => 'publish',
                        );

                        $posts = new WP_Query($args);
                        if ($posts->have_posts()) {
                            while ($posts->have_posts()) : $posts->the_post();
                                get_template_part('/templates/isf/story-list');
                            endwhile;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>
                <div class="mt-40 d-flex justify-content-center" data-aos="fade-up">
                    <a class="m-auto custom-btn primary-btn btn-read-more primary-bg-orrange" disabled="false" ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>' data-perpage="<?php echo $per_page; ?>" href="#" id="load-more-stories">
                        Read more stories
                    </a>
                </div>
            </div>
        </section>
    <?php
    }
}

// map_section
function isf_map_section($post_id)
{
    $maps = get_field('map_section', $post_id);
    $section_id = get_field('education_section_id', $post_id);
    $section = 'education_section_mobile_id';
    if ($maps) {
    ?>
        <section class="pt-0 section-padding">
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row align-items-center" data-aos="fade-up">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <?php
                            for ($i = 0; $i < count($maps); $i++) {
                                echo '<h3 class="title-and-p-padding">' .  $maps[$i]['title'] . '</h3>';
                                echo '<div class="map-wrapper">' . $maps[$i]['map'] . '</div>';
                            }
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-12 d-block d-sm-none mt-40" data-aos="fade-up">
                            <?php
                            //accordion faq
                            sport_feild_accordian($section_id, $section);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
}

function isf_book_sports_ground_section($post_id, $mobile_class = '')
{
    $text_block_section = get_field('text_block_section', $post_id);
    $section_id = get_field('education_section_id', $post_id);
    $section = 'education_section_id';

    ?>
    <section class="pt-0 section-padding <?php echo $mobile_class; ?>">
        <div class="content section-adding-x col-12">
            <div class="fusion-row">
                <div class="row">
                    <div class="col-md-6 col-sm-12 custom-text-block" data-aos="fade-right">
                        <?php
                        $text_block_section = get_field('text_block_section', $post_id);
                        echo $text_block_section;
                        ?>
                    </div>
                    <div class="col-md-6 col-sm-12 d-none d-sm-block" data-aos="fade-up">
                        <?php
                        //accordion faq
                        sport_feild_accordian($section_id, $section);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}

function sport_feild_accordian($post_id, $section = 'sport_feild')
{
    //section Field
    $accordion_title = get_field("accordion_title", $post_id);
    $accordion_description = get_field("accordion_description", $post_id);
    $accordion_list = get_field("accordion_list", $post_id);
?>
    <div class="col-12">
        <?php
        if ($accordion_title) {
        ?>
            <h3 class="title-and-p-padding">
                <?php echo $accordion_title; ?>
            </h3>
        <?php
        }
        ?>
        <?php
        echo $accordion_description;
        ?>
    </div>
    <div class="col-12">
        <!-- $accordion_list -->
        <?php
        if ($accordion_list) {
        ?>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php
                for ($i = 0; $i < count($accordion_list); $i++) {
                ?>
                    <div class="accordion-item accordion-spac">

                        <h4 class="accordion-header" id="flush-heading<?php echo $i . $section; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i . $section; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $i . $section; ?>">

                                <?php echo $accordion_list[$i]['title']; ?>

                            </button>
                        </h4>
                        <div id="flush-collapse<?php echo $i . $section; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $i . $section; ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p>
                                    <?php echo $accordion_list[$i]['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
}

// football_section_shedule
function isf_football_shedule_section($post_id, $mobile_class = '')
{
    $football_section_shedule = get_field('football_section_shedule', $post_id);
    $football_section_title = get_field('football_section_title', $post_id);
    if ($football_section_shedule) {
    ?>
        <section class="section-padding <?php echo $mobile_class; ?>">
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row align-items-center">
                        <h2 class="title-and-p-padding" data-aos="fade-up">
                            <?php echo $football_section_title; ?>
                        </h2>
                        <div class="grid-2-column">
                            <?php
                            $section = 'shedule';
                            for ($i = 0; $i < count($football_section_shedule); $i++) {
                            ?>
                                <div class="box-wrapper d-none d-sm-block" data-aos="fade-up">
                                    <h4 class="title-and-p-padding">
                                        <?php echo $football_section_shedule[$i]['title']; ?>
                                    </h4>
                                    <div class="d-grid grid-1-column mb-40">
                                        <?php
                                        for ($a = 0; $a < count($football_section_shedule[$i]['pitch_name']); $a++) {
                                        ?>
                                            <div class="col primary-bg-sand img-border-radius">
                                                <div class="p-40">
                                                    <h4 class="title-and-p-padding">
                                                        <?php
                                                        echo $football_section_shedule[$i]['pitch_name'][$a]['name'];
                                                        ?>
                                                    </h4>
                                                    <?php
                                                    for (
                                                        $b = 0;
                                                        $b < count($football_section_shedule[$i]['pitch_name'][$a]['pitch_option']);
                                                        $b++
                                                    ) {
                                                        echo '<div class="d-flex justify-content-between pb-20">';
                                                        echo '<div>' . $football_section_shedule[$i]['pitch_name'][$a]['pitch_option'][$b]['hour'] . '</div>';
                                                        echo '<div><strong>' . $football_section_shedule[$i]['pitch_name'][$a]['pitch_option'][$b]['fee'] . '</strong></div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    echo $football_section_shedule[$i]['football_section_note'];
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        for ($i = 0; $i < count($football_section_shedule); $i++) {
                        ?>
                            <div class="box-wrapper d-block d-sm-none">
                                <div class="accordion accordion-flush" id="accordionFlushExampleSchedule">
                                    <div class="accordion-items accordion-spac">
                                        <h2 class="accordion-header pitch-schedule" id="flush-heading<?php echo $i; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i . $section; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $i . $section; ?>">
                                                <?php echo $football_section_shedule[$i]['title']; ?>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?php echo $i . $section; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $i . $section; ?>" data-bs-parent="#accordionFlushExampleSchedule">
                                            <div class="accordion-body p-0">
                                                <?php
                                                for ($d = 0; $d < count($football_section_shedule[$i]['pitch_name']); $d++) {
                                                ?>
                                                    <div class="col primary-bg-sand img-border-radius mb-3 ">
                                                        <div class="p-40">
                                                            <h4 class="title-and-p-padding">
                                                                <?php
                                                                echo $football_section_shedule[$i]['pitch_name'][$d]['name'];
                                                                ?>
                                                            </h4>
                                                            <?php
                                                            for (
                                                                $b = 0;
                                                                $b < count($football_section_shedule[$i]['pitch_name'][$d]['pitch_option']);
                                                                $b++
                                                            ) {
                                                                echo '<div class="d-flex justify-content-between pb-20">';
                                                                echo '<div>' . $football_section_shedule[$i]['pitch_name'][$d]['pitch_option'][$b]['hour'] . '</div>';
                                                                echo '<div><strong>' . $football_section_shedule[$i]['pitch_name'][$d]['pitch_option'][$b]['fee'] . '</strong></div>';
                                                                echo '</div>';
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <p>
                                                    <?php
                                                    echo $football_section_shedule[$i]['football_section_note'];
                                                    ?>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <?php
    }


    function isf_our_people_section($post_id, $mobile_class)
    {
        $our_people_section = get_field('people_section_field', $post_id);
        // $cate_id = get_field('our_people_section_cate', $post_id);
        $section_color = '';
        $section_background = $section_color ? 'style="background:' . $section_color . '"' : '';
        $class = '';
        if ($our_people_section) {
            for ($i = 0; $i < count($our_people_section); $i++) {
                $cate_id = $our_people_section[$i]['category'];
                $limit = $our_people_section[$i]['post_limit'];
                $args = array(
                    'posts_per_page' => $limit ? $limit : 30,
                    'post_type' => 'people',
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'people-category',
                            'field' => 'term_id',
                            'terms' => $cate_id,
                            'operator' => 'IN'
                        )
                    )
                );


                $posts = new WP_Query($args);
                if ($posts->have_posts()) {
        ?>
                    <section class="pt-0 section-padding pb-md-20" <?php echo $section_background; ?>>
                        <div class="content section-adding-x col-12">
                            <div class="fusion-row">
                                <div class="row <?php echo $class; ?>">
                                    <?php
                                    $col = 6;
                                    $empty = '';
                                    if ($our_people_section[$i]['image']) {
                                        $col = 5;
                                        $empty = '<div class="col-1"></div>';
                                    }
                                    if ($our_people_section[$i]['title']) {
                                    ?>
                                        <div class="col-md-<?php echo $col; ?> col-sm-12">
                                            <h2 class="title-and-p-padding">
                                                <?php echo $our_people_section[$i]['title']; ?>
                                            </h2>
                                            <?php
                                            echo $our_people_section[$i]['description'];
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    echo $empty; ?>
                                    <?php
                                    if ($our_people_section[$i]['image']) {
                                    ?>
                                        <div class="col-md-6 col-sm-12">
                                            <img class="img-fluid img-border-radius" src="<?php echo $our_people_section[$i]['image']; ?>" />
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $a = 1;
                                    while ($posts->have_posts()) : $posts->the_post();
                                        get_template_part(
                                            '/templates/isf/people-list',
                                            null,
                                            array(
                                                'parrams' => array(
                                                    "col" => $a
                                                )
                                            )
                                        );
                                        $a++;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php
                }
            }
        }
    }

    function how_we_are_run_section_post($post_id, $mobile_class = '')
    {
        $how_we_are_run_section_post = get_field('how_we_are_run_section_post', $post_id);
        if ($how_we_are_run_section_post) {
            how_we_are_run_section($how_we_are_run_section_post, $post_id, $mobile_class);
        }
    }

    function text_block_section($post_id)
    {
        $text_block_section = get_field('text_block_section', $post_id);
        if ($text_block_section) {
            $fundraiser_section_color = get_field('text_block_section_color', $post_id);
            $section_background = $fundraiser_section_color ? 'style="background:' . $fundraiser_section_color . '"' : '';
            ?>
            <section class="section-padding " <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row">
                            <div class="col-md-6 col-sm-12" data-aos="fade-up">
                                <?php
                                echo $text_block_section;
                                ?>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-md-6 col-sm-12"></div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }

    function isf_job_section($post_id, $mobile_class = '')
    {
        $job_section_field = get_field('job_section_field', $post_id);
        $class = '';
        if ($job_section_field) {
            for ($i = 0; $i < count($job_section_field); $i++) {

                if ($job_section_field[$i]['job_section_image']) {
                    $class = 'd-flex align-items-center';
                }
            ?>
                <section class="section-padding <?php echo $mobile_class; ?>">
                    <div class="content section-adding-x col-12">
                        <div class="fusion-row">
                            <div class="row align-items-center <?php echo $class; ?>">
                                <?php
                                $col = 6;
                                $empty = '';
                                if ($job_section_field[$i]['job_section_image']) {
                                    $col = 6;
                                    // $empty = '<div class="col-1"></div>';
                                }
                                ?>
                                <div class="row  align-items-center">
                                    <div class="col-md-<?php echo $col; ?> col-sm-12" data-aos="fade-up">
                                        <?php
                                        if ($job_section_field[$i]['job_section_image']) {
                                            echo '<div class="mr-78">';
                                        }
                                        ?>
                                        <h2 class="title-and-p-padding">
                                            <?php echo $job_section_field[$i]['title']; ?>
                                        </h2>
                                        <?php
                                        echo $job_section_field[$i]['description'];
                                        ?>
                                        <?php
                                        if ($job_section_field[$i]['job_section_image']) {
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                    <?php echo $empty; ?>
                                    <div class="col-md-6 col-sm-12" data-aos="fade-up">
                                        <?php
                                        if ($job_section_field[$i]['job_section_image']) {
                                        ?>
                                            <img class="img-fluid img-border-radius" src="<?php echo $job_section_field[$i]['job_section_image']; ?>" />
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <?php
                                $session = $job_section_field[$i]['job_session'];
                                $post_limit = $job_section_field[$i]['post_limit'];
                                $args = array(
                                    'posts_per_page' => $post_limit,
                                    'post_type' => 'isf_job',
                                    'post_status' => 'publish',
                                );
                                if ($session) {
                                    $args['tax_query'] = array(
                                        array(
                                            'taxonomy' => 'job_session',
                                            'field' => 'term_id',
                                            'terms' => $session,
                                            'operator' => 'IN'
                                        )
                                    );


                                    $posts = new WP_Query($args);
                                    if ($posts->have_posts()) {

                                        echo '<div class="col-12 pt-80" data-aos="fade-up">
                                        <div class="col-12">
                                            <h2>
                                            Open positions
                                            </h2>
                                        </div>
                                        <div class="row">
                                    ';
                                        $a = 1;
                                        while ($posts->have_posts()) : $posts->the_post();
                                            get_template_part(
                                                '/templates/isf/job-list',
                                                null,
                                                array(
                                                    'parrams' => array(
                                                        "col" => $a
                                                    )
                                                )
                                            );
                                            $a++;
                                        endwhile;
                                        wp_reset_postdata();
                                        echo '</div>';
                                        echo "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
            }
        }
    }

    function isf_fundraisers_section($post_id, $class_mobile = '')
    {
        $fundraiser_section_title = get_field('fundraiser_section_title', $post_id);
        $fundraiser_section_color = get_field('fundraiser_section_color', $post_id);
        $fundraiser_section_description = get_field('fundraiser_section_description', $post_id);
        $fundraiser_section_post_limit = get_field('fundraiser_section_post_limit', $post_id);
        if ($fundraiser_section_description && $fundraiser_section_title) {
            $section_background = $fundraiser_section_color ? 'style="background:' . $fundraiser_section_color . '"' : '';
            $args = array(
                'posts_per_page' => $fundraiser_section_post_limit ? $fundraiser_section_post_limit : 2,
                'order' => 'DESC',
                'post_type' => 'fundraiser',
            );
            $post = new WP_Query($args);
            $class = 'd-lg-flex d-md-block d-sm-block align-items-center mb-40';
            ?>
            <section class="section-padding fund-raiser <?php echo $class_mobile; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-40" data-aos="fade-up">
                                <h2 class="title-and-p-padding">
                                    <?php echo $fundraiser_section_title; ?>
                                </h2>
                                <?php echo $fundraiser_section_description; ?>
                            </div>
                            <?php
                            if ($post->have_posts()) {
                                $i = 1;
                                while ($post->have_posts()) : $post->the_post();
                                    echo '<div class="col-12 ' . $class . '">';
                                    get_template_part(
                                        '/templates/isf/fundraiser-list',
                                        null,
                                        array(
                                            'parrams' => array(
                                                "col" => $i
                                            )
                                        )
                                    );
                                    $i++;
                                    echo "</div>";
                                endwhile;
                                wp_reset_postdata();
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    function isf_contribute_ways_section($post_id, $class = '')
    {
        //contribute_ways_section_color
        $section_background = get_field('contribute_ways_section_color', $post_id);
        $contribute_ways_section_title = get_field('contribute_ways_section_title', $post_id);
        $contribute_ways_section_description = get_field('contribute_ways_section_description', $post_id);
        $contribute_ways_section_box = get_field('contribute_ways_section_box', $post_id);

        $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';
        ?>
        <section class="section-padding way-to-contribute <?php echo $class; ?>" <?php echo $section_background; ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="col-md-5 col-sm-12 p-0">
                                <h2 class="title-and-p-padding">
                                    <?php echo $contribute_ways_section_title; ?>
                                </h2>

                                <?php echo $contribute_ways_section_description; ?>
                            </div>
                        </div>
                        <?php
                        if ($contribute_ways_section_box) { ?>
                            <div class="col-12 d-grid grid-2-column grid-meduim-1 mt-2">
                                <?php
                                for ($i = 0; $i < count($contribute_ways_section_box); $i++) {
                                    $bg = $contribute_ways_section_box[$i]['box_color'] ? 'style="background:' . $contribute_ways_section_box[$i]['box_color'] . ';"' : '';
                                ?>
                                    <div class="col img-border-radius" <?php echo $bg; ?>>
                                        <div class="col-12 p-40 d-flex h-100 justify-content-between flex-column">
                                            <div>
                                                <h3 class="title-and-p-padding">
                                                    <?php
                                                    echo $contribute_ways_section_box[$i]['icon'] ? $contribute_ways_section_box[$i]['icon'] . '' : '';
                                                    echo $contribute_ways_section_box[$i]['title'];
                                                    ?>
                                                </h3>
                                                <p class="m-0 ">
                                                    <?php
                                                    echo $contribute_ways_section_box[$i]['description'];
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <div class="m-40 mb-0 isf-link-wraper">
                                                    <a class="isf-link " href="<?php echo $contribute_ways_section_box[$i]['button_url']['url']; ?>" title="<?php echo $contribute_ways_section_box[$i]['button_url']['title']; ?>" target="<?php echo $contribute_ways_section_box[$i]['button_url']['target']; ?>">
                                                        <div class="slide-in-bottom">
                                                            <div class="" data-hover="<?php echo $contribute_ways_section_box[$i]['button_text']; ?>">
                                                                <?php echo $contribute_ways_section_box[$i]['button_text']; ?>
                                                            </div>
                                                            <div class=" custom-styles w-embed"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    function isf_learn_more_text_section($post_id, $class = '', $mobile = '', $mb = '', $custom_read_more_btn = '')
    {
        $learn_more_text = get_field('learn_more_text', $post_id);
        if ($learn_more_text) {
            $learn_more_button = get_field('learn_more_button', $post_id);
        ?>
            <div class="col-12 justify-content-center  <?php echo $mobile == 'mobile-only' ? 'd-flex d-sm-none ' : 'd-flex ';
                                                        echo $mb; ?> " data-aos="fade-up">
                <div class="col-md-5 col-sm-12 <?php echo $class; ?>">
                    <div class="my-30">
                        <h5 class="learn-more title-and-p-padding">
                            <strong><?php echo $learn_more_text; ?></strong>
                        </h5>
                    </div>
                    <?php
                    if ($learn_more_button) {
                        $specific_width_btn = '';
                        if (count($learn_more_button) > 1) {
                            $specific_width_btn = 'specific-width-btn';
                        }

                        for ($i = 0; $i < count($learn_more_button); $i++) {
                            $color = $learn_more_button[$i]['button_text_color'] ? 'color:' . $learn_more_button[$i]['button_text_color'] . ';' : '';
                            $bg = $learn_more_button[$i]['button_color'] ? 'background:' . $learn_more_button[$i]['button_color'] . ';' : '';

                            $width = $learn_more_button[$i]['button_width'] ? 'width:' . $learn_more_button[$i]['button_width'] . 'px!important;' : '';

                            $button_style = 'style="' . $bg . $color . $width . '"';

                            $button_mobile_style = 'style="' . $bg . $color . '"';
                            $button_color = 'primary-bg-orrange ';

                            if ($learn_more_button[$i]['button_color']  == '#05357b') {
                                $button_color = 'primary-bg-blue btn-read-more ';
                                $custom_button = '';
                                $button_style = '';
                            } else if ($learn_more_button[$i]['button_color']   == '#f25b2a') {
                                $button_color = 'primary-bg-orrange btn-read-more ';
                                $custom_button = '';
                                $button_style = '';
                            }
                    ?>
                            <div class="d-none d-sm-flex <?php echo $specific_width_btn . '-mb'; ?>">
                                <a href="<?php echo $learn_more_button[$i]['button_url']['url']; ?>" target="<?php echo $learn_more_button[$i]['button_url']['target']; ?>" title="<?php echo $learn_more_button[$i]['button_url']['title']; ?>" class="m-auto primary-btn custom-btn <?php echo  $specific_width_btn . ' ' . $button_color . ' ' . $custom_read_more_btn; ?>" <?php echo $button_style; ?>>
                                    <?php echo $learn_more_button[$i]['button_text']; ?>
                                </a>
                            </div>
                            <div class="d-flex d-sm-none <?php echo $specific_width_btn . '-mb'; ?>">
                                <a href="<?php echo $learn_more_button[$i]['button_url']['url']; ?>" target="<?php echo $learn_more_button[$i]['button_url']['target']; ?>" title="<?php echo $learn_more_button[$i]['button_url']['title']; ?>" class="m-auto primary-btn custom-btn <?php echo  $specific_width_btn . ' ' . $button_color . ' ' . $custom_read_more_btn; ?>" <?php echo $button_mobile_style; ?>>
                                    <?php echo $learn_more_button[$i]['button_text']; ?>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        <?php
        }
    }

    function isf_how_we_work_section($post_id, $mobile)
    {
        // how we work section
        $how_we_work_title = get_field("how_we_work_title_football", $post_id);
        $how_we_work_description = get_field("how_we_work_description_football", $post_id);
        $how_we_work_button = get_field("how_we_work_button_football", $post_id);
        $how_we_work_button_link = get_field("how_we_work_button_link_football", $post_id);
        $how_we_work_button_color = get_field("how_we_work_button_color_football", $post_id);
        $how_we_work_button_icon = get_field("how_we_work_button_icon_football", $post_id);
        $how_we_work_video = get_field("how_we_work_video_football", $post_id);
        $how_we_work_video_icon = get_field("how_we_work_video_icon_football", $post_id);
        $how_we_work_video_thumbnail = get_field("how_we_work_video_thumbnail_football", $post_id);
        $section_background = get_field("section_background_football", $post_id);

        $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';

        //Learn more section
        $learn_more_section = get_field("learn_more_section", $post_id);

        $button_color = !$how_we_work_button_color ? "primary-bg-orrange" : "";
        $custom_button = $how_we_work_button_color ? 'style="background:' . $how_we_work_button_color . '"' : '';

        if ($how_we_work_button_color == '#05357b') {
            $button_color = 'primary-bg-blue ';
            $custom_button = '';
        } else if ($how_we_work_button_color == '#f25b2a') {
            $button_color = 'primary-bg-orrange ';
            $custom_button = '';
        }
        if ($how_we_work_title) {
        ?>
            <section class="section-padding <?php echo $mobile == 'mobile-only' ? 'd-block d-sm-none' : ''; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row ">
                            <div class="col-md-5 col-sm-12" data-aos="fade-right">
                                <h2 class="title-and-p-padding">
                                    <?php echo $how_we_work_title; ?>
                                </h2>
                                <?php
                                $display = '';
                                if (is_page_template('isf-story-page.php')) {
                                    $display = 'd-none d-sm-block';
                                ?>
                                    <div class="col-md-6 col-sm-12 d-block d-sm-none p-0 mb-40">
                                        <div class="col position-relative">
                                            <img src="<?php echo $how_we_work_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                            <?php if ($how_we_work_video) { ?>
                                                <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                    <div class="icon">
                                                        <?php echo $how_we_work_video_icon; ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                echo $how_we_work_description;

                                if ($how_we_work_button) {
                                ?>
                                    <div class="d-flex mt-40">
                                        <a href="<?php echo $how_we_work_button_link['url']; ?>" target="<?php echo $how_we_work_button_link['target']; ?>" title="<?php echo $how_we_work_button_link['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?> d-none d-sm-block" <?php echo $custom_button; ?>>
                                            <?php echo $how_we_work_button_icon ? $how_we_work_button_icon . '' : ''; ?> <?php echo $how_we_work_button; ?>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="d-none d-sm-block">
                                    <?php
                                    if ($learn_more_section) {
                                        if ($learn_more_section['description']) {

                                            echo "<h5 class='learn-more-title title-and-p-padding'>" . $learn_more_section['description'] . "</h5>";
                                        }
                                        if ($learn_more_section['button_actions']) {
                                            for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                                $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                                $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                                    "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";

                                                if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                                    $button_color = 'primary-bg-blue ';
                                                    $custom_button = 'style="' . $text_color . '"';
                                                } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                                    $button_color = 'primary-bg-orrange ';
                                                    $custom_button = 'style="' . $text_color . '"';
                                                }
                                    ?>
                                                <div class="d-flex mt-40">
                                                    <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" class="mt-3 primary-btn custom-btn <?php echo $button_color ?>" <?php echo $custom_button; ?>>
                                                        <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] . '' : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                                <?php
                                $display = '';
                                if (is_page_template('isf-contact-page.php')) {
                                    $display = 'd-none d-sm-block';
                                ?>
                                    <div class="col-md-6 col-sm-12 d-block d-sm-none p-0 mb-40" data-aos="fade-up">
                                        <div class="col position-relative">
                                            <img src="<?php echo $how_we_work_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                            <?php if ($how_we_work_video) { ?>
                                                <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                    <div class="icon">
                                                        <?php echo $how_we_work_video_icon; ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="col-md-1"></div>
                            <?php
                            if (is_page_template('isf-report-and-finance-page.php')) {
                                if ($learn_more_section['button_actions'] || $learn_more_section['description']) {
                                    echo '<div class="d-block d-sm-none col m-40 mb-40 position-relative">';
                                    if ($learn_more_section['description']) {

                                        echo '<div class="col-12">
                                                        <h5 class="learn-more-title title-and-p-padding">' . $learn_more_section['description'] . '</h5> 
                                                    </div>';
                                    }
                                    if ($learn_more_section['button_actions']) {
                                        $specific_width_btn = '';
                                        if (count($learn_more_section['button_actions']) > 1) {
                                            $specific_width_btn = 'specific-width-btn';
                                        }
                                        for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                            $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                            $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                                "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";

                                            if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                                $button_color = 'primary-bg-blue';
                                                $custom_button = 'style="' . $text_color . '"';
                                            } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                                $button_color = 'primary-bg-orrange';
                                                $custom_button = 'style="' . $text_color . '"';
                                            }
                            ?>
                                            <div class="d-flex">
                                                <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" class="primary-btn custom-btn <?php echo $specific_width_btn . ' ' . $button_color; ?>" <?php echo $custom_button; ?>>
                                                    <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] . '' : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                <?php
                                    }
                                    echo '</div>';
                                }
                                ?>

                            <?php
                            }
                            ?>

                            <?php
                            if ($how_we_work_video_thumbnail) {
                                if (is_page_template('isf-story-page.php') || is_page_template('isf-contact-page.php')) {
                                    $display = 'd-none d-sm-block';
                                }
                            ?>
                                <div class="col-md-6 col-sm-12 <?php echo $display; ?>" data-aos="fade-up">
                                    <div class="col position-relative">

                                        <?php
                                        if ($how_we_work_video) {
                                            video_bg_autoplay(str_replace(" ", "", $how_we_work_video), 'how_we_work');
                                        ?>
                                            <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                <div class="icon">
                                                    <?php echo $how_we_work_video_icon; ?>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $how_we_work_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php if ($how_we_work_button) { ?>
                                        <div class="d-flex mt-40">
                                            <a href="<?php echo $how_we_work_button_link['url']; ?>" title="<?php echo $how_we_work_button_link['title']; ?>" target="<?php echo $how_we_work_button_link['target']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?> d-block d-sm-none" <?php echo $custom_button; ?>>
                                                <?php echo $how_we_work_button_icon ? $how_we_work_button_icon . '' : ''; ?> <?php echo $how_we_work_button; ?>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if (!is_page_template('isf-report-and-finance-page.php')) {
                                    ?>
                                        <?php
                                        if ($learn_more_section['description'] || $learn_more_section['button_actions']) {
                                            echo '<div class="d-block d-sm-none col mt-40 position-relative">';
                                            if ($learn_more_section['description']) {

                                                echo '<div class="col-12"><h5 class="learn-more-title title-and-p-padding">' . $learn_more_section['description'] . '</h5> </div>';
                                            }
                                            if ($learn_more_section['button_actions']) {
                                                for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                                    $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                                    $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                                        "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";
                                                    if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                                        $button_color = 'primary-bg-blue';
                                                        $custom_button = 'style="' . $text_color . '"';
                                                    } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                                        $button_color = 'primary-bg-orrange';
                                                        $custom_button = 'style="' . $text_color . '"';
                                                    }
                                        ?>
                                                    <div class="d-flex mt-40">
                                                        <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" class="primary-btn custom-btn " <?php echo $custom_button; ?>>
                                                            <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] . '' : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                        <?php
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                </div>
                            <?php
                                    }
                            ?>

                        </div>
                    <?php
                            }
                            if ($how_we_work_video) {
                                echo video_component($how_we_work_video, $section_video_id = "how_we_work_video");
                            }
                    ?>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    function isf_sustainable_section($post_id, $mobile_class = '')
    {
        $sustainable_section_post = get_field('sustainable_section_post', $post_id);

        if ($sustainable_section_post) {
            $section_background = get_field('sustainable_section_color', $post_id);
            $title = get_the_title($sustainable_section_post);
            $content_post = get_post($sustainable_section_post);
            $content = $content_post->post_content;
            $icons = get_field('sustainable_icon', $sustainable_section_post);

            $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';
        ?>
            <section class="section-padding sdg <?php echo $mobile_class; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row align-items-center">

                            <div class="col-md-5 col-sm-12" data-aos="fade-right">
                                <h2 class="title-and-p-padding">
                                    <?php echo $title; ?>
                                </h2>
                                <div class="description">
                                    <?php
                                    echo $content;
                                    ?>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center" data-aos="fade-up">
                                <div class="col-lg-8 col-md-12 meduim-hide d-none d-sm-flex sdg-item-wrap gap-12 flex-wrap justify-content-center">
                                    <?php
                                    if ($icons) {
                                        grid_sastanable_icons($icons);
                                    }
                                    ?>
                                </div>
                                <div class="col-12 mt-40 flex-wrap d-flex d-sm-none meduim-show grid-meduim gap-12">
                                    <?php
                                    if ($icons) {
                                        grid_sastanable_icons($icons);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    function grid_sastanable_icons($icons)
    {
        for ($i = 0; $i < count($icons); $i++) {
            echo '<div class="sdg-icon"><img class="img-fluid w-100" src="
        ' . $icons[$i]["icon"] . '"/>
        </div>';
        }
    }

    function isf_football_impage_section($post_id, $mobile_class = '')
    {
        $section_id = get_field('football_impage_section_id', $post_id);
        $section = 'football_impage_section_id';
        if ($section_id) {
            $section_background = get_field("football_impage_section_color", $post_id);
            $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';
            echo '<section class="section-padding three_column ' . $mobile_class . '"' . $section_background . '>';
            state_three_column($section_id);
            echo '</section>';
        }
    }

    function isf_football_section($post_id)
    {
        $section_id = get_field('footbal_section_id', $post_id);
        $section = 'footbal_section_id';
        if ($section_id) {
            $section_background = get_field("football_section_color", $post_id);
            $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';
            echo '<section class="section-padding"' . $section_background . '>';
            accordion_section_function($section_id, $section);
            echo '</section>';
        }
    }

    function isf_impact_section($post_id)
    {
        $section_id = get_field('impact_section_id', $post_id);
        if ($section_id) {
            $section_background = get_field("impact_section_color", $post_id);
            $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';
            echo '<section class="section-padding three_column "' . $section_background . '>';
            state_three_column($section_id);
            echo '</section>';
        }
    }

    function isf_community_section($post_id)
    {
        $community_section_id = get_field('community_section_id', $post_id);
        $section = 'community_section_id';
        if ($community_section_id) {
            $section_state_background = get_field("community_section_color", $post_id);

            $section_background = $section_state_background ? 'style="background:' . $section_state_background . '"' : '';
            echo '<section class="section-padding"' . $section_background . '>';
            accordion_section_function($community_section_id, $section);
            echo '</section>';
        }
    }

    function state_three_column($post_id, $btn_class = '')
    {
        $state_title = get_field("state_title", $post_id);
        $state_description = get_field("state_description", $post_id);
        $state_button = get_field("state_section_button_text", $post_id);
        $state_button_link = get_field("state_section_button_url", $post_id);
        $state_button_icon = get_field("state_section_button_icon", $post_id);
        $state_button_color = get_field("button_state_color", $post_id);

        // var_dump($state_button_link);
        // $section_state_background = get_field("section_state_background", $post_id);

        $state_columns_1 = get_field("state_columns_1", $post_id);
        $state_columns_2 = get_field("state_columns_2", $post_id);
        $state_columns_3 = get_field("state_columns_3", $post_id);
        $state_description_column = get_field("state_description_column", $post_id);
        $button_color = !$state_button_color ? "primary-bg-orrange" : "";
        $custom_button = $state_button_color ? 'style="background:' . $state_button_color . '"' : "";
        $column = $state_description_column > 1 ? 'col-12' : 'col-md-6 col-sm-12';

        if ($state_button_color == '#05357b') {
            $button_color = 'primary-bg-blue';
            $custom_button = '';
        } else if ($state_button_color  == '#f25b2a') {
            $button_color = 'primary-bg-orrange';
            $custom_button = '';
        }

        ?>
        <div class="content section-adding-x col-12 state-number" id="number_state">
            <div class="fusion-row">
                <div class="state-wrapper">
                    <div class="row mb-40" data-aos="fade-up">
                        <div class="col-sm-12 <?php echo $column; ?>">
                            <h2 class="title-and-p-padding"><?php echo $state_title; ?></h2>
                            <div class="description<?php echo  $state_description_column > 1 ? '-2' : ''; ?> ">
                                <?php echo $state_description; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row three-box-lists">
                        <div class="col-lg-4 col-md-12 col-sm-12 d-lg-block d-md-flex box-wrapper d-sm-flex  align-items-center p-0" data-aos="fade-up">
                            <?php if ($state_columns_1) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon">
                                    <img class="img-fluid" src="<?php echo $state_columns_1['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8">
                                    <h1 class="m-0 number state-number_field" data-count="<?php echo $state_columns_1['number']; ?>" data-symbol="<?php echo $state_columns_1['number_symbol']; ?>">0</h1>
                                    <p class="m-0"><?php echo $state_columns_1['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 d-lg-block d-md-flex box-wrapper d-sm-flex align-items-center  p-0" data-aos="fade-up">
                            <?php if ($state_columns_2) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon">
                                    <img class="img-fluid" src="<?php echo $state_columns_2['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8">
                                    <h1 class="m-0 number state-number_field" data-count="<?php echo $state_columns_2['number']; ?>" data-symbol="<?php echo $state_columns_2['number_symbol']; ?>">0</h1>
                                    <p class="m-0"><?php echo $state_columns_2['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 d-lg-block box-wrapper d-md-flex d-sm-flex  align-items-center p-0" data-aos="fade-up">
                            <?php if ($state_columns_3) { ?>
                                <div class="col-lg-4 col-md-3 col-sm-4 state_icon">
                                    <img class="img-fluid" src="<?php echo $state_columns_3['icon']; ?>" />
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8">
                                    <h1 class="m-0 number state-number_field" data-count="<?php echo $state_columns_3['number']; ?>" data-symbol="<?php echo $state_columns_3['number_symbol']; ?>">0</h1>
                                    <p class="m-0"><?php echo $state_columns_3['description']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    if ($state_button) { ?>
                        <div class="d-flex meduim-show isf-mt <?php echo $btn_class; ?>">
                            <a href="<?php echo $state_button_link['url']; ?>" target="<?php echo $state_button_link['target']; ?>" title="<?php echo $state_button_link['title']; ?>" class="m-auto primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                <?php echo $state_button_icon ? $state_button_icon . '' : ''; ?> <?php echo $state_button; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
    }
    function accordion_section_function($post_id, $section)
    {
        //section Field
        $accordion_title = get_field("accordion_title", $post_id);
        $accordion_description = get_field("accordion_description", $post_id);
        $accordion_list = get_field("accordion_list", $post_id);
    ?>
        <div class="content section-adding-x col-12">
            <div class="fusion-row">
                <div class="row">
                    <!-- <div class="row"> -->
                    <div class="col-12" data-aos="fade-right">
                        <h2 class="title-and-p-padding">
                            <?php echo $accordion_title; ?>
                        </h2>
                    </div>
                    <div class="col-md-6 col-sm-12" data-aos="fade-right">
                        <div class="description">
                            <?php
                            echo $accordion_description;
                            ?>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-md-5 col-sm-12 mt-sm-20" data-aos="fade-up">

                        <!-- $accordion_list -->
                        <?php
                        if ($accordion_list) {
                        ?>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <?php
                                for ($i = 0; $i < count($accordion_list); $i++) {
                                ?>
                                    <div class="accordion-item accordion-spac">
                                        <h2 class="accordion-header" id="flush-heading<?php echo $i . $section; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i . $section; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $i . $section; ?>">
                                                <?php echo $accordion_list[$i]['title']; ?>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?php echo $i . $section; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $i . $section; ?>" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>
                                                    <?php echo $accordion_list[$i]['description']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <?php
    }

    function isf_education_program_impact_section($post_id, $class = '')
    {
        $education_program_section_id = get_field('education_program_section_id', $post_id);
        if ($education_program_section_id) {
            $section_state_background = get_field("education_program_section_color", $post_id);
            //three Columns
            $section_state_background = $section_state_background ? 'style="background:' . $section_state_background . '"' : '';
            echo '<section class="section-padding three_column ' . $class . '" ' . $section_state_background . '>';
            state_three_column($education_program_section_id);
            echo '</section>';
        }
    }

    // isf_education_program_section
    function isf_education_program_section($post_id, $class = '')
    {
        $education_section_id = get_field("education_section_id", $post_id);
        $section = 'education_section_id';
        if ($education_section_id) {
            $education_section_color = get_field("education_section_color", $post_id);
            $section_background = $education_section_color ? 'style="background:' . $education_section_color . '"' : '';
            echo '<section class="section-padding three_column ' . $class . '" ' . $section_background . '>';
            accordion_section_function($education_section_id, $section);
            echo '</section>';
        }
    }

    //how it start 
    function isf_show_it_start_section($post_id, $class = '', $gallery_title = '')
    {
        $how_it_start_section_id = get_field("how_it_start_section_id", $post_id);
        if ($how_it_start_section_id) {
            $how_it_start_section_color = get_field("how_it_start_section_color", $post_id);

            //section Field
            $how_it_start_title = get_field("how_it_start_title", $how_it_start_section_id);
            $how_it_start_description = get_field("how_it_start_description", $how_it_start_section_id);
            $how_it_start_buttons = get_field("how_it_start_button", $how_it_start_section_id);
            $how_it_start_images = get_field("how_it_start_images", $how_it_start_section_id);

            $section_how_we_are_run_background = $how_it_start_section_color ? 'style="background:' . $how_it_start_section_color . '"' : '';
        ?>
            <section class="section-padding <?php echo $class; ?>" <?php echo $section_how_we_are_run_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row align-items-center">
                            <div class="row mb-40 mb-sm-20">
                                <div class="col-md-6 col-sm-12" data-aos="fade-up">
                                    <h2 class="title-and-p-padding">
                                        <?php echo $how_it_start_title; ?>
                                    </h2>
                                    <div class="description d-none d-sm-block">
                                        <?php
                                        echo $how_it_start_description;
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <!-- $how_it_start_images -->
                                <?php
                                if ($how_it_start_images) {
                                    // grid_photo_gallery($how_it_start_images, $gallery_title);
                                    how_we_are_start_gallery($how_it_start_images, $gallery_title);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mt-40 d-block d-sm-none">
                            <?php
                            echo $how_it_start_description;
                            ?>

                        </div>
                        <?php
                        if ($how_it_start_buttons) {
                            for ($i = 0; $i < count($how_it_start_buttons); $i++) {
                                $button_text_color = $how_it_start_buttons[$i]['button_text_color'] ? 'color:' . $how_it_start_buttons[$i]['button_text_color'] . ";" : "''";
                                $button_color = !$how_it_start_buttons[$i]['button_color'] ? "primary-bg-orrange" : "";
                                $custom_button = $how_it_start_buttons[$i]['button_color']  ? 'style="background:' . $how_it_start_buttons[$i]['button_color'] . $button_text_color . '"' : "";
                                if ($how_it_start_buttons[$i]['button_color'] == '#05357b') {
                                    $button_color = 'primary-bg-blue';
                                    $custom_button = 'style="' . $button_text_color . '"';
                                } else if ($how_it_start_buttons[$i]['button_color']  == '#f25b2a') {
                                    $button_color = 'primary-bg-orrange';
                                    $custom_button = 'style="' . $button_text_color . '"';
                                }
                        ?>
                                <div class="d-flex d-sm-none">
                                    <a href="<?php echo $how_it_start_buttons[$i]['url']['url']; ?>" title="<?php echo $how_it_start_buttons[$i]['url']['title']; ?>" target="<?php echo $how_it_start_buttons[$i]['url']['target']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>> <?php echo $how_it_start_buttons[$i]['icon'] ? $how_it_start_buttons[$i]['name'] . '' : ''; ?> <?php echo $how_it_start_buttons[$i]['name']; ?></a>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    function how_we_are_start_gallery($partnership_images = [], $gallery_title)
    {
        ?>
        <div class="custome-min-width">
            <div class="owl-carousel owl-theme owl-loaded owl-drag we_are_run">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <?php
                        for ($b = 0; $b < count($partnership_images); $b++) {
                        ?>
                            <div class="owl-item">
                                <div class="item">
                                    <?php
                                    if ($partnership_images[$b]) { ?>
                                        <img src="<?php echo wp_get_attachment_image_url($partnership_images[$b], 'full'); ?>" class="img-fluid svg" alt="Partner Logo">
                                    <?php
                                        if ($gallery_title == 'image-title') {
                                            $image_title = get_the_title($partnership_images[$b]);
                                            $image_description = get_the_excerpt($partnership_images[$b]);
                                            echo "<div class='m-40'>";
                                            if ($image_title) {
                                                echo "<div>" . $image_title . ",</div>";
                                            }
                                            if ($image_description) {
                                                echo "<div>" . $image_description . "</div>";
                                            }
                                            echo "</div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                var prev = '<span aria-label="Previous"><svg aria-hidden="true" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7915 30L35.4165 14.375L37.604 16.5625L24.1665 30L37.604 43.4375L35.4165 45.625L19.7915 30Z" fill="#2D2D2D" /><circle cx="30" cy="30" r="28.5" stroke="#2D2D2D" stroke-width="3" /></svg></span>';
                var next = '<span aria-label="Next" class="d-block"><svg aria-hidden="true" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.2085 30L24.5835 45.625L22.396 43.4375L35.8335 30L22.396 16.5625L24.5835 14.375L40.2085 30Z" fill="#2D2D2D" /><circle cx="30" cy="30" r="28.5" transform="rotate(-180 30 30)" stroke="#2D2D2D" stroke-width="3" /></svg></span>';

                var owlMobile = jQuery('.we_are_run');
                owlMobile.owlCarousel({
                    items: 3,
                    loop: true,
                    margin: 24,
                    autoplay: false,
                    autoplayTimeout: 3500,
                    smartSpeed: 1500,
                    autoplayHoverPause: true,
                    dots: false,
                    nav: true,
                    navText: [prev, next],
                    responsive: {
                        0: {
                            items: 2,
                        },
                        400: {
                            items: 2,
                        },
                        740: {
                            items: 3,
                        },
                        940: {
                            items: 3,
                        },
                    },
                });
            });
        </script>
    <?php
    }

    function partner_logo_lists($gallery)
    {
    ?>
        <div id="partnerGalleryCarousel" class="partnerGalleryCarousel carousel" data-bs-ride="carousel">
            <div class="custome-min-width">
                <div class="carousel-inner" role="listbox">
                    <?php for ($i = 0; $i < count($gallery); $i++) { ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="col-4">
                                <div class="">
                                    <?php
                                    echo '<img class="img-fluid img-border-radius" src="' . $gallery[$i] . '"/>';
                                    ?>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-indicators position-relative m-40 mb-0">
                <?php for ($i = 0; $i < count($gallery); $i++) { ?>
                    <button type="button" data-bs-target="#partnerGalleryCarousel" data-bs-slide-to="<?php echo $i; ?>" class="icons <?php echo $i == 0 ? 'active' : '' ?>"></button>
                <?php } ?>
            </div>
        </div>
        <script>
            // $("#partnerGalleryCarousel").carousel('pause');
            let item = document.querySelectorAll('#partnerGalleryCarousel .carousel-item')
            item.forEach((el) => {
                const minPerSlide = 3;
                let next = el.nextElementSibling
                for (var i = 1; i < minPerSlide; i++) {
                    if (!next) {
                        next = item[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })
        </script>
    <?php
    }

    function grid_photo_gallery($images, $gallery_title = '')
    {
        $gallery = $images;
    ?>
        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="custome-min-width">
                <div class="carousel-inner" role="listbox">
                    <?php for ($i = 0; $i < count($gallery); $i++) { ?>
                        <div class="gap-3 carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                            <div class="col-md-4 p-0 col-sm-10">
                                <div class="card">
                                    <div class="card-img">
                                        <?php
                                        $image_title = get_the_title($gallery[$i]);
                                        $image_description = get_the_excerpt($gallery[$i]);
                                        echo '<img class="img-fluid img-border-radius" src="' . wp_get_attachment_image_url($gallery[$i], 'full') . '"/>';
                                        if ($gallery_title != 'no_image_title') {
                                            echo "<div class='m-40 d-none d-sm-block'>";
                                            if ($image_title) {
                                                echo "<div>" . $image_title . ",</div>";
                                            }
                                            if ($image_description) {
                                                echo "<div>" . $image_description . "</div>";
                                            }
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="position-relative d-flex gap-12 m-40 mb-0 d-none d-sm-flex">
                    <a class="carousel-control-prev bg-transparent w-aut" href="#galleryCarousel" role="button" data-bs-slide="prev">
                        <svg aria-hidden="true" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7915 30L35.4165 14.375L37.604 16.5625L24.1665 30L37.604 43.4375L35.4165 45.625L19.7915 30Z" fill="#2D2D2D" />
                            <circle cx="30" cy="30" r="28.5" stroke="#2D2D2D" stroke-width="3" />
                        </svg>
                    </a>
                    <a class="carousel-control-next bg-transparent w-aut" href="#galleryCarousel" role="button" data-bs-slide="next">
                        <svg aria-hidden="true" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M40.2085 30L24.5835 45.625L22.396 43.4375L35.8335 30L22.396 16.5625L24.5835 14.375L40.2085 30Z" fill="#2D2D2D" />
                            <circle cx="30" cy="30" r="28.5" transform="rotate(-180 30 30)" stroke="#2D2D2D" stroke-width="3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <script>
            jQuery(document).ready(function($) {
                let items = document.querySelectorAll('#galleryCarousel .carousel-item');
                var minPerSlide = 3;
                if ($(window).width() <= 768) {
                    minPerSlide = 2;
                }
                items.forEach((el) => {
                    let next = el.nextElementSibling
                    for (var i = 1; i < minPerSlide; i++) {
                        if (!next) {
                            next = items[0]
                        }
                        let cloneChild = next.cloneNode(true)
                        el.appendChild(cloneChild.children[0])
                        next = next.nextElementSibling
                    }
                })
            })
        </script>
        <?php
    }

    function isf_hero_section($post_id)
    {
        $hero_title = get_field('hero_title', $post_id);
        $hero_description = get_field('hero_description', $post_id);
        $hero_button_text = get_field('hero_button_text', $post_id);
        $hero_button_url = get_field('hero_button_url', $post_id);
        $hero_video = get_field('hero_video', $post_id);
        $hero_video_background = get_field('hero_video_background', $post_id);
        $hero_video_mobile_background = get_field('hero_video_mobile_background', $post_id);
        $hero_desktop_image = get_field('hero_desktop_image', $post_id);
        $hero_mobile_image = get_field('hero_mobile_image', $post_id);
        if ($hero_title) {
        ?>
            <div class="d-none d-md-block hero-desktop">
                <div class="px-4 position-relative d-flex flex-wrap justify-content-center hero-section m-auto">
                    <div class="position-absolute h-100 section-adding-x col-12 hero-description">
                        <div class="col-12 h-100 d-flex align-items-center fusion-row">
                            <div class="col-lg-6 col-md-7">
                                <div class="col-12 m-auto hero-wraper" data-aos="fade-right">
                                    <h1 class="secondary-sand mobile-title-and-p-margin mb-20">
                                        <?php echo $hero_title; ?>
                                    </h1>
                                    <p class="secondary-sand">
                                        <?php
                                        echo $hero_description;
                                        ?>
                                    </p>
                                    <div class="mt-60">
                                        <button id="playvideo_hero" type="button" class="hero-btn custom-btn">
                                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.5625 26.25C6.31386 26.25 6.0754 26.1512 5.89959 25.9754C5.72377 25.7996 5.625 25.5611 5.625 25.3125V4.68749C5.62503 4.52458 5.66751 4.36449 5.74825 4.223C5.82899 4.08151 5.94521 3.9635 6.08546 3.8806C6.2257 3.7977 6.38512 3.75278 6.54801 3.75026C6.7109 3.74775 6.87164 3.78772 7.01438 3.86624L25.7644 14.1787C25.9114 14.2597 26.0339 14.3786 26.1193 14.523C26.2047 14.6675 26.2497 14.8322 26.2497 15C26.2497 15.1678 26.2047 15.3325 26.1193 15.477C26.0339 15.6214 25.9114 15.7403 25.7644 15.8212L7.01438 26.1337C6.87595 26.2099 6.72052 26.2499 6.5625 26.25Z" fill="#F25B2A" />
                                            </svg>
                                            <div class="slide-in-bottom">
                                                <div class="" data-hover="<?php echo $hero_button_text; ?>">
                                                    <?php
                                                    echo $hero_button_text;
                                                    ?>
                                                </div>
                                                <!-- <div class=" custom-styles w-embed"></div> -->
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="video-background w-100" id="hero_background">
                        <?php
                        echo  $hero_video_background;
                        ?>
                    </div>
                    <!-- <img class="img-fluid" src="<?php // echo $hero_desktop_image; 
                                                        ?>" /> -->
                </div>
            </div>
            <div class="d-block d-md-none hero-mobile">
                <div class="position-relative d-flex flex-wrap justify-content-center hero-section m-auto">
                    <div class="px-4 position-absolute mobile-hero-wraper h-100 section-adding-x col-12">
                        <div class="col-12 h-100 d-flex align-items-center fusion-row">
                            <div class="col-12">
                                <div class="col-12 m-auto hero-wraper text-center">
                                    <div class="m-40">
                                        <!-- id="playvideo_hero_mobile" -->
                                        <div class="icon" id="playvideo_hero_mobile">
                                            <svg class="mb-40" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M40 0.625031C32.2124 0.625031 24.5996 2.93433 18.1244 7.26091C11.6493 11.5875 6.60246 17.737 3.62226 24.9319C0.642061 32.1267 -0.137696 40.0437 1.3816 47.6817C2.90089 55.3197 6.65099 62.3357 12.1577 67.8423C17.6644 73.349 24.6803 77.0991 32.3183 78.6184C39.9563 80.1377 47.8733 79.358 55.0682 76.3778C62.263 73.3976 68.4125 68.3508 72.7391 61.8756C77.0657 55.4004 79.375 47.7877 79.375 40C79.375 29.5571 75.2266 19.5419 67.8423 12.1577C60.4581 4.77346 50.4429 0.625031 40 0.625031ZM60.9447 42.5172L27.1947 59.3922C26.7658 59.6065 26.2892 59.7076 25.8103 59.6859C25.3313 59.6643 24.8658 59.5205 24.4581 59.2683C24.0503 59.0161 23.7138 58.6638 23.4805 58.2449C23.2471 57.826 23.1248 57.3545 23.125 56.875V23.125C23.1253 22.6458 23.248 22.1746 23.4815 21.7561C23.715 21.3376 24.0516 20.9857 24.4592 20.7339C24.8669 20.482 25.3322 20.3384 25.811 20.3169C26.2897 20.2953 26.766 20.3964 27.1947 20.6107L60.9447 37.4856C61.4112 37.7195 61.8035 38.0785 62.0777 38.5225C62.3518 38.9666 62.497 39.4782 62.497 40C62.497 40.5219 62.3518 41.0335 62.0777 41.4775C61.8035 41.9216 61.4112 42.2806 60.9447 42.5144" fill="#FFFFF6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <h1 class="secondary-sand mobile-title-and-p-margin mt-76">
                                        <?php echo $hero_title; ?>
                                    </h1>
                                    <p class="secondary-sand">
                                        <?php
                                        echo $hero_description;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <?php
                                // echo video_component($hero_video, $id = "playvideo_hero_mobile");
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="video-mobile_background w-100 img-fluid" id="hero_background_mobile">
                        <?php
                        echo  $hero_video_mobile_background;
                        ?>
                    </div>
                    <!-- <img class="img-fluid" src="<?php echo $hero_mobile_image ?>" /> -->
                </div>
            </div>
            <!-- <div class="col"> -->
            <?php
            echo video_hero_component($hero_video);
            //echo video_component($hero_video, $id = "playvideo_hero_mobile");
            ?>
            <!-- </div> -->
        <?php
        }
        $modal = get_field("select_modal", $post_id);
        if ($modal) {
            $modal_title = get_field("modal_title", $modal);
            $modal_description = get_field("modal_description", $modal);
            $modal_button = get_field("button_label", $modal);
            $modal_url = get_field("button_url", $modal);
            $modal_icon = get_field("button_icon", $modal);
            $modal_button_color = get_field("button_color", $modal);
            $modal_button_text_color = get_field("button_text_color", $modal);
            $modal_modal_color = get_field("modal_color", $modal);
            echo custom_modal_function($modal_title, $modal_description, $modal_button, $modal_url, $modal_icon, $modal_button_color, $modal_button_text_color, $modal_modal_color);
        }
    }

    function isf_two_columns_section($post_id, $class, $mobile_class = '', $reverse = '', $readmore = '', $custom_read_more_btn = '', $no_sm_40 = '')
    {
        $two_columns_section_color = get_field("two_columns_section_color", $post_id);
        $two_columns_section_title = get_field("two_columns_section_title", $post_id);
        $two_columns_column = get_field("two_columns_column", $post_id);
        $section_background = $two_columns_section_color ? 'style="background:' . $two_columns_section_color . '"' : '';
        if ($two_columns_column) {
        ?>
            <section class="section-padding two-column <?php echo $mobile_class; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="">
                            <?php
                            if ($two_columns_section_title) {
                            ?>
                                <div class="row" data-aos="fade-up">
                                    <div class="col-md-5 col-sm-12">
                                        <h2 class="title-and-p-padding">
                                            <?php echo $two_columns_section_title; ?>
                                        </h2>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php
                            if ($two_columns_column) {
                                for ($a = 0; $a < count($two_columns_column); $a++) {
                                    $reserse_margin_image = '';
                                    $reserse_margin = '';
                                    if ($a % 2 == 0) {
                                        $newclass = ' meduim-reverse flex-column-reverse flex-md-row ';
                                        $reserse_margin = 'meduim-mt-20 meduim-mb-20 mb-sm-40';
                                        $reserse_margin_image = '';
                                    } else {
                                        $newclass = '';
                                        $reserse_margin = '';
                                        $reserse_margin_image = 'meduim-mb-20';
                                    }
                                    if ($reverse == 'no_revers') {
                                        $newclass = '';
                                        $reserse_margin = '';
                                        $reserse_margin_image = 'meduim-mb-20';
                                    }
                                    if ($no_sm_40) {
                                        $reserse_margin = '';
                                    }

                                    echo '<div class="row ' . $newclass . $class . '" data-aos="fade-up">';
                                    if ($two_columns_column[$a]['column_1']) {
                            ?>
                                        <div class="col-md-6 col-sm-12  <?php echo $reserse_margin . ' ' . $reserse_margin_image; ?>">
                                            <?php
                                            if ($two_columns_column[$a]['column_1']['text']) {
                                                if (!$two_columns_column[$a]['column_1']['image']) {
                                            ?>
                                                    <div class="col-md-11 col-sm-12 p-0">
                                                        <?php echo $two_columns_column[$a]['column_1']['text']; ?>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <?php echo $two_columns_column[$a]['column_1']['text']; ?>
                                                <?php
                                                }
                                            }
                                            if ($two_columns_column[$a]['column_1']['video']) {
                                                video_bg_autoplay(str_replace(" ", "", $two_columns_column[$a]['column_1']['video']), 'custom_col_1');
                                            } else {
                                                if ($two_columns_column[$a]['column_1']['image']) {
                                                ?>
                                                    <img src="<?php echo $two_columns_column[$a]['column_1']['image']; ?>" class="img-fluid img-border-radius" />
                                                <?php
                                                }
                                            }

                                            if ($two_columns_column[$a]['column_1']['video']) { ?>
                                                <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                    <div class="icon">
                                                        <?php echo $two_columns_column[$a]['column_1']['video_icon']; ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if ($two_columns_column[$a]['column_1']['video']) {
                                            echo video_component($two_columns_column[$a]['column_1']['video'], $section_video_id = "how_we_work_video" . $a);
                                        }
                                    }

                                    if ($two_columns_column[$a]['column_2']) {
                                        ?>
                                        <div class="col-md-6 col-sm-12 <?php echo $reserse_margin_image; ?>">
                                            <div class="position-relative">
                                                <?php
                                                if ($two_columns_column[$a]['column_2']['text']) {
                                                    if (!$two_columns_column[$a]['column_2']['image']) {
                                                ?>
                                                        <div class="col-md-11 col-sm-12 p-0 custom-float-right">
                                                            <?php echo $two_columns_column[$a]['column_2']['text']; ?>
                                                        </div>
                                                    <?php
                                                    } else {
                                                        echo $two_columns_column[$a]['column_2']['text'];
                                                    }
                                                }
                                                if ($two_columns_column[$a]['column_2']['video']) {
                                                    video_bg_autoplay(str_replace(" ", "", $two_columns_column[$a]['column_2']['video']), 'column-2');
                                                } else {
                                                    if ($two_columns_column[$a]['column_2']['image']) {
                                                    ?>
                                                        <img src="<?php echo $two_columns_column[$a]['column_2']['image']; ?>" class="img-fluid img-border-radius" />
                                                    <?php
                                                    }
                                                }

                                                if ($two_columns_column[$a]['column_2']['video']) { ?>
                                                    <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                        <div class="icon">
                                                            <?php echo $two_columns_column[$a]['column_2']['video_icon']; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                            <?php
                                        if ($two_columns_column[$a]['column_2']['video']) {
                                            echo video_component($two_columns_column[$a]['column_2']['video'], $section_video_id = "how_we_work_video_2" . $a);
                                        }
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                            <?php
                            if ($readmore != 'no_readmore') {
                            ?>
                                <div class="row">
                                    <?php
                                    isf_learn_more_text_section($post_id, 'text-center', '', '', $custom_read_more_btn);
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }
    function video_bg_autoplay($video, $id = "")
    {
        ?>
        <div class="img-fluid img-border-radius">
            <div style="padding:56.25% 0 0 0;position:relative;">
                <iframe src="<?php echo $video; ?>?muted=1&amp;loop=1&amp;controls=0&amp;autoplay=1&amp;autopause=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" id="<?php echo $id; ?>" data-ready="true">
                </iframe>
            </div>
        </div>
    <?php
    }
    function video_hero_component($video)
    {
        echo '<div id="playvideo_hero-wrapper" class="custom-video-wrapper">';
    ?>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe class="vimeo_video_ifram" src="<?php echo $video; ?>?muted=0&loop=0&controls=1&autoplay=0&autopause=0&playsinline=0" width="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen allowfullscreen="true" id="playvideo_hero_full" data-ready="true">
            </iframe>
        </div>
        <?php
        echo '</div>';
        ?>
        <script>
            jQuery(document).ready(function($) {
                $("#playvideo_hero_mobile , #playvideo_hero").on('click', function() {

                    var iframe = document.querySelector('#playvideo_hero-wrapper iframe');
                    if (iframe) {
                        var player = new Vimeo.Player(iframe);
                        player.play();
                        if (isFullScreen()) {
                            return false;
                        }
                        if (player.requestFullscreen) {
                            player.requestFullscreen();
                        } else if (player.msRequestFullscreen) {
                            player.msRequestFullscreen();
                        } else if (player.mozRequestFullScreen) {
                            player.mozRequestFullScreen();
                        } else if (player.webkitRequestFullscreen) {
                            player.webkitRequestFullscreen();
                        }

                        player.on("ended", function(e) {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            } else if (document.msExitFullscreen) {
                                document.msExitFullscreen();
                            } else if (document.mozCancelFullScreen) {
                                document.mozCancelFullScreen();
                            } else if (document.webkitExitFullscreen) {
                                document.webkitExitFullscreen();
                            }
                            showModalCallAction("isfModal");
                            player.off();
                        });

                        player.on("fullscreenchange", function(e) {
                            if (!e.fullscreen) {
                                showModalCallAction("isfModal");
                                player.pause();
                                player.off();
                            }
                        })
                    }
                });

                function isFullScreen() {
                    return Boolean(
                        document.fullscreenElement ||
                        document.webkitFullscreenElement ||
                        document.mozFullScreenElement ||
                        document.msFullscreenElement
                    );
                }

                function showModalCallAction(data) {
                    $('#' + data).addClass("show");
                    $('#' + data).toggle();
                }
            });
        </script>
    <?php
    }
    function video_component($video, $button, $mobilebtn = '')
    {
        echo '<div id="' . $button . '-wrapper" class="custom-video-wrapper">';
    ?>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe class="vimeo_video_ifram" src="<?php echo $video; ?>?muted=0&loop=0&controls=1&autoplay=0&autopause=0&playsinline=0" width="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen allowfullscreen="true" id="<?php echo $button; ?>" data-ready="true">
            </iframe>
        </div>
        <?php
        echo '</div>';
        ?>
        <script>
            jQuery(document).ready(function($) {
                var button = '#<?php echo $button; ?>';
                var buttonname = '';
                $(button).on('click', function() {
                    buttonname = $(this).attr('id');
                    var iframe = document.querySelector('#' + buttonname + '-wrapper iframe');
                    if (iframe) {
                        var player = new Vimeo.Player(iframe);
                        player.play();
                        if (isFullScreen()) {
                            return false;
                        }
                        if (player.requestFullscreen) {
                            player.requestFullscreen();
                        } else if (player.msRequestFullscreen) {
                            player.msRequestFullscreen();
                        } else if (player.mozRequestFullScreen) {
                            player.mozRequestFullScreen();
                        } else if (player.webkitRequestFullscreen) {
                            player.webkitRequestFullscreen();
                        }

                        player.on("ended", function(e) {
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            } else if (document.msExitFullscreen) {
                                document.msExitFullscreen();
                            } else if (document.mozCancelFullScreen) {
                                document.mozCancelFullScreen();
                            } else if (document.webkitExitFullscreen) {
                                document.webkitExitFullscreen();
                            }
                            player.off();
                        });

                        player.on("fullscreenchange", function(e) {
                            if (!e.fullscreen) {
                                player.pause();
                                player.off();
                            }
                        })
                    }
                });

                function isFullScreen() {
                    return Boolean(
                        document.fullscreenElement ||
                        document.webkitFullscreenElement ||
                        document.mozFullScreenElement ||
                        document.msFullscreenElement
                    );
                }
            });
        </script>
    <?php
    }

    function
    custom_modal_function(
        $modal_title = '',
        $modal_description = '',
        $modal_button = '',
        $modal_url = '',
        $modal_icon = '',
        $modal_button_color = '',
        $modal_button_text_color = '',
        $modal_modal_color = ''
    ) {
    ?>
        <!-- Modal -->
        <div class="modal fade" id="isfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" style="background: <?php echo $modal_modal_color ?>;">
                    <div class="d-flex justify-content-end">

                        <button type="button" class="close close_modal_home" data-dismiss="modal" aria-label="Close">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/carbon_close-large.svg'; ?>" />
                        </button>

                    </div>

                    <div class="modal-body text-center">
                        <div class="col-11">
                            <h2 class="primary-gray mb-20" id="isfModalTitle"><?php echo $modal_title; ?></h2>
                        </div>
                        <p class="primary-gray">
                            <?php
                            echo $modal_description;
                            ?>
                        </p>
                        <div class="d-flex mt-40 modal-donation-btn">
                            <!-- style="background:<?php echo $modal_button_color; ?>" -->
                            <a href="<?php echo $modal_url['url']; ?>" title="<?php echo $modal_url['title']; ?>" target="<?php echo $modal_url['target']; ?>" class="btn-donation-modal primary-btn custom-btn m-auto">
                                <?php
                                echo $modal_icon;
                                echo $modal_button;
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $(".close_modal_home").on('click', function(e) {
                    $('#isfModal').removeClass("show");
                    $('#isfModal').toggle();
                })
            })
        </script>
        <?php
    }

    // how we work
    function how_we_work_section($post_id, $form = '', $class = '', $header_padding = '', $btn_read_more = '', $md_column = '')
    {
        // how we work section
        $how_we_work_title = get_field("how_we_work_title", $post_id);
        $how_we_work_description = get_field("how_we_work_description", $post_id);
        $how_we_work_button = get_field("how_we_work_button", $post_id);
        $how_we_work_button_link = get_field("how_we_work_button_link", $post_id);
        $how_we_work_button_color = get_field("how_we_work_button_color", $post_id);
        $how_we_work_button_icon = get_field("how_we_work_button_icon", $post_id);
        $how_we_work_video = get_field("how_we_work_video", $post_id);
        $how_we_work_video = str_replace(" ", "", $how_we_work_video);
        $how_we_work_video_background = get_field("how_we_work_video_background", $post_id);
        $how_we_work_video_icon = get_field("how_we_work_video_icon", $post_id);
        $how_we_work_video_thumbnail = get_field("how_we_work_video_thumbnail", $post_id);
        $section_background = get_field("section_background", $post_id);

        $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';

        //Learn more section
        $learn_more_section = get_field("learn_more_section", $post_id);

        $button_color = !$how_we_work_button_color ? "primary-bg-orrange" : "";
        $custom_button = $how_we_work_button_color ? 'style="background:' . $how_we_work_button_color . '"' : '';
        $add_class = $class ? $class : 'align-items-center';
        if ($how_we_work_button_color == '#05357b') {
            $button_color = 'primary-bg-blue ';
            $custom_button = '';
        } else if ($how_we_work_button_color == '#f25b2a') {
            $button_color = 'primary-bg-orrange ';
            $custom_button = '';
        }
        if ($how_we_work_title) {
        ?>
            <section class="section-padding <?php echo $header_padding; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row <?php echo $add_class ?>">
                            <div class="col-md-5 col-sm-12 " data-aos="fade-right">
                                <h2 class="title-and-p-padding">
                                    <?php echo $how_we_work_title; ?>
                                </h2>
                                <?php
                                $display = '';
                                if (is_page_template('isf-story-page.php')) {
                                    $display = 'd-none meduim-show d-sm-block';
                                ?>
                                    <div class="col-md-6 col-sm-12 d-block d-sm-none p-0 mb-40">
                                        <div class="col position-relative">
                                            <?php if ($how_we_work_video) {
                                                video_bg_autoplay($how_we_work_video, $id = 'how_we_work');
                                            ?>

                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?php echo $how_we_work_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                            <?php
                                            }
                                            ?>
                                            <?php if ($how_we_work_video) { ?>
                                                <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                    <div class="icon">
                                                        <?php echo $how_we_work_video_icon; ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                echo $how_we_work_description;

                                if ($how_we_work_button) {
                                ?>
                                    <div class="mt-40 d-none d-sm-flex meduim-hide">
                                        <a href="<?php echo $how_we_work_button_link['url']; ?>" title="<?php echo $how_we_work_button_link['title']; ?>" target="<?php echo $how_we_work_button_link['target']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                            <?php echo $how_we_work_button_icon ? $how_we_work_button_icon . '' : ''; ?> <?php echo $how_we_work_button; ?>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="d-none meduim-hide d-sm-block">
                                    <?php
                                    if ($learn_more_section) {
                                        if ($learn_more_section['description']) {
                                            echo "<div class='my-30'>";
                                            echo "<h5 class='learn-more-title title-and-p-padding'>" . $learn_more_section['description'] . "</h5>";
                                            echo "</div>";
                                        }
                                        if ($learn_more_section['button_actions']) {
                                            $specific_width_btn = '';
                                            if (count($learn_more_section['button_actions']) > 1) {
                                                $specific_width_btn = 'specific-width-btn';
                                            }
                                            for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                                $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                                $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                                    "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";

                                                if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                                    $button_color = 'primary-bg-blue ';
                                                    $custom_button = 'style="' . $text_color . '"';
                                                } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                                    $button_color = 'primary-bg-orrange ';
                                                    $custom_button = 'style="' . $text_color . '"';
                                                }
                                    ?>
                                                <div class="d-flex <?php echo $specific_width_btn . '-mb'; ?>">
                                                    <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" class="primary-btn custom-btn <?php echo  $specific_width_btn . ' ' . $button_color . ' ' . $btn_read_more; ?>" <?php echo $custom_button; ?>>
                                                        <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] . '' : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                                <?php
                                $display = '';
                                if (is_page_template('isf-contact-page.php')) {
                                    $display = 'd-none d-sm-block';
                                ?>
                                    <div class="col-md-6 col-sm-12 d-block d-sm-none meduim-show p-0 mb-40" data-aos="fade-up">
                                        <div class="col position-relative">
                                            <?php if ($how_we_work_video) {
                                                video_bg_autoplay($how_we_work_video, $id = "how_we_work_mobile");
                                            } else {
                                            ?>
                                                <img src="<?php echo $how_we_work_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                            <?php } ?>
                                            <?php if ($how_we_work_video) { ?>
                                                <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                    <div class="icon">
                                                        <?php echo $how_we_work_video_icon; ?>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($form && $form == "contact-form") {
                                    //   do contact form here 
                                ?>
                                    <h3>General inquiries</h3>
                                    <div class="form-group">
                                        <?php echo do_shortcode('[contact-form-7 id="0eed96e" title="Contact form"]'); ?>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="col-md-1 d-none d-sm-flex meduim-show"></div>
                            <?php
                            if (is_page_template('isf-report-and-finance-page.php')) {
                                if ($learn_more_section['button_actions'] || $learn_more_section['description']) {
                                    echo '<div class="meduim-show ' . $md_column . ' d-block d-sm-none col m-40 mb-40 position-relative">';
                                    if ($learn_more_section['description']) {

                                        echo '<div class="col-12">
                                                        <h5 class="learn-more-title title-and-p-padding">' . $learn_more_section['description'] . '</h5> 
                                                    </div>';
                                    }
                                    if ($learn_more_section['button_actions']) {
                                        $specific_width_btn = '';
                                        if (count($learn_more_section['button_actions']) > 1) {
                                            $specific_width_btn = 'specific-width-btn';
                                        }
                                        for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                            $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                            $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                                "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";

                                            if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                                $button_color = 'primary-bg-blue';
                                                $custom_button = 'style="' . $text_color . '"';
                                            } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                                $button_color = 'primary-bg-orrange';
                                                $custom_button = 'style="' . $text_color . '"';
                                            }
                            ?>
                                            <div class="d-flex <?php echo $specific_width_btn . '-mb'; ?>">
                                                <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" class="primary-btn custom-btn <?php echo  $specific_width_btn . ' ' . $button_color; ?>" <?php echo $custom_button; ?>>
                                                    <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] . '' : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                <?php
                                    }
                                    echo '</div>';
                                }
                                ?>
                            <?php
                            }
                            ?>
                            <?php
                            if ($how_we_work_video_thumbnail) {
                                if (is_page_template('isf-story-page.php') || is_page_template('isf-contact-page.php')) {
                                    $display = 'd-none d-sm-block meduim-hide';
                                }
                            ?>
                                <div class="col-md-6 col-sm-12 <?php echo $display; ?>" data-aos="fade-up">
                                    <div class="col position-relative">
                                        <?php if ($how_we_work_video) {
                                            video_bg_autoplay($how_we_work_video, "how_we_work_meduim");
                                        } else {
                                        ?>
                                            <img src="<?php echo $how_we_work_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                        <?php } ?>
                                        <?php if ($how_we_work_video) { ?>
                                            <div id="how_we_work_video" class="video-icon d-flex justify-content-center align-items-center">
                                                <div class="icon">
                                                    <?php echo $how_we_work_video_icon; ?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php if ($how_we_work_button) { ?>
                                        <div class="mt-40 d-flex meduim-show d-sm-none justify-content-center">
                                            <a href="<?php echo $how_we_work_button_link['url']; ?>" target="<?php echo $how_we_work_button_link['target']; ?>" title="<?php echo $how_we_work_button_link['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?> " <?php echo $custom_button; ?>>
                                                <?php echo $how_we_work_button_icon ? $how_we_work_button_icon . '' : ''; ?> <?php echo $how_we_work_button; ?>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    if (!is_page_template('isf-report-and-finance-page.php')) {
                                    ?>
                                        <?php
                                        if ($learn_more_section['description'] || $learn_more_section['button_actions']) {
                                            echo '<div class="readmore d-block d-sm-none meduim-show col mt-40 position-relative">';
                                            if ($learn_more_section['description']) {

                                                echo '<div class="col-12"><h5 class="learn-more-title title-and-p-padding">' . $learn_more_section['description'] . '</h2> </div>';
                                            }
                                            if ($learn_more_section['button_actions']) {
                                                $specific_width_btn = '';
                                                if (count($learn_more_section['button_actions']) > 1) {
                                                    $specific_width_btn = 'specific-width-btn';
                                                }
                                                for ($i = 0; $i < count($learn_more_section['button_actions']); $i++) {
                                                    $text_color = $learn_more_section['button_actions'][$i]['button_text_color'] ? 'color:' . $learn_more_section['button_actions'][$i]['button_text_color'] : "";
                                                    $custom_button = $learn_more_section['button_actions'][$i]['button_color'] ?
                                                        "style='background-color:" . $learn_more_section['button_actions'][$i]['button_color'] . ";" . $text_color . "'"  : "";
                                                    if ($learn_more_section['button_actions'][$i]['button_color'] == '#05357b') {
                                                        $button_color = 'primary-bg-blue';
                                                        $custom_button = 'style="' . $text_color . '"';
                                                    } else if ($learn_more_section['button_actions'][$i]['button_color'] == '#f25b2a') {
                                                        $button_color = 'primary-bg-orrange';
                                                        $custom_button = 'style="' . $text_color . '"';
                                                    }
                                        ?>
                                                    <div class="d-flex <?php echo $specific_width_btn . '-mb'; ?>">
                                                        <a href="<?php echo $learn_more_section['button_actions'][$i]['button_url']['url']; ?>" target="<?php echo $learn_more_section['button_actions'][$i]['button_url']['target']; ?>" title="<?php echo $learn_more_section['button_actions'][$i]['button_url']['title']; ?>" class="primary-btn custom-btn <?php echo $specific_width_btn; ?> " <?php echo $custom_button; ?>>
                                                            <?php echo $learn_more_section['button_actions'][$i]['button_icon'] ? $learn_more_section['button_actions'][$i]['button_icon'] : ''; ?> <?php echo $learn_more_section['button_actions'][$i]['button_text']; ?>
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                        <?php
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                </div>
                            <?php
                                    }
                            ?>

                        </div>
                    <?php
                            }
                            if ($how_we_work_video) {
                                echo video_component($how_we_work_video, $section_video_id = "how_we_work_video");
                            }
                    ?>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    //how_we_are_run_section
    function how_we_are_run_section($post_id, $post, $mobile_class = '')
    {
        //how we are run
        $how_we_are_run_title = get_field("how_we_are_run_title", $post_id);
        $how_we_are_run_description = get_field("how_we_are_run_description", $post_id);
        $how_we_are_run_button = get_field("how_we_are_run_button", $post_id);
        $how_we_are_run_button_link = get_field("how_we_are_run_button_link", $post_id);
        $how_we_are_run_button_color = get_field("how_we_are_run_button_color", $post_id);
        $how_we_are_run_button_icon = get_field("how_we_are_run_button_icon", $post_id);
        $how_we_are_run_video = get_field("how_we_are_run_video", $post_id);
        $how_we_are_run_video = str_replace(" ", "", $how_we_are_run_video);
        $how_we_are_run_video_icon = get_field("how_we_are_run_video_icon", $post_id);
        $how_we_are_run_video_thumbnail = get_field("how_we_are_run_video_thumbnail", $post_id);
        $section_how_we_are_run_background = get_field("how_we_are_run_section_color", $post);
        $section_how_we_are_run_background = $section_how_we_are_run_background ? $section_how_we_are_run_background : get_field("section_how_we_are_run_background", $post_id);
        $how_we_are_run_ceo = get_field("how_we_are_run_ceo", $post_id);
        $how_we_are_run_quot = get_field("how_we_are_run_quot", $post_id);
        $button_color = !$how_we_are_run_button_color ? "primary-bg-orrange" : "";
        $custom_button = $how_we_are_run_button_color ? 'style="background:' . $how_we_are_run_button_color . '"' : "";
        $section_bg = $section_how_we_are_run_background
            ? 'style="background:' . $section_how_we_are_run_background . '"' : "";

        if ($how_we_are_run_button_color == '#05357b') {
            $button_color = 'primary-bg-blue';
            $custom_button = '';
        } else if ($how_we_are_run_button_color == '#f25b2a') {
            $button_color = 'primary-bg-orrange';
            $custom_button = '';
        }

        if ($how_we_are_run_title) {
        ?>
            <section class="section-padding how-we-run <?php echo $mobile_class; ?>" <?php echo $section_bg; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row meduim-reverse flex-column-reverse flex-sm-row align-items-center">
                            <div class="col-md-6 col-sm-12" data-aos="fade-up">
                                <div class="position-relative">
                                    <?php if ($how_we_are_run_video) {
                                        video_bg_autoplay(str_replace(" ", "", $how_we_are_run_video), 'how_we_run');
                                    } else {
                                        if ($how_we_are_run_video_thumbnail) {
                                    ?>
                                            <img src="<?php echo $how_we_are_run_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if ($how_we_are_run_video) {
                                    ?>
                                        <div id="how_we_are_run_video" class="video-icon d-flex justify-content-center align-items-center">
                                            <div class="icon">
                                                <?php echo $how_we_are_run_video_icon; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if ($how_we_are_run_quot) { ?>
                                    <div class="quote">
                                        <div class="d-flex mt-40">
                                            <span class="quote primary-orrange">“</span>
                                            <p class="quote-description">
                                                <?php echo $how_we_are_run_quot; ?>
                                            </p>
                                        </div>
                                        <p class="text-end m-0">
                                            <?php echo $how_we_are_run_ceo; ?>
                                        </p>
                                    </div>
                                <?php } ?>
                                <div class="d-flex mt-40 d-sm-none meduim-show">
                                    <a href="<?php echo $how_we_are_run_button_link['url']; ?>" target="<?php echo $how_we_are_run_button_link['target']; ?>" title="<?php echo $how_we_are_run_button_link['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $how_we_are_run_button_icon . ''; ?> <?php echo $how_we_are_run_button; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5 col-sm-12">
                                <h2 class="title-and-p-padding"><?php echo $how_we_are_run_title; ?></h2>
                                <?php echo $how_we_are_run_description; ?>
                                <div class="mt-40 d-none d-sm-flex meduim-hide ">
                                    <a href="<?php echo $how_we_are_run_button_link['url']; ?>" target="<?php echo $how_we_are_run_button_link['target']; ?>" title="<?php echo $how_we_are_run_button_link['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $how_we_are_run_button_icon . ''; ?> <?php echo $how_we_are_run_button; ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                            echo video_component($how_we_are_run_video, $section_video_id = "how_we_are_run_video");
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    //state_number_three_columns_section
    function state_number_three_columns_section($post_id, $class = '', $btn_class = '')
    {
        $state_number_section_id = get_field('state_number_section_id', $post_id);

        if ($state_number_section_id) {
            //three Columns
            $section_state_background = get_field("section_state_background", $state_number_section_id);
            $section_state_background = $section_state_background ? 'style="background:' . $section_state_background . '"' : '';
            echo '<section class="section-padding three_column ' . $class . '"' . $section_state_background . '>';
            state_three_column($state_number_section_id, $btn_class);
            echo '</section>';
        }
    }

    // isf_four_columns_section
    function isf_four_columns_section($post_id, $class = '')
    {
        //how we are run
        $four_column_title = get_field("4_columns_title", $post_id);
        $four_column_description = get_field("4_columns_description", $post_id);
        $four_column_button = get_field("4_columns_button_text", $post_id);
        $four_column_button_link = get_field("4_columns_button_url", $post_id);
        $four_column_button_icon = get_field("4_columns_button_icon", $post_id);
        $four_column_button_color = get_field("4_columns_button_color", $post_id);
        $four_column_background = get_field("4_columns_background", $post_id);

        $four_column_columns_1 = get_field("4_columns_columns_1", $post_id);
        $four_column_columns_2 = get_field("4_columns_columns_2", $post_id);
        $four_column_columns_3 = get_field("4_columns_columns_3", $post_id);
        $four_column_columns_4 = get_field("4_columns_columns_4", $post_id);

        $button_color = !$four_column_button_color ? "primary-bg-orrange custom-btn" : "";
        $custom_button = $four_column_button_color ? 'style="background:' . $four_column_button_color . '"' : "";

        $four_column_background = $four_column_background ? 'style="background:' . $four_column_background . '"' : '';

        if ($four_column_background == '#05357b') {
            $button_color = 'primary-bg-blue';
            $custom_button = '';
        } else if ($four_column_background == '#f25b2a') {
            $button_color = 'primary-bg-orrange';
            $custom_button = '';
        }

        if ($four_column_title) {
        ?>
            <section class="section-padding four-boxes <?php echo $class; ?>" <?php echo $four_column_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row-wraper">
                            <div class="row" data-aos="fade-up">
                                <div class="col-md-6 col-sm-12">
                                    <h2 class="title-and-p-padding"><?php echo $four_column_title; ?></h2>
                                    <p>
                                        <?php echo $four_column_description; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-20 box-lists">
                                <div class="col-lg-3 col-md-12 col-sm-12 flex-column-reverse flex-sm-row" data-aos="fade-up">
                                    <?php if ($four_column_columns_1) { ?>
                                        <div class="col-12 d-flex">
                                            <div class="image-wraper col-md-12 col-sm-11">
                                                <img src="<?php echo $four_column_columns_1['image']; ?>" class="img-fluid" />
                                            </div>
                                            <div class="col-1 d-sm-none meduim-show d-flex align-items-end">
                                                <div class="position-absolute icon-arrow  d-sm-none meduim-show d-flex">
                                                    <img src="<?php echo $four_column_columns_1['arrow_icon_mobile']; ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-12">
                                            <h4 class="title-and-p-padding"><?php echo $four_column_columns_1['title']; ?></h4>
                                            <p><?php echo $four_column_columns_1['description']; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12 flex-column-reverse flex-sm-row" data-aos="fade-up">
                                    <?php if ($four_column_columns_2) { ?>
                                        <div class="col-12 d-flex">
                                            <div class="col-1 d-flex d-sm-none meduim-show d-flex">
                                                <div class="position-absolute icon-arrow d-sm-none meduim-show d-flex">
                                                    <img src="<?php echo $four_column_columns_2['arrow_icon_mobile']; ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                            <div class="image-wraper col-md-12 col-sm-11">
                                                <img src="<?php echo $four_column_columns_2['image']; ?>" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-12">
                                            <h4 class="title-and-p-padding"><?php echo $four_column_columns_2['title']; ?></h4>
                                            <p><?php echo $four_column_columns_2['description']; ?></p>
                                        </div>

                                    <?php } ?>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12 flex-column-reverse flex-sm-row" data-aos="fade-up">
                                    <?php if ($four_column_columns_3) { ?>
                                        <div class="col-12 d-flex">
                                            <div class="image-wraper col-md-12 col-sm-11">
                                                <img src="<?php echo $four_column_columns_3['image']; ?>" class="img-fluid" />
                                            </div>
                                            <div class="col-1 d-sm-none meduim-show d-flex">
                                                <div class="position-absolute icon-arrow d-sm-none meduim-show d-flex">
                                                    <img src="<?php echo $four_column_columns_3['arrow_icon_mobile']; ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-12">
                                            <h4 class="title-and-p-padding"><?php echo $four_column_columns_3['title']; ?></h4>
                                            <p><?php echo $four_column_columns_3['description']; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12 flex-column-reverse flex-sm-row" data-aos="fade-up">
                                    <?php if ($four_column_columns_4) { ?>
                                        <div class="col-12 d-flex">
                                            <div class="col-1 d-sm-none meduim-show d-flex">
                                                <div class="position-absolute icon-arrow  d-sm-none meduim-show d-flex">
                                                    <img src="<?php echo $four_column_columns_4['arrow_icon_mobile']; ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                            <div class="image-wraper col-md-12 col-sm-11">
                                                <img src="<?php echo $four_column_columns_4['image']; ?>" class="img-fluid" />
                                            </div>
                                        </div>
                                        <div class="col-12"></div>
                                        <div class="col-12">
                                            <h4 class="title-and-p-padding"><?php echo $four_column_columns_4['title']; ?></h4>
                                            <p><?php echo $four_column_columns_4['description']; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex mt-40">
                                    <a href="<?php echo $four_column_button_link['url']; ?>" target="<?php echo $four_column_button_link['target']; ?>" title="<?php echo $four_column_button_link['title']; ?>" class="m-auto primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $four_column_button_icon ? $four_column_button_icon . '' : ''; ?> <?php echo $four_column_button; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    function isf_partnership_section($post_id, $class = '', $mobile = '', $logo = '', $ishome = "")
    {
        $partnership = get_field("partner_section_page", $post_id);
        if ($partnership) {
            $section_background = get_field("partnership_section_bg", $post_id);
            $partnership_gallery_button_color = get_field("partnership_gallery_button_color", $post_id);
            $partnership_gallery_button_active_color = get_field("partnership_gallery_button_active_color", $post_id);

            $title = get_field("title", $partnership);
            $partnership_description = get_field("description", $partnership);
            $partnership_button = get_field("button_text", $partnership);
            $partnership_url = get_field("button_url", $partnership);
            $partnership_icon = get_field("button_icon", $partnership);
            $partnership_button_color = get_field("button_color", $partnership);
            $partnership_button_text_color = get_field("button_text_color", $partnership);
            $partnership_images = get_field("images", $partnership);

            $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';

            $button_color = !$partnership_button_color ? "primary-bg-orrange" : "";
            $custom_button = $partnership_button_color ? 'style="background:' . $partnership_button_color . '"' : '';

            if ($partnership_button_color == '#05357b') {
                $button_color = 'primary-bg-blue';
                $custom_button = '';
            } else if ($partnership_button_color == '#f25b2a') {
                $button_color = 'primary-bg-orrange';
                $custom_button = '';
            }
        ?>
            <section class="section-padding <?php echo $class; ?> <?php echo $mobile == 'mobile-only' ? 'd-block d-sm-none' : '';
                                                                    ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row meduim-reverse align-items-center justify-content-beetween">
                            <div class="col-lg-5 col-md-5 col-sm-12 <?php if (!$ishome) {
                                                                        echo 'meduim-mt-40';
                                                                    } ?>">
                                <h2 class="title-and-p-padding">
                                    <?php echo $title; ?>
                                </h2>
                                <p><?php echo $partnership_description; ?></p>
                                <div class="mt-40 d-lg-flex d-md-none d-sm-none meduim-show md-partner-btn">
                                    <a href="<?php echo $partnership_url['url']; ?>" target="<?php echo $partnership_url['target']; ?>" title="<?php echo $partnership_url['title']; ?>" class="primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $partnership_icon ? $partnership_icon . '' : ''; ?> <?php echo $partnership_button; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <?php
                                owl_slider_gallery($post_id, $partnership_images, $partnership_gallery_button_color, $partnership_gallery_button_active_color);
                                ?>
                                <div class="justify-content-center mt-40 d-none d-lg-none d-md-flex d-sm-flex meduim-hide sm-partner-btn">
                                    <a href="<?php echo $partnership_url['url']; ?>" target="<?php echo $partnership_url['target']; ?>" title="<?php echo $partnership_url['title']; ?>" class="primary-btn custom-btn mobile-primary-orrang <?php echo $button_color; ?>" <?php echo $custom_button; ?>>
                                        <?php echo $partnership_icon ? $partnership_icon . '' : ''; ?> <?php echo $partnership_button; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }
    function owl_slider_gallery_mobile($post_id = '', $partnership_images = [], $partnership_gallery_button_color = '', $partnership_gallery_button_active_color = '')
    {
        ?>
        <div class="custome-min-width partner-logo">
            <div class="owl-carousel owl-mobile owl-theme owl-loaded owl-drag d-block d-sm-none ">
                <div class="owl-stage-outer pl-25">
                    <div class="owl-stage">
                        <?php
                        for ($b = 0; $b < count($partnership_images); $b++) {
                        ?>
                            <div class="owl-item">
                                <div class="item">
                                    <?php
                                    if ($partnership_images[$b]) { ?>
                                        <img src="<?php echo $partnership_images[$b]; ?>" class="img-fluid svg" alt="Partner Logo">

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                var owlMobile = jQuery('.owl-mobile');
                owlMobile.owlCarousel({
                    items: 3,
                    loop: true,
                    margin: 20,
                    autoplay: true,
                    autoplayTimeout: 3500,
                    autoplayHoverPause: true
                });

            });
        </script>
    <?php
    }

    function owl_slider_gallery($post_id = '', $partnership_images = [], $partnership_gallery_button_color = '', $partnership_gallery_button_active_color = '')
    {
        $partner = array_chunk($partnership_images, 6);
    ?>
        <div class="owl-carousel owl-desktop owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <?php
                    for ($i = 0; $i < count($partner); $i++) {
                    ?>
                        <div class="owl-item">
                            <div class="item">
                                <div class="row">
                                    <?php
                                    $items = count($partner[$i]);
                                    $count = count($partner[$i]) < 6 ? 6 : count($partner[$i]);
                                    for ($a = 0; $a < $count; $a++) { ?>
                                        <div class="col-6 d-flex align-items-center justify-content-center">
                                            <div class="col-12 p-3 partner-wrapper d-flex align-items-center justify-content-center">
                                                <?php
                                                if ($a < $items) {
                                                    if ($partner[$i][$a]) { ?>
                                                        <img src="<?php echo $partner[$i][$a]; ?>" class="img-fluid svg" alt="Partner Logo">
                                                <?php }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function() {
                var owl = jQuery('.owl-desktop');
                owl.owlCarousel({
                    items: 1,
                    loop: true,
                    smartSpeed: 1500,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 3500,
                    autoplayHoverPause: true
                });
            });
        </script>
        <?php
    }

    // isf_remark_story_section
    function isf_remark_story_section($post_id, $class = '', $quot = '')
    {
        $story = get_field("story_section_post", $post_id);
        if ($story) {

            $section_background = get_field('story_section_background_color', $post_id);
            $section_title = get_field('story_section_title', $post_id);
            $story_link_label = get_field('story_section_link_label', $post_id);
            $story_link_url = get_field('story_link', $story);
            // $story_link_url = get_permalink($story_id);

            //get story fields
            $story_quote = get_field('quote', $story);
            $story_quote_icon = get_field('quote_icon', $story);
            $story_video = get_field('video', $story);
            $story_video = str_replace(" ", "", $story_video);
            $story_video_icon = get_field('video_icon', $story);
            $story_video_thumbnail = get_field('video_thumbnail', $story);
            $section_video_id = "story_section_video";
            $section_background = $section_background ? 'style="background:' . $section_background . '"' : '';
        ?>
            <section class="section-padding <?php echo $class; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-sm-12 m-auto">
                                <div class="col d-flex justify-content-center">
                                    <div class="col-md-10 col-sm-12 m-auto p-0" data-aos="fade-up">
                                        <h2 class="title-and-p-padding">
                                            <?php echo $section_title; ?>
                                        </h2>
                                        <div class="quote">
                                            <div class="d-flex">
                                                <?php if ($story_quote_icon == 'Yes') {
                                                ?>
                                                    <span class="quote primary-orrange">“</span>
                                                <?php } ?>

                                                <p class="quote-description">
                                                    <?php echo $story_quote; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative" data-aos="fade-up">
                                    <?php if ($story_video) { ?>
                                        <div class="img-fluid img-border-radius">
                                            <div style="padding:56.25% 0 0 0;position:relative;">
                                                <iframe src="<?php echo $story_video; ?>?muted=1&amp;loop=1&amp;controls=0&amp;autoplay=1&amp;autopause=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" id="player_6" data-ready="true">
                                                </iframe>
                                            </div>
                                        </div>
                                        <div id="<?php echo $section_video_id; ?>" class="video-icon d-flex justify-content-center align-items-center">
                                            <div class="icon">
                                                <?php echo $story_video_icon; ?>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        if ($story_video_thumbnail) {
                                        ?>
                                            <img src="<?php echo $story_video_thumbnail; ?>" class="img-fluid img-border-radius" />
                                    <?php }
                                    } ?>

                                    <?php
                                    echo video_component($story_video, $section_video_id);
                                    ?>
                                </div>
                                <?php
                                if ($story_link_url) {
                                ?>
                                    <div class="col-12 d-flex justify-content-center" data-aos="fade-up">
                                        <div class="m-40 mb-0 isf-link-wraper">
                                            <a class="isf-link" href="<?php echo $story_link_url['url']; ?>" target="<?php echo $story_link_url['target']; ?>" title="<?php echo $story_link_url['title']; ?>">
                                                <div class="slide-in-bottom">
                                                    <div class="" data-hover=" <?php echo $story_link_label; ?>">
                                                        <?php echo $story_link_label; ?>
                                                    </div>
                                                    <div class=" custom-styles w-embed"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    //isf_contribution_section
    function isf_contribution_section($post_id)
    {
        $ctb_post = get_field("contribution_section_post", $post_id);
        $title = get_field("title", $ctb_post);
        $description = get_field("description", $ctb_post);
        $column_1 = get_field("columns_1", $ctb_post);
        $column_2 = get_field("columns_2", $ctb_post);
        $column_3 = get_field("columns_3", $ctb_post);
        $contribution_section_background_color = get_field("contribution_section_background_color", $post_id);
        $section_state_background = $contribution_section_background_color ? 'style="background:' . $contribution_section_background_color . '"' : '';
        if ($ctb_post) {
        ?>
            <section class="section-padding" <?php echo $section_state_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row">
                            <div class="col-12  mb-40" data-aos="fade-up">
                                <div class="col-md-5 col-sm-12 p-0">
                                    <h2 class="title-and-p-padding"><?php echo $title; ?></h2>
                                    <p>
                                        <?php echo $description; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 d-grid contribute-column">
                                <?php if ($column_1) { ?>
                                    <div class="col secondary-sand img-border-radius" style="background:<?php echo $column_1['column_background']; ?>" data-aos="fade-up">
                                        <div class="col-12 p-40">
                                            <h4 class="title-and-p-padding contribute-title">
                                                <?php echo $column_1['icon']; ?> &nbsp;<?php echo $column_1['title']; ?>
                                            </h4>
                                            <p class="m-0"><?php echo $column_1['description']; ?></p>
                                            <div class="d-flex justify-content-start">
                                                <div class="m-40 mb-0 isf-link-wraper secondary-sand">
                                                    <a class="isf-link secondary-sand" href="<?php echo $column_1['button_link']['url']; ?>" title="<?php echo $column_1['button_link']['title']; ?>" target="<?php echo $column_1['button_link']['target']; ?>">

                                                        <div class="slide-in-bottom">
                                                            <div class="" data-hover="<?php echo $column_1['button_text']; ?>">
                                                                <?php echo $column_1['button_text']; ?>
                                                            </div>
                                                            <div class="custom-styles w-embed"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if ($column_2) { ?>
                                    <div class="col primary-gray img-border-radius" style="background:<?php echo $column_2['column_background']; ?>" data-aos="fade-up">
                                        <div class="col-12 p-40">
                                            <h4 class="title-and-p-padding contribute-title">
                                                <?php echo $column_2['icon']; ?> &nbsp;<?php echo $column_2['title']; ?>
                                            </h4>
                                            <p class="m-0"><?php echo $column_2['description']; ?></p>
                                            <div class="d-flex justify-content-start">
                                                <div class="m-40 mb-0 isf-link-wraper">
                                                    <a class="isf-link" href="<?php echo $column_2['button_link']['url']; ?>" title="<?php echo $column_2['button_link']['title']; ?>" target="<?php echo $column_2['button_link']['target']; ?>">
                                                        <div class="slide-in-bottom">
                                                            <div class="" data-hover="<?php echo $column_2['button_text']; ?>">
                                                                <?php echo $column_2['button_text']; ?>
                                                            </div>
                                                            <div class="custom-styles w-embed"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if ($column_3) { ?>
                                    <div class="col primary-gray img-border-radius" style="background:<?php echo $column_3['column_background']; ?>" data-aos="fade-up">
                                        <div class="col-12 p-40">
                                            <h4 class="title-and-p-padding contribute-title">
                                                <?php echo $column_3['icon']; ?> &nbsp;<?php echo $column_3['title']; ?>
                                            </h4>
                                            <p class="m-0"><?php echo $column_3['description']; ?></p>
                                            <div class="d-flex justify-content-start">
                                                <div class="m-40 mb-0 isf-link-wraper">
                                                    <a class="isf-link" href="<?php echo $column_3['button_link']['url']; ?>" title="<?php echo $column_3['button_link']['title']; ?>" target="<?php echo $column_3['button_link']['target']; ?>">
                                                        <div class="slide-in-bottom">
                                                            <div class="" data-hover="<?php echo $column_3['button_text']; ?>">
                                                                <?php echo $column_3['button_text']; ?>
                                                            </div>
                                                            <div class="custom-styles w-embed"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    //section_form_id
    function sfi_subscription_section($post_id, $class = '')
    {
        $form_id = get_field('section_form_id', $post_id);
        if ($form_id) {
            $section_color = get_field('section_color', $post_id);
            $title = get_field('title', $form_id);
            $description = get_field('description', $form_id);
            $form = get_field('form', $form_id);

            // notice
            $notice = get_field('notice', $form_id);
            // button_text
            $button_text = get_field('button_text', $form_id);
            $button_text_color = get_field('button_text_color', $form_id);
            // button_color
            $button_color = get_field('button_color', $form_id);
            //image
            $image = get_field('image', $form_id);

            $section_background = $section_color ? 'style="background:' . $section_color . '"' : '';
            $button_class = !$button_color ? "primary-bg-orrange text-white custom-btn" : "";

            $custom_button_text_color = $button_text_color ? 'color:' . $button_text_color . '"' : "";
            $custom_button = $button_color ? 'style="background:' . $button_color . ';' . $custom_button_text_color . '"' : "";

            if ($button_color == '#05357b') {
                $button_color = 'primary-bg-blue';
                $custom_button = 'style="' . $custom_button_text_color . '"';
            } else if ($button_color == '#f25b2a') {
                $button_color = 'primary-bg-orrange';
                $custom_button = '';
            }
        ?>
            <section class="section-padding subscribe <?php echo $class; ?>" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row meduim-reverse flex-column-reverse flex-md-row align-items-center">
                            <div class="col-lg-4 col-md-5 col-sm-12 meduim-mt-40" data-aos="fade-right">
                                <h2 class="title-and-p-padding">
                                    <?php echo $title; ?>
                                </h2>
                                <p>
                                    <?php echo $description; ?>
                                </p>
                                <?php echo do_shortcode($form); ?>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-12"></div>
                            <div class="col-md-6 col-sm-12 mb-sm-40" data-aos="fade-up">
                                <div class="subscibe-image">
                                    <img src="<?php echo $image; ?>" class="img-fluid img-border-radius" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    //secail_media_section_id
    function sfi_secail_media_section($post_id)
    {
        $section_id = get_field('secail_media_section_id', $post_id);
        if ($section_id) {
            $section_color = get_field('socialmedia_section_color', $post_id);
            $title = get_field('title', $section_id);
            $description = get_field('description', $section_id);
            // social media
            $social_medias = get_field('social_medias', $section_id);

            //image
            $images = get_field('images', $section_id);

            $section_background = $section_color ? 'style="background:' . $section_color . '"' : '';
        ?>
            <section class="section-padding social-media" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row meduim-reverse flex-column-reverse flex-md-row align-items-center">
                            <div class="col-lg-5 col-md-5 col-sm-12 meduim-mt-40" data-aos="fade-right">
                                <h2 class="title-and-p-padding">
                                    <?php echo $title; ?>
                                </h2>
                                <p>
                                    <?php echo $description; ?>
                                </p>
                                <div class="mt-40 socail-media-link">
                                    <?php
                                    for ($i = 0; $i < count($social_medias); $i++) {
                                        $button_color = strtolower(str_replace(' ', '', $social_medias[$i]['button_color']));

                                        $custom_button =
                                            $button_color ? 'style="background:' . $button_color . '"' : '';
                                        if ($button_color == '#05357b') {
                                            $button_color = 'primary-bg-blue';
                                            $custom_button = '';
                                        } else if ($button_color == '#f25b2a') {
                                            $button_color = 'primary-bg-orrange';
                                            $custom_button = '';
                                        } else if ($button_color == '#01295c') {
                                            $button_color = 'secondary-bg-blue';
                                        } else {
                                            $button_color = '';
                                        }
                                    ?>
                                        <div class="d-flex specific-width-btn-mb">
                                            <a class="specific-width-btn primary-btn custom-btn <?php echo $button_color; ?>" <?php echo $custom_button; ?> href="<?php echo $social_medias[$i]['url']['url']; ?>" title="<?php echo $social_medias[$i]['url']['title']; ?>" target="<?php echo $social_medias[$i]['url']['target']; ?>">
                                                <?php echo $social_medias[$i]['icon'] ? $social_medias[$i]['icon'] . '' : '' ?><?php echo $social_medias[$i]['name']; ?>
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12"></div>
                            <div class="col-md-6 col-sm-12" data-aos="fade-up">
                                <div class="d-grid grid-three-column mb-sm-40">
                                    <?php
                                    $gallery = array_chunk($images, 2);
                                    for ($a = 0; $a < count($gallery); $a++) {
                                        $mt = $a == 1 ? 'mt-4' : '';
                                        echo "<div class='d-flex gap-20 " . $mt . "'>";
                                        for ($b = 0; $b < count($gallery[$a]); $b++) {
                                    ?>
                                            <img src="<?php echo $gallery[$a][$b]; ?>" class="img-fluid img-border-radius" />
                                    <?php
                                        }
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    function sfi_where_our_money_go_section($post_id, $bg = '')
    {

        $money_section_id = get_field('money_section_id', $post_id);
        if ($money_section_id) {
            $section_color = get_field('money_section_color', $post_id);
            $title = get_field('money_title', $money_section_id);
            $description = get_field('money_description', $money_section_id);

            $button_text = get_field('money_button_text', $money_section_id);
            $button_icon = get_field('money_button_icon', $money_section_id);
            // button_color
            $button_url = get_field('money_button_url', $money_section_id);
            $button_color = get_field('money_button_color', $money_section_id);


            //image
            $image = get_field('money_image', $money_section_id);
            $money_svg_image = get_field('money_svg_image', $money_section_id);
            $number_counting = get_field('number_counting', $money_section_id);
            $number_symbol = get_field('number_symbol', $money_section_id);
            $number_description = get_field('number_description', $money_section_id);




            $button_color = !$button_color ? "primary-bg-orrange text-white primary-button" : "";
            $custom_button = $button_color ? 'style="background:' . $button_color . '"' : "";

            if ($button_color == '#05357b') {
                $button_color = 'primary-bg-blue';
                $custom_button = '';
            } else if ($button_color == '#f25b2a') {
                $button_color = 'primary-bg-orrange';
                $custom_button = '';
            }
            if ($bg && $bg == 'default') {
                $section_background = $section_color ? 'style="background:' . $section_color . '"' : '';
            } else {
                $section_background = '';
            }
        ?>
            <section id="number_state" class="section-padding where-money-go state-number" <?php echo $section_background; ?>>
                <div class="content section-adding-x col-12">
                    <div class="fusion-row">
                        <div class="row meduim-reverse align-items-center flex-column-reverse flex-sm-row">
                            <div class="col-md-5 col-sm-12 meduim-mt-40" data-aos="fade-right">
                                <h2 class="title-and-p-padding">
                                    <?php echo $title; ?>
                                </h2>
                                <p>
                                    <?php echo $description; ?>
                                </p>
                                <div class="d-flex mt-40">
                                    <a class="donat-btn primary-btn custom-btn <?php echo $custom_button ? '' : 'primary-bg-orrange'; ?>" <?php echo $custom_button; ?> href="<?php echo $button_url['url']; ?>" title="<?php echo $button_url['title']; ?>" target="<?php echo $button_url['target']; ?>">
                                        <?php echo $button_icon; ?><?php echo $button_text; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12"></div>
                            <div class="col-md-6 col-sm-12 d-flex justify-content-center" data-aos="fade-up">
                                <div class="col-lg-8 col-md-12 col-sm-12 p-0 money-chat-box svg-image-wrapper mb-sm-40">
                                    <?php if ($image) {
                                        echo '<div class="money-go-wrapper">';
                                        if ($number_counting) {
                                            echo '<h1 class="where-money-go-number primary-teal mb-0 number" data-aos="fade-up" data-count="' . $number_counting . '" data-symbol="' . $number_symbol . '">0</h1>';
                                        }
                                        if ($number_description) {
                                            echo "<p data-aos='fade-up' class='mb-0 primary-teal money-go-description'>";
                                            echo $number_description;
                                            echo "</p>";
                                        }
                                        echo '</div>';
                                        echo  '<img data-aos="fade-up" src="' . $image . '" class="img-fluid img-border-radius" />';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php
        }
    }

    function register_donation_menus()
    {
        register_nav_menus(
            array(
                'do_nation_menu' => __('Donation Button Menu'),
                'do_nation_menu_desktop' => __('Donation Button Desktop Menu'),
            )
        );
    }
    add_action('init', 'register_donation_menus');

    function register_widget_areas()
    {

        register_sidebar(array(
            'name'          => 'Mobile Footer Option 1',
            'id'            => 'mobile_footer_option_one',
            'description'   => 'This widget area discription',
            'before_widget' => '<div class="mobile-footer text-center mobile_footer_option_one">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => 'Mobile Footer Option 2',
            'id'            => 'mobile_footer_option_tow',
            'description'   => 'This widget area discription',
            'before_widget' => '<div class="text-center mobile-footer mobile_footer_option_two">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ));
    }

    add_action('widgets_init', 'register_widget_areas');


    function add_slug_body_class($classes)
    {
        global $post;
        if (isset($post)) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }
        return $classes;
    }
    add_filter('body_class', 'add_slug_body_class');

    function custom_donation_menu()
    {
        wp_nav_menu(
            array(
                'theme_location' => 'do_nation_menu_desktop',
                'menu_class' => 'p-0 m-0 mega-menu max-mega-menu mega-menu-horizontal d-none d-sm-flex mega-menu-call-action',
                'container' => 'donation-menu-button',
                'container_class' => '',
            )
        );
    }
    // header security
    function mad_security_hsts_plugin_get_headers(array $headers = array()): array
    {
        $headers['Access-Control-Allow-Methods']             = 'GET,POST';
        $headers['Access-Control-Allow-Headers']             = 'Content-Type, Authorization';
        $headers['Content-Security-Policy']                  = mad_security_hsts_plugin_get_csp_header();
        $headers['Cross-Origin-Embedder-Policy']             = "unsafe-none; report-to='default'";
        $headers['Cross-Origin-Embedder-Policy-Report-Only'] = "unsafe-none; report-to='default'";
        $headers['Cross-Origin-Opener-Policy']               = 'unsafe-none';
        $headers['Cross-Origin-Opener-Policy-Report-Only']   = "unsafe-none; report-to='default'";
        $headers['Cross-Origin-Resource-Policy']             = 'cross-origin';
        $headers['Permissions-Policy']                       = 'accelerometer=(), autoplay=(), camera=(), cross-origin-isolated=(), display-capture=(self), encrypted-media=(), fullscreen=*, geolocation=(self), gyroscope=(), keyboard-map=(), magnetometer=(), microphone=(), midi=(), payment=*, picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), sync-xhr=(), usb=(), xr-spatial-tracking=(), gamepad=(), serial=()';
        $headers['Referrer-Policy']                          = 'strict-origin-when-cross-origin';
        $headers['Strict-Transport-Security']                = mad_security_hsts_plugin_get_hsts_header();
        $headers['X-Content-Security-Policy']                = 'default-src \'self\'; img-src *; media-src * data:;';
        $headers['X-Content-Type-Options']                   = 'nosniff';
        $headers['X-Frame-Options']                          = 'SAMEORIGIN';
        $headers['X-XSS-Protection']                         = '1; mode=block';
        $headers['X-Permitted-Cross-Domain-Policies']        = 'none';

        return $headers;
    }
    add_filter('wp_headers', 'mad_security_hsts_plugin_get_headers');

    function mad_security_hsts_plugin_get_hsts_header(): string
    {
        $max_age            = 63072000;
        $include_subdomains = false;
        $preload            = false;

        $header_tokens = array("max-age={$max_age}");
        if ($include_subdomains) {
            $header_tokens[] = 'includeSubDomains';
        }
        if ($preload) {
            $header_tokens[] = 'preload';
        }
        return implode('; ', $header_tokens);
    }

    function mad_security_hsts_plugin_get_csp_header(): string
    {
        $csp = 'upgrade-insecure-requests;';
        return $csp;
    }

    function more_stories_post_ajax()
    {
        $per_page = (isset($_POST["per_page"])) ? $_POST["per_page"] : 6;
        $pageNumber = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
        header("Content-Type: text/html");
        $args = array(
            'suppress_filters' => true,
            'post_type' => 'post',
            'posts_per_page' => $per_page,
            'paged'    => $pageNumber,
            'post_status' => 'publish',
        );
        $loop = new WP_Query($args);
        $out = '';
        if ($pageNumber == $loop->max_num_pages) {
            $out .= '
        <style>
        #load-more-stories{
            display:none!important;
        }
        </style>';
        }
        if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $out .= get_template_part('/templates/isf/story-list');
            endwhile;
        endif;
        wp_reset_postdata();
        die($out);
    }

    add_action('wp_ajax_nopriv_more_stories_post_ajax', 'more_stories_post_ajax');
    add_action('wp_ajax_more_stories_post_ajax', 'more_stories_post_ajax');

    function more_video_post_ajax()
    {
        $per_page = (isset($_POST["per_page"])) ? $_POST["per_page"] : 6;
        $pageNumber = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
        header("Content-Type: text/html");
        $args = array(
            'suppress_filters' => true,
            'posts_per_page' => $per_page,
            'post_type' => 'video-library',
            'post_status' => 'publish',
            'paged'    => $pageNumber,
        );
        $loop = new WP_Query($args);
        $out = '';
        if ($pageNumber == $loop->max_num_pages) {
            $out .= '
        <style>
        #load-more-video{
            display:none!important;
        }
        </style>';
        }

        if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
                $out .= get_template_part('/templates/isf/video-list');
            endwhile;
        endif;
        wp_reset_postdata();
        die($out);
    }

    add_action('wp_ajax_nopriv_more_video_post_ajax', 'more_video_post_ajax');
    add_action('wp_ajax_more_video_post_ajax', 'more_video_post_ajax');
