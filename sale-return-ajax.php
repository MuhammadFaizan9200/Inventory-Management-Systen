<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();
   

  
if(@$_GET['invoiceNumber']){
       $invoiceNumber = @$_GET['invoiceNumber'];   
        
         $fetch_querys = "SELECT (SELECT id FROM products WHERE id = sale_invoice_details.insert_productName) as product_id ,(SELECT product_name FROM products WHERE id = sale_invoice_details.insert_productName) as products_name FROM `sale_invoice_details` WHERE  `sale_invoice_id` = '$invoiceNumber'";
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


if(@$_GET['get_product']){
            $get_product = $_GET['get_product'];
            
            $fetch_querys = "SELECT `total_quantity` FROM `sale_invoice_details` WHERE `insert_productName` = '$get_product'";
            $sths = $dbh->prepare($fetch_querys);
            $result = $sths->execute();
            $rowss = $sths->fetch(PDO::FETCH_ASSOC);
            $total_quantity = $rowss['total_quantity'];
            $temparray['total_quantity']= $total_quantity;
              
         echo json_encode($temparray);  
         
    }



//     if(@$_GET['invoiceNumber']){
//             $invoiceNumber = $_GET['invoiceNumber'];
            
            
//             $fetch_query = "SELECT sid.* ,siad.id as siad_id,siad.grossAmount,siad.totalNetAmount,siad.previousBalance ,(SELECT product_name FROM products WHERE id = sid.insert_productName) as products_name FROM `sale_invoice_details` sid , sale_invoice s ,sale_invoice_amount_details siad  WHERE s.id = sid.`sale_invoice_id` AND s.id = siad.sale_invoice_id AND   s.`id` = '$invoiceNumber'";
//             //var_dump($fetch_query);
//             $sth = $dbh->prepare($fetch_query);
//             $result = $sth->execute();
//            while ($rows = $sth->fetch(PDO::FETCH_ASSOC))
//             {
//             $product_name = $rows['products_name'];
//             $list_price = $rows['list_price'];
//             $total_quantity = $rows['total_quantity'];
//             $discount = $rows['discount'];
//             $net_price = $rows['net_price'];
//             $net_amount = $rows['net_amount'];
//             $grossAmount = $rows['grossAmount'];
//             $totalNetAmount = $rows['totalNetAmount'];
//             $previousBalance = $rows['previousBalance'];
//             $siad_id = $rows['siad_id'];
//             $sia_id = $rows['id'];
//             $insert_productName = $rows['insert_productName'];

//             $total_quantity_convert = (int)$total_quantity;
//             $net_amount_convert = (int)$net_amount;

//             $per_peace_price = $total_quantity_convert / $net_amount_convert;



//             $time_stamp = $rows['time_stamp'];
//             $time_stamp = explode(" ", $time_stamp)[0];
//             $new_date_format = date('d-m-Y', strtotime($time_stamp));
//             $new_date_format =  date('D d F Y', strtotime($new_date_format));

//                 $temparray['product_name']= $product_name;
//                 $temparray['list_price']= $list_price;
//                 $temparray['total_quantity']= $total_quantity_convert;
//                 $temparray['discount']= $discount;
//                 $temparray['net_price']= $net_price;
//                 $temparray['net_amount']= $net_amount;
//                 $temparray['insert_productName']= $insert_productName;


//                  $temparray['grossAmount']= $grossAmount;
//                   $temparray['totalNetAmount']= $totalNetAmount;
//                    $temparray['previousBalance']= $previousBalance;
//                     $temparray['siad_id']= $siad_id;
//                     $temparray['sia_id']= $sia_id;
//                     $temparray['per_peace_price']= $per_peace_price;

//                 $temparray['new_date_format'] = $new_date_format;
//                $returnArray['products_data'][] = $temparray;	
//           }
//             echo json_encode($returnArray);     
        
               
    
//     }















?>