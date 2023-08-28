<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();



if(@$_GET['shipmentID']){
        $shipmentID = $_GET['shipmentID'];
            $fetch_query = "SELECT * FROM `shipment` where id = '$shipmentID'";
            $sth = $dbh->prepare($fetch_query);
            $result = $sth->execute();
            $rows = $sth->fetch(PDO::FETCH_ASSOC);
            $id = $rows['id'];
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
    
    
            $temparray['id']= $id;
            $temparray['vendor_name']= $vendor_name;
            $temparray['date']= $date;
            $temparray['invoice_number']= $invoice_number;
            $temparray['number_of_carton']= $number_of_carton;
            $temparray['gross_weight']= $gross_weight;
            $temparray['net_weight']= $net_weight;
            $temparray['shipment_cost']= $shipment_cost;
            $temparray['shipper_name']= $shipper_name;
            $temparray['shipper_address']= $shipper_address;
            $temparray['freight_company']= $freight_company;
            $temparray['custom_agency']= $custom_agency;
            $temparray['godown_name']= $godown_name;
            $temparray['godown_name']= $godown_name;
            $temparray['freightCompanyCharges']= $freightCompanyCharges;
            $temparray['agencyCharges']= $agencyCharges;
            $temparray['pODutyCharges']= $pODutyCharges;
            $temparray['pOTaxesCharges']= $pOTaxesCharges;
            $temparray['localFreightCharges']= $localFreightCharges;
            $temparray['localLabourCharges']= $localLabourCharges;
            $temparray['pOForeignCharges']= $pOForeignCharges;
            $temparray['extraCharges']= $extraCharges;
            $temparray['customExaminationCharges']= $customExaminationCharges;
            $temparray['totalExpenses']= $totalExpenses;
             $returnArray = $temparray;

}
 
 echo json_encode($returnArray);  
exit;    
?>
		