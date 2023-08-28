<?php

  include("headers/connect.php");
  include("headers/_user-details.php");
  $array = array();
  $temparray = array();




        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $payment_type = $_GET['payment_type'];
        $replort_selection = $_GET['replort_selection'];
        $customerType = $_GET['customerType'];
     

     if($replort_selection == "1"){ 
         $html .= ' <table class="table card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Voucher #</th>
                                        <th>Description</th>
                                        <th>Cheque #</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>';


         $array = array();
		        $query = "SELECT `voucher_number`,`description`,`date`,`check_number`, `debitAmount`,`creditAmount`, @variable := @variable + (`debitAmount` - `creditAmount`) `Balance` ,(SELECT invoiceNumber FROM sale_invoice WHERE id = customer_ledger.`invoice_id`) as invoice_number FROM customer_ledger WHERE customer_id = '$customerType'  and `date` >= '$start_date' and Date <= '$end_date' ORDER BY id ASC";
           // var_dump($query);
            $sthrt = $dbh->prepare($query);
              $dbh->query('SET @variable := 0');
            $sthrt->execute();
            $counter = $sthrt->rowCount();
            if($counter >= 1){
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $date = $rowss['date'];           
                    $voucher_number = $rowss['voucher_number'];
                    $invoice_number = $rowss['invoice_number'];
                    $description = $rowss['description'];
                    $check_number = $rowss['check_number'];
                    $debitAmount = $rowss['debitAmount'];
                     $creditAmount = $rowss['creditAmount'];
                      $Balance = $rowss['Balance'];

                          if($voucher_number == ""){
                              $voucher_number = $invoice_number;
                          }
                         $html .='<tr>
                                 <td>'.$date.'</td>
                                  <td>'.$voucher_number.'</td>
                                  <td>'.$description.'</td>
                                  <td>'.$check_number.'</td>
                                   <td>'.$debitAmount.'</td>
                                    <td>'.$creditAmount.'</td>
                                     <td>'.$Balance.'</td>
                                </tr>';
                     
                }
              }else{
                $html .='<tr>
                                 <td colspan="8" style="text-align: center;color: red;font-weight: bold;">Record not found !</td>
                                </tr>';
              }
             $html .= '</table>' ;          
            echo $html;
    
    }


 if($replort_selection == "3"){ 

     $html .= ' <table class="table card-table">
                                <thead class="thead-light">
                                  <tr>
                                  <th>Description</th>
                                  <th>Account Type</th>
                                   <th>Contact #</th>
                                   <th>Debit</th>
                                   <th>Credit</th>
                                </tr>
                                </thead>';


         $array = array();

         if($customerType == 0){
          $setWhereQueryValue = "";
          //$changepayment_status = "WHERE";
         }else{
            $setWhereQueryValue = "where customer_id = '$customerType' and invoice_id ='0'";
            //$changepayment_status = "and"; 
         }

         if($payment_type == "all"){
            $paymentTypeValue = ""; 
         }else{
            $paymentTypeValue = "where customer_type = '$payment_type' and invoice_id ='0'"; 
         }


            $query = "SELECT customer.customer_type as customer_type  , `description`,`debitAmount`,`creditAmount`, @variable := @variable + (`debitAmount` - `creditAmount`) `Balance` ,(SELECT mobile_1 FROM customer WHERE id = customer_ledger.`customer_id`) as contact_number  FROM customer_ledger LEFT JOIN customer on customer.id = customer_ledger.customer_id $changepayment_status  $paymentTypeValue   ";
            //var_dump($query);
            $sthrt = $dbh->prepare($query);
              $dbh->query('SET @variable := 0');
            $sthrt->execute();
           $counter = $sthrt->rowCount();  
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $description = $rowss['description'];
                    $debitAmount = $rowss['debitAmount'];
                     $creditAmount = $rowss['creditAmount'];
                     $mobile_1 = $rowss['contact_number'];
                     $account_type = $rowss['customer_type'];

                      if($account_type == 1){
                          # code...
                         $account_type_val  = "Cash";
                      }elseif ($account_type == 10) {
                        # code...
                        $account_type_val  = "Bank";
                      }elseif ($account_type == 3) {
                        # code...
                        $account_type_val  = "Expense";
                      }elseif ($account_type == 4) {
                        # code...
                        $account_type_val  = "Supplier";
                      }elseif ($account_type == 5) {
                        # code...
                        $account_type_val  = "Customer";
                      }elseif ($account_type == 6) {
                        # code...
                        $account_type_val  = "Company";
                      }elseif ($account_type == 7) {
                        # code...
                        $account_type_val  = "Others";
                      }


                         
                         $html .='<tr>
                                  <td>'.$description.'</td>
                                   <td>'.$account_type_val.'</td>
                                   <td>'.$mobile_1.'</td>
                                    <td>'.$debitAmount.'</td>
                                     <td>'.$creditAmount.'</td>
                                </tr>';
                            $debitAmountSun +=  $debitAmount;
                            $creditAmountSum += $creditAmount;
                     
                }
                $html .= '<tfoot>
                    <tr>
                         <th  colspan="3" style="text-align: center;">Total</th>
                         <td>'.$debitAmountSun.'</td>
                         <td>'.$creditAmountSum.'</td>
                      </tr>
                  </tfoot>';
              
              

             $html .= '</table>' ;          
            echo $html;

 }

   if($replort_selection == "2"){ 
         $html .= ' <table class="table card-table">
                                <thead class="thead-light">
                                   <tr>
                                    <th>Date</th>
                                    <th>Voucher #</th>
                                     <th>Name / Description</th>
                                     <th>Qty.</th>
                                     <th>Rate</th>
                                     <th>%</th>
                                     <th>Bill Amount</th>
                                     <th>Debit</th>
                                     <th>Credit</th>
                                     <th>Balance</th>
                                  </tr>
                                </thead>';


         $array = array();
            $query = "SELECT `voucher_number`,`description`,`date`,`check_number`, `debitAmount`,`creditAmount`, @variable := @variable + (`debitAmount` - `creditAmount`) `Balance` ,(SELECT invoiceNumber FROM sale_invoice WHERE id = customer_ledger.`invoice_id`) as invoice_number  ,(SELECT GROUP_CONCAT((SELECT product_name FROM products WHERE id = sale_invoice_details.insert_productName ),'***',(SELECT category_name FROM category WHERE id = sale_invoice_details.categoryName),'***',  `total_quantity` , '***' , `list_price` , '***' ,`discount`,'***' ,`net_amount`) FROM sale_invoice_details  WHERE `sale_invoice_id` = customer_ledger.invoice_id) as product_details  FROM customer_ledger WHERE customer_id = '$customerType'  and `date` >= '$start_date' and Date <= '$end_date' ORDER BY id ASC";
           // var_dump($query);
            $sthrt = $dbh->prepare($query);
              $dbh->query('SET @variable := 0');
            $sthrt->execute();
            $counter = $sthrt->rowCount();
          if($counter >= 1){   
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $date = $rowss['date'];           
                    $voucher_number = $rowss['voucher_number'];
                    $invoice_number = $rowss['invoice_number'];
                    $description = $rowss['description'];
                    $check_number = $rowss['check_number'];
                    $debitAmount = $rowss['debitAmount'];
                     $creditAmount = $rowss['creditAmount'];
                      $Balance = $rowss['Balance'];
                      $product_details = $rowss['product_details'];
                      $product_details_1 = explode(",", $product_details);

                          if($voucher_number == ""){
                              $voucher_number = $invoice_number;
                          }
                         $html .='<tr>
                                 <td>'.$date.'</td>
                                  <td>'.$voucher_number.'</td>
                                  <td colspan="5">
                              <table width="100%" border="0">';

                            if(!empty($product_details_1)){  
                             foreach ($product_details_1 as $key => $value) {
                                    # code...
                                    if(!empty($value)){

                                    $value = explode("***", $value); 

                                    $product_name = $value[0];
                                    $category_name = $value[1];                                   
                                    $quantity = $value[2];
                                    $list_price = $value[3];
                                    $discount =  $value[4];
                                    $net_amount = $value[5];

                               $html .='<tbody>
                                    <tr>
                                       <td width="43%">'.$product_name.' ('.$category_name.')</td>
                                        <td width="11%" style="text-align: center;">'.$quantity.'</td>
                                       <td width="12%" style="text-align: center;">'.$list_price.'</td>
                                       <td width="6%" style="text-align: center;">'.$discount.'</td>
                                       <td width="28%" style="text-align: center;">'.$net_amount.'</td>
                                      
                                    </tr>
                                 </tbody>';
                             }
                             }
                         }
                               $html .='</table>
                                       </td>
                                 
                                   <td>'.$debitAmount.'</td>
                                    <td>'.$creditAmount.'</td>
                                     <td>'.$Balance.'</td>
                                </tr>';
                     
                }
              }else{
                        $html .='<tbody>
                                    <tr>
                                       <td width="43%">Data not found!</td>
                                    </tr>
                                 </tbody>';
              }
             $html .= '</table>' ;          
            echo $html;
    
    }



    ?>


