<?php

include("headers/connect.php");
include("headers/_user-details.php");

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
      border-bottom: 1px solid #ddd !important;
      border-top: 0px solid #ddd !important;
    }

</style>

<body>

    <?php
        $array = array();
        $query = "SELECT si.*,(SELECT product_name FROM products WHERE id = si.`insert_productName`) as productName ,(SELECT description FROM products WHERE id = si.`insert_productName`) as description ,(SELECT category_name FROM category WHERE id = si.`categoryName`) as categoryName ,(SELECT grossAmount FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as grossAmount ,(SELECT `totalDiscount` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as totalDiscount ,(SELECT `totalNetAmount` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as totalNetAmountGet ,(SELECT `previousBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as previousBalance ,(SELECT `openingBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as openingBalance,(SELECT `amountReceived` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as amountReceived ,(SELECT `payment_status` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as paymentBY ,(SELECT `id` FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` AND sale_invoice_id = '1' ORDER by id DESC LIMIT 1) as sale_invoice_details_id  FROM `sale_invoice_details` si , sale_invoice s  WHERE s.id = si.sale_invoice_id and si.`sale_invoice_id` ='1'";
           // var_dump($query);
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
                    $sale_invoice_details_id = $rowss['sale_invoice_details_id'];

                    $invoiceArray['productName'] = $productName;
                    $invoiceArray['categoryName'] = $categoryName;
                    $invoiceArray['list_price'] = $list_price;
                    $invoiceArray['total_quantity'] = $total_quantity;
                    $invoiceArray['discount'] = $discount;
                    $invoiceArray['net_price'] = $net_price;
                    $invoiceArray['net_amount'] = $net_amount;
                    $invoiceArray['description'] = $description;
                    $returnArray[] = $invoiceArray;

                }

                // print_r($returnArray);


    ?>



<div class="container">       
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Vouchar #</th>
        <th></th>
        <th>Debit</th>
        <th>Cradit</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1/1/2019</td>
         <td>12345</td>
        <td>
         <table class="table">
            <tr>
              <th>Product Name</th>
              <th>Category Type</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Discount</th>
              <th>Net Price</th>
              <th>Net Amount</th>
            </tr>
          <?php
                foreach ($returnArray as $key => $value) {
                    # code...
                    // print_r($value);
                      $productName = $value['productName'];
                      $categoryName = $value['categoryName'];
                      $list_price = $value['list_price'];
                      $total_quantity = $value['total_quantity'];
                      $discount = $value['discount'];
                       $net_price = $value['net_price'];
                        $net_amount = $value['net_amount'];
                     $description = $value['description'];
                     echo '<tr>
                           <td>'.$productName.'</td>
                            <td>'.$categoryName.'</td>
                            <td>'.$list_price.'</td>
                            <td>'.$total_quantity.'</td>
                            <td>'.$discount.'</td>
                            <td>'.$net_price.'</td>
                            <td>'.$net_amount.'</td>
                          </tr>';
                   
                }
                ?>
         </table> 
          

        </td>
        <td>2000</td>
        <td></td>
        <td>2000</td>
      </tr>
      
    </tbody>
  </table>
</div>

</body>
</html>