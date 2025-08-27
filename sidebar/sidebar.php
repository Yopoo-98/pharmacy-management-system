<!-- sidebar.php -->
<div class="sidebar" id="sidebar">
    <h4 class="text-center p-3">💊 Pharmacy</h4>

    <a href="dashboard.php" class="sidebar-link"><i class="fa fa-home"></i> Dashboard</a>

    <!-- Medicine Menu -->
    <button class="dropdown-btn"><i class="fa fa-pills"></i> Medicine <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="add_medicine.php">➕ Add Medicine</a>
        <a href="manage_medicine.php">📦 Manage Medicine</a>
    </div>

    <!-- Sales Menu -->
    <button class="dropdown-btn"><i class="fa fa-shopping-cart"></i> Sales <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="sale.php">🧾 New Sale</a>
        <a href="sales_list.php">📊 Sale Records</a>
    </div>

    <!-- Customers -->
    <a href="customers.php" class="sidebar-link"><i class="fa fa-users"></i> Customers</a>

    <!-- Reports -->
    <button class="dropdown-btn"><i class="fa fa-file-alt"></i> Reports <i class="fa fa-caret-down float-end"></i></button>
    <div class="dropdown-container">
        <a href="daily_report.php">📅 Daily Report</a>
        <a href="monthly_report.php">📆 Monthly Report</a>
    </div>

    <!-- Logout -->
    <a href="logout.php" class="sidebar-link"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<script>
    // Sidebar dropdown toggle
let dropdownBtns = document.getElementsByClassName("dropdown-btn");
for (let i = 0; i < dropdownBtns.length; i++) {
    dropdownBtns[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let dropdownContent = this.nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
}

// Sidebar show/hide on mobile
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
}

</script>

<style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
}

/* Sidebar */
.sidebar {
    width: 250px;
    background: #343a40;
    color: white;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}
.sidebar a, .sidebar button {
    padding: 12px;
    display: block;
    width: 100%;
    border: none;
    background: none;
    color: white;
    text-align: left;
    font-size: 16px;
    text-decoration: none;
    cursor: pointer;
}
.sidebar a:hover, .sidebar button:hover {
    background: #495057;
}
.sidebar .dropdown-container {
    display: none;
    background-color: #495057;
    padding-left: 20px;
}

/* Active menu */
.sidebar .active {
    background-color: #007bff;
}

/* Content */
.content {
    flex-grow: 1;
    padding: 20px;
}

/* Toggle button */
.toggle-btn {
    display: none;
    background: #343a40;
    color: white;
    border: none;
    padding: 10px;
    margin-bottom: 10px;
}
@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        height: 100%;
        transform: translateX(-100%);
    }
    .sidebar.active {
        transform: translateX(0);
    }
    .toggle-btn {
        display: block;
    }
}

</style>