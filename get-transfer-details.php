<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $typeArray = array();
    $fetch_query = "SELECT p.* , (SELECT user_name FROM user WHERE user_id = p.`created_by`) as createdName , (SELECT category_name FROM category WHERE id = p.`category_id`) as categoryName FROM `products` p order by p.id asc";
    $sth = $dbh->prepare($fetch_query);
    $result = $sth->execute();
    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
            $typeArray[] = $rows;
    }	

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Get Transfer Details | Ppipopular</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Bhumlu Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Bhumlu, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.css">
    <link rel="stylesheet" href="assets/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/fonts/open-iconic.css">
    <link rel="stylesheet" href="assets/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="assets/css/shreerang-material.css">
    <link rel="stylesheet" href="assets/css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="assets/libs/datatables/datatables.css">
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
                          <!-- Modal template -->
                        <div class="modal fade" id="modals-default">
                            <div class="modal-dialog">

                            </div>
                        </div>

            <!-- Modal template end-->
                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Get Transfer Details</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Get Transfer Details</li>
                            </ol>
                        </div>

                       <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp;Get Transfer Details</h3>
                                 <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                    <form method="post" id="add_product"> 
                                  <div class="form-row">

                                    <div class="form-group col-md-3">
                                     <label class="form-label">Product Type</label>
                                <select class="select2-demo form-control purchaseInvoiceID" style="width: 100%" data-allow-clear="true" name="purchaseInvoiceID">
                                        <option value="0">Select Product Type</option>
                                        <?php
                                            $fetch_category = "SELECT p.*  FROM `purchase_invoice` p order by p.id asc";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $purchase_invoice_id = $rowss['id'];
                                                  $purchase_invoice	 = $rowss['purchase_invoice_#'];
                                                  $vendorName	 = $rowss['vendorName#'];
                                                echo '<option value="'.$purchase_invoice_id.'">'.$purchase_invoice.'</option>';    
                                            }	
                                        ?>
                                </select>    
                                     <div class="clearfix"></div>
                                    </div>                                    
     
                                </div>
                                    </form>
                                </div>
                            </div>         

                       
                        <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Product List</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                   <div class="table-responsive">
                            
                        </div>

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
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
      <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>
        <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="assets/libs/select2/select2.js"></script>
    
    <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>
    <script src="assets/js/pages/forms_selects.js"></script>
    <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
     <!-- Libs -->
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/datatables/datatables.js"></script>
        <script src="assets/libs/moment/moment.js"></script>
    <!-- Demo -->
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/tables_datatables.js"></script>
    <script src="assets/js/toastr.js"></script>
    
    

    
    
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>
 
        $('body').on('change','.purchaseInvoiceID', function(event){
            var purchaseInvoiceID =$(this).val();
           
            $.get("get_transfer_details_ajax.php?purchaseInvoiceID="+purchaseInvoiceID, function (data, status) {
                        $('.table-responsive').html(data);    
                        $('#editable-table').DataTable();
                    });
     });  
    

       
        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
