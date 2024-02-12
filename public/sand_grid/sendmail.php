<?php
    include('emailCurl_vibes.php');
    //die('test');
	//echo "<pre>"; print_r($_POST); die;     
    $to=trim($_POST['to']);
    $toName=trim($_POST['toName']);
    $subject=trim($_POST['subject']);
    $message=$_POST['message'];
    $fromEmail=trim($_POST['fromEmail']);
    $fromName=trim($_POST['fromName']);

	$email = new Emailclass();
	$email->mailaccount='Ligogroup';		
	$email->to=$to;		
	$email->toname=$toName;
	$email->bcc='';
	$email->from=$fromEmail;
	$email->fromname=$fromName;	
	$email->subject=$subject;
	$email->body=$message;
	$email_response = $email->sendemail();
	return $email_response;
	//echo $email_response;
?>
