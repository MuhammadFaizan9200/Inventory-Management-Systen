<?php
      include("headers/connect.php");
      include("headers/_user-details.php");
      require("fpdf/fpdf.php");

        $get_company_name = @$_GET['get_company_name_dis'];
        $start_date = @$_GET['start_date'];
        $end_date = @$_GET['end_date'];
        $companyVariable = '';  
        $dateData = '';
        if($start_date == "" && $end_date == ""){
           $dateBtween = "";   
        }else{
          $dateBtween = "AND (s.invoiceDate BETWEEN '$start_date' AND '$end_date')";
        }
        if($get_company_name != '' && $get_company_name != 'undefined'){
          $companyVariable =  "and sid.company_id = '$get_company_name'";
        }
        
        if(($get_company_name == 'undefined') && $start_date == "" && $end_date == ""){
        //  echo "working";
          $dateData = 'AND s.invoiceDate = "'.gmdate("Y-m-d").'" ';
        }


$fpdf = new FPDF("p",'mm','A4');
    $fpdf->addPage();

    $fpdf->SetFont('Times','B',14 );
    $fpdf->Cell(189,2,'AHMED TRADERS',0,1,'C');

    $fpdf->SetFont('Times','',8 );
    $fpdf->Cell(88);
    $fpdf->Cell(15,5,'OLD CITY AREA',0,1,'C');

    $fpdf->SetFont('Times','',9 );
    $fpdf->Cell(66);
    $fpdf->Cell(60,4,'SALE REPORT',0,1,'C');


    $fpdf->SetFont('Times','B',10 );
    $fpdf->Cell(66);
    $fpdf->Cell(60,2,'',0,1,'C');



    $fpdf->SetFont('Times','B',8);
    $fpdf->Cell(10,7,'Sno', 'T B', 0, 'L');
    $fpdf->Cell(25,7,'Invoice Date', 'T B', 0, 'L');
    $fpdf->Cell(20,7,'Invoice #', 'T B', 0, 'L');
    $fpdf->Cell(55,7,'Customer Name', 'T B', 0, 'L');
    $fpdf->Cell(25,7,'Company Name', 'T B', 0, 'L');
    $fpdf->Cell(20,7,'Total Amount', 'T B', 0, 'L');
    $fpdf->Cell(10,7,'Dis', 'T B', 0, 'L');
    $fpdf->Cell(20,7,'Total', 'T B', 1, 'L');
  

   $fetch_query =  "SELECT sid.* ,s.invoiceNumber,s.invoiceDate ,(SELECT product_name from products where id = sid.insert_productName) as productName ,(SELECT customer_name from customer where id = sid.customer_id) as customerName ,(SELECT company_name from company where id = sid.`company_id`) as companyName ,(SELECT totalNetAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as totalNetAmount ,(SELECT grossAmount from sale_invoice_amount_details where sale_invoice_id = s.id) as grossAmount   FROM `sale_invoice_details` sid , sale_invoice s WHERE s.id = sid.`sale_invoice_id` $companyVariable $dateBtween AND sid.discount > 0 GROUP by s.invoiceNumber order by s.invoiceDate desc";

     

          $sth = $dbh->prepare($fetch_query);
       //var_dump($fetch_query);
          $result = $sth->execute();
          $count = 1;
          $grand_total_quantity = 0;
          $grand_list_price = 0;
          $grand_discount = 0;
          $grand_net_amount = 0;
       $fpdf->SetFont('Times','',8);   
          while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
              $id = $rows['id'];
              $invoiceDate = $rows['invoiceDate'];
              $invoiceNumber = $rows['invoiceNumber'];
              $customerName = $rows['customerName'];
              $companyName = $rows['companyName'];
              $total_quantity = $rows['total_quantity'];
              $list_price = $rows['list_price'];
              $discount = $rows['discount'];
              $totalNetAmount = $rows['totalNetAmount'];
              $discount = $rows['discount'];
              $net_price =$rows['net_price'];
              $grossAmount =$rows['grossAmount'];
              $grand_total_quantity += $total_quantity;
              $grand_list_price += $list_price;
              $grand_discount  += $discount;
              $grand_net_amount += $totalNetAmount;


                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetTextColor(0);
                $fpdf->SetDrawColor(209, 212, 207);
                $fpdf->SetLineWidth(.3);
                $fpdf->SetFont('');
                // Data
                $fill = false;   
                $fpdf->Cell(10,7,' '.$count.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(25,7,''.$invoiceDate.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(20,7,''.$invoiceNumber.' ', 'B R', 0, 'L',$fill);
                 $fpdf->Cell(55,7,''.$customerName.' ','B R', 0, 'L',$fill);
                $fpdf->Cell(25,7,''.$companyName.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(20,7,''.$grossAmount.' ', 'B R', 0, 'L',$fill);
                $fpdf->Cell(10,7,''.$discount.'%', 'B R', 0, 'L',$fill);
                $fpdf->Cell(20,7,''.$totalNetAmount.' ', 'B R', 1, 'L',$fill);
                $fill = !$fill;
                $count++;
          }
               $fpdf->SetFont('Times','B',8);
               $fpdf->Cell(165,7,'Grand Total', 'B R', 0, 'L');
               // $fpdf->Cell(10,7,' '.$grand_total_quantity.' ', 'B R', 0, 'L');
               // $fpdf->Cell(20,7,' '.$grand_list_price.' ', 'B R', 0, 'L');
               // $fpdf->Cell(10,7,' '.$grand_discount.' ', 'B R', 0, 'L');
               $fpdf->Cell(20,7,' '.$grand_net_amount.' ', 'B R', 0, 'L');

           $fpdf->Output('sale-report.pdf','D');


?>