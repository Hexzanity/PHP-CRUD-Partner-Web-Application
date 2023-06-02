<?php
session_start();

// Check if cart is not empty
if (!empty($_SESSION['cart'])) {
    // Loop through the cart and update the quantity of the selected item
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($_POST['product_key'] == $key) {
            $_SESSION['cart'][$key]['quantity'] = $_POST['quantity'];
            break;
        }
    }

    // Redirect back to the cart page
    header('Location: cart.php');
    exit;
}
?>
