<?php

    include("headers/connect.php");
    include("headers/_user-details.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $invoiceNumber = $_POST['invoiceNumber'];
    $categoryName = $_POST['categoryName'];
    $productName = $_POST['productName'];
    $avialableQuantity = $_POST['avialableQuantity'];
    $transferQuantity = $_POST['transferQuantity'];
    $totalQuantity = $_POST['totalQuantity'];
    $product_details_id = $_POST['product_details_id'];
    $product_quantity_sale = $_POST['product_quantity_sale'];

    $godwn_from = $_POST['godwn_from'];
    $godwn_to = $_POST['godwn_to'];
    $date = $_POST['date'];


   

    foreach($productName as $key => $value){
        
        $categoryNameValue = $categoryName[$key];
        $productNameValue = $productName[$key];
        $avialableQuantityValue = $avialableQuantity[$key];
        $transferQuantityValue = $transferQuantity[$key];
        $totalQuantityValue  = $totalQuantity[$key];
        $product_details_idValue  = $product_details_id[$key];
         $invoiceNumberValue  = $invoiceNumber[$key];
         $product_quantity_saleValue  = $product_quantity_sale[$key];
        
        
        $fetach_query = "SELECT * FROM godown_6th_floor  WHERE `productID` ='$productNameValue' order by `id` asc";
        $fetach_stht = $dbh->prepare($fetach_query);
        $result =  $fetach_stht->execute();
        $count = $fetach_stht->rowCount();   
    if($count >= 1)
        {
        if($result)
            {
                $sum_value = 0;    
                $complete_quantity = 0;
                while($row = $fetach_stht->fetch(PDO::FETCH_ASSOC))
                    {
                        $id = $row['id'];
                        $categoryID = $row['categoryID'];
                        $productID =  $row['productID'];
                        $purchase_invoice_details_id =  $row['purchase_invoice_details_id'];
                        $godown_sith_quantity = $row['godown_sith_quantity'];    
                        $godown_sith_quantity_minus = $godown_sith_quantity;
                        $invoice_id = $row['invoice_id'];
                         $purchase_invoice = $row['purchase_invoice_#'];
                        $invoiceNumberValue = $invoice_id;

                    
                        $sum_value += $godown_sith_quantity_minus;
                     
                if($transferQuantityValue != 0)
                {
                   if($godown_sith_quantity_minus <= $transferQuantityValue){
                          $transferQuantityValue = $transferQuantityValue - $godown_sith_quantity_minus;
                          $quantityMinus = $godown_sith_quantity_minus;
                       
                       $delete_query = "Delete  FROM `godown_6th_floor` WHERE `id` ='$id'";
                        $delete_stmt = $dbh->prepare($delete_query);
                        $$delete_result = $delete_stmt->execute();
                       //var_dump($delete_query);

                       
                        $updateProductQuantity = $product_quantity_saleValue + $quantityMinus;
                        
                        $update_product = "UPDATE `products` SET `product_quantity_sale` ='$updateProductQuantity' , `updated_time`=now()  WHERE `id` ='$productNameValue'";
                        $stmtt_p = $dbh->prepare($update_product);
                        $resultRegisterts = $stmtt_p->execute();
                       
                       
                    }
                    else{ 
                        
                        $back_qunttity =  $godown_sith_quantity_minus - $transferQuantityValue;
                        $quantityMinus = $transferQuantityValue;
                        $transferQuantityValue = 0;
                    
                        $updateProductQuantity = $product_quantity_saleValue + $quantityMinus;
                        
                        $update_product = "UPDATE `products` SET `product_quantity_sale` ='$updateProductQuantity' , `updated_time`=now()  WHERE `id` ='$productNameValue'";
                        $stmtt_p = $dbh->prepare($update_product);
                        $resultRegisterts = $stmtt_p->execute();
                       
                        
                        $update_quantity = "UPDATE `godown_6th_floor` SET `godown_sith_quantity` ='$back_qunttity' , `time_stamp`=now()  WHERE `id` ='$id'";
                        $stmtt = $dbh->prepare($update_quantity);
                        $resultRegistert = $stmtt->execute();
                      
                     }
                   


                    $fetach_query_godown = "SELECT * ,godown_sith_quantity as godown_first_floor_quantity FROM `godown_1th_floor` WHERE `categoryID` = '$categoryID' AND `productID` = '$productID'";
                    $fetach_sthtd = $dbh->prepare($fetach_query_godown);
                    $fetach_sthtd->execute();
                    $counter = $fetach_sthtd->rowCount();  
                    $rows = $fetach_sthtd->fetch(PDO::FETCH_ASSOC); 
                    $godown_first_floor_quantity = $rows['godown_first_floor_quantity'];
                $dodown_quantity_update = $godown_first_floor_quantity + $quantityMinus;

                    if($counter >= 1)
                    {
                         $completeQuantity_query = "update  `godown_1th_floor` set  `categoryID` ='$categoryID', `productID` ='$productID', `godown_sith_quantity` = '$dodown_quantity_update', `invoice_id` = '$invoiceNumberValue', `time_stamp` =now(),`transfer_id` = '',`purchase_invoice_details_id` = '$purchase_invoice_details_id',`user_id` = '$user_id' WHERE categoryID = '$categoryID' AND productID   = '$productID'";

                    }else{

                         $completeQuantity_query = "INSERT INTO `godown_1th_floor`(`categoryID`, `productID`, `godown_sith_quantity`, `invoice_id`, `time_stamp`,`transfer_id`,`purchase_invoice_details_id`,`godwon_previous_quantity`,`user_id`) VALUES ('$categoryID','$productID','$quantityMinus','$invoiceNumberValue',now(),'','$purchase_invoice_details_id','$godown_sith_quantity','$user_id')";

                    }
                     
                         $stmtt_qunt = $dbh->prepare($completeQuantity_query);
                        $resultRegistert = $stmtt_qunt->execute();

               $transfer_query = "INSERT INTO `godown_transfer`(`godown_from`, `godown_to`, `date`, `transfer_user_name`,`category_id`,`product_id`,`invoice_id`,`transfer_quantity`) VALUES ('$godwn_from','$godwn_to','$date','$user_id','$categoryID','$productID','$invoiceNumberValue','$quantityMinus')";
                $tran_stmtt = $dbh->prepare($transfer_query);
                $tran_stmtt->execute(); 
              

         $historty_discription = $invoiceNumberValue ." {PURCHASE}";       
              //query to maintain history
            $history_query = "INSERT INTO `inventory_history`(`invoice_id`, `description`, `rate`, `plus_full`, `minus_full`, `status`, `time_stamp`,`date`,`product_id`,`customer_id`) VALUES ('$invoiceNumberValue','$historty_discription','','$quantityMinus','','2',NOW(),'$date','$productID','')";
            $stt = $dbh->prepare($history_query);
            $stt->execute();        




                }
                   
            } 
        }
        }
    }

    
?>
        