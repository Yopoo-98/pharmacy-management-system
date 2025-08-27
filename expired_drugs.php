<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired</title>


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
               <div class="container"><br>
        <div class="row">
            <div class="col-md-4">
                <a href="" style="text-decoration:none">
                    <div class="card-header" style="border-radius:30px;background-image: linear-gradient(to right,#A52A2A, )">
                        <h4 style="color:#A52A2A;font-weight:bolder">Expired Drugs</h4>
                    </div>
                </a>
               
            </div>
            <div class="col-md-4">
                <!-- <div class="card-header">
   
                </div> -->
            </div>
            <div class="col-md-4">
                <a href="print_expired_drugs.php" style="padding: 15px;color:white;background:green;border-radius: 10px;">Print</a>
            </div>
        </div>
    </div>


    <div class="container"><br>
        <div class="row">

                 
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Manage Medicine</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Manage Existing Drugs Recorded</h>
                 <h2 style="border-bottom:2px solid orangered;"></h2>


                 <div class="container">
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
                        
                     
                        <th class="text-light" style="border: 1px solid black;background:black">Supplier's Name</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Medicine Name</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Batch ID</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Generic Name</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Drug Condition</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class=" table" style="color:navy; font-size: 16px; text-align: justify;">
                        
                        <?php

                            $sql = "SELECT * FROM medicine where drug_condition='Expired' ";
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
                                
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['supplier_name']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['medicine_name']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['batch_id']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?php echo $row['generic_name']?></td>
                                <td class="text-light" style="border: 1px solid black;background:red;font-weight:bold;"><?php echo $row['drug_condition']?></td>   
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