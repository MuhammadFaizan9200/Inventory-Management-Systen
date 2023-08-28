<?php
    ob_start();
	session_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $getInvoiceDetails = array();
    $date = date('Y-m-d');
    $currentTime = date("h:i:s");
    $sale_invoice_random = "A-T-". mt_rand(100000, 999999);
    $session_user_name =  $username ;
    $company_id = @$_GET['company_id'];


    if(!@$_GET['company_id']){
      header("Location:invoice-company.php");
    }

   if(@$_GET['id']){
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
       
//        $invoice_details_query = "SELECT * FROM `purchase_invoice_details`  where purchase_invoice_id = '$purchaseInvoiceID'";
//        $stht = $dbh->prepare($invoice_details_query);
//        $result = $stht->execute();
//        while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
//            $getInvoiceDetails[] = $rowss;
//        }
          
   }
    


?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
       <title>Sale Invoice | Ahmed Traders</title>
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
  .modal-dialog {
  width: 100%;
  height: 100%;
  padding: 0;
}

.modal-content {
  height: 100%;
  border-radius: 0;
} 
.table-responsive{
  height: 450px !important;
  overflow: auto !important; 
}
@media (min-width: 576px){
.modal-dialog {
    max-width: 100% !important;
    margin: 1.75rem auto;
  }           
}
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
                        <h4 class="font-weight-bold py-3 mb-0">Sales Invoice</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Sales Invoice</li>
                            </ol>
                        </div>
                        <!-- Modal -->


                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <!-- <h4 class="modal-title" id="myModalLabel"></h4> -->
                      </div>
                      <div class="modal-body">
   
                      </div>
                     <!--  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div> -->
                    </div>
                  </div>
                </div>
                       


                     <div class="print-ledger-data" style="display: none"></div>       

                        <div class="card mb-4">
                           
                           <div class="card-header bg-primary text-white " style="font-size: 25px; text-align: center;"> <i class="fas fa-money-bill-alt" style="font-size:25px; "></i> &nbsp; Ahmed Traders | New Invoice 
                                    </div>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                 <h3 style="width: 100%; text-align: center; border-bottom: 2px solid #716aca; line-height: 0.1em; margin: 10px 0 20px; "><span style="background:#fff; padding:0 10px; color:#716aca; ">Customer Details</span></h3>

                           <form method="post" id="purchaseInvoice">



                              <div class="form-row">
                                <div class="form-group col-md-3">
                                  <label class="form-label">Customer Name</label>
                                   <select class="select2-demo form-control customerType" style="width: 100%" data-allow-clear="true" name="customer_id">
                                        <option value="0">Select Customer Name</option>
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
                                </div>
                                <div class="form-group col-md-3">
                                   <label class="form-label">Customer Address</label>
                                     <input type="text" class="form-control customerAddress" readonly="" name="customerAddress" placeholder="Current Address">
                                </div>

                              
                                <div class="form-group col-md-3">
                                 <label class="form-label">Contact Number</label>
                                        <input type="text" class="form-control contactNumber" name="contactNumber" readonly="" placeholder="Active Mob. Number">

                                </div>

                                <div class="form-group col-md-3">
                                     <label class="form-label">Invoice No.</label>
                                            <input type="text" class="form-control" required name="invoiceNumber" value="<?php echo @$sale_invoice_random ?>" placeholder="SI/PPI/0000001">
                                </div>
                               
                                <input type="hidden" class="form-control" readonly=""  name="invoiceCreate" value="<?php echo @$session_user_name ?>" placeholder="Login User Name">
                               </div>

                              <div class="form-row">  
                                 <div class="form-group col-md-3">
                                    <label class="form-label">Invoice Date</label>
                                            <input type="text" class="form-control"  name="invoiceDate" placeholder="" value="<?php echo @$date ?>">
                                </div>
                           
                               <div class="form-group col-md-3">
                                  <label class="form-label">Saleman Name</label>
                                   <select class="select2-demo form-control saleman_name" style="width: 100%" data-allow-clear="true" name="saleman_id">
                                        <option value="0">Select Saleman Name</option>
                                        <?php
                                            $fetch_category = "SELECT * FROM `saleman`";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $saleman_id = $rowss['id'];
                                                 $saleman_name = $rowss['saleman_name'];
                                                echo '<option value="'.$saleman_id.'">'.$saleman_name.'</option>';    
                                            }   
                                        ?>
                                    </select>    
                                </div>

                            <div class="form-group col-md-3"> 
                                      <input type="image" width="50" value="submit" src="assets/ledger.svg" alt="submit Button" onMouseOut="this.src='assets/ledger.svg'" onMouseOver="this.src='assets/ledger.svg'" class="customer_ledger" style="display: none">       
                                </div>    



                            </div>

                                <br> 
                                <h3 style="width: 100%; text-align: center; border-bottom: 2px solid #716aca; line-height: 0.1em; margin: 10px 0 20px; "><span style="background:#fff; padding:0 10px; color:#716aca; ">Select Product</span></h3>

                               
                                 <div class="table-responsive">
                                            <table class="table product-discounts-edit datatable" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Name</th>
                                                        <th>List Price</th>
                                                         <th>Qty</th>
                                                        <th>Discount %</th>
                                                        <th>Net Price</th>
                                                        <th>Net Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                
                                                    <tr>
                                                     <td>
                                                     <select class="custom-select set_products select2-demo" name="insert_productName[]" required>
                                                      <option value="0">Choose Product</option>
                                                     <?php
                                                        $fetch_query = "SELECT * FROM `products` where company_id = '$company_id'";
                                                        $sth = $dbh->prepare($fetch_query);
                                                        $result = $sth->execute();
                                                        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                                              $id = $rows['id'];
                                                             $product_name = $rows['product_name'];
                                                            echo '<option value="'.$id.'">'.$product_name.'</option>';    
                                                        } 
                                                    ?>
                                                  </select> 
                                                        </td>


                                                        <td><input type="text" class="form-control list_price" name="list_price[]" placeholder="List Price" required></td> 
                                                        
                                                        
                                                         <td><input type="hidden" name="avialableQuantity[]" class="avialableQuantity"><input type="number" class="form-control total_quantity" name="total_quantity[]" required  placeholder="Total Qty."></td>
                                                        <td><input type="number" class="form-control discount" name="discount[]" placeholder="Discount %"></td>
                                                        <td><input type="number" required class="form-control net_price" name="net_price[]" placeholder="Net Price" required readonly=""></td>
                                                        <td><input type="number" required class="form-control net_amount" name="net_amount[]" placeholder="Net Amount" readonly=""></td>
                                                        <td><button type="button" class="btn icon-btn btn btn-outline-success add_invoice"><span class="fas fa-plus"></span></button></td>
                                                    </tr>
                                            
                                            </table>
                                    
                             <span class="card-header limit_message" align="Center" style="color: red;display:none"> Excied your limit please select valid quantity</span>
                               <br>   
                             <h3 style="width: 100%; text-align: center; border-bottom: 2px solid #716aca; line-height: 0.1em; margin: 10px 0 20px; "><span style="background:#fff; padding:0 10px; color:#716aca; ">Selected Product Previous Details</span></h3>

                                    <table class="table product-discounts-edit" style="width:100%">
                                        
                                        <tr>
                                             <th width="15%">On Hand Quantity:</th>
                                            <td width="15%"><strong class="on_hand_quantity"></strong></td>

                                             <th width="15%">Type (Packing):</th>
                                            <td width="15%"><strong class="type_packing"></strong></td>


                                            <th width="15%">Previous Price:</th>
                                            <td width="15%"><strong class="previousPrice"></strong></td>
                                            
                                             <th width="15%">Previous Discount:</th>
                                            <td width="15%"><strong class="PreviousDiscount"></strong></td>

                                        </tr>
                                    </table>    
                                    
                                     <table class="table product-discounts-edit table_details" style="width:38%;float:right">
                                              <tr>
                                                <td colspan="7" class="py-3">
                                                      <b>Total Gross Amount:</b><br>
                                                      <b>Total Discount%:</b><br>
                                                       <b>Discount Amount:</b><br>
                                                      <b>Total Net Amount:</b> <br>
                                                     <b>Previous Balance:</b>
                                                   <!--  <span class="d-block text-big mt-2">  <strong>Payment Method:</strong>   </span> -->
                                                    <span class="d-block text-big mt-2">  <strong>Total Receivable:</strong>   </span>
                                                   <!--  <span class="d-block text-big mt-2">  <strong>Check Balance Amount:</strong>   </span> -->
                                                </td>
                                                  
                                                  <input type="hidden" name="openingBalance" class="openingBalance">
                                                  <input type="hidden" name="grossAmount" class="grossAmount">
                                                  <input type="hidden" name="totalDiscount" class="totalDiscount">
                                                  <input type="hidden" name="totalNetAmount" class="totalNetAmount">
                                                  <input type="hidden" name="totalReceivableInput" class="totalReceivableInput">
                                                   <input type="hidden" name="previousBalance" class="previousBalance">
                                                   <input type="hidden" name="amountReceived" class="amountReceived">
                                                   <input type="hidden" name="craditLimit" class="craditLimit">
                                                   <input type="hidden" name="company_id" class="company_id" value="<?php echo @$company_id ?>">
                                                  
                                                <td class="py-3">
                                                    <strong class="gross_amount"></strong><br>
                                                    <strong class="totalDiscount"></strong>
                                                    <br>
                                                    <strong class="totalDiscountAmount"></strong>
                                                    <br>
                                                    <strong class="totalNetAmount"></strong>
                                                    <br>
                                                    <strong class="totalPreviousBal"></strong> <br>
                                                   <!--  <input type="radio" name="payment_method" value="1">By Check <input type="radio" value="2" name="payment_method"> By Cash <input type="radio" value="3" name="payment_method"> By Cradit -->
                                                    <strong class="d-block text-big mt-2 totalReceivable" style="font-size:30px;"></strong>
                                                    <br>
                                                    <!-- <strong class="d-block text-big mt-2 checkBalanceAmount" style="font-size:30px;"></strong> -->
                                                    <br>
                                                </td>
                                            </tr>
                                        </table> 
                                    
                                    
                    <table class="table product-discounts-edit bank_details" style="width:100%;float:right;display:none">
                              <thead>
                                  <tr>
                                    <th width="15%">Account Title</th>
                                    <th width="15%">Account Number</th>
                                    <th>Amount</th>
                                     <th>Bank</th>
                                    <th>Check Date</th>
                                    <th></th>
                                </tr>
                            </thead> 
                              <tr>
                                  <td><input type="text" class="form-control account_titles"  placeholder="Account Title"  name="account_titles[]"></td>
                                  <td><input type="text" class="form-control account_numbers" placeholder="Account Number"  name="account_numbers[]"></td>
                                  <td><input type="number" class="form-control amount" placeholder="Amount"  name="amount[]"></td>
                                  <td> 
                                      <select class="form-control select2-demo bank" name="bank[]">
                                             <option value="0">Select Bank</option>
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
                                             
                                         </select>
                                  </td>
                                  <td><input type="date" class="form-control"  name="chec_date[]"></td>
                                  <td><button type="button" class="btn icon-btn btn btn-outline-success add_banks"><span class="fas fa-plus"></span></button>
                                  </td>
                              </tr>
                              
                        </table>  
                                    
                    </div>
                     
                         <div class="form-row check_details" style="display: none;">

                                <div class="form-group col-md-2">
                                   <label class="form-label">Godown Check</label>
                                     <input type="text" class="form-control godownCheck" placeholder="Godown Check"  name="godownCheck">
                                     <div class="clearfix"></div>
                                </div> 

                                    <div class="form-group col-md-2">
                                   <label class="form-label">Delivered By</label>
                                     <input type="text" class="form-control deliveredBy" placeholder="Delivered By"  name="deliveredBy">
                                     <div class="clearfix"></div>
                                    </div> 

                                   <div class="form-group col-md-2">
                                   <label class="form-label">Amount Received</label>
                                     <input type="text" class="form-control totalReceived" placeholder="Amount Received"  name="totalReceived">
                                     <div class="clearfix"></div>
                                    </div> 
                                    <div class="form-group col-md-2">
                                            <label class="form-label">Balance Amount</label>
                                            <input type="text" class="form-control currentBalance" placeholder="Balance Amount"  name="new_balance_amount">
                                            <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group col-md-3">
                                       <label class="form-check">
                                         <input class="form-check-input logo" type="radio" name="logo" value="1">
                                            <span class="form-check-label">With Logo</span>
                                            <input class="form-check-input logo" style="margin-left: 10px;" type="radio" name="logo" value="0">
                                            <span class="form-check-label" style="margin-left: 25px;">Without Logo</span>
                                        </label>
                                    </div>
                                     
                                </div>
                                
                                    <div class="form-group" align="right">
                                      <div class="col-sm-offset-8 col-sm-3">
                                      <input type="image" width="60" value="submit" src="assets/printer.svg" alt="submit Button" onMouseOut="this.src='assets/printer.svg'" onMouseOver="this.src='assets/printer.svg'">       
                                            </div>
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


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
        <script src="assets/js/spdf.plugin.autotable.js"></script>

