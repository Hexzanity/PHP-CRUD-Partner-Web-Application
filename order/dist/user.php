<?php
if (isset($_SESSION['fname']) && isset($_SESSION['client_id'])) {
  $fname = $_SESSION['fname'];
  $id = $_SESSION['client_id'];
  echo strtoupper($fname);
}
?>