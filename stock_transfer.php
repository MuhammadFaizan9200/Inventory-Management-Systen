<?php
    ob_start();
	session_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $date = date('Y-m-d');


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
                        <h4 class="font-weight-bold py-3 mb-0">Godown</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Stock Transfer</li>
                            </ol>
                        </div>



                        <div class="card mb-4">
                            <h3 class="card-header" align="Center"><i class="fas fa-exchange-alt" style="font-size:35px; "></i> &nbsp; Stock Transfer</h3>
                            <div class="card-body">
                                <form method="post" id="purchaseInvoice">
                                  <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <label class="form-label">Godwn Form</label>
                                        <select class="select2-demo form-control godwn_from" required style="width: 100%" data-allow-clear="true" name="godwn_from">
                                        <option value="0">Select Godown</option>
                                        <option value="1st_floor">1st Floor CM</option>
                                        <option value="6" selected>6th Floor CM</option>
                                        </select>
                                         <div class="clearfix"></div>
                                    </div>   

                                    <div class="form-group col-md-3">
                                        <label class="form-label">Godwn To</label>
                                        <select class="select2-demo form-control godwn_to" required style="width: 100%" data-allow-clear="true" name="godwn_to">
                                        <option value="0">Select Godown</option>
                                        <option value="1">1st Floor CM</option>
                                        </select>
                                         <div class="clearfix"></div>
                                    </div>  

                                    <div class="form-group col-md-3">
                                            <label class="form-label">Date</label>
                                            <input type="text" class="form-control" value="<?php echo @$date ?>" readonly name="date" placeholder="Date">
                                            <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group col-md-3">
                                            <label class="form-label">Transfer By</label>
                                            <input type="text" class="form-control" required value="<?php echo @$username ?>" placeholder="User Name">
                                            <div class="clearfix"></div>
                                    </div>

                                </div>


<br><br>                                   <div class="table-responsive">
                                            <table class="table product-discounts-edit datatable" id="datatable">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Product Type</th>
                                                        <th width="15%">Product Name</th>
                                                        <th>Full Avialable</th>
                                                        <th>PCS</th>
                                                        <th>Total PCS</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                       
                                                        <td>
                                                            <select class="custom-select select_category" name="categoryName[]" required>
                                                                <option value="0">Choose Type</option>
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
                                                            </select>    
                                                        </td>

                                                        <td>
                                                               <select class="custom-select set_products" name="productName[]">
                                                                <option value="0">Choose Product</option>
                                                                
                                                            </select> 
                                                        </td>
                                                        <td><input type="text" class="form-control avialableQuantity" required placeholder="Full Avialable" name="avialableQuantity[]" readonly=""></td>
                                                        <td><input type="text" class="form-control transferQuantity" required name="transferQuantity[]" placeholder="25"></td>
                                                        <td><input type="text" class="form-control totalQuantity" required name="totalQuantity[]" placeholder="Total Qty."><input type="hidden" name="product_details_id[]" class="product_details_id"><input type="hidden" name="product_quantity_sale[]" class="product_quantity_sale"></td>
                                                        <td><button type="button" class="btn icon-btn btn btn-outline-success add_invoice"><span class="fas fa-plus "></span></button></td>
                                                         <td></td>
                                                    </tr>

<!--
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type="text" class="form-control" placeholder="Total Full"></td>
                                                        <td><input type="text" class="form-control" placeholder="Total PCS"></td>
                                                        
                                                        <td><input type="text" class="form-control" placeholder="Total Qty."></td>
                                                        <td><input type="text" class="form-control" placeholder="Total Items" readonly=""></td>
                                                    </tr>   
