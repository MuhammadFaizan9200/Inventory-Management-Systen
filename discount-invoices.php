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
    <title>Daily Sale Report | Ahmed Traders</title>

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
                        <h4 class="font-weight-bold py-3 mb-0">Sale Report By Discounts</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Sale Report By Discounts</li>
                            </ol>
                        </div>

                        <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp;Filter By Company</h3>
                                 <div class="card-body"  style="border-style: solid; border-color: #716aca;"> 
                                  <div class="form-row">

                                    <div class="form-group col-md-4">
                                     <label class="form-label form-label-lg">Company Name</label>
                                     <select class="select2 form-control company" style="width: 100%" data-allow-clear="true">
                                            <option value="0">Choose Company</option>
                                            <?php
                                            $fetch_category = "SELECT * FROM `company` WHERE status = 0";
                                            $stht = $dbh->prepare($fetch_category);
                                            $result = $stht->execute();
                                            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                  $company_id = $rowss['id'];
                                                 $company_name = $rowss['company_name'];
                                                echo '<option value="'.$company_id.'">'.$company_name.'</option>';    
                                                 }   
                                            ?>
                                        </select>
                                     <div class="clearfix"></div>
                                    </div>  

                                  <div class="form-group col-md-3">
                                   <label class="form-label">To</label>
                                        <input type="text" id="" class="form-control b-m-dtp-date start_date" placeholder="To">
                                        <div class="clearfix"></div>
                                </div>

                                <div class="form-group col-md-3">
                                   <label class="form-label">From</label>
                                        <input type="text"  class="form-control b-m-dtp-date end_date" placeholder="From">
                                        <div class="clearfix"></div>
                                </div>


                                </div>
                                    <input type="hidden" name="sess_user_id" value="<?php echo $_SESSION['user_id'] ?>">   
                                     <input type="hidden" name="form_submit" value="insert_category">   
                                     <div class="form-row">       
                                        <div class="form-group col-sm-4">
                                                <button class="btn btn-primary btn-lg btn-block fetch_by_date" type="button">Fetch By Date</button>
                                        </div>
                                         <div class="form-group col-sm-4">
                                                <button class="btn btn-secondary btn-lg btn-block export" type="button">Export</button>
                                        </div>
                                    </div>
                                </div>
                            </div>         
                       
                        <!-- / Filters -->

                        <div class="card">
                             <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Daily Sale Report List</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                  <div class="table-responsive">
                        <div class="table-responsive custom_datatable">                     
                            <table class="table table-bordered" style="width:100%;margin:auto;text-align:left;" >
                                <thead>
                                    <tr>
                                        <th style="width:25px;">S No</th>
                                        <th>Invoice Date</th>
                                        <th>Invoice Number</th>
                                        <th>Customer Name</th>
                                        <th>Company Name</th>
                                        <th>Total Amount</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    	$date = gmdate("Y-m-d");
                              $fetch_query = "SELECT sid.* ,s.invoiceNumber,s.invoiceDate ,(SELECT product_name from products where id = sid.insert_productName) as productName ,(SELECT customer_name from customer where id = sid.customer_id) as customerName  ,(SELECT company_name from company where id = sid.`company_id`) as companyName ,(SELECT totalNetAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as totalNetAmount  ,(SELECT grossAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as grossAmount FROM `sale_invoice_details` sid , sale_invoice s WHERE s.id = sid.`sale_invoice_id` and s.invoiceDate = '$date' AND sid.discount > 0 GROUP by s.invoiceNumber order by s.invoiceDate asc , sid.id desc";
                                        $sth = $dbh->prepare($fetch_query);
                                       // var_dump($fetch_query);
                                        $result = $sth->execute();
                                        $count = 1;
                                        $grand_total_quantity = 0;
                                        $grand_list_price = 0;
                                        $grand_discount = 0;
                                        $grand_net_amount = 0;
                                        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                            $id = $rows['id'];
                                            $invoiceDate = $rows['invoiceDate'];
                                            $invoiceNumber = $rows['invoiceNumber'];
                                            $productName = $rows['productName'];
                                            $companyName = $rows['companyName'];
                                            $customerName = $rows['customerName'];
                                            $list_price = $rows['list_price'];
                                            $discount = $rows['discount'];
                                            $totalNetAmount =$rows['totalNetAmount'];
                                            $grossAmount =$rows['grossAmount'];
                                            $grand_list_price += $list_price;
                                            $grand_discount  += $discount;
                                        $grand_net_amount += $totalNetAmount;
                                       echo"<tr> 
                                          <td>$count</td>
                                          <td>$invoiceDate</td>
                                          <td>$invoiceNumber</td>
                                          <td>$customerName</td>
                                          <td>$companyName</td>
                                          <td>$grossAmount</td>
                                           <td>$discount%</td>
                                          <td>$totalNetAmount</td>
                                         </tr>";
                                    $count++;

                                    }
                                    echo "<tr> 
                                          <td colspan='7'><b>Grand Total:</b></td>
                                          <td><b>$grand_net_amount</b></td>
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


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
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
   //alert(select_company)
    $(".table-bordered tbody").empty();
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?select_company_bydiscount='+select_company,  
            success: function (data) {
                console.log(data);
          			$(".table-bordered tbody").html(data);
            },
            error: function(data){
               console.log("error");
           }
          });
    
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
            url: 'fetch_ajax.php?get_company_name_discount_data='+select_company+"&start_date="+start_date+"&end_date="+end_date,  
            success: function (data) {
                console.log(data);
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
    if(start_date == "" && end_date == ""){
        alert("Please select date");
    }else{  
       window.open(
      'export_report_discount.php?get_company_name_dis='+select_company+"&start_date="+start_date+"&end_date="+end_date,
      '_blank' // <- This is what makes it open in a new window.
    );
   }
}) 

 
 
</script>
