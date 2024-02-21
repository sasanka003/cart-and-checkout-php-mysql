<?php

$amount = 3000;
$merchant_id = "1225820";
$order_id = uniqid();
$merchant_secret = "OTkxNTQ0NzEwMzQyNTU4ODk3MzM4NzE1MzY5MDgxNzgyMzM3NDIw";
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