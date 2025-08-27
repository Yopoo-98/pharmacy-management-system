<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Report</title>


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
      
            <div class="col-md-12" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Sold Drugs</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Manage Sold Drugs Report</h>
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
                <table id="#datatableid" class=" table" style="color:navy; font-size: 16px; text-align: justify;">
                    
                        <tr>
                        <th>Medicine Name</th>
                        <th>Invoice Number</th>
                        <th>Payment Mode</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        </tr>
                   
                   
                        
                        <?php

                            $sql = "SELECT * FROM sale_items inner join sale_manager on sale_items.sale_manager_id=sale_manager.sale_manager_id join medicine on sale_items.medicine_id= medicine.medicine_id";
                            $query= mysqli_query($conn, $sql);

                            $grand_total=0;
                            while($row = mysqli_fetch_assoc($query)){
                            
                          
                           $amount=$row['price'];
                           
                           $grand_total +=$amount;
    
                            ?>
                                <tr>
                                <td><?php echo $row['medicine_name']?></td>
                                
                                <td><?php echo $row['invoice_number']?></td>
                                <td><?php echo $row['payment_mode']?></td>
                                <td><?php echo $row['quantity_sold']?></td>
                                <td><?php echo $row['price']?></td>
                                <td><?php echo $row['date']?></td>
                               
                                </tr>
                            
                            <?php
                            }
                        ?>

                        

               
                   
                </table><br>
                        <!--Total Calculation begins-->
                        <div class="total" style="float: right;">
                            <h2 style="color: red;font-weight:bolder;margin-right:20px">Total : <span><?php echo $grand_total;?></span></h2>
                        </div>
                        <!--Total Calculation Ends-->

                
            <!--Print Function begins-->

            <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col">
                    <form action="print_sales_report.php" method="post">
                        <div class="container">
                        <div class="row">

                            <div class="col-md-4">
                            <button onclick="window.print(hideButton(this))" class="btn btn-success btn-start">Print</button>
                            
                            </div>
                
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            </div><br> 

            <!--=============================================-->
            <!--=============hide button=====================-->
            <!--=============================================-->
            <script>
                function hideButton(x){
                x.style.display = 'none';
            }
            </script>

            <!--Print Function ends-->

            </div>
        </div>
    </div>


            </div>
       
            <div class="col-md-1"></div>
    
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