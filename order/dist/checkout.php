<?php
session_start();
include('../../config/db.php');

$user_id = $_SESSION['ID'];

$date_ordered = date('Y-m-d H:i:s');
$receive_date = date('Y-m-d H:i:s', strtotime($date_ordered . ' +15 days'));

foreach ($_SESSION['cart'] as $key => $product) {
    $product_id = $product['id'];
    $quantity = $product['quantity'];

    $sql = "INSERT INTO order_system (client_id, date_ordered, item_id, quantity, receive_date) 
            VALUES ('$user_id','$date_ordered', '$product_id', '$quantity', '$receive_date')";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($db));
    }
}

$query = "SET @autoid :=0";
mysqli_query($db, $query);
$query = "UPDATE order_system SET os_id = @autoid := (@autoid+1)";
mysqli_query($db, $query);
$query = "ALTER TABLE products AUTO_INCREMENT = 1";
mysqli_query($db, $query);

$order_id = mysqli_insert_id($db);

foreach ($_SESSION['cart'] as $key => $product) {
    $product_id = $product['id'];
    $quantity = $product['quantity'];
    $total = $product['price'] * $quantity;

    $sql = "INSERT INTO product_ordered (product_id, quantity, total) VALUES ('$product_id', '$quantity', '$total')
            ON DUPLICATE KEY UPDATE quantity = quantity + '$quantity', total = total + '$total'";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($db));
    }

    $sql = "UPDATE products SET Stocks = Stocks - '$quantity' WHERE id = '$product_id'";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($db));
    }
}

unset($_SESSION['cart']);
header("Location: cart.php");
exit();
?>