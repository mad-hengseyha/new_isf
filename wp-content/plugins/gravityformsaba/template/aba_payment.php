<?php
get_header('home');
?>
<section id="content" class=""></section>
<section class="section-padding header-padding">
    <div class="content section-adding-x col-12">
        <div class="fusion-row">
            <div class="post-content col-12">
                <div class="w-778 m-auto text-center">
                    <div id="aba_main_modal" class="aba-modal">
                        <div class="aba-modal-content">
                            <!-- Include PHP class -->
                            <?php
                            require_once('PayWayApiCheckout.php');

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
                            if (isset($_GET['first_name'])) {
                                $firstName = $_GET['first_name'];
                            }
                            if (isset($_GET['last_name'])) {
                                $lastName = $_GET['last_name'];
                            }
                            if (isset($_GET['phone'])) {
                                $phone = $_GET['phone'];
                            }
                            if (isset($_GET['time'])) {
                                $req_time = $_GET['time'];
                            }
                            if (isset($_GET['id'])) {
                                $hash = $_GET['id'];
                            }
                            if (isset($_GET['email'])) {
                                $email = $_GET['email'];
                            }
                            if (isset($_GET['tran_id'])) {
                                $transactionId = $_GET['tran_id'];
                            }
                            if (isset($_GET['amount'])) {
                                $amount = $_GET['amount'];
                            }
                            if (isset($_GET['merchant_id'])) {
                                $merchant_id = $_GET['merchant_id'];
                            }
                            if (isset($_GET['type'])) {
                                $payment_option = $_GET['type'];
                            }
                            if (isset($_GET['form_id'])) {
                                $form_id = $_GET['form_id'];
                            }

                            $return_url = $aba_credentials['return_url'];
                            $success_url = $aba_credentials['success_url'];
                            // $req_time . $merchant_id . $transactionId . $amount . $firstName . $lastName . $email . $phone .$payment_method, $api
                            $prepear_hash = $req_time . $merchant_id . $transactionId . $amount . $firstName . $lastName . $email . $phone . $payment_option . $return_url . $success_url;
                            $confirm_has = PayWayApiCheckout::getHash($prepear_hash, $aba_credentials['aba_api_key']);
                            if ($confirm_has === $hash && $hash != '') {
                            ?>
                                <div>
                                    <h3>Donate to ISF Cambodia Via ABA Bank Payment</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="aba-info text-start col-md-6 col-sm-12">
                                            <h4>Confirm Your Donation</h4>
                                            <div class="first-name">
                                                First Name: <strong><?php echo $firstName; ?></strong>
                                            </div>
                                            <div class="last-name">
                                                Last Name: <strong><?php echo $lastName; ?></strong>
                                            </div>
                                            <div class="last-name">
                                                Email: <strong><?php echo $email; ?></strong>
                                            </div>
                                            <div class="last-name">
                                                Phone: <strong><?php echo $phone; ?></strong>
                                            </div>
                                            <div class="last-name">
                                                Amount: <strong><?php echo $amount . '.00'; ?> USD</strong>
                                            </div>
                                        </div>
                                        <div class="donation-button col-md-6 col-sm-12">
                                            <div class="confirm-button">
                                                <?php
                                                if ($payment_option == 'bakong') {
                                                ?>
                                                    <img class="cardType" src="<?php echo plugin_dir_url(__FILE__) . 'logos/kh-qrcode-v2.png'; ?>">
                                                <?php
                                                } elseif ($payment_option == 'abapay') {
                                                ?>
                                                    <img class="cardType" src="<?php echo plugin_dir_url(__FILE__) . 'logos/abapay-v2.png'; ?>">
                                                <?php
                                                } else {
                                                ?>
                                                    <img class="cardType" src="<?php echo plugin_dir_url(__FILE__) . 'logos/4Cards_2x.png'; ?>">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <input type="button" value="Donate Now" name="subscribe" id="aba_checkout_button" class="primary-button primary-bg-orrange">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" target="aba_webservice" action="<?php echo $aba_credentials['aba_url']; ?>" id="aba_merchant_request">
                                    <input type="hidden" name="hash" value="<?php echo $confirm_has; ?>" id="hash" />
                                    <input type="hidden" name="tran_id" value="<?php echo $transactionId; ?>" id="tran_id" />
                                    <input type="hidden" name="amount" value="<?php echo $amount; ?>" id="amount" />
                                    <input type="hidden" name="firstname" value="<?php echo $firstName; ?>" />
                                    <input type="hidden" name="lastname" value="<?php echo $lastName; ?>" />
                                    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                                    <input type="hidden" name="req_time" value="<?php echo $req_time; ?>" />
                                    <input type="hidden" name="merchant_id" value="<?php echo $merchant_id; ?>" />
                                    <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
                                    <input type="hidden" name="continue_success_url" value="<?php echo $success_url; ?>" />
                                    <input type="hidden" name="payment_option" value="<?php echo $payment_option; ?>" />
                                </form>
                            <?php
                            } else {
                                return;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    /* .d-flex {
        margin-bottom: 6em;
    } */
    #aba_checkout_button {
        margin-top: 2em;
        color: #fff;
        cursor: pointer;
    }

    .donation-button {
        margin: auto;
        margin-top: 2em;
    }
</style>
<?php

add_action('wp_footer', function () {
?>
    <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#aba_checkout_button').click(function() {
                AbaPayway.checkout();
            });
        });
    </script>
<?php
});

get_footer();
