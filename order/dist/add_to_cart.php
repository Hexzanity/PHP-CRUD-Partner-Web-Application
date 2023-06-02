<?php
session_start();

if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price'])) {
    $product = array(
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'quantity' => 1
    );
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    $cart = $_SESSION['cart'];
    
    if (array_key_exists($product['id'], $cart)) {
        $cart[$product['id']]['quantity']++;
    } else {
        $cart[$product['id']] = $product;
    }
    
    $_SESSION['cart'] = $cart;
}

header('Location: http://localhost/fin/order/dist/order.php');
exit();
?>
