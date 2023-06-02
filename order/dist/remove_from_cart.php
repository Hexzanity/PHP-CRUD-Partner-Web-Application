<?php
session_start();

if(isset($_POST['product_key'])) {
    $product_key = $_POST['product_key'];
    unset($_SESSION['cart'][$product_key]);
}

header("Location: cart.php");
exit();
?>