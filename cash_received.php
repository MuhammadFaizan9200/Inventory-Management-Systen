<?php
session_start();
	
    include("headers/connect.php");
    include("headers/_user-details.php");
    include("headers/function.php");
    require("fpdf/fpdf.php");


    $year = date("Y");
    $year = explode("0",$year);
    $current_date = date('Y-m-d');
     $payment_voucher_num = "SI/" . "PP1" ."/". mt_rand(100000, 999999);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $customer_code_random = "RV/" . $year[1] ."/". mt_rand(100000, 999999);
    $customer_id = @$_GET['id'];

    if($_POST){


        $customerType = @$_POST['customerType']; 
        $vouchar_date = @$_POST['vouchar_date'];
        $bank_name = @$_POST['bank_name'];
        $received_amount = @$_POST['received_amount'];
        $cash_date = @$_POST['cash_date'];
        $vouchar_number = @$_POST['vouchar_number'];
       
        $remarks = @$_POST['remarks'];
        $account_number = @$_POST['account_number'];
        $date = date('Y-m-d');
        $clear_date = @$_POST['clear_date'];  
        $received_from = @$_POST['received_from'];  
        $received_by = @$_POST['received_by'];  
        $payment_type = @$_POST['payment_type'];
        $account_selection = @$_POST['account_selection'];

        $account_type = @$_POST['account_type'];
        if($payment_type == '1' && $bank_name == ""){
            // cash in hand
            $type_status = '1';
        }else{
            // cheque in hand
            $type_status = '2';
        }
        
       
      
        $fetch_balance = "SELECT c.customer_name,sa.id, sa.`previousBalance` FROM `sale_invoice_amount_details` sa , customer c WHERE c.id = sa.`customer_id`   AND `customer_id` = '$customerType' ORDER BY sa.id DESC LIMIT 1";
        $stht = $dbh->prepare($fetch_balance);
        $stht->execute();
        $rowss = $stht->fetch(PDO::FETCH_ASSOC);
        $opening_balance = 0; 
        $previousBalance = $rowss['previousBalance'];
        $customer_name = $rowss['customer_name'];
         $id = $rowss['id'];


       

         $received_amount_ledger = @$received_amount;
         $remaningOpeningBalance = $opening_balance - $received_amount ;
         $reaminingPreviousBalance = $previousBalance - $received_amount;


             //query to maintain the ledger
            $leadear_query = "INSERT INTO `invoice_leaders`(`debit`, `credit`, `status`, `invoice_id`, `time_stamp`,`customer_id`,`date`) VALUES ('0','$received_amount_ledger','0','0',now(),'$customerType','$date')";
            $st = $dbh->prepare($leadear_query);
            $st->execute(); 


             $update_cus_query = "UPDATE `sale_invoice_amount_details` SET `previousBalance`='$reaminingPreviousBalance' WHERE id ='$id'";
            $stmtt = $dbh->prepare($update_cus_query);
            $stmtt->execute(); 
           // var_dump($update_cus_query);

            $update_invoice_query = "UPDATE `customer` SET `opening_balance`='$remaningOpeningBalance' WHERE id ='$customerType'";
            $stmttt = $dbh->prepare($update_invoice_query);
            $stmttt->execute(); 
         


            // maintain owner ledger
            $owner_ledger_query = "INSERT INTO `customer_ledger`(`description`, `bank_name`, `check_number`, `clear_date`, `received_from`, `received_by`, `payment_type_status`, `account_selection_status`, `debitAmount`, `creditAmount`, `date`, `customer_id`, `account_type`, `time_stamp`,`voucher_number`,`type`) VALUES ('$remarks','$bank_name','$account_number','$clear_date','$received_from','$received_by','0','0','0','$received_amount_ledger','$date','$customerType','0',now(),'$customer_code_random','$type_status')";
            $st_t = $dbh->prepare($owner_ledger_query);
            $st_t->execute(); 
            //var_dump($owner_ledger_query);
           



        $number =   $received_amount_ledger;      
        $no = round($number);
           $point = round($number - $no, 2) * 100;
           $hundred = null;
           $digits_1 = strlen($no);
           $i = 0;
           $str = array();
           $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
           $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
           while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
             } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          $points = ($point) ?
            "." . $words[$point / 10] . " " . 
                  $words[$point = $point % 10] : '';
        $rupees_value =  ucwords($result) . "Rupees";              

  $fpdf = new FPDF("p",'mm','A4');
  $fpdf->addPage('0');
  
  $fpdf->SetFont('Times','B',14 );
    $fpdf->Cell(189,2,'AHMED TRADERS',0,1,'C');

    $fpdf->SetFont('Times','',8 );
    $fpdf->Cell(88);
    $fpdf->Cell(15,8,'OLD CITY AREA',0,1,'C');

    $fpdf->SetFont('Times','B',10 );
    $fpdf->Cell(66);
    $fpdf->Cell(60,2,'** RECIPT VOUCHER **',0,0,'C');

  $fpdf->Cell(189,15,'',0,1);
  $fpdf->SetFont('Arial','B',10);

  $fpdf->Cell(30,6,'Voucher #',1,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,6,' '.$vouchar_number.' ',1,0,'C');



  $fpdf->Cell(150);
  $fpdf->Cell(30,6,'Date',1,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,6,' '.$date.' ',1,1,'C');    

  
  $fpdf->SetFont('Arial','B',10 );
  $fpdf->Cell(60,7,'Debit Account',1,0,'L');

  $fpdf->SetFont('Arial','b',10);
  $fpdf->Cell(210,7,' '.$customer_name.' ',1,1,'L');


  $fpdf->SetFont('Arial','B',10 );
  $fpdf->Cell(60,7,'Remarks',1,0,'L');

  $fpdf->SetFont('Arial','b',10);
  $fpdf->Cell(210,7,' '.$remarks.' ',1,1,'L');


  $fpdf->Cell(189,5,'',0,1);

  $fpdf->SetFont('Arial','',12 );
  $fpdf->SetFont('Arial','B',10 );
  $fpdf->Cell(60,7,'Account',1,0,'C');

  $fpdf->SetFont('Arial','b',10);
  $fpdf->Cell(60,7,'Remarks',1,0,'C');

  $fpdf->SetFont('Arial','b',10);
  $fpdf->Cell(50,7,'Cheque #',1,0,'C');

    $fpdf->SetFont('Arial','b',10);
  $fpdf->Cell(50,7,'Cheque Date',1,0,'C');

  $fpdf->SetFont('Arial','b',10);
  $fpdf->Cell(50,7,'Amount',1,1,'C');


  
  // for($i=1;$i<=40;$i++){

    $fpdf->SetFont('Arial','',10 );
    $fpdf->Cell(60,7,' '.$bank_name.' ',1,0,'C');

    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(60,7,' '.$remarks.' ',1,0,'C');

    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(50,7,' '.$account_number.' ',1,0,'C');

      $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(50,7,' '.$clear_date.' ',1,0,'C');

    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(50,7,' '.$received_amount_ledger.' ',1,1,'C');

  //}

  $fpdf->Cell(270, 10, ' ', 'B', 1, 'L');

  $fpdf->Cell(189,2,'',0,1);
  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(30,7,'Rupees: ',0,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(20);
  $fpdf->Cell(30,7,' '.$rupees_value.' ',0,0,'C');

  $fpdf->Cell(130);

  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(30,7,'Total: ',0,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,7,' '.$received_amount_ledger.' ',0,1,'C');


  $fpdf->Cell(189,1,'',0,1);
  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(20,7,'',0,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,7,'',0,0,'C');

  $fpdf->Cell(170);

  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(30,7,'Previous Balance: ',0,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,7,' '.$previousBalance.' ',0,1,'C');


  $fpdf->Cell(189,1,'',0,1);
  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(20,7,'',0,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,7,'',0,0,'C');

  $fpdf->Cell(170);

  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(20,7,'Net Amount: ',0,0,'C');

  $fpdf->SetFont('Arial','',10);
  $fpdf->Cell(30,7,' '.$reaminingPreviousBalance.' ',0,1,'C');
  
  $fpdf->Cell(270, 5, ' ', 'B', 1, 'L');


  //spacing of bottom 
  $fpdf->Cell(189,5,'',0,1);

  $fpdf->Cell(50, 10, ' ', 'B', 0, 'L');
  $fpdf->Cell(60);
  $fpdf->Cell(50, 10, ' ', 'B', 0, 'L');
  $fpdf->Cell(60);
  $fpdf->Cell(50, 10, ' ', 'B', 1, 'L');

  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(50,10,'Accountant',0,0,'C');
   $fpdf->Cell(60);

   $fpdf->Cell(50,10,'Approved By',0,0,'C');
   $fpdf->Cell(60);

   $fpdf->Cell(50,10,'Receiver Signature',0,1,'C');
  
   $fpdf->output(''.$date.'_'.$vouchar_number.'.pdf','D');

 
        
    }
    else{
        $typeArray = array();
        $fetch_query = "SELECT * FROM `customer` WHERE `id` ='$customer_id'";
        $sth = $dbh->prepare($fetch_query);
        $result = $sth->execute();
        $rows = $sth->fetch(PDO::FETCH_ASSOC);
        $credit_limit = $rows['credit_limit']; 
        $date = $rows['date'];
        $customer_code = $rows['customer_code'];
        $customer_name = $rows['customer_name'];
        $address = $rows['customer_name'];
        $area = $rows['area'];
        $city = $rows['city'];
        $mobile_1 = $rows['mobile_1'];
        $mobile_2 = $rows['mobile_2'];
        $saleman_name = $rows['saleman_name'];
        $saleman_mobile1 = $rows['saleman_mobile1'];
        $saleman_mobile2 = $rows['saleman_mobile2'];
	
        
        
        
    }


    

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
    <title>Receipt Voucher | Ahmed Traders</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Bhumlu Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Bhumlu, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.css">
    <link rel="stylesheet" href="assets/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/fonts/open-iconic.css">
    <link rel="stylesheet" href="assets/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="assets/css/shreerang-material.css">
    <link rel="stylesheet" href="assets/css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="assets/libs/select2/select2.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="assets/libs/timepicker/timepicker.css">
    <link rel="stylesheet" href="assets/libs/input-mask/inputmask.css">
    <link rel="stylesheet" href="assets/libs/input-mask/material.min.css">
    <link rel="stylesheet" href="assets/libs/phonemask/css/bootstrap-formhelpers.min.css">
        <style>
    #profileImage {    
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #2a3542;
        font-size: 21px;
        color: #fff;
        float: left;
        text-align: center;
        line-height: 40px;
        text-transform: none;
        }
    .ui-builder{
        display: none;
    }      
    .received_amount{
        outline: none;
    }      
    </style>
    
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->

    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <?php include('headers/navigation.php') ?>
            
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <?php include('headers/top-navigation.php') ?>
                
                    <!-- [ Layout content ] Start -->
                <div class="layout-content">

                    <!-- [ content ] Start -->
                   <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Receipt Voucher</h4>
                    
                         <div class="card mb-4">
                                 <div class="card-body" style="border-style: solid; border-color: #716aca;">
                                    <form method="post" id="category_update"  action="cash_received.php"> 
                                    
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                               <h3 class="card-header bg-primary text-white" align="Center"><i class="fas fa-address-card" style="font-size:35px; "></i> &nbsp;Receipt Voucher</h3><br>
                                               <div class="form-row">      
                                                <div class="form-group col-md-12">
                                            <div class="card bg-secondary text-white" style="font-size: 33px;text-align: center;">Credit Account</div>
                                        </div></div><br>
                                                 <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Customer Name</label>
                                                         <select  class="form-control select2 customerType" required  name="customerType">
                                                            <option value="0">Select Customer Name</option>
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `customer` WHERE status = 0";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $customer_id = $rowss['id'];
                                                                     $customer_name = $rowss['customer_name'];
                                                                    echo '<option value="'.$customer_id.'">'.$customer_name.'</option>';    
                                                                }   
                                                            ?>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Previous Total Balance</label>
                                                         <input type="text" readonly="" class="form-control preciousBalance" required  name="address">
                                                         <div class="clearfix"></div>   
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i>Vouchar No#</label>
                                                         <input type="text" readonly="" class="form-control" required  name="vouchar_number" value="<?php echo $payment_voucher_num; ?>">
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                    
                                                 <div class="form-group col-md-3">
                                                     <label class="form-label form-label-lg">Voucher Date</label>
                                                     <input type="date" readonly="" value="<?php echo @$current_date ?>" class="form-control"  name="vouchar_date">
                                                     <div class="clearfix"></div>
                                                  </div>
                                                </div>
												<br>
                                             <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Company Name</label>
                                                         <select  class="form-control select2 companyNameSelected" required  name="companyName">
                                                            <option value="0">Select Company Name</option>
                                                            <?php
                                                                $fetch_category = "SELECT * FROM `company`";
                                                                $stht = $dbh->prepare($fetch_category);
                                                                $result = $stht->execute();
                                                                while($rowss = $stht->fetch(PDO::FETCH_ASSOC)){
                                                                      $company_id = $rowss['id'];
                                                                     $company_name = $rowss['company_name'];
                                                                    echo '<option value="'.$company_id.'">'.$company_name.'</option>';    
                                                                }   
                                                            ?>
                                                         </select>
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                         <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Previous Balance For Selected Company</label>
                                                         <input type="text" readonly="" class="form-control preciousBalanceByCompany" required  name="address">
                                                         <div class="clearfix"></div>   
                                                    </div>
                                                  </div>    

                                                <br>
                                                    <div class="form-row">      
                                                <div class="form-group col-md-12">
                                            <div class="card bg-success text-white" style="font-size: 33px;text-align: center;">Debit Account</div>
                                        </div></div><br>
                                                  
                                                 <br>
                                               <div class="form-row"> 
                                                <div class="form-group col-md-12">
                                                     <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i>Amount</label>
                                                     <input type="text" class="form-control received_amount"  id="received_amount"  name="received_amount"  placeholder="Amount">
                                                     <div class="clearfix"></div>
                                                    </div>
                                                </div><br>

                                                 <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Received From</label>
                                                       <input type="text" class="form-control"   name="received_from"  placeholder="Received From">   
                                                     <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                     <label class="form-label form-label-lg">Received By</label>
                                                       <input type="text" class="form-control"   name="received_by"  placeholder="Received By">   
                                                     <div class="clearfix"></div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                             <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                     <label class="form-label form-label-lg">Remarks</label>
                                                     <textarea  class="form-control"  name="remarks"></textarea>
                                                     <div class="clearfix"></div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-row">
                                                  <div class="form-group col-md-4 center" style="margin: 0 auto;">
                                                     <label class="form-label form-label-lg"></label>
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
                                                    </div>
                                                
                                            </div>

                                              </div>
                                            </div>



                                            </div>
                                             

                                               

                                               

                                            </div>

                                        </div>
 
                                    </form>
                                </div>
                            </div>         

                        <!-- / Filters -->



                    </div>
                    <!-- [ content ] End -->
                </div>
                <!-- [ Layout content ] Start -->

                

            </div>
            <!-- [ Layout container ] End -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper ] end -->


   <!-- Core scripts -->
    <script src="assets/js/pace.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!--    <script src="assets/js/jquery-3.3.1.min.js"></script>-->
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
      <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>
        <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="assets/libs/select2/select2.js"></script>
    
    <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>
    <script src="assets/js/pages/forms_selects.js"></script>
    <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
     <!-- Libs -->
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/datatables/datatables.js"></script>
        <script src="assets/libs/moment/moment.js"></script>
    <!-- Demo -->
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/tables_datatables.js"></script>
    <script src="assets/js/toastr.js"></script>
    
    

    
    
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>

       

    $('.select2').select2();       
    $('[data-toggle="tooltip"]').tooltip(); 
    function  showmessage(shortCutFunction, msg,title) {
            
            var shortCutFunction =shortCutFunction;
             var title = title;
            var msg = msg;
            var $toast = toastr[shortCutFunction](msg, title);
      }	
        toastr.options = {
        tapToDismiss: false
        , timeOut: 4500
        , extendedTimeOut: 0
        , allowHtml: true
        , preventDuplicates: true
        , preventOpenDuplicates: true
        , newestOnTop: true
        , closeButton: true
        , closeHtml: ''
          
    }
    
    $('body').on("submit","#category_update",function(e){
         
         setTimeout(function(){
               window.location.reload(1);
            }, 1000);

          <?php if(!@$_GET['id']) {echo "showmessage('success','Cash Received Successfully','Success')";  } ?>;
               
    })


    $('.account_type').on("change",function(){
        var account_type =  $('.account_type').val();
    
        if(account_type == "1"){
           
        }

        if (account_type == "2"){
        }

    })


    var  customerType;    
