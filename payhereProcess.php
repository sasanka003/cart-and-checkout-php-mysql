<?php
require 'credentials.php';

session_start();

require_once('db/DbConnect.php');
$db   = new DbConnect();
$conn = $db->connect();

require 'classes/cart.class.php';
$objCart = new cart($conn);
$objCart->setCid($_SESSION['cid']);
$cartItems = $objCart->getAllCartItems();
$cartPrices = $objCart->calculatePrices($cartItems);

require 'classes/transaction.class.php';
$objTrans = new transaction($conn);
$objTrans->setCid($_SESSION['cid']);
$objTrans->setAmount( str_replace(',', '', $cartPrices['finalPrice']));


$amount = $objTrans->getAmount();
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