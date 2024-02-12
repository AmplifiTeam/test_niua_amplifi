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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  #toolbarContainer{
    display: none !important;
  }
  /*.fa-eye-slash, .fa-eye {
  position: absolute;
  top: 53%;
  right: 6%; 
  }
  .fa-eye-slash{
  position: absolute;
  top: 53%;
  right: 6%;
  }*/
  .sign1{
   position: absolute;
   top: 41%;
   right: 6%;  
  }
</style>
</head>
<body>
<header id="header" class="header2">
<div class="container-fluid">
<div class="logo-part">
<a href="javascript:void(0);" class="logo d-flex align-items-center">
<img src="<?php echo base_url('assets/niua/img/logo.png'); ?>" alt="">
<img src="<?php echo base_url('assets/niua/img/logo-2 ministoy-B.png'); ?>" alt="">
</a>     
</div><!-- End Logo -->
</div>
</header><!-- End Header -->
<main id="main" class="main">
<div class="container-fluid d-flex flex-row bd-highlight mb-3">
<div class="card card11 mb-4 col-md-6 col-lg-4">
<div class="sign-1"> SIGN IN </div>
<div class="card-body">
<form method="POST" name="loginForm" id="loginForm">
<div class="form-group input1">               
<input type="email" class="form-control" id="userName" name="userName" placeholder="Enter user name" />
<span class="err" id="errorUserName" style="color: red;"></span>
</div>
<div class="form-group input1">
<span class="sign1"><i style="cursor: pointer;font-size: 16px;" class="fa fa-eye" id="togglePassword" onclick="myFunction()"  title="Show/Hide password"></i></span>
<input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter Password" />
<span class="err" id="errorUserPassword" style="color: red;"></span>

</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group input1">
  <input maxlength="10" autocomplete="off" name="captcha_code" id="captcha_code" type="text" class="form-control" placeholder="Enter captcha code">
  <span class="error_msg err_captcha err" style="color: red;"></span>
</div>
</div>
<div class="col-md-6" style="line-height: 75px; height: 70px;">
    <span id="DrawCaptcha" style="background-image: url('<?php echo base_url('assets/niua/img/captcha-bg.png'); ?>'); font-weight: bold; height: 44px; line-height: 47px; font-style: italic; display: inline-grid; width: 80%; border-radius: 4px; text-align: center; font-size: 22px; color: #fff;"></span>&nbsp;&nbsp;<i title="Refresh Captcha" id="BulkEnqueryref" style="cursor: pointer;" class="fa fa-refresh"></i>
    <input type="hidden" name="DrawCaptcha_val" id="DrawCaptcha_val" value="">

</div>
</div>


<div class="form-group input1 remembermechkSection">
<input type="checkbox" class="form-check-input remembermechk"> 
<label class="form-check-label"> Remember me </label>         
</div>
<div class="form-group input1">
<a href="javascript:void(0);" class="but-sign btn btn-primary" id="signin">SIGN IN</a>
</div>
</div>
</form>
</div>
</div>
<div class="col-md-6 col-lg-7 bg-darkNew text-center text-white overflow-hidden">
<div class="shadow-sm mx-auto"></div>
</div>
</main>
<p class="text-center" style="font-size: 11px;">Last Updated: <?php echo date('d/m/Y') ?></p>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/md5-js-tools@1.0.2/lib/md5.min.js"></script>
</body>
<script type="text/javascript">
$(document).keypress(function(e){
  if(e.which==13) /* 13 is the keycode for enter button */
  {
    $("#signin").click();
  }
  });

$(document).on('click', '#signin', function(e){
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


    $(".err").html('');
    var user_name=$("#userName").val().trim();
    var user_password=$("#userPassword").val().trim();
    var get_captcha=$("#DrawCaptcha_val").val().trim();
    var entered_captcha=$("#captcha_code").val().trim();
    //alert(user_name+"======"+user_password);
    if(user_name==""){
      $("#userName").focus();
      Toast.fire({
        icon: 'error',
        title: 'Please enter user name'
      });
      return false;
    }
    if(user_password==""){
      $("#userPassword").focus();
      Toast.fire({
        icon: 'error',
        title: 'Please enter password'
      });
      return false;
    }
    if(entered_captcha==""){
      $("#captcha_code").focus();
      Toast.fire({
        icon: 'error',
        title: 'Please enter captcha'
      });
      return false;
    }

    if(entered_captcha!=get_captcha){
      $("#captcha_code").focus();
      Toast.fire({
        icon: 'error',
        title: 'Invalid captcha!'
      });
      return false;

    }
    var userPassword=MD5.generate(user_password);            
    //alert(userPassword); return false;
    // Ajax Call
    var action_uri='<?php echo base_url('admin/validate-login'); ?>';
    var formData=new FormData($('#loginForm')[0]);
    $.ajax({
      type:'POST',
      url: action_uri,
      //data:formData,
      data: {'userName':user_name, 'userPassword':userPassword},
      dataType: 'json',
      beforeSend: function(){
          $('#signin').html('Processing ...');
          $('#signin').prop('disabled',true);
          $('#signin').css('cursor', 'wait');
      },
      complete: function(){
          $('#signin').html('SIGN IN');
          $('#signin').prop('disabled',false);
          $('#signin').css('cursor', '');
      },
      success: function(response){
          if(response.status==1){
            window.location.href='<?php echo site_url("admin/dashboard"); ?>';
          }else{
            //$('#errorUserPassword').html('Invalid login Credentials!');
            Toast.fire({
            icon: 'error',
            title: 'Invalid login credential!'
            });
            return false; 
          }
      }
    });
});
</script>

<script>
 function myFunction() {
   var x = document.getElementById("userPassword");
   if (x.type === "password") {
     x.type = "text";
     $('#togglePassword').removeClass('fa fa-eye');
     $('#togglePassword').addClass('fa fa-eye-slash');
   } else {
     x.type = "password";
     $('#togglePassword').removeClass('fa fa-eye-slash');
     $('#togglePassword').addClass('fa fa-eye');
   }
 }

 $(document).ready(function(){
     DrawCaptchaBulkEnquery();
  $("#BulkEnqueryref").click(function(){
     DrawCaptchaBulkEnquery();
  });
});

function DrawCaptchaBulkEnquery(){
    var alpha=new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    var a = Math.ceil(Math.random() * 9)+ '';
    var b = alpha[Math.floor(Math.random() * alpha.length)];
    var c = Math.ceil(Math.random() * 9)+ '';  
    var d = alpha[Math.floor(Math.random() * alpha.length)]; 
    var e = Math.ceil(Math.random() * 9)+ '';  
    var f = alpha[Math.floor(Math.random() * alpha.length)];         
    var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f;
    var gatcode=a+b+c+d+e+f;
    //alert(code);
    $("#DrawCaptcha").text(code);
    $("#DrawCaptcha_val").attr("value",gatcode);
}
</script>
</html>