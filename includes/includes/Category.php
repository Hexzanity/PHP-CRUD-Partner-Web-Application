<?php
    include ('../config/db.php');
    
    $query = "SELECT category.kind AS category, SUM(orders.quantity) AS total_quantity
              FROM orders
              INNER JOIN products ON orders.product_id = products.product_id
              INNER JOIN category ON products.category_id = category.category_id
              GROUP BY products.category_id
              ORDER BY total_quantity DESC";
    
    $result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    <div class="container">
        <h3>Product Critism</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total of Ordered</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['total_quantity']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
