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
    <title>Inventory Report | Ahmed Traders</title>

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
    <link rel="stylesheet" href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="assets/libs/timepicker/timepicker.css">
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
                        <h4 class="font-weight-bold py-3 mb-0">Inventory Report</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Inventory Report</li>
                            </ol>
                        </div>

                        <div class="card">
                             <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp;Inventory Report List</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                     <div class="table-responsive">
                        <div class="row">          
                          <div class="form-group col-md-6">   
                          <label class="form-label">Search By Company</label>      
                             <select class="company form-control">
                               <option value="0">Select Company</option>
                               <?php
                                    $fetch_query = "SELECT * FROM `company` where status = 0 order by id asc";
                                    $sth = $dbh->prepare($fetch_query);
                                    $result = $sth->execute();
                                    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                          $id = $rows['id'];
                                         $company_name = $rows['company_name'];
                                        echo '<option value="'.$id.'">'.$company_name.'</option>';    
                                    } 
                                ?>
                             </select>         
                           </div>

                           <div class="form-group col-md-6">   
                          <label class="form-label"><button type="submit" class="btn btn-primary print_button">Print</button>   </label>      
                             
                           </div>
                         </div>

                        <div class="table-responsive custom_datatable">                     
                            <table class="table table-bordered" style="width:100%;margin:auto;text-align:left;" >
                                <thead>
                                    <tr>
                                        <th style="width:25px;">S No</th>
                                        <th>Product Name</th>
                                        <th>Company Name</th>
                                        <th>Available Quantity</th>
                                        <th>P Rate</th>
                                        <th>S Rate</th>
                                        <th>Profit</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                    	$date = gmdate("Y-m-d");
                              $fetch_query = "SELECT p.* ,(SELECT company_name from company where id = p.`company_id`) companyName FROM `products` p ";
                                        $sth = $dbh->prepare($fetch_query);
                                       // var_dump($fetch_query);
                                        $result = $sth->execute();
                                        $count = 1;
                                        $grand_total_quantity_rate = 0;
                                        $grand_profit_amount = 0;
                                        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                            $id = $rows['id'];
                                        $product_name = $rows['product_name'];
                                        $product_quantity_sale = $rows['product_quantity_sale'];
                                        $companyName = $rows['companyName'];
                                        $price = $rows['price'];
                                        $purchase_price = $rows['purchase_price'];
                                        $total_quantity_rate = $product_quantity_sale * $price;
                                        if($product_quantity_sale == ""){
                                            $product_quantity_sale = 0;
                                        }    

                                        if($purchase_price == ""){
                                           $purchase_price = 0;
                                        }

                                        $total_purchase_amount = $product_quantity_sale * $purchase_price; 

                                        $profit_amount =  $total_quantity_rate -  $total_purchase_amount; 

                                        $grand_total_quantity_rate += $total_quantity_rate;
                                        $grand_profit_amount += $profit_amount;


                                       echo"<tr> 
                                          <td>$count</td>
                                          <td>$product_name</td>
                                          <td>$companyName</td>
                                          <td>$product_quantity_sale</td>
                                          <td>$purchase_price</td>
                                          <td>$price</td>
                                          <td>$profit_amount</td>
                                          <td>$total_quantity_rate</td>
                                         </tr>";
                                    $count++;

                                    }
                                    echo "<tr> 
                                          <td colspan='6'><b>Grand Total:</b></td>
                                          <td><b>$grand_profit_amount</b></td>
                                          <td><b>$grand_total_quantity_rate</b></td>
                                         </tr>";
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
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
        <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/libs/timepicker/timepicker.js"></script>
    <script src="assets/libs/minicolors/minicolors.js"></script>
    <!-- Demo -->
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/tables_datatables.js"></script>
    <script src="assets/js/toastr.js"></script>
     <script src="assets/js/pages/forms_pickers.js"></script>
    
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
        <script src="assets/js/spdf.plugin.autotable.js"></script> -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> 
    
    

    
    
</body>
</html>

<script>
	$('.company').select2();
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
    


var select_company; 
 $("body").on("change", ".company", function (event) {
   select_company =  $(this).val();
   //alert(select_company);
    $(".table-bordered tbody").empty();
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?select_company_by_inventory='+select_company,  
            success: function (data) {
          			$(".table-bordered tbody").html(data);
            },
            error: function(data){
               console.log("error");
           }
          });
    
 })      
   

    
$('.print_button').on('click',function(){
    if(select_company == undefined){
      select_company = 0;
    }
    window.open(
'inventory-report-print.php?select_company_stock_print='+select_company,
'_blank' // <- This is what makes it open in a new window.
);

})




   var start_date;
   var  end_date;
$('.fetch_by_date').on('click',function(){
	 start_date =  $('.start_date').val();
	  end_date =  $('.end_date').val();
	if(start_date == "" && end_date == ""){
		alert("Please select date");
	}else{
		//alert(select_company);
		 $(".table-bordered tbody").empty();
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?get_company_name='+select_company+"&start_date="+start_date+"&end_date="+end_date,  
            success: function (data) {
            	$(".table-bordered tbody").html(data);
            },
            error: function(data){
               console.log("error");
           }
          });

	}
})  

$('.export').on('click',function(){
    start_date =  $('.start_date').val();
      end_date =  $('.end_date').val();
       window.open(
      'export_report.php?get_company_name='+select_company+"&start_date="+start_date+"&end_date="+end_date,
      '_blank' // <- This is what makes it open in a new window.
    );

}) 

 
 
</script>
