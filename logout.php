<?php
include("headers/connect.php");
    session_start();
    if(session_destroy())
    {

       header("Location:login.php");

       $query_update = "UPDATE `user` SET `login_popup`= 0 WHERE id =$user_id";
        $stt = $dbh->prepare($query_update);
        $stt->execute(); 

    }
?>