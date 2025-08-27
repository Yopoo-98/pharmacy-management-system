<?php
session_start();

include"include/connection.php";
session_destroy();

$_SESSION['message'] = "You have Logged Out Successfully !!!" . mysqli_error($conn);
header("Location: login.php?msg=You have Logged Out Successfully !!!.");
exit(0);
// header("Location:login.php");

?>