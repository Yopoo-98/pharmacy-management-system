<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sold Drugs</title>


        <!--Font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

        <!--table Search-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

</head>
<body>
    <?php include"sidebar/new_sidebar.php"?>
    <?php include"include/connection.php"?>

   <div class="content">
     <div class="container-fluid"><br>
        <div class="row">
            <div class="col-md-4">
            <a href="add_sales.php" style="text-decoration:none">
                <div class="card-header" style="border-radius:30px;background-image: linear-gradient(to right,#A52A2A,)">
                    <h4 style="color: #d72400c2;font-weight:bolder">Add New Sales</h4>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <!-- <div class="card-header">
   
                </div> -->
            </div>
            <div class="col-md-4">
                <a href="payment_info.php" style="text-decoration:none">
                <div>
                    <h4 style="color: #0d99feff;font-weight:bolder">Payment Information</h4>
                </div>
                </a> 
            </div>
        </div>
    </div>


    <div class="container-fluid"><br>
        <div class="row">

            <!-- <div class="col-md-1"></div> -->
                 
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Manage Sold Drugs</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Manage Sold Drugs Records</h>
                 <h2 style="border-bottom:2px solid orangered;"></h2>


                 <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
                ?>
                <table id="datatableid" class="table"  style="border:2px solid black; background-color:gray;" >
                    <thead style="font-size:13px;" >
                        <tr>
                        
                     
                        
                        <th class="text-dark" style="background:white">Medicine Name</th>
                        <th class="text-dark" style="background:white">Price</th>
                        <th class="text-dark" style="background:white">Quantity</th>
                        <th class="text-dark" style="background:white">Date</th>
                        
                        <th class="text-dark" style="background:white">Action</th>

                        </tr>
                    </thead>
                    <tbody id="table-body" class=" table" style="color:navy; font-size: 16px; text-align: justify;">
                        
                        <?php

                            $sql = "SELECT m.medicine_name, si.quantity_sold, si.price, sm.date,si.sale_manager_id
                                    FROM sale_items si
                                    JOIN medicine m ON si.medicine_id = m.medicine_id
                                    JOIN sale_manager sm ON si.sale_manager_id = sm.sale_manager_id
                                    
                                    ORDER BY si.sale_item_id ASC";
                            $query= mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){
                                
                            ?>
                                <tr>
                                
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['medicine_name']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['price']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['quantity_sold']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['date']?></td>
                              
                                
                          
                              
                            
                                <td style="border: 1px solid black;background:white">
               
                                    <a onclick="return confirm('Do You Really Want to Delete This Record? ')" href="delete_sold_drugs.php?delete_id=<?php echo $row['sale_manager_id']?>" id="delete" style="color:red;"><i class="fa-solid fa-trash"></i></a> 
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
    </div>


   </div>

    <!--jquery cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
     new DataTable('#datatableid');
    </script>


</body>
</html>

<style>
    a{
        text-decoration: none;
    }
   img{
    width:10px;
    height:10px
   }
</style>