<?php
    include("headers/connect.php");
    include("headers/_user-details.php");
    require("fpdf/fpdf.php");


    $date = date('Y-m-d');
    
    $user_id = $_SESSION['user_id'];
    $customer_id = $_POST['customer_id'];
    
    $customerAddress = $_POST['customerAddress'];
        
    $contactNumber = $_POST['contactNumber'];
    $invoiceNumber = $_POST['invoiceNumber'];
    $invoiceCreate  = $_POST['invoiceCreate'];
    $invoiceDate =  gmdate("Y-m-d");
    $saleman_id = $_POST['saleman_id'];

    $deliveredBy = $_POST['deliveredBy'];
    $godownCheck = $_POST['godownCheck'];
    $totalReceivableInput = $_POST['totalReceivableInput'];
    $creditAmount = "0";
    $debitAmount = "0";


    $categoryName = @$_POST['categoryName'];
    $insert_productName = $_POST['insert_productName'];
    $list_price = $_POST['list_price'];
    $total_quantity = $_POST['total_quantity'];
    $discount = $_POST['discount'];
    $net_price = $_POST['net_price']; 
    $net_amount = $_POST['net_amount'];
    $avialableQuantity = $_POST['avialableQuantity'];
    $company_id = $_POST['company_id'];

       
     
    $openingBalance = $_POST['openingBalance'];
    $grossAmount = $_POST['grossAmount'];
    $totalDiscount = $_POST['totalDiscount'];
    $totalNetAmount = $_POST['totalNetAmount'];

    $previousBalance = $_POST['previousBalance'];
    $amountReceived = $_POST['amountReceived'];

    $new_balance_amount = $_POST['new_balance_amount'];
    $totalReceived = $_POST['totalReceived'];
    $amountReceived = 0;
    $openingBalance = 0;

    // Bank fields 
        $payment_method = @$_POST['payment_method']; 
        $account_titles = $_POST['account_titles'];
        $account_numbers = $_POST['account_numbers'];
        $bank = $_POST['bank'];
        $amount = $_POST['amount'];
        $chec_date = $_POST['chec_date'];


        //fetch customer name from database
            $fetch_customer = "SELECT customer_name FROM `customer`  where id = '$customer_id'";
            $sth_cust = $dbh->prepare($fetch_customer);
            $sth_cust->execute();
            $rowss = $sth_cust->fetch(PDO::FETCH_ASSOC);
            $customer_name = $rowss['customer_name'];
            $ageing = '';
            // add 3 days to date

            $dt = date("Y-m-d");
            $ageing_date = date( "Y-m-d", strtotime( "$dt + ".$ageing." day" ) ); // PHP:  2009-03-04

          
          


        $insert_query = "INSERT INTO `sale_invoice`(`customer_id`, `customerAddress`, `contactPerson`, `contactNumber`, `invoiceNumber`, `invoiceCreate`, `invoiceDate`, `totalItems`, `deliveredBy`, `time_stamp`,`godownCheck`,`ageing_date`,`user_id`) VALUES ('$customer_id','$customerAddress','00','$contactNumber','$invoiceNumber','$invoiceCreate','$invoiceDate','00','$deliveredBy',now(),'$godownCheck','$ageing_date','$user_id')";
        $stmt = $dbh->prepare($insert_query);
         $stmt->execute();
        $invoice_id = $dbh->lastInsertId(); 
     

          
        // print_r($insert_productName);
        foreach($insert_productName as $key=>$value){
            
            $categoryNameValue = $categoryName[$key];
            $insert_productNameValue = $insert_productName[$key];
            $list_priceValue =  $list_price[$key];
            $total_quantityValue =  $total_quantity[$key];
            $discountValue =  $discount[$key];
            $net_priceValue = $net_price[$key];
            $net_amountValue = $net_amount[$key];
            $avialableQuantityValue = $avialableQuantity[$key];
           // $company_idValue = $company_id[$key];
            
            $remaningQuantity = 0;
            if($avialableQuantityValue != null){
                $remaningQuantity = $avialableQuantityValue - $total_quantityValue;    
            }
            
            
            
            $update_quantity = "UPDATE `products` SET `product_quantity_sale`= '$remaningQuantity' WHERE `id`  ='$insert_productNameValue'";
            $stmtttt = $dbh->prepare($update_quantity);
            $stmtttt->execute();   
            
                
            $insert_query_details = "INSERT INTO `sale_invoice_details`(`insert_productName`, `list_price`, `total_quantity`, `discount`, `net_price`, `net_amount`, `sale_invoice_id`, `time_stamp`,`customer_id`,`company_id`,`saleman_id`) VALUES ('$insert_productNameValue','$list_priceValue','$total_quantityValue','$discountValue','$net_priceValue','$net_amountValue','$invoice_id',now(),'$customer_id','$company_id','$saleman_id')";
            $stmtt = $dbh->prepare($insert_query_details);
            $stmtt->execute();
            $details_id = $dbh->lastInsertId(); 
           // var_dump($insert_query_details);

          

            $historty_discription = $customer_name ." {SALE}";
            $each_quantity_price = $net_amountValue/$total_quantityValue;


            //query to maintain history
            $history_query = "INSERT INTO `inventory_history`(`invoice_id`, `description`, `rate`, `plus_full`, `minus_full`, `status`, `time_stamp`,`date`,`product_id`,`customer_id`,`invoice_detail_id`,`company_id`) VALUES ('$invoice_id','$historty_discription','$each_quantity_price','','$total_quantityValue','3',NOW(),'$date','$insert_productNameValue','$customer_id','$details_id','$company_id')";
            $stt = $dbh->prepare($history_query);
            $stt->execute(); 
          //  var_dump($history_query);     

            
            
        }


        $openingRemaniningBalance = $openingBalance - $amountReceived;
         $update_customer = "UPDATE `customer` SET `opening_balance`= '$openingRemaniningBalance' WHERE `id` ='$customer_id'";
            $stmttt = $dbh->prepare($update_customer);
            $stmttt->execute();   


        $insert_query_details_totals = "INSERT INTO `sale_invoice_amount_details`(`grossAmount`, `totalDiscount`, `totalNetAmount`, `previousBalance`, `amountReceived`, `sale_invoice_id`, `time_stamp`,`customer_id`,`payment_status`,`company_id`) VALUES ('$grossAmount','$totalDiscount','$totalNetAmount','$previousBalance','$amountReceived','$invoice_id',now(),'$customer_id','0','$company_id')";
        $stmttt = $dbh->prepare($insert_query_details_totals);
        $stmttt->execute();
       

       
            $creditAmount =   $totalReceived; 
             $debitAmount =   $totalNetAmount; 
        
             //query to maintain the ledger
        $leadear_query = "INSERT INTO `customer_ledger`(`debitAmount`, `creditAmount`, `invoice_id`, `time_stamp`,`customer_id`,`date`,`description`,`company_id`,`saleman_id`) VALUES ('$debitAmount','$creditAmount','$invoice_id',now(),'$customer_id','$date','Sale Invoice','$company_id','$saleman_id')";
            $st = $dbh->prepare($leadear_query);
            $st->execute(); 
             echo $invoice_id ."," .$customer_id;
    
    $get_invoice_id = $invoice_id;
    $get_customer_id = $customer_id;
    

?>