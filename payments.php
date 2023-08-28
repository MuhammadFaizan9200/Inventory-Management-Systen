<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
     $date = date('Y-m-d');

    if($_POST){


        $paymentType = @$_POST['paymentType']; 
        $expenseType = @$_POST['expenseType'];
        $customerType = @$_POST['customerType'];


        $cash_amount = @$_POST['cash_amount'];
        $cash_amount_exp = explode(",", $cash_amount);
        $cash_amount_amount = @$cash_amount_exp[0];
        $cash_amount_id = @$cash_amount_exp[1];


        $bank_amount = @$_POST['bank_amount'];
        $bank_amount_exp = explode(",", $bank_amount);
        $bank_amount_amount = @$bank_amount_exp[0];
        $bank_amount_id = @$bank_amount_exp[1];
         $bank_account_title = @$bank_amount_exp[2];
        $remarks = @$_POST['remarks'];
       


      

        $remarks_value = $remarks ." " . "[' '.$bank_account_title.' ']";

        if($paymentType == 1){
           $paymentTypeValue = $cash_amount_amount;
           $cash_status_query = "UPDATE `owner_ledger` SET `paid_status`= '1' WHERE `id` = '$cash_amount_id'";
          }else{
          $paymentTypeValue = $bank_amount_amount;
           $cash_status_query = "UPDATE `customer_bank_records` SET `paid_status`= '1' WHERE `id` = '$bank_amount_id'";
          }
            $st = $dbh->prepare($cash_status_query);
            $st->execute(); 
           
            // maintain owner ledger
             $owner_ledger_query = "INSERT INTO `payments`(`payment_type`, `expense_type`, `customer_id`, `amount`, `remarks`, `time_stamp`) VALUES ('$paymentType','$expenseType','$customerType','$paymentTypeValue','$remarks',now())";
            $st_t = $dbh->prepare($owner_ledger_query);
            $st_t->execute(); 



           // maintain payment 
            $payment_query = "INSERT INTO `owner_ledger`(`description`, `debitAmount`, `creditAmount`, `date`, `customer_id`, `status`, `paid_status`, `time_stamp`) VALUES ('$remarks_value','$paymentTypeValue','0','$date','$customerType','1','1',now())";
            $st_tt = $dbh->prepare($payment_query);
            $st_tt->execute(); 



      if($paymentType == 3){

              // TYPE 3

          $ownerBankList = @$_POST['ownerBankList'];
          $chequeList = @$_POST['chequeList'];

          $chequeList_exp = explode(",", $chequeList);
          $bank_check_id = $chequeList_exp[0];
          $bank_name = $chequeList_exp[1];
          $account_number = $chequeList_exp[2];
          $customer_id = $chequeList_exp[3];



          $transferBank = @$_POST['transferBank'];
          $chequeAmount = @$_POST['chequeAmount'];
          $bank_remarks = @$_POST['bank_remarks'];
 

           $bank_query = "UPDATE `customer_bank_records` SET `transfer_status`= '1' WHERE `id` = '$bank_check_id'";
           $str = $dbh->prepare($bank_query);
           $str->execute(); 
          

            $transfer_query = "INSERT INTO `customer_bank_records`(`account_title`, `account_number`, `amount`, `customer_id`, `current_date`, `remarks`, `bank_id`) VALUES ('$bank_name','$account_number','$chequeAmount','$customer_id','$date','$bank_remarks','$transferBank')";
            $st_ttt = $dbh->prepare($transfer_query);
            $st_ttt->execute(); 


             $history_query = "INSERT INTO `bank_transfer_history`(`bank_id`, `cheque_id`, `bank_transfer_id`, `cheque_amount`, `remarks`, `date`, `time_stamp`) VALUES ('$ownerBankList','$bank_check_id','$transferBank','$chequeAmount','$bank_remarks','$date',now())";
            $st_tttt = $dbh->prepare($history_query);
            $st_tttt->execute(); 


            



           } 







          
           header("Location:payments.php");    
           
        }


       
      
        
    
    

    

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Payments | Ppipopular</title>

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
                        <h4 class="font-weight-bold py-3 mb-0">Payments</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Payments</li>
                            </ol>
                        </div>


                         <div class="card mb-4">
                            <h3 class="card-header" align="Center"><i class="feather icon-user-plus" style="font-size:35px; "></i> &nbsp; Payments </h3>
                                 <div class="card-body">
                                    <form method="post" id="category_update" novalidate=""> 

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                               <h3 class="card-header" align="Center"><i class="fas fa-address-card" style="font-size:35px; "></i> &nbsp;Payments</h3><br>
                                                 <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i>Payment Type</label>
                                                         <select  class="form-control select2 paymentType" required  name="paymentType">
                                                            <option value="0">Select Payment Type</option>
                                                            <option value="1">Cash</option>
                                                             <option value="2">Cheque</option>
                                                              <option value="3">Banks</option>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>  
                                                 </div>
                                                <div class="form-row cash_cheque" style="display: none;"> 
                                                    <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Type</label>
                                                         <select  class="form-control select2 expenseType" required  name="expenseType">
                                                            <option value="0">Select Type</option>
                                                             <option value="3">Expense</option>
                                                             <option value="4">Supplier/Vendor</option>
                                                             <option value="6">Company</option>
                                                             <option value="7">Others</option>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    <br>
                                                    <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Customer Name</label>
                                                         <select  class="form-control select2 customerType" required  name="customerType">
                                                            <option value="0">Select Customer Name</option>
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
                                                    <div class="form-group col-md-6 amount" style="display: none">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Amount</label>
                                                          <select class="form-control select2 cash_amount" required  name="cash_amount">
                                                                <option value="0">Select Amount</option>
                                                            </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                     
                                                     
                                                      <div class="form-group col-md-6 bank_amount" style="display: none;">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i>Bank Amount</label>
                                                          <select class="form-control select2 bank_amount_select" required  name="bank_amount">
                                                                <option value="0">Select Bank Amount</option>
                                                        </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                
                                               
                                                    <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Remarks</label>
                                                        <textarea class="form-control" name="remarks" required=""></textarea>
                                                     <div class="clearfix"></div>
                                                    </div>
                                               </div>
                                                <div class="form-row banks_list" style="display: none;"> 


                                                    <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Bank</label>

                                                         <select  class="form-control select2 ownerBankList" required  name="ownerBankList">
                                                            <option value="0">Select Bank</option>
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `customer` where customer_type = '2'";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $bank_id = $rowss['id'];
                                                                     $bank = $rowss['bank'];
                                                                    echo '<option value="'.$bank_id.'">'.$bank.'</option>';    
                                                                }   
                                                            ?>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    <br>
                                                    <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Cheque List</label>

                                                         <select  class="form-control select2 chequeList" required  name="chequeList">
                                                            <option value="0">Select Cheque List</option>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                   <br>

                                                   <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i>Transfer Bank </label>

                                                         <select  class="form-control select2 transferBank" required  name="transferBank">
                                                            <option value="0">Select Transfer Bank </option>
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `customer` where customer_type = '2'";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $bank_id = $rowss['id'];
                                                                     $bank = $rowss['bank'];
                                                                    echo '<option value="'.$bank_id.'">'.$bank.'</option>';    
                                                                }   
                                                            ?>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div> 

                                                    <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Cheque Amount</label>
                                                        <input  class="form-control chequeAmount" name="chequeAmount" required="">
                                                     <div class="clearfix"></div>
                                                    </div>
                                               

                                                <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Remarks</label>
                                                        <textarea class="form-control" name="bank_remarks" required=""></textarea>
                                                     <div class="clearfix"></div>
                                                    </div>
                                               

                                                  </div>

                                             

                                                   <div class="form-group col-md-4">
                                                     <label class="form-label form-label-lg"></label>
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
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
         
          <?php if(!@$_GET['id']) {echo "showmessage('success','Payments Insert Successfully','Success')";  } ?>
    })

