<?php 
include"include/connection.php";


$id = $_GET['update_id']; 
if(isset($_POST['add_supplier'])){
    $name = htmlentities(mysqli_real_escape_string($conn,$_POST['name']));
    $email = htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $contact = htmlentities(mysqli_real_escape_string($conn,$_POST['contact']));
    $address = htmlentities(mysqli_real_escape_string($conn,$_POST['address']));

 
       
        $sql = "UPDATE `supplier` SET `supplier_id`='$id',`supplier_name`='$name',`supplier_email`='$email',`supplier_contact`='$contact',`supplier_address`='$address',`supplier_date`=now() WHERE supplier_id ='$id' ";
        $query = mysqli_query($conn,$sql);
    
    if($query){
        $_SESSION['message'] = "Supplier Account Update Successfully" . mysqli_error($conn);
        header("Location: manage_supplier.php?msg=Supplier Account Update Successfully.");
        exit(0);
    } 
    else{
        $_SESSION['message'] = "Supplier Account Not Update Successfully" . mysqli_error($conn);
        header("Location: manage_supplier.php?msg=Supplier Account Not Update Successfully. ");
        exit(0);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier</title>

    <!--Css link-->
    <link rel="stylesheet" href="style.css">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body>
<?php include"sidebar/new_sidebar.php"?>

<?php
        $sql = "SELECT * FROM `supplier` where supplier_id =$id ";
        
        $query = mysqli_query($conn,$sql);
    
        $row = mysqli_fetch_assoc($query);
        ?>

 

  <div class="content">

        
          <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="add_supplier.php" style="text-decoration:none">
                            <div>
                                <h4 style="color:#A52A2A;font-weight:bolder">Add Supplier</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <!-- <div class="card-header">
        
                        </div> -->
                    </div>
                    <div class="col-md-4">
                        <!-- <a href="manage_supplier.php" style="text-decoration:none">
                        <div class="card-header" style="border-radius:30px">
                            <h4 style="text-align:center; color:white">Manage Supplier</h4>
                        </div>
                        </a> -->
                    </div>
                </div>
          </div>

          <div class="container-fluid"><br>
        <div class="row">
            <div class="col-md-2"></div>
                 
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Update Supplier</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Update Supplier Account</h>
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
                                    <input type="text" name="name" class="form-control" placeholder="Supplier's Name" value="<?php echo $row['supplier_name']?>">
                                </div>
                            </div>
                        <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Supplier's Email" value="<?php echo $row['supplier_email']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Contact</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Contact Number" value="<?php echo $row['supplier_contact']?>">
                                </div>
                            </div>
                       </div><br>
                       <div class="row">
                        
                        <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="">Supplier's Address</label>
                                    <textarea name="address" id="" class="form-control" placeholder="Supplier's Address "><?php echo $row['supplier_address']?></textarea>
                                </div>
                            </div>
                       </div>

                       <button name="add_supplier" class="btn btn-primary" style="background:orangered; color:white">Update Supplier</button><br><br>
                    
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