<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/frontend/images/favicon.png">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/plugins/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/style.css">

<style>
.container {
  position: relative;
  width: 100%;
  background-color: #fff;
  min-height: 100vh;
  overflow: hidden;
}

.forms-container {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.signin-signup {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  left: 75%;
  width: 50%;
  transition: 1s 0.7s ease-in-out;
  display: grid;
  grid-template-columns: 1fr;
  z-index: 5;
}

form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0rem 5rem;
  transition: all 0.2s 0.7s;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}

form.sign-up-form {
  opacity: 0;
  z-index: 1;
}

form.sign-in-form {
  z-index: 2;
}

.title {
  font-size: 2.2rem;
  color: #444;
  margin-bottom: 10px;
}

.input-field {
  max-width: 380px;
  width: 100%;
  background-color: #f0f0f0;
  margin: 10px 0;
  height: 55px;
  border-radius: 55px;
  display: grid;
  grid-template-columns: 15% 85%;
  padding: 0 0.4rem;
  position: relative;
}

.input-field i {
  text-align: center;
  line-height: 55px;
  color: #acacac;
  transition: 0.5s;
  font-size: 1.1rem;
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: #333;
}

.input-field input::placeholder {
  color: #aaa;
  font-weight: 500;
}

.input-field select {
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 500;
    font-size: 1.1rem;
    color: #999fa5;
}

.input-field select::placeholder {
  color: #aaa;
  font-weight: 500;
}



.social-text {
  padding: 0.7rem 0;
  font-size: 1rem;
/*  visibility:hidden;*/
}

.social-media {
  display: flex;
  justify-content: center;
  visibility:hidden;
}

.social-icon {
  height: 46px;
  width: 46px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 0.45rem;
  color: #333;
  border-radius: 50%;
  border: 1px solid #333;
  text-decoration: none;
  font-size: 1.1rem;
  transition: 0.3s;
}

.social-icon:hover {
  color: #F86F03;
  border-color: #F86F03;
}

.btn {
  width: 350px;
  background-color:#121212;
  border: none;
  outline: none;
  height: 49px;
  border-radius: 49px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.5s;
}

.btn:hover {
  background-color: #ae7c3d;
  transition:all 0.4s ease;
  color:#000;
}
.panels-container {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}

