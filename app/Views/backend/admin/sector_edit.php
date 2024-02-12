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
<h1 class="">Update Sector</h1>
</div>
<section class="section dashboard">
<form class="form-horizontal" name="editSectorform"  id="editSectorform" enctype="multipart/form-data">
<div class="midl1">
<div class="tabl-titl1">
<div class="pup1">
<a href="<?php echo base_url('admin/view-sector'); ?>" class="btn btn-primary d-none">All Sector</a>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Sector Name<label class="star-red">*</label></span> 
<input type="hidden" name="sid" id="sid" value='<?php echo isset($sectorDetail["Sector_ID"])?$sectorDetail["Sector_ID"]:""; ?>'>        
</div>  
<div class="col-lg-8" style="pointer-events: none;">
<input readonly value='<?php echo isset($sectorDetail["Sector"])?$sectorDetail["Sector"]:""; ?>' type="text" name="sector_name" id="sector_name" class="form-control" placeholder="Enter sector name">
<span class="error_msg err_sector_name err" style="color: red;"></span>       
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Description <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<textarea name="Sector_Description" id="Sector_Description" class="form-control" rows="4" cols="25" placeholder="Enter description"><?php echo isset($sectorDetail["Description"])?$sectorDetail["Description"]:""; ?></textarea>
<span class="error_msg err_Sector_Description err" style="color: red;"></span>        
</div>
</div>
</div>


<?php
$icon=base_url('assets/niua/img/').$sectorDetail["sectorIcon"];
$bg=base_url('assets/niua/img/').$sectorDetail["sectorBackground"];
?>
<div class="for1">
  <div class="row">           
    <div class="col-lg-4">
    <label for="Sector_Icon" class="col-form-label lable_left">Sector Icon<label class="star-red">*</label>:</label>
    </div>
    <div class="col-lg-8">
    <input type="file" class="form-control" id="Sector_Icon" name="Sector_Icon" accept="image/*">
    <div style="display: block; text-align: left; font-size: 11px;">
    <span><b>Note : </b>.svg format allowed.</span>
    <span><a target="_blank" href="<?php echo $icon; ?>" title="Current Icon"><i class="bi bi-eye"></i></a></span>
    </div>
    </div>
</div>

  <div class="">
  <div class="row">           
  <div class="col-lg-4">
  <label for="Sector_Images" class="col-form-label lable_left">Sector Image<label class="star-red">*</label>:</label>
  </div>
  <div class="col-lg-8">
  <input type="file" class="form-control" id="Sector_Images" name="Sector_Images" accept="image/*">
  <div style="display: block; text-align: left; font-size: 11px;">
  <span><b>Note : </b>.png, .jpg, and .jpeg format allowed.</span></div>
  <span><a target="_blank" href="<?php echo $bg; ?>" title="Current Image"><i class="bi bi-eye"></i></a></span>
  </div>
  </div>
  </div>

<div class="col-lg-12 text-center my-4">
<button type="button" id="updateSector" class="btn btn-primary bg-col1">Update</button>
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
  function updatetoast(type,text){
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


<script>  
  $(document).on('click','#updateSector',function(){
  var sector_Name = $.trim($('#sector_name').val());
  var sector_Description = $.trim($('#Sector_Description').val());
  var sector_Icon = $.trim($('#Sector_Icon').val());
  var extcat_Sector_Icon = sector_Icon.split('.').pop();
  var sector_Images = $.trim($('#Sector_Images').val());
  var extcat_sector_Images = sector_Images.split('.').pop();

  if(sector_Description==''){
    updatetoast('error','Please enter sector description');
    $('#Sector_Description').focus();
    return false; 
  }else{
    if(sector_Description.length > 500){
      updatetoast('error','Description should be less than 500 characters');
      $('#Sector_Description').focus();
      return false;
    }
  }


  if(sector_Icon!=''){
    if($.inArray(extcat_Sector_Icon,['svg']) == -1){
      updatetoast('error','Please attach .svg image format only');
      $('#Sector_Icon').val('');
      return false; 
    }
  }
  if(sector_Images!=''){
    if($.inArray(extcat_sector_Images,['png','PNG','jpg','JPG','jpeg','JPEG']) == -1){
      updatetoast('error','Please attach .png, .jpg, .jpeg  image format only'); 
      $('#Sector_Images').val('');    
      return false; 
    }
  }

  //alert("Fine here....");
  var action_uri="<?php echo base_url('admin/update-sector-detail'); ?>";
  var formData=new FormData($('#editSectorform')[0]);
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
      $('#updateSector').html('Processing ...');
      $('#updateSector').prop('disabled',true);
      $('#updateSector').css('cursor', 'wait');
  },
  complete: function(){
      $('#updateSector').html('Update');
      $('#updateSector').prop('disabled',false);
      $('#updateSector').css('cursor', '');
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
               window.location.href="<?php echo base_url('admin/view-sector'); ?>";
            });
      }else{
             updatetoast('error',response.msg);
            return false;
      }
  }
});
  });
</script>
</html>