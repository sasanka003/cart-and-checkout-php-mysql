<?php
require 'credentials.php';

$amount = 3000;
$merchant_id = MERCHANT_ID;
$order_id = uniqid();
$merchant_secret = MERCHANT_SECRET;
$currency = "LKR";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];

$array["amount"] = $amount;
$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["merchant_secret"] = $merchant_secret;
$array["currency"] =$currency;
$array["hash"] =$hash;

$jsonObj = json_encode($array);

echo $jsonObj;