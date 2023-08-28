<?php

         include("headers/connect.php");
         $invoice_id = $_GET['invoice_id'];
         $customer_id = $_GET['customer_id'];    
         $invoiceDate = $_GET['invoiceDate'];    
  




        $fetch_query = "SELECT i.*,i.id as saleInvoiceId,c.* FROM `sale_invoice` i , customer c WHERE c.id = i.customer_id and  c.`id` ='$customer_id' and invoiceDate ='$invoiceDate'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
             $invoiceNumber = $rows['invoiceNumber'];           
             $invoiceDate = $rows['invoiceDate'];
             $invoiceDate = $rows['invoiceDate'];
             $customer_name = $rows['customer_name'];
             $customerAddress = $rows['customerAddress'];
             $mobile_1 = $rows['mobile_1'];
            $saleInvoiceId = $rows['saleInvoiceId'];

?>





<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="http://via.placeholder.com/400x90?text=logo">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice <?php echo @$invoiceNumber ?></p>
                            <p class="text-muted">Due to: <?php echo @$invoiceDate ?></p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1"><?php echo @$customer_name ?></p>
                            <p class="mb-1"><?php echo @$customerAddress ?></p>
                            <p class="mb-1"><?php echo @$mobile_1 ?></p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                            <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">Sno</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Product Type</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Product Name</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Discount</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Net Price</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Net Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php
                                        $fetch_query_details = "SELECT si.*,(SELECT product_name FROM products WHERE id = si.`insert_productName`) as productName ,(SELECT description FROM products WHERE id = si.`insert_productName`) as description ,(SELECT category_name FROM category WHERE id = si.`categoryName`) as categoryName FROM `sale_invoice_details` si  WHERE si.`customer_id` ='$customer_id' and si.`sale_invoice_id` ='$saleInvoiceId'";
                                        $stht = $dbh->prepare($fetch_query_details);
                                        $result = $stht->execute();
                                        $count = 1;    
                                        while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                            $productName = $rowss['productName'];           
                                             $categoryName = $rowss['categoryName'];
                                             $list_price = $rowss['list_price'];
                                             $total_quantity = $rowss['total_quantity'];
                                             $discount = $rowss['discount'];
                                             $net_price = $rowss['net_price'];
                                	         $net_amount = $rowss['net_amount'];  
                                             $description = $rowss['description'];  
                                            
                                            echo '<tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$categoryName.'</td>
                                                    <td>'.$productName.'</td>
                                                    <td>'.$description.'</td>
                                                    <td>'.$list_price.'</td>
                                                    <td>'.$total_quantity.'</td>
                                                    <td>'.$discount.'</td>
                                                    <td>'.$net_price.'</td>
                                                    <td>'.$net_amount.'</td>
                                                </tr>';
                                            
                                            $count++;
                                        }
                                             
                                    ?>
                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        
                        <?php
                            
                             $fetch_query_balan = "SELECT * FROM `sale_invoice_amount_details` WHERE `sale_invoice_id` ='$invoice_id'";
                             $sthtt = $dbh->prepare($fetch_query_balan);
                             $result = $sthtt->execute();
                             $rowsd = $sthtt->fetch(PDO::FETCH_ASSOC);
                                 $grossAmount = $rowsd['grossAmount'];           
                                 $totalDiscount = $rowsd['totalDiscount'];
                                 $totalNetAmount = $rowsd['totalNetAmount'];
                                 $previousBalance = $rowsd['previousBalance'];
                                 $amountReceived = $rowsd['amountReceived'];
                                    
                                echo '<div class="py-3 px-5 text-right">
                                        <div class="mb-2">Gross Amount</div>
                                        <div class="h2 font-weight-light">'.$grossAmount.'</div>
                                    </div>

                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2">Discount</div>
                                        <div class="h2 font-weight-light">'.$totalDiscount.'%</div>
                                    </div>

                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2">Net Amount</div>
                                        <div class="h2 font-weight-light">'.$totalNetAmount.'</div>
                                    </div>
                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2">Cash Received</div>
                                        <div class="h2 font-weight-light">'.$amountReceived.'</div>
                                    </div>
                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2">Balance</div>
                                        <div class="h2 font-weight-light">'.$previousBalance.'</div>
                                    </div>';
                        
                        ?>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

</div>

<script>
     window.print();
</script>
