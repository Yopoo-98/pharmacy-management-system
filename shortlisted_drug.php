
<?php include "include/connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Shortened Drug</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php include "sidebar/new_sidebar.php" ?>

    <div class="content">

         <div class="container-fluid"><br>
        <div class="row">
            <div class="col-md-4">
                <a href="add_medicine.php" style="text-decoration:none">
                    <div>
                        <h4 style="color:#A52A2A;font-weight:bolder">Add Medicine</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-md-1"></div> -->
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br>
                <h4>Manage Shortened Medicine </h4>
                <p style="margin-left:50px;margin-bottom:20px;">Managing Out of Stock Drugs</p>
                <h2 style="border-bottom:2px solid orangered;"></h2>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($_GET['msg'])) {
                                $msg = $_GET['msg'];
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'
                                    . $msg .
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            }
                            ?>
                           <table id="datatableid" class="table table-responsive table-striped bg-info table-hover">
                                <thead style="font-size:13px;">
                                    <tr>
                                        <th>#</th>
                                        <th>Medicine Name</th>
                                        <th>INITIAL STOCK</th>
                                        <th>TOTAL SOLD</th>
                                        <th>REMAINING DRUGS</th>
                                        <th>Min Qty</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                               <tbody id="datatableid" class=" table table-responsive table-striped bg-info table-hover" style="color:navy; font-size: 16px; text-align: justify;">
                                    <?php
                                    $sql =  "SELECT 
                                            m.medicine_id,
                                            m.medicine_name,
                                            (m.quantity + IFNULL(s.total_sold, 0)) AS initial_stock,   -- what the stock was before sales
                                            IFNULL(s.total_sold, 0) AS total_sold,                     -- how many sold
                                            m.quantity AS balance_quantity,                            -- what’s left (remaining)
                                            m.min_quantity,
                                            CASE 
                                                WHEN m.quantity < m.min_quantity 
                                                THEN 'Drug Shortage' 
                                                ELSE 'Enough Drug' 
                                            END AS status
                                        FROM medicine m
                                        LEFT JOIN (
                                            SELECT 
                                                medicine_id, 
                                                SUM(quantity_sold) AS total_sold
                                            FROM sale_items
                                            GROUP BY medicine_id
                                        ) s ON m.medicine_id = s.medicine_id;
";
                                    $query = mysqli_query($conn, $sql);
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo "<tr>
                                                <td>{$i}</td>
                                                <td>{$row['medicine_name']}</td>
                                                <td>{$row['initial_stock']}</td>
                                                <td>{$row['total_sold']}</td>
                                                <td>{$row['balance_quantity']}</td>
                                                <td>{$row['min_quantity']}</td>
                                                <td>{$row['status']}</td>
                                               
                                              </tr>";
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="col-md-1"></div> -->
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#datatableid');
    </script>
</body>

</html>

<style>
    a {
        text-decoration: none;
    }
</style>
