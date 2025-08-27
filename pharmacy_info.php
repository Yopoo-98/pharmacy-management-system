
<?php 
//session_start();
include"include/connection.php";


if(isset($_POST['save_data'])){
    $pharmacy_name = htmlentities(mysqli_real_escape_string($conn,$_POST['pharmacy_name']));
    $phone_number = htmlentities(mysqli_real_escape_string($conn,$_POST['phone_number']));
    $address = htmlentities(mysqli_real_escape_string($conn,$_POST['address']));
    


    $sql = "INSERT INTO `pharmacy`(`pharmacy_name`, `address`, `phone_number`, `date`) VALUES ('$pharmacy_name','$address','$phone_number',now() )";
    $query = mysqli_query($conn,$sql);

if($query){
    $_SESSION['message'] = "Pharmacy Information Created Successfully. " . mysqli_error($conn);
    header("Location: manage_pharmacy.php?msg=Pharmacy Information Created Successfully. ");
    exit(0);
} 
else{
    $_SESSION['message'] = "Pharmacy Information Not Successfully Created. " . mysqli_error($conn);
    header("Location: pharmacy_info.php?msg=Pharmacy Information Not Successfully Created. ");
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
            
<div class="container px-4">
   <div class="row">
    <div class="col-md-12">
        <div class="card mt-5 shadow">
            <div class="card-header">
                <h5 class="mb-0">Add Pharmacy Details
                    <a href="manage_pharmacy.php" class="btn btn-danger float-end">Manage Pharmacy</a>
                </h5>
            </div>
            <div class="card-body">
                
                <form action="" method="post" enctype="multipart/form-data">    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Pharmacy's Name : </label>
                            <input type="text" name="pharmacy_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Phone Number </label>
                            <input type="text" name="phone_number" class="form-control" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Pharmacy Address : </label>
                           <textarea name="address"  class="form-control" rows="3"></textarea>
                        </div>
                    </div><br>
            
                    <div class="col-md-12 mb-3 text-end"><br>
                        <button type="submit" name="save_data" class="btn btn-primary">Save Information</button>
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