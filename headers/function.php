<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
	if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}


   
//   function app_history($edit_type_name,$date,$user_id,$last_id,$categoryID,$page_url,$AppID,$action,$dbh) {
//	   
//	   
//	   
//        $query_history = "insert into app_history (edit_type_name,last_edited,edited_by,type_id,category_id,page_url,app_id,action) VALUES('$edit_type_name','$date','$user_id','$last_id','$categoryID','$page_url','$AppID','$action')";
//        $sth = $dbh->prepare($query_history);
//        $sth->execute();
//	  
//	   
//   }
//

?>