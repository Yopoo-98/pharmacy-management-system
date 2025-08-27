<?php 
$conn = mysqli_connect("localhost","root","","pharmacy");
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] != true){
    $_SESSION['message'] = "Login First to access the site" . mysqli_error($conn);
          header("Location: login.php?msg=Login First to access the site.");
          exit(0);
}


?>