<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();


    if(@$_GET['fetch_select_invoice']){
        $fetch_select_invoice = $_GET['fetch_select_invoice'];
        
        $fetch_query = "SELECT c.* FROM `category` c ,godown_6th_floor  gf WHERE c.id = gf.categoryID AND gf.invoice_id = '$fetch_select_invoice'  GROUP by `categoryID` ORDER by id ASC";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
//var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $category_name = $rows['category_name'];  
            
            $temparray['id']= $id;
            $temparray['category_name']= $category_name;
           
            
            $returnArray['category'][] = $temparray;	
        }	
         echo json_encode($returnArray);  
        exit;
    }


    if(@$_GET['select_category']){
        $select_category = $_GET['select_category'];
        $select_category_invoice = $_GET['select_category_invoice'];
        
        $fetch_query = "SELECT p.id, p.product_name ,p.product_quantity_sale, gd.id as product_details_id FROM `products` p ,  godown_6th_floor gd  WHERE  p.id = gd.productID AND  gd.`categoryID` = '$select_category'  GROUP BY gd.productID ";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
     //var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $product_name = $rows['product_name'];  
              $product_details_id = $rows['product_details_id'];  
              $product_quantity_sale = $rows['product_quantity_sale'];  
            
            
            $temparray['id']= $id;
            $temparray['product_name']= $product_name;
            $temparray['product_details_id']= $product_details_id;
            $temparray['product_quantity_sale']= $product_quantity_sale;
            
            $returnArray['products'][] = $temparray;	
        }	
         echo json_encode($returnArray);  
        exit;
    }


   if(@$_GET['set_products_value']){
        $set_products_value = $_GET['set_products_value'];
         $select_invoice_product  = $_GET['select_invoice_product'];
        $select_category_id = $_GET['select_category_id'];    
       
        $fetch_query = "SELECT sum(`godown_sith_quantity`) as godown_sith_quantity FROM `godown_6th_floor` WHERE categoryID = '$select_category_id' AND productID = '$set_products_value'";
        $sth = $dbh->prepare($fetch_query);
        // var_dump($fetch_query);
        $result = $sth->execute();
        $count = $sth->rowCount();  
       if($count == 0){
          $temparray['counter']= 0; 
       }else{
            while($rows = $sth->fetch(PDO::FETCH_ASSOC)){

                $avialableQuantity = $rows['godown_sith_quantity'];  
                $temparray['godown_sith_quantity']= $avialableQuantity;
              //  $returnArray[] = $temparray;	
            }	
       }
         echo json_encode($temparray);  
        exit;
    }




       
     
?>
		