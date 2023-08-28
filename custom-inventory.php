<?php
    ob_start();
	session_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $getInvoiceDetails = array();
    $date = date('Y-m-d');
    $currentTime = date("h:i:s");
    $sale_invoice_random = "MP/" . "PP1" ."/". mt_rand(100000, 999999);
    $session_user_name =  $username ;

  if($_POST){

    // IN VARIABLES 
        $inProductType = $_POST['inProductType'];
        $inProductName = $_POST['inProductName'];
        $inGodown = $_POST['inGodown'];
        $inQuantity = $_POST['inQuantity'];

    // OUT VARIABLES
        $outProductType = $_POST['outProductType'];
        $outProductName = $_POST['outProductName'];
        $outGodown = $_POST['outGodown'];
        $outQuantity = $_POST['outQuantity'];
        $comment = $_POST['comment'];

     

    foreach($inProductName as $key => $value){
        
        $inProductTypeValue = $inProductType[$key];
        $inProductNameValue = $inProductName[$key];
        $inGodownValue = $inGodown[$key];
        $inQuantityValue = $inQuantity[$key];
        $user_id = "1";

        $outProductTypeValue  = $outProductType[$key];
        $outProductNameValue  = $outProductName[$key];
         $outGodownValue  = $outGodown[$key];
         $outQuantityValue  = $outQuantity[$key];
         $commentValue  = $comment[$key];
         
         $fetach_query = "SELECT * , SUM(`godown_sith_quantity`) as  godown_sith_quantitysum FROM godown_1th_floor  WHERE `productID` ='$inProductNameValue'   order by `id` asc";
        $fetach_stht = $dbh->prepare($fetach_query);
        $fetach_stht->execute();
        $count = $fetach_stht->rowCount();   
        if($count >= 1)
            {
                $sum_value = 0;    
                $complete_quantity = 0;
                while($row = $fetach_stht->fetch(PDO::FETCH_ASSOC))
                    {
                        $id = $row['id'];
                        $categoryID = $row['categoryID'];
                        $productID =  $row['productID'];
                        $invoice_id = $row['invoice_id'];
                        $purchase_invoice_details_id = $row['purchase_invoice_details_id'];

                        $godown_sith_quantity = $row['godown_sith_quantitysum'];    
                        $godown_sith_quantity_minus = $godown_sith_quantity;
                        
                    
                        $sum_value += $godown_sith_quantity_minus;
                     
            if($outQuantityValue != 0)
                {
                  

                   if($godown_sith_quantity_minus <= $outQuantityValue){
                          // $outQuantityValue = $outQuantityValue - $godown_sith_quantity_minus;
                          // $quantityMinus = $godown_sith_quantity_minus;
                       

                       $back_qunttity =  $godown_sith_quantity_minus - $outQuantityValue;
                        $quantityMinus = $outQuantityValue;
                        $outQuantityValue = 0;



                    $fetach_query_quantity = "SELECT `product_quantity_sale` FROM `products` WHERE `id` ='$outProductNameValue'";
                    $fetach_sthtt = $dbh->prepare($fetach_query_quantity);
                    $fetach_sthtt->execute();
                    $rowss = $fetach_sthtt->fetch(PDO::FETCH_ASSOC);
                      $product_quantity_sale = $rowss['product_quantity_sale'];

                             
                        $updateProductQuantity = $outQuantityValue + $quantityMinus;
                        $updateProductQuantityValue = $product_quantity_sale + $updateProductQuantity;


                        
                        $update_product = "UPDATE `products` SET `product_quantity_sale` ='$updateProductQuantityValue' , `updated_time`=now()  WHERE `id` ='$outProductNameValue'";
                        $stmtt_p = $dbh->prepare($update_product);
                       $resultRegisterts = $stmtt_p->execute();
                      // var_dump($update_product);


                        $update_product = "UPDATE `products` SET `product_quantity_sale` ='$back_qunttity' , `updated_time`=now()  WHERE `id` ='$inProductNameValue'";
                        $stmtt_p = $dbh->prepare($update_product);
                       $resultRegisterts = $stmtt_p->execute();
                     //  var_dump($update_product);
                        
                        $update_quantity = "UPDATE `godown_1th_floor` SET `godown_sith_quantity` ='$back_qunttity' , `time_stamp`=now()  WHERE `id` ='$id'";
                        $stmtt = $dbh->prepare($update_quantity);
                        $resultRegistert = $stmtt->execute();
                        

                        $history_query = " INSERT INTO `inventory_history`(`invoice_id`, `description`, `rate`, `plus_full`, `minus_full`, `status`, `product_id`, `date`, `customer_id`, `time_stamp`) VALUES ('$invoice_id','RESERVED {PURCHASE}','0','$updateProductQuantity','0','0','$outProductNameValue','$date','0',now())  ";
                        $stmttt = $dbh->prepare($history_query);
                        $resultRegistert = $stmttt->execute();    


                       $delete_query = "Delete  FROM `godown_1th_floor` WHERE `id` ='$id'";
                        $delete_stmt = $dbh->prepare($delete_query);
                        $delete_stmt->execute();
                    }
                    else{ 
                        $back_qunttity =  $godown_sith_quantity_minus - $outQuantityValue;
                        $quantityMinus = $outQuantityValue;
                        $outQuantityValue = 0;



                    $fetach_query_quantity = "SELECT `product_quantity_sale` FROM `products` WHERE `id` ='$outProductNameValue'";
                    $fetach_sthtt = $dbh->prepare($fetach_query_quantity);
                    $fetach_sthtt->execute();
                    $rowss = $fetach_sthtt->fetch(PDO::FETCH_ASSOC);
                      $product_quantity_sale = $rowss['product_quantity_sale'];

                             
                        $updateProductQuantity = $outQuantityValue + $quantityMinus;
                        $updateProductQuantityValue = $product_quantity_sale + $updateProductQuantity;


                        
                        $update_product = "UPDATE `products` SET `product_quantity_sale` ='$updateProductQuantityValue' , `updated_time`=now()  WHERE `id` ='$outProductNameValue'";
                        $stmtt_p = $dbh->prepare($update_product);
                       $resultRegisterts = $stmtt_p->execute();
                      // var_dump($update_product);


                        $update_product = "UPDATE `products` SET `product_quantity_sale` ='$back_qunttity' , `updated_time`=now()  WHERE `id` ='$inProductNameValue'";
                        $stmtt_p = $dbh->prepare($update_product);
                       $resultRegisterts = $stmtt_p->execute();
                     //  var_dump($update_product);
                        
                        $update_quantity = "UPDATE `godown_1th_floor` SET `godown_sith_quantity` ='$back_qunttity' , `time_stamp`=now()  WHERE `id` ='$id'";
                        $stmtt = $dbh->prepare($update_quantity);
                        $resultRegistert = $stmtt->execute();
                        

                        $history_query = " INSERT INTO `inventory_history`(`invoice_id`, `description`, `rate`, `plus_full`, `minus_full`, `status`, `product_id`, `date`, `customer_id`, `time_stamp`) VALUES ('$invoice_id','RESERVED {PURCHASE}','0','$updateProductQuantity','0','0','$outProductNameValue','$date','0',now())  ";
                        $stmttt = $dbh->prepare($history_query);
                        $resultRegistert = $stmttt->execute(); 

                     


                      
                     }
                   

                  $fetach_query_godown = "SELECT * ,godown_sith_quantity as godown_first_floor_quantity FROM `godown_1th_floor` WHERE `categoryID` = '$outProductTypeValue' AND `productID` = '$outProductNameValue'";
                    $fetach_sthtd = $dbh->prepare($fetach_query_godown);
                    $fetach_sthtd->execute();
                    $counter = $fetach_sthtd->rowCount();  
                    $rows = $fetach_sthtd->fetch(PDO::FETCH_ASSOC); 
                    $godown_first_floor_quantity = $rows['godown_first_floor_quantity'];
                $dodown_quantity_update = $godown_first_floor_quantity + $quantityMinus;

                    if($counter >= 1)
                    {
                         $completeQuantity_query = "update  `godown_1th_floor` set  `categoryID` ='$outProductTypeValue', `productID` ='$outProductNameValue', `godown_sith_quantity` = '$dodown_quantity_update', `invoice_id` = '$invoice_id', `time_stamp` =now(),`transfer_id` = '',`purchase_invoice_details_id` = '$purchase_invoice_details_id',`user_id` = '$user_id' WHERE categoryID = '$outProductTypeValue' AND productID   = '$outProductNameValue'";

                    }else{

                         $completeQuantity_query = "INSERT INTO `godown_1th_floor`(`categoryID`, `productID`, `godown_sith_quantity`, `invoice_id`, `time_stamp`,`transfer_id`,`purchase_invoice_details_id`,`godwon_previous_quantity`,`user_id`) VALUES ('$outProductTypeValue','$outProductNameValue','$quantityMinus','$invoice_id',now(),'','$purchase_invoice_details_id','$godown_sith_quantity','$user_id')";

                    }    
                  $stmtt_qunt = $dbh->prepare($completeQuantity_query);
                  $resultRegistert = $stmtt_qunt->execute();
                  //  var_dump($completeQuantity_query);
            } 
        }

            }



        
    }

      header("Location:custom-inventory.php");  


  }
    


