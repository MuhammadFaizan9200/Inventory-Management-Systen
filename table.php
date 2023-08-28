

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

    <style type="text/css">
      .input-sm{
        display: none;
      }
      label{
        display: none;
      }
      table  td th {
        border: none !important;
      }
    </style>

<?php

include("headers/connect.php");
include("headers/_user-details.php");

        $array = array();
         //SET @variable = 0;
        $query = "SELECT si.*,si.id as sale_invoice_id ,s.invoiceNumber ,s.invoiceDate,(SELECT product_name FROM products WHERE id = si.`insert_productName`) as productName ,(SELECT debit FROM  invoice_leaders WHERE invoice_id = si.`id`) as debitAmount ,(SELECT credit FROM  invoice_leaders WHERE invoice_id = si.`id`) as creditAmount ,(SELECT  @variable := @variable + (`debit` - `credit`) `Balance` FROM  invoice_leaders WHERE invoice_id = si.`id`) as Balance  ,(SELECT description FROM products WHERE id = si.`insert_productName`) as description ,(SELECT category_name FROM category WHERE id = si.`categoryName`) as categoryName ,(SELECT grossAmount FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '8' ORDER by id DESC LIMIT 1) as grossAmount ,(SELECT `totalDiscount` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '8' ORDER by id DESC LIMIT 1) as totalDiscount ,(SELECT `totalNetAmount` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '8' ORDER by id DESC LIMIT 1) as totalNetAmountGet ,(SELECT `previousBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '8' ORDER by id DESC LIMIT 1) as previousBalance ,(SELECT `openingBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '8' ORDER by id DESC LIMIT 1) as openingBalance,(SELECT `amountReceived` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '8' ORDER by id DESC LIMIT 1) as amountReceived ,(SELECT `payment_status` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as paymentBY ,(SELECT `id` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND customer_id = '1' ORDER by id DESC LIMIT 1) as sale_invoice_details_id  FROM `sale_invoice_details` si , sale_invoice s  WHERE s.id = si.sale_invoice_id and si.`customer_id` ='8'";
           // var_dump($query);
            $count = 1;
            $json = array();
            $sthrt = $dbh->prepare($query);
             $dbh->query('SET @variable := 0');
            $sthrt->execute();
            $counter = 1;
            $invoiceArray = array();
            $returnArray  = array();
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $sale_invoice_id = $rowss['sale_invoice_id'];      
                    $invoiceNumber = $rowss['invoiceNumber'];       
                    $productName = $rowss['productName'];           
                     $categoryName = $rowss['categoryName'];
                     $list_price = $rowss['list_price'];
                     $total_quantity = $rowss['total_quantity'];
                     $discount = $rowss['discount'];
                     $net_price = $rowss['net_price'];
                     $net_amount = $rowss['net_amount'];  
                     $description = $rowss['description'];
                     $grossAmount = $rowss['grossAmount'];
                     $invoiceDate =   $rowss['invoiceDate'];


                    $totalDiscount = $rowss['totalDiscount'];
                    $totalNetAmountGet = $rowss['totalNetAmountGet'];
                    $previousBalance = $rowss['previousBalance'];
                    $amountReceived = $rowss['amountReceived'];
                    $openingBalance = $rowss['openingBalance'];
                    $paymentBY = $rowss['paymentBY'];   
                    $creditAmount = $rowss['creditAmount'];   
                    $debitAmount = $rowss['debitAmount'];   
                    $sale_invoice_details_id = $rowss['sale_invoice_details_id'];
                    $Balance = $rowss['Balance'];
                
                    
                

    echo '<table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Invoice #</th>
                <th></th>
                <th>Debit</th>
                <th>Cradit</th>
                <th>Balance</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>'.$invoiceDate.'</td>
                 <td>'.$invoiceNumber.'</td>
                <td>
                   <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
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
                       
                        
                              # code...

                            
                               echo '<tr>
                                     <td>'.$productName.'</td>
                                      <td>'.$categoryName.'</td>
                                      <td>'.$list_price.'</td>
                                      <td>'.$total_quantity.'</td>
                                      <td>'.$discount.'</td>
                                      <td>'.$net_price.'</td>
                                      <td>'.$net_amount.'</td>
                                    </tr>';
                             
                         
              
                   echo '</table>  


                </td>
                <td>'.$debitAmount.'</td>
                <td>'.$creditAmount.'</td>
                <td>'.$Balance.'</td>
            </tr>
           
            
        </tbody>
    </table><hr>';


                }

               
?>



 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

 <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable();
} );

 </script>>