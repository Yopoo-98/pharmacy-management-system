
<?php 
include"include/connection.php";

$id = $_GET['update_id']; 
if(isset($_POST['update_customer'])){
    $customer_name = htmlentities(mysqli_real_escape_string($conn,$_POST['customer_name']));
    $doctor_name = htmlentities(mysqli_real_escape_string($conn,$_POST['doctor_name']));
    $doctor_address = htmlentities(mysqli_real_escape_string($conn,$_POST['doctor_address']));
    $customer_contact = htmlentities(mysqli_real_escape_string($conn,$_POST['customer_contact']));
    $customer_address = htmlentities(mysqli_real_escape_string($conn,$_POST['customer_address']));
      $medication = htmlentities(mysqli_real_escape_string($conn,$_POST['medication']));
    $med_condition = htmlentities(mysqli_real_escape_string($conn,$_POST['med_condition']));
    $drug_collection_date = htmlentities(mysqli_real_escape_string($conn,$_POST['drug_collection_date']));
   
  
 

       
        $sql = "UPDATE `customer` SET `customer_id`='$id',`customer_name`='$customer_name',`customer_contact`='$customer_contact',`medication`='$medication',`med_condition`='$med_condition',`drug_collection_date`='$drug_collection_date',`doctor_name`='$doctor_name',`customer_address`='$customer_address',`doctor_address`='$doctor_address',`customer_date`=now() WHERE customer_id = $id";
        $query = mysqli_query($conn,$sql);
    
    if($query){
        $_SESSION['message'] = " Customer Record Updated Successfully" . mysqli_error($conn);
        header("Location: manage_customer.php?msg= Customer Record Updated Successfully.");
        exit(0);
    } 
    else{
        $_SESSION['message'] = "Customer Record Not Successfully Updated" . mysqli_error($conn);
        header("Location: manage_customer.php?msg=Customer Record Not Successfully Updated. ");
        exit(0);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>

    <!--Css link-->
    <link rel="stylesheet" href="style.css">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body>
    <?php include"sidebar/new_sidebar.php"?>

    <?php
        $sql = "SELECT * FROM `customer` where customer_id =$id ";
        
        $query = mysqli_query($conn,$sql);
    
        $row = mysqli_fetch_assoc($query);
        ?>

    <div class="content">
        
        <div class="container">
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
                    <a href="manage_customer.php" style="text-decoration:none">
                    <div>
                        <h4 style="color: #A52A2A;font-weight:bolder">Manage Customer</h4>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br>
                    <h4>Update Customer</h4>
                    <p style="margin-left:50px;margin-bottom:20px;">Update Customer Information</h>
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
                                        <label for="">Customer's Name:</label>
                                        <input type="text" name="customer_name" class="form-control" value="<?php echo $row['customer_name']?>">
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Customer's Contact:</label>
                                        <input type="text" name="customer_contact" class="form-control" value="<?php echo $row['customer_contact']?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Doctor's Name</label>
                                        <input type="text" name="doctor_name" class="form-control" value="<?php echo $row['doctor_name']?>">
                                    </div>
                                </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-4">
                                    
                                    <div class="form-group mb-2">
                                        <label for="">Medical Condition:</label>
                                        <input type="text" name="med_condition" class="form-control" value="<?php echo $row['med_condition']?>" required>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Medication:</label>
                                        <input type="text" name="medication" class="form-control" value="<?php echo $row['medication']?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Drug Collection Date</label>
                                        <input type="text" name="drug_collection_date" class="form-control" value="<?php echo $row['drug_collection_date']?>" required>
                                    </div>
                                </div>
                        </div><br>

                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Customer's Address:</label>
                                        <textarea name="customer_address" id="" class="form-control" placeholder="Enter Customer's Address Here"><?php echo $row['customer_address']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Doctor's Address:</label>
                                        <textarea name="doctor_address" id="" class="form-control" placeholder="Enter Doctor's Address Here"><?php echo $row['doctor_address']?></textarea>
                                    </div>
                                </div>
                            
                        </div><br>
    
                        <button name="update_customer" class="btn btn-success" style="color:white">Update Customer</button><br><br>
                        
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