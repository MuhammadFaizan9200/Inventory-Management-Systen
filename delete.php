<?php

    include("headers/connect.php");
	if(@$_GET['product_id'])
		{
			$array = array();
			$product_id = $_GET['product_id'];
            $delete_query ="DELETE FROM `products` WHERE id ='$product_id'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}

    if(@$_GET['category_id'])
		{
			$array = array();
			$category_id = $_GET['category_id'];
            $delete_query ="DELETE FROM `category` WHERE id ='$category_id'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}

    if(@$_GET['customer_id'])
		{
			$array = array();
			$customer_id = $_GET['customer_id'];
            $delete_query ="DELETE FROM `customer` WHERE id ='$customer_id'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}

  if(@$_GET['shipmentID'])
		{
			$array = array();
			$shipmentID = $_GET['shipmentID'];
            $delete_query ="DELETE FROM `shipment` WHERE id ='$shipmentID'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}

if(@$_GET['company_id'])
		{
			$array = array();
			$company_id = $_GET['company_id'];
            $delete_query ="DELETE FROM `company` WHERE id ='$company_id'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}

  if(@$_GET['purchaseInvoiceID'])
		{
			$array = array();
			$purchaseInvoiceID = $_GET['purchaseInvoiceID'];
            $delete_query ="DELETE p,pmd,pd FROM purchase_invoice p  JOIN purchase_invoice_amount_details pmd ON p.id = pmd.purchaseInvoiceId   JOIN purchase_invoice_details pd ON pd.purchase_invoice_id = p.id  WHERE p.id = '$purchaseInvoiceID'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}

		if(@$_GET['saleman_id'])
		{
			$array = array();
			$saleman_id = $_GET['saleman_id'];
            $delete_query ="DELETE FROM `saleman` WHERE id ='$saleman_id'";
			$stmt = $dbh->prepare($delete_query);
            $result = $stmt->execute();  
			if($result)
			{
                $array['response'] = 1;				
			}
			else
			{
					$array['response'] = 2;				
			}
			echo json_encode($array);
		}


?>