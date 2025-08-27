<?php
include "fpdf/fpdf.php";

// DB connection
$conn = mysqli_connect("localhost","root","","pharmacy");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// Check invoice number
if(!isset($_GET['invoice']) || empty($_GET['invoice'])){
    die("Invoice number not provided.");
}
$invoice_number = $_GET['invoice'];

// Fetch pharmacy info
$sql = "SELECT * FROM pharmacy LIMIT 1";
$pharmacy_result = mysqli_query($conn,$sql);
if(!$pharmacy_result || mysqli_num_rows($pharmacy_result) == 0){
    die("Pharmacy info not found.");
}
$pharmacy = mysqli_fetch_assoc($pharmacy_result);

// Fetch sale info
$sql_sale = "SELECT * FROM sale_manager WHERE invoice_number = '$invoice_number'";
$sale_result = mysqli_query($conn,$sql_sale);
if(!$sale_result || mysqli_num_rows($sale_result) == 0){
    die("Invoice not found.");
}
$sale = mysqli_fetch_assoc($sale_result);

// Fetch sale items
$sql_items = "
SELECT m.medicine_name, si.quantity_sold, si.price
FROM sale_items si
JOIN medicine m ON si.medicine_id = m.medicine_id
JOIN sale_manager sm ON si.sale_manager_id = sm.sale_manager_id
WHERE sm.invoice_number = '$invoice_number'
ORDER BY si.sale_item_id ASC
";
$items_result = mysqli_query($conn,$sql_items);
if(!$items_result){
    die("Error fetching sale items: " . mysqli_error($conn));
}

// Start PDF
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);
$pdf->Cell(190,10,$pharmacy['pharmacy_name'],0,1,"C");
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,8,$pharmacy['address'],0,1,"C");
$pdf->Cell(190,8,"Phone: ".$pharmacy['phone_number'],0,1,"C");
$pdf->Ln(5);

// Customer + Invoice Info
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,8,"Customer: ".$sale['customer_name'],0,0,"L");
$pdf->Cell(95,8,"Invoice No: ".$sale['invoice_number'],0,1,"R");
$pdf->Cell(95,8,"Payment Mode: ".$sale['payment_mode'],0,0,"L");
$pdf->Cell(95,8,"Date: ".$sale['date'],0,1,"R");
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial','B',11);
$pdf->Cell(80,10,"Medicine Name",1,0,"C");
$pdf->Cell(30,10,"Price",1,0,"C");
$pdf->Cell(30,10,"Qty",1,0,"C");
$pdf->Cell(50,10,"Total",1,1,"C");

// Table Rows
$pdf->SetFont('Arial','',11);
$grand_total = 0;
while($row = mysqli_fetch_assoc($items_result)){
    $total = $row['price'] * $row['quantity_sold'];
    $grand_total += $total;

    $pdf->Cell(80,10,$row['medicine_name'],1,0,"L");
    $pdf->Cell(30,10,number_format($row['price']),1,0,"C");
    $pdf->Cell(30,10,$row['quantity_sold'],1,0,"C");
    $pdf->Cell(50,10,number_format($total),1,1,"C");
}

// Grand Total
$pdf->SetFont('Arial','B',12);
$pdf->Cell(140,10,"Grand Total",1,0,"R");
$pdf->Cell(50,10,number_format($grand_total),1,1,"C");

// Output PDF
$pdf->Output();
?>
