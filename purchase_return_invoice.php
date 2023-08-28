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
        $sale_invoice_amount_details_id = @$_POST['sale_invoice_amount_details_id'];
        $totalNetAmount = @$_POST['totalNetAmount'];
        
        
        $previous_balance =  $totalNetAmount - $amount_received;
        
        
        if($form_submit == 1){
            
            
        $insert_query_bank = "INSERT INTO `check _records`(`account_title`, `account_number`, `bank`, `status`, `sale_invoice_id`, `customer_id`, `check_date`, `current_date`,`sale_invoice_amount_id`) VALUES ('$account_title','$account_number','$bank','1','$invoice_id','$customerID','$check_date','$date','$sale_invoice_amount_details_id')";
            $stmttte = $dbh->prepare($insert_query_bank);
            $stmttte->execute();   
            
        $update_query = "UPDATE `sale_invoice_amount_details` SET `payment_status`= '1',`time_stamp`= now() WHERE `id` ='$sale_invoice_amount_details_id'";
        $st = $dbh->prepare($update_query);
        $st->execute();
            
        }else{
        
            $insert_query_cash = "UPDATE `sale_invoice_amount_details` SET `amountReceived`= '$amount_received',`previousBalance` ='$previous_balance',`payment_status`='2',`time_stamp`= now() WHERE `id`  = '$sale_invoice_amount_details_id'";
            $stmt = $dbh->prepare($insert_query_cash);
            $stmt->execute();   
        }
        
        
        header("Location:due-payment.php");
        
        
    }


?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Sale Return | Ppipopular</title>

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
                     <form method="post" id="purchase-return-invoice">
                   <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Purchase Return</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Purchase Return</li>
                            </ol>
                        </div>
                       
                          <div class="card mb-4">
                            <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp; Purchase Return</h3>
                                 <div class="card-body"  style="border-style: solid; border-color: #716aca;">
                                    
                                  <div class="form-row">

                                <div class="form-group col-md-3">
                                     <label class="form-label">Invoice #</label>
                                <select class="select2-demo form-control invoiceType" style="width: 100%" data-allow-clear="true" name="invoice_id">
                                        <option value="0">Select Invoice #</option>
                                        <?php
                                            $fetch_category = "SELECT `id`, `purchase_invoice_#` FROM `purchase_invoice`";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $purchase_invoice_id = $rowss['id'];
                                                 $purchase_invoice = $rowss['purchase_invoice_#'];
                                                echo '<option value="'.$purchase_invoice_id.'">'.$purchase_invoice.'</option>';    
                                            }	
                                        ?>
                                </select>    
                                     <div class="clearfix"></div>
                                 </div>                                    

                                   <div class="form-group col-md-3">
                                     <label class="form-label">Select Product Type</label>
                                <select class="select2-demo form-control productType" style="width: 100%" data-allow-clear="true" name="category_id">
                                        <option value="0">Select Product Type</option>
                                        
                                </select>    
                                     <div class="clearfix"></div>
                                 </div>         
                                      
                              <div class="form-group col-md-3">
                                     <label class="form-label">Select Product </label>
                                <select class="select2-demo form-control productName" style="width: 100%" data-allow-clear="true" name="product_id_value">
                                        <option value="0">Select Product </option>
                                        
                                </select>    
                                     <div class="clearfix"></div>
                                 </div>        
                                 
                                      
                                <div class="form-group col-md-3">
                                     <label class="form-label">Foreign Currency</label>
                                <input type="number" class="form-control foreignCurrency" readonly required="" name="foreignCurrency" placeholder="Dollar/RMB">
                                     <div class="clearfix"></div>
                                 </div>         
                                      
                                    
                                </div>
                                  
                                </div>
                            </div>         

                       
                       <!-- / Filters -->
                        
                        <div class="card">
                             <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Due Payment List</h3>
                            <div class="card-body"  style="border-style: solid; border-color: #716aca;">
                               
                                   <div class="table-responsive">
                                   
                                         <table class="table product-discounts-edit datatable" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Type</th>
                                                        <th width="15%">Product Name</th>
                                                         <th>Price Of FC</th>
                                                        <th>Quantity</th>
                                                        <th>Return Quantity</th>
                                                        <th>Price In PKR</th>
                                                        <th>Freight Cost</th>
                                                        <th>Net Cost</th>
                                                        <th>Net Amount</th>
                                                    </tr>
                                                </thead>
                                                
                                                    <tr>
                                                       <td><input type="text" class="form-control productTypeVal" name="productType" placeholder="Product Type" required readonly></td> 

                                                        <td><input type="text" class="form-control productNameVal" name="productNameVal" placeholder="Product Name" required readonly></td> 
                                                            
                                                        <td><input type="text" class="form-control fc_price" required name="fcPrice" placeholder="FC Price"></td>
                                                        <td><input type="text" class="form-control quantity" required name="quantity" placeholder="Quantity"></td>
                                                         <td><input type="text" class="form-control return_quantity" required name="return_quantity" placeholder="Return Quantity"></td>
                                                        <td><input type="text" class="form-control total_pkr" required name="priceInPkt" placeholder="Total PKR" readonly=""></td>
                                                        <td><input type="text" class="form-control per_peace" required name="perPeace" placeholder="Per PCS"></td>
                                                        <td><input type="number"s class="form-control net_cost" required name="netCost" placeholder="Net Cost" readonly=""></td>
                                                        <td><input type="number" class="form-control net_amount" required name="netAmount" placeholder="Net Amount" readonly=""></td>
                                                        <td> <input type="hidden" name="previousQuantity" class="previousQuantity"></td>
                                                        
                                                    </tr>
                                            
                                            </table>
                                    
                                       <span style="font-size: 16px;color: red;font-weight: bold;" class="payment_status"></span><br>
                                    
                                     <table class="table product-discounts-edit table_details" style="width:38%;float:right">
                                              <tr>
                                                <td colspan="8" class="text-right py-3">
                                                    Total Amount In  <b>FC:</b>
                                                    <br> Total <b> Freight:</b>
                                                    <br> Total <b> PKR:</b> 
