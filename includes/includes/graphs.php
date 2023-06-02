<!DOCTYPE html>
<html>
<head>
    <script src="includes/chart.js"></script>
</head>
<body>
    <div class="chart-container" style="width: 200%; margin-left: 50px; padding-bottom: 50px">
        <canvas id="myChart" style="width:100%; max-width: 900px;"></canvas>
    </div>

    <script>
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include ('../config/db.php');

        $sql_top = "SELECT p.Item, SUM(o.quantity * p.price) AS total_earn
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        GROUP BY o.product_id
        ORDER BY total_earn DESC
        LIMIT 1";

        $result_top = mysqli_query($db, $sql_top);
        $row_top = mysqli_fetch_assoc($result_top);
        $top_product = $row_top["Item"];

$sql = "SELECT o.product_id, p.Item, SUM(o.quantity * p.price) AS total
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        GROUP BY o.product_id
        ORDER BY total DESC";
        $result = mysqli_query($db, $sql);
        $items = array();
        $totals = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($items, $row["Item"]);
            array_push($totals, $row["total"]);
        }
        mysqli_close($db);
        ?>
        var xValues = <?php echo json_encode($items); ?>;
        var yValues = <?php echo json_encode($totals); ?>;
        var barColors = ["red", "green", "blue", "orange", "brown", "pink", "grey", "black"];
        var topProduct = "<?php echo isset($top_product) ? $top_product : ''; ?>";

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Top Product: " + topProduct.toUpperCase()
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0.5,
                            callback: function(value, index, values) {
                                return "₱" + value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Total Earned"
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0.5,
                            callback: function(value, index, values) {
                                return "₱" + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = tooltipItem.yLabel;
                            return "₱" + value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
