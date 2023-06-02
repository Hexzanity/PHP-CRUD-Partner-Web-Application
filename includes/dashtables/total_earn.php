<?php
require("../config/db.php");
$query = "SELECT SUM(o.quantity * p.price) AS total_earn
          FROM orders o
          JOIN products p ON o.product_id = p.product_id;";
$result = mysqli_query($db, $query);
if ($result) {
  $total = mysqli_fetch_assoc($result);
  echo "₱" . number_format($total['total_earn'], 2, '.', ',');
} else {
  echo "Error retrieving total earnings: " . mysqli_error($db);
}
mysqli_close($db);
?>
