<?php
    session_start();
    ob_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
  
        if($_POST){
        $date = date('Y-m-d');
        $invoice_id = $_GET['invoice_id'];
        $account_title = @$_POST['account_title'];
        $account_number = @$_POST['account_number'];
        $bank = @$_POST['bank'];
        $check_date = @$_POST['check_date'];
        $amount_received = @$_POST['amount_received'];
        $balance   = @$_POST['balance'];
        $form_submit = @$_POST['form_submit'];
        $customerID = @$_POST['customerID'];
        $sale_invoice_amount_details_id = @$_POST['sale_invoice_amount_details_ids'];
        $totalNetAmount = @$_POST['totalNetAmount'];
        $opening_balance = @$_POST['opening_balance'];
        $amount = @$_POST['amount'];
        
        $previous_balance =  $totalNetAmount - $amount_received;
       
        
        if($form_submit == 1){
           
            
           foreach($account_title as $key=>$value){
                
                $account_titlesValue = $account_title[$key];
                $account_numbersValue = $account_number[$key];
                $bankValue = $bank[$key];
                $amountValue = $amount[$key];
                $chec_dateValue = $check_date[$key];
              
                $insert_query_bank = "INSERT INTO `check _records`(`account_title`, `account_number`, `bank`, `status`, `sale_invoice_id`, `customer_id`, `check_date`, `current_date`,`sale_invoice_amount_id`,`amount`) VALUES ('$account_titlesValue','$account_numbersValue','$bankValue','1','$invoice_id','$customerID','$chec_dateValue','$date','$sale_invoice_amount_details_id','$amountValue')";
                $stmttte = $dbh->prepare($insert_query_bank);
                $stmttte->execute();    
            }        
            
        $update_query = "UPDATE `sale_invoice_amount_details` SET `payment_status`= '1',`time_stamp`= now() WHERE `id` ='$sale_invoice_amount_details_id'";
        $st = $dbh->prepare($update_query);
        $st->execute();
            
        }else{
            
            
            $remainingOpeningBalance = $opening_balance -  $amount_received;
        
            $update_query_customer = "UPDATE `customer` SET `opening_balance`= '$remainingOpeningBalance'  WHERE `id` = '$customerID'";
            $stmtes = $dbh->prepare($update_query_customer);
            $stmtes->execute();
            
        
            $insert_query_cash = "UPDATE `sale_invoice_amount_details` SET `amountReceived`= '$amount_received',`previousBalance` ='$previous_balance',`payment_status`='2',`time_stamp`= now() WHERE `id`  = '$sale_invoice_amount_details_id'";
            $stmt = $dbh->prepare($insert_query_cash);
            $stmt->execute();   
        }
        
        
        header("Location:bank-check-status.php");
        
        
    }



?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Bank Check Status | Ppipopular</title>

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
            
