# pharmacy-management-system
-A Pharmacy Management System built with PHP & MySQL to streamline medicine inventory, sales, supplier management, and reporting. This system helps pharmacists manage stock, track sales, and ensure smooth day-to-day operations.

Features

**User Authentication

-Secure login and registration with hashed passwords.

-Role-based access (Admin, Pharmacist, Cashier).

**Medicine Management

-Add, update, and delete medicines.

-Track batch ID, expiry date, supplier, and stock levels.

-Automatic alerts for expired and low-stock medicines.

**Sales Management

-Generate sales invoices.

-Apply discounts and calculate final totals.

-Print receipts for customers.

**Supplier Management

-Store supplier details.

-Manage medicine supply records.

**Reports & Dashboard

-Daily, weekly, and monthly sales reports.

-Graphical charts for sales trends.

-Low stock and expired drug reports.

**Tech Stack

-Frontend: HTML, CSS, Bootstrap, JavaScript (DataTables, Chart.js)

-Backend: PHP (Procedural & OOP)

-Database: MySQL

-Server: Apache (XAMPP / WAMP / LAMP)

**Project Structure
pharmacy-management/
│── config/             # Database connection  
│── css/                # Stylesheets  
│── js/                 # JavaScript files  
│── fpdf/               # PDF generation library  
│── index.php           # Dashboard (main page)  
│── login.php           # User login  
│── register.php        # User registration  
│── medicines.php       # Manage medicines  
│── sales.php           # Manage sales & invoices  
│── suppliers.php       # Supplier management  
│── reports.php         # Sales & stock reports  
│── print_sales.php     # Receipt generation  
│── README.md           # Documentation  


⚙️ Installation

1. Clone the repository:
git clone https://github.com/Yopoo-98/pharmacy-management-system.git

2. Move the project folder to your server (e.g., htdocs for XAMPP).

3. Import the database:

-Open phpMyAdmin.

-Create a new database (e.g., pharmacy).

-Import the pharmacy.sql file.
 
4. Update database credentials in include/connection.php:
     $conn = mysqli_connect("localhost", "root", "", "pharmacy");
5. Start Apache & MySQL from XAMPP/WAMP.
6. Open the system in your browser:
   
** User Credentials
Email: frimpongfredrick87@gmail.com
Password: 0548567598



web based pharmacy_m_system
