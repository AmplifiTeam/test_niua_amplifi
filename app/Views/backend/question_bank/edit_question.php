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
<h1 class="">Copy Question</h1>
</div>
<section class="section dashboard">
<form class="form-horizontal" name="addQuestionform"  id="addQuestionform" enctype="multipart/form-data">
<div class="midl1">
<div class="tabl-titl1">
<div class="pup1">
<a href="<?php echo base_url('admin/view-question'); ?>" class="btn btn-primary d-none">All Questions</a>
</div>
</div>
<div class="for1">
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


<div class="for1">
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

<div class="for1">
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
<span class="error_msg err_question_supporting_document err" style="color: red;"></span>        
</div>
</div>
</div>



<div class="for1 showOther" style="display: none;">
<div class="row">           
<div class="col-lg-4">
<span>Others<label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<input type='text' name="other" id="other" value='' class="form-control"  placeholder="Enter other framework">
<span class="error_msg err_other err" style="color: red;"></span>        
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

<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Question Input type <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" name="inputTypeSelector" id="inputTypeSelector" aria-label="Default select example">
<?php
$uomDetail=getQuestionUnitOfMeasurement($question['UOM_ID']);
// if(isset($allinputs) && !empty($allinputs)){
// foreach ($allinputs as $allinputsDetails){              
?>
<option selected value="<?php echo trim($question['UOM_ID']); ?>"><?php echo ucwords($uomDetail['UOM']); ?></option>
<?php //} } ?>
</select>
<span class="error_msg err_inputTypeSelector err" style="color: red;"></span>      
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


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Question Placeholder</span>         
</div>  
<div class="col-lg-8">
<textarea name="question_placeholder" id="question_placeholder" class="form-control" rows="2" cols="25" placeholder="Placeholder for question"><?php echo isset($question["question_placeholder"])?$question["question_placeholder"]:""; ?></textarea>
<span class="error_msg err_question_placeholder err" style="color: red;"></span>       
</div>
</div>
</div>


<div class="for1 additionalSection" id="rangeSection" style="display:<?php if($question["UOM_ID"]==35){ echo "block"; }else{ echo "none"; } ?>;">
<div class="row">
<div class="col-lg-4">
<span>Range (Min/Max)</span>         
</div>  
<div class="col-lg-4">
<label>MIN</label>
<input value="<?php echo !empty($alloptions[0]["range_min_value"])?$alloptions[0]["range_min_value"]:""; ?>" type="text" class="form-control" placeholder="Enter min value" id="inputPassword">    
</div>
<div class="col-lg-4">
<label>MAX</label>
<input value="<?php echo !empty($alloptions[0]["range_max_value"])?$alloptions[0]["range_max_value"]:""; ?>" type="text" class="form-control" placeholder="Enter max value" id="inputPassword">   
</div>
</div>
</div>


<div id="fileExtensionSection" class="additionalSection mb-4 for1" style="display:<?php if($question["UOM_ID"]==30){ echo "block"; }else{ echo "none"; } ?>;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">File Extension<span style="color: red;">*</span></div>
<div class="col-lg-8">
<table>
<tr>
<?php
if(isset($alloptions) && !empty($alloptions)){
  $fileExt=$alloptions[0]["file_extension"];
}else{
  $fileExt="";
}
?>
<td><input <?php if(str_contains($fileExt, "PDF")){ echo "checked"; } ?> class="getFileExt" type="checkbox" id="PDF" name="PDF" value="PDF"> 
<label class="form-label" for="PDF">PDF</label><br><span class="ext_one" style="color: red;"></span></td>
<td><input <?php if(str_contains($fileExt, "JPG")){ echo "checked"; } ?> class="getFileExt" type="checkbox" id="JPG" name="JPG" value="JPG">
<label class="form-label" for="JPG">JPG</label></td>
<td><input <?php if(str_contains($fileExt, "PNG")){ echo "checked"; } ?> class="getFileExt" type="checkbox" id="PNG" name="PNG" value="PNG">
<label class="form-label" for="PNG">PNG</label></td>
<td><input <?php if(str_contains($fileExt, "WEBP")){ echo "checked"; } ?> class="getFileExt" type="checkbox" id="WEBP" name="WEBP" value="WEBP">
<label class="form-label" for="WEBP">WEBP</label></td>
<td><input <?php if(str_contains($fileExt, "JPEG")){ echo "checked"; } ?> class="getFileExt" type="checkbox" id="JPEG" name="JPEG" value="JPEG">
<label class="form-label" for="JPEG">JPEG</label></td>
</tr>
<tr>
<td><input <?php if(str_contains($fileExt, "GIF")){ echo "checked"; } ?>  class="getFileExt" type="checkbox" id="GIF" name="GIF" value="GIF">
<label class="form-label" for="GIF">GIF</label></td>
</tr>           
</table>
</div>    
</div>
</div>

