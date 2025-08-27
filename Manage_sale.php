
    <?php include"sidebar/new_sidebar.php"?>
    <?php include"include/connection.php"?>

    <div class="content">
        
    <div class="container-fluid"><br><br><br>
        <div class="row">
            <div class="col-md-4">
            <a href="sale.php" style="text-decoration:none">
                <div class="card-header" style="padding:10px;border-radius:30px;">
                    <h4 style="text-align:center; color: #A52A2A;font-weight:bolder">Add New Sale</h4>
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
            <div class="col">
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
                    
                        <th>Customer</th>
                        <th>Payment Mode</th>
                        <th>Medicine Name</th>
                        <th>Generic Name</th>
                        <th>Invoice_Number</th>
                      
                        <th>Amount  Paid</th>
                        <th>Discount</th>
                        
                        <th>Date</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                      <tbody id="datatableid" class=" table table-responsive table-striped bg-info table-hover" style="color:navy; font-size: 16px; text-align: justify;">
                        
                        <?php

              $sql = " SELECT 
                    sm.sale_manager_id,
                    sm.customer_name,
                    sm.payment_mode,
                    sm.total_amount,
                    sm.final_amount,
                    sm.invoice_number,
                    sm.date,
                    sm.discount,
                    m.medicine_name,
                    m.generic_name,
                    si.quantity_sold,
                    si.price
                FROM sale_manager sm
                JOIN sale_items si ON sm.sale_manager_id = si.sale_manager_id
                JOIN medicine m ON si.medicine_id = m.medicine_id
                ORDER BY sm.date DESC;
                ";
                            $query= mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($query)){
                            /*to display the data in the table, in the bracket of the assoc function you interchage the php syntax 
                            the question mark and greater than sign comes first and the less than and php goes down */                  
                            ?>
                                <tr>
                                
                                   
                                    <td><?= $row['customer_name'] ?></td>
                                    <td><?= $row['payment_mode'] ?></td>
                                   
                                    <td><?= $row['medicine_name'] ?></td>
                                    <td><?= $row['generic_name'] ?></td>
                                    <td><?= $row['invoice_number'] ?></td>
                                     <td><?= number_format($row['price'], 2) ?></td>
                                      <td><?= number_format($row['discount'], 2) ?></td>
                                 
                                    
                                   
                                    <td><?= $row['date']; ?></td>
                               
                                <td style="background:white">
                                <a href="print_sales.php?invoice=<?php echo $row['invoice_number']?>" id="print" style="color:blue;">
                                <i class="fa-solid fa-print"></i>
                                </a>

                                    <a onclick="return confirm('Do You Really Want to Delete This Record? ')" href="delete_sales.php?delete_id=<?php echo $row['sale_manager_id']?>" id="delete" style="color:red;"><i class="fa-solid fa-trash"></i></a> 
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



          <script>
           $(document).ready(function(){
             $('.mySelect2').select2();
           });
          </script> 


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
      <!--==Products search button ==-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <!--==jquery link==-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    
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