<script>
       
    
$('input:radio[name="payment_method"]').change(function(){
    if($(this).val() === '1'){
       // append stuff
       $('.bank_details').show();
        $('.check_details').hide();
    }
    else if($(this).val() === '3'){
       // append stuff
        $('.bank_details').hide();
        $('.check_details').show();
        
        $('.totalReceived').attr('readonly', true);
        $('.currentBalance').attr('readonly', true);
        $('.totalReceived').val("0");
        $('.currentBalance').val("0");
    }
    else{
         $('.totalReceived').attr('readonly', false);
        $('.currentBalance').attr('readonly', false);
        $('.totalReceived').val("");
        $('.currentBalance').val("");
        $('.bank_details').hide();
        $('.check_details').show();
    }
});    
    
    

    
$("#purchaseInvoice").submit(function(e) {
	e.preventDefault();
     var saleman_name =  $('.saleman_name').val();
     var customerType =  $('.customerType').val();
    var form_data = new FormData(this);

  if(saleman_name != 0 && customerType != 0){ 
 swal({
              title: "Are you sure you want to confirm this sale invoice?",
              text: "Once updated, your invoice successfully saved!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
    
    .then((willDelete) => {
              if (willDelete) {
                 
                    $.ajax({
                        type: 'post',
                        url: 'saleInvoiceAjax.php',
                        data:form_data,
                         cache:false,
                        contentType: false,
                        processData: false,	 
                        success: function (data,status) {
                            console.log(data);
                            var get_varabile = data.split(",");
                            var get_invoice_id = get_varabile[0];
                            var get_customer_id = get_varabile[1];
                            var trimStr = $.trim(get_invoice_id);
                            console.log(trimStr);
                            window.open(
                              'print-invoice-fpdf.php?get_invoice_id='+trimStr +'&get_customer_id='+get_customer_id+"&company_id="+<?php echo @$company_id ?>,
                              '_blank' // <- This is what makes it open in a new window.
                            );
                            window.setTimeout(function() {
                              window.location.href = 'sale_invoice.php?company_id=<?php echo @$company_id ?>';
                          }, 2000);  


                        }
                    });
            swal("Poof! Sale invoice has been submit!", {
                  icon: "success",

                });
              } else {
               return false;
              }
            });
    }else{
        alert("Please select customer or saleman");
    }
       
       
});

 $(document).ready(function(){
   $('body').on("focusout",".amount",function(e){	  
    var $trs = $(this).closest('tr');   
     var amount = parseInt($trs.find('.amount').val());
     var totalReceivable = parseInt($('.totalReceivable').text());
     var checkBalanceAmountUpdated = $('.checkBalanceAmount').text();   
      console.log(checkBalanceAmountUpdated +"==");
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
                $('.checkBalanceAmount').text(checkBalanceAmount);   
            }else{
                var checkBalanceAmount =  totalReceivable - amount;
            $('.checkBalanceAmount').text(checkBalanceAmount);    
            }
          
       }
     
 })    
 })


