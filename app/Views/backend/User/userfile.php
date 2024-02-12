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
<h1>Add User</h1>

<a style="margin-left:5px;" href="<?php echo base_url('admin/user-list'); ?>" class="btn btn-primary save-part">User List</a>
</div>
<section class="section dashboard">
<form class="form-horizontal" name="addQuestionform"  id="addQuestionform" enctype="multipart/form-data">
<div class="midl1">
<div class="tabl-titl1 text-center text-dark">
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>User Type<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-10">
<select class="form-select roleChange" aria-label="Default select example" name="role" id="role">
<option value="">Select user type</option>
<?php
if(isset($user_type) && !empty($user_type)){
foreach($user_type as $role){
  if($role['id']==1 || $role['id']==5){
    continue;
  }
$sid=$role['id'];
?>
<option value="<?php echo trim($sid); ?>"><?php echo ucwords($role['name']); ?></option>
<?php }}?>
</select>
<!-- <input type='text' value='' name="role" id="role" class="form-control"  placeholder="Enter role"> -->
<span class="error_msg err_role err" style="color: red;"></span>     
</div>
</div>
</div>



<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>User Name<label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-10">
<input type='text' value='' name="city" id="city" class="form-control"  placeholder="Enter user name">
<span class="error_msg err_city err" style="color: red;"></span>        
</div>
</div>
</div>

<div class="sectorData" style="display: none;">
<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>Sector<label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-10">
<select class="form-select" id="userSector" name="userSector[]" multiple>
<?php
if(isset($allsector) && !empty($allsector)){
foreach($allsector as $allsectorDetails){
$sid=$allsectorDetails['Sector_ID'];
?>
<option value="<?php echo trim($sid); ?>"><?php echo ucwords($allsectorDetails['Sector']); ?></option>
<?php }} ?>
</select>
<span class="error_msg err_sector err" style="color: red;"></span>        
</div>
</div>
</div>
</div>

<div class="cityofficial_show" style="display: none;">
<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>State<label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-10">
<select class="form-select" id="state" name="state" >
  <option value="">Select state</option>
<?php
if(isset($statedata) && !empty($statedata)){
foreach($statedata as $state){
$stateid=$state['id'];
?>
<option value="<?php echo ucwords($state['state']); ?>"><?php echo ucwords($state['state']); ?></option>
<?php }} ?>
</select>
<!-- <input type='text' value='' name="state" id="state" class="form-control"  placeholder="Enter state name"> -->
<span class="error_msg err_state err" style="color: red;"></span>        
</div>
</div>
</div>



<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>Latitude<label class="star-red"></label></span>         
</div>  
<div class="col-lg-10">
<input oncopy="return false" onpaste="return false" type='text' value='' name="lat" id="lat" class="form-control numberOnly"  placeholder="Enter latitude" maxlength="12">
<span class="error_msg err_lat err" style="color: red;"></span>     
</div>
</div>
</div>

<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>Longitude<label class="star-red"></label></span>         
</div>  
<div class="col-lg-10">
<input oncopy="return false" onpaste="return false" type='text' value='' name="long" id="long" class="form-control numberOnly"  placeholder="Enter longitude" maxlength="12">
<span class="error_msg err_long err" style="color: red;"></span>     
</div>
</div>
</div>



<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>Zone<label class="star-red">*</label></span>         
</div>  

<!-- $zoneData -->
<div class="col-lg-10">


  <select class="form-select" id="zone" name="zone" >
  <option value="">Select Zone</option>
<?php
if(isset($zoneData) && !empty($zoneData)){
foreach($zoneData as $key=>$zone){
?>
<option value="<?php echo ucwords($zone['Zone']); ?>"><?php echo ucwords($zone['Zone']); ?></option>
<?php }} ?>
</select>





<!-- <input type='text' value='' name="zone" id="zone" class="form-control"  placeholder="Enter zone"> -->
<span class="error_msg err_zone err" style="color: red;"></span>     
</div>
</div>
</div>

</div>

<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>User Password<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-10">
<input type='text' value='' name="password" id="password" class="form-control"  placeholder="Enter password">
<span class="error_msg err_password err" style="color: red;"></span>     
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>Confirm Password<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-10">
<input type='text' value='' name="Cpassword" id="Cpassword" class="form-control"  placeholder="Enter confirm password">
<span class="error_msg err_Cpassword err" style="color: red;"></span>     
</div>
</div>
</div>

<div class="col-lg-12 text-center my-4">
<button type="button" id="saveQuestion" class="btn btn-primary bg-col1">Add User</button>
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
<script>
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


$('.numberOnly').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode || event.which))){
   showToast('info',"Please enter a valid value");
   return false; 
  } 
});

$('.alphaOnly').keypress(function(e) {
var regex = new RegExp("^[a-zA-Z 0-9_-]+$");
var str=String.fromCharCode(!e.charCode ? e.which : e.charCode);
if(regex.test(str)){
return true;
}
return false;
});
</script>
<script>
  $(document).on('change', '.roleChange', function(e){
    // var role = document.getElementsByName('role');
    var e = document.getElementById("role");
    var value = e.value;
   // alert(value);
    var roledata = e.options[e.selectedIndex].text;
    //alert(role);
     if(roledata==='Validator 1' || roledata==='Validator 2'){
       $('.cityofficial_show').hide();
       $('.sectorData').show();
     }else if(roledata==='City Official'){
      $('.cityofficial_show').show();
      $('.sectorData').hide();
     }
  });
</script>

  <script type="text/javascript">
  var _URL = window.URL || window.webkitURL;
