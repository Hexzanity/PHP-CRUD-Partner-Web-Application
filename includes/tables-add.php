<?php
    require("../config/db.php");

    if (isset($_POST['submit'])) {
        $item = $_POST['item'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $stocks = $_POST['stocks'];
        $cat_id = $_POST['cat_id'];

        $query = "INSERT INTO products (Item, Color, Size,  Price, Stocks, Cat_ID) VALUES ('$item','$color', '$size', '$price', '$stocks','$cat_id')";
        $result = mysqli_query($db, $query);

        if ($result) {
            header("Location: tables.php");
            exit();
        } else {
            echo "Error adding item";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('includes\header.php');
?>
<body class="g-sidenav-show  bg-gray-200">
<?php
include('includes\Tab-dash.php');
?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
<form method="POST" style="
  width: 720px;
  height: 550px;
  margin:auto; 
  margin-top: 50px;
  margin-bottom: 20px; 
  padding: 10px;  
  background: rgba(255, 255, 255, 0.5);  
  border: solid rgba(250, 250, 250, 0.5);
  border-radius: 60px;
  background-color: black">
<div class="container text-center">
    <form method="POST">
        <div class="form-group">
            <label style="font-weight: bolder"for="item">ITEM:</label>
            <input type="text" class="form-control" id="item" name="item" style="background-color: white; text-align: center;">
        </div>
        <div class="form-group">
            <label style="font-weight: bolder" for="color">COLOR:</label>
            <input type="text" class="form-control" id="color" name="color" style="background-color: white; text-align: center;">
        </div>
        <div class="form-group">
            <label style="font-weight: bolder" for="size">SIZE:</label>
            <input type="text" class="form-control" id="size" name="size" style="background-color: white; text-align: center;">
        </div>
        <div class="form-group">
            <label style="font-weight: bolder" for="price">PRICE:</label>
            <input type="text" class="form-control" id="price" name="price" style="background-color: white; text-align: center;">
        </div>
        <div class="form-group">
            <label style="font-weight: bolder" for="stocks">STOCKS:</label>
            <input type="text" class="form-control" id="stocks" name="stocks" style="background-color: white; text-align: center;">
        </div>
        <div class="form-group">
            <label style="font-weight: bolder" for="cat_id">Category ID:</label>
            <input type="text" class="form-control" id="cat_id" name="cat_id" style="background-color: white; text-align: center;">
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-danger"
        style="font-weight: bolder">Add Item</button>
    </form>
</div>
<?php
include('includes\footer.php');
?>