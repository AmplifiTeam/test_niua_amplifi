<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title> NIUA | Dashboard </title>
<meta content="" name="description">
<meta content="" name="keywords">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="icon">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
</head>
<body class="toggle-sidebar">
<header id="header" class="header fixed-top d-flex align-items-center">
<div class="d-flex align-items-center justify-content-between">
<a href="javascript:void(0);" class="logo d-flex align-items-center">
<img src="<?php echo base_url('assets/niua/img/logo.png'); ?>" alt="">
<img src="<?php echo base_url('assets/niua/img/logo-2 ministoy-B.png'); ?>" alt="">
</a>
</div>
<nav class="header-nav ms-auto">
<ul class="d-flex align-items-center">
<li class="nav-item dropdown">
<a class="nav-link nav-icon" href="javascript:void(0);" data-bs-toggle="dropdown">
<i class="bi bi-bell"></i>
</a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
<li class="dropdown-header">
You have 3 new notifications
<a href="javascript:void(0);"><span class="badge rounded-pill bg-primary p-2 ms-2"> View all </span></a>
</li>
<li>
<hr class="dropdown-divider">
</li>
<li class="notification-item">
<i class="bi bi-check-circle text-success"></i>
<div>
  <h4> Define values according  </h4>
  <p> Define values according to the organization’s ...&ZeroWidthSpace;</p>
</div>
</li>
<li>
<hr class="dropdown-divider">
</li>
<li class="notification-item">
<i class="bi bi-check-circle text-success"></i>
<div>
  <h4> Leading the growth </h4>
  <p>Leading the growth of a sustainable ...&ZeroWidthSpace;</p>
</div>
</li>
<li>
<hr class="dropdown-divider">
</li>
<li class="notification-item">
<i class="bi bi-check-circle text-success"></i>
<div>
  <h4>Enabling the endowment  </h4>
  <p> Enabling the endowment sector to ...&ZeroWidthSpace;</p>
</div>
</li>
<li>
<hr class="dropdown-divider">
</li>

</ul><!-- End Notification Dropdown Items -->
</li><!-- End Notification Nav -->
<li class="nav-item dropdown pe-3">
<a class="nav-link nav-profile d-flex align-items-center pe-0" href="javascript:void(0);" data-bs-toggle="dropdown">
<img src="assets/img/messages-1.jpg" alt="Profile" class="rounded-circle">
<span class="d-none d-md-block dropdown-toggle ps-2"> Admin </span>
</a><!-- End Profile Iamge Icon -->
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
<li>
<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/logout'); ?>">
  <i class="bi bi-box-arrow-right"></i>
  <span>Sign Out</span>
</a>
</li>
</ul>
</li><!-- End Profile Nav -->
<li class="pe-3"> 
<i class="bi bi-list toggle-sidebar-btn"></i>
</li>
</ul>
</nav><!-- End Icons Navigation -->
</header><!-- End Header -->
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<ul class="sidebar-nav" id="sidebar-nav">
<li class="nav-item">
<a class="nav-link " href="index.html">
<i class="bi bi-grid"></i>
<span>My Dashboard</span>
</a>
</li><!-- End Dashboard Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-menu-button-wide"></i><span> My Beneficiaries </span>
</a>
</li><!-- End Components Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-journal-text"></i><span> My Requests  </span>
</a>
</li><!-- End Forms Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-layout-text-window-reverse"></i><span> My Documents </span>
</a>
</li><!-- End Tables Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-bar-chart"></i><span> My Contributions </span>
</a>
</li><!-- End Charts Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-envelope"></i> <span> Help &amp; Support</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
<span> Other</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li>
<a href="">
<i class="bi bi-circle"></i><span> Menu 1 </span>
</a>
</li>
<li>
<a href="">
<i class="bi bi-circle"></i><span> Menu 2 </span>
</a>
</li>
</ul>
</li>
<!-- End Icons Nav -->
</ul>
</aside><!-- End Sidebar-->
<main id="main" class="main">
<div class="pagetitle">
<h1> Welcome to Urban Outcomes Frameworks 2023 </h1>
<div class="save-part">
<form>
<span>Servery 2023</span>
<button type="submit" class="btn btn-primary sub-p"> Submit </button>
</form> 
</div>
</div>
<!-- End Page Title -->
<section>
<div class="mt-n10">
<div class="flex-container">
<div>	
<a class="navbar-brand img-bx1" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>"></span>
<h5> Demography</h5>
<div class="line"></div>
<h6>0/14</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx2" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-2.svg'); ?>"></span>
<h5> Economy </h5>
<div class="line"></div>
<h6>0/23</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx3" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-3.svg'); ?>"></span>
<h5> Education </h5>
<div class="line"></div>
<h6>0/21</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx4" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-4.svg'); ?>"></span>
<h5> Energy </h5>
<div class="line"></div>
<h6>0/47</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx5" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-5.svg'); ?>"></span>
<h5> Finance </h5>
<div class="line"></div>
<h6>0/75</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx6" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-6.svg'); ?>"></span>
<h5> Governance &amp; ICT </h5>
<div class="line"></div>
<h6> 0/20</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx7" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-7.svg'); ?>"></span>
<h5> Housing </h5>
<div class="line"></div>
<h6>0/14</h6>
</div>           
</a>
</div>
</div>
<div class="flex-container">
<div>	
<a class="navbar-brand img-bx1" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-8.svg'); ?>"></span>
<h5> Environment </h5>
<div class="line"></div>
<h6>0/24</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx2" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-9.svg'); ?>"></span>
<h5> Water and Sanitation </h5>
<div class="line"></div>
<h6>0/31</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx3" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-10.svg'); ?>"></span>
<h5> Safety and Security </h5>
<div class="line"></div>
<h6>0/13</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx4" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-11.svg'); ?>"></span>
<h5> Health </h5>
<div class="line"></div>
<h6>0/42</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx5" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-12.svg'); ?>"></span>
<h5> Mobility </h5>
<div class="line"></div>
<h6>0/24</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx6" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-13.svg'); ?>"></span>
<h5> Planning Regulation </h5>
<div class="line"></div>
<h6> 0/20</h6>
</div>           
</a>
</div>
<div>	
<a class="navbar-brand img-bx7" href="">           
<div class="box-content">
<span><img src="<?php echo base_url('assets/niua/img/icon-14.svg'); ?>"></span>
<h5> Solid Waste Management </h5>
<div class="line"></div>
<h6>0/14</h6>
</div>           
</a>
</div>
</div>
</div>
</section>
</main><!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
<div class="copyright"> © 2023 <span class="colr-n-1"> National Institute of Urban Affairs. </span>  All Rights Reserved .</div>
<div class="credits">
Maintained By <a href="https://niua.in/" target="_blank"> NIUA </a>
</div>
</footer>
<a href="javascript:void(0);" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
</body>
</html>