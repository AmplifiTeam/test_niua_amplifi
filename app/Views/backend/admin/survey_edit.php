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
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
  #toolbarContainer{
    display: none !important;
  }
</style>
</head>
<body>
<!-- ======= Header ======= -->
<?php echo view('backend/partials/top_header.php'); ?>
<main id="main" class="main">
<div class="pagetitle">
<p>
<a href="<?=base_url('/admin/view-survey')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1 class="">Update Survey</h1>
</div>
<section class="section dashboard">
<form class="form-horizontal" name="editSurveyform"  id="editSurveyform" enctype="multipart/form-data">
<div class="midl1">
<div class="tabl-titl1">
<div class="pup1">
<a href="<?php echo base_url('admin/view-survey'); ?>" class="btn btn-primary d-none">All Survey</a>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Survey Name<label class="star-red">*</label></span> 
<input type="hidden" name="sid" id="sid" value="<?php echo isset($survey["Survey_ID"])?$survey["Survey_ID"]:""; ?>">        
</div>  
<div class="col-lg-8">
<input value="<?php echo isset($survey["Survey_Name"])?$survey["Survey_Name"]:""; ?>" type="text" name="survey_name" id="survey_name" class="form-control" placeholder="Enter survey name">
<span class="error_msg err_survey_name err" style="color: red;"></span>       
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Description <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<textarea readonly name="description" id="description" class="form-control" rows="4" cols="25" placeholder="Enter description"><?php echo isset($survey["Description"])?$survey["Description"]:""; ?></textarea>
<span class="error_msg err_description err" style="color: red;"></span>        
</div>
</div>
</div>

<?php
$startDt=date_create($survey["From_Date"]);
$endDt=date_create($survey["To_Date"]);
?>

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Survey Start Date<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-8">
<input value="<?php echo date_format($startDt,'d-m-Y'); ?>" readonly type="text" name="survey_start_date" id="survey_start_date_edit" class="form-control" placeholder="Select start date">
<span class="error_msg err_survey_start_date err" style="color: red;"></span>       
</div>
</div>
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Survey End Date<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-8">
<input value="<?php echo date_format($endDt,'d-m-Y'); ?>" readonly type="text" name="survey_end_date" id="survey_end_date" class="form-control" placeholder="Select end date">
<input type="hidden" name="old_end_dt" id="old_end_dt" value="<?php echo $survey["To_Date"]; ?>">
<span class="error_msg err_survey_end_date err" style="color: red;"></span>       
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Active/Inactive<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-8">
<select class="form-select" name="survey_active_inactive" id="survey_active_inactive">
  <option <?php if($survey["active_inactive_status"]==1){ echo "selected"; } ?> value="1">Active</option>
  <option <?php if($survey["active_inactive_status"]==0){ echo "selected"; } ?> value="0">Inactive</option>
</select>      
</div>
</div>
</div>




<div class="col-lg-12 text-center my-4">
<button type="button" id="updateSurvey" class="btn btn-primary bg-col1">Update</button>
</div>
</form>
</section>
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>

<script>
	$(function(){
    $("#survey_start_date").datepicker({
      dateFormat:'dd-mm-yy'
    });
    $("#survey_end_date").datepicker({
      dateFormat:'dd-mm-yy'
    });
  });
</script>

<script type="text/javascript">
$(document).on('click', '#updateSurvey', function(e){  
$(".err").html('');
var s_name=$("#survey_name").val().trim();
var s_desc=$("#description").val().trim();
//var start_dt=$("#survey_start_date").val().trim();
var end_dt=$("#survey_end_date").val().trim();
var old_end_dt=$("#old_end_dt").val().trim();
/*if(s_name==""){
  $('#survey_name').focus();
  $('.err_survey_name').html('Please enter survey name!');
  return false;
}

if(s_desc==""){
  $('#description').focus();
  $('.err_description').html('Please enter survey description!');
  return false;
}

if(start_dt==""){
  $('#survey_start_date').focus();
  $('.err_survey_start_date').html('Please select start date!');
  return false;
}*/

if(end_dt==""){
  $('#survey_end_date').focus();
  $('.err_survey_end_date').html('Please select end date!');
  return false;
}
// if(end_dt<old_end_dt){
//   $('#survey_end_date').focus();
//   $('.err_survey_end_date').html('Please select another date!');
//   return false;  
// }

//alert("Fine here..."); return false;
var action_uri='<?php echo base_url('admin/update-survey'); ?>';
var formData=new FormData($('#editSurveyform')[0]);
$.ajax({
  type:'POST',
  url: action_uri,
  data:formData,
  dataType: 'json',
  mimeType: "multipart/form-data",
  contentType: false,
  cache: false,
  processData: false,
  beforeSend: function(){
      $('#updateSurvey').html('Processing ...');
      $('#updateSurvey').prop('disabled',true);
      $('#updateSurvey').css('cursor', 'wait');
  },
  complete: function(){
      $('#updateSurvey').html('Update');
      $('#updateSurvey').prop('disabled',false);
      $('#updateSurvey').css('cursor', '');
  },
  success: function(response){
      if(response.status==1){
            Swal.fire({
            icon: "success",
            title: 'Success',
            text: response.msg,
            type: 'success',
            showCancelButton: false,
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutRight'
            },
            }).then((confirmed) => {
               window.location.href="<?php echo base_url('admin/view-survey'); ?>";
            });
      }else{
            $("#" + response.validation.fieldName).focus();
            $("." + response.validation.errorMsgFieldName).html(response.validation.errorMsg);
            return false;
      }
  }
});



});
</script>
</html>