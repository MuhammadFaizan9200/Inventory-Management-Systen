<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
$returnArray =array();

    if(@$_GET['status']){
        $status = $_GET['status'];
        $bank_check_id_hidden = $_GET['bank_check_id'];
        $sale_invoice_detail_id = $_GET['sale_invoice_detail_id'];
        $totalNetAmountHidden =  $_GET['amount'];
        
        
        if($status == "Pending"){
            $status_value = "1";
        }else if($status == "Clear"){
            $status_value = "3";
        }else if($status == "Exchange"){
            $status_value = "4";
        }else{
            $status_value = "2";
        }
        
        
    if($status == "Clear"){    
        
        $fetch_query = "SELECT customer_id FROM `sale_invoice_amount_details` WHERE `id` = '$sale_invoice_detail_id'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        $customer_id = $rows['customer_id'];
              
        
        $balace_query = "SELECT opening_balance FROM `customer` WHERE `id` = '$customer_id'";
        $sthrt = $dbh->prepare($balace_query);
        $sthrt->execute();
        $rowss = $sthrt->fetch(PDO::FETCH_ASSOC);
        $opening_balance = $rowss['opening_balance'];
        
        
        $remainingOpeningBalance = $opening_balance -  $totalNetAmountHidden;
        
        
        
        $update_query_customer = "UPDATE `customer` SET `opening_balance`= '$remainingOpeningBalance'  WHERE `id` = '$customer_id'";
        $stmtes = $dbh->prepare($update_query_customer);
        $stmtes->execute();
        
        
        
        $update_query_detail = "UPDATE `sale_invoice_amount_details` SET `amountReceived`= '$totalNetAmountHidden' ,`payment_status`= '2' WHERE `id` = '$sale_invoice_detail_id'";
        $stmtttes = $dbh->prepare($update_query_detail);
        $stmtttes->execute();  
        
        
        
        $update_query_bank = "UPDATE `check _records` SET `status`= '$status_value' WHERE `id` = '$bank_check_id_hidden'";
        $stmttte = $dbh->prepare($update_query_bank);
        $stmttte->execute();  
        
        echo "success";
    }else{
      $update_query_bank = "UPDATE `check _records` SET `status`= '$status_value' WHERE `id` = '$bank_check_id_hidden'";
        $stmttte = $dbh->prepare($update_query_bank);
        $stmttte->execute();  
        var_dump($update_query_bank);
    }

    }

    

     if(@$_GET['invoice_id']){
        $invoice_id = $_GET['invoice_id'];
     
         $array = array();
		$query = "SELECT cr.* ,(SELECT bank_name FROM banks WHERE id = cr.bank) as bank_name ,(SELECT id from sale_invoice_amount_details WHERE sale_invoice_id = si.id) as sale_invoice_detail_id   FROM `check _records` cr , sale_invoice si  WHERE  si.id = cr.`sale_invoice_id` and `sale_invoice_id` ='$invoice_id'";
        	$result = mysqli_query($conn,$query); 
         
            $count = 1;
            $json = array();
           $html = '<table class="table product-discounts-edit" id="datatable">
                <tr class="">
                <th width ="80px;">Serial #</th>
                <th >Account Title</th>
                <th width ="130px;">Account Number</th>
                <th width ="130px;">Bank</th>
                <th>Check Clear Date</th>
                <th>Check Issue Date</th>
                <th width ="130px;">Status</th>
                <th width ="130px;">Amount</th>
                <th width ="130px;">Check Status</th>
                <th width ="130px;">Add New Checks</th>
                   </tr>';
            
			while($row = mysqli_fetch_assoc($result))
			{
                $bank_check_id = $row['id'];
                $account_title = $row['account_title'];
				$account_number = $row['account_number'];
				$bank =$row['bank'];
                $status =$row['status'];
                $amount =$row['amount'];
                 $check_date = $row['check_date'];
                $current_date  = $row['current_date'];
                $sale_invoice_detail_id  = $row['sale_invoice_detail_id'];
                 $payment_status  = $row['status'];
                $customer_id  = $row['customer_id'];
               	$checkDate = strtotime($check_date . "UTC");
                $checkDate_convert = date('d-M-Y', $checkDate); 
                
                
                
				if($payment_status == 1){
                    $exchangeTD = '--';
                    $statusHtml = "Pending"; 
                    $payment_statuHtml = '<span class="badge badge-pill badge-primary">Pending</span>';
                }else if($payment_status == 2){
                    $exchangeTD = '--';
                    $statusHtml = "Return";
                    $payment_statuHtml = '<span class="badge badge-pill badge-success">Return</span>';
                }else if($payment_status == 4){
                    $statusHtml = "Exchange";
                    $exchangeTD = '<img src="assets/img/plus.svg" class="payment_by_bank"  data-toggle="modal" data-target="#modals-default"  style="width:25px;height:25px;cursor:pointer">';
                    $payment_statuHtml = '<span class="badge badge-pill badge-info">Exchange</span>';
                }else{
                    $statusHtml = "Clear";
                    $exchangeTD = '--';
                    $payment_statuHtml = '<span class="badge badge-pill badge-danger">Clear</span>';
                 }
             $html .= '<tbody><tr>
						<td>'.$count++.'</td>
						<td>'.$account_title.'</td>
						<td align="center">'.$account_number.'</td>
                        <td>'.$bank.'</td>
                    <td>'.$check_date.'</td>
                         <td>'.$current_date.'</td>
                         <td><span class="status-div">'.$payment_statuHtml.'</div><input type="hidden" value="'.$status.'" class="payment_statuHtml"><input type="hidden" value="'.$amount.'" class="amount"><input type="hidden" value="'.$bank_check_id.'" class="bank_check_id"><input type="hidden" value="'.$sale_invoice_detail_id.'" class="sale_invoice_detail_id"><input type="hidden" value="'.$customer_id.'" class="customer_id"></td>
                          <td>'.$amount.'</td>
                        <td style="display: flex;align-items: center;align-content: center;"><div class="input-group-prepend" style="margin:0 auto;">
                                                
                                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" status ='.$statusHtml.' href="javascript:void(0)" >Clear</a>
                                                    <a class="dropdown-item" status ='.$statusHtml.' href="javascript:void(0)">Return</a>
                                                    <a class="dropdown-item" status ='.$statusHtml.' href="javascript:void(0)">Pending</a>
                                                    <a class="dropdown-item" status ='.$statusHtml.' href="javascript:void(0)">Exchange</a>
                                            </div></td> 
                            <td>'.$exchangeTD.'</td>                
                        </tr>
                        </tbody>';
             }
            $html .= '</table>';
            
            echo $html;
            
         
         
     }
    

?>