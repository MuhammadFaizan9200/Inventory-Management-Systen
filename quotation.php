<?php
ob_start();
session_start();
include("headers/connect.php");
include("headers/_user-details.php");
require("fpdf/fpdf.php");
include("headers/function.php");
$getInvoiceDetails = array();
$date = date('Y-m-d');
$currentTime = date("h:i:s");
$sale_invoice_random = "QUT/" . "PP1" ."/". mt_rand(100000, 999999);


 if($_POST){
 

    $categoryName = $_POST['categoryName'];
    $insert_productName = $_POST['insert_productName'];
    $list_price = $_POST['list_price'];
    $total_quantity = $_POST['total_quantity'];
    $discount = $_POST['discount'];
    $net_price = $_POST['net_price']; 
    $net_amount = $_POST['net_amount'];
    $avialableQuantity = $_POST['avialableQuantity'];
    $customerName = $_POST['customerName'];
    $customerAddress = $_POST['customerAddress'];


    $fpdf = new FPDF("p",'mm','A4');
    $fpdf->addPage();

   
    $fpdf->Cell(189,35,'',0,1);
    

    $fpdf->SetFont('Arial','B',14 );
    $fpdf->Cell(65);
    $fpdf->Cell(60,10,'**QUOTATION**',0,0,'C');


    $fpdf->Cell(189,20,'',0,1);
    $fpdf->SetFont('Arial','B',14);

    //Cell width , height,border.text
    $fpdf->Cell(130,5,'Customer Information',0,0);
   
    $fpdf->Cell(130,5,'Customer Name : '.$customerName.' ',0,0);
    $fpdf->Cell(50,5,'Inputed By: --',0,1);

    $fpdf->Cell(130,5,'Address : '.$customerAddress.' ',0,0);

    $fpdf->Cell(130,5,'Remarks :--',0,0);
    $fpdf->Cell(50,5,'Date : '.$date.' ',0,1);

    $fpdf->Cell(189,10,'',0,1);
    // Invoice content

    $fpdf->SetFont('Arial','B',12 );
    $fpdf->Cell(60,10,'Description Of Goods',1,0,'C');
    $fpdf->Cell(30,10,'Quantity',1,0,'C');
    $fpdf->Cell(30,10,'List Price',1,0,'C');
    $fpdf->Cell(20,10,'Disc %',1,0,'C');
    $fpdf->Cell(20,10,'Rate',1,0,'C');
    $fpdf->Cell(30,10,'Amount',1,1,'C');


    $fpdf->SetFont('Arial','',12 );



     foreach($categoryName as $key=>$value){
            
            $categoryNameValue = $categoryName[$key];
            $insert_productNameValue = $insert_productName[$key];
            $list_priceValue =  $list_price[$key];
            $total_quantityValue =  $total_quantity[$key];
            $discountValue =  $discount[$key];
            $net_priceValue = $net_price[$key];
            $net_amountValue = $net_amount[$key];
            $avialableQuantityValue = $avialableQuantity[$key];

        $insert_query_details = "INSERT INTO `quotation`(`categoryName`, `insert_productName`, `list_price`, `total_quantity`, `discount`, `net_price`, `net_amount`, `sale_invoice_id`, `time_stamp`,`customer_id`) VALUES ('$categoryNameValue','$insert_productNameValue','$list_priceValue','$total_quantityValue','$discountValue','$net_priceValue','$net_amountValue','0',now(),'0')";
            $stmtt = $dbh->prepare($insert_query_details);
            $stmtt->execute(); 

              $fpdf->SetFillColor(224,220,255);
                $fpdf->SetTextColor(0);
                $fpdf->SetDrawColor(209, 212, 207);
                $fpdf->SetLineWidth(.3);
                $fpdf->SetFont('');
                // Data
                $fill = false;   
                $fpdf->Cell(60,8,' '.$insert_productNameValue.' ',1,'LR',0,'L',$fill);
                $fpdf->Cell(30,8,''.$total_quantityValue.' ',1,'LR',0,'C',$fill);
                $fpdf->Cell(30,8,''.$list_priceValue.' ',1,'LR',0,'C',$fill);
                $fpdf->Cell(20,8,''.$discountValue.' ',1,'LR',0,'C',$fill);
                $fpdf->Cell(20,8,''.$net_priceValue.' ',1,'LR',0,'C',$fill);
                $fpdf->Cell(30,8,''.$net_amountValue.' ',1,1,'C',$fill);
                $fill = !$fill;

      }

      $fpdf->Cell(189,15,'',0,1);
     $fpdf->SetFont('Arial','B',11);

    //  //Cell width , height,border.text // Total Items
    //  $fpdf->Cell(35,10,'TOTAL # OF ITEMS:',0,0);
    //  $fpdf->Cell(5);
    //  $fpdf->Cell(20,10,' '.$total_number_items.' ',1,0,'C');

    //  // Quantity Total
    //  $fpdf->Cell(30);
    //  $fpdf->Cell(30,10,' '.$sum_of_quantity.' ',1,0,'C');


    //  $fpdf->Cell(10);
    // $fpdf->Cell(35,10,'Gross Amount:',0,0);
    // $fpdf->Cell(-5);
    // $fpdf->Cell(30,10,' '.$grossAmount.'',1,0,'C');

     $fpdf->Output(''.$date.'"_"'.$sale_invoice_random.'.pdf','D');

 }






