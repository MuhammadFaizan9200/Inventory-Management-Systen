<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $typeArray = array();
    $fetch_query = "SELECT *  FROM `category`";
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
    <title>Category | Ppipopular</title>

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
                        <h4 class="font-weight-bold py-3 mb-0">New Category</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Category</li>
                            </ol>
                        </div>

                        <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp; Add Category</h3>
                                 <div class="card-body"  style="border-style: solid; border-color: #716aca;">
                                    <form method="post" id="add_category"> 
                                  <div class="form-row">

                                    <div class="form-group col-md-12">
                                     <label class="form-label form-label-lg">Product Type</label>
                                     <input type="text" name="category_name" class="form-control form-control-lg" placeholder="For e.g. 'PRIME'">
                                     <div class="clearfix"></div>
                                    </div>                                    
                                </div>
                                    <input type="hidden" name="sess_user_id" value="<?php echo $_SESSION['user_id'] ?>">   
                                     <input type="hidden" name="form_submit" value="insert_category">   
                                            
                                        <div class="form-group" align="center">
                                            <div class="col-sm-offset-7 col-sm-4">
                                                <button class="btn btn-primary btn-lg btn-block add_category" type="submit">Add Category</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>         

                       
                        <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Category List</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                   <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                        <th style="width:25px;">S No</th>
                                        <th>Category Name</th>
                                        <th style="width:25px;">Edit</th>
                                        <th style="width:25px;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count =1;
                                    foreach($typeArray as $key => $values){
                                        $id = $values['id'];
                                        $category_name = $values['category_name'];
                                       echo"<tr> 
                                          <td>$count</td>
                                          <td>$category_name</td>
                                           <input type='hidden' class='category_id' value='$id'>
                                            <input type='hidden' class='category_name' value='$category_name'>
            
                                           <td><img src='assets/img/edit.svg' class='edit_category' data-toggle='modal' data-target='#modals-default' style='width: 25px;height: 25px;cursor:pointer'></td>
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
