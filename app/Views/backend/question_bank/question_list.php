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
<?php echo view('backend/partials/top_header.php'); ?>
<main id="main" class="main">
<div class="pagetitle">
<p>
<a href="<?=base_url('/admin/dashboard')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1>Survey All Questions</h1>
<a style="margin-left:5px;" href="<?php echo base_url('admin/create-question'); ?>" class="btn btn-primary save-part">Add New</a>
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
<th scope="col">Question Label/Title</th>
<th scope="col">Question Type</th>
<th scope="col">Sector</th>
<th scope="col">Framework</th>
<th scope="col" class="text-center">Is Child</th>
<th scope="col" class="text-center">Created Date</th>
<th scope="col" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$i=1;
$k=1;
if(isset($allquestions) && !empty($allquestions)) {
foreach ($allquestions as $allquestions_details) {
$sectorName=getSectorName($allquestions_details["Sector_ID"]);
$frameworkName=getFrameworkName($allquestions_details["framework_id"]);
$uom=getQuestionUnitOfMeasurement($allquestions_details["UOM_ID"]);
$copyUrl=base_url("admin/edit-question/").$allquestions_details["QB_ID"];
$updateUrl=base_url("admin/update-question-detail/").$allquestions_details["QB_ID"];
$allowUOMcopy=['30','39','41','42','43','44'];
//print_data($allquestions);
?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo isset($allquestions_details["Description"])?$allquestions_details["Description"]:""; ?></td>
    <td><?php echo isset($uom["UOM"])?$uom["UOM"]:""; ?></td>
    <td><?php echo $sectorName; ?></td>
    <td><?php echo $frameworkName; ?></td>
    <td class="text-center"><?php echo isset($allquestions_details["is_child_question"])?ucfirst($allquestions_details["is_child_question"]):""; ?></td>
    <td class="text-center"><?php echo isset($allquestions_details["created_at"])?date('d-m-Y H:i:s',strtotime($allquestions_details["created_at"])):""; ?></td>
    <td class="text-center">
    <?php if(!in_array($allquestions_details['UOM_ID'],$allowUOMcopy)){ ?>
    <a href="<?php echo $copyUrl; ?>"><span class=""><i title="Clone question" class="bi bi-c-square"></i></span></a>
    <?php } ?>
    &nbsp;<a href="<?php echo $updateUrl; ?>"><span class=""><i title="Update question detail" class="bi bi-pencil-square"></i></span></a>
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
  $(document).on('click','.back-to-top',function(){
    $("html, body").animate({ scrollTop: 0 });
  })
</script>
</body>
</html>