.container:before {
  content: "";
  position: absolute;
  height: 2000px;
  width: 2000px;
  top: -10%;
  right: 48%;
  transform: translateY(-50%);
  background-image:linear-gradient(-45deg, #b56e36 0%, #a47d43 100%);
  transition: 1.8s ease-in-out;
  border-radius: 50%;
  z-index: 6;
}

.image {
  width:84%;
  transition: transform 1.1s ease-in-out;
  transition-delay: 0.4s;
}

.panel {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: space-around;
  text-align: center;
  z-index: 6;
}

.left-panel {
  pointer-events: all;
  padding: 3rem 17% 2rem 12%;
}

.right-panel {
  pointer-events: none;
  padding: 3rem 12% 2rem 17%;
}

.panel .content {
  color: #fff;
  transition: transform 0.9s ease-in-out;
  transition-delay: 0.6s;
}

.panel h3 {
  font-weight: 600;
  line-height: 1;
  font-size: 1.5rem;
}

.panel p {
  font-size: 0.95rem;
  padding: 0.7rem 0;
}

.btn.transparent {
  margin: 0;
  background: none;
  border: 2px solid #fff;
  width: 130px;
  /* height: 41px; */
  font-weight: 600;
  font-size: 0.8rem;
}

.right-panel .image,
.right-panel .content {
  transform: translateX(800px);
}

/* ANIMATION */

.container.sign-up-mode:before {
  transform: translate(100%, -50%);
  right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
  transform: translateX(-800px);
}

.container.sign-up-mode .signin-signup {
  left: 25%;
}

.container.sign-up-mode form.sign-up-form {
  opacity: 1;
  z-index: 2;
}

.container.sign-up-mode form.sign-in-form {
  opacity: 0;
  z-index: 1;
}

.container.sign-up-mode .right-panel .image,
.container.sign-up-mode .right-panel .content {
  transform: translateX(0%);
}

.container.sign-up-mode .left-panel {
  pointer-events: none;
}

.container.sign-up-mode .right-panel {
  pointer-events: all;
}

@media (max-width: 870px) {
  .container {
    min-height: 800px;
    height: 100vh;
  }
  .signin-signup {
    width: 100%;
    top: 95%;
    transform: translate(-50%, -100%);
    transition: 1s 0.8s ease-in-out;
  }

  .signin-signup,
  .container.sign-up-mode .signin-signup {
    left: 50%;
  }

  .panels-container {
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 2fr 1fr;
  }

  .panel {
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    padding: 2.5rem 8%;
    grid-column: 1 / 2;
  }

  .right-panel {
    grid-row: 3 / 4;
  }

  .left-panel {
    grid-row: 1 / 2;
  }

  .image {
    width: 200px;
    transition: transform 0.9s ease-in-out;
    transition-delay: 0.6s;
  }

  .panel .content {
    padding-right: 15%;
    transition: transform 0.9s ease-in-out;
    transition-delay: 0.8s;
  }

  .panel h3 {
    font-size: 1.2rem;
  }

  .panel p {
    font-size: 0.7rem;
    padding: 0.5rem 0;
  }

  .btn.transparent {
    width: 110px;
    /* height: 35px; */
    font-size: 0.7rem;
  }

  .container:before {
    width: 1500px;
    height: 1500px;
    transform: translateX(-50%);
    left: 30%;
    bottom: 68%;
    right: initial;
    top: initial;
    transition: 2s ease-in-out;
  }

  .container.sign-up-mode:before {
    transform: translate(-50%, 100%);
    bottom: 32%;
    right: initial;
  }

  .container.sign-up-mode .left-panel .image,
  .container.sign-up-mode .left-panel .content {
    transform: translateY(-300px);
  }

  .container.sign-up-mode .right-panel .image,
  .container.sign-up-mode .right-panel .content {
    transform: translateY(0px);
  }

  .right-panel .image,
  .right-panel .content {
    transform: translateY(300px);
  }

  .container.sign-up-mode .signin-signup {
    top: 5%;
    transform: translate(-50%, 0);
  }
}

@media (max-width: 570px) {
  form {
    padding: 0 1.5rem;
  }

  .image {
    display: none;
  }
  .panel .content {
    padding: 0.5rem 1rem;
  }
  .container {
    padding: 1.5rem;
  }

  .container:before {
    bottom: 72%;
    left: 50%;
  }

  .container.sign-up-mode:before {
    bottom: 28%;
    left: 50%;
  }
  
}
.home-icon{
  position: relative;
  text-align:end;
}
.home-icon.left-align-class a {
    text-decoration: none;
    position: absolute;
    font-size: 26px;
    padding: 3px 10px;
    left: 17px;
    position: absolute;
    top: -44px;
    width: 45px;
}
.home-icon.left-align-class a:hover {
    background: white;
    color: #ae7c3d;
    border-radius: 50%;
    font-size: 26px;
}
.home-icon a{
    text-decoration: none;
    position: absolute;
    font-size: 26px;
    padding: 3px 10px;
    right: 17px;
    position: absolute;
    top: -44px;
}
.home-icon.left-align-class {
  text-align:left;
}
.home-icon a:hover {
  background:white;
  color: #ae7c3d;
  border-radius:50%;
}
.pass-view{
  font-size: 12px;
    position: absolute;
    right: 9px;
    cursor: pointer;
}
.pass-view i{
  font-size:20px;
}
#toolbarContainer{
  display:none;
}

.fa-eye-slash, .fa-eye {
 position: absolute;
  top: 40%;
  right: 5%; 
}
.mrl_35{margin-left:35px;}
.social-text{width: 84%;}
.sign-up-form .form-control:focus {
    color: #585858;
    background-color: #f0f0f0;
    border-color: #e1a9a8;
    /* border-top-right-radius: 25px;
    border-bottom-right-radius: 25px; */
  }



