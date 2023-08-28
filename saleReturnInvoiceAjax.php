<?php
    include("headers/connect.php");
    include("headers/_user-details.php");

$date = date('Y-m-d');
    
    $category_id = $_POST['category_id'];
    $getProductID = $_POST['getProductID'];
    $list_price = $_POST['list_price'];
    $categoryID = $_POST['categoryID'];


    $return_quantity = $_POST['return_quantity'];
    $total_quantity = $_POST['total_quantity'];
    $discount  = $_POST['discount'];
    $net_price = $_POST['net_price'];
    $net_return_price = $_POST['net_return_price'];


    $net_amount = $_POST['net_amount'];
    $net_return_amount = $_POST['net_return_amount'];
    $openingBalance = $_POST['openingBalance'];
    $grossAmount = $_POST['grossAmount'];
     $totalDiscount = $_POST['totalDiscount'];
    $totalNetAmount = $_POST['totalNetAmount'];
    $totalReceivableInput = $_POST['totalReceivableInput'];
    $previousBalance = $_POST['previousBalance'];
    $amountReceived = $_POST['amountReceived'];
    $customerID = $_POST['customerID'];
    $invoice_number = $_GET['invoice_number'];
   


            $fetch_query = "select product_quantity_sale from products where id = '$getProductID'";
            $sth = $dbh->prepare($fetch_query);
            $result = $sth->execute();
            $rows = $sth->fetch(PDO::FETCH_ASSOC);
            $product_quantity_sale = $rows['product_quantity_sale'];
            $product_quantity_sale_update = $product_quantity_sale + $return_quantity;
      
        
            $update_quantity = "UPDATE `products` SET `product_quantity_sale`= '$product_quantity_sale_update' WHERE `id`  ='$getProductID'";
            $stmtttt = $dbh->prepare($update_quantity);
            $stmtttt->execute();
        


            $fetch_query_customer = "select opening_balance from  customer where id = '$customerID'";
            $sthr = $dbh->prepare($fetch_query_customer);
            $result = $sthr->execute();
            $rowss = $sthr->fetch(PDO::FETCH_ASSOC);
            $opening_balance = $rowss['opening_balance'];
            $opening_balance_update = $net_return_amount + $opening_balance;
            
             $update_opening = "UPDATE `customer` SET `opening_balance`= '$opening_balance_update' WHERE `id`  ='$customerID'";
            $stmttttd = $dbh->prepare($update_opening);
            $stmttttd->execute();


                $avialableQuantity  =  $total_quantity - $return_quantity;
                $net_price_updated = $list_price * $avialableQuantity;
                $totalNetAmountUpdated = $net_price_updated - ($net_price_updated * $discount/100 );
                


            $query_invoice_details = "UPDATE `sale_invoice_details` SET `total_quantity`= '$avialableQuantity' ,`net_price` ='$net_price_updated' ,`net_amount`= '$totalNetAmountUpdated'  WHERE `insert_productName`  ='$getProductID' and sale_invoice_id ='$invoice_number' and categoryName = '$categoryID' ";
            $sr = $dbh->prepare($query_invoice_details);
            $sr->execute();





      
            $balance_netAmount = $net_amount - $net_return_amount;
      


            $query_invoice_amount = "UPDATE `sale_invoice_amount_details` SET `totalNetAmount` ='$balance_netAmount'  WHERE  sale_invoice_id ='$invoice_number'";
            $str = $dbh->prepare($query_invoice_amount);
            $str->execute();



?>