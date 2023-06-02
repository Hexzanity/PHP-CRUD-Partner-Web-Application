<?php 
    include("../config/db.php");
    include('includes\..\includes\header.php');
    include('includes\..\includes\orders-dash.php');
    $limit = 5;
    $offset = isset($_GET['page']) ? ($_GET['page']-1) * $limit : 0;
    $query = "SELECT o.order_id, CONCAT(c.Fname, ' ', c.Lname) AS name, c.address, o.date_ordered, p.Item, o.quantity, o.receive_date 
    FROM orders o 
    JOIN client c ON o.client_id = c.client_id
    JOIN products p ON o.product_id = p.product_id";
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($db, $_GET['search']);
        $query .= " WHERE o.Item LIKE '%$search%'";
    }
    $query .= " LIMIT $offset, $limit";
    
    $result = mysqli_query($db, $query);
    $os = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
      $id = mysqli_real_escape_string($db, $_POST['order_id']);
      $query = "DELETE FROM orders WHERE order_id = $id";
      mysqli_query($db, $query);
      header('Location: orders.php');
      exit;
  }
  
  $query = "SET @autoid :=0";
  mysqli_query($db, $query);
  $query = "UPDATE orders SET order_id = @autoid := (@autoid+1)";
  mysqli_query($db, $query);
  $query = "ALTER TABLE orders AUTO_INCREMENT = 1";
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
                      <div class="card-header">
                        <h4 class="card-title">Orders</h4>
                      </div>
                      <div class="card-body table-full-width table-responsive text-center">
                        <table class="table table-hover table-striped text-center" style="width: 100">
                          <thead>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Order Date</th>
                            <th>Quantity</th>
                            <th>Receive Date</th>
                            <th>Action</th>
                          </thead>
                          <tbody>
                            <?php foreach ($os as $oss) : ?>
                              <tr>
                                <td><?php echo $oss['order_id'] ?></td>
                                <td><?php echo $oss['Item'] ?></td>
                                <td><?php echo $oss['name'] ?></td>
                                <td><?php echo $oss['address'] ?></td>
                                <td><?php echo $oss['date_ordered'] ?></td>
                                <td><?php echo $oss['quantity'] ?></td>
                                <td><?php echo $oss['receive_date'] ?></td>
                                <td>
                                  <form action="orders.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="order_id" value="<?php echo $oss['order_id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-fill pull-right">Cancel</button>
                                  </form>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <?php
                      $numberOfPage = 10;
                      for ($page = 1; $page <= $numberOfPage; $page++) {
                        echo '<a href = "orders.php?page=' . $page . '">' . $page . '&nbsp;&nbsp;&nbsp; </a>';
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>