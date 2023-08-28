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
    <title>Account Report | Ppipopular</title>

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

    <link rel="stylesheet" href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="assets/libs/timepicker/timepicker.css">
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
.select2-results__option{
    font-size: 11px !important;
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
                        <h4 class="font-weight-bold py-3 mb-0">Account Report</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Account Report</li>
                            </ol>
                        </div>

                       <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp; Account Report</h3>
                                 <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                  <div class="form-row">

        

                                <div class="form-group col-md-2">
                                   <label class="form-label">From</label>
                                        <input type="text" id="" class="form-control b-m-dtp-date start_date" placeholder="From">
                                        <div class="clearfix"></div>
                                </div>

                                <div class="form-group col-md-2">
                                   <label class="form-label">To</label>
                                        <input type="text"  class="form-control b-m-dtp-date end_date" placeholder="To">
                                        <div class="clearfix"></div>
                                </div>
                                     
                                    
                                    <div class="form-group col-md-2">
                                     <label class="form-label">Account Selection</label>
                                    <select class="select2-demo form-control customerType" style="width: 100%" data-allow-clear="true" name="category_id">
                                            <option value="0">All</option>
                                            <?php
                                                $fetch_category = "SELECT * FROM `customer`";
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

                                    <div class="form-group col-md-2">
                                     <label class="form-label">Type</label>
                                    <select class="select2-demo form-control payment_type" style="width: 100%" data-allow-clear="true" name="category_id">
                                              <option value="all">All</option>
                                             <option value="1">Cash</option>
                                             <option value="10">Bank</option>
                                             <option value="3">Expense</option>
                                             <option value="4">Supplier/Vendor</option>
                                             <option value="5">Customer</option>
                                             <option value="6">Company</option>
                                             <option value="7">Others</option>
                                    </select>    
                                     <div class="clearfix"></div>
                                    </div>    

                                     <div class="form-group col-md-2">
                                        <label class="form-label">Report Selection</label>
                                        <select class="select2-demo form-control replort_selection" style="width: 100%" data-allow-clear="true" name="category_id">
                                                <option value="0">Select Report Selection</option>      
                                                <option value="1">Ledger</option>      
                                                <option value="2">Detail Ledger</option>      
                                                <option value="3">Trial Balance (2 Column)</option>      
                                        </select>    
                                         <div class="clearfix"></div>
                                        </div>                    
                                    <div class="form-group col-md-2">
                                        <br>
                                        <button type="button" class="btn btn-primary btn btn-block search"  role="button">Search</button>
                                    </div>
                                     <div class="form-group col-md-1 print_icon" style="display: none;"><img src="assets/img/print-icon.svg"></div>
                                </div>
                                </div>
                            </div>         

                       
                        <!-- / Filters -->

                          <div class="card account_reports_data">
                            <img src="assets/img/loading.gif" class="progress_bar" style="width: 50px;display: none">
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
    <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/libs/timepicker/timepicker.js"></script>
    <script src="assets/libs/minicolors/minicolors.js"></script>

    <!-- Demo -->
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/tables_datatables.js"></script>
    <script src="assets/js/toastr.js"></script>
     <script src="assets/js/pages/forms_pickers.js"></script>
    
    

    
    
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>


    $('.search').on('click',function () {
        // body...

        var start_date = $('.start_date').val();
        var  end_date = $('.end_date').val();
        var customerType = $('.customerType').val();
        var payment_type = $('.payment_type').val();
        var replort_selection = $('.replort_selection').val();
        $('.progress_bar').show();
        $('.card-table').empty();
       if(replort_selection != "0"){

         $.ajax({
            type: 'get',
            url: 'account-report-ajax.php?start_date='+start_date+'&end_date='+end_date +'&customerType='+customerType +'&payment_type='+payment_type +'&replort_selection='+replort_selection,
                  // dataType: 'JSON',
            success: function (data) {
              console.log(data);
                $('.progress_bar').hide();
                $('.print_icon').show();
                $('.account_reports_data').append(data);
               
            },
            error: function(data){
               console.log("error");
           }
          });
     }else{
        alert("Select Report Selection");
     }


    })


    $('[data-toggle="tooltip"]').tooltip(); 
    function  showmessage(shortCutFunction, msg,title) {
            
            var shortCutFunction =shortCutFunction;
             var title = title;
            var msg = msg;
            var $toast = toastr[shortCutFunction](msg, title);
      }	
        toastr.options = {
        tapToDismiss: false
        , timeOut: 4500
        , extendedTimeOut: 0
        , allowHtml: true
        , preventDuplicates: true
        , preventOpenDuplicates: true
        , newestOnTop: true
        , closeButton: true
        , closeHtml: ''
          
    }





    

        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
