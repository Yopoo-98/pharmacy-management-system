<?php
session_start(); 
$conn = mysqli_connect("localhost","root","","pharmacy");

$sql = "SELECT * FROM `users` ";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($query);
?>

<?php
$user = $_SESSION['email'];
$get_user = "select * from users where email = '$user' ";
$run_user =  mysqli_query($conn,$get_user);
if($row = mysqli_fetch_array($run_user)){
    $staff_id = $row['user_id'];
    $staff_password = $row['password'];
    $staff_email = $row['email'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $register_date = $row['date'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Sale</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
         <!--Font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

        <!--table Search-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background: #7b2724ff;
            color: white;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        .sidebar a {
            color: white;
            padding: 12px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
            text-decoration: none;
        }
        .sidebar .dropdown-container {
            display: none;
            background-color: #495057;
        }
        .sidebar .dropdown-btn {
            cursor: pointer;
            padding: 12px;
            width: 100%;
            border: none;
            background: none;
            color: white;
            text-align: left;
        }
        .sidebar .dropdown-btn:hover {
            background: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .toggle-btn {
            display: none;
            background: #343a40;
            color: white;
            border: none;
            padding: 10px;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100%;
                transform: translateX(-100%);
                z-index: 1000;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .toggle-btn {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1100;
            }
        }
    </style>
</head>
<body>

<!-- Toggle button for small screens -->
<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fa fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <h4 class="text-center p-3">Pharmacy</h4>
    <a href="home.php"><i class="fa fa-home"></i> Dashboard</a>

    <button class="dropdown-btn"><i class="fa fa-shopping-cart"></i> Sales <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="sale.php">New Sale</a>
        <a href="Manage_sale.php">Sale Records</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-pills"></i> Medicine <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="add_medicine.php">Add Drugs</a>
        <a href="manage_medicine.php">Manage Drugs</a>
        <a href="monitor_expiry.php">Monitor Expiry</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-user"></i> PharmaCare Patients <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="add_customer.php">Add PharmaCare Patients</a>
        <a href="manage_customer.php">Manage PharmaCare Patients</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-car"></i> Supplier <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="add_supplier.php">Add Supplier</a>
        <a href="manage_supplier.php">Manage Supplier</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-dollar-sign"></i> Purchase <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="add_purchase.php">Add Purchase</a>
        <a href="manage_purchase.php">Manage Purchase</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-eye"></i> Monitor Sales <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="sold_drugs.php">Drug Sold</a>
        <a href="payment_info.php">Payment Details</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-file"></i> Reports <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="sale_report.php">Sales Report</a>
        <a href="purchase_report.php">Purchase Report</a>
        <a href="drug_condition.php">Drug Conditions</a>
        <a href="expired_drugs.php">Expired Drugs</a>
    </div>

    <button class="dropdown-btn"><i class="fa fa-users"></i> Users <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="add_user.php">Add User</a>
        <a href="manage_user.php">Manage User</a>
    </div>

    <a href="shortlisted_drug.php"><i class="fa fa-pills"></i> Shortage Drugs</a>
    <a href="pharmacy_info.php"><i class="fas fa-home"></i> Pharmacy Information</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>

        <p class="text-center" style="color:yellow">Login As-:<?php echo $fname . " " . $lname; ?></p>
</div>

<!-- JS for Dropdown + Sidebar -->
<script>
    // Dropdown toggle
    var dropdown = document.getElementsByClassName("dropdown-btn");
    for (var i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    // Sidebar toggle (mobile)
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
    }
</script>

</body>
</html>