?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/tables_datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:20 GMT -->
<head>
 <title>Quatation | ppipopular</title>
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
  .custom_button_align{
    float: right!important;
  } 
  .ui-builder{
    display: none;
  } 
  @media print { 
   /* All your print styles go here */
   #create_pdf { display: none !important; } 
 }                             
</style>
</head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
          <h4 class="font-weight-bold py-3 mb-0">Quatation</h4>
          <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active">Quatation</li>
            </ol>
          </div>

          <!-- Modal template -->
          <div class="modal fade" id="modals-default">
            <div class="modal-dialog modal-lg">

            </div>
          </div>

          <!-- Modal template end-->


          <div class="print-ledger-data" style="display: none"></div>       

          <div class="card mb-4">
            <h3 class="card-header bg-primary text-white" align="Center"><i class="fas fa-money-bill-alt" style="font-size:35px; "></i> &nbsp; Quatation</h3>
            <div class="card-body" style="border-style: solid; border-color: #716aca;">
              <form method="post" id="purchaseInvoice" class="form">
                <div class="form-row">

                  <div class="form-group col-md-4">
                   <label class="form-label">Customer Name</label>
                   <input type="text" class="form-control customerName" name="customerName" placeholder="Customer Name">
                   <div class="clearfix"></div>
                 </div>                                    
                 <div class="form-group col-md-4">
                   <label class="form-label">Customer Address</label>
                   <input type="text" class="form-control customerAddress" name="customerAddress" placeholder="Current Address">
                   <div class="clearfix"></div>
                 </div> 
               </div>
               <br>

               <div class="table-responsive">
                <table class="table product-discounts-edit datatable" id="datatable">
                  <thead>
                    <tr>
                      <th width="15%">Product Type</th>
                      <th width="15%">Product Name</th>
                      <th>List Price</th>
                      <th>Qty</th>
                      <th>Discount %</th>
                      <th>Net Price</th>
                      <th>Net Amount</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tr>
                    <td>
                      <select class="custom-select select_category select2-demo"  name="categoryName[]"  required>
                        <option value="0">Choose Type</option>
                        <?php
                        $fetch_query = "SELECT * FROM `category` ";
                        $sth = $dbh->prepare($fetch_query);
                        $result = $sth->execute();
                        while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
                          $id = $rows['id'];
                          $category_name = $rows['category_name'];
                          echo '<option value="'.$id.'">'.$category_name.'</option>';    
                        }	
                        ?>
                      </select>    
                    </td>

                    <td>
                     <select class="custom-select set_products select2-demo" name="insert_productName[]" required>
                      <option value="0">Choose Product</option>

                    </select> 
                  </td>


                  <td><input type="number" class="form-control list_price" name="list_price[]" placeholder="List Price" required></td> 


                  <td><input type="hidden" name="avialableQuantity[]" class="avialableQuantity"><input type="number" class="form-control total_quantity" name="total_quantity[]" required  placeholder="Total Qty."></td>
                  <td><input type="number" class="form-control discount" name="discount[]" placeholder="Discount %"></td>
                  <td><input type="number" required class="form-control net_price" name="net_price[]" placeholder="Net Price" required readonly=""></td>
                  <td><input type="number" required class="form-control net_amount" name="net_amount[]" placeholder="Net Amount" readonly=""></td>
                  <td><button type="button" class="btn icon-btn btn btn-outline-success add_invoice"><span class="fas fa-plus"></span></button></td>
                </tr>

              </table>


                                         <table class="table product-discounts-edit table_details" style="width:38%;float:right">
                                            <tr>
                                              <td colspan="7" class="py-3">

                                                <b>Total Gross Amount:</b><br>
                                                <b>Total Discount%:</b><br>
                                                <b>Total Net Amount:</b> <br>

                                                <!--  <span class="d-block text-big mt-2">  <strong>Payment Method:</strong>   </span> -->
                                                <span class="d-block text-big mt-2">  <strong>Total Receivable:</strong>   </span>
                                                <!--  <span class="d-block text-big mt-2">  <strong>Check Balance Amount:</strong>   </span> -->
                                              </td>


                                              <input type="hidden" name="grossAmount" class="grossAmount">
                                              <input type="hidden" name="totalDiscount" class="totalDiscount">
                                              <input type="hidden" name="totalNetAmount" class="totalNetAmount">
                                              <input type="hidden" name="totalReceivableInput" class="totalReceivableInput">



                                              <td class="py-3">

                                                <strong class="gross_amount"></strong><br>
                                                <strong class="totalDiscount"></strong>
                                                <br>
                                                <strong class="totalNetAmount"></strong>
                                                <br>


                                                <strong class="d-block text-big mt-2 totalReceivable" style="font-size:30px;"></strong>
                                                <br>

                                              </td>
                                            </tr>
                                          </table> 



                                        </div>



                                        <div class="form-group" align="right">
                                          <div class="col-sm-offset-8 col-sm-3">
                                            <button type="submit" id="create_pdf" class="btn btn-primary btn-lg btn-block" role="button">Print</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>

                                  </div>


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
                        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                        <script src="assets/libs/popper/popper.js"></script>
                        <script src="assets/js/bootstrap.js"></script>
                        <script src="assets/js/sidenav.js"></script>
                        <script src="assets/js/layout-helpers.js"></script>
                        <script src="assets/js/material-ripple.js"></script>

                        <!-- Libs -->
                        <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
                        <script src="assets/libs/bootstrap-select/bootstrap-select.js"></script>
                        <script src="assets/libs/bootstrap-multiselect/bootstrap-multiselect.js"></script>
                        <script src="assets/libs/select2/select2.js"></script>
                        <script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
                        <script src="assets/libs/moment/moment.js"></script>
                        <script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
                        <script src="assets/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
                        <script src="assets/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
                        <script src="assets/libs/timepicker/timepicker.js"></script>
                        <script src="assets/libs/minicolors/minicolors.js"></script>

                        <!-- Demo -->
                        <script src="assets/js/demo.js"></script><script src="assets/js/analytics.js"></script>
                        <script src="assets/js/pages/forms_selects.js"></script>
                        <script src="assets/js/pages/forms_pickers.js"></script>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
                        <script src="assets/js/spdf.plugin.autotable.js"></script>


                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> 

