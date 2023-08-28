<?php

  include("headers/connect.php");
  include("headers/_user-details.php");
  $array = array();
  $temparray = array();


      $start_date_variable = "";
      $company_name_variable = "";
      $account_selection = "";
      $search_bycustomer_vari = "";
      $set_products_value_var = "";
      $start_date = "";
      $end_date = "";
      $search_bycustomer = "";
      $company_name = "";
      $html = "";

        $start_date = @$_GET['start_date'];
        $end_date = @$_GET['end_date'];
        $company_name = @$_GET['company_name'];
        $search_bycustomer = @$_GET['search_bycustomer'];
        $product_id = @$_GET['product_id'];
        
        if($_GET['start_date']){
        	$company_name_variable = '';
			$search_bycustomer_vari	 = '';
			$set_products_value_var	 = '';
          $start_date_variable = "AND (ih.date BETWEEN '".$start_date."' AND '".$end_date."') ";
        }
         if($_GET['company_name']){
         	$search_bycustomer_vari = '';
			$set_products_value_var = '';
			$start_date_variable = '';
          	$company_name_variable = "AND ih.company_id = '".$company_name."'";
        }

        if($_GET['search_bycustomer']){
			$set_products_value_var = '';
			$start_date_variable = '';
			$company_name_variable = '';

          $search_bycustomer_vari = "AND ih.customer_id = '".$search_bycustomer."'";
        }
        
        if($_GET['product_id']){
        	$start_date_variable = '';
			$company_name_variable = '';
			$search_bycustomer_vari = '';
          $set_products_value_var  = "AND ih.product_id = '".$product_id."'";
        }

         $html .= ' <table class="table card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sno</th>     
                                        <th>Date</th>
                                        <th>Voucher #</th>
                                        <th>Customer Name</th>
                                        <th>Company Name</th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                        <th>-Quantity</th>
                                    </tr>
                                </thead>';


         $array = array();
		        $query = "SELECT ih.id,ih.`description`,ih.`date`,ih.`rate`, ih.`plus_full`, ih.`minus_full` ,(SELECT invoiceNumber FROM sale_invoice where id = ih.invoice_id) AS invoice_id ,(SELECT company_name from company where id =.ih.company_id) AS company_name , (SELECT customer_name from customer where id = ih.customer_id) AS customer_name FROM inventory_history ih join sale_invoice_details sid on ih.invoice_detail_id = sid.id $set_products_value_var  $search_bycustomer_vari  $company_name_variable  $start_date_variable ORDER BY ih.`time_stamp` desc";
          //var_dump($query);
            $sthrt = $dbh->prepare($query);
              $dbh->query('SET @variable := 0');
            $sthrt->execute();
            $counter = $sthrt->rowCount();
            $count = 1;
            if($counter >= 1){
            while ($rows =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    
                    $id = $rows['id'];
                    $description = $rows['description'];  
                    $plus_full = $rows['plus_full'];  
                    $minus_full = $rows['minus_full'];  
                    $date = $rows['date'];  
                    $invoice_id = $rows['invoice_id'];  
                    $company_name = $rows['company_name'];  
                    $rate = $rows['rate'];  
                    $customer_name = $rows['customer_name'];  

                      $html .='<tr>
                           <td>'.$count.'</td>
                            <td>'.$date.'</td>
                            <td>'.$invoice_id.'</td>
                            <td>'.$customer_name.'</td>
                            <td>'.$company_name.'</td>
                            <td>'.$description.'</td>
                             <td>'.$rate.'</td>
                            <td>'.$minus_full.'</td>
                          </tr>';
                     $count++;
                }
              }else{
                $html .='<tr>
                                 <td>Data not found !</td>
                                </tr>';
              }
             $html .= '</table>' ;          
            echo $html;
    
   
    ?>


