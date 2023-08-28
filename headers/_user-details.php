
<?php
if(!isset($_SESSION)){
    session_start();
}
 if(!isset($_SESSION['user_id']))
    {                
        header("Location: login.php");
    }
    else
    {
        $user_id = $_SESSION['user_id'];

       $user_level = @$_COOKIE['user_level'];
       switch($user_level){
           case '1':
               $user_type = 'Admin';
               break;
           case '2':
                   $user_type = 'Content Editor';
               break;
           case '3':
               $user_type = 'Demo';
               break; 
           case '4':
               $user_type = 'UI Editor';
               break;                
           case '5':
               $user_type = 'Super Admin';
               break;                                
           case '7':
               $user_type = 'Partner';
               break;
       }
        
		$query_detail = "SELECT * FROM `user` where user_id = '$user_id'";
//            var_dump($query_detail);
		$result_detail = mysqli_query($conn,$query_detail);
		$row_query = mysqli_fetch_array($result_detail);

		$image = $row_query['image'];
        $user_image_url = $row_query['image_url'];
		$username = $row_query['user_name'];
		$password = $row_query['password'];
        $user_image = $row_query['image'];
		$image = $row_query['image'];          
    $login_popup = $row_query['login_popup'];              
		$username_allcaps = strtoupper($username);
        
    }

?>	
