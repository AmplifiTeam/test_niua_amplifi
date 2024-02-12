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
<a href="<?=base_url('/admin/view-question')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1 class="">Update Question</h1>
</div>
<section class="section dashboard">
<form class="form-horizontal" name="updateQuestionform"  id="updateQuestionform" enctype="multipart/form-data">
<div class="midl1">
<div class="tabl-titl1">
<div class="pup1">
<a href="<?php echo base_url('admin/view-question'); ?>" class="btn btn-primary d-none">All Questions</a>
</div>
</div>
<div class="for1" style="pointer-events: none;">
<div class="row">        
<div class="col-lg-4">
<span>Question Sector <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" name="qestion_sector" id="qestion_sector">
<option value="">Select Sector</option>
<?php
if(isset($allsector) && !empty($allsector)){
foreach ($allsector as $allsectorDetails){              
?>
<option <?php if($question["Sector_ID"]==$allsectorDetails['Sector_ID']){ echo "selected"; } ?> value="<?php echo trim($allsectorDetails['Sector_ID']); ?>"><?php echo ucwords($allsectorDetails['Sector']); ?></option>
<?php } } ?>
</select>
<span class="error_msg err_qestion_sector err" style="color: red;"></span>   
</div>
</div>
</div>


<div class="for1" style="pointer-events: none;">
<div class="row">        
<div class="col-lg-4">
<span>Question Framework <label class="star-red">*</label></span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" name="qestion_framework" id="qestion_framework">
<option value="">Select Framework</option>
<?php
if(isset($allframework) && !empty($allframework)){
foreach ($allframework as $allframeworkDetails){              
?>
<option <?php if($question["framework_id"]==$allframeworkDetails['Framework_ID']){ echo "selected"; } ?> value="<?php echo trim($allframeworkDetails['Framework_ID']); ?>"><?php echo ucwords($allframeworkDetails['Description']); ?></option>
<?php } } ?>
<option value="Others">Others</option>
</select>
<span class="error_msg err_qestion_framework err" style="color: red;"></span>   
</div>
</div>
</div>

<div class="for1" style="pointer-events: none;">
<div class="row">           
<div class="col-lg-4">
<span>Is this a Child Question?<label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" id="questionTypeSelection" name="questionTypeSelection">
  <option <?php if($question["is_child_question"]=="no"){ echo "selected"; }else{echo "disabled"; } ?> value="no">No</option>
  <option <?php if($question["is_child_question"]=="yes"){ echo "selected"; }else{echo "disabled"; } ?> value="yes">Yes</option>
</select>
<span class="error_msg err_question_type err" style="color: red;"></span>        
</div>
</div>
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Year<label class="star-red d-none">*</label> </span>         
</div>  
<div class="col-lg-8">
<input value="<?php echo isset($question["Reference_Period"])?$question["Reference_Period"]:""; ?>" type='text' name="question_year" id="question_year" class="form-control" placeholder="Enter year">
<span class="error_msg err_question_year err" style="color: red;"></span>        
</div>
</div>
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Source<label class="star-red d-none">*</label> </span>         
</div>  
<div class="col-lg-8">
<input value="<?php echo isset($question["Data_Source"])?$question["Data_Source"]:""; ?>" type='text' name="question_source" id="question_source" class="form-control" placeholder="Enter source">
<span class="error_msg err_question_source err" style="color: red;"></span>        
</div>
</div>
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Supporting Document<label class="star-red d-none">*</label> </span>         
</div>  
<div class="col-lg-8">
<input value="<?php echo isset($question["Supporting_Document"])?$question["Supporting_Document"]:""; ?>" type='text' name="question_supporting_document" id="question_supporting_document" class="form-control" placeholder="Enter supporting document">
<input type="hidden" name="questionId" id="questionId" value="<?php echo isset($question["QB_ID"])?$question["QB_ID"]:""; ?>">
<span class="error_msg err_question_supporting_document err" style="color: red;"></span>        
</div>
</div>
</div>


