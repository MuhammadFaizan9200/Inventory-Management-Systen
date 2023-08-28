<?php

        include("headers/connect.php");
        include("headers/_user-details.php");


		if(@$_GET['purchaseInvoiceID'])
		{
			$array = array();
			$purchaseInvoiceID =$_GET['purchaseInvoiceID'];
            
          
		  $query = "SELECT pi.id ,pid.productID ,pid.quantity as totalPurchaseQuantity,godown_first.godwon_previous_quantity , godown_first.godown_sith_quantity as firstFloorQuantity ,(SELECT product_name from products WHERE id = pid.productID) as productName ,(SELECT category_name from category WHERE id = pid.categoryID) as categoryName , godown_first.time_stamp  FROM `purchase_invoice` pi LEFT JOIN purchase_invoice_details pid  ON   pi.id =pid.purchase_invoice_id LEFT JOIN  godown_1th_floor  godown_first on   godown_first.purchase_invoice_details_id =pid.id WHERE  pi.id = '$purchaseInvoiceID' ORDER by godown_first.id ASC";
        	$result = mysqli_query($conn,$query); 
         
            $count = 1;
            $json = array();
           $html = ' <table class="datatables-demo table table-striped table-bordered" id="editable-table">
                        <tr class="">
                    <th>Serial #</th>
                     <th >Category Name</th>
                    <th >Product Name</th>
                    <th>Total Purchase Quantity</th>
                    <th>First Floor Quantity</th>
                    <th>Remaining Quantity</th>
                    <th>Date</th>
                       </tr>';
            
			while($row = mysqli_fetch_assoc($result))
			{
                
                $productID = $row['productID'];
				$godwon_previous_quantity = $row['godwon_previous_quantity'];
                $totalPurchaseQuantity = $row['totalPurchaseQuantity'];
				$firstFloorQuantity =$row['firstFloorQuantity'];
               	$categoryName =$row['categoryName'];
                $productName =$row['productName'];
				$time_stamp =$row['time_stamp'];
                
                if($godwon_previous_quantity == 0){
                    $godwon_previous_quantity = $totalPurchaseQuantity;
                }
                
                
                $totalPurchaseRemainingQuantity = $row['totalPurchaseRemainingQuantity'];
                
                
                $remainingQuantity =  $godwon_previous_quantity - $firstFloorQuantity;
				
                
                if($firstFloorQuantity == NULL){
                    $firstFloorQuantity = "0";
                }
                
                $createdTime = strtotime($time_stamp . "UTC");
                $created_time_convert = date('d-M-Y', $createdTime); 
                
             $html .= '<tr>
						<td>'.$count++.'</td>
                        <td>'.$categoryName.'</td>
						<td>'.$productName.'</td>
						<td align="center">'.$godwon_previous_quantity.'</td>
                        <td align="center">'.$firstFloorQuantity.'</td>
                        <td align="center">'.$remainingQuantity.'</td>
                        <td align="center">'.$created_time_convert.'</td>
                        </tr>';
             }
            $html .= '</table>';
            
            echo $html;
            
		}


?>