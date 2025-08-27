
<?php 
session_start();
include"include/connection.php";

$conn = mysqli_connect("localhost","root","","pharmacy");

if(isset($_POST['login'])){

    //for authenticating the login
    $_SESSION['auth'] = true;

    $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    $raw_password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
    $fname = htmlentities(mysqli_real_escape_string($conn, $_POST['fname']));
    $lname = htmlentities(mysqli_real_escape_string($conn, $_POST['lname']));

   
   
 
{
        $sql= "SELECT * FROM `users` WHERE `email`='$email' ";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) ==1){
              $_SESSION['email'] = $email;
              $_SESSION['fname'] = $fname;
              $_SESSION['lname'] = $lname;
              $row = mysqli_fetch_assoc($query);
              $hashpassword = $row['password'];
              if(password_verify($raw_password,$hashpassword) ){
                echo"<script>window.open('home.php', '_self')</script>";
    }

        else{
          $_SESSION['message'] = "Your Email or Password is Incorrect" . mysqli_error($conn);
          header("Location: login.php?msg=Your Email or Password is Incorrect.");
          exit(0);
      }
       
       
    }
}}

     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar with Dropdown</title>

    <!--Css link-->
    <!-- <link rel="stylesheet" href="style.css"> -->

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

</head>
<body>


<div class="py-5 bg-light">
    <div class="container mt-5" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                    <div class="p-5">
                        <h4 class="mb-3 text-center">
                            Pharmacy Management System<br><br>
                            <img src="png/drugs.png" alt="" style="width: 100px;border-radius:50%;border:3px solid black">
                        </h4>
                        <form action="" method="post">
                                <?php
                                    if(isset($_GET['msg'])){
                                    $msg = $_GET['msg'];
                                    echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    '.$msg.'
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                    }
                                ?>
                            <div class="mb-3">
                                <input type="hidden" name="fname" class="form-control" required>
                                <input type="hidden" name="lname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Password:</label>
                                <input type="password" name="password" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="my-3">
                              <div class="row">
                                <div class="col-md-3">
                                    <button  class="btn btn-danger w-100 mt-2"><a href="index.html" style="color:white;text-decoration:none;font-weight:bold;">Back</a></button>
                                </div>
                                <div class="col-md-9">
                                     <button name="login" class="btn btn-success w-100 mt-2">Sign In</button>
                                </div>
                              </div>
                            </div>
                        </form>
                        <!-- <a href="student_login.php" style="text-decoration: none;font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-size:25px;margin-left:10px;color:red">Students Login</a> -->
                    </div>
            </div>
        </div>
    </div>
    </div>
</div>


       <!-- Option 1: Bootstrap Bundle with Popper -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 

    <!--jquery cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    </body>
</html>

<style>
     /* *{
    margin: 0;
    padding: 0;
}

#main-container{
    background-image: url(images/.jpeg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
} */
</style>