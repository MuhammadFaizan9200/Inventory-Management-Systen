<?php

    include("headers/connect.php");
    require("fpdf/fpdf.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ob_start();

    $get_invoice_id = $_GET['get_invoice_id'];
    $get_customer_id = $_GET['get_customer_id'];
    $company_id = $_GET['company_id'];
    $date = gmdate("Y-m-d G:i:s");

    $returnArray = array();
    $returnValues = array();
      $fetch_query_details = "SELECT s.invoiceCreate,s.invoiceNumber,s.invoiceDate ,(SELECT saleman_name FROM saleman where id = si.saleman_id) as saleman_name ,(SELECT COUNT(id) FROM  sale_invoice_details WHERE sale_invoice_id = s.id and sale_invoice_id = $get_invoice_id and customer_id = '$get_customer_id') as total_number_items ,(SELECT SUM(total_quantity) FROM  sale_invoice_details WHERE sale_invoice_id = s.id and sale_invoice_id = $get_invoice_id and customer_id = '$get_customer_id') as sum_of_quantity, si.*,(SELECT GROUP_CONCAT(product_name , '***' , description) FROM products WHERE id = si.`insert_productName` and si.sale_invoice_id = $get_invoice_id and si.customer_id = '$get_customer_id') as productNameDesc  ,(SELECT  GROUP_CONCAT(grossAmount , '***' , `totalDiscount` ,'***',`totalNetAmount` ,'***' ,`amountReceived`) FROM sale_invoice_amount_details WHERE sale_invoice_id = s.`id` and sale_invoice_id = $get_invoice_id and customer_id = '$get_customer_id' ORDER by id DESC LIMIT 1) as grossAmountDiscount ,(SELECT `previousBalance`  FROM sale_invoice_amount_details WHERE customer_id = '$get_customer_id' and company_id = '$company_id' ORDER by id DESC LIMIT 1,1) as previousBalance ,(SELECT GROUP_CONCAT(customer_name , '***',address) FROM customer WHERE id = s.customer_id) as customer_details  FROM `sale_invoice_details` si , sale_invoice s  WHERE s.id = si.sale_invoice_id and si.`customer_id` ='$get_customer_id' and si.`sale_invoice_id` ='$get_invoice_id'";
        print_r($fetch_query_details);
            $stht = $dbh->prepare($fetch_query_details);
            $result = $stht->execute();
            while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                
                     $productNameDesc = $rowss['productNameDesc'];
                     
                     $invoiceCreate  = $rowss['invoiceCreate'];
                     $invoiceNumber = $rowss['invoiceNumber'];
                     $invoiceDate = $rowss['invoiceDate'];
                     $saleman_name = $rowss['saleman_name'];
                     

                     $total_number_items = $rowss['total_number_items'];
                     $sum_of_quantity = $rowss['sum_of_quantity'];
                     $previousBalance = $rowss['previousBalance'];

                     $productNameDesc = explode('***', $productNameDesc);


                     $productName = $productNameDesc[0];   
                     $description = $productNameDesc[1];   

                     $grossAmountDiscount  = $rowss['grossAmountDiscount'];  
                     if(!empty($grossAmountDiscount)){
                        $grossAmountDiscount = explode('***', $grossAmountDiscount); 

                         $grossAmount = $grossAmountDiscount[0];
                         $totalDiscount = $grossAmountDiscount[1];
                         $totalNetAmount = $grossAmountDiscount[2];
                        // $previousBalance = $grossAmountDiscount[3];
                         $amountReceived = $grossAmountDiscount[3];    

                     }

                     $totalReceivable = $previousBalance + $totalNetAmount;

                     $customer_details  = $rowss['customer_details'];  
                     $customer_details = explode('***', $customer_details);
                     $customer_name = ucwords($customer_details[0]);
                     $address = $customer_details[1]; 

                     $list_price = $rowss['list_price'];
                     $total_quantity = $rowss['total_quantity'];
                     $discount = $rowss['discount'];
                     $net_price = $rowss['net_price'];
                     $net_amount = $rowss['net_amount'];  
                   
                     $returnArray['productName'] = $productName;
                     $returnArray['description'] = $description;
                     $returnArray['grossAmount'] = $grossAmount;
                     $returnArray['totalDiscount'] = $totalDiscount;
                     $returnArray['totalNetAmount'] = $totalNetAmount;
                     $returnArray['previousBalance'] = $previousBalance;
                     $returnArray['amountReceived'] = $amountReceived;
                     $returnArray['customer_name'] = $customer_name;
                     $returnArray['total_quantity'] = $total_quantity;
                     $returnArray['discount'] = $discount;
                     $returnArray['net_price'] = $net_price;
                     $returnArray['net_amount'] = $net_amount;
                     $returnArray['list_price'] = $list_price;



                     $returnValues[] = $returnArray;

                    
                }



        $number =   $totalNetAmount;      
        $no = round($number);
           $point = round($number - $no, 2) * 100;
           $hundred = null;
           $digits_1 = strlen($no);
           $i = 0;
           $str = array();
           $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
           $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
           while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
             } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          $points = ($point) ?
            "." . $words[$point / 10] . " " . 
                  $words[$point = $point % 10] : '';
        $rupees_value =  ucwords($result) . "Rupees";               


    $fpdf = new FPDF("p",'mm','A4');
    $fpdf->addPage();

    $fpdf->SetFont('Times','B',14 );
    $fpdf->Cell(189,2,'AHMED TRADERS',0,1,'C');

    $fpdf->SetFont('Times','',8 );
    $fpdf->Cell(88);
    $fpdf->Cell(15,5,'OLD CITY AREA',0,1,'C');

    $fpdf->SetFont('Times','',9 );
    $fpdf->Cell(66);
    $fpdf->Cell(60,4,'CELL:03219257700',0,1,'C');


    $fpdf->SetFont('Times','B',10 );
    $fpdf->Cell(66);
    $fpdf->Cell(60,2,'SALE INVOICE',0,1,'C');

     


    $fpdf->Cell(220,5,'',0,1);
     $fpdf->SetFont('Times','B',8);

    //Cell width , height,border.text
    $fpdf->Cell(130,4,'Invoice Number : '.$invoiceNumber.' ',0,0);
    $fpdf->Cell(50,4,'Date : '.$date.' ',0,1);
    $fpdf->Cell(130,4,'Customer Name : '.$customer_name.' ',0,0);
    $fpdf->Cell(50,4,'Inputed By: '.$invoiceCreate.' ',0,1);

    $fpdf->Cell(130,4,'Address : '.$address.' ',0,0);
    $fpdf->Cell(50,4,'Booker Name : '.$saleman_name.' ',0,1);

     $fpdf->Cell(130,4,'Remarks :   ',0,0);
     $fpdf->Cell(50,4,'Saleman : '.$saleman_name.' ',0,1);
     $fpdf->Cell(130,4,'NTN # : 3024874-4',0,0);
    

    $fpdf->Cell(189,5,'',0,1);
    // Invoice content

    $fpdf->SetFont('Times','B',8 );
    $fpdf->Cell(60,7,'Item Description', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Quantity', 'T B', 0, 'L');
    $fpdf->Cell(20,7,'Price Rs.', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Total Value', 'T B', 0, 'L');
    $fpdf->Cell(20,7,'Disc %', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Amount', 'T B', 1, 'L');
  

    $fpdf->SetFont('Times','',8);

    
        foreach ($returnValues as $key => $value) {
            # code...
                
                    $productName = $value['productName'];           
                     $list_price = $value['list_price'];
                     $total_quantity = $value['total_quantity'];
                     $discount = $value['discount'];
                     $net_price = $value['net_price'];
                     $net_amount = $value['net_amount'];  
                     $description = $value['description'];
                     $grossAmount = $value['grossAmount'];
                    
                    $totalDiscount = $value['totalDiscount'];
                    $totalNetAmount = $value['totalNetAmount'];
                    $previousBalance = $value['previousBalance'];
                    $amountReceived = $value['amountReceived'];


                  // Centered text in a framed 20*10 mm cell and line break
                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetTextColor(0);
                $fpdf->SetDrawColor(209, 212, 207);
                $fpdf->SetLineWidth(.3);
                $fpdf->SetFont('Times','B',7);
                // Data
                $fill = false;   
                $fpdf->Cell(60,7,' '.$productName.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(30,7,''.$total_quantity.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(20,7,''.$list_price.' ', 'B R', 0, 'L',$fill);
                 $fpdf->Cell(30,7,''.$net_price.' ','B R', 0, 'L',$fill);
                $fpdf->Cell(20,7,''.$discount.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(30,7,''.$net_amount.' ', 'B R', 1, 'L',$fill);
                $fill = !$fill;

             }

    $fpdf->Cell(189,10,'',0,1);         
    $fpdf->SetFont('Times','B',8 );
    $fpdf->Cell(60,7,'Grand Total: ', 'B R T', 0, 'L');
    $fpdf->Cell(30,7,''.$sum_of_quantity.' ', 'B R T', 0, 'L');
    $fpdf->Cell(20,7,'', 'B R T', 0, 'L');
     $fpdf->Cell(30,7,''.$grossAmount.' ','B R T', 0, 'L');
    $fpdf->Cell(20,7,' '.$totalDiscount.' ', 'B R T', 0, 'L');
    $fpdf->Cell(30,7,''.$totalNetAmount.' ', 'B T', 1, 'L');

    $fpdf->Cell(189,0,'',0,1);         
    $fpdf->SetFont('Times','',8 );
    $fpdf->Cell(60,7,'TOTAL # OF ITEMS: ', '', 0, 'L');
    $fpdf->Cell(30,7,''.$total_number_items.' ', '', 1, 'L');
    // $fpdf->Cell(20,7,'', '', 0, 'L');
    // $fpdf->Cell(50,7,'NET AMOUNT RECEIVABLE: ', '', 0, 'L');
    // $fpdf->Cell(30,7,'  '.$totalReceivable.' ', '', 1, 'L');

    $fpdf->Cell(189,0,'',0,1);         
    $fpdf->SetFont('Times','',8 );
    $fpdf->Cell(60,7,'AMOUNT IN WORDS: ', '', 0, 'L');
    $fpdf->Cell(30,7,''.$rupees_value.' ', '', 0, 'L');
    $fpdf->Cell(20,7,'', '', 0, 'L');
     $fpdf->Cell(30,7,'','', 0, 'L');
    $fpdf->Cell(20,7,'', '', 0, 'L');
    $fpdf->Cell(30,7,'', '', 1, 'L');


    $fpdf->Cell(189,0,'',0,1);         
    $fpdf->SetFont('Times','B',8 );

    $fpdf->Cell(200,7,'If you have any question about this invoice please contact or visit our office', '', 1, 'C');
    $fpdf->SetFont('Times','',8 );

    $fpdf->Cell(200,1,'Address: 108/2 Alnoor house A road street # 10 behar colony lyari karachi', '', 1, 'C');
    $fpdf->SetFont('Times','B',9 );

    $fpdf->Cell(200,6,'Thank You For Your Bussiness!', '', 1, 'C');

     $fpdf->SetFont('Times','B',7); 
     $fpdf->Cell(200,2,'Software Develop By Muhammad Faizan', '', 1, 'C');
     $fpdf->Cell(200,4,'Contact us: +923139200720', '', 0, 'C');

     $fpdf->Output('invoices-pdf/'.$invoiceNumber.'.pdf','F');
     $fpdf->Output(''.$invoiceDate.'.pdf','I');

?>