<!--                                                    <br> Previous Balance:-->
                                                    <span class="d-block text-big mt-2">  <strong>Total Net Amount:</strong>   </span>
                                                </td>
                                                  
                                                <td class="py-3">
                                                    <strong class="totalAmountInFc"></strong>
                                                    <br>
                                                    <strong class="total_freight"></strong>
                                                    <br>
                                                    <strong class="total_pkr_amount"></strong>
                                                    <br>
                                                    <strong class="d-block text-big mt-2 totalNetAmount" style="font-size:30px;"></strong>
                                                    
                                                    <input type="hidden" name="totalAmountInFc" class="totalAmountInFc">
                                                    <input type="hidden" name="totalFreight" class="total_freight">
                                                    <input type="hidden" name="totalPkrAmount" class="total_pkr_amount">
                                                    <input type="hidden" name="totalAmount" class="totalNetAmount">
                                                </td>
                                            </tr>
                                        </table> 
                                           
                                         <div class="form-group" align="right">
                                            <div class="col-sm-offset-8 col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" role="button">Save</button>
                                            </div>
                                        </div>
                                       
                                </div>
                               
                            </div>
                        </div>
                   
                    </div>
                        </form>    
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
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
    
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>
   
   

    
    
    
  $('body').on("keyup change",".datatable tbody tr", function() {
            calcul();
            
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
                var return_quantity = $tr.find('.return_quantity').val();


                    var net_price = list_price * return_quantity;
                    afterDiscount= net_price - (net_price * discount/100 );    
                    $tr.find('.net_return_price').val(net_price.toFixed(2));
                    $tr.find('.net_return_amount').val(afterDiscount.toFixed(2));

            });
        }    

    
    