<div id="fileExtensionOfAudio" class="additionalSection audioSection mb-4 for1" style="display:<?php if($question["UOM_ID"]==28){ echo "block"; }else{ echo "none"; } ?>;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Audio Extension<span style="color: red;">*</span></div>
<div class="col-lg-8">
<table>
<tr>
<td><input <?php if(str_contains($fileExt, "MP3")){ echo "checked"; } ?> class="getaudioExt" type="checkbox" id="MP3" name="MP3" value="MP3"> 
<label class="form-label" for="MP3">MP3</label><br><span class="ext_two" style="color: red;"></span></td>
<td><input <?php if(str_contains($fileExt, "AAC")){ echo "checked"; } ?> class="getaudioExt" type="checkbox" id="AAC" name="AAC" value="AAC">
<label class="form-label" for="AAC">AAC</label></td>
<td><input <?php if(str_contains($fileExt, "M4A")){ echo "checked"; } ?> class="getaudioExt" type="checkbox" id="M4A" name="M4A" value="M4A">
<label class="form-label" for="M4A">M4A</label></td>
<td><input <?php if(str_contains($fileExt, "MP4")){ echo "checked"; } ?> class="getaudioExt" type="checkbox" id="MP4" name="MP4" value="MP4">
<label class="form-label" for="MP4">MP4</label></td>
</tr>
<tr>
<td><input <?php if(str_contains($fileExt, "WAV")){ echo "checked"; } ?> class="getaudioExt" type="checkbox" id="WAV" name="WAV" value="WAV">
<label class="form-label" for="WAV">WAV</label></td>
<td><input <?php if(str_contains($fileExt, "WMA")){ echo "checked"; } ?> class="getaudioExt" type="checkbox" id="WMA" name="WMA" value="WMA">
<label class="form-label" for="WMA">WMA</label></td>
</tr>           
</table>
</div>    
</div>
</div>



