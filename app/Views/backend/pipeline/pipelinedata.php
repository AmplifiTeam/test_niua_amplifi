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
<link rel="stylesheet" href="<?php echo base_url('assets/vanilla_selectbox/css/vanillaSelectBox.css'); ?>">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<style>
  #toolbarContainer{
    display: none !important;
  }
  .vsb-main{width: 100%;}
  .vsb-main button{background: #0d6efd !important;}
</style>
</head>
<body>
<?php echo view('backend/partials/top_header.php'); ?>
<main id="main" class="main">
<div class="pagetitle">
<p>
<a href="<?=base_url('/admin/user-list')?>"><i class="bi bi-chevron-left"></i>Back</a>
</p>
<h1>Data pipeline</h1>

<!-- <a style="margin-left:5px;" href="<//?php echo base_url('admin/user-list'); ?>" class="btn btn-primary save-part"></a> -->
</div>
<section class="section dashboard">
<form class="form-horizontal" name="pipeline"  id="pipeline" method="POST" action="<?php echo base_url('admin/pipeline-filter'); ?>" enctype="multipart/form-data">
<div class="midl1">
<div class="tabl-titl1 text-center text-dark">
</div>

<div class="for1">
<div class="row">           
  
<div class="col-md-4">
<select class="form-select roleChange" aria-label="Default select example" name="survey" id="survey">
<option value="">Select survey</option>
<?php
if(isset($allSurvey) && !empty($allSurvey)){
foreach($allSurvey as $survey){
 
$sid=$survey['Survey_ID'];
?>
<option value="<?php echo trim($sid); ?>"><?php echo ucwords($survey['Survey_Name']); ?></option>
<?php }}?>
</select>
<span class="error_msg err_survey err" style="color: red;"></span>     
</div>





  
<div class="col-md-4">
<select class="form-select roleChange" aria-label="Default select example" name="sector" id="sector">
<option value="">Select survey</option>

<?php
if(isset($allsector) && !empty($allsector)){
foreach($allsector as $sector){
 
$sid=$sector['Sector_ID'];
?>
<option value="<?php echo trim($sid); ?>"><?php echo ucwords($sector['Sector']); ?></option>
<?php }}?>
</select>
<!-- <input type='text' value='' name="role" id="role" class="form-control"  placeholder="Enter role"> -->
<span class="error_msg err_role err" style="color: red;"></span>     
</div>

  
<div class="col-md-4">
<select class="form-select roleChange" aria-label="Default select example" name="city" id="city">
<option value="">Select city</option>
<?php
if(isset($city) && !empty($city)){
foreach($city as $citydata){
 
$sid=$citydata['City_ID'];
?>
<option value="<?php echo trim($sid); ?>"><?php echo ucwords($citydata['City']); ?></option>
<?php }}?>
</select>
<!-- <input type='text' value='' name="role" id="role" class="form-control"  placeholder="Enter role"> -->
<span class="error_msg err_role err" style="color: red;"></span>     
</div>
</div>
</div>


<div class="col-lg-12 text-center my-4">
<button type="Submit" id="Downloaddata" class="btn btn-primary bg-col1">Download</button>
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
<script type="text/javascript" src="<?php echo base_url('assets/vanilla_selectbox/js/vanillaSelectBox.js'); ?>"></script>
</body>

<script type="text/javascript">
var _URL = window.URL || window.webkitURL;
$(document).on('click', '#Downloaddata', function(e){
 $(".error_msg").html('');
 var survey=$("#survey").val().trim();
 if(survey==""){
   $("#survey").focus();
   $(".err_survey").text('Please select a survey');
   return false;
 }
});
</script>
</html>