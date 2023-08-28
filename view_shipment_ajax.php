<?php

include("headers/connect.php");
include("headers/_user-details.php");


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
       
            $shipmentHtml = ' <div class="form-group col-md-3">
                                     <label class="form-label">Vendor Name</label>
                                     <input type="text" class="form-control" name="vendor_name" value="'.@$vendor_name.'" required placeholder="Complete Name">
                                     <div class="clearfix"></div>
                                    </div>                                    

                                   <div class="form-group col-md-3">
                                   <label class="form-label">Vendor Address</label>
                                     <input type="text" class="form-control" name="vendor_address" value="'.@$vendor_address.'" required placeholder="Complete Address">
                                     <div class="clearfix"></div>
                                    </div>

                                   <div class="form-group col-md-2">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control"  name="date" required value="'.@$date.'" id="datepicker-features">
                                    </div>    

                                    <div class="form-group col-md-2">
                                            <label class="form-label">Invoice#</label>
                                            <input type="text" class="form-control" name="invoice_number" value="'.@$shipment_code_random.'"  required readonly placeholder="NS/PPI/00000000001">
                                            <div class="clearfix"></div>
                                    </div>
                                
              
                           
                                      <div class="form-group col-md-5">
                                          <h4 class="card-header" align="Center"><i class="oi oi-pencil" style="font-size:20px; "></i> &nbsp;Shipment Details</h4><br>
                                     <label class="form-label">No# of Cartons</label>
                                     <input type="text" class="form-control" placeholder="Total Cartons"><br>

                                     <label class="form-label">Gross Weight</label>
                                     <input type="text" class="form-control" placeholder="Total Gross Weight"><br>

                                     <label class="form-label">Net Weight</label>
                                     <input type="text" class="form-control" placeholder="Total Net Weight"><br>

                                     <label class="form-label">Shipment Cost</label>
                                     <input type="text" class="form-control" placeholder="Total Cost"><br>

                                     <label class="form-label">Shipper Name</label>
                                     <input type="text" class="form-control" placeholder="Shipper Name"><br>

                                     <label class="form-label">Shipper Address</label>
                                     <input type="text" class="form-control" placeholder="Shipper Address"><br>

                                     <label class="form-label">Freight Company</label>
                                     <input type="text" class="form-control" placeholder="Company Name"><br>

                                     <label class="form-label">Custom Agency</label>
                                     <input type="text" class="form-control" placeholder="Agency Name"><br>

                                     <label class="form-label">Godown Name</label>
                                     <input type="text" class="form-control" placeholder="Godown Name"><br>
                                          
                                          
                                     
                                         
                                    <div class="custom_items"></div>     
                                      </div>
                                    
                                      


                                    <div class="form-group col-md-1"></div>
                                      <div class="form-group col-md-6">
                                           <h4 class="card-header" align="Center"><i class="fas fa-dollar-sign" style="font-size:25px; "></i> &nbsp;Shipment Expenses</h4><br>
                                           <label class="form-label">Freight Company Charges</label>
                                           <input type="number" class="form-control freightCompanyCharges" value="0" placeholder="Freight Charges"><br>

                                            <label class="form-label">Agency Charges</label>
                                           <input type="number" class="form-control agencyCharges" value="0" placeholder="Agency Charges"><br>

                                            <label class="form-label">P/O Duty Charges </label>
                                           <input type="number" class="form-control pODutyCharges" value="0" placeholder="Duty Charges"><br>

                                            <label class="form-label">P/O Taxes Charges</label>
                                           <input type="number" class="form-control pOTaxesCharges" value="0" placeholder="Tax Charges"><br>

                                            <label class="form-label">Local Freight Charges</label>
                                           <input type="number" class="form-control localFreightCharges" value="0" placeholder="Local Freight"><br>

                                            <label class="form-label">Local Labour Charges</label>
                                           <input type="number" class="form-control localLabourCharges" value="0" placeholder="Labour Charges"><br>

                                            <label class="form-label">P/O Foreign Charges</label>
                                           <input type="number" class="form-control pOForeignCharges" value="0" placeholder="Foreign Charges"><br>

                                            <label class="form-label">Extra Charges</label>
                                           <input type="number" class="form-control extraCharges" value="0" placeholder="Extra Charges"><br>

                                            <label class="form-label">Custom Examination Charges</label>
                                           <input type="number" class="form-control customExaminationCharges" value="0" placeholder="Custom Charges"><br>

                                            <div class="form-group row">
                                           
                                                <label class="col-form-label col-form-label col-sm-8 text-sm-center" align="">Total Net Expenses</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-lg totalExpenses" value="0:00" placeholder="" readonly="">
                                                    <div class="clearfix"></div>
                                                </div>';     
       
        echo $shipmentHtml;
        }
     
?>
		