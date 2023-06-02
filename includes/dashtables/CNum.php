<?php
require("../config/db.php");
$query = "SELECT client_id FROM client ORDER BY client_id DESC LIMIT 1";
$result = mysqli_query($db, $query);
if ($result) {
  $clientData = mysqli_fetch_assoc($result);
  echo $clientData['client_id'];
} else {
  echo "Error retrieving last client ID: " . mysqli_error($db);
}
mysqli_close($db);
?>