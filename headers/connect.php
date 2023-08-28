<?php
     ob_start(); 
   
    $dbhost = 'localhost';
    $dbuser = 'ahmed_inventory';
    $dbpass = 'Hemani786!!';
    $dbname ='ahmed_inventory';	
    
// $dbhost = 'localhost';
//   $dbuser = 'root';
//   $dbpass = '';
//   $dbname ='inventory_system';	   


   $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  
   if(!$conn)
    {
      die('Could not connects: ' . mysqli_error());
   	}
	
  
    $dbh = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser,$dbpass); 
     $dbh->exec("set names utf8");

?> 


