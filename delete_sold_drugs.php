<?php
$conn = mysqli_connect("localhost","root","","new_pharmacy");
if(isset($_GET['delete_id'])){
  
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM `sale_items` WHERE `sale_manager_id` = $id";
    $query= mysqli_query($conn, $sql);
    if($query){
        $_SESSION['message'] = "Drug Record Deleted Successfully" . mysqli_error($conn);
        header("Location: sold_drugs.php?msg=Drug Record Deleted Successfully. ");
        exit(0);
      }
      else{
        echo "Failed: " . mysqli_error($conn);
      }
  }
   
?>
