<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>தேவ் கேட்டரிங்</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>assets\img\catering_log.png" alt="" style="width:50%;"" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/demo.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTable/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTable/dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTable/dataTables.dateTime.min.css" />
    <script src="<?php echo base_url();?>assets/js/dataTable/jquery-3.7.1.js"></script>
    <!-- Include SelectBox CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/multiselect/dist/css/bootstrap-multiselect.css">
    <!-- Application CSS -->         
    <link rel="stylesheet" href="<?php echo base_url();?>assets/toastr/css/toastr.css">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo base_url();?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo base_url();?>assets/js/config.js"></script>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo " style="height:150px;">
            <a href="<?php echo base_url()?>admin/dashboard" class="app-brand-link">
						<img src="<?php echo base_url(); ?>assets\img\catering_log.png" alt="" style="width:100%;">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?php if($this->uri->segment(2)=="dashboard"){echo "active";}?>">
              <a href="<?php echo base_url()?>admin/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li> 
            <?php if( ($this->session->userdata['admin_id'] == 1) && ($this->session->userdata['role'] == 'admin') ): ?>           
            <li class="menu-item <?php if($this->uri->segment(2)=="menu"){echo "active";}?>">
              <a href="<?php echo base_url()?>admin/menu" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div>Menu </div>
              </a>
            </li>
            <li class="menu-item <?php if($this->uri->segment(2)=="vessels"){echo "active";}?>">
              <a href="<?php echo base_url()?>admin/vessels" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div>Vessels </div>
              </a>
            </li>
            <li class="menu-item <?php if($this->uri->segment(2)=="category"){echo "active";}?>">
              <a href="<?php echo base_url()?>admin/category" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Category </div>
              </a>
            </li>
            <li class="menu-item <?php if($this->uri->segment(2)=="package"){echo "active";}?>">
              <a href="<?php echo base_url()?>admin/package" class="menu-link" >
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div>Package </div>
              </a>
            </li>
            <li class="menu-item <?php if($this->uri->segment(2)=="salesquote" || $this->uri->segment(2)=="salesinvoice"){echo "active";}?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-credit-card-front"></i>
                <div data-i18n="Authentications">Sales</div>
              </a>
              <ul class="menu-sub">               
                <li class="menu-item <?php if($this->uri->segment(2)=="salesquote"){echo "active";}?>">
                  <a href="<?php echo base_url()?>admin/salesquote" class="menu-link" >
                    <div>Quote</div>
                  </a>
                </li>
                <li class="menu-item <?php if($this->uri->segment(2)=="salesinvoice"){echo "active";}?>">
                  <a href="<?php echo base_url()?>admin/salesinvoice" class="menu-link" >
                    <div>Invoice</div>
                  </a>
                </li>
              </ul>
            </li>
            <?php endif; ?>
            <li class="menu-item <?php if($this->uri->segment(2)=="kitchen"){echo "active";}?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dish"></i>
                <div data-i18n="Authentications">Kitchen</div>
              </a>
              <ul class="menu-sub">               
                <li class="menu-item <?php if($this->uri->segment(2)=="kitchen"){echo "active";}?>">
                  <a href="<?php echo base_url()?>admin/kitchen" class="menu-link" >
                    <div>Order list</div>
                  </a>
                </li>
                <li class="menu-item <?php if($this->uri->segment(3)=="items"){echo "active";}?>">
                  <a href="<?php echo base_url()?>admin/kitchen/items" class="menu-link" >
                    <div>Item List</div>
                  </a>
                </li>
              </ul>
            </li>
			
			
			
			<li class="menu-item <?php if($this->uri->segment(2)=="delivery"){echo "active";}?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-car"></i>
                <div data-i18n="Authentications">Delivery Challan</div>
              </a>
              <ul class="menu-sub"> 
                <li class="menu-item <?php if($this->uri->segment(2)=="delivery"){echo "active";}?>">
                  <a href="<?php echo base_url()?>admin/delivery" class="menu-link" >
                    <div>Add & List</div>
                  </a>
                </li>              
              </ul>
            </li>
			
          </ul>
        </aside>
        <!-- / Menu -->
