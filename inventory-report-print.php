<?php

    include("headers/connect.php");
    require("fpdf/fpdf.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ob_start();

    $select_company_stock_print = @$_GET['select_company_stock_print'];
    if($select_company_stock_print == 0){
        $para_meters = "";
    }else{
        $para_meters = "WHERE p.company_id = '$select_company_stock_print'";
    }
    $date = gmdate("Y-m-d G:i:s");

    $returnArray = array();
    $returnValues = array();
      $fetch_query_details = "SELECT p.* ,(SELECT company_name from company where id = p.`company_id`) companyName FROM `products` p $para_meters";
       // print_r($fetch_query_details);
            $stht = $dbh->prepare($fetch_query_details);
            $result = $stht->execute();
            $grand_total_quantity_rate = 0;
            while($rows = $stht->fetch(PDO::FETCH_ASSOC)){
                
                     $id = $rows['id'];
                    $product_name = $rows['product_name'];
                    $product_quantity_sale = $rows['product_quantity_sale'];
                    $companyName = $rows['companyName'];
                    $price = $rows['price'];
                    $total_quantity_rate = $product_quantity_sale * $price;
                    if($product_quantity_sale == ""){
                        $product_quantity_sale = 0;
                    }    

                    $grand_total_quantity_rate += $total_quantity_rate;
                   
                     $returnArray['product_name'] = $product_name;
                     $returnArray['companyName'] = $companyName;
                     $returnArray['product_quantity_sale'] = $product_quantity_sale;
                     $returnArray['price'] = $price;
                     $returnArray['total_quantity_rate'] = $total_quantity_rate;
                     
                     $returnValues[] = $returnArray;

                    
                }



        $number =   @$totalNetAmount;      
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
    $fpdf->Cell(60,2,'INVENTORY REPORT',0,1,'C');

     


    $fpdf->Cell(220,5,'',0,1);
     $fpdf->SetFont('Times','B',8);

    $fpdf->Cell(189,0,'',0,1);
    // Invoice content

    $fpdf->SetFont('Times','B',8 );
    $fpdf->Cell(60,7,'Product Name', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Company Name', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Available Quantity', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Rate', 'T B', 0, 'L');
    $fpdf->Cell(30,7,'Total', 'T B', 1, 'L');
  

    $fpdf->SetFont('Times','',8);

    
        foreach ($returnValues as $key => $value) {
            # code...
                
                $productName = $value['product_name'];           
                 $companyName = $value['companyName'];
                 $product_quantity_sale = $value['product_quantity_sale'];
                 $price = $value['price'];
                 $total_quantity_rate = $value['total_quantity_rate'];
                 


                  // Centered text in a framed 20*10 mm cell and line break
                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetTextColor(0);
                $fpdf->SetDrawColor(209, 212, 207);
                $fpdf->SetLineWidth(.3);
                $fpdf->SetFont('');
                // Data
                $fill = false;   
                $fpdf->Cell(60,7,' '.$productName.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(30,7,''.$companyName.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(30,7,''.$product_quantity_sale.' ', 'B R', 0, 'L',$fill);
                 $fpdf->Cell(30,7,''.$price.' ','B R', 0, 'L',$fill);
                $fpdf->Cell(30,7,''.$total_quantity_rate.' ', 'B R', 1, 'L',$fill);
                $fill = !$fill;

             }

    $fpdf->Cell(189,5,'',0,1);         
    $fpdf->SetFont('Times','B',8 );
    $fpdf->Cell(150,7,'Grand Total: ', 'B R T', 0, 'L');
    $fpdf->Cell(30,7,''.@$grand_total_quantity_rate.' ', 'B R T', 1, 'L');
    

     //$fpdf->Output('inventory-report/'.@$date.'.pdf','F');
     $fpdf->Output(''.@$date.'.pdf','D');

?>