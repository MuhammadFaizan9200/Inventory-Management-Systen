<?php
session_start();
    
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $typeArray = array();

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Invoice Company | Ahmed Traders</title>

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
                        <h4 class="font-weight-bold py-3 mb-0">AHMED TRADERS COMPANY</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data</li>
                            </ol>
                        </div>
    
                       
                        <div class="row">
                            <!-- first card start -->
                            <div class="col-xl-12 col-md-12">
                                <div class="card d-flex w-100 mb-4">
                                  <h5 class="card-header bg-primary text-white " style="font-size: 20px; text-align: center;"><i class="fas fa-users" style="font-size:28px; "></i> &nbsp; AHMED TRADERS | COMPANY </h5>
                                    <div class="row no-gutters row-bordered row-border-light h-100" style="border-style: solid; border-color: #716aca ;">

                                <div class=" col-sm-12">
                                    <div class="card-body text-dark">
                                    <div class="form-group">
                                        <label class="form-label form-label-lg">Select Company For Invoice</label>
                                        <select class="select2 form-control company" style="width: 100%" data-allow-clear="true">
                                            <option value="0">Choose Company</option>
                                            <?php
                                            $fetch_category = "SELECT * FROM `company` WHERE status = 0";
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
                                    
                                    </div>
                                </div>
                                 <div class=" col-sm-12">
                                    <div class="card-body text-dark">
                                             <div>
                                             <button type="button" class="btn btn-primary text-white btn-block company_event">Make Invoice</button>
                                            </div>
                                    </div>
                                </div>   

                                            
                                    </div>

                                </div>

                            </div>
                        </div>
                        </div>
                </div>
                    <!-- [ content ] End -->
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
    $('.company').select2();

$('body').on("click",".company_event", function() {
    var company = $('.company').val();
    if(company != 0){
        window.location.href = "sale_invoice.php?company_id=" + company;
    }else{
        alert("Please select company");
    }
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
