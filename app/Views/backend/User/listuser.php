<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title> NIUA | ADMIN </title>
<meta content="" name="description">
<meta content="" name="keywords">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="icon">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/datatable/jquery.dataTables.min.css'); ?>">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<style>
  #toolbarContainer{
    display: none !important;
  }
  div.container {
  width: 80%;
  }

.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current{
  color: white !important;

}
a.paginate_button.current {
  color: white !important;
}

.save-part{
  padding: 1px 20px 2px 20px;
  margin: 0px 0px 0px 5px;
  text-align: center;
  background-color: #0081c4;
  border-radius: 3px;
}
</style>
</head>
<body>
<!-- ======= Header ======= -->
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
<div class="pagetitle">

<p>
<a href="<?=base_url('/admin/dashboard')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1>User Management</h1>


<a style="margin-left:5px;" href="<?php echo base_url('admin/user-master'); ?>" class="btn btn-primary save-part">Add User</a>
</div>
<section class="section dashboard">
<form>
<div class="row">
<div class="col-lg-12">
<div class="data-tabl2">
<table class="table table-striped" id="question_list">
<thead>
<tr>
<th scope="col">S.No</th>
<th scope="col">User Id</th>
<th scope="col">Name</th>
<th scope="col">State</th>
<th scope="col">State Code</th>
<th scope="col">Zone</th>
<th scope="col">Role</th>
<!-- <th scope="col" class="text-center">Created Date</th> -->
<th scope="col" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$i=1;
$k=1;
if(isset($listdata) && !empty($listdata)) {
  // echo "<pre>"; print_r($listdata);die;
foreach ($listdata as $data) {

?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo isset($data["City_ID"])?$data["City_ID"]:""; ?></td>
    <td><?php echo isset($data["City"])?$data["City"]:""; ?></td>
    <td><?php echo (isset($data["State"]) && $data["State"]!='')?$data["State"]: "NA"; ?></td>
    <td><?php echo (isset($data["State_Code"]) && $data["State_Code"])?$data["State_Code"]:"NA"; ?></td>
    <td><?php echo (isset($data["Zone"]) && $data["Zone"]) ?$data["Zone"]:"NA"; ?></td>
    <td><?php if((int)$data['role']==2){echo "Validator 1";}else if((int)$data['role']==3){echo "Validator 2";}else if((int)$data['role']==4){echo "City Official";}?></td>

    <td class="text-center">
    <a href="<?php echo base_url('admin/user-fetch/'.$data['user_id']);?>"><span class=""><i title="edit" class="bi bi-pencil-square"></i></span></a>
    </td>
  </tr>
<?php $i++;}} ?>  
</tbody>
</table>

</div>
</div>
</div>
</form>
</section>
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/datatable/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script>  
  new DataTable('#question_list');
</script>
</body>
</html>