<?php
$conn = mysqli_connect("localhost", "root", "", "pharmacy");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $payment_mode = $_POST['payment_mode'];
    $discount = floatval($_POST['discount']);
    $grand_total = floatval($_POST['grand_total']);
    $final_total = floatval($_POST['final_total']);

    

    // Generate invoice number
    $invoice_number = "INV-" . rand(100000, 999999);

    // Insert invoice into sale_manager
    $sql = "INSERT INTO sale_manager (customer_name, payment_mode, invoice_number, discount, total_amount, final_amount) 
            VALUES ('$customer_name', '$payment_mode', '$invoice_number', '$discount', '$grand_total', '$final_total')";
    mysqli_query($conn, $sql);
    $sale_manager_id = mysqli_insert_id($conn);

    // Insert sale items
    foreach ($_POST['medicine_id'] as $index => $medicine_id) {
        if ($medicine_id == "") continue; // skip empty rows

        $price = floatval($_POST['price'][$index]);
        $qty = intval($_POST['quantity'][$index]);
        $line_total = $price * $qty;

        $insert_item = "INSERT INTO sale_items (sale_manager_id, medicine_id, quantity_sold, price, total)
                        VALUES ('$sale_manager_id', '$medicine_id', '$qty', '$price', '$line_total')";
        mysqli_query($conn, $insert_item);

        // Update stock
        $update_stock = "UPDATE medicine SET quantity = quantity - $qty WHERE medicine_id = $medicine_id";
        mysqli_query($conn, $update_stock);
    }
    header("Location: sale.php?msg=Sale Completed Successfully&invoice=$invoice_number");
    exit;
}
?>
