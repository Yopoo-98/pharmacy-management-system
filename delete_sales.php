<?php
$conn = mysqli_connect("localhost","root","","pharmacy");
if(isset($_GET['delete_id'])){
  
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `sale_manager` WHERE `sale_manager_id` = $id";
    $query= mysqli_query($conn, $sql);
    if($query){
        $_SESSION['message'] = "Sale Record Deleted Successfully" . mysqli_error($conn);
        header("Location: manage_sale.php?msg=Sales Record Deleted Successfully. ");
        exit(0);
      }
      else{
        echo "Failed: " . mysqli_error($conn);
      }
  }
   
?>
