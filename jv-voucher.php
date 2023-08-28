<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    require("fpdf/fpdf.php");


    $year = date("Y");
    $year = explode("0",$year);
    $current_date = date('Y-m-d');
     $payment_voucher_num = "SI/" . "PP1" ."/". mt_rand(100000, 999999);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $customer_code_random = "RV/" . $year[1] ."/". mt_rand(100000, 999999);
    $customer_id = @$_GET['id'];

    if($_POST){


      
        
    }


    

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Receipt Voucher | Ppipopular</title>

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
    <link rel="stylesheet" href="assets/libs/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="assets/libs/select2/select2.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="assets/libs/timepicker/timepicker.css">
    <link rel="stylesheet" href="assets/libs/input-mask/inputmask.css">
    <link rel="stylesheet" href="assets/libs/input-mask/material.min.css">
    <link rel="stylesheet" href="assets/libs/phonemask/css/bootstrap-formhelpers.min.css">
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
    .received_amount{
        outline: none;
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
                        <h4 class="font-weight-bold py-3 mb-0">JV Voucher</h4>
                    
                         <div class="card mb-4">
                                 <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                    <form method="post" id="category_update"  action="cash_received.php"> 
                                    
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                               <h3 class="card-header bg-primary text-white" align="Center"><i class="fas fa-address-card" style="font-size:35px; "></i> &nbsp;JV Voucher</h3><br>
                                               <div class="form-row">      
                                                <div class="form-group col-md-12">
                                            <div class="card bg-secondary text-white" style="font-size: 33px;text-align: center;">Credit Account</div>
                                        </div></div><br>
                                                 <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Account Selection</label>
                                                         <select  class="form-control select2 customerType" required  name="accountSelectionMinus">
                                                            <option value="0">Select Account</option>
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
                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i>Description</label>
                                                         <textarea  class="form-control" required  name="descriptionMinus"></textarea>
                                                         <div class="clearfix"></div>   
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i>Recipt/Debit</label>
                                                         <input type="text"  class="form-control" required  name="recipt_debit_minus">
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    
                                                 <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">Payment/Credit</label>
                                                     <input type="text"  class="form-control"  name="payment_credit_minus">
                                                     <div class="clearfix"></div>
                                                    </div>


                                                </div><br>
                                                    <div class="form-row">      
                                                <div class="form-group col-md-12">
                                            <div class="card bg-success text-white" style="font-size: 33px;text-align: center;">Debit Account</div>
                                        </div></div><br>
                                                   <div class="form-row">
                                                <br> 
                                                   <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Account Selection</label>
                                                         <select  class="form-control select2" required  name="accountSelectionPlus">
                                                            <option value="0">Select Account</option>
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

                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">Description</label>
                                                      <textarea  class="form-control" required  name="descriptionMinus"></textarea>
                                                     <div class="clearfix"></div>
                                                    </div>
                                                
                                                

                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Recipt/Debit</label>
                                                     <input type="text" id="bank_name" class="form-control bank_name"  name="recipt_debit_plus"  placeholder="Bank name">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Payment/Credit</label>
                                                     <input type="text" class="form-control"  name="payment_credit_plus"  placeholder="Cheque #">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                </div><br>

                                    
                                                <div class="form-row">
                                                  <div class="form-group col-md-4 center" style="margin: 0 auto;">
                                                     <label class="form-label form-label-lg"></label>
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
                                                    </div>
                                                
                                            </div>

                                              </div>
                                            </div>



                                            </div>
                                             

                                               

                                               

                                            </div>

                                        </div>
 
                                    </form>
                                </div>
                            </div>         

                        <!-- / Filters -->



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
<!--    <script src="assets/js/jquery-3.3.1.min.js"></script>-->
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

       

    $('.select2').select2();       
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
    
    $('body').on("submit","#category_update",function(e){
         
         setTimeout(function(){
               window.location.reload(1);
            }, 1000);

          <?php if(!@$_GET['id']) {echo "showmessage('success','Cash Received Successfully','Success')";  } ?>;
               
    })


    $('.account_type').on("change",function(){
        var account_type =  $('.account_type').val();
    
        if(account_type == "1"){
           
        }

        if (account_type == "2"){
        }

    })


    var  customerType;    
$(".customerType").on("change", function (event) {
      customerType  =  $(this).val();

         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?customerTypeCashRec='+customerType,
                  dataType: 'JSON',
            success: function (data) {
                var previousBalance = data.previousBalance;
                $('.preciousBalance').val(previousBalance);  
            },
            error: function(data){
               console.log("error");
           }
          });
    
 }) 


$(".payment_type").on("change", function (event) {
    var  payment_type  =  $(this).val();
         $('.account_type').empty();
        $('.account_type').append($('<option></option>').val("0").html("Select Payment Type"));
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?payment_type='+payment_type,
                  dataType: 'JSON',
            success: function (data) {
                
                $.each(data.payment_type, function (key, value) {
                 console.log(value.customer_name);
                $('.account_type').append($('<option></option>').val(value.id).html(value.customer_name));
                 
                
            });


            },
            error: function(data){
               console.log("error");
           }
          });
    
 }) 

        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
