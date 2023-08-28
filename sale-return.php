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

    if($_POST){


    	$invoiceNumber = $_POST['invoiceNumber'];
		$get_product = $_POST['get_product'];
		$sold_quantity = $_POST['sold_quantity'];
		$return_quantity = $_POST['return_quantity'];

		$balance_quantity = $sold_quantity - $return_quantity;

		$fetch_querys = "SELECT `list_price`,`discount` ,`net_price`,net_amount FROM `sale_invoice_details` WHERE `insert_productName` = '$get_product'";
            $sths = $dbh->prepare($fetch_querys);
            $result = $sths->execute();
            $rowss = $sths->fetch(PDO::FETCH_ASSOC);
            $get_list_price = $rowss['list_price'];
            $get_discount = $rowss['discount'];
            $get_net_price = $rowss['net_price'];
            $get_net_amount = $rowss['net_amount'];

            $updated_net_price = $get_list_price * $balance_quantity;

 
           $updated_discount_products = $get_list_price - ($get_list_price * ($get_discount / 100));
            

            $updated_net_amount = $updated_discount_products * $balance_quantity;

            $minus_total_amount = $get_net_amount - $updated_net_amount; 

            echo $updated_net_amount;

            $fetch_querys_details = "SELECT totalNetAmount FROM `sale_invoice_amount_details` WHERE `sale_invoice_id` = '$invoiceNumber'";
            $sthst = $dbh->prepare($fetch_querys_details);
            $sthst->execute();
            $rowss_data = $sthst->fetch(PDO::FETCH_ASSOC);
            $getTotalNetAmount = $rowss_data['totalNetAmount'];

            $updated_total_net_amount = $getTotalNetAmount - $minus_total_amount;

            $fetch_prod_querys = "SELECT product_quantity_sale FROM `products` WHERE `id` = '$get_product'";
            $sthstt = $dbh->prepare($fetch_prod_querys);
            $sthstt->execute();
            $rowss_data_prod = $sthstt->fetch(PDO::FETCH_ASSOC);
            $product_quantity_sale = $rowss_data_prod['product_quantity_sale'];	
          
            $update_produc_quantity  = $product_quantity_sale + $return_quantity;


            $update_quan_query = "UPDATE `products` SET `product_quantity_sale`= '$update_produc_quantity'  WHERE id = '$get_product' ";
             $sth = $dbh->prepare($update_quan_query);
             $sth->execute();

             $update_gross_query = "UPDATE `sale_invoice_amount_details` SET `totalNetAmount`= '$updated_total_net_amount'  WHERE sale_invoice_id = '$invoiceNumber' ";
             $stht = $dbh->prepare($update_gross_query);
             $stht->execute();

            $update_list_query = "UPDATE `sale_invoice_details` SET `net_price`= '$updated_net_price' ,`net_amount` = '$updated_net_amount' ,`total_quantity` = '$balance_quantity'  WHERE insert_productName = '$get_product' ";
             $sthtt = $dbh->prepare($update_list_query);
             $sthtt->execute();  
            
            header("Location:sale-return.php");


    }