.forgot_btn{
  border: 0px;
    padding: 10px 30px;
    border-radius: 36px;
    background: #121212;
    color: #fff;
    right: 20%;
    position: absolute;
    bottom: 10%;
    width: 59%;
    z-index: 99999;

  }

#forgot_pass.modal {
  display: none; 
  position: fixed;
  z-index: 999; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
  padding-top: 60px;
}

/* Modal Content/Box */
#forgot_pass .modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; 
  border: 1px solid #888;
  width: 32%;
  z-index:999 ;
}

/* The Close Button (x) */
#forgot_pass .close {
  position: absolute;
  right: 10px;
  top:-10px;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

#forgot_pass .close:hover,
#forgot_pass .close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
#forgot_pass .animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}   
.forgot_pass_bx{
        position: relative;
    background: #fff;
    margin: 10px 115px;
    width: 60%;
    border-radius: 10px;
    text-align: center;
    border: 2px solid #000;
    font-size: 16px;
    padding: 8px 30px;
}
.forgot_pass_bx .title {font-size: 1.2rem;}
 .sumit_forgot{
    width: 270px;
    background-color: #121212;
    border: none;
    outline: none;
    line-height: 35px;
    height: 35px;
    border-radius: 35px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    margin: 10px 0;
    cursor: pointer;
    transition: 0.5s;
}
#ref{position: absolute;top: 26px;right: -10px;}

