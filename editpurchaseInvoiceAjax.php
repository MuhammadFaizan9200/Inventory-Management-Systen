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
    $productID = $_POST['productID'];

    $update_categoryName = $_POST['update_categoryName'];
    $update_productName = $_POST['update_productName'];
    $update_fcPrice = $_POST['update_updatefcPrice'];
    $update_quantity = $_POST['update_quantity'];
    $update_priceInPkt = $_POST['update_priceInPkt'];
    $update_perPeace = $_POST['update_perPeace']; 
    $update_netCost = $_POST['update_netCost'];
    $update_netAmount = $_POST['update_netAmount'];
    $productIDPrimaryKey = $_POST['productIDPrimaryKey']; 
    $updatePreviousQuantity = $_POST['updatePreviousQuantity'];


    $insert_categoryName = $_POST['insert_categoryName'];
    $insert_productName = $_POST['insert_productName'];
    $insert_fcPrice = $_POST['insert_fcPrice'];
    $insert_quantity = $_POST['insert_quantity'];
    $insert_priceInPkt = $_POST['insert_priceInPkt'];
    $insert_perPeace = $_POST['insert_perPeace']; 
    $insert_netCost = $_POST['insert_netCost'];
    $insert_netAmount = $_POST['insert_netAmount'];
     
    $totalAmountInFc = $_POST['totalAmountInFc'];
    $totalFreight = $_POST['totalFreight'];
    $totalPkrAmount = $_POST['totalPkrAmount'];
    $totalAmount = $_POST['totalAmount'];
    $invoiceDetailsID = $_POST['invoiceDetailsID'];
    $productsdeleteID = $_POST['productsdeleteID'];
    $updatePreviousQuantityHidden = $_POST['updatePreviousQuantityHidden'];
    //$previousQuantity = $_POST['previousQuantity'];

        $insert_query = "update `purchase_invoice` set `purchase_invoice_#`= '$invoiceNumber', `date` = '$date', `foreighn_currency` = '$foreignCurrency',`vendorName` '$vendorName',`vendorAddress` ='$vendorAddress',`contactPerson` = '$contactNumber' ,`contactNumber` = '$contactNumber',`totalItem` = '$totalItem',`totalQuantity` = '$totalQuantity', `time_stamp` = now(),`created_by` = '$user_id',`created_time` = now() where id '$productID'";
        $stmt = $dbh->prepare($insert_query);
         $stmt->execute();


       

        foreach($update_categoryName as $key => $value){
            
                $update_categoryNameValue = $update_categoryName[$key];
                $update_productNameValue = $update_productName[$key];
                $update_fcPriceValue =  $update_fcPrice[$key];
                $update_quantityValue =  $update_quantity[$key];
                $update_totalPkrValue =  $update_priceInPkt[$key];
                $update_perPeaceValue = $update_perPeace[$key];
                $update_netCostValue = $update_netCost[$key];
                $update_netAmountValue = $update_netAmount[$key];
                $productIDPrimaryKeyValue =  $productIDPrimaryKey[$key];
                $previousQuantityValue =$previousQuantity[$key];
                $updatePreviousQuantityValue = $updatePreviousQuantity[$key];
                $updatePreviousQuantityHiddenValue = $updatePreviousQuantityHidden[$key];
                
                if($update_quantityValue < $updatePreviousQuantityHiddenValue){
                    $minusQuantity =  $updatePreviousQuantityHiddenValue - $update_quantityValue;
                    $UpdatetotalQuantity = $updatePreviousQuantityHiddenValue -  $minusQuantity;
                }else{
                    
                    $plusQuantity =  $update_quantityValue - $updatePreviousQuantityHiddenValue;
                    $UpdatetotalQuantity = $plusQuantity + $updatePreviousQuantityHiddenValue;
                }
              
            $insert_query_details = "update `purchase_invoice_details` set `categoryID` ='$update_categoryNameValue', `productID` ='$update_productNameValue', `priceOfFc` = '$update_fcPriceValue', `quantity` ='$update_quantityValue', `priceInPkr` ='$update_totalPkrValue', `freightCost` ='$update_perPeaceValue', `netCost` = '$update_netCostValue', `netAmount` = '$update_netAmountValue', `time_stamp` = now() where id = '$productIDPrimaryKeyValue'";
            $stmtt = $dbh->prepare($insert_query_details);
            $stmtt->execute();
            
            
             $delete_query ="DELETE FROM `purchase_invoice_details` WHERE `id` in($productsdeleteID)";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  

            
            
//            var_dump($insert_query_details);
            $update_query = "UPDATE `products` SET `product_quantity`='$UpdatetotalQuantity' WHERE `id` = '$update_productNameValue'";
            $upstmt = $dbh->prepare($update_query);
            $upstmt->execute();
            
            
            
            
        }


//
        foreach($insert_categoryName as $key=>$value){
            
            $categoryNameValue = $insert_categoryName[$key];
            $productNameValue = $insert_productName[$key];
            $fcPriceValue =  $insert_fcPrice[$key];
            $quantityValue =  $insert_quantity[$key];
            $totalPkrValue =  $insert_priceInPkt[$key];
            $perPeaceValue = $insert_perPeace[$key];
            $netCostValue = $insert_netCost[$key];
            $netAmountValue =$insert_netAmount[$key];
//            $previousQuantityValue =$previousQuantity[$key];
//            
//            $totalQuantity = $previousQuantityValue + $quantityValue;
            
            $insert_query_details = "INSERT INTO `purchase_invoice_details`(`categoryID`, `productID`, `priceOfFc`, `quantity`, `priceInPkr`, `freightCost`, `netCost`, `netAmount`, `purchase_invoice_id`, `time_stamp`) VALUES ('$categoryNameValue','$productNameValue','$fcPriceValue','$quantityValue','$totalPkrValue','$perPeaceValue','$netCostValue','$netAmountValue','$productID',now())";
            $stmtt = $dbh->prepare($insert_query_details);
            $stmtt->execute();
        
//            $update_query = "UPDATE `products` SET `product_quantity`='$totalQuantity' WHERE `id` = '$productNameValue'";
//            $upstmt = $dbh->prepare($update_query);
//            $upstmt->execute();
//            
            
            
            
        }

        $insert_query_details_totals = "update `purchase_invoice_amount_details` set `totalAmountInFc` ='$totalAmountInFc', `totalFreight` = '$totalFreight', `totalPkr` ='$totalPkrAmount', `totalAmount` = '$totalAmount'  where id = '$invoiceDetailsID'";
        $stmttt = $dbh->prepare($insert_query_details_totals);
        $stmttt->execute();
        //var_dump($insert_query_details_totals);
      //  print_r($netAmount);
        
        
    




?>