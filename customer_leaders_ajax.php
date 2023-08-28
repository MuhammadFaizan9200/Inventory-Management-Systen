<?php

include("headers/connect.php");
include("headers/_user-details.php");
$array = array();
$temparray = array();
if(@$_GET['customerType']){
        $customerType = $_GET['customerType'];
     
             $array = array();
    		$query = "SELECT * FROM `sale_invoice` WHERE `customer_id` = '$customerType' order by id asc";
        	$sthrt = $dbh->prepare($query);
            $sthrt->execute();
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    # code...
                $id = $rowss['id'];
                $invoiceNumber = $rowss['invoiceNumber'];
                $invoiceDate = $rowss['invoiceDate'];
                $contactPerson = $rowss['contactPerson'];
                $contactNumber = $rowss['contactNumber'];
                $deliveredBy = $rowss['deliveredBy'];


                $temparray['invoiceNumber']= $invoiceNumber;
                $temparray['invoiceDate']= $invoiceDate;
                $temparray['contactPerson']= $contactPerson;
                $temparray['contactNumber']= $contactNumber;
                $temparray['deliveredBy']= $deliveredBy;
                 $temparray['id']= $id;

                $returnArray['sale_invoice'][] = $temparray;    
        }
        echo json_encode($returnArray);      
            
         
     }

  if(@$_GET['invoice_id']){
        $invoice_id = $_GET['invoice_id'];
     
         $html .= ' <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                      <thead>
                          <tr>
                               <th>Product Name</th>
                              <th>Category Type</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Discount</th>
                              <th>Net Price</th>
                              <th>Net Amount</th>    
                          </tr>
                        </thead>';


         $array = array();
		$query = "SELECT si.*,(SELECT debit FROM  invoice_leaders WHERE invoice_id = si.`id`) as debitAmount ,(SELECT credit FROM  invoice_leaders WHERE invoice_id = si.`id`) as creditAmount ,(SELECT product_name FROM products WHERE id = si.`insert_productName`) as productName ,(SELECT description FROM products WHERE id = si.`insert_productName`) as description ,(SELECT category_name FROM category WHERE id = si.`categoryName`) as categoryName ,(SELECT grossAmount FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as grossAmount ,(SELECT `totalDiscount` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as totalDiscount ,(SELECT `totalNetAmount` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as totalNetAmountGet ,(SELECT `previousBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as previousBalance ,(SELECT `openingBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as openingBalance,(SELECT `amountReceived` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as amountReceived ,(SELECT `payment_status` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as paymentBY ,(SELECT `id` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '$invoice_id' ORDER by id DESC LIMIT 1) as sale_invoice_details_id  FROM `sale_invoice_details` si , sale_invoice s  WHERE s.id = si.sale_invoice_id and si.`sale_invoice_id` ='$invoice_id'";
           // var_dump($query);
            $count = 1;
            $json = array();
            $count = 1;
            $json = array();
            $sthrt = $dbh->prepare($query);
            $sthrt->execute();
            $counter = 1;
            $invoiceArray = array();
            $returnArray  = array();
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $productName = $rowss['productName'];           
                     $categoryName = $rowss['categoryName'];
                     $list_price = $rowss['list_price'];
                     $total_quantity = $rowss['total_quantity'];
                     $discount = $rowss['discount'];
                     $net_price = $rowss['net_price'];
                     $net_amount = $rowss['net_amount'];  
                     $description = $rowss['description'];
                     $grossAmount = $rowss['grossAmount'];
                      


                    $totalDiscount = $rowss['totalDiscount'];
                    $totalNetAmountGet = $rowss['totalNetAmountGet'];
                    $previousBalance = $rowss['previousBalance'];
                    $amountReceived = $rowss['amountReceived'];
                    $openingBalance = $rowss['openingBalance'];
                    $paymentBY = $rowss['paymentBY'];   
                    $creditAmount = $rowss['creditAmount'];   
                    $debitAmount = $rowss['debitAmount'];   
                    $sale_invoice_details_id = $rowss['sale_invoice_details_id'];

                  

                     if($creditAmount > 0){
                      $balanceAmount = "0";    
                     }else{
                      $balanceAmount = $creditAmount - $debitAmount;  
                     } 
                    
                   # code...
                       
                        $html .='<tr>
                             <td>'.$productName.'</td>
                              <td>'.$categoryName.'</td>
                              <td>'.$list_price.'</td>
                              <td>'.$total_quantity.'</td>
                              <td>'.$discount.'</td>
                              <td>'.$net_price.'</td>
                              <td>'.$net_amount.'</td>
                            </tr>';
                     
                }
               
             $html .= '</table>' ;          


             $html .= ' <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                      <thead>
                          <tr>
                            <th>Opening Balance</th>
                                <td>'.$openingBalance.'</td>
                              </tr>
                              <tr>  
                              <th>Debit</th>
                              <td>'.$debitAmount.'</td>
                              </tr>
                              <tr>
                              <th>Credit</th>
                              <td>'.$creditAmount.'</td>
                              </tr>
                              <tr>
                              <th>Balance</th>
                             <td>'.$balanceAmount.'</td>
                          </tr>
                        </thead></table>';


           $html .= '<div class="form-row" style="float: right;"><div class="form-group col mb-4"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div></div>';
            
            echo $html;
     }
                    


     if(@$_GET['customer_id']){
        $customer_id = $_GET['customer_id'];
        $html = "";
         $html .= '<div class="row">
      <!-- <h2 style="text-align: center;">Monthly wise customer leadger</h2>  -->
      <div class="table-responsive">
         <div class="table-responsive custom_datatable">
            <table class="table table-bordered" style="width:100%;margin:auto;text-align:left;" >
               <tbody>
                  <tr>
                     <th width="50">Date</th>
                     <th colspan="1">Description</th>
                     <th width="50">Debit</th>
                     <th width="50">Credit</th>
                     <th width="50">Balance</th>
                  </tr>';


          $array = array();
   
          $query = "SELECT id,description,`date`, `debitAmount`, `creditAmount`, @variable := @variable + (`debitAmount` - `creditAmount`) `Balance` FROM          customer_ledger WHERE  customer_id = '$customer_id'  ORDER BY Balance DESC";
            $sthrt = $dbh->prepare($query);
            $dbh->query('SET @variable := 0');
            $sthrt->execute();

            $counter = 1;
             $returnArray = array();
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $date = $rowss['date'];     
                     $date_explode = explode("-", $date);
                     $month = $date_explode[1];     
                      $dateObj   = DateTime::createFromFormat('!m', $month);
                      $monthName = $dateObj->format('F'); // March
                     $monthArray[] = $monthName;   
                      $returnArray[$monthName][] = $rowss;
                  }
                   # code...
                  foreach ($returnArray as $key => $value) {
                        $html .='<tr>
                             <td colspan="5" style="    font-size: 12px;
                                font-weight: bold;
                                text-align: center;">Month Of '.$key.' 2020</td>
                          </tr>';
                          //print_r($value);
                        foreach ($value as $value_tr) {  
                         $description_get = $value_tr['description'];
                          $debit_get = $value_tr['debitAmount'];
                         $credit_get = $value_tr['creditAmount'];
                         $Balance_get = $value_tr['Balance'];
                         $date_get = $value_tr['date'];  

                         $old_date_timestamp = strtotime($date_get);
                          $new_date = date('l, F d Y', $old_date_timestamp);      

                          $html .='<tr>
                             <td width="50">'.$new_date.'</td>
                             <td colspan="1">'.$description_get.'</td>
                             <td width="50">'.$debit_get.'</td>
                             <td width="50">'.$credit_get.'</td>
                             <td width="50">'.$Balance_get.'</td>
                          </tr>';
                        }
                }
               
             $html .= '</tbody>
                        </table>
                  </div>
                  </div>
              </div>' ;          


          
            echo $html;
     } 









    ?>


