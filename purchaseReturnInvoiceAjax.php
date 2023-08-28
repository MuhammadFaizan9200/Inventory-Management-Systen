<?php
    include("headers/connect.php");
    include("headers/_user-details.php");

if($_GET['invoice_number']){
    $invoice_number = $_GET['invoice_number'];
    $foreignCurrency = $_POST['foreignCurrency'];
        

    $categoryName = $_POST['category_id'];
    $productName = $_POST['product_id_value'];
    $fcPrice = $_POST['fcPrice'];
    $quantity = $_POST['quantity'];
    $return_quantity = $_POST['return_quantity'];
    $priceInPkt = $_POST['priceInPkt'];
    $perPeace = $_POST['perPeace']; 
    $netCost = $_POST['netCost'];
    $netAmount = $_POST['netAmount'];
    $totalAmount = $_POST['totalAmount'];
 
    $remainingQuantity = $quantity - $return_quantity;
    $minuspriceInPkr = $foreignCurrency * $fcPrice;
    
    
    $totalFrightCost =  $remainingQuantity * $perPeace;
    $minuspriceInPkrValues = $remainingQuantity * $minuspriceInPkr;
    
    
    $pluspriceInPkrValue = $minuspriceInPkrValues + $totalFrightCost;
    
    $totalAmountUpdated = $netAmount - $pluspriceInPkrValue;
    
    $totalAmountUpdated = $totalAmount - $totalAmountUpdated;
    
    
    
    $update_query = "UPDATE `purchase_invoice_details` SET `quantity`='$remainingQuantity' ,`netAmount` ='$pluspriceInPkrValue'  WHERE `purchase_invoice_id` = '$invoice_number' and productID = '$productName' and categoryID ='$categoryName'";
    $upstmt = $dbh->prepare($update_query);
    $upstmt->execute(); 


        $update_query_details = "UPDATE `purchase_invoice_amount_details` SET `totalAmount`='$totalAmountUpdated' WHERE `purchaseInvoiceId` = '$invoice_number'";
        $up = $dbh->prepare($update_query_details);
        $up->execute(); 
    
    
        $update_query_godown = "UPDATE `godown_6th_floor` SET `godown_sith_quantity`='$remainingQuantity' WHERE `invoice_id` = '$invoice_number' and productID = '$productName' and categoryID ='$categoryName'";
        $upt = $dbh->prepare($update_query_godown);
        $upt->execute(); 

    
    
  
}


   
?>