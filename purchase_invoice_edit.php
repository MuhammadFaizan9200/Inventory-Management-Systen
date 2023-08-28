<?php
    ob_start();
	session_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $getInvoiceDetails = array();

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
       <title>New Shipment | ppipopular</title>
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
                        <h4 class="font-weight-bold py-3 mb-0">Purchase Invoice</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Purchase Invoice</li>
                            </ol>
                        </div>



                        <div class="card mb-4">
                            <h3 class="card-header" align="Center"><i class="fas fa-box-open" style="font-size:35px; "></i> &nbsp; Purchase Invoice</h3>
                            <div class="card-body">
                                <form method="post" id="purchaseInvoice">
                                    <div class="form-row">









                                    <div class="form-group col-md-4">
                                      <label class="form-label">Vendor Name</label>
                                     <input type="text" class="form-control" name="vendorName" value="<?php echo $vendorName  ?>" placeholder="Complete Name">
                                     <div class="clearfix"></div><br>
                                         
                                        <label class="form-label">Vendor Address</label>
                                         <input type="text" class="form-control" name="vendorAddress" value="<?php echo $vendorAddress  ?>" placeholder="Complete Address">
                                          <div class="clearfix"></div><br>
                                       
                                       <label class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" name="contactPerson" value="<?php echo  $contactPerson ?>" placeholder="Person Name">
                                         <div class="clearfix"></div><br>
                                        
                                        <label class="form-label">Contact Number#</label>
                                         <input type="text" class="form-control" name="contactNumber" value="<?php echo $contactNumber  ?>" placeholder="Person Mobile/Phone No.#">
                                         <div class="clearfix"></div>

                                        </div>
                                        <div class="form-group col-md-4"></div>
                                        <div class="form-group col-md-4">
                                            
                                         <label class="form-label">Purchase Invoice#</label>
                                            <input type="text" class="form-control" value="<?php echo @$invoiceNumber ?>" placeholder="NS/PPI/00000000001" name="invoiceNumber" readonly>
                                            <div class="clearfix"></div><br>
                                            
                                            <label class="form-label">Date</label>
                                            <input type="text" class="form-control" id="" value="<?php echo $date ?>" readonly name="date" required placeholder="Select Date"><br>

                                             <label class="form-label">Total Items</label>
                                            <input type="text" class="form-control" placeholder="25" value="<?php echo $totalItem  ?>" name="totalItem">
                                            <div class="clearfix"></div><br>
                                                
                                            
                                            <label class="form-label">Total Quantity</label>
                                            <input type="text" class="form-control" placeholder="30" value="<?php echo $totalQuantity ?>" name="totalQuantity">
                                            <div class="clearfix"></div><br>

                                           <label class="form-label">Foreign Currency</label>
                                            <input type="number" class="form-control foreignCurrency" value="<?php echo $foreignCurrency ?>" required name="foreignCurrency" placeholder="Dollar/RMB">
                                            <input type="hidden" name="productID" value="<?php echo $product_id ?>"   class="">
                                            <div class="clearfix"></div><br>
                                            
                                        
                                        </div>
                                            
                                       
                                    </div>
  
                                        <div class="table-responsive">
                                            <table class="table product-discounts-edit datatable" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Type</th>
                                                        <th width="15%">Product Name</th>
                                                         <th>Price Of FC</th>
                                                        <th>Quantity</th>
                                                        <th>Price In PKR</th>
                                                        <th>Freight Cost</th>
                                                        <th>Net Cost</th>
                                                        <th>Net Amount</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                
                                                  <?php
                                                        $invoice_details_query = " SELECT pd.*,p.product_quantity  FROM `purchase_invoice_details` pd , products p  where p.id = pd.productID AND  pd.purchase_invoice_id = '$purchaseInvoiceID'";
                                                        $stht = $dbh->prepare($invoice_details_query);
                                                        $result = $stht->execute();
                                                         while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                          $productID = $rowss['id'];  
                                                            $categoryNameKey = $rowss['categoryID'];
                                                            $productNameKey = $rowss['productID'];
                                                            $fcPriceKey = $rowss['priceOfFc'];
                                                            $quantityKey = $rowss['quantity'];
                                                            $priceInPktKey = $rowss['priceInPkr'];
                                                            $perPeaceKey = $rowss['freightCost']; 
                                                            $netCostKey = $rowss['netCost'];
                                                            $netAmountKey = $rowss['netAmount'];
                                                            $product_quantity = $rowss['product_quantity'];
                                                            
                                                            
                                                     echo ' <tr class="tRow">
                                                        <td>
                                                            <select class="custom-select categoryFunction select_category_'.$productID.'" name="update_categoryName[]" required>
                                                                <option value="0">Choose Type</option>';
                                                                $fetch_query = "SELECT * FROM `category` ";
                                                                $sth = $dbh->prepare($fetch_query);
                                                                $result = $sth->execute();
                                                                while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                                                      $id = $rows['id'];
                                                                     $category_name = $rows['category_name'];
                                                                    echo '<option value="'.$id.'">'.$category_name.'</option>';    
                                                                }	
                                                            echo '</select>    
                                                        </td> <td>
                                                            <select class="custom-select set_products set_product_id_'.$productID.'" name="update_productName[]" required>
                                                                <option selected>Choose Product</option>';
                                                                $fetch_query = "SELECT id,product_name FROM `products` where category_id = '$categoryNameKey'";
                                                                $sth = $dbh->prepare($fetch_query);
                                                                $result = $sth->execute();
                                                                while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                                                      $id = $rows['id'];
                                                                     $product_name = $rows['product_name'];
                                                                    echo '<option value="'.$id.'">'.$product_name.'</option>';
                                                                    
                                                                }	
                                                            echo '</select> 
                                                        </td><td><input type="text" class="form-control fc_price" value="'.$fcPriceKey.'" required name="update_updatefcPrice[]" placeholder="FC Price"></td>
                                                        <td><input type="text" class="form-control quantity" value="'.$quantityKey.'" required name="update_quantity[]" placeholder="Quantity"></td>
                                                        <td><input type="text" class="form-control total_pkr" value="'.$priceInPktKey.'" required name="update_priceInPkt[]" placeholder="Total PKR" readonly=""></td>
                                                        <td><input type="text" class="form-control per_peace" value="'.$perPeaceKey.'" required name="update_perPeace[]" placeholder="Per PCS"></td>
                                                        <td><input type="number"s class="form-control net_cost" value="'.$netCostKey.'" required name="update_netCost[]" placeholder="Net Cost" readonly=""></td>
                                                        <td><input type="number" class="form-control net_amount net_amount" value="'.$netAmountKey.'" required name="update_netAmount[]" placeholder="Net Amount" readonly=""><input type="hidden" name="productIDPrimaryKey[]" value="'.$productID.'"  class=""><input type="hidden" name="updatePreviousQuantity[]" value="'.$product_quantity.'"  class=""><input type="hidden" name="updatePreviousQuantityHidden[]" value="'.$quantityKey.'"  class=""></td>
                                                        <td><button type="button" id="'.$productID.'" class="btn icon-btn btn btn-outline-danger delete_tr_row"><span class="fas fa-trash-alt"></span></button></td></tr>';

                                                echo '<script>
                                                  $(".tRow").find(".select_category_'.$productID.'").val('.$categoryNameKey.');
                                                   $(".tRow").find(".set_product_id_'.$productID.'").val('.$productNameKey.');
                                                    </script>';    
                                                            
                                                }   
                                                        
                                                        ?>
                                                      <span></span>  
                                                
                                            </table>
                                            <button type="button" class="btn icon-btn btn btn-outline-success add_product"><span class="fas fa-plus"></span></button>
                                         <table class="table product-discounts-edit table_details" style="width:25%;float:right">
                                             <?php
                                                $fetch_query_invoice = "SELECT * FROM `purchase_invoice_amount_details`  where id = '$purchaseInvoiceID'";
                                                $sthh = $dbh->prepare($fetch_query_invoice);
                                                $result = $sthh->execute();
                                                $rowsd = $sthh->fetch(PDO::FETCH_ASSOC);
                                                 $totalAmountInFc = $rowsd['totalAmountInFc'];
                                                $totalFreight = $rowsd['totalFreight'];
                                                $totalPkrAmount = $rowsd['totalPkr'];
                                                $totalAmount = $rowsd['totalAmount'];
                                                 $invoiceDetailsID = $rowsd['id'];
                                                echo ' <tr>
                                                <td colspan="8" class="text-right py-3">
                                                    Total Amount In  <b>FC:</b>
                                                    <br> Total <b> Freight:</b>
                                                    <br> Total <b> PKR:</b> 
