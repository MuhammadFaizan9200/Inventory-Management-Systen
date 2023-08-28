    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Bhumlu Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Bhumlu, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.css">
    <link rel="stylesheet" href="assets/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/fonts/open-iconic.css">
    <link rel="stylesheet" href="assets/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">
<link rel="stylesheet" href="assets/libs/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="assets/libs/select2/select2.css">
    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="assets/css/shreerang-material.css">
    <link rel="stylesheet" href="assets/css/uikit.css">
    <link rel="stylesheet" href="assets/css/toastr.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/libs/datatables/datatables.css">

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

    <style type="text/css">

   <?php
    if (basename($_SERVER['PHP_SELF']) == 'sale_invoice.php' ||  basename($_SERVER['PHP_SELF']) == 'sale-return.php') {
        ?>      
        @media (min-width: 992px){
.layout-fixed:not(.layout-collapsed) .layout-container, .layout-fixed-offcanvas:not(.layout-collapsed) .layout-container {
    padding-left: 0rem !important;
}
    <?php
        }
    ?>
    </style>
<!-- [ Layout sidenav ] Start -->
             <?php
                    if (basename($_SERVER['PHP_SELF']) != 'sale_invoice.php' && basename($_SERVER['PHP_SELF']) != 'sale-return.php') {
            ?>
            <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
                <!-- Brand demo (see assets/css/demo/demo.css) -->
                <div class="app-brand demo">
                    <span class="app-brand-logo demo">
<!--                        <img src="assets/img/logo.png" alt="Brand Logo" class="img-fluid">-->
                    </span>
                    <a href="index.php" class="app-brand-text demo sidenav-text font-weight-normal ml-2">AHMED TRADERS</a>
                    <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                        <i class="ion ion-md-menu align-middle"></i>
                    </a>
                </div>


                <div class="sidenav-divider mt-0"></div>

                     <!-- Links -->
                <ul class="sidenav-inner py-1">

                    <!-- Dashboards -->

                    <li class="sidenav-item">
                        <a href="#" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                     <li class="sidenav-divider mb-1"></li>
                     <li class="sidenav-item">
                        <a href="javascript:" class="sidenav-link sidenav-toggle">
                            <i class="sidenav-icon fas fa-shipping-fast"></i>
                            <div>Inventory</div>
                        </a>
                        <ul class="sidenav-menu">
                                <li class="sidenav-item active">
                                    <a href="add-product.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-dolly"></i>
                                        <div>Inventory</div>
                                    </a>
                                </li> 

                                <li class="sidenav-item active">
                                    <a href="inventory-report.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-dolly"></i>
                                        <div>Inventory Report</div>
                                    </a>
                                </li> 
                              
                                <li class="sidenav-item">
                                    <a href="inventory-history.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-hashtag"></i>
                                        <div>Inventory History</div>
                                    </a>
                                </li>
                                
                        </ul>
                    </li>

                    <li class="sidenav-item">
                        <a href="companies.php" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Companies</div>
                        </a>
                    </li>
    
                    <li class="sidenav-item">
                        <a href="saleman.php" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Saleman's</div>
                        </a>
                    </li>

                     <li class="sidenav-item">
                        <a href="daily-sale-report.php" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Daily Sale Report</div>
                        </a>
                    </li>

                     <li class="sidenav-item">
                        <a href="discount-invoices.php" class="sidenav-link">
                            <i class="sidenav-icon feather icon-home"></i>
                            <div>Discount Invoices</div>
                        </a>
                    </li>

                     <li class="sidenav-divider mb-1"></li>
                     <li class="sidenav-item">
                        <a href="javascript:" class="sidenav-link sidenav-toggle">
                            <i class="sidenav-icon fas fa-shipping-fast"></i>
                            <div>Customer</div>
                        </a>
                        <ul class="sidenav-menu">
                                <li class="sidenav-item active">
                                    <a href="customer.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-dolly"></i>
                                        <div>Add Customer</div>
                                    </a>
                                </li> 
                              
                                <li class="sidenav-item">
                                    <a href="cash_received.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-hashtag"></i>
                                        <div>Receipt Voucher</div>
                                    </a>
                                </li>
                                
                             <li class="sidenav-item">
                                    <a href="customer_leaders.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-hashtag"></i>
                                        <div>Customer Ledger</div>
                                    </a>
                                </li>
                            
                        </ul>
                    </li>
                     
                   <li class="sidenav-divider mb-1"></li>
                      <li class="sidenav-item">
                        <a href="javascript:" class="sidenav-link sidenav-toggle">
                            <i class="sidenav-icon fas fa-clipboard-list"></i>
                            <div>Sale</div>
                        </a>
                        <ul class="sidenav-menu">
                               
                                <li class="sidenav-item active">
                                    <a href="view-sale-invoice.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-check"></i>
                                        <div>Sale Invoice</div>
                                    </a>
                                </li> 
                                <li class="sidenav-item active">
                                    <a href="sale-return.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-check"></i>
                                        <div>Sale Return</div>
                                    </a>
                                </li> 

                                
                             <!-- <li class="sidenav-item active">
                                    <a href="invoice-pdf.php" class="sidenav-link" >
                                        <i class="sidenav-icon fas fa-check"></i>
                                        <div>Invoice Pdf</div>
                                    </a>
                                </li>  -->
                            
                        </ul>
                    </li>
                  
                </ul>
            </div>
            <?php
                }
            ?>
            <!-- [ Layout sidenav ] End -->
            
        