$(".customerType").on("change", function (event) {
      customerType  =  $(this).val();

         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?customerTypeCashRec='+customerType,
                  dataType: 'JSON',
            success: function (data) {
                var previousBalance = data.previousBalance;
                $('.preciousBalance').val(previousBalance);  
            },
            error: function(data){
               console.log("error");
           }
          }); 
 }) 
 
$(".companyNameSelected").on("change", function (event) {
    var  companyName  =  $(this).val();
    $('.preciousBalanceByCompany').val("");  
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?companyTypeCashRec='+companyName +'&customerTypeBCompany='+customerType,
                  dataType: 'JSON',
            success: function (data) {
            	console.log(data);
                var previousBalance = data.previousBalance;
                $('.preciousBalanceByCompany').val(previousBalance);  
            },
            error: function(data){
               console.log("error");
           }
          }); 
 }) 




$(".payment_type").on("change", function (event) {
    var  payment_type  =  $(this).val();
         $('.account_type').empty();
        $('.account_type').append($('<option></option>').val("0").html("Select Payment Type"));
         $.ajax({
            type: 'get',
            url: 'fetch_ajax.php?payment_type='+payment_type,
                  dataType: 'JSON',
            success: function (data) {
                
                $.each(data.payment_type, function (key, value) {
                 console.log(value.customer_name);
                $('.account_type').append($('<option></option>').val(value.id).html(value.customer_name));
                 
                
            });


            },
            error: function(data){
               console.log("error");
           }
          });
    
 }) 

        var firstName = $('#firstName').text();
        var intials = $('#firstName').text().charAt(0);
        console.log(intials);
        var profileImage = $('#profileImage').text(intials);
         
    
</script>
