<?php
    ob_start();
	session_start();
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    $totalExpenses = "0:00";
    $year = date("Y");
    $year = explode("0",$year);
    $shipment_code_random = "NC/" . $year[1] ."/". mt_rand(100000, 999999);
    if($_POST){
        
        $vendor_name = $_POST['vendor_name']; 
        $vendor_address = $_POST['vendor_address'];
        $date = $_POST['date'];
        $invoice_number = $_POST['invoice_number'];
        $number_of_carton = $_POST['number_of_carton'];
        $gross_weight = $_POST['gross_weight'];
        $net_weight = $_POST['net_weight'];
        $shipment_cost = $_POST['shipment_cost'];
        $shipper_name = $_POST['shipper_name'];
        $shipper_address = $_POST['shipper_address'];
        $freight_company = $_POST['freight_company'];
        $custom_agency = $_POST['custom_agency'];
        $godown_name = $_POST['godown_name'];
        $freightCompanyCharges = $_POST['freightCompanyCharges'];
        $agencyCharges = $_POST['agencyCharges'];
        $pODutyCharges = $_POST['pODutyCharges'];
        $pOTaxesCharges = $_POST['pOTaxesCharges'];
        $localFreightCharges = $_POST['localFreightCharges'];
        $localLabourCharges = $_POST['localLabourCharges'];
        $pOForeignCharges = $_POST['pOForeignCharges'];
        $extraCharges = $_POST['extraCharges'];
        $customExaminationCharges = $_POST['customExaminationCharges'];
        $totalExpenses = $_POST['totalExpenses'];
        
         if(@$_GET['id']){
            $shipmentID = @$_GET['id'];
            $insert_query = "UPDATE `shipment` SET `vendor_name`='$vendor_name',`vendor_address`='$vendor_address',`date`='$date',`invoice_number`='$invoice_number',`number_of_carton`='$number_of_carton',`gross_weight`='$gross_weight',`net_weight`='$net_weight',`shipment_cost`='$shipment_cost',`shipper_name`='$shipper_name',`shipper_address`='$shipper_address',`freight_company`='$freight_company',`custom_agency`='$custom_agency',`godown_name`='$godown_name',`freightCompanyCharges`='$freightCompanyCharges',`agencyCharges`='$agencyCharges',`pODutyCharges`='$pODutyCharges',`pOTaxesCharges`='$pOTaxesCharges',`localFreightCharges`='$localFreightCharges',`localLabourCharges`='$localLabourCharges',`pOForeignCharges`='$pOForeignCharges',`extraCharges`='$extraCharges',`customExaminationCharges`='$customExaminationCharges',`totalExpenses`='$totalExpenses',`time_stamp`=now() WHERE id ='$shipmentID'";
        
             
         }else{
              $insert_query = "INSERT INTO `shipment`(`vendor_name`, `vendor_address`, `date`, `invoice_number`, `number_of_carton`, `gross_weight`, `net_weight`, `shipment_cost`, `shipper_name`, `shipper_address`, `freight_company`, `custom_agency`, `godown_name`, `freightCompanyCharges`, `agencyCharges`, `pODutyCharges`, `pOTaxesCharges`, `localFreightCharges`, `localLabourCharges`, `pOForeignCharges`, `extraCharges`, `customExaminationCharges`, `totalExpenses`, `time_stamp`) VALUES ('$vendor_name','$vendor_address','$date','$invoice_number','$number_of_carton','$gross_weight','$net_weight','$shipment_cost','$shipper_name','$shipper_address','$freight_company','$custom_agency','$godown_name','$freightCompanyCharges','$agencyCharges','$pODutyCharges','$pOTaxesCharges','$localFreightCharges','$localLabourCharges','$pOForeignCharges','$extraCharges','$customExaminationCharges','$totalExpenses',now())";     
         }
            $stmt = $dbh->prepare($insert_query);
            $stmt->execute(); 
        
        header("Location:shipment.php");
        
        
    }else{
        if(@$_GET['id']){
            $shipmentID = @$_GET['id'];
            
            
            $fetch_query = "SELECT * FROM `shipment` where id ='$shipmentID'";
            $sth = $dbh->prepare($fetch_query);
            $result = $sth->execute();
            $rows = $sth->fetch(PDO::FETCH_ASSOC);
             $vendor_name = $rows['vendor_name']; 
            $vendor_address = $rows['vendor_address'];
            $date = $rows['date'];
            $invoice_number = $rows['invoice_number'];
            $number_of_carton = $rows['number_of_carton'];
            $gross_weight = $rows['gross_weight'];
            $net_weight = $rows['net_weight'];
            $shipment_cost = $rows['shipment_cost'];
            $shipper_name = $rows['shipper_name'];
            $shipper_address = $rows['shipper_address'];
            $freight_company = $rows['freight_company'];
            $custom_agency = $rows['custom_agency'];
            $godown_name = $rows['godown_name'];
            $freightCompanyCharges = $rows['freightCompanyCharges'];
            $agencyCharges = $rows['agencyCharges'];
            $pODutyCharges = $rows['pODutyCharges'];
            $pOTaxesCharges = $rows['pOTaxesCharges'];
            $localFreightCharges = $rows['localFreightCharges'];
            $localLabourCharges = $rows['localLabourCharges'];
            $pOForeignCharges = $rows['pOForeignCharges'];
            $extraCharges = $rows['extraCharges'];
            $customExaminationCharges = $rows['customExaminationCharges'];
            $totalExpenses = $rows['totalExpenses'];   
        }
    }



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
                        <h4 class="font-weight-bold py-3 mb-0">Shipment Details</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">New Shipment</li>
                            </ol>
                        </div>



                        <div class="card mb-4">
                            <h3 class="card-header" align="Center"><i class="fas fa-shipping-fast" style="font-size:35px; "></i> &nbsp; New Shipment</h3>
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-row">

                                    <div class="form-group col-md-3">
                                     <label class="form-label">Vendor Name</label>
                                     <input type="text" class="form-control" name="vendor_name" value="<?php echo @$vendor_name;  ?>" required placeholder="Complete Name">
                                     <div class="clearfix"></div>
                                    </div>                                    

                                   <div class="form-group col-md-3">
                                   <label class="form-label">Vendor Address</label>
                                     <input type="text" class="form-control" name="vendor_address" value="<?php echo @$vendor_address;  ?>" required placeholder="Complete Address">
                                     <div class="clearfix"></div>
                                    </div>

                                   <div class="form-group col-md-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control"  name="date" required value="<?php echo @$date;  ?>" id="datepicker-features">
                                    </div>    

                                    <div class="form-group col-md-3">
                                            <label class="form-label">Invoice#</label>
                                            <input type="text" class="form-control" name="invoice_number" value="<?php echo @$shipment_code_random;  ?>"  required readonly placeholder="NS/PPI/00000000001">
                                            <div class="clearfix"></div>
                                    </div>
                                </div>
