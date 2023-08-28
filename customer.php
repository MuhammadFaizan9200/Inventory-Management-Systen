<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");


?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
     <title>Customers | Imran & Son's</title>
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


                    <div class="form-row">                          
                        <div class="form-group col-md-4">
                                 <h4 class="font-weight-bold py-3 mb-0">Customers</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Customers</li>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                        <div class="form-group col-md-5"></div>

                        <div class="form-group col-md-3">
                            <h4 class="font-weight-bold py-3 mb-0"></h4>
                             <ol class="breadcrumb">
                               <a href="add_customer.php"  class="btn btn-primary btn btn-block add_product"  style="width:100%" >Add New Customers</a>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                    </div>    
                                            
                       
                      
                        <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp;Customers List</h3>
                            <div class="card-body">
                                   <div class="table-responsive">
                                   	<div class="form-group col-md-6">
                                     <label class="form-label">Chart Of Accounts</label>
                                <select class="select2-demo form-control customerType" style="width: 100%" data-allow-clear="true" name="category_id">
                                         <option value="0">Select Account</option>
                                         <option value="Cash">Cash</option>
                                         <option value="Bank">Bank</option>
                                         <option value="Expense">Expense</option>
										<option value="Vendor">Supplier/Vendor</option>
										<option value="Customer">Customer</option>
										<option value="Company">Company</option>
										<option value="Others">Others</option>
                                </select>    
                                     <div class="clearfix"></div>
                                    </div>              
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                         <th>S#</th>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Mobile# 1</th>
                                         <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count = 1;
                                            $fetch_query = "SELECT * FROM `customer`";
                                            $sth = $dbh->prepare($fetch_query);
                                            $result = $sth->execute();
                                            while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                             $id = $rows['id'];     
                                            $customer_name = $rows['customer_name'];
                                            $address = $rows['address'];
                                            $mobile_1 = $rows['mobile_1'];

                                                
                                     echo "<tr>
                                            <td>$count</td>
                                            <td>$customer_name</td>
                                             <td>$address</td>
                                           <td>$mobile_1</td>
                                            <td><a href='add_customer.php?id=$id'><img src='assets/img/edit.svg' class='edit_category'  style='width: 25px;height: 25px;cursor:pointer'></a></td>
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

var oTable = $('#editable-table').DataTable();
$('.customerType').on('change', function() {
  oTable.columns(5).search($(this).val()).draw(); // note columns(0) here
});
   
<?php
        if(@$_GET['id']){
          echo "showmessage('success','Customer Update Successfully','Success')";  
        }
    ?>
    
    
 
    
    $("table").on("click", ".delete", function (event) {
                if (confirm("Are you sure you want to delete this Chart Of Account?")) {
                    var ID = this.id;
                     var $this = $(this); 
                    $.get("delete.php?customer_id="+ID, function (data, status) {
                        if (status == 'success') {
                            var Row = $this.closest('tr');
                              var tr = $this.parents('tr');
                              var nRow = Row[0];
                            showmessage('warning','Chart Of Account Delete Successfully','Success');  
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