$(document).on('click', '#saveQuestion', function(e){
var role = document.getElementById('role');
var rolevalue = role.value;
var roledatavalue = role.options[role.selectedIndex].text;
  //alert(roledatavalue);
var city=$("#city").val();
var state=$("#state").val();
var lat=$("#lat").val();
var long=$("#long").val();
var city_type=$("#city_type").val();
var state_code=$("#state_code").val();
var zone=$("#zone").val();
var password=$("#password").val();
var Cpassword=$("#Cpassword").val();
var userSector=$("#userSector").val();
var userSectordata = document.getElementById('userSector');
var userSector = userSectordata.value;
// alert(userSector);
//var validpassword  =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}+$/i;
var validPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
var validname = /^[a-z ,.'-]+$/i;
var latRegex  = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,15}/g;
var lngRegex = /^-?(([-+]?)([\d]{1,3})((\.)(\d+))?)/g;
var alphanumeric=/^[0-9]*$/;

// var num=/^[0-9]*$/;

if(rolevalue==''){
  $('.err_role').show();
  $('.err_role').text('Please select user type').css("color", "red");
  $('#role').focus();
  return false;
}else{
  $('.err_role').show();
  $('.err_role').text('');
}


if(city==''){
  $('.err_city').show();
  $('.err_city').text('Please enter name').css("color", "red");
  $('#city').focus();
  return false;
}else{
  $('.err_city').show();
  $('.err_city').text('');
}

if(roledatavalue==='City Official'){
if(state==''){
  $('.err_state').show();
  $('.err_state').text('Please enter state name').css("color", "red");
  $('#state').focus();
  return false;
}else{
  $('.err_state').show();
  $('.err_state').text('');
}

/*if(lat==''){
  $('.err_lat').show();
  $('.err_lat').text('Please enter latitude ').css("color", "red");
  $('#lat').focus();
  return false;
} else if (!latRegex.test(lat)) {
  $('.err_lat').show();
  $('.err_lat').text('Please enter valid latitude ').css("color", "red");
  $('#lat').focus();
  return false;
}else{
  $('.err_lat').show();
  $('.err_lat').text('');
}

if(long==''){
  $('.err_long').show();
  $('.err_long').text('Please enter longitude').css("color", "red");
  $('#long').focus();
  return false;
} else if (!lngRegex.test(long)) {
  $('.err_long').show();
  $('.err_long').text('Please enter valid longitude').css("color", "red");
  $('#long').focus();
  return false;
}else{
  $('.err_long').show();
  $('.err_long').text('');
}*/

if(city_type==''){
  $('.err_city_type').show();
  $('.err_city_type').text('Please enter city type').css("color", "red");
  $('#city_type').focus();
  return false;
} else if (!validname.test(city_type)) {
  $('.err_city_type').show();
  $('.err_city_type').text('Please enter valid city type').css("color", "red");
  $('#state').focus();
  return false;
}else{
  $('.err_city_type').show();
  $('.err_city_type').text('');
}

if(state_code==''){
  $('.err_state_code').show();
  $('.err_state_code').text('Please enter state code').css("color", "red");
  $('#state_code').focus();
  return false;
}else{
  $('.err_state_code').show();
  $('.err_state_code').text('');
}

if(zone==''){
  $('.err_zone').show();
  $('.err_zone').text('Please enter zone').css("color", "red");
  $('#zone').focus();
  return false;
}else{
  $('.err_zone').show();
  $('.err_zone').text('');
}
}

if(roledatavalue==='Validator 1' || roledatavalue==='Validator 2'){
  if(userSector==''){
  $('.err_sector').show();
  $('.err_sector').text('Please select sector').css("color", "red");
  $('#role').focus();
  return false;
}else{
  $('.err_sector').show();
  $('.err_sector').text('');
}
}

if(password==''){
  $('.err_password').show();
  $('.err_password').text('Please enter password').css("color", "red");
  $('#password').focus();
  return false;
} else if (!validPassword.test(password)) {
  $('.err_password').show();
  $('.err_password').text('Please enter minimum eight characters, at least one letter, one number and one special character').css("color", "red");
  $('#password').focus();
  return false;
}else if(password.length>15){
  $('.err_password').show();
  $('.err_password').text('Maximum length 15 digit').css("color", "red");
  $('#password').focus();
  return false;
}else{
  $('.err_password').show();
  $('.err_password').text('');
}

if(Cpassword==''){
  $('.err_Cpassword').show();
  $('.err_Cpassword').text('Please enter confirm password').css("color", "red");
  $('#Cpassword').focus();
  return false;
}else if(Cpassword!=password){
  $('.err_Cpassword').show();
  $('.err_Cpassword').text('Password and confirm password does not match').css("color", "red");
  $('#Cpassword').focus();
  return false;
}else{
  $('.err_Cpassword').show();
  $('.err_Cpassword').text('');
}


// Ajax Call
var action_uri='<?php echo base_url('admin/add-user'); ?>';
var formData=new FormData($('#addQuestionform')[0]);
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
      $('#saveQuestion').html('Processing ...');
      $('#saveQuestion').prop('disabled',true);
      $('#saveQuestion').css('cursor', 'wait');
  },
  complete: function(){
      $('#saveQuestion').html('Submit');
      $('#saveQuestion').prop('disabled',false);
      $('#saveQuestion').css('cursor', '');
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
              window.location.href="<?php echo base_url('admin/user-list'); ?>";
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


<script>
$(document).ready(function () {
  let sector=new vanillaSelectBox("#userSector",{"maxOptionWidth":300, "maxHeight": 200,"search": false,translations: { "all": "All selected", "items": "Sectors", "item": "Sector" }, "placeHolder": "Select sector" });
});
</script>

</html>