<?php
include"fpdf/fpdf.php";
$conn = mysqli_connect("localhost","root","","pharmacy");

    $id =$_GET['print_id'];

   $sql = "SELECT * FROM `pharmacy` ";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_assoc($query);


 
    $pdf = new FPDF('p','mm','A4');//this is the paper page size

    $pdf ->AddPage('L');//landscape

   
    $pdf -> SetFont('arial','b','25');
    $pdf -> SetTextColor(0,0,0);

    $pdf -> cell(300,10,$rows['pharmacy_name'], 0, 1, "C", false);

    $pdf -> SetFont('arial','b','16');

    $pdf -> cell(300,10,$rows['address'], 0, 1, "C", false);
    $pdf -> cell(300,10,$rows['phone_number'], 0, 1, "C", false);


    $pdf -> Ln(5);//line break

//ABOUT CUSTOMER DETAILS
    // $sql = "SELECT * FROM `order_manager` ";
    // $query = mysqli_query($conn,$sql);
    // $rows = mysqli_fetch_assoc($query);
    // $id =$rows['manager_id'];

    $sql = "SELECT * FROM customer  WHERE customer_id=$id";
    $query = mysqli_query($conn,$sql);
    while($rows = mysqli_fetch_assoc($query)){

    $pdf -> SetFont('arial','b','15');
    $pdf -> cell(30,10,"Customer Details", 0, 0, "L", false);
    $pdf -> cell(190,10,"Doctors Information", 0, 1, "R", false);

    $pdf -> SetFont('arial','b','12');
    $pdf -> cell(51,10,"Customer's Name:", 0, 0, "L", false);
    $pdf -> cell(20,10,$rows['customer_name'], 0, 0, "L", false);

    //doctor info
    $pdf -> cell(130,10,"Doctor's Name:", 0, 0, "R", false);
    $pdf -> cell(38,10,$rows['doctor_name'], 0, 1, "R", false);

     //customer info
    $pdf -> cell(51,10,"Customer's Contact:", 0, 0, "L", false);
    $pdf -> cell(20,10,$rows['customer_contact'], 0, 0, "L", false);
    
     //doctor info
    $pdf -> cell(134,10,"Doctor's Contact:", 0, 0, "R", false);
    $pdf -> cell(35,10,$rows['doctor_address'], 0, 1, "R", false);

    //customer Info
    $pdf -> cell(51,10,"Medication:", 0, 0, "L", false);
    $pdf -> cell(20,10,$rows['medication'], 0, 0, "L", false);

      //doctor info
    $pdf -> cell(110,10,"Date:", 0, 0, "R", false);
    $pdf -> cell(30,10,$rows['customer_date'], 0, 1, "R", false);

    //customer Info
    $pdf -> cell(51,10,"Medical Condition:", 0, 0, "L", false);
    $pdf -> cell(20,10,$rows['med_condition'], 0, 1, "L", false);

    $pdf -> cell(51,10,"Reporting Date:", 0, 0, "L", false);
    $pdf -> cell(20,10,$rows['drug_collection_date'], 0, 1, "L", false);

    $pdf -> cell(51,10,"Customer Address:", 0, 0, "L", false);
    $pdf -> cell(20,10,$rows['customer_address'], 0, 1, "L", false);
    
    // $pdf -> cell(51,10,"Date:", 0, 0, "L", false);
    // $pdf -> cell(20,10,$rows['date'], 0, 1, "L", false);
    }

    $pdf -> Ln(5);
    
$pdf ->Output();
?>