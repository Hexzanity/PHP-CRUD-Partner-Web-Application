<?php
session_start();
error_reporting(0);
include('includes/header.php');
include('includes/navbar.php');

if (!empty($_SESSION['cart'])) {
    $total_price = 0;
?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION['cart'] as $key => $product) {
                    $item_name = $product['name'];
                    $item_quantity = $product['quantity'];
                    $item_price = $product['price'];
                    $total_price += ($item_quantity * $item_price);
                ?>
                    <tr>
                        <td><?= $item_name ?></td>
                        <td>
                            <form method="post" action="update_cart.php">
                                <input type="hidden" name="product_key" value="<?= $key ?>">
                                <div class="input-group">
                                <input type="number" name="quantity" value="<?= $item_quantity ?>" min="1" class="form-control" style="width: 50px; margin-right: 10px" pattern="\d+" title="Please enter numbers only">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>₱<?= number_format($item_price, 2) ?></td>
                        <td>
                            <form method="post" action="remove_from_cart.php">
                                <input type="hidden" name="product_key" value="<?= $key ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" align="right"><strong>Total Price:</strong></td>
                    <td colspan="2"><strong>₱<?= number_format($total_price, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<br>";
    echo "<br>";
    echo '<h1 style="text-align: center;">Your cart is empty.</h1>';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo '<hr>';
}
?>
<div class="text-center mt-3">
<form method="post" action="checkout.php" id="checkout-form">
    <button type="submit" class="btn btn-primary">Check Out</button>
</form>
<script>
    document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault();

        alert('Thank you for your order!! Your order has been processed successfully.');
        this.submit();
    });
    
</script>
</div>
<footer class="py-2 bg-dark" style="position: absolute; bottom: -200; width: 100%">
  <div class="container">
    <p class="m-0 text-center text-white">All Rights Reserved by Hexzanity &copy;</p>
  </div>
</footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