<!--                                                    <br> Previous Balance:-->
                                                    <span class="d-block text-big mt-2">  <strong>Total Net Amount:</strong>   </span>
                                                </td>
                                                <td class="py-3">
                                                    <strong class="totalAmountInFc">'.$totalAmountInFc.'</strong>
                                                    <br>
                                                    <strong class="total_freight">'.$totalFreight.'</strong>
                                                    <br>
                                                    <strong class="total_pkr_amount">'.$totalPkrAmount.'</strong>
                                                    <br>
                                                    <strong class="d-block text-big mt-2 totalNetAmount" style="font-size:30px;">'.$totalAmount.'</strong>
                                                    
                                                    <input type="hidden" name="totalAmountInFc" value="'.$totalAmountInFc.'" class="totalAmountInFc">
                                                    <input type="hidden" name="totalFreight" value="'.$totalFreight.'"  class="total_freight">
                                                    <input type="hidden" name="totalPkrAmount" value="'.$totalPkrAmount.'"  class="total_pkr_amount">
                                                    <input type="hidden" name="totalAmount" value="'.$totalAmount.'"  class="totalNetAmount">
                                                    <input type="hidden" name="invoiceDetailsID" value="'.$invoiceDetailsID.'"  class="">
                                                </td>
                                            </tr>';   
                                             
                                             ?>
                                             
                                            </table> 
                                            
                                            
                                            
                                        </div>

                                        <input type="hidden" name="productsdeleteID"   class="productsdeleteID">
                                        <div class="form-group" align="right">
                                            <div class="col-sm-offset-8 col-sm-3">
                                                <button class="btn btn-primary btn-lg btn-block"  type="submit">Submit</button>
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
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:22 GMT -->
</html>

