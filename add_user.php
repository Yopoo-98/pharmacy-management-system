
<?php 
include"include/connection.php";

if(isset($_POST['add_user'])){
   
    $fname = htmlentities(mysqli_real_escape_string($conn,$_POST['fname']));
    $lname = htmlentities(mysqli_real_escape_string($conn,$_POST['lname']));
    $email = htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
    $confirm_password = htmlentities(mysqli_real_escape_string($conn,$_POST['confirm_password']));
    
    $password==$confirm_password;
    if($password != $confirm_password){  
        $_SESSION['message'] = "Password Do Not Match!!!" . mysqli_error($conn);
        header("Location: add_user.php?msg=Password Do Not Match!!!.");
        exit(0);
       
      }

    if(strlen(($password) < 4)){
        $_SESSION['message'] = "Password Must Be a Maximum of 4 Characters" . mysqli_error($conn);
        header("Location: add_user.php?msg=Password Must Be a Maximum of 4 Characters. ");
        exit(0);
    }

    $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);


    $e = "SELECT email from users where email = '$email'";
    $ee =  mysqli_query($conn,$e);
    $count = mysqli_num_rows($ee);
    if($count>0){
        $_SESSION['message'] = "Email Already Used!!! Try New One" . mysqli_error($conn);
        header("Location: add_user.php?msg=Email Already Used!!! Try New One. ");
        exit(0);
  }
   
          
        $sql = "INSERT INTO `users`(`fname`, `lname`, `email`, `password`, `date`) VALUES ('$fname','$lname','$email','$bcrypt_password',now() )";
        $query = mysqli_query($conn,$sql);
    
    if($query){
        $_SESSION['message'] = "New User Record Saved Successfully" . mysqli_error($conn);
        header("Location: add_user.php?msg=New User Record Saved Successfully.");
        exit(0);
    } 
    else{
        $_SESSION['message'] = "User Record Not Successfully Saved" . mysqli_error($conn);
        header("Location: add_user.php?msg=User Record Not Successfully Saved. ");
        exit(0);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>

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
                <a href="manage_user.php" style="text-decoration:none">
                <div>
                    <h4 style="color:#A52A2A;font-weight:bolder">Manage Users</h4>
                </div>
                </a>
            </div>
        </div>
    </div>


    <div class="container-fluid"><br>
        <div class="row">

          
                 
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Add New User</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">User Information</h>
                 <h2 style="border-bottom:2px solid orangered;"></h2>
                    <br>
                 
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
                                    <label for="">First Name:</label>
                                    <input type="text" name="fname" class="form-control" required>
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lname" class="form-control" required>
                                </div>
                            </div>
                            
                       </div><br>

                       <div class="row">
                       
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Email: </label>
                                    <input type="text" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Password: </label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Confirm Password: </label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                            </div>
                          
                       </div><br>
 
                       <button name="add_user" class="btn btn-primary" style="color:white">Add New User</button><br><br>
                    
                </form>
            </div>
       
            <div class="col-md-2"></div>
    
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