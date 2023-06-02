<?php
require("../config/db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['product_id']);
    $item = mysqli_real_escape_string($db, $_POST['item']);
    $color = mysqli_real_escape_string($db, $_POST['color']);
    $size = mysqli_real_escape_string($db, $_POST['size']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $stocks = mysqli_real_escape_string($db, $_POST['stocks']);

    $query = "UPDATE products SET Item='$item', Color='$color', Size='$size', Price='$price', Stocks='$stocks' WHERE ID=$id";
    mysqli_query($db, $query);

    header('Location: tables.php');
    exit;
}
if (!isset($_GET['id'])) {
    header('Location: tables.php');
    exit;
}

$id = mysqli_real_escape_string($db, $_GET['id']);
$query = "SELECT * FROM products WHERE product_id=$id";
$result = mysqli_query($db, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header('Location: tables.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes\..\includes\header.php'); ?>
<body class="g-sidenav-show  bg-gray-200">
    <?php include('includes\..\includes\Tab-dash.php'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" style="
                                    width: 700px;
                                    height: 550px;
                                    margin:auto; 
                                    margin-top: 50px;
                                    margin-bottom: 20px; 
                                    padding: 10px;  
                                    background: rgba(255, 255, 255, 0.5);  
                                    border: solid rgba(250, 250, 250, 0.5);
                                    border-radius: 60px;
                                    background-color: black">
                    <div class="card-body text-center">
                        <form action="tables-edit.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $product['product_id'] ?>">
                            <div class="form-group">
                                <label for="item">ITEM:</label>
                                <input type="text" class="form-control" id="item" name="item" value="<?php echo $product['Item'] ?>" style="background-color: white; text-align: center;">
                            </div>
                            <div class="form-group">
    <label for="color">COLOR:</label>
    <select class="form-control" id="color" name="color" style="background-color: white; text-align: center;">
        <?php
            // Get the available colors from the database
            $query = "SHOW COLUMNS FROM products WHERE Field = 'colors'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            $options = explode(',', str_replace("'", "", substr($row['Type'], 5, -1)));

            // Generate an option element for each available color
            foreach ($options as $option) {
                echo '<option value="' . $option . '"';
                if ($product['colors'] == $option) {
                    echo ' selected';
                }
                echo '>' . $option . '</option>';
            }
        ?>
    </select>
</div>
                            <div class="form-group">
                                <label for="size">SIZE:</label>
                                <input type="text" class="form-control" id="size" name="size" value="<?php echo $product['Size'] ?>"style="background-color: white; text-align: center;">
                            </div>
                            <div class="form-group">
                                <label for="price">PRICE:</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['Price'] ?>"style="background-color: white; text-align: center;">
                            </div>
                            <div class="form-group">
                                <label for="stocks">STOCKS:</label>
                                <input type="text" class="form-control" id="stocks" name="stocks" value="<?php echo $product['Stocks'] ?>"style="background-color: white; text-align: center;">
                            </div>
                            <br>
                            <button type="submit" name="submit" class="btn btn-danger"
                            style="font-weight: bolder">Update</button>
                        </form>
                </div>
                </form>
        </div>
<?php
?>