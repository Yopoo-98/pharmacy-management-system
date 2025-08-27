
<?php 
include"include/connection.php";

if(isset($_POST['purchase'])){
   
    $supplier_name = htmlentities(mysqli_real_escape_string($conn,$_POST['supplier_name']));
    $med_name = htmlentities(mysqli_real_escape_string($conn,$_POST['med_name']));
    $batch_id = htmlentities(mysqli_real_escape_string($conn,$_POST['batch_id']));
    $generic_name = htmlentities(mysqli_real_escape_string($conn,$_POST['generic_name']));
    $packing = htmlentities(mysqli_real_escape_string($conn,$_POST['packing']));
    $quantity = htmlentities(mysqli_real_escape_string($conn,$_POST['quantity']));
    $mrp = htmlentities(mysqli_real_escape_string($conn,$_POST['mrp']));
    // $amount = htmlentities(mysqli_real_escape_string($conn,$_POST['amount']));
    $expire_date = htmlentities(mysqli_real_escape_string($conn,$_POST['expire_date']));
    $current_date = htmlentities(mysqli_real_escape_string($conn,$_POST['current_date']));
    $payment_mode = htmlentities(mysqli_real_escape_string($conn,$_POST['payment_mode']));

    $invoice_number= "XYZ" . rand(0,9999);
  
    $amount;
    $amount =  $mrp * $quantity;

    $expiry_days;
//now convert to strtotime
$exp = strtotime($expire_date); 
$td = strtotime($current_date); 

if($td < $exp){
//now we count how many days
    $diff = $exp - $td;
    $expire_days = abs(floor($diff / (60 * 60 * 24))) . " day/s to expire";
}
else{
    $diff = $td - $exp;
    // $expire_days  ="Expired for "  . abs(floor($diff / (60 * 60 * 24))) . " day/s" ; 
    $expire_days  ="Expired" ; 
}
   

       
        $sql = "INSERT INTO `purchase`(`supplier_name`, `payment_type`,`invoice_number`,`medicine_name`, `generic_name`, `packing`, `batch_id`, `quantity`, `mrp`, `amount`, `expired_date`, `present_date`,`medicine_condition`, `purchase_date`) 
        VALUES 
        ('$supplier_name','$payment_mode','$invoice_number','$med_name','$generic_name','$packing','$batch_id','$quantity','$mrp','$amount','$expire_date','$current_date','$expire_days',now())";
        
        $query = mysqli_query($conn,$sql);
    
    if($query){
        $_SESSION['message'] = "New Purchase Record Saved Successfully" . mysqli_error($conn);
        header("Location: add_purchase.php?msg=New Purchase Record Saved Successfully.");
        exit(0);
    } 
    else{
        $_SESSION['message'] = "Purchase Record Not Successfully Saved" . mysqli_error($conn);
        header("Location: add_purchase.php?msg=Purchase Record Not Successfully Saved. ");
        exit(0);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>



    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>
    <?php include"sidebar/new_sidebar.php"?>

   <div class="content">

     <div class="container"><br>
        <div class="row">
            <div class="col-md-4">
                <!-- <div class="card-header">
   
                </div> -->
            </div>
            <div class="col-md-4">
                <!-- <div class="card-header">
   
                </div> -->
            </div>
            <div class="col-md-4">
                <a href="manage_purchase.php" style="text-decoration:none">
                <div>
                    <h4 style="color:#A52A2A;font-weight:bolder">Manage Purchase</h4>
                </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br>
                 <h4>Purchase New Medicine</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Buy New Drugs</h>
                 <h2 style="border-bottom:2px solid orangered;"></h2>

                 
                 <?php
                    if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    '.$msg.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                     }
                    ?>
    
                 <form action="" method="post">
                       <div class="row">
                        <div class="col-md-6">
                                
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Name:</label>
                                    <select name="supplier_name" class="form-control" id="" required>
                                    <option selected>Select Supplier's Name</option>
                                        <?php 
                                         $sql = "SELECT supplier_name FROM supplier";
                                         $query= mysqli_query($conn, $sql);
                                         while($row = mysqli_fetch_assoc($query)){
                                            $supplier_name = $row['supplier_name'];
                                            
                                            echo"<option value='$supplier_name'>$supplier_name</option>";
                                        ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="">Payment Type:</label>
                                    <select name="payment_mode" id="" class="form-control">
                                        <option selected>Select Payment Type</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Momo">Momo</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Net Banking">Net Banking</option>
                                    </select>
                                 
                                </div>
                            </div>
                       </div><br><hr><br>
                            

                    <div class="row">
                        
                    <div class="main-form mt-3 border-bottom">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                <label for="">Medicine Name:</label>
                                                <input type="text" name="med_name" class="form-control"  Required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                <label for="">Generic Name: </label>
                                                <input type="text" name="generic_name" class="form-control"  Required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-2">
                                                <label for="">Packing:</label>
                                                <input type="text" name="packing" class="form-control"  Required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-2">
                                                <label for="">Batch-ID</label>
                                                <input type="text" name="batch_id" class="form-control"  Required>
                                            </div>
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                <label for="">Expired Date:</label>
                                                <input type="date" name="expire_date" class="form-control"  Required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                <label for="">Current Date: </label>
                                                <input type="date" name="current_date" class="form-control"  Required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-2">
                                                <label for="">Quantity:</label>
                                                <input type="text" name="quantity" class="form-control" id="quantity" onkeyup="cal_quantity(this.value);" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-2">
                                                <label for="">MRP:</label>
                                                <input type="text" name="mrp" class="form-control" id="mrp" onkeyup="cal_mrp(this.value)" Required>
                                            </div>
                                        </div>

                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-2">
                                                <label for="" id="">Amount:</label>
                                                <input type="text" name="amount" class="form-control" id="amount" disabled>
                                            </div>
                                        </div>
                                    </div><br>

                                    <button name="purchase" class="btn btn-primary" style="color:white; margin-bottom:30px">Save Purchase</button>
                            </div>
                </form>
            </div>

        </div>
    </div>

   </div>



    <!-- jquery cdn link -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

    
    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

<script type="text/javascript" src="add_purchase.js"></script>
</html>

<style>
      #link{
        text-decoration: none;
        color:red;
        text-align: center;
    }
     #link:hover{
        text-decoration: none;
        color:green;
        font-weight: bold;
    }
    #add_button{
        width: 40px;
    }
    .remove-btn{
        border:none;
        margin-top:10px;
    }
    #remove_button{
        width: 25px;
    }
</style>