<?php 
include"include/connection.php";

if(isset($_POST['add_supplier'])){
   
    $name = htmlentities(mysqli_real_escape_string($conn,$_POST['name']));
    $email = htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $contact = htmlentities(mysqli_real_escape_string($conn,$_POST['contact']));
    $address = htmlentities(mysqli_real_escape_string($conn,$_POST['address']));

 

    $e = "SELECT supplier_email from supplier where supplier_email = '$email'";
    $ee =  mysqli_query($conn,$e);
    $count = mysqli_num_rows($ee);
    if($count>0){
        $_SESSION['message'] = "Supplier's Email Already Used!!! Try New One" . mysqli_error($conn);
        header("Location: supplier.php?msg=Suppliers Email Already Used!!! Try New One. ");
        exit(0);
  }
    $e = "SELECT supplier_contact from supplier where supplier_contact = '$contact'";
    $ee =  mysqli_query($conn,$e);
    $count = mysqli_num_rows($ee);
    if($count>0){
        $_SESSION['message'] = "Contact Already Exist!!! Try New One" . mysqli_error($conn);
        header("Location: supplier.php?msgContact Already Exist!!! Try New One. ");
        exit(0);
  }
       
        $sql = "INSERT INTO `supplier`(`supplier_name`, `supplier_email`, `supplier_contact`, `supplier_address`, `supplier_date`) VALUES ('$name','$email','$contact','$address',now())";
        $query = mysqli_query($conn,$sql);
    
    if($query){
        $_SESSION['message'] = "New User Added Successfully" . mysqli_error($conn);
        header("Location: supplier.php?msg=New Supplier Account Created Successfully.");
        exit(0);
    } 
    else{
        $_SESSION['message'] = "New User Added Successfully" . mysqli_error($conn);
        header("Location: supplier.php?msg=New Supplier Account Not Created Successfully. ");
        exit(0);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>

    <!--Css link-->
    <link rel="stylesheet" href="style.css">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

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
                <a href="manage_supplier.php" style="text-decoration:none">
                <div>
                    <h4 style="color:#A52A2A;font-weight:bolder">Manage Supplier</h4>
                </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
                 
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br>
                 <h4>Add Supplier</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Create New Supplier Account</h>
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
                                    <label for="">Supplier's Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Supplier's Name">
                                </div>
                            </div>
                        <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Supplier's Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Contact</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Contact Number">
                                </div>
                            </div>
                       </div><br>
                       <div class="row">
                        
                        <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Address</label>
                                    <textarea name="address" id="" class="form-control" placeholder="Supplier's Address "></textarea>
                                </div>
                            </div>
                       </div>

                       <button name="add_supplier" class="btn btn-primary" >Add New Supplier</button><br><br>
                    
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
   
</style>