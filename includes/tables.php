<?php
include 'includes\..\includes\header.php';
include 'includes\..\includes\Tab-dash.php';
include '../config/db.php';
$limit = 5;
$offset = isset($_GET['page']) ? ($_GET['page'] - 1) * $limit : 0;
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    $query = "SELECT * FROM products WHERE Item LIKE '%$search%' LIMIT $offset, $limit";
} else {
    $query = "SELECT * FROM products LIMIT $offset, $limit";
}

$result = mysqli_query($db, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $query = "DELETE FROM products WHERE product_id = $id";
    mysqli_query($db, $query);
    header('Location: tables.php');
    exit;
}

$query = 'SET @autoid :=0';
mysqli_query($db, $query);
$query = 'UPDATE products SET product_id = @autoid := (@autoid+1)';
mysqli_query($db, $query);
$query = 'ALTER TABLE products AUTO_INCREMENT = 1';
mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">
<body class="bg-gray-200">
<div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-1">
                    <div class="card-body px-0 pb-1">
                        <div class="table-responsive p-0">
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="card-header ">
                                                    <h4 class="card-title">Stocks</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <form action="tables.php" method="GET">
                                                            <input type="text" name="search" />
                                                            <input type="submit" value="Search" class="btn btn-dark" />
                                                        </form>
                                                        <a href="tables-add.php" class="btn btn-info">Add New Item</a>
                                                    </div>
                                                </div>
                                                <div class="card-body table-full-width table-responsive text-center">
                                                    <table class="table table-hover table-striped">
                                                        <thead>
                                                            <th>ID</th>
                                                            <th>Item</th>
                                                            <th>Color</th>
                                                            <th>Size</th>
                                                            <th>Amount</th>
                                                            <th>Stocks</th>
                                                            <th>Action</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($products as $product) { ?>
                                                            <tr>
                                                                <td><?php echo $product['product_id']; ?></td>
                                                                <td><?php echo $product['Item']; ?></td>
                                                                <td><?php echo $product['colors']; ?></td>
                                                                <td><?php echo $product['Size']; ?></td>
                                                                <td><?php echo $product['Price']; ?></td>
                                                                <td><?php echo $product['Stocks']; ?></td>
                                                                <td>
                                                                    <a href="tables-edit.php?id=<?php echo $product['product_id']; ?>">
                                                                        <button type="submit" class="btn btn-warning btn-fill pull-right">Edit</button>
                                                                    </a>
                                                                    &nbsp;&nbsp;
                                                                    <form action="tables.php" method="POST" style="display:inline-block;">
                                                                        <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
                                                                        <button type="submit" class="btn btn-danger btn-fill pull-right">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                                $numberOfPage = 10;
for ($page = 1; $page <= $numberOfPage; ++$page) {
    echo '<a href = "tables.php?page='.$page.'">'.$page.'&nbsp;&nbsp;&nbsp; </a>';
}
?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
