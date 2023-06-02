<?php include('../../config/db.php');

$sql = "SELECT product_id, Item, Price, Stocks, Size, colors FROM products WHERE product_id = 2";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="col mb-5">
        <div class="card h-100">
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale 10% OFF</div>
            <img class="card-img-top" src="Shoes2.jpg" width="450" height="300" alt="..."/>
            <div class="card-body p-4">
                <div class="text-center">
                    <h5 class="fw-bolder"><?= $row['Item'] ?></h5>
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <span>&#8369;&nbsp</span><?= $row['Price'] ?>.00
                    <br>
                    Stocks: <?= $row['Stocks'] ?>
                    <?php if (!empty($row['Size'])) { ?>
                        <br>Size: <?= $row['Size'] ?>
                    <?php } ?>
                    <?php if (!empty($row['colors'])) { ?>
                        <br>Color: <?= $row['colors'] ?>
                    <?php } ?>
                </div>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <form method="post" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $row['Item'] ?>">
                        <input type="hidden" name="product_price" value="<?= $row['Price'] ?>">
                        <?php include('button.php'); ?>
                    </form>
                    <?php
if (isset($_POST['add_to_cart'])) {
    // Get the product information from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Store the product information in the session variable
    $_SESSION['cart'][] = array(
        'product_id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    );
}
?>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "No product found with ID = 2";
}

// Close the database connection
mysqli_close($db);
?>
