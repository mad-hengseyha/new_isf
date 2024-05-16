<?php
class PayWayApiCheckout {
    public static function getHash($hash_str, $api_key) {
        $hash = base64_encode(hash_hmac('sha512', $hash_str, $api_key, true));
        return $hash;
    }
}