<BR>
                                  <div class="form-row">
                                      <div class="form-group col-md-5">
                                          <h4 class="card-header" align="Center"><i class="oi oi-pencil" style="font-size:20px; "></i> &nbsp;Shipment Details</h4><br>
                                     <label class="form-label">No# of Cartons</label>
                                     <input type="text" class="form-control" name="number_of_carton" value="<?php echo @$number_of_carton;  ?>" placeholder="Total Cartons"><br>

                                     <label class="form-label">Gross Weight</label>
                                     <input type="text" class="form-control" name="gross_weight" value="<?php echo @$gross_weight;  ?>" placeholder="Total Gross Weight"><br>

                                     <label class="form-label">Net Weight</label>
                                     <input type="text" class="form-control" name="net_weight" value="<?php echo @$net_weight;  ?>" placeholder="Total Net Weight"><br>

                                     <label class="form-label">Shipment Cost</label>
                                     <input type="text" class="form-control" name="shipment_cost" value="<?php echo @$shipment_cost;  ?>" placeholder="Total Cost"><br>

                                     <label class="form-label">Shipper Name</label>
                                     <input type="text" class="form-control" name="shipper_name" value="<?php echo @$shipper_name;  ?>" placeholder="Shipper Name"><br>

                                     <label class="form-label">Shipper Address</label>
                                     <input type="text" class="form-control" name="shipper_address" value="<?php echo @$shipper_address;  ?>" placeholder="Shipper Address"><br>

                                     <label class="form-label">Freight Company</label>
                                     <input type="text" class="form-control" name="freight_company" value="<?php echo @$freight_company;  ?>" placeholder="Company Name"><br>

                                     <label class="form-label">Custom Agency</label>
                                     <input type="text" class="form-control" name="custom_agency" value="<?php echo @$custom_agency;  ?>" placeholder="Agency Name"><br>

                                     <label class="form-label">Godown Name</label>
                                     <input type="text" class="form-control" name="godown_name" value="<?php echo @$godown_name;  ?>" placeholder="Godown Name"><br>
                                          
                                          
<!--
                                     <label class="form-label"></label>
                                          <button type="button" class="btn btn-primary btn-lg custom_button_align add_items">Add Item</button><br>   <br> <br>    
                                         
                                    <div class="custom_items"></div>     
