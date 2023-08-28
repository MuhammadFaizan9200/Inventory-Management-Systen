<?php
session_start();
	
	include("headers/connect.php");
	include("headers/_user-details.php");
	include("headers/function.php");
	$year = date("Y");
	$year = explode("0",$year);
	 $current_date = date('Y-m-d');
   

	$customer_code_random = "NC/" . $year[1] ."/". mt_rand(100000, 999999);
	$customer_id = @$_GET['id'];

	if($_POST){
		
		$customer_name = $_POST['customer_name'];
		$address = $_POST['address'];
		$mobile_1 = $_POST['mobile_1'];
		
		
		if(@$_GET['id']){
			$update_query = "UPDATE `customer` SET `customer_name`='$customer_name',`address`='$address',`mobile_1`='$mobile_1',`added_by`='$user_id',`time_stamp`=now()  WHERE id ='$customer_id'";

		}else{
		   $update_query = "INSERT INTO `customer`(`customer_name`, `address`, `mobile_1`, `time_stamp`,`added_by`) VALUES ('$customer_name','$address','$mobile_1',now(),'$user_id')";
		}
		$stmt = $dbh->prepare($update_query);
		$stmt->execute(); 
	   header("Location:customer.php"); 
		
	}
	else{
		$typeArray = array();
		$fetch_query = "SELECT * FROM `customer` WHERE `id` ='$customer_id'";
		$sth = $dbh->prepare($fetch_query);
		$result = $sth->execute();
		$rows = $sth->fetch(PDO::FETCH_ASSOC);
	
		$customer_name = $rows['customer_name'];
		$address = $rows['address'];
		$mobile_1 = $rows['mobile_1'];
		
	
		
		
		
	}


	

?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
<head>
	 <title>Add Customer | Imran & Son's</title>

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

		<?php
			if(@$_GET['id']){
				echo '<script src="assets/js/jquery-3.2.1.min.js"></script>';
			}
		?>
		


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
						<h4 class="font-weight-bold py-3 mb-0">New Customer</h4>
						<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
								<li class="breadcrumb-item">Dashboard</li>
								<li class="breadcrumb-item active">Add Customer</li>
							</ol>
						</div>


						 <div class="card mb-4">
							<h3 class="card-header" align="Center"><i class="feather icon-user-plus" style="font-size:35px; "></i> &nbsp; Add New Customer </h3>
								 <div class="card-body">
									<form method="post" id="category_update" novalidate=""> 
										<div class="form-row">
											<div class="form-group col-md-12">
											    <label class="form-label form-label-lg"><i class="lnr lnr-user"></i> Name</label>
												 <input type="text" class="form-control" required name="customer_name" value="<?php echo @$customer_name  ?>" placeholder="Name of (Customer OR Distributor)">
												 <div class="clearfix"></div>
												 <br>

												 <div class="form-row">
													<div class="form-group col-md-12 bank_account" style="display: none;">
														 <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> A/c #</label>
														  <input type="text" class="form-control" required name="account_number" value="" placeholder="Bank">

														 <div class="clearfix"></div>   
													</div>
													<div class="form-group col-md-6">
														 <label class="form-label form-label-lg"><i class="lnr lnr-home"></i> Address</label>
														 <input type="text" class="form-control"  name="address" value="<?php echo @$address  ?>" placeholder="Address of (Customer OR Distributor)">
														 <div class="clearfix"></div>   
													</div>
													<div class="form-group col-md-6">
													 <label class="form-label form-label-lg"><i class="lnr lnr-smartphone"></i> Mobile#1</label>
													 <input type="text" class="form-control"  name="mobile_1" value="<?php echo @$mobile_1  ?>" placeholder="For e.g '0333-123456'">
													 <div class="clearfix"></div>
													</div>
												</div>
												
											<div class="form-group col-md-3">
		                                        <br>
		                                        <button type="submit" class="btn btn-primary btn btn-block add_product"  role="button">Add Customer</button>
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
	<script src="assets/js/jquery-3.2.1.min.js"></script><!-- tables not work in jquery-3.3.1 js -->
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
	<script src="assets/libs/vanilla-text-mask/vanilla-text-mask.js"></script>
	<script src="assets/libs/vanilla-text-mask/text-mask-addons.js"></script>
	<script src="assets/libs/input-mask/jquery.inputmask.min.js"></script>
	<script src="assets/libs/input-mask/material.min.min.js"></script>



	<!-- Demo -->

	<script src="assets/js/demo.js"></script><script src="assets/js/analytics.js"></script>
	<script src="assets/js/pages/forms_selects.js"></script>
	<script src="assets/js/pages/forms_pickers.js"></script>
	<script src="assets/js/pages/forms_extras.js"></script>
	   <script src="assets/js/toastr.js"></script>
	
	

	
	
</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_tickets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:56 GMT -->
</html>

<script>
	 $('.set_account_type').select2();       
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
		 
		  <?php if(!@$_GET['id']) {echo "showmessage('success','Customer Insert Successfully','Success')";  } ?>
	})

//    <?php
//        if(@$_GET['id']){
//          echo "showmessage('success','Product Update Successfully','Success')";  
//        }else{
//            echo "showmessage('success','Product Insert Successfully','Success')";  
//        }
//        
//    ?>


	$('.set_account_type').on("change",function(){
		var account_type =  $('.account_type').val();
		if(account_type == "10"){
			$('.bank').show();
			$('.bank_account').show();
			
		}else{
			$('.bank').hide();
			$('.bank_account').hide();
		}

	})

	
	
	

		var firstName = $('#firstName').text();
		var intials = $('#firstName').text().charAt(0);
		console.log(intials);
		var profileImage = $('#profileImage').text(intials);
		 
	
</script>
