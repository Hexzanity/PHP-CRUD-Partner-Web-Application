<?php

session_start();

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($_POST['product_key'] == $key) {
            $_SESSION['cart'][$key]['quantity'] = $_POST['quantity'];
            break;
        }
    }

    header('Location: cart.php');
    exit;
}