?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
       <title>Manufacturing | ppipopular</title>
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
                        <h4 class="font-weight-bold py-3 mb-0">Manufacturing Products</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Manufacturing Products</li>
                            </ol>
                        </div>

                          <!-- Modal template -->
                       <div class="modal fade" id="modals-default">
                            <div class="modal-dialog modal-lg">

                            </div>
                        </div>

                         <!-- Modal template end-->

                        <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="fas fa-money-bill-alt" style="font-size:35px; "></i> &nbsp;Manufacturing Products</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                <form method="post" id="purchaseInvoice">

                                    <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg">Vouchar No#</label>
                                                     <input type="text" readonly="" class="form-control" value="<?php echo $sale_invoice_random ?>"  name="vouchar_date">
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg">Date</label>
                                                     <input type="text" readonly="" value="<?php echo @$date ?>" class="form-control"  name="vouchar_date">
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                 <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">Input By</label>
                                                     <input type="text" readonly="" class="form-control" value="<?php echo $session_user_name ?>"  name="vouchar_date">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                     <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">No of Items</label>
                                                     <input type="text" readonly=""  class="form-control"  name="vouchar_date">
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    
                                                </div><br><br>



                                  <div class="form-row">

                                    <div class="form-group col-md-0" style="margin: 0 auto">
                                            <h3>OUT IN STOCK</h3>
                                        </div>
                                    </div>      
                                 <table class="table product-discounts-edit datatable outTableAddMore" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="25%">Product Type</th>
                                                        <th width="25%">Product Name</th>
                                                        <th width="22%">Godown</th>
                                                        <th width="24%">Quantity</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                       
                                                        <td>
                                                           <select class="select2-demo form-control inProductType" style="width: 100%" data-allow-clear="true" name="inProductType[]">
                                                            <option value="0">Select Product Type</option>
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `category`";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $category_id = $rowss['id'];
                                                                     $category_name = $rowss['category_name'];
                                                                    echo '<option value="'.$category_id.'">'.$category_name.'</option>';    
                                                                }   
                                                            ?>
                                                        </select>    
                                                        </td>

                                                        <td>
                                                            <select class="select2-demo form-control inProductName" style="width: 100%" data-allow-clear="true" name="inProductName[]">
                                                                <option value="0">Select Product Name</option>
                                                                
                                                            </select>    
                                                        </td>
                                                        <td>
                                                             <select class="select2-demo form-control inGodown" style="width: 100%" data-allow-clear="true" name="inGodown[]">
                                                            <option value="0">Select Godown</option>
                                                            <option value="1">Godown 1st Floor</option>
                                                        </select>    
                                                        </td>
                                                        <td>
                                                             <input type="text" class="form-control inQuantity" required name="inQuantity[]" readonly="" placeholder="">
                                                        </td>
                                                        <td><button type="button" class="btn icon-btn btn btn-outline-success add_more"><span class="fas fa-plus "></span></button></td>
                                                         <td></td>
                                                    </tr>

                                                </tbody>
                                </table>

                                 <div class="form-row">

                                        <div class="form-group col-md-0" style="margin: 0 auto">
                                            <h3>IN STOCK</h3>
                                        </div>
                                    </div>    

                                 <table class="table product-discounts-edit datatable inTableAddMore" id="datatable">
                                                <thead>
                                                    <tr>
                                                       <th width="25%">Product Type</th>
                                                        <th width="25%">Product Name</th>
                                                        <th>Godown</th>
                                                        <th>Quantity</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                       
                                                        <td>
                                                    <select class="select2-demo form-control outProductType" style="width: 100%" data-allow-clear="true" name="outProductType[]">
                                                            <option value="0">Select Product Type</option>
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `category`";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $category_id = $rowss['id'];
                                                                     $category_name = $rowss['category_name'];
                                                                    echo '<option value="'.$category_id.'">'.$category_name.'</option>';    
                                                                }   
                                                            ?>
                                                        </select>    
                                                        </td>
                                                        <td>
                                                        <select class="select2-demo form-control outProductName" style="width: 100%" data-allow-clear="true" name="outProductName[]">
                                                            <option value="0">Select Product Name</option> 
                                                        </select>      
                                                        </td>
                                                        <td>
                                                           <select class="select2-demo form-control outGodown" style="width: 100%" data-allow-clear="true" name="outGodown[]">
                                                                <option value="0">Select Godown</option>
                                                                <option value="1">Godown 1st Floor</option>
                                                            </select>    
                                                        </td>
                                                        <td>
                                                           <input type="text" class="form-control"  required name="outQuantity[]" placeholder="">
                                                        </td>

                                                    </tr>

                                                </tbody>
                                </table> 


                                <div class="custom_in_out"></div>

                                <br>
                                  <div class="form-group" align="right">
                                           <div class="form-group col-md-4 center" style="margin: 0 auto;">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" role="button">Save</button>
                                            </div>
                                        </div>

                     
                        </form>
                
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

