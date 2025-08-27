<?php
// --- Database connection ---
$conn = new mysqli("localhost", "root", "", "pharmacy");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -------- DAILY SALES (Today’s Sales) --------
$dailySalesResult = $conn->query("SELECT SUM(final_amount) AS total FROM sale_manager WHERE DATE(date) = CURDATE()");
$dailySales = $dailySalesResult->fetch_assoc()['total'] ?? 0;

// -------- MONTHLY SALES --------
$monthlySalesResult = $conn->query("SELECT SUM(final_amount) AS total FROM sale_manager WHERE MONTH(date) = MONTH(CURDATE())");
$monthlySales = $monthlySalesResult->fetch_assoc()['total'] ?? 0;

// -------- MONTHLY PURCHASE --------
$monthlyPurchaseResult = $conn->query("SELECT SUM(amount) AS total FROM purchase WHERE MONTH(purchase_date) = MONTH(CURDATE())");
$monthlyPurchase = $monthlyPurchaseResult->fetch_assoc()['total'] ?? 0;

// -------- MONTHLY PROFIT --------
$monthlyProfitResult = $conn->query("SELECT SUM(m.profit * s.quantity_sold) AS total_profit 
    FROM sale_items s 
    JOIN medicine m ON s.medicine_id = m.medicine_id
    JOIN sale_manager sm ON sm.sale_manager_id = s.sale_manager_id
    WHERE MONTH(sm.date) = MONTH(CURDATE())");
$monthlyProfit = $monthlyProfitResult->fetch_assoc()['total_profit'] ?? 0;

// -------- PIE CHART: TOP SOLD DRUGS --------
$drugSalesResult = $conn->query("SELECT m.medicine_name, SUM(s.quantity_sold) AS sold 
    FROM sale_items s 
    JOIN medicine m ON s.medicine_id = m.medicine_id 
    GROUP BY m.medicine_name 
    ORDER BY sold DESC 
    LIMIT 5");
$drugLabels = [];
$drugData = [];
while ($row = $drugSalesResult->fetch_assoc()) {
    $drugLabels[] = $row['medicine_name'];
    $drugData[] = $row['sold'];
}

// -------- LINE CHART: WEEKLY SALES --------
$weeklySalesResult = $conn->query("SELECT DATE(date) as sale_date, SUM(final_amount) as total 
    FROM sale_manager 
    WHERE WEEK(date) = WEEK(CURDATE()) 
    GROUP BY DATE(date)");
$weeklyDates = [];
$weeklyTotals = [];
while ($row = $weeklySalesResult->fetch_assoc()) {
    $weeklyDates[] = $row['sale_date'];
    $weeklyTotals[] = $row['total'];
}

// -------- SHORTAGE DRUGS --------
$shortageResult = $conn->query("SELECT medicine_name, quantity, min_quantity 
    FROM medicine 
    WHERE quantity < min_quantity");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body { background: #f8f9fa; }
        .card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .dashboard-container { padding: 20px; }
        .chart-canvas { width: 100% !important; height: 370px !important; } /* same size for both charts */
    </style>
</head>
<body>
    <?php include "sidebar/new_sidebar.php"; ?>
    <div class="content">
        <div class="container-fluid dashboard-container">
            <h2 class="text-center mb-4">Pharmacy Management Dashboard</h2>
            <div class="row text-center mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary p-3">
                        <h5>Daily Sales</h5>
                        <h3>₵<?= number_format($dailySales, 2) ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success p-3">
                        <h5>Monthly Sales</h5>
                        <h3>₵<?= number_format($monthlySales, 2) ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning p-3">
                        <h5>Monthly Purchase</h5>
                        <h3>₵<?= number_format($monthlyPurchase, 2) ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger p-3">
                        <h5>Monthly Profit</h5>
                        <h3>₵<?= number_format($monthlyProfit, 2) ?></h3>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card p-3 text-center">
                        <h5>Top Sold Drugs</h5>
                        <canvas id="drugPieChart" class="chart-canvas" width="370" height="370"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-3 text-center">
                        <h5>Weekly Sales</h5>
                        <canvas id="weeklyLineChart" class="chart-canvas" width="370" height="370"></canvas>
                    </div>
                </div>
            </div>

            <!-- Shortage Drugs Table -->
           <div class="card p-3">
    <h5 class="text-center">Shortage Drugs</h5>
    <table id="shortageTable" class="display table table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Available Quantity</th>
                <th>Minimum Required</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $shortageResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                <td><?= (int)$row['quantity'] ?></td>
                <td><?= (int)$row['min_quantity'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>



        </div>
    </div>

<!-- Correct JS Includes -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    // --- Pie Chart ---
    new Chart(document.getElementById('drugPieChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode($drugLabels) ?>,
            datasets: [{
                data: <?= json_encode($drugData) ?>,
                backgroundColor: ['#ff6384','#36a2eb','#ffce56','#4bc0c0','#9966ff']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // --- Weekly Line Chart ---
    new Chart(document.getElementById('weeklyLineChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($weeklyDates) ?>,
            datasets: [{
                label: 'Sales (₵)',
                data: <?= json_encode($weeklyTotals) ?>,
                fill: false,
                borderColor: 'blue',
                tension: 0.1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // --- DataTables ---
   $(document).ready(function () {
    $('#shortageTable').DataTable({
        searching: true,   // ✅ Enable search bar
        paging: true,      // ✅ Enable pagination
        ordering: true,    // ✅ Enable sorting
        info: true,        // ✅ Display table info
        responsive: true,  // ✅ Responsive layout
        lengthMenu: [5, 10, 25, 50] // ✅ Rows per page dropdown
    });
});
</script>
</body>
</html>


