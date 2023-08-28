<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $typeArray = array();
    $fetch_query = "SELECT p.* , (SELECT user_name FROM user WHERE user_id = p.`created_by`) as createdName  FROM `purchase_invoice` p order by p.id asc";
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
    <title>List Purchase Invoice | Ppipopular</title>

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
                    
            <div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row" style="padding: 2px 0px 0px;width:100%">
                    <div class="col-md-1">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                       <div class="form-row" style="width:100%">

                                    <div class="form-group col-md-4">
                                      <label class="form-label">Vendor Name</label>
                                     <input type="text" class="form-control vendorName" name="vendorName" placeholder="Complete Name">
                                     <div class="clearfix"></div><br>
                                         
                                        <label class="form-label">Vendor Address</label>
                                         <input type="text" class="form-control vendorAddress" name="vendorAddress" placeholder="Complete Address">
                                          <div class="clearfix"></div><br>
                                       
                                       <label class="form-label">Contact Person</label>
                                        <input type="text" class="form-control contactPerson" name="contactPerson" placeholder="Person Name">
                                         <div class="clearfix"></div><br>
                                        
                                        <label class="form-label">Contact Number#</label>
                                         <input type="text" class="form-control contactNumber" name="contactNumber" placeholder="Person Mobile/Phone No.#">
                                         <div class="clearfix"></div>

                                        </div>
                                        <div class="form-group col-md-4"></div>
                                        <div class="form-group col-md-4">
                                            
                                         <label class="form-label">Purchase Invoice#</label>
                                            <input type="text" class="form-control invoiceNumber" value="" placeholder="NS/PPI/00000000001" name="invoiceNumber" readonly>
                                            <div class="clearfix"></div><br>
                                            
                                            <label class="form-label">Date</label>
                                            <input type="text" class="form-control date" id=""  readonly name="date" required placeholder="Select Date"><br>

                                             <label class="form-label">Total Items</label>
                                            <input type="text" class="form-control totalItem" placeholder="25" name="totalItem">
                                            <div class="clearfix"></div><br>
                                                
                                            
                                            <label class="form-label">Total Quantity</label>
                                            <input type="text" class="form-control totalQuantity" placeholder="30" name="totalQuantity">
                                            <div class="clearfix"></div><br>

                                           <label class="form-label">Foreign Currency</label>
                                            <input type="number" class="form-control foreignCurrency" required name="foreignCurrency" placeholder="Dollar/RMB">
                                            <div class="clearfix"></div><br>
                                            
                                        
                                        </div>
                                            
                                       <table class="table fetchProductInvoiceDetails">
                                          <thead>
                                            <tr>
                                              <th scope="col">#</th>
                                              <th width="15%">Product Type</th>
                                                <th width="15%">Product Name</th>
                                                 <th>Price Of FC</th>
                                                <th>Quantity</th>
                                                <th>Price In PKR</th>
                                                <th>Freight Cost</th>
                                                <th>Net Cost</th>
                                                <th>Net Amount</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            
                                            
                                          </tbody>
                                        </table>
                                    </div>    
				
                   
                </div>             
            </div>
            
            
            

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
                    

                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
                         <div class="form-row">                          
                        <div class="form-group col-md-4">
                                 <h4 class="font-weight-bold py-3 mb-0">List Purchase Invoice</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">List Purchase Invoice</li>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                        <div class="form-group col-md-5"></div>

                        <div class="form-group col-md-3">
                            <h4 class="font-weight-bold py-3 mb-0"></h4>
                             <ol class="breadcrumb">
                               <a href="purchase_invoice.php"  class="btn btn-primary btn btn-block add_product"  style="width:100%" >Add Purchase Invoice</a>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                    </div>   

                      
                        <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Purchase Invoice List</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                   <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Purchase Invoice #</th>
                                        <th>Vendor Name</th>
                                        <th>Contact Person</th>
                                         <th>Invoice Date</th>
                                        <th>Add by</th>
                                        <th>Created Date</th>
                                         <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count =1;
                                    foreach($typeArray as $key => $values){
                                        $id = $values['id'];
                                        $invoiceNumber = $values['purchase_invoice_#'];
                                        $date = $values['date'];
                                        $vendorName = $values['vendorName'];
                                        $contactPerson  = $values['contactPerson'];
                                        $created_time  = $values['created_time'];
                                        $createdName  = $values['createdName'];
                                        
                                        
                                        $invoiceNumber = $values['purchase_invoice_#'];
                                        $foreignCurrency = $values['foreighn_currency'];
                                        $vendorAddress = $values['vendorAddress'];
                                       
                                        $contactNumber = $values['contactNumber'];
                                        $totalItem = $values['totalItem'];
                                        $totalQuantity = $values['totalQuantity'];
                                        
                                        
                                        
                                         $createdTime = strtotime($created_time . "UTC");
                                         $created_time_convert = date('d-M-Y h:i A', $createdTime);    
                                         $created_time_convert = explode(" " , $created_time_convert);        
                                         $createdDate =  $created_time_convert[0];
                                        
                                        
                                              
                                        
                                    echo"<tr> 
                                          <td>$count</td>
                                          <td>$invoiceNumber</td>
                                           <td>$vendorName</td>
                                           <td>$contactPerson</td>
                                           <td>$date</td>
                                            <td>$createdName</td>
                                           <td><span title='' data-placement='top' data-toggle='tooltip' class='tooltips tooltips_update'  data-original-title='$createdDate'>".$createdDate."</span></td>
                                            <td><a href='purchase_invoice_edit.php?id=$id'><img src='assets/img/edit.svg' class='edit_product'  style='width: 25px;height: 25px;cursor:pointer'></a></td>
                                           <td><img src='assets/img/delete.svg' id ='$id' class='delete' style='width: 25px;height: 25px;cursor:pointer'></td>
                                           <td><a href='view-purchase-invoice.php?id=$id'' target='_blank'><img src='assets/img/view.svg' id ='$id' class='' style='width: 25px;height: 25px;cursor:pointer'></a></td>
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


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>
    
    
//     $('body').on('click','.comment_box,.view_comment',function(e){
//        var purchaseInvoiceID = this.id;
//         
//           
//       $(".form-row input").val("");
//           
//        
//         
//         
//         var $tr = $(this).closest('tr');
//         var vendorAddress =  $tr.find('.vendorAddress').val();
//          var contactPerson =  $tr.find('.contactPerson').val();
//          var contactNumber =  $tr.find('.contactNumber').val();
//          var invoiceNumber =  $tr.find('.invoiceNumber').val();
//          var date =  $tr.find('.date').val();
//          var totalItem =  $tr.find('.totalItem').val();
//          var foreignCurrency =  $tr.find('.foreignCurrency').val();
//           var vendorName =  $tr.find('.vendorName').val();
//          var totalQuantity =  $tr.find('.totalQuantity').val();
//            
//            
//            $('.vendorName').val(vendorName);
//            $('.vendorAddress').val(vendorAddress);
//            $('.contactPerson').val(contactPerson);
//            $('.contactNumber').val(contactNumber);
//            $('.invoiceNumber').val(invoiceNumber);
//            $('.date').val(date);
//            $('.totalItem').val(totalItem);
//            $('.totalQuantity').val(totalQuantity);
//            $('.foreignCurrency').val(foreignCurrency);
//               
//         $('#support').modal('show');
//         
//         
////        $.ajax({
////            type: 'post',
////            url: 'fetch_purchase_invoice.php?purchaseInvoiceID='+purchaseInvoiceID,
////            success: function (data,status) {
////                console.log(data);
////                var obj = jQuery.parseJSON(data);
////
////
////                
////               $('.vendorName').val(obj.vendorName);
////                $('.vendorAddress').val(obj.vendorAddress);
////                $('.contactPerson').val(obj.contactPerson);
////                $('.contactNumber').val(obj.contactNumber);
////                $('.invoiceNumber').val(obj.invoiceNumber);
////                $('.date').val(obj.date);
////                $('.totalItem').val(obj.totalItem);
////                $('.totalQuantity').val(obj.totalQuantity);
////                $('.foreignCurrency').val(obj.foreignCurrency);
////                
////                
//////            $.each(data, function (key, value) {
//////                
//////                console.log(value.categoryID);
//////               
//////                
//////                
//////            });
////                
//////                fetchProductInvoiceDetails
//////                
//////                <tr>
//////                                              <th scope="row"></th>
//////                                              <td></td>
//////                                              <td></td>
//////                                              <td></td>
//////                                                <th scope="row"></th>
//////                                              <td></td>
//////                                              <td></td>
//////                                              <td></td>
//////                                                <td></td>
//////                                            </tr>
////                
////                
////                
////            },
////            error: function(data){
////               console.log("error");
////           }
////          });
////         
//
//    })

   
    
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
    

    
    $("table").on("click", ".delete", function (event) {
                if (confirm("Are you sure you want to delete this Purchase Invoice?")) {
                    var ID = this.id;
                     var $this = $(this); 
                    $.get("delete.php?purchaseInvoiceID="+ID, function (data, status) {
                        if (status == 'success') {
                            var Row = $this.closest('tr');
                              var tr = $this.parents('tr');
                              var nRow = Row[0];
                            showmessage('warning','Purchase Invoice Delete Successfully','Success');  
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
