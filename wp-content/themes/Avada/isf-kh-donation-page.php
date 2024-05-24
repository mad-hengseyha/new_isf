<?php

/**
 * Template Name: ISF KH donation page
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
<section id="content" class="full-width col-12 md-margin-top">
    <?php
    while (have_posts()) :
    ?>
        <?php
        the_post();
        $post_id = get_the_ID();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="content section-adding-x col-12">
                <div class="fusion-row">
                    <?php if (has_post_thumbnail($post_id)) : ?>
                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full'); ?>
                        <div class="feature-image mb-20">
                            <img src="<?php echo  $image[0]; ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <div class="post-content col-12 mt-40">
                        <div class="w-778 m-auto text-center">
                            <?php
                            the_content();
                            ?>
                            <div class="d-none gravity-form-ajax-url" ajaxurl='<?php echo admin_url('admin-ajax.php'); ?>'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endwhile;
    ?>
</section>

<div id="aba_main_modal" class="aba-modal">
    <div class="aba-modal-content">
        <!-- Include PHP class -->
        <?php
        $aba = new GFABA();
        $aba_credentials = $aba->get_aba_credentails();

        $transactionId = '';
        $amount = '';
        $firstName = '';
        $lastName = '';
        $phone = '';
        $email = '';
        $req_time = '';
        $merchant_id = '';
        $payment_option = '';
        #abapay, cards, abapay_deeplink, bakong

        $hash = '';
        $form_id = '';
        $return_url = $aba_credentials['return_url'] ? $aba_credentials['return_url'] : '';
        $success_url = $aba_credentials['success_url'] ? $aba_credentials['success_url'] : '';

        // $req_time . $merchant_id . $transactionId . $amount . $firstName . $lastName . $email . $phone .$payment_method, $api
        // $prepear_hash = $req_time . $merchant_id . $transactionId . $amount . $firstName . $lastName . $email . $phone . $payment_option . $return_url . $success_url;
        // $confirm_has = getHash($prepear_hash, $aba_credentials['aba_api_key']);
        // if ($confirm_has === $hash && $hash != '') {
        ?>
        <form method="POST" target="aba_webservice" action="<?php echo $aba_credentials['aba_url']; ?>" id="aba_merchant_request">
            <input type="hidden" name="hash" value="" id="hash" />
            <input type="hidden" name="tran_id" value="" id="tran_id" />
            <input type="hidden" name="amount" value="" id="amount" />
            <input type="hidden" name="firstname" id="firstname" value="" />
            <input type="hidden" name="lastname" id="lastname" value="" />
            <input type="hidden" name="phone" id="phone" value="" />
            <input type="hidden" name="email" id="email" value="" />
            <input type="hidden" name="req_time" id="req_time" value="" />
            <input type="hidden" name="merchant_id" id="merchant_id" value="" />
            <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
            <input type="hidden" name="continue_success_url" value="<?php echo $success_url; ?>" />
            <input type="hidden" name="payment_option" id="payment_option" value="" />
        </form>
    </div>
</div>
<script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>

<?php
get_footer(); ?>