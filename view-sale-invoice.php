<?php

        include("headers/connect.php");
        include("headers/_user-details.php");
        $array = array();
        $temparray = array();
        $returnArray =array();

        $typeArray = array();
    $fetch_query = "SELECT i.*,i.id as invoice_id ,c.* ,c.id as customer_id FROM `sale_invoice` i, customer c WHERE c.id = i.`customer_id` order by i.id desc";
    $sth = $dbh->prepare($fetch_query);
    $result = $sth->execute();
    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
            $typeArray[] = $rows;
    }   



?>
<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
       <title>View Sale Invoice | ppipopular</title>
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

                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
                       <!--  <h4 class="font-weight-bold py-3 mb-0">View Sale Invoice</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">View Sale Invoice</li>
                            </ol>
                        </div> -->


                     <div class="form-row">                          
                        <div class="form-group col-md-4">
                                 <h4 class="font-weight-bold py-3 mb-0">View Sale Invoice</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">View Sale Invoice</li>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                        <div class="form-group col-md-5"></div>

                        <div class="form-group col-md-3">
                            <h4 class="font-weight-bold py-3 mb-0"></h4>
                             <ol class="breadcrumb">
                               <a href="invoice-company.php"  class="btn btn-primary btn btn-block add_product"  style="width:100%" >New Invoice</a>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                    </div>    
                                
                         <div class="card mb-4">
                            <h3 class="card-header bg-primary text-white" align="Center"><i class="feather icon-layers" style="font-size:35px; "></i> &nbsp;Search Invoice</h3>
                                 <div class="card-body"  style="border-style: solid; border-color: #716aca;"> 
                                  <div class="form-row">

                                    
                                 
                                <div class="form-group col-md-12">
                                   <label class="form-label">Search</label>
                                        <input type="text"  class="form-control" id="myInputTextField">
                                        <div class="clearfix"></div>
                                </div>


                                </div>
                                  
                                </div>
                            </div>         

                        <div class="card">
                             <h3 class="card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp;Duplicate Invoice</h3>
                            <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                   <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                        <th style="width:25px;">S No</th>
                                        <th>Customer Name</th>
                                        <th>Invoice #</th>
                                        <th>Invoice Date</th>
                                        <th>Pdf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count =1;
                                    foreach($typeArray as $key => $values){
                                        $invoice_id = $values['invoice_id'];
                                        $customer_name = $values['customer_name'];
                                        $invoiceNumber = $values['invoiceNumber'];
                                        $invoiceCreate = $values['invoiceCreate'];
                                        $invoiceDate = $values['invoiceDate'];
                                        $contactPerson = $values['contactPerson'];
                                        $customer_id = $values['customer_id'];    
                                       $invoiceDateConvert =  date('D d F Y', strtotime($invoiceDate));
                                       echo"<tr> 
                                          <td>$count</td>
                                          <td>$customer_name</td>
                                           <td>$invoiceNumber</td>
                                           <td>$invoiceDateConvert</td>
                                           <td><a target = '_blank' href='invoices-pdf/".$invoiceNumber.".pdf' download><img src='assets/img/view.svg' class='view_shipment_details view_comment'  style='width: 25px;height: 25px;cursor:pointer'></a></td>
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


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:22 GMT -->
</html>

<script>
 
    
    oTable = $('#editable-table').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
    $('#myInputTextField').keyup(function(){
            //console.log("dfsdf");
          oTable.search($(this).val()).draw() ;
    })

    var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         

    $('.show_invoice').on('click',function(){
        
        var customerType = $('.customerType').val();
        var date = $('.date').val();
        var invoiceType = $('.invoiceType').val();
        
       if(customerType != 0 &&  date != "" && invoiceType != 0){
           
           $.ajax({
            type: 'get',
            url: 'view_sale_invoice_ajax.php?customerType='+customerType + "&date="+date +"&invoiceType="+invoiceType,
                  dataType: 'JSON',
            success: function (data) {
              $.each(data, function (key, value) {
                
               $('#datatable').append('<tbody><tr class="tRow"><td><input readonly type="text" value="'+value.productName+'" required class="form-control"></td><td><input readonly type="text" value="'+value.description+'" class="form-control" ></td><td><input readonly type="text" required value="'+value.list_price+'" class="form-control"></td><td><input type="text" readonly  value="'+value.total_quantity+'" class="form-control"></td><td><input type="text" readonly  value="'+value.discount+'" class="form-control"></td><td><input  readonly type="text"  value="'+value.net_price+'" class="form-control"></td><td><input readonly type="text"  value="'+value.net_amount+'" class="form-control"></td></tr></tbody>'); 

                      console.log(value.grossAmount);
                      if(value.grossAmount != null){
                        $('.gross_amount').html(value.grossAmount);     
                      }
                      if(value.totalDiscount != null){
                        $('.totalDiscount').html(value.totalDiscount);
                      }
                       if(value.totalNetAmount != null){
                        $('.totalNetAmount').html(value.totalNetAmount);
                       }
    //                   if(value.previousBalance != null){
    //                    $('.totalPreviousBal').html(value.previousBalance);
    //                   }
                       if(value.amountReceived != null){
                        $('.totalReceivable').html(value.amountReceived);
                       }
                    
                
            });   
                
        
            },
            error: function(data){
               console.log("error");
           }
          });
           
           
           
       }else{
           alert("Slect Customer/Date");
       }
        
    })


</script>
    		