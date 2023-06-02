<?php
require("../config/db.php");
$query = "SELECT ID FROM client ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($db, $query);
if ($result) {
  $clientData = mysqli_fetch_assoc($result);
  echo "Last client ID: " . $clientData['ID'];
} else {
  echo "Error retrieving last client ID: " . mysqli_error($db);
}
mysqli_close($db);
?>