var  customerType;    
$(".customerType").on("change", function (event) {
      customerType  =  $(this).val();

         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?customerType='+customerType+"&company_id="+<?php echo @$company_id ?>,
                  dataType: 'JSON',
            success: function (data) {
                console.log(data);
                var previousBalance = data.previousBalance;
                if(previousBalance == null){
                    previousBalance = 0;
                }
                
                 $('.previousBalance').val(previousBalance);
                 $('.totalPreviousBal').html(previousBalance);  
                
                $('.account_titles').val(data.account_title);
                $('.account_numbers').val(data.account_number);
                
                $('.bank').select2('data', {id: data.bank, a_key: 'National Bank of Pakistan'});
               
                $('.customer_ledger').show();
                $('.customer_ledger').attr('customer-id',customerType);
                
               
                $("#mySelect2").select2("val", "0");
                
                 $('.contactPerson').val(data.saleman_name);
                  $('.contactNumber').val(data.saleman_mobile1);
                $('.customerAddress').val(data.address);
                $('.contactNumber').val(data.mobile_1);
                
                //console.log(data.credit_limit);  
        
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })    

 var  select_category;
$("table").on("change", ".select_category", function (event) {
  select_category =  $(this).closest('tr').find('.select_category').val();
    var $tr = $(this).closest('tr');
     $tr.find('.set_products').empty();
    $tr.find('.set_products').append($('<option></option>').val("0").html("Choose Product"));
   
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?select_category='+select_category,
                  dataType: 'JSON',
            success: function (data) {
               
            $.each(data.products, function (key, value) {
                 //console.log(value.product_name);
                $tr.find('.set_products').append($('<option></option>').val(value.id).html(value.product_name));
                 $('.limit_message').hide();
                 $tr.find('.previousQuantity').val(value.product_quantity);
                
                
            });
      
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })       
    
    
$("table").on("change", ".set_products", function (event) {
     var  set_products_value =  $(this).closest('tr').find('.set_products').val();
     var $tr = $(this).closest('tr');
     if(customerType != 0 && customerType != undefined){
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?set_products_value='+set_products_value +"&customerID="+customerType,
                  dataType: 'JSON',
            success: function (data) {
                console.log(data);
                var product_quantity_sale = data.product_quantity_sale;
                

                if(product_quantity_sale == 0){
                    $tr.find('.set_products').val("0");   
                    alert("Quantity is not available");
                }else{
                   if(data.previousPrice != null){
                       $('.previousPrice').html(data.previousPrice);
                       $('.PreviousDiscount').html(data.previousDiscount); 
                        $('.on_hand_quantity').html(product_quantity_sale); 
                        $('.type_packing').html(data.type); 
                        
                   }else{
                       $('.previousPrice').html("0");
                       $('.PreviousDiscount').html("0");   
                       $('.on_hand_quantity').html(product_quantity_sale); 
                       $('.type_packing').html(data.type); 
                   }
                    //   console.log(data.company_id); 
                    $tr.find('.list_price').val(data.price);    
                    $tr.find('.avialableQuantity').val(data.product_quantity_sale);      
                     $tr.find('.discount').val(data.discount);  
                     //$tr.find('.company_id').val(data.company_id);       
                }
          },
            error: function(data){
               console.log("error");
           }
          });
    }else{
      alert("Please select customer");
      $tr.find('.set_products').val("Choose Product");
    }
      
    
 })        
    
  
