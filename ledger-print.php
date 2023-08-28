<?php
include("headers/connect.php");
include("headers/_user-details.php");

$html = "";
 $customer_id = $_GET['customerType'];
     
         $html .= ' <table id="example" class="table table-striped sfc_table table-bordered nowrap" style="width:100%">
                      <thead>
                          <tr>
                              <th>Description</th>
                              <th>Date</th>
                              <th>Debit</th>
                              <th>Credit</th>
                              <th>Balance</th>    
                          </tr>
                        </thead>';


          $array = array();
   
          $query = "SELECT id,description,`date`, `debitAmount`, `creditAmount`, @variable := @variable + (`debitAmount` - `creditAmount`) `Balance` FROM          customer_ledger WHERE  customer_id = '$customer_id'  ORDER BY id ASC";
            $sthrt = $dbh->prepare($query);
            $dbh->query('SET @variable := 0');
            $sthrt->execute();

            $counter = 1;
          
            while ($rowss =  $sthrt->fetch(PDO::FETCH_ASSOC)) {
                    $date = $rowss['date'];           
                     $debit = $rowss['debitAmount'];
                     $credit = $rowss['creditAmount'];
                     $Balance = $rowss['Balance'];
                      $description = $rowss['description'];

                   # code...
                       
                        $html .='<tr>
                             <td>'.$description.'</td>
                             <td>'.$date.'</td>
                              <td>'.$debit.'</td>
                              <td>'.$credit.'</td>
                              <td>'.$Balance.'</td>
                            </tr>';
                     
                }
               
             $html .= '</table>' ;          


          
            echo $html;









?>