ul.dropdown-menu {
            border: 1px solid #efebeb !important;
            border-radius: 0px;
            box-shadow: 0 6px 12px rgba(0,0,0,.175) !important;
        }
        .status-button {
            float: right;
            line-height: 2.6;
        }
        .menu-hover > li > a:hover, .dropdown-menu > li > a:focus {
            background: rgb(237, 241, 242) !important;
            color: #414042 !important;
        }            
 .status-button {
            float: right;
            line-height: 2.6;
        } 
            
  .comments-list .comment-avatar {
            width: 50px;
            height: 50px;
            position: relative;
            z-index: 99;
            float: left;
            border: 2px solid #FFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 50px;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin-left: 8px;
            background: white;
        }
            .dropdown-menu-selected{
                color: #f3f4f5 !important;text-decoration: #fff !important;background-color: rgba(24, 28, 33, 0.03) !important;background: #262937 !important;                    
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
<!--
                        <div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               
                                <form class="modal-content" method="post" action="due-payment.php?invoice_id='+ID+'" id="product_update">
                                    <div class="modal-body form-horizontal">
                                        <div class="row">
                                            <div class="col-md-10" style="width:86%">
                                                <div class="status-button">
                                                    <span class="status-div">
                                                        <span class="badge badge-pill badge-primary">Pending</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                     <div class="status-button">
                                                            <div class="dropdown" style="float:left;margin-left:9px">
                                                                <button class="dropdown-toggle" style="border:none;background:none" type="button" data-toggle="dropdown">
                                                                    <i class="fa" style="color: #000;">&#xf141;</i>
                                                                </button>
                                                                <ul class="dropdown-menu update_status">
                                                                    <input type='text' class='bank_check_id_hidden'>
                                                                    <input type='text' class='sale_invoice_detail_id_hidden'>
                                                                    <input type='text' class='totalNetAmountHidden'>
                                                                    
                                                                        <li><a href="#">Pending</a></li>
                                                                        <li><a href="#">Clear</a></li>
                                                                        <li><a href="#">Return</a></li>
                                                                    </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="form-row">
                                                    <div class="form-group col mb-4">
                                                            <label class="form-label">Comment</label>
                                                        <textarea class="form-control"  name="comment"></textarea>
                                                            <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                <div class="form-row" style="float:right">
                                                    <div class="form-group col mb-4">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                   
                                                    </div>
                                                </form>
                                
                        
                    
                                
                            </div>
                        </div>
-->

                    
                       <div class="modal fade" id="check_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-xl">
                                    <div class="modal-body form-horizontal">
                                      
                                    </div>
                               </div>
                        </div>

                      <!-- Modal template -->
                        <div class="modal fade" id="modals-default">
                            <div class="modal-dialog modal-lg">

                            </div>
                        </div>

            <!-- Modal template end-->
            <!-- Modal template end-->
                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Bank Check Status</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Bank Check Status</li>
                            </ol>
                        </div>

                       
                       
                       
                       
                       <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Bank Check Status List</h3>
                            <div class="card-body">
                                   <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Customer Name</th>
                                        <th>Invoice #</th>
                                       <th>Invoice Date</th>
                                         <th>Total Invoice Amount</th>
                                         <th>Check Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $fetch_query = "SELECT cr.* ,si.invoiceDate,(SELECT customer_name from customer WHERE id = cr.customer_id) as customer_name ,(SELECT totalNetAmount from sale_invoice_amount_details WHERE sale_invoice_id = si.id) as totalNetAmount  ,(SELECT payment_status from sale_invoice_amount_details WHERE sale_invoice_id = si.id) as payment_status ,(SELECT id from sale_invoice_amount_details WHERE sale_invoice_id = si.id) as sale_invoice_detail_id  ,   si.invoiceNumber ,(SELECT status_name FROM bank_status WHERE id = cr.status) as statusName  FROM `check _records` cr , sale_invoice si  WHERE  si.id = cr.`sale_invoice_id` GROUP BY  cr.`sale_invoice_id`";
                                $sth = $dbh->prepare($fetch_query);
                                $result = $sth->execute();
                                 $count =1;
                                while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                      $bank_check_id = $rows['id'];
                                      $customer_name = $rows['customer_name'];
                                      $invoiceNumber = $rows['invoiceNumber'];
                                      $statusName = $rows['statusName'];
                                      $invoiceDate = $rows['invoiceDate'];
                                     
                                      $totalNetAmount  = $rows['totalNetAmount'];
                                     
                                      $sale_invoice_detail_id = $rows['sale_invoice_detail_id'];
                                      $sale_invoice_id = $rows['sale_invoice_id'];
                                    
                                   
                                    
                                    
                              echo"<tr> 
                                          <td>$count</td>
                                          <td>$customer_name</td>
                                           <td>$invoiceNumber</td>
                                           <td>$invoiceDate</td>
                                            <td>$totalNetAmount</td>
                                           <input type='hidden' class='totalNetAmount' value='$totalNetAmount'><input type='hidden' class='sale_invoice_detail_id' value='$sale_invoice_detail_id'><input type='hidden' class='status_fetch' value='$statusName'><input type='hidden' class='bank_check_id' value='$bank_check_id'>
                                           <td><img src='assets/img/view.svg' id ='$sale_invoice_id' class='check_details'  style='width: 25px;height: 25px;cursor:pointer'></td>";
                                        
                                         echo "</tr>";
                                    $count++;
                                }	
    

                                    ?>
<!--                                    if($payment_status == 1){-->
<!--
                                        echo "<td><img src='assets/img/view.svg' id ='$bank_check_id' class='payment_by_bank' data-toggle='modal' data-target='#modals-default' style='width: 25px;height: 25px;cursor:pointer'></td>";
                                        }else{
                                            echo "<td>--</td>";
                                        }