$('.add_invoice').on('click',function(){
       

        var $tr = $(this).closest('tr');   
        var total_quantity = parseInt($tr.find('.total_quantity').val());
        var avialableQuantity = parseInt($tr.find('.avialableQuantity').val());
    
        var rowCount = $('#datatable tr').length;
        $('.totalItem').val(rowCount);

        if(total_quantity > avialableQuantity){
            alert("Quantity not available");
      
            }else{
                var craditLimit = parseInt($('.craditLimit').val());
                var totalNetAmount = parseInt($('.totalReceivableInput').val());
                
              if(totalNetAmount > craditLimit){
                     alert("Your Cash limit is excied please change the quantity");            
                }else{
                    
                    
        $('#datatable').append('<tbody><tr class="tRow"><td><select class="custom-select set_products" required name="insert_productName[]"><option selected>Choose Product</option>\
             <?php
              $fetch_query = "SELECT * FROM `products` where company_id = '$company_id'";
              $sth = $dbh->prepare($fetch_query);
              $result = $sth->execute();
              while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                    $id = $rows['id'];
                   $product_name = $rows['product_name'];
                  echo '<option value="'.$id.'">'.$product_name.'</option>';    
              }   
          ?>
          </select></td><td><input type="text" class="form-control list_price" name="list_price[]" required placeholder="List Price"></td><td><input type="hidden" name="avialableQuantity[]" class="avialableQuantity"><input type="text" required class="form-control total_quantity" name="total_quantity[]" placeholder="Total Qty"></td><td><input type="text" class="form-control discount"  placeholder="Discount %" name="discount[]"></td><td><input  required type="number" class="form-control net_price" placeholder="Net Price" name="net_price[]" required readonly=""></td><td><input type="number" required class="form-control net_amount" name="net_amount[]" placeholder="Net Amount" readonly=""></td><td><button type="button" class="btn icon-btn btn btn-outline-danger delete_tr_row"><span class="fas fa-trash-alt"></span></button></td></tr></tbody>'); 
            $('#datatable tr:last').find(".select_category").focus();
             $('.select_category').select2();
             $('.set_products').select2();  

              $('#datatable tr:last').find('.select_category').val(''+select_category+'').trigger("change");  
            }

        }
    
    
         
    })  


  $('body').on("keyup change",".total_quantity", function() {
            
        var $tr = $(this).closest('tr');   
        var total_quantity = parseInt($tr.find('.total_quantity').val());
        var avialableQuantity = parseInt($tr.find('.avialableQuantity').val());
         if(total_quantity > avialableQuantity){
              $tr.find('.total_quantity').val(avialableQuantity);
            }


    });

 $(document).ready(function(){
    $("table").on("click", ".delete_tr_row", function (event) {
            var IdArray = $('.productsdeleteID').val();    
        
            if(IdArray != ''){
			     $('.productsdeleteID').val(IdArray+","+this.id);
            }
            else{
                $('.productsdeleteID').val(this.id);
            }	
        $(this).closest('tr').remove();
         calcul();

         })

  $('body').on("keyup change",".datatable tbody tr", function() {
            calcul();
        });
     $('.totalReceived').on('keyup change',function(){
            var totalReceived = $(this).val();
            $('.amountReceived').val(totalReceived); 
            $('.previousBalance').val(parseInt($('.totalReceivable').html() - totalReceived));
            $('.currentBalance').val(parseInt($('.totalReceivable').html() - totalReceived));  
            
        });
     
     
    
});


