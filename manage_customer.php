<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage customer</title>


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
            
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            <a href="add_customer.php" style="text-decoration:none">
                <div>
                    <h4 style="color: #A52A2A;font-weight:bolder">Add Customer</h4>
                </div>
                </a>
            </div>
            <div class="col-md-4">
                <!-- <div class="card-header">
   
                </div> -->
            </div>
            <div class="col-md-4">
                <!-- <a href="manage_supplier.php" style="text-decoration:none">
                <div class="card-header" style="border-radius:30px">
                    <h4 style="text-align:center; color:white">Manage Supplier</h4>
                </div>
                </a> -->
            </div>
        </div>
    </div>


    <div class="container-fluid"><br>
        <div class="row">         
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br>
                 <h4>Manage Customer</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Manage Existing Customer Record</h>
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
                <table id="datatableid" class="table table-responsive table-striped bg-info table-hover" >
                    <thead style="font-size:13px;" >
                        <tr>
                        <th class="text-dark" style="background:white">Customer's Name</th>
                        <th class="text-dark" style="background:white">Customer's Contact</th>
                        <th class="text-dark" style="background:white">Medication</th>

                        <th class="text-dark" style="background:white">Medical Condtion</th>
                        <th class="text-dark" style="background:white">Reporting Date</th>
                        <th class="text-dark" style="background:white">Customer's Address</th>

                        <th class="text-dark" style="background:white">Doctor's Name</th>
                        <th class="text-dark" style="background:white">Doctor's Address</th>
                        <th class="text-dark" style="background:white">Date</th>

                        <th class="text-dark" style="background:white">Action</th>

                        </tr>
                    </thead>
                      <tbody id="datatableid" class=" table table-responsive table-striped bg-info table-hover" style="color:navy; font-size: 16px; text-align: justify;">
                        
                        <?php

                            $sql = "SELECT * FROM customer";
                            $query= mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){
                            /*to display the data in the table, in the bracket of the assoc function you interchage the php syntax 
                            the question mark and greater than sign comes first and the less than and php goes down */                  
                            ?>
                                <tr>
                                
                                <td class="text-dark" style="background:white"><?php echo $row['customer_name']?></td>
                                <td class="text-dark" style="background:white"><?php echo $row['customer_contact']?></td>
                                <td class="text-dark" style="background:white"><?php echo $row['medication']?></td>
                                
                                <td class="text-dark" style="background:white"><?php echo $row['med_condition']?></td>
                                <td class="text-dark" style="background:white"><?php echo $row['drug_collection_date']?></td>
                                <td class="text-dark" style="background:white"><?php echo $row['customer_address']?></td>

                                <td class="text-dark" style="background:white"><?php echo $row['doctor_name']?></td>
                                <td class="text-dark" style="background:white"><?php echo $row['doctor_address']?></td>
                                <td class="text-dark" style="background:white"><?php echo $row['customer_date']?></td>
                            
                                <td style="background:white">
                                    <a href="update_customer.php?update_id=<?php echo $row['customer_id']?>" id="update" style="color:green;"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="print_customer.php?print_id=<?php echo $row['customer_id']?>" id="print" style="color:blue;"><i class="fa-solid fa-print"></i></a>
                                    <a onclick="return confirm('Do You Really Want to Delete This Record? ')" href="delete_customer.php?delete_id=<?php echo $row['customer_id']?>" id="delete" style="color:red;"><i class="fa-solid fa-trash"></i></a> 
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




     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    
    <!--==jquery link==-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        <!--==Products search button ==-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
          
          <script>
           $(document).ready(function(){
             $('.mySelect2').select2();
           });
          </script> 


    <!--==Table link==-->
    <!-- <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    
    
    <script>
     new DataTable('#datatableid');
    </script>
</body>
</html>

<style>
    a{
        text-decoration: none;
    }
 
</style>
