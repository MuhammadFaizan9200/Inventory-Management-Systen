<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $typeArray = array();
    $fetch_query = "SELECT p.*,c.id as customer_id , (SELECT user_name FROM user WHERE user_id = p.`created_by`) as createdName , (SELECT company_name FROM company WHERE id = p.`company_id`) as companyName  FROM `products` p join company c ON c.id = p.`company_id` WHERE c.status = 0 order by p.id desc";
    $sth = $dbh->prepare($fetch_query);
    $result = $sth->execute();
    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
            $typeArray[] = $rows;
    }	

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Products | Ahmed Traders</title>

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
                   <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">New Products</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>

                       <div class="card mb-4">
                            <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp; Add Products</h3>
                                 <div class="card-body" style="border-style: solid; border-color: #716aca;">
                            <form method="post" id="add_product"> 
                                  <div class="form-row">

                                   <div class="form-group col-md-4">
                                   <label class="form-label">Product Name</label>
                                     <input type="text" class="form-control" placeholder="Product Name" required name="product_name">
                                     <div class="clearfix"></div>
                                    </div> 

                                    <div class="form-group col-md-4">
                                       <label class="form-label">Company Name</label>
                                         <select  class="form-control company_name"  required name="company_name">
                                             <option value="0">Select Company Name</option>
                                        <?php
                                            $fetch_query = "SELECT * FROM `company` WHERE status = 0";
                                            $sth = $dbh->prepare($fetch_query);
                                            $result = $sth->execute();
                                            while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                                  $id = $rows['id'];
                                                 $company_name = $rows['company_name'];
                                                echo '<option value="'.$id.'">'.$company_name.'</option>';    
                                            } 
                                        ?>
                                         </select>
                                         <div class="clearfix"></div>
                                    </div> 

                                
                                    <div class="form-group col-md-3">
                                            <label class="form-label">Total Peace</label>
                                            <input type="number" class="form-control" placeholder="Total Peace'" required name="total_peace">
                                            <div class="clearfix"></div>
                                    </div>
                                      
                                      
                                      <input type="hidden" name="sess_user_id" value="<?php echo $_SESSION['user_id'] ?>">   
                                     <input type="hidden" name="form_submit" value="insert"> 

                                    <div class="form-group col-md-4">
                                            <label class="form-label">Purchase Price</label>
                                            <input type="text" class="form-control" placeholder="Purchase Price" required name="purchase_price">
                                            <div class="clearfix"></div>
                                    </div>
                                     

                                    <div class="form-group col-md-4">
                                            <label class="form-label">Sale Price</label>
                                            <input type="text" class="form-control" placeholder="Sale Price" required name="add_prodct_price">
                                            <div class="clearfix"></div>
                                    </div>

                                      
                                       <div class="form-group col-md-4">
                                            <label class="form-label">Discount</label>
                                            <input type="text" value="0" class="form-control" placeholder="Discount"  name="discount">
                                            <div class="clearfix"></div>
                                    </div>

                                     <div class="form-group col-md-4">
                                            <label class="form-label">Product Description</label>
                                            <input type="text" class="form-control" placeholder="Description"  name="description">
                                            <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn btn-block add_product"  role="button">Add Product</button>
                                    </div>
                                </div>
                                    </form>
                                </div>
                            </div>         

                       
                        <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Product List</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                   <div class="table-responsive">
                          <div class="row">          
                          <div class="form-group col-md-6">   
                          <label class="form-label">Search By Company</label>      
                             <select class="company form-control">
                               <option value="0">Select Company</option>
                               <?php
                                    $fetch_query = "SELECT * FROM `company` WHERE status = 0";
                                    $sth = $dbh->prepare($fetch_query);
                                    $result = $sth->execute();
                                    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                          $id = $rows['id'];
                                         $company_name = $rows['company_name'];
                                        echo '<option value="'.$company_name.'">'.$company_name.'</option>';    
                                    } 
                                ?>
                             </select>         
                           </div>

                           <div class="form-group col-md-6">   
                          <label class="form-label">Search By Title</label>      
                             <input type="text" class="form-control search_products" placeholder="Search By title"  name="search_products">     
                           </div>
                         </div>
                           <hr>
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Product Name</th>
                                        <th>Company name</th>
                                        <th>Product Description</th>
                                        <th>P Price</th>
                                        <th>S Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Add by</th>
                                        <th>Created Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count =1;
                                    foreach($typeArray as $key => $values){
                                        $id = $values['id'];
                                        $product_name = $values['product_name'];
                                        $description = $values['description'];
                                        $createdName = $values['createdName'];
                                        $createdName = $values['createdName'];
                                        $product_quantity = $values['discount'];
                                        $price = $values['price'];
                                        $created_time = $values['created_time'];
                                         $companyName = $values['companyName'];
                                         $product_quantity_sale = $values['product_quantity_sale'];
                                         $purchase_price = $values['purchase_price'];
                                       
                                         $createdTime = strtotime($created_time . "UTC");
                                         $created_time_convert = date('d-M-Y h:i A', $createdTime);    
                                         $created_time_convert = explode(" " , $created_time_convert);        
                                         $createdDate =  $created_time_convert[0];
                                        
                                        
                                              
                                        
                                    echo"<tr> 
                                          <td>$count</td>
                                          
                                           <td>$product_name</td>
                                           <td>$companyName</td>
                                           <td>$description</td>
                                           <td>$purchase_price</td>
                                           <td>$price</td>
                                            <td>$product_quantity_sale</td>
                                           <td>$product_quantity</td>
                                           <td>$createdName</td>
                                           <td><span title='' data-placement='top' data-toggle='tooltip' class='tooltips tooltips_update'  data-original-title='$createdDate'>".$createdDate."</span></td>
                                           <input type='hidden' class='product_id' value='$id'>
                                            <input type='hidden' class='product_name' value='$product_name'>
                                             <input type='hidden' class='description' value='$description'>
                                              <input type='hidden' class='price' value='$price'>
                                              <input type='hidden' class='purchase_price' value='$purchase_price'>
                                              <input type='hidden' class='product_quantity_sale' value='$product_quantity_sale'>
                                               <input type='hidden' class='discount' value='$product_quantity'>
                                           <td><img src='assets/img/edit.svg' class='edit_product' data-toggle='modal' data-target='#modals-default' style='width: 25px;height: 25px;cursor:pointer'></td>
                                           <td><img src='assets/img/delete.svg' id ='$id' class='delete' style='width: 25px;height: 25px;cursor:pointer'></td>
                                         </tr>";
                                    $count++;

                                    }

                                    ?>
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
    $('body').on('click','.edit_product', function(event){
            var product_id = $(this).closest('tr').find('.product_id').val();
            var product_name = $(this).closest('tr').find('.product_name').val();
            var description = $(this).closest('tr').find('.description').val();
            var category_id = $(this).closest('tr').find('.category_id').val();
             var price = $(this).closest('tr').find('.price').val();
             var discount = $(this).closest('tr').find('.discount').val();
             var purchase_price = $(this).closest('tr').find('.purchase_price').val();

             var product_quantity_sale = $(this).closest('tr').find('.product_quantity_sale').val();
             var reorder = $(this).closest('tr').find('.reorder').val();
             var type = $(this).closest('tr').find('.type').val();

        
          $('.modal-dialog').html(' <form class="modal-content" method="post" id="product_update"><div class="modal-body form-horizontal"><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">Product Name</label><input type="text" value="'+product_name+'" class="form-control" placeholder="Product Name" name="product_name"><div class="clearfix"></div> </div></div><div class="form-row"><div class="form-group col mb-4"> <label class="form-label">Description</label><input type="text" class="form-control" value="'+description+'" placeholder="Description" name="description"><div class="clearfix"></div></div> </div><div class="form-row"> </div><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">P Price</label><input type="text" value="'+purchase_price+'" class="form-control" placeholder="P Price" name="purchase_price"><div class="clearfix"></div> </div></div><div class="form-row"> </div><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">S Price</label><input type="text" value="'+price+'" class="form-control" placeholder="S Price" name="price"><div class="clearfix"></div> </div></div><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">Quantity</label><input type="text" value="'+product_quantity_sale+'" class="form-control" placeholder="Quantity" name="total_peace"><div class="clearfix"></div> </div></div><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">Discount</label><input type="text" value="'+discount+'"  class="form-control" placeholder="Discount" name="discount"><div class="clearfix"></div> </div></div></div><br><br><input type="hidden" name="form_submit" value="update"><input type="hidden" name="product_id" value="'+product_id+'"><div class="form-row" style="float: right;"><div class="form-group col mb-4"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary">Save</button></div></div></div></form>');
         $('.categoryType').val(category_id);
        $('.modalTYpe').select2({
            dropdownParent: $('#modals-default')
        });
        
     });  
      
})


