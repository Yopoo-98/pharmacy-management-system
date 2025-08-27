<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(isset($_GET['delete_id'])){
  
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `purchase` WHERE `purchase_id` = $id";
    $query= mysqli_query($conn, $sql);
    if($query){
        $_SESSION['message'] = "Purchase Record Deleted Successfully" . mysqli_error($conn);
        header("Location: manage_purchase.php?msg=Purchase Record Deleted Successfully. ");
        exit(0);
      }
      else{
        echo "Failed: " . mysqli_error($conn);
      }
  }
   
?>
