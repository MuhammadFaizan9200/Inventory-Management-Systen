<?php
    session_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
     $typeArray = array();
    $fetch_query = "SELECT * FROM `banks`";
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
    <title>Bank Details | Ppipopular</title>

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
    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
        background-color: #fff !important;
    }
    .modal-dialog{
            max-width: 56rem !important;
    }
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #fff;}

#customers tr:hover {background-color: #fff;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #2c2e3e !important;
  color: white;
}        
    </style>
    
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->
    
      <!-- Modal template -->
        <div class="modal fade" id="modals-default">
            <div class="modal-dialog">

            </div>
        </div>
    
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
                        <h4 class="font-weight-bold py-3 mb-0">Bank Details</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Bank Details</li>
                            </ol>
                             <ol class="breadcrumb">
                               <a href="add-bank.php"  class="btn btn-primary btn btn-block add_product"  style="width:20%" >Add Bank</a>
                            </ol>
                        </div>
                       
                       <div class="card-deck">
                           
                           <?php
                                
                                foreach($typeArray as $values){
                                    $bank_name = $values['bank_name'];    
                                     $icon = $values['icon'];    
                                    echo '<div class="card">
                                        <img class="card-img-top" src="assets/img/bank/'.$icon.'" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">'.$bank_name.'</h4>
                                        </div>
                                    </div>';
                                }
    
                            ?>
                            
                          
                         
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
        $(document).ready(function () {
    $('body').on('click','.edit_product', function(event){
            var purchaseInvoiceID =this.id;
            
            $.get("fetch_transfer_details_ajax.php?purchaseInvoiceID="+purchaseInvoiceID, function (data, status) {
                          $('.modal-dialog').html(data);    
                 //$('#editable-table').DataTable();
            });
     });  
    
    })
  
    
    
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
    
    
    
    $('body').on('click','.edit_category', function(event){
            var category_id = $(this).closest('tr').find('.category_id').val();
            var category_name = $(this).closest('tr').find('.category_name').val();
            
          $('.modal-dialog').html(' <form class="modal-content" method="post" id="category_update"><div class="modal-body form-horizontal"><div class="form-row"><div class="form-group col mb-4">\ <label class="form-label">Category Name</label><input type="text" value="'+category_name+'" class="form-control" placeholder="Product Name" name="category_name_edit"><div class="clearfix"></div> </div></div><input type="hidden" name="form_submit" value="update_category"><input type="hidden" name="category_id_get" value="'+category_id+'"><div class="form-row" style="float: right;"><div class="form-group col mb-4"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary">Save</button></div></div></div></form>');
         $('.categoryType').val(category_id);
     });  

    
    //  var table = $('#editable-table').DataTable();          
    
    $('#add_category').on('submit',function(e){
         var form_data = new FormData(this);
         e.preventDefault();  
        $('.add_category').html("Processing");
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
                $('.add_category').html("Add Category");   
                showmessage('success','Category Add Successfully','Success');
                 window.location.href = 'category.php'; 
            },
            error: function(data){
               console.log("error");
           }
          });
            
          
        
    })
    
    $('body').on("submit","#category_update",function(e){
        
        var form_data = new FormData(this);
         e.preventDefault();
          $.ajax({
            type: 'post',
             cache:false,
            contentType: false,
            processData: false,
            url: 'add_product_ajax_file.php',
            data:form_data,
            success: function (data,status) {
                showmessage('success','Category Update Successfully','Success');  
                window.location.href = 'category.php'; 
            },
            error: function(data){
               console.log("error");
           }
          });   
        
    })
    
    <?php
        if(@$_GET['id']){
          echo "showmessage('success','Product Update Successfully','Success')";  
        }
        
    ?>
    
    $("table").on("click", ".delete", function (event) {
                if (confirm("Are you sure you want to delete this Category?")) {
                    var ID = this.id;
                     var $this = $(this); 
                    $.get("delete.php?category_id="+ID, function (data, status) {
                        if (status == 'success') {
                            var Row = $this.closest('tr');
                              var tr = $this.parents('tr');
                              var nRow = Row[0];
                            showmessage('warning','Category Delete Successfully','Success');  
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
