<?php




   $db_host="localhost";
    $db_user="pakpopul_backend";
    $db_pass="ppipopular!!";
    $db_name="pakpopul_dashboard";
    $todayDate = gmdate('d-m-Y');

    

    if (!file_exists('temp-daily-backup/'.$todayDate.'')) {
            mkdir('temp-daily-backup/'.$todayDate.'', 0777, true);
    }


    $tables=array('category','customer','customer_ledger','inventory_history','invoice_leaders','products','payments','sale_invoice','sale_invoice_amount_details','sale_invoice_details','purchase_invoice','purchase_invoice_amount_details','purchase_invoice_details','payments');

    $other_tables=array(
            'bank_transfer_history',
            'customer_bank_records',
            'godown_1th_floor',
            'godown_6th_floor',
            'godown_transfer',
            'inventory_history_status',
            'owner_bank_ledger',
            'quotation',
            'sale_return_history',
            'shipment',
            'user',
            'user_levels');
    function &backup_tables($host, $user, $pass, $name, $table)
    {

        $dbh = new PDO("mysql:host=$host; dbname=$name", $user, $pass);
        $conn = mysqli_connect($host, $user, $pass, $name);
        $data="";
        $data .= "\n/*---------------------------------------------------------------" .
        "\n  TABLE: `{$table}`" .
        "\n  ---------------------------------------------------------------*/\n";




        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $vals = Array();
            $z = 0;
            for ($i = 0; $i < $num_rows; $i++) {
                $items = mysqli_fetch_row($result);
                $vals[$z] = "(";
                for ($j = 0; $j < count($items); $j++) {
                    if (isset($items[$j])) {
                        $vals[$z] .= "'" . mysqli_real_escape_string($conn, $items[$j]) . "'";
                    } else {
                        $vals[$z] .= "NULL";
                    }
                    if ($j < (count($items) - 1)) {
                        $vals[$z] .= ",";
                    }
                }
                $vals[$z] .= ")";
                $z++;
            }
            $data .= "INSERT INTO `{$table}` VALUES ";
            $data .= "  " . implode(";\nINSERT INTO `{$table}` VALUES ", $vals) . ";\n";
        }

        mysqli_close($conn);
        return $data;
    }
     
   
// exporting old db before reseting
if (true) {
   
        foreach ($tables as $key => $table) {
            $table_with_ext=$todayDate."_".$table.'.sql';

            $backup_file ="temp-daily-backup/".$todayDate."/".$table_with_ext;    
            $my_backup=backup_tables($db_host,$db_user,$db_pass,$db_name,$table);
            $app['backup_file_path']=$backup_file;
            $app['table_name']=$table;
            $app['file_name']=$table_with_ext;
            $app_full_data[]=$app;
            $handle = fopen($backup_file, 'w+');
            fwrite($handle, $my_backup);
            fclose($handle);
        }
        foreach ($other_tables as $key => $table2) {
           $extra_tabels_data=$todayDate."_"."other_tables_data.sql";
            $extar_tabel_path="temp-daily-backup/".$todayDate."/".$extra_tabels_data;
            $extra_table_backup=backup_tables($db_host,$db_user,$db_pass,$db_name,$table2);
            $handle = fopen($extar_tabel_path, 'a+');
            fwrite($handle, $extra_table_backup);
            fclose($handle);
        }
            
    }
    //echo json_encode($app_full_data);
    echo "Backup created!";
    


?>