<script>
     
  $("body").on("click", ".add_more", function (event) {

    $('.outTableAddMore').append('<tbody> <tr><td><select class="select2-demo form-control inProductType" style="width: 100%" data-allow-clear="true" name="inProductType[]"><option value="0">Select Product Type</option>\
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `category`";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $category_id = $rowss['id'];
                                                                     $category_name = $rowss['category_name'];
                                                                    echo '<option value="'.$category_id.'">'.$category_name.'</option>';    
                                                                }   
                                                            ?>
                                                        </select></td><td>\
                                                            <select class="select2-demo form-control inProductName" style="width: 100%" data-allow-clear="true" name="inProductName[]"><option value="0">Select Product Name</option>\
                                                            </select></td>  <td> <select class="select2-demo form-control inGodown" style="width: 100%" data-allow-clear="true" name="inGodown[]"><option value="0">Select Godown</option><option value="1">Godown 1st Floor</option></select></td><td>\
                                                             <input type="text" class="form-control inQuantity" required name="inQuantity[]" readonly="" placeholder="">\
                                                        </td>\
                                                        <td><button type="button" class="btn icon-btn btn btn-outline-success delete_tr_row"><span class="fas fa-trash-alt "></span></button></td>\
                                                         <td></td>\</tr></tbody>');

    $('.inTableAddMore').append('<tbody> <tr><td> <select class="select2-demo form-control outProductType" style="width: 100%" data-allow-clear="true" name="outProductType[]"><option value="0">Select Product Type</option>\
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `category`";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $category_id = $rowss['id'];
                                                                     $category_name = $rowss['category_name'];
                                                                    echo '<option value="'.$category_id.'">'.$category_name.'</option>';    
                                                                }   
                                                            ?>
                                                        </select></td><td><select class="select2-demo form-control outProductName" style="width: 100%" data-allow-clear="true" name="outProductName[]">\
                                                            <option value="0">Select Product Name</option> </select></td><td><select class="select2-demo form-control outGodown" style="width: 100%" data-allow-clear="true" name="outGodown[]"><option value="0">Select Godown</option><option value="1">Godown 1st Floor</option>\
                                                            </select></td><td><input type="text" class="form-control"  required name="outQuantity[]" placeholder=""></td><td><button type="button" class="btn icon-btn btn btn-outline-success delete_tr_row"><span class="fas fa-trash-alt "></span></button></td>\</tr></tbody>')


    $('.inProductType').select2();
    $('.inProductName').select2(); 
    $('.outProductType').select2();
    $('.outProductName').select2();
    $('.outGodown').select2(); 
    $('.inGodown').select2();



  })

     
  $("table").on("click", ".delete_tr_row", function (event) {
          
        $(this).closest('tr').remove();
         

         })

    
