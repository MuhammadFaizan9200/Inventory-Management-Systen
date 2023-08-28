<?php

        include("headers/connect.php");
        include("headers/_user-details.php");
        $array = array();
        $temparray = array();
        $returnArray =array();

        $purchaseInvoiceID = @$_GET['id'];

        $fetch_query = "SELECT * FROM `purchase_invoice`  where id = '$purchaseInvoiceID'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        $product_id = $rows['id'];
        $invoiceNumber = $rows['purchase_invoice_#'];
        $date = $rows['date'];
        $foreignCurrency = $rows['foreighn_currency'];

        $vendorName = $rows['vendorName'];
        $vendorAddress = $rows['vendorAddress'];
        $contactPerson  = $rows['contactPerson'];
        $contactNumber = $rows['contactNumber'];
        $totalItem = $rows['totalItem'];
        $totalQuantity = $rows['totalQuantity'];

?>
<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
       <title>View Purchase Invoice | ppipopular</title>
    <style>
    #profileImage {    
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #2a3542;
        font-size: 21px;
        color: #fff;
        float: left;
        text-align: center;
        line-height: 40px;
        text-transform: none;
        }
        .custom_button_align{
            float: right!important;
        } 
.ui-builder{
                display: none;
            }              
    </style>
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->

    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
                <?php include('headers/navigation.php') ?>
            
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                 <?php include('headers/top-navigation.php') ?>
            
              <!-- [ Layout content ] Start -->
                <div class="layout-content">

                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">View Purchase Invoice</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">View Purchase Invoice</li>
                            </ol>
                        </div>



                        <div class="card mb-4">
                            <h3 class="card-header" align="Center"><i class="fas fa-box-open" style="font-size:35px; "></i> &nbsp; Purchase Invoice</h3>
                            <div class="card-body">
                                <form method="post" id="purchaseInvoice">
                                    <div class="form-row">

                              
                                    <div class="form-group col-md-4">
                                      <label class="form-label">Vendor Name</label>
                                     <input type="text" class="form-control" name="vendorName" readonly value="<?php echo $vendorName  ?>" placeholder="Complete Name">
                                     <div class="clearfix"></div><br>
                                         
                                        <label class="form-label">Vendor Address</label>
                                         <input type="text" class="form-control" name="vendorAddress" readonly value="<?php echo $vendorAddress  ?>" placeholder="Complete Address">
                                          <div class="clearfix"></div><br>
                                       
                                       <label class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" name="contactPerson" readonly value="<?php echo  $contactPerson ?>" placeholder="Person Name">
                                         <div class="clearfix"></div><br>
                                        
                                        <label class="form-label">Contact Number#</label>
                                         <input type="text" class="form-control" name="contactNumber" readonly value="<?php echo $contactNumber  ?>" placeholder="Person Mobile/Phone No.#">
                                         <div class="clearfix"></div>

                                        </div>
                                        <div class="form-group col-md-4"></div>
                                        <div class="form-group col-md-4">
                                            
                                         <label class="form-label">Purchase Invoice#</label>
                                            <input type="text" class="form-control" readonly value="<?php echo @$invoiceNumber ?>" placeholder="NS/PPI/00000000001" name="invoiceNumber" readonly>
                                            <div class="clearfix"></div><br>
                                            
                                            <label class="form-label">Date</label>
                                            <input type="text" class="form-control" readonly id="" value="<?php echo $date ?>" readonly name="date" required placeholder="Select Date"><br>

                                             <label class="form-label">Total Items</label>
                                            <input type="text" class="form-control" placeholder="25" readonly value="<?php echo $totalItem  ?>" name="totalItem">
                                            <div class="clearfix"></div><br>
                                                
                                            
                                            <label class="form-label">Total Quantity</label>
                                            <input type="text" class="form-control" placeholder="30" readonly value="<?php echo $totalQuantity ?>" name="totalQuantity">
                                            <div class="clearfix"></div><br>

                                           <label class="form-label">Foreign Currency</label>
                                            <input type="number" class="form-control foreignCurrency" readonly value="<?php echo $foreignCurrency ?>" required name="foreignCurrency" placeholder="Dollar/RMB">
                                            <input type="hidden" name="productID" value="<?php echo $product_id ?>"   class="">
                                            <div class="clearfix"></div><br>
                                            
                                        
                                        </div>
                                            
                                       
                                    </div>
  
                                        <div class="table-responsive">
                                            <table class="table product-discounts-edit datatable" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Type</th>
                                                        <th width="15%">Product Name</th>
                                                         <th>Price Of FC</th>
                                                        <th>Quantity</th>
                                                        <th>Price In PKR</th>
                                                        <th>Freight Cost</th>
                                                        <th>Net Cost</th>
                                                        <th>Net Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    
                                                        <?php
    
    
                                                $fetch_query_details = "SELECT  p.* , (SELECT category_name FROM category WHERE id = p.`categoryID`) as categoryName , (SELECT product_name FROM products WHERE id = p.`productID`) as productName FROM `purchase_invoice_details` p where p.purchase_invoice_id = '$purchaseInvoiceID'";
                                                $stht = $dbh->prepare($fetch_query_details);
                                                $result = $stht->execute();
                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                    
                                                    $productID = $rowss['id'];  
                                                    $categoryNameKey = $rowss['categoryID'];
                                                    $productNameKey = $rowss['productID'];
                                                    $fcPriceKey = $rowss['priceOfFc'];
                                                    $quantityKey = $rowss['quantity'];
                                                    $priceInPktKey = $rowss['priceInPkr'];
                                                    $perPeaceKey = $rowss['freightCost']; 
                                                    $netCostKey = $rowss['netCost'];
                                                    $netAmountKey = $rowss['netAmount'];
                                                     $categoryName = $rowss['categoryName'];
                                                     $productName = $rowss['productName'];
                                                    
                                                    echo '<tr class="tRow">
                                                            <td>'.$categoryName.'</td>
                                                            <td>'.$productName.'</td>
                                                            <td>'.$fcPriceKey.'</td>
                                                            <td>'.$quantityKey.'</td>
                                                            <td>'.$priceInPktKey.'</td>
                                                            <td>'.$perPeaceKey.'</td>
                                                            <td>'.$netCostKey.'</td>
                                                            <td>'.$netAmountKey.'</td>
                                                    </tr>';
                                                    
                                                }
