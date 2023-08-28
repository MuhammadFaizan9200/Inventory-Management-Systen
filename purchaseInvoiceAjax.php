<?php
    include("headers/connect.php");
    include("headers/_user-details.php");


    
    $invoiceNumber = $_POST['invoiceNumber'];
    $date = $_POST['date'];
    $foreignCurrency = $_POST['foreignCurrency'];
        
    $vendorName = $_POST['vendorName'];
    $vendorAddress = $_POST['vendorAddress'];
    $contactPerson  = $_POST['contactPerson'];
    $contactNumber = $_POST['contactNumber'];
    $totalItem = $_POST['totalItem'];
    $totalQuantity = $_POST['totalQuantity'];
 

    $categoryName = $_POST['categoryName'];
    $productName = $_POST['productName'];
    $fcPrice = $_POST['fcPrice'];
    $quantity = $_POST['quantity'];
    $priceInPkt = $_POST['priceInPkt'];
    $perPeace = $_POST['perPeace']; 
    $netCost = $_POST['netCost'];
    $netAmount = $_POST['netAmount'];
     
    $totalAmountInFc = $_POST['totalAmountInFc'];
    $totalFreight = $_POST['totalFreight'];
    $totalPkrAmount = $_POST['totalPkrAmount'];
    $totalAmount = $_POST['totalAmount'];

    $previousQuantity = $_POST['previousQuantity'];

        $insert_query = "INSERT INTO `purchase_invoice`(`purchase_invoice_#`, `date`, `foreighn_currency`,`vendorName`,`vendorAddress`,`contactPerson`,`contactNumber`,`totalItem`,`totalQuantity`, `time_stamp`,`created_by`,`created_time`) VALUES ('$invoiceNumber','$date','$foreignCurrency','$vendorName','$vendorAddress','$contactPerson','$contactNumber','$totalItem','$totalQuantity',now(),'$user_id',now())";
        $stmt = $dbh->prepare($insert_query);
         $stmt->execute();
        $invoice_id = $dbh->lastInsertId(); 


        foreach($categoryName as $key=>$value){
            
            $categoryNameValue = $categoryName[$key];
            $productNameValue = $productName[$key];
            $fcPriceValue =  $fcPrice[$key];
            $quantityValue =  $quantity[$key];
            $totalPkrValue =  $priceInPkt[$key];
            $perPeaceValue = $perPeace[$key];
            $netCostValue = $netCost[$key];
            $netAmountValue =$netAmount[$key];
            $previousQuantityValue =$previousQuantity[$key];
            
            $totalQuantity = $previousQuantityValue + $quantityValue;
            
            $insert_query_details = "INSERT INTO `purchase_invoice_details`(`categoryID`, `productID`, `priceOfFc`, `quantity`, `priceInPkr`, `freightCost`, `netCost`, `netAmount`, `purchase_invoice_id`, `time_stamp`) VALUES ('$categoryNameValue','$productNameValue','$fcPriceValue','$quantityValue','$totalPkrValue','$perPeaceValue','$netCostValue','$netAmountValue','$invoice_id',now())";
            $stmtt = $dbh->prepare($insert_query_details);
            $stmtt->execute();
            $details_id = $dbh->lastInsertId(); 
            
            
            $update_query = "UPDATE `products` SET `product_quantity`='$totalQuantity' WHERE `id` = '$productNameValue'";
            $upstmt = $dbh->prepare($update_query);
            $upstmt->execute();
            
            
            $query_6th_floor = "INSERT INTO `godown_6th_floor`(`categoryID`, `productID`, `godown_sith_quantity`, `invoice_id`, `time_stamp`,`purchase_invoice_details_id`) VALUES ('$categoryNameValue','$productNameValue','$quantityValue','$invoice_id',now(),'$details_id')";
            $six_stmt = $dbh->prepare($query_6th_floor);
            $six_stmt->execute();
            
            
        }

        $insert_query_details_totals = "INSERT INTO `purchase_invoice_amount_details`(`totalAmountInFc`, `totalFreight`, `totalPkr`, `totalAmount`, `purchaseInvoiceId`) VALUES ('$totalAmountInFc','$totalFreight','$totalPkrAmount','$totalAmount','$invoice_id')";
        $stmttt = $dbh->prepare($insert_query_details_totals);
        $stmttt->execute();
        
      //  print_r($netAmount);
        
        
    




?>