<div id="fileExtensionOfVideo" class="additionalSection VideoSection mb-4 for1" style="display:<?php if($question["UOM_ID"]==29){ echo "block"; }else{ echo "none"; } ?>;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Video Extension<span style="color: red;">*</span></div>
<div class="col-lg-8">
<table>
<tr>
<td><input <?php if(str_contains($fileExt, "MP4")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="MP4" name="MP4" value="MP4"> 
<label class="form-label" for="MP4">MP4</label><br><span class="ext_three" style="color: red;"></span></td>
<td><input <?php if(str_contains($fileExt, "MOV")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="MOV" name="MOV" value="MOV">
<label class="form-label" for="MOV">MOV</label></td>
<td><input <?php if(str_contains($fileExt, "AVI")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="AVI" name="AVI" value="AVI">
<label class="form-label" for="AVI">AVI</label></td>
<td><input <?php if(str_contains($fileExt, "FLV")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="FLV" name="FLV" value="FLV">
<label class="form-label" for="FLV">FLV</label></td>
<td><input <?php if(str_contains($fileExt, "MKV")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="MKV" name="MKV" value="MKV">
<label class="form-label" for="MKV">MKV</label></td>
</tr>
<tr>
<td><input <?php if(str_contains($fileExt, "WMV")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="WMV" name="WMV" value="WMV">
<label class="form-label" for="WMV">WMV</label></td>
<td><input <?php if(str_contains($fileExt, "WEBM")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="WEBM" name="WEBM" value="WEBM">
<label class="form-label" for="WEBM">WEBM</label></td>
<td><input <?php if(str_contains($fileExt, "MPEG-4")){ echo "checked"; } ?> class="getvideoExt" type="checkbox" id="MPEG-4" name="MPEG-4" value="MPEG-4">
<label class="form-label" for="MPEG-4">MPEG-4</label></td>
</tr>           
</table>
</div>    
</div>
</div>


<div id="optionSection" class="additionalSection mb-4 for1" style="display:<?php if($question["UOM_ID"]==8 || $question["UOM_ID"]==25 || $question["UOM_ID"]==36){ echo "block"; }else{ echo "none"; } ?>;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Options</div>
<div class="col-lg-8">
<table>
<tr>
  <td><b>Option</b></td>
  <td class="text-center"><b>Action(<font class="addMoreRow" title="Add More..." style="font-size: 18px; font-weight: bold; color: green; cursor: pointer;">&plus;</font>)</b></td>
</tr>
<tbody class="allActions">
<?php
if(isset($alloptions) && !empty($alloptions)){
foreach ($alloptions as $alloptions_details){
?>
<tr>
<td><input value="<?php echo isset($alloptions_details["options"])?$alloptions_details["options"]:""; ?>" type="text" class="form-control options alphaOnly" name="option[]" placeholder="Enter option"><span class="more_row_err" style="color: red;"></span></td>
  <td class="text-center"><font class="deleteRow" title="Delete More..." style="font-size: 18px; font-weight: bold; color: red; cursor: pointer;">-</font></td>
</tr>
<?php }} ?>
</tbody>           
</table>
</div>    
</div>
</div>



<div class="for1 d-none">
<div class="row">           
<div class="col-lg-4">
<span>Are you want to add question</span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example">
<option value="1">No</option>
<option value="2">Yes</option>
</select>      
</div>
</div>
</div>

<div class="for1 ">
<div class="row">           
<div class="col-lg-4">
<span>Is file upload mandatory ?</span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" id="fileUploadconcent" name="fileUploadconcent">
<option value="0" <?php if(!empty($question['concent_of_upload_file']==0)){ echo'selected'; }else{ echo'';} ?>>No</option>
<option value="1" <?php if(!empty($question['concent_of_upload_file']==1)){ echo'selected'; }else{ echo'';} ?>>Yes</option>
</select>      
</div>
</div>
</div>

<div class="for1 templateData" id="tamplatefileuplodeData" style="display:none;">
<div class="row">           
<div class="col-lg-4">
<span>Kindly upload template</span>         
</div>  
<div class="col-lg-8">
<input type="file" value="" name="template" id="template" >  </br>
<span class="error_template" style="color: red;"></span> 
</div> 
</div>  
</div>




<div class="col-lg-12 text-center my-4">
<button type="button" id="saveQuestion" class="btn btn-primary bg-col1">Create New Question</button>
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
<script>
  $(document).on('change','#qestion_framework', function(e){
    var framework=$("#qestion_framework").val().trim();
    
    if(framework=='Others'){
      $(".showOther").show();
    }else{
      $(".showOther").hide();
    }
    
  })
</script>
<script>


$(document).ready(function(){
  $('#inputTypeSelector').trigger('change')

})
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
var count=1;
$(document).on('click', '.addMoreRow', function(){
    var optionsvaldata = $('input[name="option[]"]');
    var optionlengthdata=optionsvaldata.length;
    count++;
//alert("Fine here...");
var app='<tr>\
<td><input type="text" class="form-control options alphaOnly" name="option[]" placeholder="Enter option"><span class="more_row_err" style="color: red;"></span></td>\
<td class="text-center"><font class="deleteRow" title="Delete Row" style="font-size: 18px; font-weight: bold; color: red; cursor: pointer;">&minus;</font></td>\
</tr>';
$(".allActions").append(app);
// let length=data.length;
if(optionlengthdata<count){
    $(".questionstype").hide();
    $(".innerquestionstable").hide();
    $("#addgroupquestion").val("");
    $(".inputselecttypeofquestion ").val("");
}

$('.alphaOnly').keypress(function(e) {
var regex = new RegExp("^[a-zA-Z 0-9_-]+$");
var str=String.fromCharCode(!e.charCode ? e.which : e.charCode);
if(regex.test(str)){
return true;
}
return false;
});
});

$(document).on('click', '.deleteRow', function(){  
    count--;
    var optionsvaldata = $('input[name="option[]"]');
    var optionlengthdata=optionsvaldata.length;
    if(optionlengthdata>count){
    $(".questionstype").hide();
    $(".innerquestionstable").hide();
    $("#addgroupquestion").val("");
    $(".inputselecttypeofquestion ").val("");
}
$(this).closest('tr').remove();   
});
</script>
<script>  
  $('#inputTypeSelector').change(function(){
    $(".additionalSection").hide();
    $('#tamplatefileuplodeData').hide()
    //alert($(this).val().trim());
    var input_type=$(this).val().trim();
    // alert(input_type)
    if(input_type=="17" || input_type=="34"){
      $("#placeholderSection").show();
    }else if(input_type=="8" || input_type=="25"  || input_type==36){      
      $("#optionSection").show();
      $('.addgroupquestion').show();
    }else if(input_type=="35"){      
      $("#rangeSection").show();
    }else if(input_type=="30"){      
      $("#fileExtensionSection").show();
      $('#tamplatefileuplodeData').show()
    }else if(input_type=="28"){      
      $("#fileExtensionOfAudio").show();
    }else if(input_type=="29"){      
      $("#fileExtensionOfVideo").show();
    }else if(input_type=="31"){      
      $("#dateRangeSection").show();
    }

  });
</script>

<script type="text/javascript">
$(document).on('click', '#saveQuestion', function(e){
$(".err").html('');
var qestion_sector=$("#qestion_sector").val();
var framework=$("#qestion_framework").val();
var question_title=$("#question_title").val();
var question_note=$("#question_note").val();
//var question_instruction=$("#question_instruction").val();
var inputTypeSelector=$("#inputTypeSelector").val();
// var inputvaluedata=$("#inputvaluedata").val();
if(qestion_sector==""){
  $('#qestion_sector').focus();
  $('.err_qestion_sector').html('Please select a sector!');
  return false;
}


if(framework==""){
  $('#qestion_framework').focus();
  $('.err_qestion_framework').html('Please select a framework!');
  return false;
}

if(framework=='Others'){
  var other=$("#other").val().trim();
  if(other==''){
    $('#other').focus();
    $('.err_other').html('Please enter other framework');
    return false;
  }else if(other.length>20){
    $('.err_other').html('Maximum 20 characters are allowed ');
    return false;
  }
}

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

if(inputTypeSelector==""){
  $('#inputTypeSelector').focus();
  $('.err_inputTypeSelector').html('Please select a type!');
  return false;
}

// For Range Input
if(inputTypeSelector=="35"){
  var min=$("#range_min_val").val().trim();
  var max=$("#range_max_val").val().trim();
  if(min==""){
    $('#range_min_val').focus();
    $('.err_range_min_val').html('Please enter min value!');
    return false;
  }

  if(max==""){
    $('#range_max_val').focus();
    $('.err_range_max_val').html('Please enter max value!');
    return false;
  }

  if(min>=max){
    $('#range_min_val').focus();
    $('.err_range_min_val').html('Please enter another value!');
    return false;
  }

}

if(inputTypeSelector=="dateRange"){
  var mindate=$("#date_range_min_val").val().trim();
  var maxdate=$("#date_range_max_val").val().trim();
  if(mindate==""){
    $('#date_range_min_val').focus();
    $('.err_date_min_val').html('Please enter start date!');
    return false;
  }

  if(maxdate==""){
    $('#date_range_max_val').focus();
    $('.err_date_max_val').html('Please enter end date!');
    return false;
  }

  if(mindate>=maxdate){
    $('#date_range_min_val').focus();
    $('.err_date_min_val').html('Please enter another value!');
    return false;
  }
}

//Add more row validation..
if(inputTypeSelector=="8" || inputTypeSelector=="25"){  
  
  var is_form_valid=true;
  var options=$('.options');
    $.each(options,function(i,v){
      //console.log(`Test ${i} ==== ${v}`);
      $(".more_row_err").html("");
      if($(v).val()==""){
          //alert(i);
          $(v).focus();
          $(v).parent().find('.more_row_err').text('Please enter option!'); 
          is_form_valid=false;
          return false;
      }
    });
    if(!is_form_valid){ return false;}
}



if(inputTypeSelector=="30"){  
  var totalSelected=$('.getFileExt').filter(':checked').length;
  //alert(totalSelected);
  if(totalSelected==0){
    $(".ext_one").text("Please select atleast one!");
    return false;
  }
  var template=$("#template").val();
  if(template==''){
    $(".error_template").text("Please upload template!");
    return false;
  }
}
if(inputTypeSelector=="28"){  
  var totalSelected=$('.getaudioExt').filter(':checked').length;
  //alert(totalSelected);
  if(totalSelected==0){
    $(".ext_two").text("Please select atleast one!");
    return false;
  }
}

if(inputTypeSelector=="29"){  
  var totalSelected=$('.getvideoExt').filter(':checked').length;
  //alert(totalSelected);
  if(totalSelected==0){
    $(".ext_three").text("Please select atleast one!");
    return false;
  }
}


var action_uri='<?php echo base_url('admin/save-question'); ?>';
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
      $('#saveQuestion').html('Save Question');
      $('#saveQuestion').prop('disabled',false);
      $('#saveQuestion').css('cursor', '');
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
            $("#" + response.validation.fieldName).focus();
            $("." + response.validation.errorMsgFieldName).html(response.validation.errorMsg);
            return false;
      }
  }
});
});
</script>


<script>
  function deleteOptions(OptionId){
    //alert(OptionId);
    if(OptionId!=""){
      Swal.fire({
       icon: "question",     
       type: 'question',
       text: 'Are you sure,you want to remove this option?',
       showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: "No, keep it",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/removeSigleOption',
            data: {'option_id':OptionId},
            dataType: "json",
            success: function(response){
              if(response.status==1){
                  Swal.fire({
                  icon: "success",     
                  text: response.msg,
                  showCancelButton: false,
                  confirmButtonClass: 'btn-danger',
                  confirmButtonText: 'Ok',
                  closeOnConfirm: false,
                  closeOnCancel: false
                  }).then((result) => {
                    window.location.reload();
                  })                  
              }              
            }
        });
      } 
    });
    }
  }
</script>


<script>
  $('#questionTypeSelection').change(function(){
    $(".additionalSection").hide();
    var allow=17; // Short text
    var selectOne=8; // Select One
    var integer=1; // Integer
    if($(this).val()=="yes"){
      $('#inputTypeSelector option').attr("disabled", true);
      $('#inputTypeSelector option[value="'+allow+'"]').attr("disabled", false);
      $('#inputTypeSelector option[value="'+selectOne+'"]').attr("disabled", false);
      $('#inputTypeSelector option[value="'+integer+'"]').attr("disabled", false);
      $('#inputTypeSelector option[value="'+allow+'"]').attr("selected", true);      
      $("#IsFileUploadMandatory").hide();
      $("#UOMDetailSection").show();
    }else{
      $('#inputTypeSelector option').attr("disabled", false);
      $("#IsFileUploadMandatory").show();
      $("#UOMDetailSection").hide();
    }
});
</script>
</html>