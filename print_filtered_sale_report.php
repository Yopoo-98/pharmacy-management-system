
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>


        <!--Font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

        <!--table Search-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

            <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

</head>
<body><br><br>

    <?php include"include/connection.php";
    
    // $id =$_GET['update_id'];

    $sql = "SELECT * FROM `pharmacy` ";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_assoc($query);

    $pharmacy_name = $rows['pharmacy_name'];
    $address    = $rows['address'];
    $phone_number= $rows['phone_number'];
    
    echo "
        <div style='text-align:center; margin-top:10px;'>
        <h2 style='font-weight:bold; color:red;'>$pharmacy_name</h2>
        <h5 style='font-weight:bold; color:red;'>$address</h5>
        <h5 style='font-weight:bold; color:red;'>$phone_number</h5>
        </div>
    ";
    ?><br>

  

   <h3 style="text-align: center;color: red;font-weight:bold"> <u>Sales Report</u> </h3>
    




<!--========================================================-->
<!--======== FILTERING SECTION PHP START====================-->
<!--========================================================-->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <?php 
  if(isset($_POST['filter'])){
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
   

    $sql = "SELECT * FROM sale_items inner join sale_manager on sale_items.sale_manager_id=sale_manager.sale_manager_id join medicine on sale_items.medicine_id= medicine.medicine_id where sale_manager.date between '$start_date' AND '$end_date'";
    $query= mysqli_query($conn, $sql);

    $grand_total=0;
     if(mysqli_num_rows($query)>0){?>
    
    
        <div class="col-lg-12">
          <table id="datatableid" class="table">
            <thead>

                        <th class="text-light" style="border: 1px solid black;background:black">Medicine Name</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Invoice Number</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Payment Mode</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Quantity</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Price</th>
                        <th class="text-light" style="border: 1px solid black;background:black">Date</th>
                          
            </thead>
            <tbody>
           
                <?php foreach($query as $value){
                   
                    $amount=$value['price'];
                           
                    $grand_total +=$amount;
                    ?>
                  <tr>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?=$value['medicine_name']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?=$value['invoice_number']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?=$value['payment_mode']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?=$value['quantity']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?=$value['price']?></td>
                                <td class="text-dark" style="border: 1px solid black;background:white"><?=$value['date']?></td>
                             
                    
                  </tr>
                  <?php } ?>

            </tbody>
          </table>

            <!--Total Calculation begins-->
            <div class="total" style="float: right;">
                <h2 style="color: red;font-weight:bolder;margin-right:20px">Total : <span><?php echo $grand_total;?></span></h2>
            </div>
            <!--Total Calculation Ends-->
        </div>

        <?php 
    }
    else{
   
      echo'<h2 class="text-center mt-5">No Data Found.</h2>
        <div><img src="png/question-mark.png"></div>
      ';
    }
  }
  else{
   
    
?><br>
        

        </div>
    </div>
</div>


<!--======================================================-->
<!--======== FILTERING SECTION PHP END====================-->
<!--======================================================-->



    <div class="container-fluid"><br>
        <div class="row">
     
            <div class="col-md-10 bg-light" style="border-radius:10px; border-bottom:2px solid orangered"><br><br>
                 <h4>Sold Drugs</h4>
                 <p style="margin-left:50px;margin-bottom:20px;">Manage Sales Report</h>
                 <h2 style="border-bottom:2px solid orangered;"> <a href="sale_report.php">Back</a></h2>


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
             
                       

                
                  <!--=========The beginning of the closing tag of the date filtering=================-->
            <?php } ?>
            <!--=========The Ending of the closing tag of the date filtering=================--> 
            

            <!--Print Function begins-->

            <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col">
                    <form action="" method="post">
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
       
            <!-- <div class="col-md-2"></div> -->
    
        </div>
    </div>



    <!--jquery cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- <script>
     new DataTable('#datatableid');
    </script> -->


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