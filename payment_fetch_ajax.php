<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();





    if(@$_GET['customerType']){
        $paymentType = $_GET['paymentType'];
         $customerType = $_GET['customerType'];
        
        if($paymentType == 1){
            $fetch_query = "SELECT id, creditAmount as amount , `date` as payment_date  FROM `owner_ledger` WHERE `status` = 1 and `customer_id` = '$customerType' and paid_status ='0' ";    
        }else{
            $fetch_query = "SELECT id, amount , `current_date` as payment_date ,account_title ,account_number  FROM `customer_bank_records` WHERE `customer_id` = '$customerType' AND `status` =2 and paid_status ='0' ";
        }
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $amount = $rows['amount'];  
            $payment_date = $rows['payment_date'];  
            $account_title = $rows['account_title'];  
            $account_number = $rows['account_number'];  
                
            $temparray['id']= $id;
            $temparray['amount']= $amount;
             $temparray['payment_date']= $payment_date;
              $temparray['account_title']= $account_title;
               $temparray['account_number']= $account_number;
            $returnArray['owner_leadger'][] = $temparray;	
        }	
         echo json_encode($returnArray);  
        exit;
    }


     if(@$_GET['ownerBankList']){
        $ownerBankList = $_GET['ownerBankList'];
        
        
        
      $fetch_query = "SELECT id, `account_title` , `account_number`,`customer_id` FROM `customer_bank_records` WHERE `bank_id` = '$ownerBankList' AND `transfer_status` = 0";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $account_title = $rows['account_title'];  
            $account_number = $rows['account_number'];  
            $customer_id = $rows['customer_id'];  
           
            $temparray['id']= $id;
            $temparray['account_title']= $account_title;
             $temparray['customer_id']= $customer_id;
             $temparray['account_number']= $account_number;
            $returnArray['chequeList'][] = $temparray; 
        } 
         echo json_encode($returnArray);  
        exit;
    }


     if(@$_GET['chequeList']){
        $chequeList = $_GET['chequeList'];
         $chequeList_expl = explode(",", $chequeList);
         $chequeList_id =  $chequeList_expl[0];
        
        
      $fetch_query = "SELECT  `amount` FROM `customer_bank_records` WHERE `id` = '$chequeList_id'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        // var_dump($fetch_query);
        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $amount = $rows['amount'];  
          
           
            $temparray['amount']= $amount;

            
        } 
         echo json_encode($temparray);  
        exit;
    }


     
?>
		