$('.quantity_type').on('change',function(e){
    var quantity_type = $(this).val();
    if(quantity_type == 2){
        $('.cotton').prop('readonly', false);
        $('.per_cotton_quantity').prop('readonly', false);
    }else{
        $('.cotton').prop('readonly', true);
        $('.per_cotton_quantity').prop('readonly', true);
    }
})


$(document).ready(function() {
  var table =  $('#editable-table').DataTable();
    $('.company').on('change',function(e){
      if($(this).val() != 0){
        table.columns(2).search( $(this).val() ).draw();  
      }else{
        table.columns(2).search("").draw();  
      }
      
    })

    $('.search_products').keyup(function (e) {
              console.log("gdfgdfg")
                table.columns(1).search( $(this).val() ).draw();  
           //  oTable.fnFilter("^"+$(this).val()+"$", 1, false, false); 
            
        });


  })


    
    //  var table = $('#editable-table').DataTable();          
    
    $('#add_product').on('submit',function(e){
         var form_data = new FormData(this);
         e.preventDefault();  
        $('.add_product').html("Processing");
        var categoryType = $('.categoryType').val();
        var company_name = $('.company_name').val();
       // alert(company_name);
        if(company_name == 0){
            e.preventDefault();
            alert("Please Select Company Name");
        }else{
            
        $.ajax({
            type: 'post',
             cache:false,
            contentType: false,
            processData: false,
            url: 'add_product_ajax_file.php',
            data:form_data,
            success: function (data,status) {
                console.log(data);
                //var obj = jQuery.parseJSON(data);
                $('.add_product').html("Add Product");   
                showmessage('success','Product Add Successfully','Success');
                  window.location.href = 'add-product.php'; 
            },
            error: function(data){
               console.log("error");
           }
          });
            
          
        }
    })
    
    $('body').on("submit","#product_update",function(e){
        
        var form_data = new FormData(this);
        var categoryType = $('.categoryType').val();
         e.preventDefault();
        if(categoryType == 0){
            e.preventDefault();
            alert("Please Select Category Type");
        }else{
          $.ajax({
            type: 'post',
             cache:false,
            contentType: false,
            processData: false,
            url: 'add_product_ajax_file.php',
            data:form_data,
            success: function (data,status) {
                console.log(data);
                showmessage('success','Product Update Successfully','Success');  
                window.location.href = 'add-product.php'; 
            },
            error: function(data){
               console.log("error");
           }
          });   
        }
    })
    
    <?php
        if(@$_GET['id']){
          echo "showmessage('success','Product Update Successfully','Success')";  
        }
        
    ?>
    
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
    

        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
