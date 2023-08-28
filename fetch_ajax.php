<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();



    if(@$_GET['select_category']){
        $select_category = $_GET['select_category'];
        
        
        $fetch_query = "SELECT id, product_name,discount FROM `products` WHERE `category_id` = '$select_category'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
    // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $product_name = $rows['product_name'];  
            $discount = $rows['discount'];  
                
            $temparray['id']= $id;
            $temparray['product_name']= $product_name;
             $temparray['discount']= $discount;
            $returnArray['products'][] = $temparray;	
        }	
         echo json_encode($returnArray);  
        exit;
    }


     if(@$_GET['payment_type']){
        $payment_type = $_GET['payment_type'];
        
        
        $fetch_query = "SELECT `id` , `customer_name` FROM `customer` WHERE `customer_type` = '$payment_type'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
    // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $customer_name = $rows['customer_name'];  
           
                
            $temparray['id']= $id;
            $temparray['customer_name']= $customer_name;
             
            $returnArray['payment_type'][] = $temparray;    
        }   
         echo json_encode($returnArray);  
        exit;
    }

     if(@$_GET['accountTypeSelection']){
        $accountTypeSelection = $_GET['accountTypeSelection'];
        
        
        $fetch_query = "SELECT `id` , `customer_name` FROM `customer` WHERE `customer_type` = '$accountTypeSelection'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
    // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $customer_name = $rows['customer_name'];  
           
                
            $temparray['id']= $id;
            $temparray['customer_name']= $customer_name;
             
            $returnArray['payment_type'][] = $temparray;    
        }   
         echo json_encode($returnArray);  
        exit;
    }


     if(@$_GET['payment_typeSelection']){
        $payment_typeSelection = $_GET['payment_typeSelection'];
        
        
        $fetch_query = "SELECT `id` , `customer_name` FROM `customer` WHERE `customer_type` = '$payment_typeSelection'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
    // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $customer_name = $rows['customer_name'];  
           
                
            $temparray['id']= $id;
            $temparray['customer_name']= $customer_name;
             
            $returnArray['payment_type'][] = $temparray;    
        }   
         echo json_encode($returnArray);  
        exit;
    }

 if(@$_GET['payment_type_cheque_inhands']){
        $payment_type_Selection = $_GET['payment_type_SelectionAmount'];

         $payment_type_inhands = $_GET['payment_type_cheque_inhands']; 
          
         if($payment_type_Selection == '19'){

          $fetch_query = "SELECT    @variable := @variable + SUM(`creditAmount` - `debitAmount`) `Balance`    FROM `customer_ledger` WHERE `payment_type_status` ='1' AND `account_type` = '19' AND type = 1";

         }else{

          $fetch_query = "SELECT `debitAmount` , `bank_name` ,`check_number` , `creditAmount` ,`id`,`clear_date`  FROM `customer_ledger` WHERE `payment_type_status` ='$payment_type_inhands' AND `account_type` = '$payment_type_Selection' AND `clear_date` >= DATE(NOW())  and type = 2 and paid_status = 0";

         }
        
        $sth = $dbh->prepare($fetch_query);
        $dbh->query('SET @variable := 0');
        $result = $sth->execute();
      // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $bank_name = $rows['bank_name'];  
              $check_number = $rows['check_number'];  
              $creditAmount = $rows['creditAmount'];  
              $clear_date = $rows['clear_date'];
              $Balance = $rows['Balance'];
                
            $temparray['id']= $id;
            $temparray['bank_name']= $bank_name;
            $temparray['check_number']= $check_number;
            $temparray['creditAmount']= $creditAmount;
            $temparray['clear_date']= $clear_date;
            $temparray['Balance']= $Balance;
             
            $returnArray['payment_type_details'][] = $temparray;    
        }   
         echo json_encode($returnArray);  
        exit;
    }    



   if(@$_GET['select_category_editID']){
        $select_category_editID = $_GET['select_category_editID'];
        
        
        $fetch_query = "SELECT id, product_name,product_quantity FROM `products` WHERE `category_id` = '$select_category_editID'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $product_name = $rows['product_name'];  
            $quantity = $rows['quantity'];  
                
            $temparray['id']= $id;
            $temparray['product_name']= $product_name;
             $temparray['product_quantity']= $quantity;
            $returnArray['products'][] = $temparray;	
        }	
         echo json_encode($returnArray);  
        exit;
    }


    if(@$_GET['cheque_in_hand']){
        $cheque_in_hand = $_GET['cheque_in_hand'];
        
        
        $fetch_query = "SELECT  `bank_name` ,`check_number` , `creditAmount` ,`id`,`clear_date`  FROM `customer_ledger` WHERE id = '$cheque_in_hand'  AND `clear_date` >= DATE(NOW())  and type = 2";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
              $id = $rows['id'];
             $bank_name = $rows['bank_name'];  
              $check_number = $rows['check_number'];  
              $creditAmount = $rows['creditAmount'];  
              $clear_date = $rows['clear_date'];
             
            $temparray['id']= $id;
            $temparray['bank_name']= $bank_name;
            $temparray['check_number']= $check_number;
            $temparray['creditAmount']= $creditAmount;
            $temparray['clear_date']= $clear_date;
            $returnArray = $temparray;  
        
         echo json_encode($returnArray);  
        exit;
    }