<script>  
                          
$('input:radio[name="payment_method"]').change(function(){
  if($(this).val() === '1'){
       // append stuff
       $('.bank_details').show();
       $('.check_details').hide();
     }
     else if($(this).val() === '3'){
       // append stuff
       $('.bank_details').hide();
       $('.check_details').show();

       $('.totalReceived').attr('readonly', true);
       $('.currentBalance').attr('readonly', true);
       $('.totalReceived').val("0");
       $('.currentBalance').val("0");
     }
     else{
       $('.totalReceived').attr('readonly', false);
       $('.currentBalance').attr('readonly', false);
       $('.totalReceived').val("");
       $('.currentBalance').val("");
       $('.bank_details').hide();
       $('.check_details').show();
     }
   });    


$('.add_invoice').on('click',function(){
  var $tr = $(this).closest('tr');   


  var total_quantity = parseInt($tr.find('.total_quantity').val());
  var avialableQuantity = parseInt($tr.find('.avialableQuantity').val());


  if(total_quantity > avialableQuantity){
    alert("Quantity not available");

  }else{
    var craditLimit = parseInt($('.craditLimit').val());
    var totalNetAmount = parseInt($('.totalReceivableInput').val());

    if(totalNetAmount > craditLimit){
     alert("Your Cash limit is excied please change the quantity");            
   }else{


    $('#datatable').append('<tbody><tr class="tRow"><td><select class="custom-select select_category categoryFunction" id="select_category"  name="categoryName[]" required><option selected>Choose Type</option>\
      <?php
      $fetch_query = "SELECT * FROM `category` ";
      $sth = $dbh->prepare($fetch_query);
      $result = $sth->execute();
      while($rows = $sth->fetch(PDO::FETCH_ASSOC)){
        $id = $rows['id'];
        $category_name = $rows['category_name'];
        echo '<option value="'.$id.'">'.$category_name.'</option>';    
      }	
      ?>
      </select></td><td><select class="custom-select set_products" required name="insert_productName[]"><option selected>Choose Product</option></select></td><td><input type="text" class="form-control list_price" name="list_price[]" required placeholder="List Price"></td><td><input type="hidden" name="avialableQuantity[]" class="avialableQuantity"><input type="text" required class="form-control total_quantity" name="total_quantity[]" placeholder="Total Qty"></td><td><input type="text" class="form-control discount"  placeholder="Discount %" name="discount[]"></td><td><input  required type="number" class="form-control net_price" placeholder="Net Price" name="net_price[]" required readonly=""></td><td><input type="number" required class="form-control net_amount" name="net_amount[]" placeholder="Net Amount" readonly=""></td><td><button type="button" class="btn icon-btn btn btn-outline-danger delete_tr_row"><span class="fas fa-trash-alt"></span></button></td></tr></tbody>'); 
    $('#datatable tr:last').find(".select_category").focus();
    $('.select_category').select2();
    $('.set_products').select2();       
  }
}



})  



// $("#purchaseInvoice").submit(function(e) {
	 
//   var form_data = new FormData(this);
//   swal({
//     title: "Are you sure you want to confirm this quotation?",
//     text: "Once updated, your quotation successfully saved!",
//     icon: "warning",
//     buttons: true,
//     dangerMode: true,
//   })

//   .then((willDelete) => {
//     if (willDelete) {
//      e.preventDefault();
//       swal("Poof! Quotation has been submit!", {
//         icon: "success",

//       });
//     } else {
//      return false;
//    }
//  });



// });

$(document).ready(function(){
 $('body').on("focusout",".amount",function(e){	  
  var $trs = $(this).closest('tr');   
  var amount = parseInt($trs.find('.amount').val());
  var totalReceivable = parseInt($('.totalReceivable').text());
  var checkBalanceAmountUpdated = $('.checkBalanceAmount').text();   
  console.log(checkBalanceAmountUpdated +"==");
  if(amount > totalReceivable){
   $trs.find('.amount').css({"color":"red","border":"1px solid red"});
   $('.add_banks').prop('disabled', true);
   alert("Check amount exceed to total receivable amount");
   return false;
 }
 else{
   $('.add_banks').prop('disabled', false);
   $trs.find('.amount').css({"color":"","border":"1px"});
   if(checkBalanceAmountUpdated != ""){
     totalReceivable = checkBalanceAmountUpdated;
     var checkBalanceAmount =  totalReceivable - amount;
     $('.checkBalanceAmount').text(checkBalanceAmount);   
   }else{
    var checkBalanceAmount =  totalReceivable - amount;
    $('.checkBalanceAmount').text(checkBalanceAmount);    
  }

}

})    
})


var  customerType;    
$(".customerType").on("change", function (event) {
  customerType  =  $(this).val();

  $.ajax({
    type: 'get',
    url: 'fetch_ajax.php?customerType='+customerType,
    dataType: 'JSON',
    success: function (data) {
      var previousBalance = data.previousBalance;
      if(previousBalance == null){
        previousBalance = 0;
      }

      $('.previousBalance').val(previousBalance);
      $('.totalPreviousBal').html(previousBalance);  

      $('.account_titles').val(data.account_title);
      $('.account_numbers').val(data.account_number);

      $('.bank').select2('data', {id: data.bank, a_key: 'National Bank of Pakistan'});

      $('.customer_ledger').attr('customer-id',customerType);



      $("#mySelect2").select2("val", "0");

      $('.craditLimit').val(data.credit_limit);
      $('.customerAddress').val(data.address);
      $('.opening_balance').html(data.opening_balance);
      $('.openingBalance').val(data.opening_balance)
                //console.log(data.credit_limit);  

              },
              error: function(data){
               console.log("error");
             }
           });

})    


$("table").on("change", ".select_category", function (event) {

  var  select_category =  $(this).closest('tr').find('.select_category').val();
  var $tr = $(this).closest('tr');
  $tr.find('.set_products').empty();
  $tr.find('.set_products').append($('<option></option>').val("0").html("Choose Product"));

  $.ajax({
    type: 'get',
    url: 'fetch_ajax.php?select_category='+select_category,
    dataType: 'JSON',
    success: function (data) {

      $.each(data.products, function (key, value) {
                 //console.log(value.product_name);
                 $tr.find('.set_products').append($('<option></option>').val(value.id).html(value.product_name));
                 $('.limit_message').hide();
                 $tr.find('.previousQuantity').val(value.product_quantity);


               });
      
    },
    error: function(data){
     console.log("error");
   }
 });

})       


$("table").on("change", ".set_products", function (event) {
 var  set_products_value =  $(this).closest('tr').find('.set_products').val();
 var $tr = $(this).closest('tr');

   $.ajax({
    type: 'get',
    url: 'fetch_ajax.php?set_products_value='+set_products_value +"&customerID="+customerType,
    dataType: 'JSON',
    success: function (data) {
       if(data.previousPrice != null){
         $('.previousPrice').html(data.previousPrice);
         $('.PreviousDiscount').html(data.previousDiscount); 
         $('.on_hand_quantity').html(product_quantity_sale); 
         $('.type_packing').html(data.type); 

       }else{
         $('.previousPrice').html("0");
         $('.PreviousDiscount').html("0");   
         $('.on_hand_quantity').html(product_quantity_sale); 
         $('.type_packing').html(data.type); 
       }

       $tr.find('.list_price').val(data.price);    
       $tr.find('.avialableQuantity').val(data.product_quantity_sale);       
     
   },
   error: function(data){
     console.log("error");
   }
 });
 
})        

$(document).ready(function(){
  $("table").on("click", ".delete_tr_row", function (event) {
    var IdArray = $('.productsdeleteID').val();    

    if(IdArray != ''){
      $('.productsdeleteID').val(IdArray+","+this.id);
    }
    else{
      $('.productsdeleteID').val(this.id);
    }	
    $(this).closest('tr').remove();
    calcul();

  })
 })

  $('body').on("keyup change",".datatable tbody tr", function() {
    calcul();

  });

  $('.totalReceived').on('keyup change',function(){
    var totalReceived = $(this).val();
    $('.amountReceived').val(totalReceived); 
    $('.previousBalance').val(parseInt($('.totalReceivable').html() - totalReceived));
    $('.currentBalance').val(parseInt($('.totalReceivable').html() - totalReceived));  
});


function calcul()
{
  $('.datatable tr').each(function(i, element) {

   var $tr = $(this).closest('tr');
   var discount = $tr.find('.discount').val();
   var total_quantity = $tr.find('.total_quantity').val();
   var net_price = $tr.find('.net_price').val();
   var net_amount = $tr.find('.net_amount').val();
   var list_price = $tr.find('.list_price').val();

   var net_price = list_price * total_quantity;
   afterDiscount= net_price - (net_price * discount/100 );    
   $tr.find('.net_price').val(net_price.toFixed(2));
   $tr.find('.net_amount').val(afterDiscount.toFixed(2));
   calc_total();
 });
}

function calc_total()
{
  net_price = 0;
  $('.net_price').each(function() {
    net_price += parseInt($(this).val());

  });
  totalDiscount = 0;
  $('.discount').each(function() {
    totalDiscount += parseInt($(this).val());
  });
//        
net_amount = 0;
$('.net_amount').each(function() {
  net_amount += parseInt($(this).val());
});
//        
if(!isNaN(net_price)){
  $('.gross_amount').html(net_price.toFixed(2));
  $('.grossAmount').val(net_price.toFixed(2));
}

if(!isNaN(totalDiscount)){
  $('.totalDiscount').html(totalDiscount.toFixed(2));
  $('.totalDiscount').val(totalDiscount.toFixed(2));
}

if(!isNaN(net_amount)){
  $('.totalNetAmount').html(net_amount.toFixed(2));
  $('.totalNetAmount').val(net_amount.toFixed(2));

  var totalPreviousBal = parseInt($('.totalPreviousBal').html());
  $('.totalReceivable').html(totalPreviousBal + net_amount);
  $('.totalReceivableInput').val(totalPreviousBal + net_amount);    
}
}



  var firstName = $('#firstName').text();
  var intials = $('#firstName').text().charAt(0);
  var profileImage = $('#profileImage').text(intials);





</script>
