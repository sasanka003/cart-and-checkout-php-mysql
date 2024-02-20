<?php

$amount = 3000;
$merchant_id = "1225820";
$order_id = uniqid();
$merchant_secret = "OTkxNTQ0NzEwMzQyNTU4ODk3MzM4NzE1MzY5MDgxNzgyMzM3NDIw";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

echo $hash;