<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();
   

    if(@$_GET['invoiceType']){
            $invoiceType = $_GET['invoiceType'];


            $fetch_query = "SELECT pi.foreighn_currency, pid.categoryID,piamd.totalAmountInFc,piamd.totalFreight,piamd.totalPkr,piamd.totalAmount,(SELECT category_name FROM category WHERE id = pid.categoryID) as categoryName FROM `purchase_invoice_details` pid , purchase_invoice pi , purchase_invoice_amount_details piamd    WHERE pi.id = piamd.purchaseInvoiceId AND pi.id = pid.purchase_invoice_id AND pi.`id` = '$invoiceType' group by pid.categoryID";
            $sth = $dbh->prepare($fetch_query);
            $result = $sth->execute();
            while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                  $categoryID = $rows['categoryID'];
                  $foreighn_currency = $rows['foreighn_currency'];  
                  $categoryName = $rows['categoryName'];  
                $totalAmountInFc = $rows['totalAmountInFc'];  
                $totalFreight = $rows['totalFreight'];  
                $totalPkr = $rows['totalPkr'];  
                $totalAmount = $rows['totalAmount'];  
                
                  
                $temparray['categoryID']= $categoryID;
                 $temparray['foreighn_currency']= $foreighn_currency;
                $temparray['categoryName']= $categoryName;
                
                $temparray['totalAmountInFc']= $totalAmountInFc;
                $temparray['totalFreight']= $totalFreight;
                $temparray['totalPkr']= $totalPkr;
                $temparray['totalAmount']= $totalAmount;
                
                $returnArray['purchase'][] = $temparray;	
            }	
             echo json_encode($returnArray);  
            exit;
        }




if(@$_GET['productTypeID']){
            $productTypeID = $_GET['productTypeID'];
            $invoiceTypeID = $_GET['invoiceTypeID'];
           
            $fetch_querys = "SELECT (SELECT id FROM products WHERE id = purchase_invoice_details.productID) as product_id ,(SELECT product_name FROM products WHERE id = purchase_invoice_details.productID) as products_name FROM `purchase_invoice_details` WHERE `categoryID` = '$productTypeID' AND `purchase_invoice_id` = '$invoiceTypeID'";
            $sths = $dbh->prepare($fetch_querys);
            $result = $sths->execute();
//            var_dump($fetch_querys);
            while($rowss = $sths->fetch(PDO::FETCH_ASSOC))
            {
            $product_id = $rowss['product_id'];
            $product_name = $rowss['products_name'];
        
                
                $temparray['product_id']= $product_id;
                $temparray['product_name']= $product_name;
               $returnArray['products_data'][] = $temparray;	
            }
         echo json_encode($returnArray);  
         
    }


    if(@$_GET['productNameIDs']){
        
            $productNameIDs = $_GET['productNameIDs'];
            $invoiceTypeIDs = $_GET['invoiceTypeIDs'];
            
            $fetch_query = "SELECT pid.* ,(SELECT `godown_sith_quantity` FROM `godown_6th_floor` WHERE `invoice_id` = pi.id) as godown_sith_quantity ,(SELECT category_name FROM category WHERE id = pid.categoryID) as category_name ,(SELECT product_name FROM products WHERE id = pid.productID) as products_name FROM `purchase_invoice_details` pid ,purchase_invoice pi  WHERE  pi.id = pid.purchase_invoice_id AND `productID` = '$productNameIDs' AND `purchase_invoice_id` = '$invoiceTypeIDs'";
            $sth = $dbh->prepare($fetch_query);
            $result = $sth->execute();

            $rows = $sth->fetch(PDO::FETCH_ASSOC);
        
            $category_name = $rows['category_name'];
            $product_name = $rows['products_name'];
            $priceOfFc = $rows['priceOfFc'];
            $quantity = $rows['godown_sith_quantity'];
            $priceInPkr = $rows['priceInPkr'];
            $freightCost = $rows['freightCost'];
            $netCost = $rows['netCost'];
            $netAmount = $rows['netAmount'];
        
                $temparray['category_name']= $category_name;
                $temparray['product_name']= $product_name;
                $temparray['priceOfFc']= $priceOfFc;
                $temparray['quantity']= $quantity;
                $temparray['priceInPkr']= $priceInPkr;
                $temparray['freightCost']= $freightCost;
                $temparray['netCost']= $netCost;
                $temparray['netAmount']= $netAmount;
                
        
        
        
              $returnArray['purchase_data'][] = $temparray;	
            echo json_encode($returnArray);     
        
               
    
    }


?>