?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
       <title>Sale Return | Ahmed Traders</title>
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
.responsive_align{
  text-align: center;
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
                        <h4 class="font-weight-bold py-3 mb-0">Sales Return</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Sales Return</li>
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
                           
                           <div class="card-header bg-primary text-white " style="font-size: 25px; text-align: center;"> <i class="fas fa-money-bill-alt" style="font-size:25px; "></i> &nbsp; Ahmed Traders | Sale Return 
                                    </div>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                 <h3 style="width: 100%; text-align: center; border-bottom: 2px solid #716aca; line-height: 0.1em; margin: 10px 0 20px; "><span style="background:#fff; padding:0 10px; color:#716aca; ">Sale Return</span></h3>

                          <form method="post" id="purchaseInvoice">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                  <label class="form-label">Invoice Number</label>
                                   <select class="select2-demo form-control invoiceNumber" style="width: 100%" data-allow-clear="true" name="invoiceNumber">
                                        <option value="0">Select Invoice Number</option>
                                        <?php
                                            $fetch_category = "SELECT id,invoiceNumber FROM `sale_invoice`";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $id = $rowss['id'];
                                                 $invoiceNumber = $rowss['invoiceNumber'];
                                                echo '<option value="'.$id.'">'.$invoiceNumber.'</option>';    
                                            }   
                                        ?>
                                    </select>    
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="form-label">Select Product</label>
                                   <select class="select2-demo form-control get_product" style="width: 100%" data-allow-clear="true" name="get_product">
                                        <option value="0">Select Product</option>
                                    </select>    
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="form-label">Sold Quantity</label>
                                   <input type="text" class="form-control sold_quantity" readonly="" required name="sold_quantity"  placeholder="Sold Quantity">
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="form-label">Return Quantity</label>
                                   <input type="text" class="form-control return_quantity" required name="return_quantity"  placeholder="Return Quantity">
                                </div>
                                <div class="form-group col-md-3" style="float: right;">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn btn-block add_product" role="button">Return</button>
                                    </div>

                            </div>

                                <br> 
                                

                                <div class="return_dynamic">
                                 <!--  <b style="text-align: center;color: red">No Record Found!</b>   -->
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
// $("#purchaseInvoice").submit(function(e) {
//   e.preventDefault();
//      var saleman_name =  $('.saleman_name').val();
//      var customerType =  $('.customerType').val();
//     var form_data = new FormData(this);

//   if(saleman_name != 0 && customerType != 0){ 
//  swal({
//               title: "Are you sure you want to confirm this sale invoice?",
//               text: "Once updated, your invoice successfully saved!",
//               icon: "warning",
//               buttons: true,
//               dangerMode: true,
//             })
    
//     .then((willDelete) => {
//               if (willDelete) {
                 
//                     $.ajax({
//                         type: 'post',
//                         url: 'saleInvoiceAjax.php',
//                         data:form_data,
//                          cache:false,
//                         contentType: false,
//                         processData: false,  
//                         success: function (data,status) {
//                             console.log(data);
//                             var get_varabile = data.split(",");
//                             var get_invoice_id = get_varabile[0];
//                             var get_customer_id = get_varabile[1];
//                             var trimStr = $.trim(get_invoice_id);
//                             console.log(trimStr);
//                             window.open(
//                               'print-invoice-fpdf.php?get_invoice_id='+trimStr +'&get_customer_id='+get_customer_id+"&company_id="+<?php echo @$company_id ?>,
//                               '_blank' // <- This is what makes it open in a new window.
//                             );
//                             window.setTimeout(function() {
//                               window.location.href = 'sale_invoice.php?company_id=<?php echo @$company_id ?>';
//                           }, 2000);  


//                         }
//                     });
//             swal("Poof! Sale invoice has been submit!", {
//                   icon: "success",

//                 });
//               } else {
//                return false;
//               }
//             });
//     }else{
//         alert("Please select customer or saleman");
//     }
       
       
// });

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


var  invoiceNumber;    
$(".invoiceNumber").on("change", function (event) {
      invoiceNumber  =  $(this).val();
       $('.return_dynamic').html("");
         $.ajax({
            type: 'get',
            url: 'sale-return-ajax.php?invoiceNumber='+invoiceNumber,
             dataType: 'JSON',
            success: function (data) {
               $.each(data.products_data, function (key, value) {
                $('.get_product').append($('<option></option>').val(value.product_id).html(value.product_name));
            });

               
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })    

var  invoiceNumber;    
$(".get_product").on("change", function (event) {
      get_product  =  $(this).val();
         $.ajax({
            type: 'get',
            url: 'sale-return-ajax.php?get_product='+get_product,
             dataType: 'JSON',
            success: function (data) {
            	$('.sold_quantity').val(data.total_quantity);
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })  

    	var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        var profileImage = $('#profileImage').text(intials);
         




</script>
    