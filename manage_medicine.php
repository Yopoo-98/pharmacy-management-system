
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Medicine</title>
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
     <div class="container"><br><br><br>
        <div class="row">
            <div class="col-md-4">
            <a href="add_medicine.php" style="text-decoration:none">
                <div>
                    <h4 style="color:#A52A2A;font-weight:bolder">Add Medicine</h4>
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
    </div><br>


    <div class="container-fluid">
        <div class="row">
                 
            <div class="col-md-12">
                 <h4>Manage Medicine</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Manage Existing Drugs Recorded</h>
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
                        
                     
                        <th>Supplier's Name</th>
                        <th>Medicine Name</th>
                        <th>Batch ID</th>
                        <th>Unit PX</th>
                        <th>Generic Name</th>
                        <th>Packing</th>
                        <th>Quantity</th>
                        <th>MRP</th>
                        <th>Selling Price</th>
                        <th>Profit</th>
                        <th>Drug Condition</th>
                        <th>Date</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="datatableid" class=" table table-responsive table-striped bg-info table-hover" style="color:navy; font-size: 16px; text-align: justify;">
                        
                        <?php

                            $sql = "SELECT * FROM medicine order by date desc";
                            $query= mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){
                                
                                $expired_date = $row['expired_date'];

                                $purchased_date = date("y-m-d");
    
       
                                //now convert to strtotime(Checking Expiry Date)
    
                                $expiry_date = strtotime($expired_date); 
                                $purchase_date = strtotime($purchased_date); 
                                
                                if($purchase_date< $expiry_date){
                                //now we count how many days
                                    $diff = $expiry_date - $purchase_date;
                                    $medicine_condition = abs(floor($diff / (60 * 60 * 24))) . " day/s left";
                                }
                                else{
                                    $diff = $expiry_date - $purchase_date;
                                    // $medicine_condition  =  abs(floor($diff / (60 * 60 * 24))) . "day/s pass"; 
                                    $medicine_condition  =   "Expired"; 
                                }
                            ?>
                                <tr>
                                
                                <td><?php echo $row['supplier_name']?></td>
                                <td><?php echo $row['medicine_name']?></td>
                                <td><?php echo $row['batch_id']?></td>
                                <td><?php echo $row['unit_px']?></td>
                                <td><?php echo $row['generic_name']?></td>
                                <td><?php echo $row['packing']?></td>
                                <td><?php echo $row['quantity']?></td>
                                <td><?php echo $row['mrp']?></td>
                                <td><?php echo $row['selling_price']?></td>
                                <td><?php echo $row['profit']?></td>
                                <td>
                                <?php 
                                
                                 echo $medicine_condition
                                
                                ?>
                                </td>
                          
                                <td><?php echo $row['date']?></td>
                            
                                <td>
                                    <a href="update_medicine.php?update_id=<?php echo $row['medicine_id']?>" id="update" style="color:green;"><i class="fa-solid fa-pencil"></i></a>
                                    <a onclick="return confirm('Do You Really Want to Delete This Record? ')" href="delete_medicine.php?delete_id=<?php echo $row['medicine_id']?>" id="delete" style="color:red;"><i class="fa-solid fa-trash"></i></a> 
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
   img{
    width:10px;
    height:10px
   }
</style>