if(@$_GET['set_products_value']){
        $set_products_value = $_GET['set_products_value'];
        $customerID = $_GET['customerID'];
        
        
        $fetch_query = "SELECT p.discount,p.price,p.company_id,p.product_quantity_sale , (SELECT si.list_price as previousPrice FROM sale_invoice_details si WHERE si.insert_productName = p.id AND si.customer_id = '$customerID' ORDER BY si.id DESC LIMIT 1) as previousPrice  ,(SELECT si.discount  FROM sale_invoice_details si WHERE si.insert_productName = p.id AND si.customer_id = '$customerID' ORDER BY si.id DESC LIMIT 1) as  previousDiscount FROM `products` p  WHERE p.`id` = '$set_products_value' ";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
      
            $discount = $rows['discount'];  
            $price = $rows['price'];  
            $previousPrice = $rows['previousPrice'];  
            $previousDiscount = $rows['previousDiscount'];  
            $company_id = $rows['company_id'];  
            $product_quantity_sale = $rows['product_quantity_sale'];  

          
             $returnArray['discount']= $discount;
             $returnArray['price']= $price;
             $returnArray['previousPrice']= $previousPrice;
             $returnArray['previousDiscount']= $previousDiscount; 
             $returnArray['company_id']= $company_id; 
             $returnArray['product_quantity_sale']= $product_quantity_sale; 
        echo json_encode($returnArray);  
        exit;
        
    }