<div class="for1" style="pointer-events:none;">
<div class="row">           
<div class="col-lg-4">
<span>Question Input type <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" name="inputTypeSelector" id="inputTypeSelector" aria-label="Default select example">
<?php
$uomDetail=getQuestionUnitOfMeasurement($question['UOM_ID']);         
?>
<option selected value="<?php echo trim($question['UOM_ID']); ?>"><?php echo ucwords($uomDetail['UOM']); ?></option>
</select>
<span class="error_msg err_inputTypeSelector err" style="color: red;"></span>      
</div>
</div>
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Question Title/Lable <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<textarea name="question_title" id="question_title" class="form-control" rows="4" cols="25" placeholder="Enter question lable"><?php echo isset($question["Description"])?$question["Description"]:""; ?></textarea>
<span class="error_msg err_question_title err" style="color: red;"></span>        
</div>
</div>
</div>
<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Question Description <label class="star-red">*</label></span>         
</div>  
<div class="col-lg-8">
<textarea name="question_note" id="question_note" class="form-control" rows="3" cols="25" placeholder="Note about question"><?php echo isset($question["DetailedDescription"])?$question["DetailedDescription"]:""; ?></textarea>
<span class="error_msg err_question_note err" style="color: red;"></span>     
</div>
</div>
</div>


<div class="for1" id="UOMDetailSection" style="display:<?php if($question["is_child_question"]=="yes"){ echo "block"; }else{ echo "none"; } ?>;">
<div class="row">           
<div class="col-lg-4">
<span>UOM Detail</span>         
</div>  
<div class="col-lg-8">
<textarea name="uom_other_detail" id="uom_other_detail" class="form-control" rows="2" cols="25" placeholder="Enter UOM detail"><?php echo isset($question["sub_question_uom_detail"])?$question["sub_question_uom_detail"]:""; ?></textarea>
<span class="error_msg err_uom_other_detail err" style="color: red;"></span>       
</div>
</div>
</div>

<div class="col-lg-12 text-center my-4">
<button type="button" id="updateQuestionDetail" class="btn btn-primary bg-col1">Update Question</button>
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
</body>
<script type="text/javascript">
  function showToast(type,text){
   // alert(text);
    const Toast=Swal.mixin({
      toast: true,
      position: 'top',
      //position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });
    Toast.fire({
      icon: type,
      title: text
    });
  }
</script>

<script type="text/javascript">
$(document).on('click', '#updateQuestionDetail', function(e){
  $(".err").html('');
  var qestion_sector=$("#qestion_sector").val();
  var framework=$("#qestion_framework").val();
  var question_title=$("#question_title").val();
  var question_note=$("#question_note").val();
  var inputTypeSelector=$("#inputTypeSelector").val();
  if(question_title==""){
    $('#question_title').focus();
    $('.err_question_title').html('Please enter a question!');
    return false;
  }

  if(question_note==""){
    $('#question_note').focus();
    $('.err_question_note').html('Please enter a description!');
    return false;
  }

  //alert("fine here...");
  var action_uri='<?php echo base_url('admin/updateQuestionDetail'); ?>';
  var formData=new FormData($('#updateQuestionform')[0]);
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
      $('#updateQuestionDetail').html('Processing ...');
      $('#updateQuestionDetail').prop('disabled',true);
      $('#updateQuestionDetail').css('cursor', 'wait');
  },
  complete: function(){
      $('#updateQuestionDetail').html('Update Question');
      $('#updateQuestionDetail').prop('disabled',false);
      $('#updateQuestionDetail').css('cursor', '');
  },
  success: function(response){
      //console.log(response);
      //location.reload();
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
               window.location.href="<?php echo base_url('admin/view-question'); ?>";
            });
      }else{
          showToast('error',response.msg);
          return false;            
      }
  }
});

});
</script>
</html>