-->
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-group" align="right">
                                            <div class="col-sm-offset-8 col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" role="button">Transfer</button>
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
    $('.select_category').select2();
    $('.set_products').select2();     

    $('.add_invoice').on('click',function(){
          
            $('#datatable').append('<tbody><tr class="tRow"><td><select required class="custom-select select_category categoryFunction" id="select_category"  name="categoryName[]" required><option value="0">Choose Type</option>\
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
            </select></td><td><select  required class="custom-select set_products" required name="productName[]"><option value="0">Choose Product</option></select></td><td><input required type="text" class="form-control avialableQuantity" name="avialableQuantity[]" placeholder="Full Avialable" readonly=""></td><td><input required type="text" class="form-control transferQuantity" name="transferQuantity[]" placeholder="25"></td><td><input required type="text" class="form-control totalQuantity" name="totalQuantity[]" placeholder="Total Qty."><input type="hidden" name="product_details_id[]" class="product_details_id"><input type="hidden" name="product_quantity_sale[]" class="product_quantity_sale"></td><td><button type="button" class="btn icon-btn btn btn-outline-danger delete_tr_row"><span class="fas fa-trash-alt"></span></button></td>/tr><tbody>'); 
            $('#datatable tr:last').find(".select_category").focus();
             $('.select_category').select2();
             $('.set_products').select2();     
    })  

    var godwn_from;
    $(".godwn_from").on("change", function (event) {   
         godwn_from = $(this).val();
    })

    $(".godwn_to").on("change", function (event) {   
        var godwn_to = $(this).val();
        if(godwn_from == godwn_to){
            $(".godwn_to").val(0);
            alert("Please Select another godown");
        }
    })
    
    
    
    var  select_category;
    $("table").on("change", ".select_category", function (event) {
        
        select_category =  $(this).closest('tr').find('.select_category').val();
        var $tr = $(this).closest('tr');
         $tr.find('.set_products').empty();
        $tr.find('.set_products').append($('<option></option>').val("0").html("Choose Product"));

             $.ajax({
                type: 'get',
                url: 'fetch_ajax_staock_transfer.php?select_category='+select_category,
                      dataType: 'JSON',
                success: function (data) {
                $.each(data.products, function (key, value) {
                    
                    $tr.find('.product_details_id').val(value.product_details_id);
                    $tr.find('.product_quantity_sale').val(value.product_quantity_sale);
                    $tr.find('.set_products').append($('<option></option>').val(value.id).html(value.product_name));
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
            url: 'fetch_ajax_staock_transfer.php?set_products_value='+set_products_value+"&select_category_id="+select_category,
                dataType: 'JSON',
            success: function (data) {
                 var counter = data.counter;
                if(counter == 0){
                    alert("Quantity not found please select another invoice");
                    $tr.find('.set_products').val("0");
                    $tr.find('.select_category').val("0");
                }
                 $tr.find('.avialableQuantity').val(data.godown_sith_quantity);
          },
            error: function(data){
               console.log("error");
           }
          });
        
    
    
 })        
    
$("#purchaseInvoice").submit(function(e) {
       var  error = 0;
        e.preventDefault();
        var form_data = new FormData(this);
    
    $('.transferQuantity').each(function(){
       var avialableQuantity =  parseInt($(this).closest('tr').find('.avialableQuantity').val());
        var transferQuantity = parseInt($(this).val());
        console.log(avialableQuantity);
        console.log(transferQuantity);
            if(transferQuantity > avialableQuantity){
                    e.preventDefault();
                    alert('Please input valid quantity');
                    $(this).closest('tr').find('.transferQuantity').css('border','1px solid red');	
                    $(this).closest('tr').find('.transferQuantity').focus();	
                     error = 1;
                    return false;
                }else{
                   $(this).closest('tr').find('.transferQuantity').css('border','0px solid rgba(24, 28, 33, 0.1)'); 
                    
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
                            url: 'stock_transfer_ajax.php',
                            data:form_data,
                             cache:false,
                            contentType: false,
                            processData: false,	 
                            success: function (data,status) {
                               window.location.href = "transfer-details.php";
                            }
                        });
                swal("Poof! Purchase invoice has been updated!", {
                      icon: "success",
    
                    });
                  } else {
                   return false;
                  }
                });
        
                    
                    
                    
                }
            
        })   
     
     
        
        
       




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
         calc();

         })

    $('body').on("keyup",".datatable tbody tr", function() {
            calc();
        });
        $('.transferQuantity').on('keyup change',function(){
            console.log("this");    
            calc_total();
        });
});



    
    
function calc()
    {
        $('.datatable tr').each(function(i, element) {
            var html = $(this).html();
            if(html!='')
            {
                var avialableQuantity = $(this).find('.avialableQuantity').val(); 
                var transferQuantity = $(this).find('.transferQuantity').val();
                var totalQuantity = $('.totalQuantity').val();
                    $(this).find('.totalQuantity').val(transferQuantity);
                    calc_total();
                
            }
        });
    }

    function calc_total()
    {
        transferQuantity = 0;
        $('.transferQuantity').each(function() {
            transferQuantity += parseInt($(this).val());
        });
        console.log(transferQuantity);
        if(!isNaN(transferQuantity)){
            //$('.transferQuantity').val(transferQuantity);
        }
    }
      
    
 
    var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         




</script>
    