var  invoiceType;    
$(".invoiceType").on("change", function (event) {
      invoiceType  =  $(this).val();
     $('.productType').empty();
    $('.productType').append($('<option></option>').val("0").html("Choose Product Type"));
         $.ajax({
            type: 'get',
            url: 'purchase-return-ajax.php?invoiceType='+invoiceType,
                  dataType: 'JSON',
            success: function (data) {
             $.each(data.purchase, function (key, value) {
                    console.log(value.foreighn_currency);
                    var categoryID = value.categoryID;
                    var foreighn_currency = value.foreighn_currency;
                    var categoryName = value.categoryName;
                    var totalAmountInFc = value.totalAmountInFc;
                    var totalFreight = value.totalFreight;
                    var totalPkr = value.totalPkr;
                    var totalAmount = value.totalAmount;

                 
                 $('.totalAmountInFc').html(totalAmountInFc)
                 $('.total_freight').html(totalFreight)
                 $('.total_pkr_amount').html(totalPkr)
                 $('.totalNetAmount').html(totalAmount)
                 $('.totalAmountInFc').val(totalAmountInFc)
                 $('.total_freight').val(totalFreight)
                 $('.total_pkr_amount').val(totalPkr)
                 $('.totalNetAmount').val(totalAmount)
                
                  $('.foreignCurrency').val(value.foreighn_currency);
                    $('.productType').append($('<option></option>').val(value.categoryID).html(value.categoryName));               
                
            });
//                
                
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })  
 
   $(".productType").on("change", function (event) {
        var productType  =  $(this).val();
       if(invoiceType != undefined){
        $.ajax({
            type: 'get',
            url: 'purchase-return-ajax.php?productTypeID='+productType +"&invoiceTypeID="+invoiceType,
                  dataType: 'JSON',
            success: function (data) {
             //   console.log(data);
                $.each(data.products_data, function (key, value) {
                    $('.getProductID').val(value.product_id);
                    $('.productName').append($('<option></option>').val(value.product_id).html(value.product_name));               
                
            });
            },
            error: function(data){
               console.log("error");
           }
          });
       }else{
           alert("Please select Invoice");
       }
       
       
       
   }) 

 
    
   $(".productName").on("change", function (event) {
        var productType  =  $(this).val();
      
       if(invoiceType != undefined){
        $.ajax({
            type: 'get',
            url: 'purchase-return-ajax.php?productNameIDs='+productType +"&invoiceTypeIDs="+invoiceType,
                  dataType: 'JSON',
            success: function (data) {
                console.log(data);
                $.each(data.purchase_data, function (key, value) {
                    console.log(value.category_name);
                    $('.productTypeVal').val(value.category_name);
                    $('.productNameVal').val(value.product_name);
                    $('.fc_price').val(value.priceOfFc);
                    
                    $('.quantity').val(value.quantity);
                    $('.total_pkr').val(value.priceInPkr);
                    $('.per_peace').val(value.freightCost);
                    $('.net_cost').val(value.netCost);
                    $('.net_amount').val(value.netAmount);    
                    
                
            });
            },
            error: function(data){
               console.log("error");
           }
          });
       }else{
           alert("Please select Invoice");
       }
       
       
       
   }) 

       
$("#purchase-return-invoice").submit(function(e) {
    alert(invoiceType);
	e.preventDefault();
    var form_data = new FormData(this);
	
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
                        url: 'purchaseReturnInvoiceAjax.php?invoice_number='+invoiceType,
                        data:form_data,
                         cache:false,
                        contentType: false,
                        processData: false,	 
                        success: function (data,status) {
                            console.log(data);
                        }
                    });
            swal("Poof! Sale invoice has been submit!", {
                  icon: "success",

                });
              } else {
               return false;
              }
            });
    
            
       
}); 
    

        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
