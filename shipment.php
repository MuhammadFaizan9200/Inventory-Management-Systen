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
    <title>Shipment | Ppipopular</title>

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
    
    <link rel="stylesheet" href="https://linkedunion.org/theme/css/slidebars.css">
    
    
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
    .slidebar-table th {
        padding: 20px 0px !important;
    }
    .slidebar-table td {
        padding: 10px 0px !important;
    }
    .slidebar-table tr {
        border-bottom: 1px solid #f2efef;
    }
    .slidebar-table tr:last-child {
        border-bottom: none;
    }
button.close{         
    top: 0px !important;
    right: 0px !important;
    cursor: pointer !important;;
    font-size: 30px;
    padding-top: 0px !important;
    width: auto;
    height: auto;
    line-height: 35px;
    opacity: 0.9;
    font-weight: bold;
    color: #3a3a3a;
    padding-left: 0px !important;
    margin-top: 0px !important;
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
             
                    
                
    
<div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <div class="row" style="padding: 2px 0px 0px;">
                   <div class="form-row" style="width:100%">

                                    <div class="form-group col-md-3">
                                     <label class="form-label">Vendor Name</label>
                                     <input type="text" class="form-control vendor_name" readonly name="vendor_name"  required placeholder="Complete Name">
                                     <div class="clearfix"></div>
                                    </div>                                    

                                   <div class="form-group col-md-3">
                                   <label class="form-label">Vendor Address</label>
                                     <input type="text" class="form-control vendor_address" readonly name="vendor_address"  required placeholder="Complete Address">
                                     <div class="clearfix"></div>
                                    </div>

                                   <div class="form-group col-md-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control date" readonly  name="date" required  id="datepicker-features">
                                    </div>    

                                    <div class="form-group col-md-2">
                                            <label class="form-label">Invoice#</label>
                                            <input type="text" class="form-control invoice_number" readonly name="invoice_number"  required readonly placeholder="NS/PPI/00000000001">
                                            <div class="clearfix"></div>
                                    </div>
                       <div class="col-md-1">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                                </div>
<BR>
                                  <div class="form-row" style="width:100%">
                                      <div class="form-group col-md-5">
                                          <h4 class="card-header" align="Center"><i class="oi oi-pencil" style="font-size:20px; "></i> &nbsp;Shipment Details</h4><br>
                                     <label class="form-label">No# of Cartons</label>
                                     <input type="text" class="form-control number_of_carton" readonly name="number_of_carton"  placeholder="Total Cartons"><br>

                                     <label class="form-label">Gross Weight</label>
                                     <input type="text" class="form-control gross_weight" readonly name="gross_weight"  placeholder="Total Gross Weight"><br>

                                     <label class="form-label">Net Weight</label>
                                     <input type="text" class="form-control net_weight" readonly name="net_weight" placeholder="Total Net Weight"><br>

                                     <label class="form-label">Shipment Cost</label>
                                     <input type="text" class="form-control shipment_cost" readonly name="shipment_cost"  placeholder="Total Cost"><br>

                                     <label class="form-label">Shipper Name</label>
                                     <input type="text" class="form-control shipper_name" readonly name="shipper_name" placeholder="Shipper Name"><br>

                                     <label class="form-label">Shipper Address</label>
                                     <input type="text" class="form-control shipper_address" readonly name="shipper_address" placeholder="Shipper Address"><br>

                                     <label class="form-label">Freight Company</label>
                                     <input type="text" class="form-control freight_company" readonly name="freight_company"  placeholder="Company Name"><br>

                                     <label class="form-label">Custom Agency</label>
                                     <input type="text" class="form-control custom_agency" readonly name="custom_agency" placeholder="Agency Name"><br>

                                     <label class="form-label">Godown Name</label>
                                     <input type="text" class="form-control godown_name" readonly name="godown_name" placeholder="Godown Name"><br>
                                          
                                    
                                      </div>


                                        <div class="form-group col-md-1"></div>

                                      <div class="form-group col-md-6">
                                           <h4 class="card-header" align="Center"><i class="fas fa-dollar-sign" style="font-size:25px; "></i> &nbsp;Shipment Expenses</h4><br>
                                           <label class="form-label">Freight Company Charges</label>
                                           <input type="number" class="form-control freightCompanyCharges" value="<?php echo @$freightCompanyCharges;  ?>" readonly name="freightCompanyCharges"  placeholder="Freight Charges"><br>

                                            <label class="form-label">Agency Charges</label>
                                           <input type="number" class="form-control agencyCharges" name="agencyCharges" value="<?php echo @$agencyCharges;  ?>"  readonly placeholder="Agency Charges"><br>

                                            <label class="form-label">P/O Duty Charges </label>
                                           <input type="number" class="form-control pODutyCharges" name="pODutyCharges" value="<?php echo @$pODutyCharges;  ?>"  readonly placeholder="Duty Charges"><br>

                                            <label class="form-label">P/O Taxes Charges</label>
                                           <input type="number" class="form-control pOTaxesCharges" name="pOTaxesCharges" value="<?php echo @$pOTaxesCharges;  ?>" readonly placeholder="Tax Charges"><br>

                                            <label class="form-label">Local Freight Charges</label>
                                           <input type="number" class="form-control localFreightCharges" value="<?php echo @$localFreightCharges;  ?>" name="localFreightCharges" readonly placeholder="Local Freight"><br>

                                            <label class="form-label">Local Labour Charges</label>
                                           <input type="number" class="form-control localLabourCharges" value="<?php echo @$localLabourCharges;  ?>" name="localLabourCharges" readonly  placeholder="Labour Charges"><br>

                                            <label class="form-label">P/O Foreign Charges</label>
                                           <input type="number" class="form-control pOForeignCharges" value="<?php echo @$pOForeignCharges;  ?>" name="pOForeignCharges" readonly placeholder="Foreign Charges"><br>

                                            <label class="form-label">Extra Charges</label>
                                           <input type="number" class="form-control extraCharges" value="<?php echo @$extraCharges;  ?>"  name="extraCharges" readonly placeholder="Extra Charges"><br>

                                            <label class="form-label">Custom Examination Charges</label>
                                           <input type="number" readonly class="form-control customExaminationCharges" value="<?php echo @$customExaminationCharges;  ?>" name="customExaminationCharges" placeholder="Custom Charges"><br><br><br>

                                            <div class="form-group row">
                                           
                                            <label class="col-form-label col-form-label col-sm-6" align="">Total Net Expenses</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg totalExpenses" name="totalExpenses"   placeholder="" readonly="">
                                                    <div class="clearfix"></div>
                                                </div>


                                                    </div><br>
                                      </div>

                                  </div>
                                    </BR>
				
                   
                </div>             
            </div>
            
            
            

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        
                    
                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
            
                      <div class="form-row">                          
                        <div class="form-group col-md-4">
                                 <h4 class="font-weight-bold py-3 mb-0">New Shipment</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Shipment</li>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                        <div class="form-group col-md-5"></div>

                        <div class="form-group col-md-3">
                            <h4 class="font-weight-bold py-3 mb-0"></h4>
                             <ol class="breadcrumb">
                               <a href="add-shipment.php"  class="btn btn-primary btn btn-block add_product"  style="width:100%" >Add Shipment</a>
                            </ol>
                             <div class="clearfix"></div>   
                        </div>
                    </div>    
                        

                      
                        <!-- / Filters -->

                        <div class="card mb-4">
                             <h3 class="card-header card-header bg-primary text-white" align="Center"><i class="oi oi-spreadsheet" style="font-size:35px; "></i> &nbsp; Shipment List  </h3>
                             
                            
                            <div class="card-body"  style="border-style: solid; border-color: #716aca;">
                                   <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                                <thead>
                                    <tr>
                                         <th>S#</th>
                                        <th>Vendor Name</th>
                                        <th>Vendor Address</th>
                                        <th>Shipper Name</th>
                                        <th>Date</th>
                                        <th>Invoice #</th>
                                         <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count = 1;
                                            $fetch_query = "SELECT * FROM `shipment`";
                                            $sth = $dbh->prepare($fetch_query);
                                            $result = $sth->execute();
                                            while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                                             $id = $rows['id'];     
                                            $vendor_name = $rows['vendor_name']; 
                                            $vendor_address = $rows['vendor_address'];
                                            $date = $rows['date'];
                                            $invoice_number = $rows['invoice_number'];
                                            $shipper_name = $rows['shipper_name'];
                                           
                                                
                                            echo "<tr>
                                            <td>$count</td>
                                            <td>$vendor_name</td>
                                            <td>$vendor_address</td>
                                             <td> $shipper_name</td>
                                             <td>$date</td>
                                             <td>$invoice_number</td>
                                            <td><a href='add-shipment.php?id=$id'><img src='assets/img/edit.svg' class='edit_category'  style='width: 25px;height: 25px;cursor:pointer'></a></td>
                                           <td><img src='assets/img/delete.svg' id ='$id' class='delete' style='width: 25px;height: 25px;cursor:pointer'></td>
                                           <td><img src='assets/img/view.svg' class='view_shipment_details view_comment'  style='width: 25px;height: 25px;cursor:pointer' id ='$id'></td>
                                           </tr>";
                                           $count++;         
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
<!--<td><img src='assets/img/view.svg' class='view_shipment_details sb-toggle-right sb-toggle-right-active'  style='width: 25px;height: 25px;cursor:pointer' id ='$id'></td>-->
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
    
    <script src="https://linkedunion.org/theme/js/slidebars.min.js"></script>
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
    
     $('body').on('click','.comment_box,.view_comment',function(e){
        var shipmentID = this.id;
        $('#support').modal('show');
       
        $.ajax({
            type: 'post',
            url: 'fetch_shipment_data.php?shipmentID='+shipmentID,
            success: function (data,status) {
                var obj = jQuery.parseJSON(data);
                var vendor_id = obj.id;
                var vendor_name = obj.vendor_name;
                
                
               $('.vendor_name').val(obj.vendor_name);
                $('.vendor_address').val(obj.vendor_address);
                $('.date').val(obj.date);
                $('.invoice_number').val(obj.invoice_number);
                $('.number_of_carton').val(obj.number_of_carton);
                $('.gross_weight').val(obj.gross_weight);
                $('.net_weight').val(obj.net_weight);
                $('.shipment_cost').val(obj.shipment_cost);
                $('.shipper_name').val(obj.shipper_name);
                $('.shipper_address').val(obj.shipper_address);
                $('.freight_company').val(obj.freight_company);
                $('.custom_agency').val(obj.freight_company);
                $('.godown_name').val(obj.godown_name);
                $('.freightCompanyCharges').val(obj.freightCompanyCharges);
                $('.agencyCharges').val(obj.agencyCharges);
                $('.pODutyCharges').val(obj.pODutyCharges);
                $('.pOTaxesCharges').val(obj.pOTaxesCharges);
                $('.localFreightCharges').val(obj.localFreightCharges);
                $('.localLabourCharges').val(obj.localLabourCharges);
                $('.pOForeignCharges').val(obj.pOForeignCharges);
                $('.extraCharges').val(obj.extraCharges);
                $('.customExaminationCharges').val(obj.customExaminationCharges);
                $('.totalExpenses').val(obj.totalExpenses);
                
            },
            error: function(data){
               console.log("error");
           }
          });
         

    })

   
    
     $(function(){
         $.slidebars();
    }); 
    
    
   // $("table").on("click", ".view_shipment_details", function (event) {    
     $('.view_shipment_details').on('click',function(){
           $('.sb-slidebar').css({"-webkit-transform":"-876.844px"});
            var ID = this.id;
            var $this = $(this); 
        })  

// $("table").on("click", ".remove_slide", function (event) {    
    $('.remove_slide').on('click',function(){
       $('.sb-slidebar').removeClass('sb-active');
        $('.sb-slidebar').css({"-webkit-transform":"translate(0px)"});
        
       
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
    
    
   
    <?php
        if(@$_GET['id']){
          echo "showmessage('success','Product Update Successfully','Success')";  
        }
    ?>
    

 
 
    
    $("table").on("click", ".delete", function (event) {
                if (confirm("Are you sure you want to delete this Shipment?")) {
                    var ID = this.id;
                     var $this = $(this); 
                    $.get("delete.php?shipmentID="+ID, function (data, status) {
                        if (status == 'success') {
                            var Row = $this.closest('tr');
                              var tr = $this.parents('tr');
                              var nRow = Row[0];
                            showmessage('warning','Shipment Delete Successfully','Success');  
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
