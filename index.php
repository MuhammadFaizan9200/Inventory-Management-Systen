<?php
session_start();
    
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
  
?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Dashboard | Ahmed Traders</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Bhumlu Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Bhumlu, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.css">
    <link rel="stylesheet" href="assets/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/fonts/open-iconic.css">
    <link rel="stylesheet" href="assets/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/libs/select2/select2.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="assets/css/shreerang-material.css">
    <link rel="stylesheet" href="assets/css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/libs/morris/morris.css">
    <link rel="stylesheet" href="assets/libs/flot/flot.css">

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
                        <h4 class="font-weight-bold py-3 mb-0">AHMED TRADERS DASHBOARD</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data</li>
                            </ol>
                        </div>

                        <div class="modal" tabindex="-1" id="myModal" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">If you want to make invoice click to yes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary go_make_invoice">Yes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                              </div>
                            </div>
                          </div>
                        </div>       
                       
                        <div class="row">
                            <!-- first card start -->
                            <div class="col-xl-12 col-md-12">
                                <div class="card d-flex w-100 mb-4">
                                  <h5 class="card-header bg-primary text-white " style="font-size: 20px; text-align: center;"><i class="fas fa-users" style="font-size:28px; "></i> &nbsp; AHMED TRADERS | SALE REPORT </h5>
                                    <div class="row no-gutters row-bordered row-border-light h-100" style="border-style: solid; border-color: #716aca ;">

                                <div class=" col-sm-6">
                                    <div class="card-body text-dark">
                                    <div class="form-group">
                                        <label class="form-label form-label-lg">Filter by company</label>
                                        <select class="select2 form-control cutomers" style="width: 100%" data-allow-clear="true">
                                            <option>Choose Company</option>
                                            <?php
                                            $fetch_category = "SELECT * FROM `company`";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $company_id = $rowss['id'];
                                                 $company_name = $rowss['company_name'];
                                                echo '<option value="'.$company_id.'">'.$company_name.'</option>';    
                                                 }   
                                            ?>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label form-label-lg">Start Date</label>
                                        <select class="select2 form-control cutomers" style="width: 100%" data-allow-clear="true">
                                            <option>Choose Start Date</option>
                                            <?php
                                            $fetch_category = "SELECT * FROM `customer` where customer_type = '5'";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $customer_id = $rowss['id'];
                                                 $customer_name = $rowss['customer_name'];
                                                echo '<option value="'.$customer_id.'">'.$customer_name.'</option>';    
                                                 }   
                                            ?>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>

                                    </div>


                                </div>

                                  <div class=" col-sm-6">
                                    <div class="card-body text-dark">
                                     <div class="form-group">
                                        <label class="form-label form-label-lg">Filter by saleman</label>
                                        <select class="select2 form-control cutomers" style="width: 100%" data-allow-clear="true">
                                            <option>Choose Saleman</option>
                                            <?php
                                            $fetch_category = "SELECT * FROM `customer` where customer_type = '5'";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $customer_id = $rowss['id'];
                                                 $customer_name = $rowss['customer_name'];
                                                echo '<option value="'.$customer_id.'">'.$customer_name.'</option>';    
                                                 }   
                                            ?>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label form-label-lg">End Date</label>
                                        <select class="select2 form-control cutomers" style="width: 100%" data-allow-clear="true">
                                            <option>Choose End Date</option>
                                            <?php
                                            $fetch_category = "SELECT * FROM `customer` where customer_type = '5'";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $customer_id = $rowss['id'];
                                                 $customer_name = $rowss['customer_name'];
                                                echo '<option value="'.$customer_id.'">'.$customer_name.'</option>';    
                                                 }   
                                            ?>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    </div>
                                    
                                </div> 
                                 <div class=" col-sm-12">
                                    <div class="card-body text-dark">
                                        <div style="padding: 30px;"></div>
                                     <div class="text-center">
                                            <h2 class="d-inline-block mb-2 mt-2 payment_amount" ><span style="color: red;">Debit Amount</span>/= 100,000 , </h2>
                                             <h2 class="d-inline-block mb-2 mt-2 payment_amount" ><span style="color: green;">Credit Amount</span>/= 100,000 </h2>
                                             <h5 class="text-primary mb-0 mt-0 text-center payment_date">Current Month Sale</h5>
                                            </div>
                                            <div style="padding: 34px;"></div>
                                            <div>
                                             <button type="button" class="btn btn-primary text-white btn-block">Check  </button>
                                            </div>
                                    </div>
                                </div>   

                                            
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header bg-danger text-white " style="font-size: 20px; text-align: center;"><i class="fas fa-clipboard-list" style="font-size:28px; "></i> &nbsp;Ahmed Traders | Quick Order Products</h5>
                                    <div class="table-responsive table-striped table-bordered">
                                        <table class="table table-striped table-bordered" style="border-style: solid; border-color: #3f454a ;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th width="5%">S#</th>
                                                    <th width="40%">Product Name</th>
                                                    <th width="40%">Company Name</th>
                                                    <th>Remaining Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table table-striped table-bordered">
                                        <?php
                                        $fetch_query = "SELECT p.* , (SELECT user_name FROM user WHERE user_id = p.`created_by`) as createdName , (SELECT company_name FROM company WHERE id = p.`company_id`) as companyName  FROM `products` p where p.product_quantity_sale <= 20 order by p.id desc";
                                            $sth = $dbh->prepare($fetch_query);
                                            $result = $sth->execute();
                                            $counter = 1;
                                            while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                                   $product_name = $rows['product_name'];
                                                    $price = $rows['price'];
                                                    $companyName = $rows['companyName'];
                                                    $product_quantity_sale = $rows['product_quantity_sale'];  

                                               echo '<tr>
                                                    <td>'.$counter.'</td>
                                                    <td>'.$product_name.'</td>
                                                    <td>'.$companyName.'</td>
                                                    <td>'.$product_quantity_sale.'</td>
                                                    <td>'.$price.'</td>
                                                </tr>';     
                                                $counter++;
                                            }   

                                            ?>    

                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-md-12" >
                                <div class="card mb-4" >
                                    <h5 class="card-header bg-warning text-white " style="font-size: 20px; text-align: center;"><i class="feather icon-bar-chart" style="font-size:28px; "></i> &nbsp; AHMED TRADERS | Monthly Report </h5>
                                    <div class="card-body py-0" style="border-style: solid; border-color: #FF9149 ;">
                                        <div id="chart-bar-moris" style="height:300px"></div>
                                    </div>
                                    <div class="card-footer pt-0 pb-0" style="border-style: solid; border-color: #FF9149 ;">
                                        <div class="row row-bordered row-border-light">

                                            <div class="col-sm-3 py-3">
                                            </div>

                                            <div class="col-sm-3 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="ui-legend bg-success" style="width:20px;height:20px"></div>
                                                    <div class="ml-3">
                                                        <p class="text  mb-1">Income</p>
                                                        <h5 class="mb-0">Rs/= 150000</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="ui-legend bg-warning" style="width:20px;height:20px"></div>
                                                    <div class="ml-3">
                                                        <p class="text  mb-1">Expenses</p>
                                                        <h5 class="mb-0">Rs/= 50000</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 py-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <!-- Data card 8 Start -->
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header bg-info text-white " style="font-size: 20px; text-align: center;"><i class="fas fa-money-check" style="font-size:28px; "></i> &nbsp; Today's Cheques For Clearance </h5>
                                    <div class="table-responsive table-striped table-bordered">
                                        <table class="table table-striped table-bordered" style="border-style: solid; border-color: #3f454a ;">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S#</th>
                                                    <th>Customer Name</th>
                                                    <th>Cheque No.</th>
                                                    <th>Amount</th>
                                                    <th>Bank Name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table table-striped table-bordered">
                                            <?php
                                            $query = "SELECT `creditAmount` ,`check_number` , `bank_name` , (SELECT customer_name FROM customer WHERE id = `customer_ledger`.`customer_id`) as customer_name FROM `customer_ledger` WHERE `payment_type_status` = '1' AND account_type = '6' AND date = CURRENT_DATE();";
                                               $stht = $dbh->prepare($query);
                                               $result = $stht->execute();
                                               $counter = 1;
                                               $count = $stht->rowCount();
                                        if($count >= 1){
                                               while($rows = $stht->fetch(PDO::FETCH_ASSOC)){
                                                    $creditAmount = $rows['creditAmount'];
                                                    $check_number = $rows['check_number'];
                                                    $bank_name  = $rows['bank_name'];
                                                    $customer_name = $rows['customer_name'];
                                                    echo '<tr>
                                                    <td>'.$counter.'</td>
                                                    <td>'.$customer_name.'</td>
                                                    <td>'.$check_number.'</td>
                                                    <td>'.$creditAmount.'</td>
                                                    <td>'.$bank_name.'</td>
                                                </tr>';
                                                $counter++;
                                               }
                                           }else{
                                             echo '<tr>
                                                    <td colspan="5" style="text-align: center;color: red;font-weight: bold;">Today Cheques not found!</td>
                                                </tr>';
                                           }

                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Data card 8 End -->
                            
                            <div class="row">
                            <!-- first card start -->
                            <div class="col-xl-6 col-md-12">
                                <div class="card d-flex w-100 mb-4">
                                  <h5 class="card-header  text-white " style="font-size: 20px; background-color: #24ad7c; text-align: center; "><i class="fas fa-boxes" style="font-size:28px; "></i> &nbsp; PPI | Today's Inventory History  </h5>
                                    <div class="row no-gutters row-bordered row-border-light h-100" style="border-style: solid; border-color: #24ad7c;">
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark">
                                                <i class="fas fa-boxes text-primary d-block" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                   <span class="text-big"><span class="mr-1 text-primary"><?php echo $today_sale ?></span>Total Pieces</span>
                                                <br>
                                                <small class="text-primary"><b>Today Sales (1st Floor)</b> </small>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark">
                                               <i class="fas fa-archive text-warning d-block" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                    <span class="text-big"><span class="mr-1 text-warning">150</span>Total Pieces</span>
                                                <br>
                                                <small class="text-warning"><b>Today Sales (6th Floor)</b> </small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark">
                                                <i class="fas fa-exchange-alt d-block text-danger" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                    <span class="text-big"><span class="mr-1 text-danger"><?php echo $today_transfer ?></span> Products</span>
                                                <br>
                                                <small class="text-danger"><b>Transfer Today </b></small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark">
                                                <i class="fas fa-project-diagram d-block text-info" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                    <span class="text-big"><span class="mr-1 text-info"><?php echo $today_menufacturing ?></span> Products</span>
                                                <br>
                                                <small class="text-info"><b>Manufactured Today </b></small>
                                                </span>
                                            </div>
                                        </div>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="col-md-1">
                                                
                                            </div>

                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary text-white btn-block " style="background-color: #24ad7c;">07 Days  </button> 
                                            </div>
                                            &nbsp;
                                              <div class="col-md-3 " >
                                                <button type="button" class="btn btn-primary text-white btn-block " style="background-color: #24ad7c;">15 Days  </button> 
                                            </div>
                                            &nbsp;
                                               <div class="col-md-3 " >
                                                <button type="button" class="btn btn-primary text-white btn-block " style="background-color: #24ad7c;">30 Days  </button> <br>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <div class="card d-flex w-100 mb-4" >
                                 <h5 class="card-header text-white " style="font-size: 20px; text-align: center; background-color: #24ad7c;"><i class="ion ion-ios-albums" style="font-size:28px; "></i> &nbsp; PPI | Complete Inventory History </h5>
                                    <div class="row no-gutters row-bordered row-border-light h-100" style="border-style: solid; border-color: #24ad7c;">
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark" >
                                                <i class="fas fa-boxes text-primary d-block" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                   <span class="text-big"><span class="mr-1 text-primary">2500</span>Remaining</span>
                                                <br>
                                                <small class="text-primary"><b>Sale Godown (1st Floor)</b> </small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark" >
                                               <i class="fas fa-archive text-info d-block" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                    <span class="text-big"><span class="mr-1 text-info">6000</span>Remaining</span>
                                                <br>
                                                <small class="text-info"><b>Store Dodown (6th Floor)</b> </small>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark">
                                                <i class="fas fa-exchange-alt d-block text-danger" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                    <span class="text-big"><span class="mr-1 text-danger"><?php echo $total_transfer ?></span> Products</span>
                                                <br>
                                                <small class="text-danger"><b>Transfer So Far</b></small>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex col-sm-6 align-items-center">
                                            <div class="card-body media align-items-center text-dark">
                                                <i class="fas fa-project-diagram d-block text-warning" style="font-size:28px; "></i>
                                                <span class="media-body d-block ml-3">
                                                    <span class="text-big"><span class="mr-1 text-warning"><?php echo $total_menufact_sofar ?></span> Products</span>
                                                <br>
                                                <small class="text-warning"><b>Manufactured So Far </b></small>
                                                </span>
                                            </div>
                                        </div>
                                        <div style="padding: 28px;"></div>

                                    </div>
                                </div>

                            </div>
                        </div>
                                                     <!-- Data card 8 Start -->
                            
                        </div>
                </div>
                    <!-- [ content ] End -->

                    <!-- [ Layout footer ] Start -->
                    <nav class="layout-footer footer bg-white">
                        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
                            <div class="pt-3">
                                <span class="footer-text font-weight-semibold">&copy; <a href="https://srthemesvilla.com/" class="footer-link" target="_blank">Srthemesvilla</a></span>
                            </div>
                            <div>
                                <a href="javascript:" class="footer-link pt-3">About Us</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </nav>
                    <!-- [ Layout footer ] End -->
                </div>
                <!-- [ Layout content ] Start -->
            </div>

            </div>
            <!-- [ Layout container ] End -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper ] end -->


    
    
    
    <script src="assets/js/pace.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/libs/select2/select2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>

    <!-- Libs -->
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/eve/eve.js"></script>
    <script src="assets/libs/chart-am4/core.js"></script>
    <script src="assets/libs/chart-am4/charts.js"></script>
    <script src="assets/libs/chart-am4/animated.js"></script>
    <script src="assets/libs/raphael/raphael.js"></script>
    <script src="assets/libs/morris/morris.js"></script>

    <!-- Demo -->
    <script src="assets/js/demo.js"></script><script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/dashboards_project.js"></script>
    <script src="assets/js/pages/dashboards_ecommerce.js"></script>
    <script src="assets/js/pages/dashboards_trending.js"></script>
    
    

    
    
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>

    $('.cutomers').select2();
    $('#myModal').modal('show');

   $(document).ready(function(){
        $("#myModal").modal({
        show:false,
        backdrop:'static'
        });
        });


$('body').on("click",".go_make_invoice", function() {
    window.location.href = 'invoice-company.php'
})

 $('body').on("change",".cutomers", function() {
        var customerPaymentID = $(this).val();

        $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?customerPaymentID='+customerPaymentID,
                  dataType: 'JSON',
            success: function (data) {
               
            
      
            },
            error: function(data){
               console.log("error");
           }
          });


        });

      var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         

      
    
</script>
