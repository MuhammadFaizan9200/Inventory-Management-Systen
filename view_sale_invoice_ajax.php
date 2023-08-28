 <?php
    include("headers/connect.php");


    $customerType = $_GET['customerType'];
    $date = $_GET['date'];
    $invoiceType = $_GET['invoiceType'];

    $customArray = array();
    $returnArray = array();
    $inviceArray = array();
    
 
         $fetch_query_details = "SELECT si.*,(SELECT product_name FROM products WHERE id = si.`insert_productName`) as productName ,(SELECT description FROM products WHERE id = si.`insert_productName`) as description ,(SELECT category_name FROM category WHERE id = si.`categoryName`) as categoryName ,(SELECT grossAmount FROM sale_invoice_amount_details WHERE sale_invoice_id = si.`id` AND sale_invoice_id = '$invoiceType' ORDER by id DESC LIMIT 1) as grossAmount ,(SELECT `totalDiscount` FROM sale_invoice_amount_details WHERE sale_invoice_id = si.`id` AND sale_invoice_id = '$invoiceType' ORDER by id DESC LIMIT 1) as totalDiscount ,(SELECT `totalNetAmount` FROM sale_invoice_amount_details WHERE sale_invoice_id = si.`id` AND sale_invoice_id = '$invoiceType' ORDER by id DESC LIMIT 1) as totalNetAmount ,(SELECT `previousBalance` FROM sale_invoice_amount_details WHERE sale_invoice_id = si.`id` AND sale_invoice_id = '$invoiceType' ORDER by id DESC LIMIT 1) as previousBalance ,(SELECT `amountReceived` FROM sale_invoice_amount_details WHERE sale_invoice_id = si.`id` AND sale_invoice_id = '$invoiceType' ORDER by id DESC LIMIT 1) as amountReceived FROM `sale_invoice_details` si , sale_invoice s  WHERE s.id = si.sale_invoice_id and si.`customer_id` ='$customerType' and si.`sale_invoice_id` ='$invoiceType'";
           

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
                     $grossAmount = $rowss['grossAmount'];
                    
                    $totalDiscount = $rowss['totalDiscount'];
                    $totalNetAmount = $rowss['totalNetAmount'];
                    $previousBalance = $rowss['previousBalance'];
                    $amountReceived = $rowss['amountReceived'];
                    
                    
                    $customArray['productName'] = $productName;
                    $customArray['categoryName'] = $categoryName;
                    $customArray['list_price'] = $list_price;
                    $customArray['total_quantity'] = $total_quantity;
                    $customArray['discount'] = $discount;
                    $customArray['net_price'] = $net_price;
                    $customArray['net_amount'] = $net_amount;
                    $customArray['description'] = $description;
                     $customArray['grossAmount'] = $grossAmount;
                     $customArray['totalDiscount'] = $totalDiscount;
                     $customArray['totalNetAmount'] = $totalNetAmount;
                     $customArray['previousBalance'] = $previousBalance;
                     $customArray['amountReceived'] = $amountReceived;
                    
                    $returnArray[] = $customArray;
                    
                }

            echo json_encode($returnArray);
?>            