//    <?php
//        if(@$_GET['id']){
//          echo "showmessage('success','Product Update Successfully','Success')";  
//        }else{
//            echo "showmessage('success','Product Insert Successfully','Success')";  
//        }
//        
//    ?>



  var paymentType;
    $('.paymentType').on("change",function(){

         paymentType =  $(this).val();
   
      if(paymentType == "1"){
            
            $('.cash_cheque').show();
            $('.amount').show();
            $('.bank_amount').hide();
             $('.banks_list').hide();
        }

        if (paymentType == "2"){
            $('.cash_cheque').show();
            $('.bank_amount').show();
             $('.banks_list').hide();
          $('.amount').hide();
        }

        if (paymentType == "3"){
          
            $('.cash_cheque').hide();
             $('.banks_list').show();
            $('.bank_amount').hide();
          $('.amount').hide();
        }

    })


    var  customerType;    
$(".customerType").on("change", function (event) {
      customerType  =  $(this).val();
     
         $.ajax({
            type: 'get',
            url: 'payment_fetch_ajax.php?customerType='+customerType+'&paymentType='+paymentType,
                  dataType: 'JSON',
            success: function (data) {
              console.log(data);
       $.each(data.owner_leadger, function (key, value) {
                   var account_number = value.account_number;
                   var id = value.id;
                   var amount = value.amount;
                   var payment_date = value.payment_date;
                   var account_title = value.account_title;
                   if(paymentType == 1){
                    $('.cash_amount').append($('<option></option>').val(value.amount +"," + value.id).html(amount +" "+ "["+payment_date+"]"));
                   }else{
                    $('.bank_amount_select').append($('<option></option>').val(value.amount +"," + value.id +"," +account_title).html(amount  + " " + "["+payment_date+"]" + " " + "["+account_title+"]" ));
                   }
               })
               
            },
            error: function(data){
               console.log("error");
           }
          });
    
 }) 


      var  ownerBankList;    
$(".ownerBankList").on("change", function (event) {
      ownerBankList  =  $(this).val();
      $('.chequeList').empty();
       $('.chequeList').append($('<option></option>').val('0').html("Select Cheque List"));

         $.ajax({
            type: 'get',
            url: 'payment_fetch_ajax.php?ownerBankList='+ownerBankList,
                  dataType: 'JSON',
            success: function (data) {
              console.log(data);
       $.each(data.chequeList, function (key, value) {
                   var id = value.id;
                   var account_title = value.account_title;
                   var account_number = value.account_number;


                 $('.chequeList').append($('<option></option>').val(value.id +"," + value.account_title +"," + value.account_number +"," + value.customer_id).html(account_title +" "+ "["+account_number+"]"));
                   
               })
               
            },
            error: function(data){
               console.log("error");
           }
          });
    
 }) 


    var  chequeList;    
$(".chequeList").on("change", function (event) {
      chequeList  =  $(this).val();
      
        
         $.ajax({
            type: 'get',
            url: 'payment_fetch_ajax.php?chequeList='+chequeList,
                   dataType: 'JSON',
            success: function (data) {
              console.log(data);
      
                   var amount = data.amount;
                   $('.chequeAmount').val(amount);
                   
             
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