<script>
        
$('.add_product').on('click',function(){
          
            $('#datatable').append('<tbody><tr class="tRow"><td><select class="custom-select select_category categoryFunction" id="select_category"  name="insert_categoryName[]" required><option selected>Choose Type</option>\
                    <?php
                        $fetch_query = "SELECT * FROM `category` ";
                        $sth = $dbh->prepare($fetch_query);
                        $result = $sth->execute();
                        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                              $id = $rows['id'];
                             $category_name = $rows['category_name'];
                            echo '<option value="'.$id.'">'.$category_name.'</option>';    
                        }	
                    ?>
            </select></td><td><select class="custom-select set_products" required name="insert_productName[]"><option selected>Choose Product</option></select></td><td><input type="text" class="form-control fc_price" name="insert_fcPrice[]" required placeholder="FC Price"></td><td><input type="text" class="form-control quantity" required placeholder="Quantity" name="insert_quantity[]"></td><td><input  required type="number" class="form-control total_pkr" placeholder="Total PKR" name="insert_priceInPkt[]" required readonly=""></td><td><input type="text" required class="form-control per_peace" name="insert_perPeace[]" placeholder="Per PCS"></td><td><input type="number" required class="form-control net_cost" name="insert_netCost[]" placeholder="Net Cost" readonly=""></td><td><input type="number" required class="form-control net_amount" name="insert_netAmount[]" placeholder="Net Amount" readonly=""></td><td><input type="hidden" name="insert_previousQuantity[]" class="previousQuantity"></td><td><button type="button" class="btn icon-btn btn btn-outline-danger delete_tr_row"><span class="fas fa-trash-alt"></span></button></td></tr><tbody>'); 
            $('#datatable tr:last').find(".select_category").focus();
    })  

    
