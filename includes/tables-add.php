<?php
require("../config/db.php");


$colors = array('R/W','B/W','White','Br/W','Bl/W','Blue','Coral Green','Navy Blue','Black /Pink');


$categoryQuery = "SELECT category_id, kind FROM category";
$categoryResult = mysqli_query($db, $categoryQuery);
$categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);


$supplierQuery = "SELECT supplier_id, company FROM supplier";
$supplierResult = mysqli_query($db, $supplierQuery);
$suppliers = mysqli_fetch_all($supplierResult, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $item = $_POST['item'];
    $color = $_POST['colors'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $cat_id = $_POST['category_id'];
    $sup_id = $_POST['supplier_id'];

    $query = "INSERT INTO products (Item, colors, Size, Price, Stocks, category_id, supplier_id) VALUES ('$item', '$color', '$size', '$price', '$stocks', '$cat_id', '$sup_id')";
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
<?php include('includes/header.php'); ?>

<body class="g-sidenav-show bg-gray-200">
    <?php include('includes/Tab-dash.php'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" style="width: 720px; height: 650px; margin:auto; margin-top: 50px; margin-bottom: 100px; padding: 30px; background: rgba(255, 255, 255, 0.5); border: solid rgba(250, 250, 250, 0.5); border-radius: 50px; background-color: black">
                        <div class="container text-center">
                            <div class="form-group">
                                <label style="font-weight: bolder" for="item">ITEM:</label>
                                <input type="text" class="form-control" id="item" name="item" style="background-color: white; text-align: center;">
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bolder" for="colors">COLOR:</label>
                                <select class="form-control" id="colors" name="colors" style="background-color: white; text-align: center;">
                                    <?php foreach ($colors as $color): ?>
                                        <option value="<?php echo $color; ?>"><?php echo $color; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                                <label style="font-weight: bolder" for="category_id">Category ID:</label>
                                <select class="form-control" id="category_id" name="category_id" style="background-color: white; text-align: center;">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['kind']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bolder" for="supplier_id">Supplier ID:</label>
                                <select class="form-control" id="supplier_id" name="supplier_id" style="background-color: white; text-align: center;">
                                    <?php foreach ($suppliers as $supplier): ?>
                                        <option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['company']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <button type="submit" name="submit" class="btn btn-danger" style="font-weight: bolder">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
