<?php
include("headers/connect.php");
include("headers/_user-details.php");

if($_POST){
        // Product Page Variables
           // $discount = 0; 
            $sess_user_id = @$_POST['sess_user_id'];
            $product_name = @$_POST['product_name'];
            $description = @$_POST['description'];
            $todayDate = gmdate('d-m-Y g:i:s');
            $form_submit = @$_POST['form_submit'];
            $product_id = @$_POST['product_id'];
            $category_name = @$_POST['category_name'];
            
            $add_product_price = @$_POST['add_prodct_price'];
            $purchase_price = $_POST['purchase_price'];
            $quantity = @$_POST['quantity'];
            $cotton = "";
            $per_cotton_quantity ="";
            $price = @$_POST['price'];
            $discount = @$_POST['discount'];
            $company_name = @$_POST['company_name'];
            $total_peace = @$_POST['total_peace'];



        //Category Page variables
            $category_id_edit = @$_POST['category_id_get'];
            $category_name_edit = @$_POST['category_name_edit'];
       
            if($form_submit == "update"){
                $update_query = "UPDATE `products` SET `product_name` = '$product_name' , `description` ='$description'  ,`price` = '$price' ,`discount` ='$discount',`product_quantity_sale` = '$total_peace' ,`purchase_price` = '$purchase_price'  WHERE `id` = '$product_id'";
                $stmt = $dbh->prepare($update_query);
                $stmt->execute();    
                var_dump($update_query);
            }
        
            if($form_submit == "insert"){
                $query = "INSERT INTO `products`(`product_name`, `description`, `created_time`,`created_by`,`price`,`discount`,`company_id`,`product_quantity_sale`,`purchase_price`) VALUES ('$product_name','$description',now(),'$sess_user_id','$add_product_price','$discount','$company_name','$total_peace','$purchase_price')";
                $stm = $dbh->prepare($query);
                $stm->execute();   
             //  var_dump($query);
            }
    
           
       
        
        }
        
?>
		