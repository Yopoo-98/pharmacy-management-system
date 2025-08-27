

<?php 
//session_start();
include"include/connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pharmacy</title>

    <!--Css link-->
    <link rel="stylesheet" href="style.css">

    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body>
    <?php include"sidebar/new_sidebar.php"?>

<div class="container-fluid px-4">
    <br><br>
   <div class="row">
  
    <div class="col-md-12">
        <div>
            <div>
                <h4 class="mb-0">Manage Pharmacy
                    <a href="pharmacy_info.php" class="btn btn-primary float-end">Pharmacy Info</a>
                </h4>
            </div>
            <div>
            <?php
                    if(isset($_GET['msg'])){
                    $msg = $_GET['msg'];
                    echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    '.$msg.'
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                     }
                ?>
            <table id="datatableid" class="table table-responsive table-striped bg-info table-hover" >
                    <thead style="font-size:13px;" >
                        <tr>
                        
                     
                     
                        <th>COMPANY NAME</th>             
                        <th>ADDRESS</th>             
                        <th>NUMBER</th>             
                                                                                  
                        <th>DATE RECORDED</th>                
                        <th>ACTION</th>

                        </tr>
                    </thead>
                    <tbody id="datatableid" class="table table-responsive table-striped bg-info table-hover">
                        
                        <?php

                            $sql = "SELECT * FROM `pharmacy`";
                            $query= mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){
                            /*to display the data in the table, in the bracket of the assoc function you interchage the php syntax 
                            the question mark and greater than sign comes first and the less than and php goes down */                  
                            ?>
                                <tr>
                                <td><?php echo $row['pharmacy_name']?></td> 
                                <td><?php echo $row['address']?></td> 
                                <td><?php echo $row['phone_number']?></td> 
                    
                                <td><?php echo $row['date']?></td>
                            
                                <td>
                                    <a href="update_pharmacy.php?update_id=<?php echo $row['pharmacy_id']?>" id="update" class="btn btn-success" style="text-decoration:none"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a onclick="return confirm('Do You Really Want to Delete This Record? ')" href="delete_pharmacy.php?delete_id=<?php echo $row['pharmacy_id']?>" class="btn btn-primary" style="text-decoration:none"><i class="fa-solid fa-trash"></i></a> 
                                </td>
                                
                                </tr>
                            
                            <?php
                            }
                        ?>
                    </tbody>
                </table>

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