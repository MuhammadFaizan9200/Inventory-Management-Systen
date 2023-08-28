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
        $inPrice = $_POST['inPrice'];

    foreach($inProductName as $key => $value){
        
        $inProductTypeValue = $inProductType[$key];
        $inProductNameValue = $inProductName[$key];
        $inPriceValue = $inPrice[$key];
         
     $update_product = "UPDATE `products` SET `price` ='$inPriceValue' , `updated_time`=now()  WHERE `id` ='$inProductNameValue'";
      $stmtt_p = $dbh->prepare($update_product);
      $resultRegisterts = $stmtt_p->execute();
    //var_dump($update_product); 
      header("Location:inventory-opening.php");  


  }
    
}

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
       <title>Inventory Opening | ppipopular</title>
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
                        <h4 class="font-weight-bold py-3 mb-0">Inventory Opening</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Inventory Opening</li>
                            </ol>
                        </div>

                          <!-- Modal template -->
                       <div class="modal fade" id="modals-default">
                            <div class="modal-dialog modal-lg">

                            </div>
                        </div>

                         <!-- Modal template end-->

                        <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="fas fa-money-bill-alt" style="font-size:35px; "></i> &nbsp;Inventory Opening</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                <form method="post" id="purchaseInvoice">
                                 <table class="table product-discounts-edit datatable outTableAddMore" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">Product Type</th>
                                                        <th width="30%">Product Name</th>
                                                        <th width="30%">Price</th>
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
                                                             <input type="text" class="form-control inQuantity" required name="inPrice[]"  placeholder="">
                                                        </td>
                                                        <td><button type="button" class="btn icon-btn btn btn-outline-success add_more"><span class="fas fa-plus "></span></button></td>
                                                         <td></td>
                                                    </tr>

                                                </tbody>
                                </table>

                                 
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
                                                            </select></td><td>\
                                                             <input type="text" class="form-control inQuantity" required name="inPrice[]"  placeholder="">\
                                                        </td>\
                                                        <td><button type="button" class="btn icon-btn btn btn-outline-success delete_tr_row"><span class="fas fa-trash-alt "></span></button></td>\
                                                         <td></td>\</tr></tbody>');

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





</script>
    