$("body").on("change", ".inProductType", function (event) {

     var $closeet = $(this).closest('tr');
    var  select_category =  $closeet.find('.inProductType').val();

     $closeet.find('.inProductName').empty();
     $closeet.find('.inProductName').append($('<option></option>').val("0").html("Choose Product"));
   
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?select_category='+select_category,
                  dataType: 'JSON',
            success: function (data) {
            $.each(data.products, function (key, value) {
                $closeet.find('.inProductName').append($('<option></option>').val(value.id).html(value.product_name));
            });
            
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })


$("body").on("change", ".inProductName", function (event) {
    var $closeet = $(this).closest('tr');
    var inProductName = $closeet.find('.inProductName').val();
   
        $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?inProductName='+inProductName,
                  dataType: 'JSON',
            success: function (data) {
                console.log(data);
                var inQuantity = data.first_floor_quantity;
                if(inQuantity == "" || inQuantity == null){
                    $closeet.find('.inQuantity').val("0");  
                }else{
                    $closeet.find('.inQuantity').val(inQuantity);  
                }
                
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })


 $("body").on("change", ".outProductType", function (event) {
    var $closeet = $(this).closest('tr');
    var  select_category =  $closeet.find('.outProductType').val();
     $closeet.find('.outProductName').empty();
     $closeet.find('.outProductName').append($('<option></option>').val("0").html("Choose Product"));
   
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?select_category='+select_category,
                  dataType: 'JSON',
            success: function (data) {
            $.each(data.products, function (key, value) {
                $closeet.find('.outProductName').append($('<option></option>').val(value.id).html(value.product_name));
            });
      
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })   



</script>
    