if(@$_GET['customerType']){
        $customerType = $_GET['customerType'];
        $company_id  = $_GET['company_id'];
        
        $fetch_query = "SELECT c.*,(SELECT previousBalance FROM sale_invoice_amount_details WHERE customer_id =  c.id AND company_id = '$company_id' ORDER by id DESC LIMIT 1) AS previousBalance FROM `customer` c   WHERE c.`id` = '$customerType'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);

        $address = $rows['address'];
        $mobile_1 = $rows['mobile_1'];
        $previousBalance = $rows['previousBalance'];
        $returnArray['address']= $address;
         $returnArray['previousBalance']= $previousBalance;
          $returnArray['mobile_1']= $mobile_1;

       echo json_encode($returnArray);  
        exit;
        
    }

    if(@$_GET['customerTypeCashRec']){
        $customerTypeCashRec = $_GET['customerTypeCashRec'];
        
        
        $fetch_query = "SELECT `previousBalance` FROM `sale_invoice_amount_details` WHERE `customer_id` = '$customerTypeCashRec' ORDER BY id DESC LIMIT 1";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        
        $previousBalance = $rows['previousBalance'];
        
      
        $returnArray['previousBalance']= $previousBalance;
       echo json_encode($returnArray);  
        exit;
        
    } 

    if(@$_GET['companyTypeCashRec']){
        $companyTypeCashRec = $_GET['companyTypeCashRec'];
        $customerTypeBCompany = $_GET['customerTypeBCompany'];
        
        
        $fetch_query = "SELECT `previousBalance` FROM `sale_invoice_amount_details` WHERE `customer_id` = '$customerTypeBCompany' AND company_id = '$companyTypeCashRec' ORDER BY id DESC LIMIT 1";
        $sth = $dbh->prepare($fetch_query);
        //var_dump($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        
        $previousBalance = $rows['previousBalance'];
        
      
        $returnArray['previousBalance']= $previousBalance;
       echo json_encode($returnArray);  
        exit;
        
    }   


     if(@$_GET['inProductName']){
        $inProductName = $_GET['inProductName'];
         
        $fetch_query = "SELECT SUM(`godown_sith_quantity`) as first_floor_quantity FROM `godown_1th_floor` WHERE `productID` = '$inProductName' GROUP BY `productID` ";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        
        $first_floor_quantity = $rows['first_floor_quantity'];
        
      
        $returnArray['first_floor_quantity']= $first_floor_quantity;
       echo json_encode($returnArray);  
        exit;
        
    } 



     if(@$_GET['select_company']){
        $select_company = $_GET['select_company'];
        

        $returnHtml = '';

       $fetch_query = "SELECT sid.* ,s.invoiceNumber,s.invoiceDate ,(SELECT product_name from products where id = sid.insert_productName) as productName ,(SELECT customer_name from customer where id = sid.customer_id) as customerName ,(SELECT company_name from company where id = sid.`company_id`) as companyName  FROM `sale_invoice_details` sid , sale_invoice s WHERE s.id = sid.`sale_invoice_id` and sid.company_id = '$select_company' GROUP by s.invoiceNumber";
          $sth = $dbh->prepare($fetch_query);
         // var_dump($fetch_query);
          $result = $sth->execute();
          $count = 1;
          $grand_total_quantity = 0;
          $grand_list_price = 0;
          $grand_discount = 0;
          $grand_net_amount = 0;
          while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $invoiceDate = $rows['invoiceDate'];
              $invoiceNumber = $rows['invoiceNumber'];
              $customerName = $rows['customerName'];
              $companyName = $rows['companyName'];
              
              $net_amount = $rows['net_amount'];
              $grand_net_amount += $net_amount;
         $returnHtml .="<tr> 
            <td>$count</td>
            <td>$invoiceDate</td>
            <td>$invoiceNumber</td>
            <td>$customerName</td>
            <td>$companyName</td>
            <td>$net_amount</td>
           </tr>";
      $count++;

      }
      $returnHtml .="<tr> 
            <td colspan='5'><b>Grand Total:</b></td>
            <td><b>$grand_net_amount</b></td>
           </tr>";
     
           echo $returnHtml;
        
    } 


     if(@$_GET['select_company_bydiscount']){
        $select_company_bydiscount = $_GET['select_company_bydiscount'];
        

        $returnHtml = '';

       $fetch_query = "SELECT sid.* ,s.invoiceNumber,s.invoiceDate ,(SELECT product_name from products where id = sid.insert_productName) as productName ,(SELECT customer_name from customer where id = sid.customer_id) as customerName ,(SELECT company_name from company where id = sid.`company_id`) as companyName ,(SELECT totalNetAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as totalNetAmount ,(SELECT grossAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as grossAmount   FROM `sale_invoice_details` sid , sale_invoice s WHERE s.id = sid.`sale_invoice_id` and sid.company_id = '$select_company_bydiscount' AND sid.discount > 0 GROUP by s.invoiceNumber order by s.invoiceDate DESC";
          $sth = $dbh->prepare($fetch_query);
         //var_dump($fetch_query);
          $result = $sth->execute();
          $count = 1;
          $grand_total_quantity = 0;
          $grand_list_price = 0;
          $grand_discount = 0;
          $grand_net_amount = 0;
          while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $invoiceDate = $rows['invoiceDate'];
              $invoiceNumber = $rows['invoiceNumber'];
              $customerName = $rows['customerName'];
              $companyName = $rows['companyName'];
              $discount = $rows['discount'];
              $grossAmount =$rows['grossAmount'];
              $net_amount = $rows['net_amount'];
              $totalNetAmount = $rows['totalNetAmount'];
              $grand_net_amount += $net_amount;

              $new_date = date('d F Y', strtotime($invoiceDate));


         $returnHtml .="<tr> 
            <td>$count</td>
            <td>$new_date</td>
            <td>$invoiceNumber</td>
            <td>$customerName</td>
            <td>$companyName</td>
            <td>$grossAmount</td>
            <td>$discount<b>%</b></td>
            <td>$totalNetAmount</td>
           </tr>";
      $count++;

      }
      $returnHtml .="<tr> 
            <td colspan='7'><b>Grand Total:</b></td>
            <td><b>$grand_net_amount</b></td>
           </tr>";
     
           echo $returnHtml;
        
    } 



     if(@$_GET['get_company_name_discount_data']){
        $get_company_name_discount_data = $_GET['get_company_name_discount_data'];
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $companyVariable = '';  
        $dateBtween = "AND (s.invoiceDate BETWEEN '$start_date' AND '$end_date')";

        if($get_company_name_discount_data != 'undefined' || $get_company_name_discount_data != 0){
          $companyVariable =  "and sid.company_id = '$get_company_name_discount_data'";
        }

        $returnHtml = '';

       $fetch_query = "SELECT sid.* ,s.invoiceNumber,s.invoiceDate ,(SELECT product_name from products where id = sid.insert_productName) as productName ,(SELECT customer_name from customer where id = sid.customer_id) as customerName ,(SELECT company_name from company where id = sid.`company_id`) as companyName ,(SELECT totalNetAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as totalNetAmount ,(SELECT grossAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as grossAmount    FROM `sale_invoice_details` sid , sale_invoice s WHERE s.id = sid.`sale_invoice_id` $companyVariable $dateBtween AND sid.discount > 0 GROUP by s.invoiceNumber order by s.invoiceDate desc";
          $sth = $dbh->prepare($fetch_query);
    //var_dump($fetch_query);
          $result = $sth->execute();
          $count = 1;
          $grand_total_quantity = 0;
          $grand_list_price = 0;
          $grand_discount = 0;
          $grand_net_amount = 0;
          while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $invoiceDate = $rows['invoiceDate'];
              $invoiceNumber = $rows['invoiceNumber'];
              $productName = $rows['productName'];
              $companyName = $rows['companyName'];
              $customerName = $rows['customerName'];
              $totalNetAmount = $rows['totalNetAmount'];
              $discount = $rows['discount'];
              $net_price =$rows['net_price'];
              $grossAmount =$rows['grossAmount'];

             
              $grand_net_amount += $totalNetAmount;
         $returnHtml .="<tr> 
            <td>$count</td>
            <td>$invoiceDate</td>
            <td>$invoiceNumber</td>
            <td>$customerName</td>
            <td>$companyName</td>
            <td>$grossAmount</td>
            <td>$discount<b>%</b></td>
            <td>$totalNetAmount</td>
           </tr>";
            $count++;

      }
      $returnHtml .="<tr> 
            <td colspan='7'><b>Grand Total:</b></td>
            <td><b>$grand_net_amount</b></td>
           </tr>";
     
           echo $returnHtml;
        
    } 



      if(@$_GET['select_company_by_inventory']){
        $select_company_by_inventory = $_GET['select_company_by_inventory'];
        

        $returnHtml = '';

       $fetch_query = "SELECT p.* ,(SELECT company_name from company where id = p.`company_id`) companyName FROM `products` p WHERE p.company_id = '$select_company_by_inventory'";
          $sth = $dbh->prepare($fetch_query);
         // var_dump($fetch_query);
          $result = $sth->execute();
          $count = 1;
          $grand_total_quantity_rate = 0;
          while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
            $product_name = $rows['product_name'];
            $product_quantity_sale = $rows['product_quantity_sale'];
            $companyName = $rows['companyName'];
            $price = $rows['price'];
            $purchase_price = $rows['purchase_price'];
            $total_quantity_rate = $product_quantity_sale * $price;
            if($product_quantity_sale == ""){
                $product_quantity_sale = 0;
            }    

            if($purchase_price == ""){
               $purchase_price = 0;
            }

            $total_purchase_amount = $product_quantity_sale * $purchase_price; 

            $profit_amount =  $total_quantity_rate -  $total_purchase_amount; 

            $grand_total_quantity_rate += $total_quantity_rate;
            $grand_profit_amount += $profit_amount;

         $returnHtml .="<tr> 
                    <td>$count</td>
                    <td>$product_name</td>
                    <td>$companyName</td>
                    <td>$product_quantity_sale</td>
                    <td>$purchase_price</td>
                    <td>$price</td>
                    <td>$profit_amount</td>
                    <td>$total_quantity_rate</td>
                   </tr>";
      $count++;

      }
      $returnHtml .="<tr> 
                      <td colspan='6'><b>Grand Total:</b></td>
                      <td><b>$grand_profit_amount</b></td>
                      <td><b>$grand_total_quantity_rate</b></td>
                     </tr>";
     
           echo $returnHtml;
        
    } 



     if(@$_GET['get_company_name']){
        $select_company = $_GET['get_company_name'];
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $companyVariable = '';  
        $dateBtween = "AND (s.invoiceDate BETWEEN '$start_date' AND '$end_date')";

        if($select_company != 'undefined'){
          $companyVariable =  "and sid.company_id = '$select_company'";
        }

        $returnHtml = '';

       $fetch_query = "SELECT sid.* ,s.invoiceNumber,s.invoiceDate ,(SELECT product_name from products where id = sid.insert_productName) as productName ,(SELECT customer_name from customer where id = sid.customer_id) as customerName ,(SELECT company_name from company where id = sid.`company_id`) as companyName ,(SELECT totalNetAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as totalNetAmount   FROM `sale_invoice_details` sid , sale_invoice s WHERE s.id = sid.`sale_invoice_id` $companyVariable $dateBtween GROUP by s.invoiceNumber order by s.invoiceDate asc";
          $sth = $dbh->prepare($fetch_query);
   //  var_dump($fetch_query);
          $result = $sth->execute();
          $count = 1;
          $grand_total_quantity = 0;
          $grand_list_price = 0;
          $grand_discount = 0;
          $grand_net_amount = 0;
          while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $invoiceDate = $rows['invoiceDate'];
              $invoiceNumber = $rows['invoiceNumber'];
              $productName = $rows['productName'];
              $companyName = $rows['companyName'];
              $customerName = $rows['customerName'];
              $totalNetAmount = $rows['totalNetAmount'];
             
              $grand_net_amount += $totalNetAmount;
         $returnHtml .="<tr> 
            <td>$count</td>
            <td>$invoiceDate</td>
            <td>$invoiceNumber</td>
            <td>$customerName</td>
            <td>$companyName</td>
            <td>$totalNetAmount</td>
           </tr>";
      $count++;

      }
      $returnHtml .="<tr> 
            <td colspan='5'><b>Grand Total:</b></td>
            <td><b>$grand_net_amount</b></td>
           </tr>";
     
           echo $returnHtml;
        
    } 

     
?>
		