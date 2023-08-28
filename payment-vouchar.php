<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $year = date("Y");
    $year = explode("0",$year);
    $current_date = date('Y-m-d');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $customer_code_random = "RV/" . $year[1] ."/". mt_rand(100000, 999999);
    $customer_id = @$_GET['id'];

    if($_POST){


        $customerType = $_POST['customerType']; 
        $vouchar_date = $_POST['vouchar_date'];
        $bank_name = @$_POST['bank_name'];
        $received_amount = @$_POST['received_amount'];
        $cash_date = @$_POST['cash_date'];
       
        $remarks = $_POST['remarks'];
        $account_number = $_POST['account_number'];
        $date = date('Y-m-d');
        $clear_date = $_POST['clear_date'];  
        $received_from = $_POST['received_from'];  
        $received_by = $_POST['received_by'];  
        $payment_type = $_POST['payment_type'];
        $account_selection = $_POST['account_selection'];
        $cheque_in_hand = $_POST['cheque_in_hand'];
        $account_type = $_POST['account_type'];

        
       
      
       
             $update_cus_query = "UPDATE `customer_ledger` SET `paid_status`='1' WHERE id ='$cheque_in_hand'";
            $stmtt = $dbh->prepare($update_cus_query);
            $stmtt->execute(); 
           // var_dump($update_cus_query);


            // maintain owner ledger
            $owner_ledger_query = "INSERT INTO `customer_ledger`(`description`, `bank_name`, `check_number`, `clear_date`, `received_from`, `received_by`, `payment_type_status`, `account_selection_status`, `debitAmount`, `creditAmount`, `date`, `customer_id`, `account_type`, `time_stamp`,`voucher_number`,`paid_status`) VALUES ('$remarks','$bank_name','$account_number','$clear_date','$received_from','$received_by','$payment_type','$account_selection','$received_amount','0','$date','$customerType','$account_type',now(),'$customer_code_random','1')";
            $st_t = $dbh->prepare($owner_ledger_query);
            $st_t->execute(); 
           
       
       header("Location:payment-vouchar.php"); 
        
    }
    else{
        $typeArray = array();
        $fetch_query = "SELECT * FROM `customer` WHERE `id` ='$customer_id'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        $credit_limit = $rows['credit_limit']; 
        $date = $rows['date'];
        $customer_code = $rows['customer_code'];
        $customer_name = $rows['customer_name'];
        $address = $rows['customer_name'];
        $area = $rows['area'];
        $city = $rows['city'];
        $mobile_1 = $rows['mobile_1'];
        $mobile_2 = $rows['mobile_2'];
        $saleman_name = $rows['saleman_name'];
        $saleman_mobile1 = $rows['saleman_mobile1'];
        $saleman_mobile2 = $rows['saleman_mobile2'];
	
        
        
        
    }


    

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Payment Voucher | Ppipopular</title>

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
                        <h4 class="font-weight-bold py-3 mb-0">Payment Voucher</h4>
                    
                         <div class="card mb-4">
                                 <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                    <form method="post" id="category_update"> 
                                        <br>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                               <h3 class="card-header bg-primary text-white" align="Center"><i class="fas fa-address-card" style="font-size:35px; "></i> &nbsp;Payment Voucher</h3><br>
                                               <div class="form-row">      
                                                <div class="form-group col-md-12">
                                            <div class="card bg-success text-white" style="font-size: 33px;text-align: center;">Debit Account</div>
                                        </div></div><br>
                                                 <div class="form-row">
                                                     <div class="form-group col-md-4">
                                                     <label class="form-label form-label-lg">Account Type</label>
                                                        <select class="form-control select2 account_type" required  name="payment_type">
                                                                <option value="0">Select Account Type</option>
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


                                                    <div class="form-group col-md-4">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Account Selection</label>
                                                         <select  class="form-control select2 account_type_selection" required  name="customerType">
                                                            <option value="0">Select Account Selection</option>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    
                                                     <div class="form-group col-md-2">
                                                         <label class="form-label form-label-lg">Previous Balance</label>
                                                         <input type="text" readonly=""  class="form-control"  name="previous_balance">
                                                         <div class="clearfix"></div>
                                                    </div>

                                                     <div class="form-group col-md-2">
                                                         <label class="form-label form-label-lg">Voucher Date</label>
                                                         <input type="date" readonly="" value="<?php echo @$current_date ?>" class="form-control"  name="vouchar_date">
                                                         <div class="clearfix"></div>
                                                    </div>

                                                </div>
                                                    <br>
                                                   
                                                  <!--   <hr style="color: red;border: 1px solid #f2f3f8"> -->
                                                   
                                        <div class="form-row">      
                                                <div class="form-group col-md-12">
                                            <div class="card bg-secondary text-white" style="font-size: 33px;text-align: center;">Credit Account</div>
                                        </div>
                                    </div>
                                                    <br> 
                                               <div class="form-row">      
                                                <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">Payment Type</label>
                                                     <select  class="form-control select2 payment_type" required  name="account_type">
                                                            <option value="0">Select Payment Type</option>
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

                                               
                                                 <div class="form-group col-md-3 cash_type">
                                                     <label class="form-label form-label-lg">Account Selection</label>
                                                        <select class="form-control select2 payment_type_Selection" required  name="account_selection">
                                                                <option value="0">Select Selection Type</option>
                                                            </select>
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-3 cash_type">
                                                     <label class="form-label form-label-lg">Cheque In Hands</label>
                                                        <select class="form-control select2 cheque_in_hand" required  name="cheque_in_hand">
                                                                <option value="0">Select Cheque In Hands</option>
                                                            </select>
                                                     <div class="clearfix"></div>
                                                    </div>
                                                     <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">Cash In Hands</label>
                                                    <input type="text" id="cash_in_hand" class="form-control cash_in_hand"  name="cash_in_hand"  placeholder="Cash In Hands">
                                                     <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                
                                                    <br>

                                                <div class="form-row">      
                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Bank Name</label>
                                                     <input type="text" id="bank_name" class="form-control bank_name"  name="bank_name"  placeholder="Bank name">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Cheque #</label>
                                                     <input type="text" class="form-control account_number"  name="account_number"  placeholder="Cheque #">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Clear Date</label>
                                                     <input type="date" class="form-control clear_date"  name="clear_date"  placeholder="Clear Date">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Amount</label>
                                                     <input type="text" class="form-control received_amount"   name="received_amount"  placeholder="Amount">
                                                     <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                    <br>
                                                 <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Received From</label>
                                                       <input type="text" class="form-control"   name="received_from"  placeholder="Received From">   
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Received By</label>
                                                       <input type="text" class="form-control"   name="received_by"  placeholder="Received By">   
                                                     <div class="clearfix"></div>
                                                    </div>
                                                </div>    
                                           
                                             <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                     <label class="form-label form-label-lg">Remarks</label>
                                                     <textarea  class="form-control"  name="remarks"></textarea>
                                                     <div class="clearfix"></div>
                                                    </div>
                                            </div> 
                                               
                                               <div class="form-row">
                                                   <div class="form-group col-md-4 center" style="margin: 0 auto;">
                                                     <label class="form-label form-label-lg"></label>
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
                                                    </div>
                                                
                                            </div>




                                              

                                                <!--   <div class="form-group col-md-4">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Amount</label>
                                                     <input type="text" class="form-control"   name="cash_amount_owner"  placeholder="Amount">
                                                     <div class="clearfix"></div>
                                                 </div>  

 -->

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
    