-->
                                      </div>


                                        <div class="form-group col-md-1"></div>

                                      <div class="form-group col-md-6">
                                           <h4 class="card-header" align="Center"><i class="fas fa-dollar-sign" style="font-size:25px; "></i> &nbsp;Shipment Expenses</h4><br>
                                           <label class="form-label">Freight Company Charges</label>
                                           <input type="number" class="form-control freightCompanyCharges" value="<?php echo @$freightCompanyCharges;  ?>" name="freightCompanyCharges"  placeholder="Freight Charges"><br>

                                            <label class="form-label">Agency Charges</label>
                                           <input type="number" class="form-control agencyCharges" name="agencyCharges" value="<?php echo @$agencyCharges;  ?>"  placeholder="Agency Charges"><br>

                                            <label class="form-label">P/O Duty Charges </label>
                                           <input type="number" class="form-control pODutyCharges" name="pODutyCharges" value="<?php echo @$pODutyCharges;  ?>"  placeholder="Duty Charges"><br>

                                            <label class="form-label">P/O Taxes Charges</label>
                                           <input type="number" class="form-control pOTaxesCharges" name="pOTaxesCharges" value="<?php echo @$pOTaxesCharges;  ?>" placeholder="Tax Charges"><br>

                                            <label class="form-label">Local Freight Charges</label>
                                           <input type="number" class="form-control localFreightCharges" value="<?php echo @$localFreightCharges;  ?>" name="localFreightCharges" placeholder="Local Freight"><br>

                                            <label class="form-label">Local Labour Charges</label>
                                           <input type="number" class="form-control localLabourCharges" value="<?php echo @$localLabourCharges;  ?>" name="localLabourCharges"  placeholder="Labour Charges"><br>

                                            <label class="form-label">P/O Foreign Charges</label>
                                           <input type="number" class="form-control pOForeignCharges" value="<?php echo @$pOForeignCharges;  ?>" name="pOForeignCharges"  placeholder="Foreign Charges"><br>

                                            <label class="form-label">Extra Charges</label>
                                           <input type="number" class="form-control extraCharges" value="<?php echo @$extraCharges;  ?>"  name="extraCharges" placeholder="Extra Charges"><br>

                                            <label class="form-label">Custom Examination Charges</label>
                                           <input type="number" class="form-control customExaminationCharges" value="<?php echo @$customExaminationCharges;  ?>" name="customExaminationCharges" placeholder="Custom Charges"><br><br><br><br>

                                            <div class="form-group row">
                                            <div class="col-sm-4"></div> 
                                            <label class="col-form-label col-form-label col-sm-2 text-sm-center" align="">Total Net Expenses</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg totalExpenses" name="totalExpenses"   value="<?php echo @$totalExpenses;  ?>" placeholder="" readonly="">
                                                    <div class="clearfix"></div>
                                                </div>


                                                    </div><br>
                                      </div>

                                  </div>
                                    </BR>
                                        <div class="form-group" align="right">
                                            <div class="col-sm-offset-8 col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
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
    <script src="assets/js/jquery-3.3.1.min.js"></script>
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
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:22 GMT -->
</html>

<script>
    
    $(function(){
            $('.freightCompanyCharges, .agencyCharges, .pODutyCharges,.pOTaxesCharges,.localFreightCharges,.localLabourCharges,.pOForeignCharges,.extraCharges,.customExaminationCharges').keyup(function(){
               var freightCompanyCharges = parseFloat($('.freightCompanyCharges').val()) || 0;
               var agencyCharges = parseFloat($('.agencyCharges').val()) || 0;
               var pODutyCharges = parseFloat($('.pODutyCharges').val()) || 0;
               var pOTaxesCharges = parseFloat($('.pOTaxesCharges').val()) || 0;
                var localFreightCharges = parseFloat($('.localFreightCharges').val()) || 0;
               var localLabourCharges = parseFloat($('.localLabourCharges').val()) || 0;
                var pOForeignCharges = parseFloat($('.pOForeignCharges').val()) || 0;
               var extraCharges = parseFloat($('.extraCharges').val()) || 0;
                var customExaminationCharges = parseFloat($('.customExaminationCharges').val()) || 0;
                
                $('.totalExpenses').val(freightCompanyCharges + agencyCharges + pODutyCharges + pOTaxesCharges + localFreightCharges + localLabourCharges+pOForeignCharges + extraCharges + customExaminationCharges);
            });
         });
    
       
        $('.add_items').on('click',function(){
             var lenghtCount = parseInt($('.form-row').last().find('.add-shipment-main a').text().split(' ')[3]) + 1;
            if(isNaN(lenghtCount)){
                lenghtCount = 1;
            }else{
                lenghtCount;
            }
            $('.custom_items').append('<div class="form-row"><div class="form-group col-md-8 add-shipment-main"><label class="form-label"><a>Item Description # '+lenghtCount+'</a></label><select class="select2-demo form-control" style="width: 100%" data-allow-clear="true"><option>Select Item</option>\
                <?php                       
                    $fetch_query = "SELECT * FROM `products`";
                    $sth = $dbh->prepare($fetch_query);
                    $result = $sth->execute();
                    while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                       $id = $rows['id'];
                       $product_name = $rows['product_name'];
                        echo '<option value ='.$id.'>'.$product_name.'</option>';
                    }
                ?>
            \</select></div><div class="form-group col-md-4"><br><input onKeyUp = "calculateSum()" type="text" class="form-control total_weight" placeholder="Total"></div></div></div>'); 
            $('.select2-demo').select2();
        })  



    $(document).ready(function() {

      //iterate through each textboxes and add keyup
      //handler to trigger sum event
      $(".total_weight").each(function() {

        $(this).keyup(function() {
          calculateSum();
        });
      });

    });

    function calculateSum() {

      var sum = 0;
      //iterate through each textboxes and add the values
      $(".total_weight").each(function() {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseFloat(this.value);
        }

      });
      //.toFixed() method will roundoff the final sum to 2 decimal places

      $(".totalNetExpense").html(sum.toFixed(2));
    }



    var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         




</script>