function calcul()
    {
        $('.datatable tr').each(function(i, element) {
            
             var $tr = $(this).closest('tr');
             var discount = $tr.find('.discount').val();
             var total_quantity = $tr.find('.total_quantity').val();
             var net_price = $tr.find('.net_price').val();
             var net_amount = $tr.find('.net_amount').val();
             var list_price = $tr.find('.list_price').val();
         
                var net_price = list_price * total_quantity;
                afterDiscount= net_price - (net_price * discount/100 );    
                $tr.find('.net_price').val(net_price.toFixed(2));
                $tr.find('.net_amount').val(afterDiscount.toFixed(2));

                var totalReceived = 0;
            $('.amountReceived').val(totalReceived); 
            $('.totalReceived').val(totalReceived); 
            $('.previousBalance').val(parseInt($('.totalReceivable').html() - totalReceived));
            $('.currentBalance').val(parseInt($('.totalReceivable').html() - totalReceived)); 

                calc_total();
        });
    }

 function calc_total()
    {
        net_price = 0;
        $('.net_price').each(function() {
            net_price += parseFloat($(this).val());
         
        });
        totalDiscount = 0;
        $('.discount').each(function() {
            totalDiscount += parseFloat($(this).val());
        });
//        
         net_amount = 0;
        $('.net_amount').each(function() {
            net_amount += parseFloat($(this).val());
        });
//        
      if(!isNaN(net_price)){
            net_price =  Math.round(net_price);
            $('.gross_amount').html(net_price.toFixed(2));
            $('.grossAmount').val(net_price.toFixed(2));
        }
        
        if(!isNaN(totalDiscount)){
            $('.totalDiscount').html(totalDiscount.toFixed(2));
            $('.totalDiscount').val(totalDiscount.toFixed(2));
        }

        if(!isNaN(net_amount)){
            net_amount =  Math.round(net_amount);
            $('.totalNetAmount').html(net_amount.toFixed(2));
            $('.totalNetAmount').val(net_amount.toFixed(2));
            
            var totalPreviousBal = parseInt($('.totalPreviousBal').html());
            $('.totalReceivable').html(totalPreviousBal + net_amount);
            $('.totalReceivableInput').val(totalPreviousBal + net_amount);    
        }

    }
      
    $('.customer_ledger').on('click',function(){
        var customer_id = $(this).attr('customer-id');
         $.ajax({
            type: 'get',
            url: 'customer_leaders_ajax.php?customer_id='+customer_id,
            success: function (data) {
                $('.modal-body').html(data); 
                $('#myModal').modal('show'); 
                 // $('#example').DataTable();
            },
            error: function(data){
               console.log("error");
           }
          });
     $('#modals-default').modal('show'); 
})


    function generate() {
      
      var doc = new jsPDF('p', 'pt', 'a4');

      var elem = document.getElementById('example');
      var data = doc.autoTableHtmlToJson(elem);
      doc.autoTable(data.columns, data.rows, {
                tableLineColor: [189, 195, 199],
        tableLineWidth: 0.75,
        styles: {
            font: 'Meta',
            lineColor: [44, 62, 80],
            lineWidth: 0.55
        },
        headerStyles: {
            fillColor: [0, 0, 0],
            fontSize: 11
        },
        bodyStyles: {
            fillColor: [216, 216, 216],
            textColor: 50
        },
        alternateRowStyles: {
            fillColor: [250, 250, 250]
        },
        startY: 100,
        drawRow: function (row, data) {
            // Colspan
            doc.setFontStyle('bold');
            doc.setFontSize(10);
            if ($(row.raw[0]).hasClass("innerHeader")) {
               

                doc.rect(data.settings.margin.top, row.y, data.table.width, 20, 'F');
                doc.autoTableText("", data.settings.margin.left + data.table.width / 2, row.y + row.height / 2, {
                    halign: 'center',
                    valign: 'middle'
                });
               /*  data.cursor.y += 20; */
            };

            if (row.index % 5 === 0) {
                var posY = row.y + row.height * 6 + data.settings.margin.bottom;
                if (posY > doc.internal.pageSize.height) {
                    data.addPage();
                }
            }
        },
        drawCell: function (cell, data) {
            // Rowspan
            console.log(cell);
            if ($(cell.raw).hasClass("innerHeader")) {
            doc.setTextColor(200, 0, 0);
                    doc.autoTableText(cell.text + '', data.settings.margin.left + data.table.width / 2, data.row.y + data.row.height / 2, {
                    halign: 'center',
                    valign: 'middle'
                });
                
                return false;
            }
        }
    }); 

      var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

     doc.save(" "+today+"/customer-ledger.pdf");
    } 


    $('body').on("click","#export",function(e){  
         var  customer_ledger_id =  $('.customer_ledger').attr('customer-id');
       

        $.ajax({
            type: 'get',
            url: 'customer_leaders_ajax.php?customer_id='+customer_ledger_id,
            success: function (data) {
                console.log(data);
                $('.print-ledger-data').html(' '+data+' '); 
                 e.preventDefault();  
                   generate();
            },
            error: function(data){
               console.log("error");
           }
          });


    });



    var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        var profileImage = $('#profileImage').text(intials);
         




</script>
    