// payment_type
    var  account_type;    
$(".account_type").on("change", function (event) {
      account_type  =  $(this).val();
      $('.account_type_selection').empty();
        $('.account_type_selection').append($('<option></option>').val("0").html("Select Payment Type"));

         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?accountTypeSelection='+account_type,
                  dataType: 'JSON',
            success: function (data) {
                $.each(data.payment_type, function (key, value) {
                 console.log(value.customer_name);
                $('.account_type_selection').append($('<option></option>').val(value.id).html(value.customer_name));
                });
            },
            error: function(data){
               console.log("error");
           }
          });
    
 }) 


var  payment_type;
$(".payment_type").on("change", function (event) {
      payment_type  =  $(this).val();
         $('.payment_type_Selection').empty();
        $('.payment_type_Selection').append($('<option></option>').val("0").html("Select Payment Type"));
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?payment_typeSelection='+payment_type,
                  dataType: 'JSON',
            success: function (data) {
                
                $.each(data.payment_type, function (key, value) {
                 console.log(value.customer_name);
                $('.payment_type_Selection').append($('<option></option>').val(value.id).html(value.customer_name)); 
            });
            },
            error: function(data){
               console.log("error");
           }
          });
 }) 

var  payment_type_Selection;    
$(".payment_type_Selection").on("change", function (event) {
      payment_type_Selection  =  $(this).val();

         $('.cheque_in_hand').empty();
        $('.cheque_in_hand').append($('<option></option>').val("0").html("Select Cheque in Hands"));
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?payment_type_SelectionAmount='+payment_type_Selection +"&payment_type_cheque_inhands="+payment_type,
                  dataType: 'JSON',
            success: function (data) {
                $.each(data.payment_type_details, function (key, value) {
                    var bank_name = value.bank_name;
                    var check_number = value.check_number;
                    var creditAmount = value.creditAmount;
                    var clear_date = value.clear_date;
                    var Balance = value.Balance;
                    $('.cash_in_hand').val(Balance);    
                $('.cheque_in_hand').append($('<option></option>').val(value.id).html(value.bank_name +" " + creditAmount)); 
            });
            },
            error: function(data){
               console.log("error");
           }
          });
 }) 







$(".cheque_in_hand").on("change", function (event) {
    var  cheque_in_hand  =  $(this).val();
alert(cheque_in_hand);
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?cheque_in_hand='+cheque_in_hand,
                   dataType: 'JSON',
            success: function (data) {

                    console.log(data);
                    var bank_name = data.bank_name;
                    var account_number = data.check_number;
                    var clear_date = data.clear_date;
                    var received_amount = data.creditAmount;
                    $('.bank_name').val(bank_name);    
                    $('.account_number').val(account_number);    
                    $('.clear_date').val(clear_date);    
                    $('.received_amount').val(received_amount);    
                
            
            },
            error: function(data){
               console.log("error");
           }
          });
 })

    
    $("table").on("click", ".delete", function (event) {
                if (confirm("Are you sure you want to delete this Product?")) {
                    var ID = this.id;
                     var $this = $(this); 
                     var Row = $this.closest('tr');
                              var tr = $this.parents('tr');
                              var nRow = Row[0];
                      
//                    $.get("delete.php?product_id="+ID, function (data, status) {
//                        if (status == 'success') {
//                            var Row = $this.closest('tr');
//                              var tr = $this.parents('tr');
//                              var nRow = Row[0];
//                            showmessage('warning','Product Delete Successfully','Success');  
////                            $('#editable-table').dataTable().fnDeleteRow(nRow);
//                                     
//                            
//				        } else
//                        {
//                           // alert('Event Delete Error');
//                        }
//                    });
//                    
//                    
                    
                }
            });  	
    

        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
