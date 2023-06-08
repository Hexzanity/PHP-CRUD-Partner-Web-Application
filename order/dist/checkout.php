<?php

session_start();
include '../../config/db.php';

$user_id = $_SESSION['client_id'];

$date_ordered = date('Y-m-d H:i:s');
$receive_date = date('Y-m-d H:i:s', strtotime($date_ordered.' +15 days'));

foreach ($_SESSION['cart'] as $key => $product) {
    $product_id = $product['id'];
    $quantity = $product['quantity'];

    $sql = "INSERT INTO orders (client_id, date_ordered, product_id, quantity, receive_date)
            VALUES ('$user_id','$date_ordered', '$product_id', '$quantity', '$receive_date')";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        exit('Error: '.mysqli_error($db));
    }

    $sql = "UPDATE products
            SET Stocks = Stocks - '$quantity'
            WHERE product_id = '$product_id'";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        exit('Error: '.mysqli_error($db));
    }
}

$query = 'SET @autoid :=0';
mysqli_query($db, $query);
$query = 'UPDATE orders SET order_id = @autoid := (@autoid+1)';
mysqli_query($db, $query);
$query = 'ALTER TABLE orders AUTO_INCREMENT = 1';
mysqli_query($db, $query);

$order_id = mysqli_insert_id($db);

unset($_SESSION['cart']);
header('Location: cart.php');
exit;
