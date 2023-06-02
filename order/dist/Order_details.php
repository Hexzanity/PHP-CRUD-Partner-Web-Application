<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
include('../../config/db.php');
include('id.php');
// retrieve user ID from session

$query = "SELECT o.date_ordered, p.Item, o.quantity, o.receive_date 
    FROM orders o 
    JOIN client c ON o.client_id = c.client_id
    JOIN products p ON o.product_id = p.product_id
    WHERE c.client_id = $id";

// add search filter if applicable
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    $query .= " AND p.Item LIKE '%$search%'";
}

// execute query and fetch results
$result = mysqli_query($db, $query);
$os = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<body>
<h4 class="card-title">Order Details</h4>
<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                    </div>
                    <div class="card-body table-full-width table-responsive text-center">
                        <table class="table table-hover table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Order Date</th>
                                    <th>Receive Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($os as $oss): ?>
                                <tr>
                                    <td><?php echo $oss['Item'] ?></td>
                                    <td><?php echo $oss['quantity'] ?></td>
                                    <td><?php echo $oss['date_ordered'] ?></td>
                                    <td><?php echo $oss['receive_date'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer class="py-2 bg-dark" style="position: fixed; bottom: 0; width: 100%;">
  <div class="container">
    <p class="m-0 text-center text-white">All Rights Reserved by Hexzanity &copy;</p>
  </div>
</footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