$("#purchaseInvoice").submit(function(e) {
	e.preventDefault();
    var form_data = new FormData(this);
	
 swal({
              title: "Are you sure you want to confirm this purchase invoice?",
              text: "Once updated, your invoice successfully saved!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
    
    .then((willDelete) => {
              if (willDelete) {
                 
                    $.ajax({
                        type: 'post',
                        url: 'editpurchaseInvoiceAjax.php',
                        data:form_data,
                         cache:false,
                        contentType: false,
                        processData: false,	 
                        success: function (data,status) {
                           // console.log(data);
                            window.location.href = "list_purchase_invoice.php";
                        }
                    });
            swal("Poof! Purchase invoice has been updated!", {
                  icon: "success",

                });
              } else {
               return false;
              }
            });
    
            
       
});



    
$("table").on("change", ".categoryFunction", function (event) {
    var  select_category =  $(this).closest('tr').find('.categoryFunction').val();
    var $tr = $(this).closest('tr');
     $tr.find('.set_products').empty();
    $tr.find('.set_products').append($('<option></option>').val("0").html("Choose Product"));
   
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?select_category='+select_category,
                  dataType: 'JSON',
            success: function (data) {
            $.each(data.products, function (key, value) {
                $tr.find('.set_products').append($('<option></option>').val(value.id).html(value.product_name));
                console.log(value.product_quantity);
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
   
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?set_products_value='+set_products_value,
                  dataType: 'JSON',
            success: function (data) {
                console.log(data.product_quantity);
                 $tr.find('.previousQuantity').val(data.product_quantity);
          },
            error: function(data){
               console.log("error");
           }
          });
    
    
    
 })        
  
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
         calc();

         })

    $('body').on("keyup change",".datatable tbody tr", function() {
       // console.log("this");
            calc();
        });
        $('#tax').on('keyup change',function(){
            calc_total();
        });
});


function calc()
    {
        $('.datatable tr').each(function(i, element) {
            var html = $(this).html();
            if(html!='')
            {
                var quantity = $(this).find('.quantity').val();
                var foreignCurrency = $('.foreignCurrency').val();
                var fc_price = $(this).find('.fc_price').val();
                var per_peace = $(this).find('.per_peace').val();
                
                var total_pkr = foreignCurrency*fc_price;
                var net_cost = parseFloat(per_peace) + parseFloat(total_pkr);
                var net_amount = quantity * net_cost;
                
                $(this).find('.total_pkr').val(total_pkr.toFixed(2));
                 $(this).find('.net_cost').val(net_cost.toFixed(2));
                 $(this).find('.net_amount').val(net_amount.toFixed(2));
                calc_total();
            }
        });
    }

    function calc_total()
    {
        total_fc_price = 0;
        $('.fc_price').each(function() {
            total_fc_price += parseInt($(this).val());
        });
        total_per_peace = 0;
        $('.per_peace').each(function() {
            total_per_peace += parseInt($(this).val());
        });
        
         total_total_pkr = 0;
        $('.total_pkr').each(function() {
            total_total_pkr += parseInt($(this).val());
        });
        
        totalNetAmount = 0;
        $('.net_amount').each(function() {
            totalNetAmount += parseInt($(this).val());
        });
        
        if(!isNaN(total_fc_price)){
            $('.totalAmountInFc').html(total_fc_price.toFixed(2));
            $('.totalAmountInFc').val(total_fc_price.toFixed(2));
        }
        
        if(!isNaN(total_per_peace)){
            $('.total_freight').html(total_per_peace.toFixed(2));
             $('.total_freight').val(total_per_peace.toFixed(2));
        }

         $('.total_pkr_amount').html(total_total_pkr.toFixed(2));
         $('.total_pkr_amount').val(total_total_pkr.toFixed(2));
        
        if(!isNaN(totalNetAmount)){
            $('.totalNetAmount').html(totalNetAmount.toFixed(2));
            $('.totalNetAmount').val(totalNetAmount.toFixed(2));
        }

    }
      
    
 
    var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         




</script>
    