<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();

    if(@$_GET['set_products_value']){
        $set_products_value = $_GET['set_products_value'];
        
        
        $fetch_query = "SELECT id,`description`,`date`,`invoice_id`,`rate`, `plus_full`, `minus_full`, @variable := @variable + (`plus_full` - `minus_full`) `Balance` , (SELECT `date` from  inventory_history WHERE product_id ='$set_products_value' ORDER by id ASC , time_stamp asc LIMIT 1) as start_date ,(SELECT `date` from  inventory_history WHERE product_id ='$set_products_value' ORDER by id DESC , time_stamp asc LIMIT 1) as end_date FROM inventory_history WHERE  product_id = '$set_products_value'  ORDER BY id ASC";
        $sth = $dbh->prepare($fetch_query);
         $dbh->query('SET @variable := 0');
        $result = $sth->execute();
        // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $description = $rows['description'];  
              $plus_full = $rows['plus_full'];  
              $minus_full = $rows['minus_full'];  
              $Balance = $rows['Balance'];  
              $date = $rows['date'];  
              $invoice_id = $rows['invoice_id'];  
              $rate = $rows['rate'];  
              $start_date = $rows['start_date'];  
              $end_date = $rows['end_date'];  

              $start_date = strtotime($start_date);
              $start_date_convert = date('d-F-Y', $start_date); 

              $end_date = strtotime($end_date);
              $end_date_convert = date('d-F-Y', $end_date); 


            $temparray['id']= $id;
            $temparray['description']= $description;
             $temparray['plus_full']= $plus_full;
             $temparray['minus_full']= $minus_full;
              $temparray['Balance']= $Balance;
               $temparray['date']= $date;
                $temparray['invoice_id']= $invoice_id;
                 $temparray['rate']= $rate;
                 $temparray['start_date_convert']= $start_date_convert;
                 $temparray['end_date_convert']= $end_date_convert;
            $returnArray['history'][] = $temparray;	
        }	
        echo json_encode($returnArray);  
        exit;   
    }  

   
?>
		