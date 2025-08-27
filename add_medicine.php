
<?php 
// include"authentication.php";
include"include/connection.php";


if(isset($_POST['add_medicine'])){
   
    $supplier_name = htmlentities(mysqli_real_escape_string($conn,$_POST['supplier_name']));
    $med_name = htmlentities(mysqli_real_escape_string($conn,$_POST['med_name']));
    $batch_id = htmlentities(mysqli_real_escape_string($conn,$_POST['batch_id']));
    $unit_px = htmlentities(mysqli_real_escape_string($conn,$_POST['unit_px']));
    $generic_name = htmlentities(mysqli_real_escape_string($conn,$_POST['generic_name']));
    $packing = htmlentities(mysqli_real_escape_string($conn,$_POST['packing']));
    $quantity = htmlentities(mysqli_real_escape_string($conn,$_POST['quantity']));
    $mrp = htmlentities(mysqli_real_escape_string($conn,$_POST['mrp']));
    $price = htmlentities(mysqli_real_escape_string($conn,$_POST['selling_price']));
    $min_quantity = htmlentities(mysqli_real_escape_string($conn,$_POST['min_quantity']));
    $expire_date = htmlentities(mysqli_real_escape_string($conn,$_POST['expire_date']));
    $current_date = htmlentities(mysqli_real_escape_string($conn,$_POST['current_date']));
  
    
    $profit = ($price - $mrp) * $quantity;

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
    $expire_days  =  " Expired " ; 
}
   

       
        $sql = "INSERT INTO `medicine`(`supplier_name`, `medicine_name`, `batch_id`,`unit_px`, `generic_name`, `packing`, `quantity`, `mrp`,`selling_price`, `profit`, `expired_date`, `purchase_date`,`drug_condition`,`min_quantity`,`date`) 
        VALUES 
        ('$supplier_name','$med_name','$batch_id','$unit_px','$generic_name','$packing','$quantity','$mrp','$price','$profit','$expire_date','$current_date','$expire_days','$min_quantity',now() )";
        $query = mysqli_query($conn,$sql);
    
    if($query){
        $_SESSION['message'] = "New Medicine Record Saved Successfully" . mysqli_error($conn);
        header("Location: add_medicine.php?msg=New Medicine Record Saved Successfully.");
        exit(0);
    } 
    else{
        $_SESSION['message'] = "Medicine Record Not Successfully Saved" . mysqli_error($conn);
        header("Location: add_medicine.php?msg=Medicine Record Not Successfully Saved. ");
        exit(0);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <!--Css link-->
    <link rel="stylesheet" href="style.css">
    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <?php include"sidebar/new_sidebar.php"?>

   <div class="content">

     <div class="container"><br><br><br>
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
                <a href="manage_medicine.php" style="text-decoration:none">
                <div class="" style="color:#A52A2A">
                    <h4 style="text-align:center; color:#A52A2A;font-weight:bolder;">Manage Medicine</h4>
                </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid"><br>
        <div class="row">

            
                 
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Add New Medicine</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Take New Drug Record</h>
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
                        <div class="col-md-4">
                                
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
                        <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Medicine's Name:</label>
                                    <input type="text" name="med_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Batch-ID:</label>
                                    <input type="text" name="batch_id" class="form-control" required>
                                </div>
                            </div>
                       </div><br>

                       <div class="row">
                        <div class="col-md-4">
                                
                                <div class="form-group mb-2">
                                    <label for="">Generic Name:</label>
                                    <input type="text" name="generic_name" class="form-control" required>
                                </div>
                            </div>
                        <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Packing:</label>
                                    <input type="text" name="packing" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Quantity:</label>
                                    <input type="text" name="quantity" class="form-control" required>
                                </div>
                            </div>
                       </div><br>

                       <div class="row">
                        <div class="col-md-4">
                                
                                <div class="form-group mb-2">
                                    <label for="">MRP:</label>
                                    <input type="text" name="mrp" class="form-control" required>
                                </div>
                            </div>
                        <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Selling Price:</label>
                                    <input type="text" name="selling_price" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Expired Date: </label>
                                    <input type="date" name="expire_date" class="form-control" required>
                                </div>
                            </div>
                       </div><br>

                       <div class="row">
                        <div class="col-md-3">
                                
                                <div class="form-group mb-2">
                                    <label for="">Current Date: </label>
                                    <input type="date" name="current_date" class="form-control" required>
                                </div>
                            </div>

                        <div class="col-md-3">
                               <div class="form-group mb-2">
                                    <label for="">Minimum Quantity (for shortage alert):</label>
                                    <input type="number" name="min_quantity" class="form-control" required>
                                </div>
                            </div>
                        <div class="col-md-3">
                               <div class="form-group mb-2">
                                    <label for="">Unit Px</label>
                                    <input type="text" name="unit_px" class="form-control" required>
                                </div>
                            </div>
                       
                            <div class="col-md-3">
                                <div class="form-group mt-2"><br>
                                    <a href="add_supplier.php" style="text-decoration:none">
                                        <h5 style="color:orangered">Add New Supplier</h5>
                                    </a>
                                </div>
                            </div>
                       </div><br>
                       
                        
                        
                       <button name="add_medicine" class="btn btn-primary" style="color:white">Record New Medicine</button><br><br>
                    
                </form>
            </div>
       
           
    
        </div>
    </div>

   </div>



    <!--jquery cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</body>
</html>

<style>
   a:hover{
    color:blue;
   }
</style>