//    
    
                                                        ?>
                                                        
                                                   
                                                </thead>
                                                    <span></span>  
                                                
                                            </table>
                                           
                                         <table class="table product-discounts-edit table_details" style="width:25%;float:right">
                                             
                                             <?php
                                                
                                             $fetch_query_amount = "SELECT * FROM `purchase_invoice_amount_details` WHERE `purchaseInvoiceId` = '$purchaseInvoiceID'";
                                                $sthtt = $dbh->prepare($fetch_query_amount);
                                                $result = $sthtt->execute();
                                                $rowsss = $sthtt->fetch(PDO::FETCH_ASSOC);
                                                    
                                                    $totalAmountInFc = $rowsss['totalAmountInFc'];  
                                                    $totalFreight = $rowsss['totalFreight'];
                                                    $totalPkr = $rowsss['totalPkr'];
                                                    $totalAmount = $rowsss['totalAmount'];
                                                  
                                                    echo '<tr>
                                                    <td colspan="8" class="text-right py-3">
                                                        Total Amount In  <b>FC:</b>
                                                        <br> Total <b> Freight:</b>
                                                        <br> Total <b> PKR:</b> 
    <!--                                                    <br> Previous Balance:-->
                                                        <span class="d-block text-big mt-2">  <strong>Total Net Amount:</strong>   </span>
                                                    </td>
                                                    <td class="py-3">
                                                        <strong class="totalAmountInFc">'.$totalAmountInFc.'</strong>
                                                        <br>
                                                        <strong class="total_freight">'.$totalFreight.'</strong>
                                                        <br>
                                                        <strong class="total_pkr_amount">'.$totalPkr.'</strong>
                                                        <br>
                                                        <strong class="d-block text-big mt-2 totalNetAmount" style="font-size:30px;">'.$totalAmount.'</strong>


                                                    </td>
                                                </tr>'
                                             
                                             ?>
                                             
                                 
                                            </table> 
                                            
                                            
                                            
                                        </div>


                                      
                            </form>
                            </div>
                
                        </div>

                    </div>
                    <!-- [ content ] End -->

                   
                </div>
                <!-- [ Layout content ] Start -->

                
                
            </div>
            <!-- [ Layout container ] End -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper ] end -->

    <!-- Core scripts -->
    <script src="assets/js/pace.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>

    <!-- Libs -->
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="assets/libs/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="assets/libs/select2/select2.js"></script>
    <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="assets/libs/moment/moment.js"></script>
    <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/libs/timepicker/timepicker.js"></script>
    <script src="assets/libs/minicolors/minicolors.js"></script>

    <!-- Demo -->
    <script src="assets/js/demo.js"></script><script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/forms_selects.js"></script>
    <script src="assets/js/pages/forms_pickers.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:22 GMT -->
</html>

<script>
 
    
 
    var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         




</script>
    		