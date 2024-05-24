<?php
/*
Plugin Name: Gravity Forms ABA Bank Add-On
Plugin URI: https://mad.co
Description: Integrates Gravity Forms with ABA Bank Payments, enabling end users to purchase goods and services through Gravity Forms.
Version: 3.5
Author: Mad.co
Author URI: https://mad.co
License: GPL-2.0+
Text Domain: gravityformsaba
Domain Path: /languages

------------------------------------------------------------------------
Copyright 2009-2021 Rocketgenius, Inc.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/


defined('ABSPATH') || die();

define('GF_ABA_VERSION', '3.5');

add_action('gform_loaded', array('GF_ABA_PAYMENT_Bootstrap', 'load'), 5);

class GF_ABA_PAYMENT_Bootstrap
{

    public static function load()
    {

        if (!method_exists('GFForms', 'include_payment_addon_framework')) {
            return;
        }

        require_once('class-gf-aba.php');

        GFAddOn::register('GFABA');
    }
}

function gf_aba()
{
    return GFABA::get_instance();
}


// add a wp query variable to redirect to
if (!function_exists('set_aba_payment_methods_push_back_page')) {
    add_action('query_vars', 'set_aba_payment_methods_push_back_page');
    function set_aba_payment_methods_push_back_page($vars)
    {
        array_push($vars, 'aba_payment_pushback_methods');
        return $vars;
    }
}

// Create a redirect
if (!function_exists('custom_add_route_aba_payment_method_pushback')) {
    add_action('init', 'custom_add_route_aba_payment_method_pushback');
    function custom_add_route_aba_payment_method_pushback()
    {
        add_rewrite_rule('^aba-payment-pushback$', 'index.php?aba_payment_pushback_methods=1', 'top');
        flush_rewrite_rules();
    }
}

//add template page update payment
if (!function_exists('custom_aba_payment_pushback_plugin_include_template')) {
    add_filter('template_include', 'custom_aba_payment_pushback_plugin_include_template');
    function custom_aba_payment_pushback_plugin_include_template($template)
    {
        if (get_query_var('aba_payment_pushback_methods')) {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data['tran_id']) {
                if ($data['status'] == 0 || $data['status'] == "0") {
                    if (checkTransaction($data['tran_id'])) {
                        $entry_id = $data['tran_id'];
                        $approve_number = $data['apv'];
                        $aba = new GFABA();

                        //custom check if entry has already confirm
                        $check_entry = $aba->aba_custom_check_entry_status($entry_id);

                        if ($check_entry) {
                            //updating lead's payment_status to Processing
                            GFAPI::update_entry_property($entry_id, 'payment_status', 'Approved');
                            GFAPI::update_entry_property($entry_id, 'payment_date', current_time('mysql'));
                            GFAPI::update_entry_property($entry_id, 'transaction_id', $approve_number);
                            GFAPI::update_entry_property($entry_id, 'payment_method', 'ABA Bank');
                            GFAPI::update_entry_property($entry_id, 'is_fulfilled', 1);

                            //prepaire send notification
                            $aba->custome_update_send_email($entry_id);
                        }

                        exit;
                    }
                }
            } else {
                echo 'Silence is golden';
                exit;
            }
        }
        return $template;
    }
}


// add a wp query variable to redirect to
if (!function_exists('set_aba_payment_methods_page')) {
    add_action('query_vars', 'set_aba_payment_methods_page');
    function set_aba_payment_methods_page($vars)
    {
        array_push($vars, 'aba_payment_methods');
        return $vars;
    }
}

// Create a redirect
if (!function_exists('custom_add_route_aba_payment_method')) {
    add_action('init', 'custom_add_route_aba_payment_method');
    function custom_add_route_aba_payment_method()
    {
        add_rewrite_rule('^aba-payment-method$', 'index.php?aba_payment_methods=1', 'top');
        flush_rewrite_rules();
    }
}

//add template page
if (!function_exists('custom_aba_payment_plugin_include_template')) {
    add_filter('template_include', 'custom_aba_payment_plugin_include_template');
    function custom_aba_payment_plugin_include_template($template)
    {
        if (get_query_var('aba_payment_methods')) {
            $template = plugin_dir_path(__FILE__) . 'template/aba_payment.php';
        }
        return $template;
    }
}

function checkTransaction($tran_id)
{
    $aba = new GFABA();
    $aba_credentials = $aba->get_aba_credentails();
    $check_production =  'https://checkout.payway.com.kh/api/payment-gateway/v1/payments/check-transaction';
    $check_staging = 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/check-transaction';

    $merchantId = $aba_credentials['aba_merchan_id'];
    if ($aba_credentials['aba_env'] == 'production') {
        $url = $check_production;
    } else {
        $url = $check_staging;
    }

    $reqTime = date("YYYYmdHis");
    $hash = base64_encode(hash_hmac('sha512', $reqTime . $merchantId . $tran_id, $aba_credentials['aba_api_key'], true));
    $postfields = array(
        'tran_id' => $tran_id,
        'hash' => $hash,
        'req_time' => $reqTime,
        'merchant_id' => $merchantId
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_PROXY, null);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
    $result = curl_exec($ch); //Result Json
    $result = json_decode($result, true);
    $paymentStatus = isset($result['payment_status']) ? $result['payment_status'] : '';
    if (strtoupper($paymentStatus) == 'APPROVED') {
        return true;
    } else {
        return false;
    }
}
add_action('wp_ajax_nopriv_custom_add_entry_to_gravity_form_ajax', 'custom_add_entry_to_gravity_form_ajax');
add_action('wp_ajax_custom_add_entry_to_gravity_form_ajax', 'custom_add_entry_to_gravity_form_ajax');
function custom_add_entry_to_gravity_form_ajax()
{

    $data = $_REQUEST;
    $form = GFAPI::get_form($data['form_id']);

    # Build our entry
    $entry = array();
    $regex = '/^input_([0-9])_([0-9])$/';

    foreach ($data as $key => $value) :
        if (preg_match($regex, $key))
            $key = preg_replace($regex, '$2', $key);
        $entry[$key] = $value;
    endforeach;

    $entry['date_created'] = date('Y-m-d G:i');
    $entry['payment_status'] = '';
    $entry = GFAPI::add_entry($entry);
    if (is_wp_error($entry)) :
        die(json_encode(array(
            'error' => true,
            'msg' => $entry->get_error_message(),
            'form' => $form,
        )));

    else :
        if (class_exists('GFMailChimp')) :
        // $mc = new GFMailChimp;
        // $mc::export($entry, $form);
        endif;
        GFAPI::send_notifications($form, $entry, 'form_submission');
        die(json_encode(array(
            'error' => false,
            'msg' => end($form['confirmations']),
            'form' => $form,
        )));
    endif;
}

// ajax get hash
add_action('wp_ajax_nopriv_abagetHash', 'abagetHash');
add_action('wp_ajax_abagetHash', 'abagetHash');
function abagetHash()
{
    $hash_str = $_POST['string'];
    // $url = urldecode($hash_str);
    $aba = new GFABA();
    $aba_credentials = $aba->get_aba_credentails();
    $hash = base64_encode(hash_hmac('sha512', $hash_str, $aba_credentials['aba_api_key'], true));
    return $hash;
}
