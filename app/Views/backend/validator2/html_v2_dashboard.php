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
<style>
  #toolbarContainer{
    display: none !important;
  }  
</style>
</head>
<body>
<!-- ======= Header =========== -->
<?php echo view('backend/partials/top_header.php'); ?>
<!-- ======= End Header ======= -->
<!-- ======= Sidebar ======= -->
<aside style="display: none;" id="sidebar" class="sidebar">
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
<i class="bi bi-envelope"></i> <span> Help & Support</span>
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
</ul>
</aside>




<main id="main" class="main">

<!-- #################### Page Title & Survey Selection ############################# -->
<div class="pagetitle">
<div class="save-part">
<div class="save-part d-flex">
<div class="SurveyDropDownSelection d-flex justify-content-center">    
<select class="form-select" id="Survey_ID" name="Survey_ID" aria-label="Default select example" style="width: 100%;height: 100%;">
<option value="0" selected="">Select Survey</option>
</select>
</div>
</div>
</div>
<h1 id="ChangeSurveyName">Welcome to Urban Outcomes Frameworks 2023 - Validator 1</h1>
</div>
<!-- #################### End Page Title & Survey Selection ############################# -->





<section class="section dashboard">
<form>
<div class="row">
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>45</strong> 
<span class="abd-co2">Total Cities Assigned</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>5</strong> 
<span class="abd-co2">Recently Added Cities</span> 
<label>Withen 1 week</label>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>16</strong> 
<span class="abd-co2">Cities Validated</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>12</strong> 
<span class="abd-co2">Send to V2</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>29</strong> 
<span class="abd-co2">Pending Cities</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>3</strong> 
<span class="abd-co2">Priority Cities</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
</div>




<div class="row justify-content-end">
<div class="col-lg-3 selet1"> 
<select class="form-select" aria-label="Default select example">
<option selected>All state</option>
<option value="1">One</option>
<option value="2">Two</option>
<option value="3">Three</option>
</select>
</div>
<div class="col-lg-1 crt-2">
<label for="" class=""><button type="button" class="btn btn-primary btn-sm">Download</button></label>         
</div>        
<div class="col-lg-5 sec1"> </div>
<div class="col-lg-3 ">
<div class="header2">
<div class="search-bar search-bar3">
<div class="search-form d-flex align-items-center">
<input type="text" name="query" placeholder="Search" title="Enter search keyword">
<button type="submit" title="Search"><i class="bi bi-search"></i></button>
</div>
</div>
</div>
</div>
</div>




<div class="row">        
<div class="col-lg-12 ad-table1">
<table class="table table-db1">
<thead>
<tr class="tbl-bg1">
<th class="tb-wid01" scope="col">S No.</th>
<th class="tb-wid01" scope="col"> &nbsp; </th>
<th class="tb-wid01" scope="col">
<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
</th>
<th class="tb-wid1" scope="col">Job Id 
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span>
</th>
<th class="tb-wid1" scope="col"> City Name
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span> 
</th>            
<th class="tb-wid2" scope="col"> Response Submitted on
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span>
</th>
<th class="tb-wid2" scope="col"> Approved 
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span>
</th>
<th class="tb-wid2" scope="col"> Rejected 
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span>
</th>
<th class="tb-wid2" scope="col"> Reverted with comment 
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span>
</th>
<th class="tb-wid2" scope="col"> Submission Status
<span class="tb-pd-1"> <a href="#"> <i class="bi bi-caret-up-fill"></i> </a> </span>
<span class="tb-pd-2"> <a href="#"> <i class="bi bi-caret-down-fill"></i> </a> </span>
</th>
<th class="tb-wid2"  scope="col"> Action </th>
</tr>
</thead>
<tbody class="table-group-divider">
<tr>
<td class="tb-wid01"> 1. </td> 
<td class="tb-wid01"> <i class="bi bi-star-fill"></i> </td>
<td class="tb-wid01"> <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked> </td>
<td class="tb-wid1"> 10005 </td>
<td class="tb-wid1"> Portblair </td>
<td class="tb-wid2"> 16th Sep 2023</td>
<td class="tb-wid2"> <div class="line3"></div>0% </td>
<td class="tb-wid2"> <div class="line3"></div>0% </td>
<td class="tb-wid2"> <div class="line3"></div>0%  </td>
<td class="tb-wid2"> <a class="dem-but2a" href="#">Validated </a> 
<span class="info-circle1"><i class="bi bi-info-circle-fill"></i></span> 
</td>
<td class="tb-wid2"> <a class="dem-but4" href=""><i class="bi bi-text-indent-left"></i>  Send to V2 </a>
<div class="filter filt2">
<a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
<li><a class="dropdown-item" href="#">Today</a></li>
<li><a class="dropdown-item" href="#">This Month</a></li>
<li><a class="dropdown-item" href="#">This Year</a></li>
</ul>
</div>
</td>
</tr>

</tbody>
</table>
</div>
</div>
</form>
</section>
</main>
<?php echo view('backend/partials/footer.php'); ?>
<a href="javascript:void(0);" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
</body>
</html>