</style>
</head>
<body>
	<div class="container w-100">
		<div class="forms-container">
			<div class="signin-signup">

        <!-- ################################### Login Form ###################################### -->
				<form  class="sign-in-form" id="signInform" name="signInform" enctype="multipart/form-data" method="POST">
					<h2 class="title">Sign in</h2>
					<div class="input-field">
						<i class="fa fa-user"></i>
						<input autocomplete="off" name="user_email" id="user_email" type="email" placeholder="Enter username" />
					</div>
          <span class="error_msg err_user_email err" style="color: red;"></span>
					<div class="input-field">
						<i class="fa fa-lock"></i>
						<input autocomplete="off" name="user_password" id="user_password" type="password" placeholder="Enter password" />
            <span class="pass-view"><i class="fa fa-eye" id="togglePassword" onclick="myFunction()"></i></span>
					</div>
          <span class="error_msg err_user_password err" style="color: red;"></span>
           
          <p style="margin:0; padding:0;" class="social-text">By continuing, I agree to the <span><b><i><a style="text-decoration: none; color: #fd7e14;" href="<?php echo base_url('terms-condition'); ?>">Terms of Use</a></i></b></span> & <span><b><i><a style="text-decoration: none; color: #fd7e14;" href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></i></b></span></p>
					<button type="button" class="btn solid" id="userLogin">Login</button>

         <button onclick="document.getElementById('forgot_pass').style.display='block'"class="forgot_btn">Forgot password?</button>
         <!--FORGOT PASS--->
          <div id="forgot_pass" class="modal"> 
            <div class="forgot_pass_bx" id="forgotPassword" name="forgotPassword">
             <span onclick="document.getElementById('forgot_pass').style.display='none'" class="close" title="Close Modal">&times;</span>
             <p class="py-2 mb-0 title">Forgot Password</p>  

            <div class="mb-3 mt-3">
              <input required type="email" class="form-control" id="forgot_password_email" placeholder="Enter registered email" name="forgot_password_email">
              <span class="error_msg err_forgot_password_email err" style="color: red;"></span>
            </div>  
            <button type="button" id="forgotPasswordBtn" class="btn btn-primary mb-2 sumit_forgot">Submit</button>
          </div>
          </div>
          <!-----FORGOT PASS--->
				</form>

        
        <!-- ###################### End Login Form ##################################### -->



				<form id="signUpform" name="signUpform" class="sign-up-form" enctype="multipart/form-data" method="POST">
					<h2 class="title">Sign Up</h2>

					<div class="input-field">
						<i class="fa fa-user"></i>
						<input autocomplete="off" name="userFullName" id="userFullName" type="text" class="form-control fullNameAllowdedCharacters" placeholder="Enter Full Name">            
					</div>
          <span class="error_msg err_userFullName err" style="color: red;"></span>


          <div class="input-field">
            <i class="fa fa-phone"></i>
            <input autocomplete="off" onkeypress="onlynumeric(event)" maxlength="15" name="userContactNo" id="userContactNo" type="text" class="form-control" placeholder="Enter contact no">                  
          </div>
          <span class="error_msg err_userContactNo err" style="color: red;"></span>
                    
					<div class="input-field">
						<i class="fa fa-envelope"></i>
						<input autocomplete="off" name="userEmail" id="userEmail" type="email" class="form-control" placeholder="Enter your email">                  
					</div>
          <span class="error_msg err_userEmail err" style="color: red;"></span>


					<div class="input-field">
						<i class="fa fa-lock"></i>
            <input autocomplete="off" name="userPassword" id="userPassword" type="text" class="form-control" placeholder="Enter Password">
          </div>
          <span class="error_msg err_userPassword err" style="color: red;"></span>
            <p style="margin:0;padding:0;font-size:13px;" class="social-text"><b>Note:</b>Password should be contain atleast 1 alphabets, 1 uppercase, 1 lowercase, 1 number and 1 special character.</p>

          <div class="row">
          <div class="col-md-6 mrl_35">
          <input maxlength="10" autocomplete="off" name="Captcha" id="Captcha" type="text" class="form-control input-field" placeholder="Enter Captcha Code">
          <span class="error_msg err_captcha err" style="color: red;"></span>
          </div>
          <div class="col-md-5" style="line-height: 80px; height: 70px;position: relative">
          <span id="DrawCaptchaCaptha" style="background-image: url('https://ligobags.ligogroup.in/assets/img/captcha-bg.png'); font-weight: bold; height: 44px; line-height: 47px; font-style: italic; display: inline-grid; width: 100%; border-radius: 4px; text-align: center; font-size: 25px; color: #fff;"></span>&nbsp;&nbsp;<i title="Refresh Captcha" id="ref" style="cursor: pointer;" class="fa fa-refresh"></i>
          <input type="hidden" name="DrawCaptchaCaptha_val" id="DrawCaptchaCaptha_val" value="">
          </div>
          </div>
		
          <button type="button" class="btn solid" id="createMyaccount">Create My Account</button>
					
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
          <div class="home-icon left-align-class"> <a href="https://mofiso.ligogroup.in/"> <i class='fa fa-home'></i> </a></div>
					<h3>New here ?</h3>
					<p>
						Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
						ex ratione. Aliquid!
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Sign up
					</button>
				</div>
				<img  src="https://mofiso.ligogroup.in/assets/frontend/images/mofiso_dog.svg" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
        <div class="home-icon"> <a href="https://mofiso.ligogroup.in/"> <i class='fa fa-home'></i> </a></div>
					<h3>One of us ?</h3>
					<p>
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
						laboriosam ad deleniti.
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="https://mofiso.ligogroup.in/assets/frontend/images/mofiso_dog.svg"  class="image" alt="" />
			</div>
		</div>
	</div>


<script src="app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
</body>
<script>
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
sign_up_btn.addEventListener("click", () => {
container.classList.add("sign-up-mode");
});
sign_in_btn.addEventListener("click", () => {
container.classList.remove("sign-up-mode");
});
</script>

<script>  
let eye = document.querySelector('.fa-eye');
eye.addEventListener('click', function(e) {
  eye.classList.toggle('fa-eye-slash');
});
</script>


<script>
$(document).ready(function(){
DrawCaptcha();
$("#ref").click(function(){
DrawCaptcha();
});
});

function DrawCaptcha(){
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
    $("#DrawCaptchaCaptha").text(code);
    $("#DrawCaptchaCaptha_val").attr("value",gatcode);
}

