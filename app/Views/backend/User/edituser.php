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
</style>
</head>
<body>
<!-- ======= Header ======= -->
<?php echo view('backend/partials/top_header.php'); ?>
<main id="main" class="main">
<div class="pagetitle">

<p>
<a href="<?=base_url('/admin/user-list')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1>Update User</h1>


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
<?php
if(isset($user) && !empty($user)){
foreach($user as $role){
  if($role['id']==1 || $role['id']==5){
    continue;
  }
$sid=$role['id'];
// print_r($sid);die;
if((int)$list['role']==$sid){
?>
<option value="<?php echo trim($sid);?>" <?php  if((int)$list['role']==$sid){echo 'selected';}else{ echo 'disabled';}?>><?php echo ucwords($role['name']); ?></option>
<?php }}} ?>
</select>
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


<input type='hidden' value='<?php echo isset($list['user_id']) ? $list['user_id'] : ""; ?>' name="id"  id="id" class="form-control">
<input type='hidden' value='<?php echo isset($list['City_ID']) ? $list['City_ID'] : ""; ?>' name="user_city_id"  id="user_city_id" class="form-control">


<input type='text' value='<?php echo isset($list['City']) ? $list['City'] : ""; ?>' name="city" readonly id="city" class="form-control"  placeholder="Enter user name">
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
<?php
if(isset($statedata) && !empty($statedata)){
foreach($statedata as $state){
$stateid=$state['id'];
?>
<option value="<?php echo ucwords($state['state']); ?>"  <?php if(trim($state['state'])==trim($list['State'])){echo 'selected'; }else{ echo '';} ?>><?php echo ucwords($state['state']); ?></option>
<?php }} ?>
</select>
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
<input type='text' value='<?php echo isset($list['Lat']) ? $list['Lat'] : ""; ?>' name="lat" id="lat" class="form-control"  placeholder="Enter Latitude">
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
<input type='text' value='<?php echo isset($list['Long']) ? $list['Long'] : ""; ?>' name="long" id="long" class="form-control"  placeholder="Enter Longitude">
<span class="error_msg err_long err" style="color: red;"></span>     
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>Zone<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-10">
<input type='text' value='<?php echo isset($list['Zone']) ? $list['Zone'] : ""; ?>' name="zone" id="zone" class="form-control"  placeholder="Enter zone">
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
<input type='text'  value='' name="password" id="password" class="form-control"  placeholder="Enter password">
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

<div class="for1">
<div class="row">           
<div class="col-lg-2">
<span>User Status<label class="star-red">*</label></span>         
</div>  
<div class="col-lg-10">
<select class="form-select" aria-label="Default select example" name="status" id="status">
<option value="1" <?php if($list['status'] ==1){echo "selected";} ?>>Active</option>
<option value="0" <?php if($list['status'] ==0){echo "selected";} ?>>Inactive</option>
</select>
<span class="error_msg err_status err" style="color: red;"></span>     
</div>
</div>
</div>

<div class="col-lg-12 text-center my-4">
<button type="button" id="saveQuestion" class="btn btn-primary bg-col1">Update User</button>
</div>


</form>
</section>
</main>
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
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vanilla_selectbox/js/vanillaSelectBox.js'); ?>"></script>
</body>
<script>
$('.numberOnly').keypress(function(e) {
  if(isNaN(this.value+""+String.fromCharCode(e.charCode || event.which))) return false;
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



$(document).ready(function(){
  var value = $.trim($('#role').val())
    // alert(value);
    //alert(role);
     if(value=='2' || value=='3'){
       $('.cityofficial_show').hide();
       $('.sectorData').show();
     }else if(value==='4'){
      $('.cityofficial_show').show();
      $('.sectorData').hide();
     }
})
  $(document).on('change', '.roleChange', function(e){
    // var role = document.getElementsByName('role');
    // var e = document.getElementById("role");
    var value = $.trim($('#role').val())
   // alert(value);
    //alert(role);
     if(value=='2' || value=='3'){
       $('.cityofficial_show').hide();
       $('.sectorData').show();
     }else if(value==='4'){
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
////var state_code=$("#state_code").val();
var zone=$("#zone").val();
var password=$("#password").val();
var Cpassword=$("#Cpassword").val();
var userSector1=$("#userSector").val();
var userSectordata = document.getElementById('userSector');
var userSector = userSectordata.value;
// alert(userSector);
//var validpassword  =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}+$/i;
var validPassword = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
var validname = /^[a-z ,.'-]+$/i;
var latRegex  = /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,15}/g;
var lngRegex = /^-?(([-+]?)([\d]{1,3})((\.)(\d+))?)/g;
var alphanumeric=/^[0-9]*$/;


if(rolevalue==''){
  $('.err_role').show();
  $('.err_role').text('Please select role').css("color", "red");
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
// alert('cvb')
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
//alert('fgh')

 if (password!='' && !validPassword.test(password)) {
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

if(password!='' && Cpassword==''){
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


//alert('bghj');
// Ajax Call
var action_uri='<?php echo base_url('admin/edit-user'); ?>';
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
$(document).ready(function(){
  let sector=new vanillaSelectBox("#userSector",{"maxOptionWidth":300, "maxHeight": 200,"search": false,translations: { "all": "Select sector", "items": "Sectors", "item": "Sector" }, "placeHolder": "Select sector" });
  var role='<?php echo $userRole; ?>';
  if(role==2 || role==3){
      var selectedSector='<?php echo $userSectors; ?>';
      console.log(selectedSector);
      sector.setValue(`${selectedSector}`);
  }


});
</script>

</html>