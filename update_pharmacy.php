
<?php 
//session_start();
include"include/connection.php";


$id =$_GET['update_id'];
if(isset($_POST['update_company'])){
   $pharmacy_name = htmlentities(mysqli_real_escape_string($conn,$_POST['pharmacy_name']));
   $phone_number = htmlentities(mysqli_real_escape_string($conn,$_POST['phone_number']));
   $address = htmlentities(mysqli_real_escape_string($conn,$_POST['address']));
   
  

   $sql = " UPDATE `pharmacy` SET `pharmacy_id`='$id',`pharmacy_name`='$pharmacy_name',`address`='$address',`phone_number`='$phone_number',`date`=now() WHERE pharmacy_id = '$id' ";
   $query = mysqli_query($conn,$sql);

   if($query){
       $_SESSION['message'] = "Pharmacy Information  Successfully Updated. " . mysqli_error($conn);
       header("Location: manage_pharmacy.php?msg=Pharmacy Information  Successfully Updated. ");
       exit(0);
   } 
   else{
       $_SESSION['message'] = "Pharmacy Information Not Successfully Updated. " . mysqli_error($conn);
       header("Location: update_pharmacy.php?msg=Pharmacy Information Not Successfully Updated. ");
       exit(0);
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Pharmacy</title>

    <!--Css link-->
    <link rel="stylesheet" href="style.css">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body>
    <?php include"sidebar/new_sidebar.php"?>


<div class="content">

    <?php  
   $sql = "SELECT * FROM `pharmacy` WHERE pharmacy_id = $id ";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_assoc($query);
 ?>

 
<div class="container-fluid px-4">
   <div class="row">
  
    <div class="col-md-12">
        <div class="card mt-5 shadow">
            <div class="card-header">
                <h5 class="mb-0">Update Company Details
                    <a href="manage_pharmacy.php" class="btn btn-danger float-end">Manage Pharmacy Data</a>
                </h5>
            </div>
            <div class="card-body">
                
                <form action=" " method="post" enctype="multipart/form-data">    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Pharmacy's Name : </label>
                            <input type="text" name="pharmacy_name" class="form-control" value="<?php echo $rows['pharmacy_name']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="">Phone Number </label>
                            <input type="text" name="phone_number" class="form-control" value="<?php echo $rows['phone_number']?>">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Pharmacy Address : </label>
                           <textarea name="address"  class="form-control" rows="3"><?php echo $rows['address']?></textarea>
                        </div>
                    </div><br>
                    
            
                    <div class="col-md-12 mb-3 text-end"><br>
                        <button type="submit" name="update_company" class="btn btn-primary">Update Pharmacy</button>
                    </div>    
                </form>

            </div>
        </div>
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