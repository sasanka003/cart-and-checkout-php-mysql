<?php
// Retrieve the order ID from the query parameters
if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

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
    $objTrans->setQuantity($cartPrices['itemCount']);
    $objTrans->setAmount( str_replace(',', '', $cartPrices['finalPrice']));
    $objTrans->setOrderStatus(2);
    $objTrans->setCreatedOn(date('Y-m-d H:i:s'));
    $tId = $objTrans->saveTransaction();


    if(!is_numeric($tId)){
        echo "Something went wrong, Please try again.";
    }

    require 'classes/workshopSeat.class.php';
    $objWseat = new workshopSeat($conn);
    foreach ($cartItems as $key => $cartItem) {
        $objWseat->setTid($tId);
        $objWseat->setWid($cartItem['pid']);
        $objWseat->setQuantity($cartItem['quantity']);
        $objWseat->setCreatedOn(date('Y-m-d H:i:s'));
        $orderId = $objWseat->bookSeats();

        if(!is_numeric($orderId)) {
            echo "Something went wrong, Please try again.";

        }
    }

    $objCart->removeAllItems();

    $_SESSION['tid'] = $tId;

    // Perform actions based on the completed payment
    // For example, update the order status in the database, generate an invoice, etc.

    // Your PHP code for handling payment completion goes here

    // Respond with a success message (optional)
    $logMessage = "Order ID: $orderId\n";
    file_put_contents('order_log.log', $logMessage, FILE_APPEND | LOCK_EX);
} else {
    // Respond with an error message if the order ID is not provided
    echo "Error: OrderID not provided.";
}
?>