-->
                                </tbody>
                            </table>
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
    $(document).ready(function () {
    
        
        
     $('body').on('click','.check_details', function(event){   
         var ID = this.id;
         var $this = $(this);
           
         $.ajax({
            type: 'get',
            url: 'bank-check-status-ajax.php?invoice_id='+ID,
            success: function (data) {
               
               $('.modal-dialog').html(' <form class="modal-content" method="post" action="due-payment.php" id="product_update"><div class="modal-body form-horizontal"><div class="form-row">'+data+'<div class="form-row" style="float: right;"><div class="form-group col mb-4"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></form>'); 
                $('#check_details').modal('show'); 
                $(function() {
//  $('.datatables-demo').dataTable();
});
                $('#sample').dataTable();
                
        $('.dropdown-menu a').each(function(e){
                var status = $(this).attr('status');
                var dropdown_value = $(this).text();
                if (status==dropdown_value) {
                    $(this).addClass('dropdown-menu-selected');
                }
            })
                
                
            },
            error: function(data){
               console.log("error");
           }
          });
     })
        
    })
    
    $(document).ready(function () {
        var table = $('#example').DataTable();

        $('body').on('click','#sample tbody', function(event){
            $(this).toggleClass('selected');
            var ids = $.map(table.rows('.selected').data(), function (item) {
                return item[0]
            });
        });
});
    
   $('body').on('click','.dropdown-menu a', function(event){  

        var status = $(this).text();
        var statuDiv = "";
       $thisSupport = $(this).closest('tr');
        var bank_check_id = $thisSupport.find('.bank_check_id').val();
        var sale_invoice_detail_id = $thisSupport.find('.sale_invoice_detail_id').val();
        var amount = $thisSupport.find('.amount').val();
        var payment_statuHtml = $thisSupport.find('.payment_statuHtml').val();
       var OldStatus = $thisSupport.find(".dropdown-item").attr('status');
       
      if(status == OldStatus){
          alert('already selcted!');
      }else{
        if(status == 'Clear'){
              statuDiv = '<span class="badge badge-pill badge-success">'+status+'</span>';
            }
            else if(status == 'Pending'){
                statuDiv = '<span class="badge badge-pill badge-danger">'+status+'</span>';
            }
            else{
                statuDiv = '<span class="badge badge-pill badge-primary">'+status+'</span>';
            }
         $thisSupport.find('.status-div').html(statuDiv);   

           $.ajax({
                type: 'get',
                url: 'bank-check-status-ajax.php?status='+status +"&bank_check_id="+bank_check_id +"&sale_invoice_detail_id="+sale_invoice_detail_id +"&amount="+amount,
                success: function (data) {
                   console.log(data);
                    $("#editable-table").load(location.href + " #editable-table");
                },
                error: function(data){
                   console.log("error");
               }
              }); 
      }
        
    })
  
    $("table").on("click", ".delete", function (event) {
                if (confirm("Are you sure you want to delete this Product?")) {
                    var ID = this.id;
                     var $this = $(this); 
                    $.get("delete.php?product_id="+ID, function (data, status) {
                        if (status == 'success') {
                            var Row = $this.closest('tr');
                              var tr = $this.parents('tr');
                              var nRow = Row[0];
                            showmessage('warning','Product Delete Successfully','Success');  
                            $('#editable-table').dataTable().fnDeleteRow(nRow);
                             $("#editable-table").load(location.href + " #editable-table");
				        } else
                        {
                           // alert('Event Delete Error');
                        }
                    });
                    
                }
            });  	
    
      $(document).ready(function(){
       $('body').on("focusout",".amount",function(e){
        var $trs = $(this).closest('tr');   
         var amount = parseInt($trs.find('.amount').val());
           
         var totalReceivable = parseInt($('.totalReceivable').val());
         var checkBalanceAmountUpdated = $('.checkBalanceAmount').val();   
          
           if(amount > totalReceivable){
               $trs.find('.amount').css({"color":"red","border":"1px solid red"});
               $('.add_banks').prop('disabled', true);
               alert("Check amount exceed to total receivable amount");
               return false;
           }
           else{
               $('.add_banks').prop('disabled', false);
                 $trs.find('.amount').css({"color":"","border":"1px"});
                if(checkBalanceAmountUpdated != ""){
                   totalReceivable = checkBalanceAmountUpdated;
                     var checkBalanceAmount =  totalReceivable - amount;
                    $('.checkBalanceAmount').val(checkBalanceAmount);   
                }else{
                    var checkBalanceAmount =  totalReceivable - amount;
                $('.checkBalanceAmount').val(checkBalanceAmount);    
                }

           }
        })    
 }) 
    
    
     $('body').on('click','.payment_by_bank', function(event){
        var  sale_invoice_detail_id = $(this).closest('tr').find('.sale_invoice_detail_id').val();
        var  customerID = $(this).closest('tr').find('.customer_id').val();
        var  amount = $(this).closest('tr').find('.amount').val();
         var  bank_check_id = $(this).closest('tr').find('.bank_check_id').val();
      
         $(function () {
           $('#check_details').modal('toggle');
        });
         
         $('.modal-dialog').html(' <form class="modal-content" method="post" action="bank-check-status.php?invoice_id='+bank_check_id+'" id="product_update"><div class="modal-body form-horizontal"><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">Total Receivable:</label><input type="text" class="form-control totalReceivable" value="'+amount+'" placeholder="Total Receivable" name="total_receivable:"><div class="clearfix"></div> </div><div class="form-group col mb-4"> <label class="form-label">Check Balance Amount:</label><input type="text" class="form-control checkBalanceAmount"  placeholder="Check Balance Amount" name="check_balance_amount:"><div class="clearfix"></div> </div><table class="table product-discounts-edit bank_details" style="width:100%;float:right;"><thead><tr><th width="15%">Account Title</th><th width="15%">Account Number</th><th>Amount</th><th>Bank</th><th>Check Date</th><th></th></tr></thead> <tr> <td><input type="text" class="form-control account_titles"  placeholder="Account Title"  name="account_title[]"></td><td><input type="text" class="form-control account_numbers[]" placeholder="Account Number"  name="account_number[]"></td><td><input type="number" class="form-control amount" placeholder="Amount"  name="amount[]"></td><td> <select class="form-control select2-demo bank" name="bank[]"><option value="0">Select Bank</option>\
                                             <?php
                                                $fetch_query = "SELECT * FROM `banks`";
                                                $sth = $dbh->prepare($fetch_query);
                                                $result = $sth->execute();
                                                while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                                      $id = $rows['id'];
                                                     $bank_name = $rows['bank_name'];
                                                    echo '<option value="'.$id.'">'.$bank_name.'</option>';    
                                                }	
                                            ?>
                                         </select> </td><td><input type="date" class="form-control"  name="check_date[]"></td> <td><button type="button" class="btn icon-btn btn btn-outline-success add_banks"><span class="fas fa-plus"></span></button></td></tr></table><br><br><input type="hidden" name="form_submit" value="1"> <input type="hidden" name="customerID" value="'+customerID+'"><input type="hidden" value="'+sale_invoice_detail_id+'"><div class="form-row" style="float: right;"><div class="form-group col mb-4"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  <button type="submit" class="btn btn-primary">Save</button></div></form>');
        $('.bank').select2({
            dropdownParent: $('#modals-default')
        });
        
     });  

     $('body').on('click','.add_banks', function(event){     
          $('.bank_details').append('<tr> <td><input type="text" class="form-control account_titles"  placeholder="Account Title"  name="account_title[]"></td><td><input type="text" class="form-control account_number[]" placeholder="Account Number"  name="account_number[]"></td><td><input type="number" class="form-control amount" placeholder="Amount"  name="amount[]"></td><td> <select class="form-control select2-demo bank" name="bank[]"><option value="0">Select Bank</option>\
                 <?php
                    $fetch_query = "SELECT * FROM `banks`";
                    $sth = $dbh->prepare($fetch_query);
                    $result = $sth->execute();
                    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                          $id = $rows['id'];
                         $bank_name = $rows['bank_name'];
                        echo '<option value="'.$id.'">'.$bank_name.'</option>';    
                    }	
                ?>
           </select> </td><td><input    type="date" class="form-control"  name="check_date[]"></td><td></td></tr>');
        $('.bank').select2();         
  })  
   

    
    
        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
