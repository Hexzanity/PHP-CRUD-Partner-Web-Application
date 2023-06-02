<form method="post">
    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
    <input type="hidden" name="product_name" value="<?= $row['Item'] ?>">
    <input type="hidden" name="product_price" value="<?= $row['Price'] ?>">
    <input type="hidden" name="product_image" value="Shoes1.jpg">
    <button type="submit" name="add_to_cart" class="btn btn-outline-dark mt-auto">Add to cart</button>
</form>