function bulkEnquiryMobileOnlyNumeric(evt) {
    var theEvent = evt || window.event;
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
$('.bulkEnquiryfullNameAllowdedCharacters').keypress(function(e) {
var regex = new RegExp("^[a-zA-Z 0-9_-]+$");
var str=String.fromCharCode(!e.charCode ? e.which : e.charCode);
if(regex.test(str)){
    return true;
}
return false;
});

function onlynumeric(evt) {
    var theEvent = evt || window.event;
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
</script>


<script>
$(document).on('click', '#createMyaccount', function(e){
 $(".err").html('');
   var full_name=$("#userFullName").val().trim();
   var userContactNo=$("#userContactNo").val().trim();
   var userEmail=$("#userEmail").val().trim();
   var userPassword=$("#userPassword").val();
   if(full_name==""){
     $('#userFullName').focus();
     $('.err_userFullName').html('Please enter full name!');
     return false;
   }
   if(userContactNo==""){
     $('#userContactNo').focus();
     $('.err_userContactNo').html('Please enter contact number!');
     return false;
   }

  if(userContactNo.length<10){
    $('#userContactNo').focus();
    $('.err_userContactNo').html('Please enter valid contact number!');
    return false;
  }
 
   var filter = /^\d*(?:\.\d{1,2})?$/;    
   if(!filter.test(userContactNo)){
     $('#userContactNo').focus();
     $('.err_userContactNo').html('Please enter valid contact number!');
     return false;
   }
   if(userEmail==""){
     $('#userEmail').focus();
     $('.err_userEmail').html('Please enter your email!');
     return false;
   }
   var emailregex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
   var match=userEmail.match(emailregex);
   if(!match){
     $('#userEmail').focus();
     $('.err_userEmail').html('Please enter valid email!');
     return false; 
   }
   
   if(userPassword==""){
     $('#userPassword').focus();
     $('.err_userPassword').html('Please enter password!');
     return false;
   }
   //Validate User Password...
   var number = /([0-9])/;
   var alphabets = /([a-zA-Z])/;
   var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
    if(userPassword.length<6){
        $('#userPassword').focus();
        $('.err_userPassword').html('Password should be contain atleast 6 characters!');
        return false;
    }else if(!userPassword.match(number)){
        $('#userPassword').focus();
        $('.err_userPassword').html('Password should be contain atleast 1 number!');
        return false;
    }else if(!userPassword.match(alphabets)){
        $('#userPassword').focus();
        $('.err_userPassword').html('Password should be contain atleast 1 alphabets!');
        return false;
    }else if(!userPassword.match(special_characters)){
        $('#userPassword').focus();
        $('.err_userPassword').html('Password should be contain atleast 1 special character!');
        return false;
    }else{
        $('.err_userPassword').html('');
    }
    
    var captcha=$("#Captcha").val().trim();
    var captha_val=$("#DrawCaptchaCaptha_val").val().trim();
    if(captcha==""){        
        $('#Captcha').focus();
        $('.err_captcha').html('Please enter capctha!');
        return false;
    }
    if(captcha!=captha_val){        
        $('#Captcha').focus();
        $('.err_captcha').html('Invalid capctha!');
        return false;
    }

    //alert("Fine here...");
    var action_uri='<?php echo base_url('user/user-registration'); ?>';
    var formData=new FormData($('#signUpform')[0]);
    $.ajax({
  type:'POST',
  url: action_uri,
  data:formData,
  //data: {'bookingId':bookingId, 'comment':value},
  dataType: 'json',
  mimeType: "multipart/form-data",
  contentType: false,
  cache: false,
  processData: false,
  beforeSend: function(){
      $('#createMyaccount').html('Processing ...');
      $('#createMyaccount').prop('disabled',true);
      $('#createMyaccount').css('cursor', 'wait');
  },
  complete: function(){
      $('#createMyaccount').html('CREATE MY ACCOUNT');
      $('#createMyaccount').prop('disabled',false);
      $('#createMyaccount').css('cursor', '');
  },
  success: function(response){
      if(response.status==1){
            Swal.fire({
            icon: "success",
            title: 'Success',
            text: response.msg,
            type: 'success',
            //showDenyButton: true,
            confirmButtonText: 'Sign In Now',
            showCancelButton: false,
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutRight'
            },
            }).then((confirmed) => {              
              $("#sign-in-btn").trigger('click');
              $("#signUpform")[0].reset();
            //window.location.href="<?php echo base_url(); ?>";
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




<script type="text/javascript">
$(document).on('click', '#userLogin', function(e){
 $(".err").html('');
   var userName=$("#user_email").val().trim();
   var userPassword=$("#user_password").val();
   if(userName==""){
     $('#user_email').focus();
     $('.err_user_email').html('Please enter your username!');
     return false;
   }

   if(userPassword==""){
     $('#user_password').focus();
     $('.err_user_password').html('Please enter your password!');
     return false;
   }

   //alert("Fine here...");
    var action_uri='<?php echo base_url('user/user-login'); ?>';
    var formData=new FormData($('#signInform')[0]);
    const loginErrorToast=Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    });
  $.ajax({
  type:'POST',
  url: action_uri,
  data:formData,
  //data: {'bookingId':bookingId, 'comment':value},
  dataType: 'json',
  mimeType: "multipart/form-data",
  contentType: false,
  cache: false,
  processData: false,
  beforeSend: function(){
      $('#userLogin').html('Processing ...');
      $('#userLogin').prop('disabled',true);
      $('#userLogin').css('cursor', 'wait');
  },
  complete: function(){
      $('#userLogin').html('Login');
      $('#userLogin').prop('disabled',false);
      $('#userLogin').css('cursor', '');
  },
  success: function(response){
      if(response.status==1){
        /*window.location.href="<?php echo base_url('user/dashboard'); ?>"; */
        window.location.href="<?php echo base_url(); ?>";
      }else{
        loginErrorToast.fire({
        icon: 'error',
        title: response.msg,
        });
         
      }
  }
});


});
</script>


<script>
/* Press enter call Ajax */
$(document).keypress(function(e) {
if(e.which == 13) /* 13 is the keycode for enter button */
{
    $("#signin").trigger('click');
}
});
/* End Press enter */
</script>


<script>
 function myFunction() {
   var x = document.getElementById("user_password");
   if (x.type === "password") {
     x.type = "text";
     $('#togglePassword').addClass('fa fa-eye-slash');
   } else {
     x.type = "password";
     $('#togglePassword').addClass('fa fa-eye');
   }
 }
</script>




<script>
var modal=document.getElementById('forgot_pass');
window.onclick=function(event){
    if (event.target==modal){
        modal.style.display="none";
    }
}
</script>



<script>  
$(document).on('click', '#forgotPasswordBtn', function(e){
   var email=$("#forgot_password_email").val().trim();
   if(email==""){
     $('#forgot_password_email').focus();
     $('.err_forgot_password_email').html('Please enter registered email!');
     return false;
   }
    $.ajax({
    type:'POST',
    url: '<?php echo base_url("user/user-forgot-password"); ?>',
    data: {'user_email':email},
    dataType: 'json',
    beforeSend: function(){
      $('#forgotPasswordBtn').html('Processing ...');
      $('#forgotPasswordBtn').prop('disabled',true);
      $('#forgotPasswordBtn').css('cursor', 'wait');
    },
    complete: function(){
      $('#forgotPasswordBtn').html('SUBMIT');
      $('#forgotPasswordBtn').prop('disabled',false);
      $('#forgotPasswordBtn').css('cursor', '');
    },
    success: function(response){
      if(response.status==1){
        Swal.fire({
            icon: "success",
            title: 'Success',
            text: response.msg,
            type: 'success',
            //showDenyButton: true,
            showCancelButton: false,
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutRight'
            },
            }).then((confirmed) => {              
              window.location.reload(); 
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