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
  #SubQuestionTable, .vsb-main{width:100%!important;}
  .vsb-main button {
    max-width: 100%!important;}
</style>
</head>
<body>
<?php echo view('backend/partials/top_header.php'); ?>
<main id="main" class="main">
<div class="pagetitle">
<p>
<a href="<?=base_url('/admin/view-question')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1 class="">Create Question</h1>
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
<option value="<?php echo trim($allsectorDetails['Sector_ID']); ?>"><?php echo ucwords($allsectorDetails['Sector']); ?></option>
<?php } } ?>
</select>
<span class="error_msg err_qestion_sector err" style="color: red;"></span>   
</div>
</div>
</div>


<div class="for1">
<div class="row">        
<div class="col-lg-4">
<span>Question Framework <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" name="qestion_framework" id="qestion_framework">
<option value="">Select Framework</option>
<?php
if(isset($allframework) && !empty($allframework)){
foreach ($allframework as $allframeworkDetails){              
?>
<option value="<?php echo trim($allframeworkDetails['Framework_ID']); ?>"><?php echo ucwords($allframeworkDetails['Description']); ?></option>
<?php } } ?>
<option value="Others">Others</option>
</select>
<span class="error_msg err_qestion_framework err" style="color: red;"></span>   
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
<span>Is this a Child Question?<label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" id="questionTypeSelection" name="questionTypeSelection">
  <option value="no">No</option>
  <option value="yes">Yes</option>
</select>
<span class="error_msg err_question_type err" style="color: red;"></span>        
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Question Title/Label <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<textarea name="question_title" id="question_title" class="form-control" rows="4" cols="25" placeholder="Enter question label"></textarea>
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
<textarea name="question_note" id="question_note" class="form-control" rows="3" cols="25" placeholder="Note about question"></textarea>
<span class="error_msg err_question_note err" style="color: red;"></span>     
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Question Input Type <label class="star-red">*</label> </span>         
</div>  
<div class="col-lg-8">
<select class="form-select" name="inputTypeSelector" id="inputTypeSelector" aria-label="Default select example">
<option value="">Select Input Type</option>
<?php 
if(isset($allinputs) && !empty($allinputs)){
foreach ($allinputs as $allinputsDetails){              
?>
<option value="<?php echo trim($allinputsDetails['UOM_ID']); ?>"><?php echo ucwords($allinputsDetails['UOM']); ?></option>
<?php } } ?>
</select>
<span class="error_msg err_inputTypeSelector err" style="color: red;"></span>      
</div>
</div>
</div>


<div class="for1" id="placeholderSection">
<div class="row">           
<div class="col-lg-4">
<span>Question Placeholder</span>         
</div>  
<div class="col-lg-8">
<textarea name="question_placeholder" id="question_placeholder" class="form-control" rows="2" cols="25" placeholder="Placeholder for question"></textarea>
<span class="error_msg err_question_placeholder err" style="color: red;"></span>       
</div>
</div>
</div>


<div class="for1">
<div class="row">           
<div class="col-lg-4">
<span>Reference Year<label class="star-red d-none">*</label> </span>         
</div>  
<div class="col-lg-8">
<input type='text' name="question_year" id="question_year" class="form-control" placeholder="Enter year">
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
<input type='text' name="question_source" id="question_source" class="form-control" placeholder="Enter source">
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
<input type='text' name="question_supporting_document" id="question_supporting_document" class="form-control" placeholder="Enter supporting document">
<span class="error_msg err_question_supporting_document err" style="color: red;"></span>        
</div>
</div>
</div>

<div class="for1" id="IsFileUploadMandatory">
<div class="row">           
<div class="col-lg-4">
<span>Is file upload mandatory ?</span>         
</div>  
<div class="col-lg-8">
<select class="form-select" aria-label="Default select example" id="fileUploadconcent" name="fileUploadconcent">
<option value="0">No</option>
<option value="1">Yes</option>
</select>      
</div>
</div>
</div>


<div class="for1" id="UOMDetailSection" style="display:none;">
<div class="row">           
<div class="col-lg-4">
<span>UOM Detail</span>         
</div>  
<div class="col-lg-8">
<textarea name="uom_other_detail" id="uom_other_detail" class="form-control" rows="2" cols="25" placeholder="Enter UOM detail"></textarea>
<span class="error_msg err_uom_other_detail err" style="color: red;"></span>       
</div>
</div>
</div>





<div class="for1 additionalSection" id="rangeSection" style="display:none;">
<div class="row">
<div class="col-lg-4">
<span>Range (Min/Max)</span>         
</div>  
<div class="col-lg-4">
<label>MIN</label>
<input type="text" class="form-control numberOnly" placeholder="Enter min value" id="range_min_val" name="range_min_val">    
</div>
<div class="col-lg-4">
<label>MAX</label>
<input type="text" class="form-control numberOnly" placeholder="Enter max value" id="range_max_val" name="range_max_val">   
</div>
</div>
</div>





<div id="fileExtensionSection" class="additionalSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">File Extension<span style="color: red;">*</span></div>
<div class="col-lg-8">
<table>
<tr>
<td><input class="getFileExt" type="checkbox" id="PDF" name="PDF" value="PDF"> 
<label class="form-label" for="PDF">PDF</label><br><span class="ext_one" style="color: red;"></span></td>
<td><input class="getFileExt" type="checkbox" id="JPG" name="JPG" value="JPG">
<label class="form-label" for="JPG">JPG</label></td>
<td><input class="getFileExt" type="checkbox" id="PNG" name="PNG" value="PNG">
<label class="form-label" for="PNG">PNG</label></td>
<td><input class="getFileExt" type="checkbox" id="WEBP" name="WEBP" value="WEBP">
<label class="form-label" for="WEBP">WEBP</label></td>
<td><input class="getFileExt" type="checkbox" id="JPEG" name="JPEG" value="JPEG">
<label class="form-label" for="JPEG">JPEG</label></td>

</tr>
<tr>
<td><input class="getFileExt" type="checkbox" id="GIF" name="GIF" value="GIF">
<label class="form-label" for="GIF">GIF</label></td>
<td><input class="getFileExt" type="checkbox" id="xlsx" name="xlsx" value="xlsx">
<label class="form-label" for="xlsx">XLSX</label></td>
<td><input class="getFileExt" type="checkbox" id="doc" name="doc" value="doc">
<label class="form-label" for="doc">DOC</label></td>
<td><input class="getFileExt" type="checkbox" id="CSV" name="CSV" value="CSV">
<label class="form-label" for="CSV">CSV</label></td>
</tr>           
</table>
</div>    
</div>
</div>


<div id="fileExtensionOfAudio" class="additionalSection audioSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Audio Extension<span style="color: red;">*</span></div>
<div class="col-lg-8">
<table>
<tr>
<td><input class="getaudioExt" type="checkbox" id="MP3" name="MP3" value="MP3"> 
<label class="form-label" for="MP3">MP3</label><br><span class="ext_two" style="color: red;"></span></td>
<td><input class="getaudioExt" type="checkbox" id="AAC" name="AAC" value="AAC">
<label class="form-label" for="AAC">AAC</label></td>
<td><input class="getaudioExt" type="checkbox" id="M4A" name="M4A" value="M4A">
<label class="form-label" for="M4A">M4A</label></td>
<td><input class="getaudioExt" type="checkbox" id="MP4" name="MP4" value="MP4">
<label class="form-label" for="MP4">MP4</label></td>
</tr>
<tr>
<td><input class="getaudioExt" type="checkbox" id="WAV" name="WAV" value="WAV">
<label class="form-label" for="WAV">WAV</label></td>
<td><input class="getaudioExt" type="checkbox" id="WMA" name="WMA" value="WMA">
<label class="form-label" for="WMA">WMA</label></td>
</tr>           
</table>
</div>    
</div>
</div>



<div id="fileExtensionOfVideo" class="additionalSection VideoSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Video Extension<span style="color: red;">*</span></div>
<div class="col-lg-8">
<table>
<tr>
<td><input class="getvideoExt" type="checkbox" id="MP4" name="MP4" value="MP4"> 
<label class="form-label" for="MP4">MP4</label><br><span class="ext_three" style="color: red;"></span></td>
<td><input class="getvideoExt" type="checkbox" id="MOV" name="MOV" value="MOV">
<label class="form-label" for="MOV">MOV</label></td>
<td><input class="getvideoExt" type="checkbox" id="AVI" name="AVI" value="AVI">
<label class="form-label" for="AVI">AVI</label></td>
<td><input class="getvideoExt" type="checkbox" id="FLV" name="FLV" value="FLV">
<label class="form-label" for="FLV">FLV</label></td>
<td><input class="getvideoExt" type="checkbox" id="MKV" name="MKV" value="MKV">
<label class="form-label" for="MKV">MKV</label></td>
</tr>
<tr>
<td><input class="getvideoExt" type="checkbox" id="WMV" name="WMV" value="WMV">
<label class="form-label" for="WMV">WMV</label></td>
<td><input class="getvideoExt" type="checkbox" id="WEBM" name="WEBM" value="WEBM">
<label class="form-label" for="WEBM">WEBM</label></td>
<td><input class="getvideoExt" type="checkbox" id="MPEG-4" name="MPEG-4" value="MPEG-4">
<label class="form-label" for="MPEG-4">MPEG-4</label></td>
</tr>           
</table>
</div>    
</div>
</div>


<div id="SubQuestionSection" class="additionalSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Child Question</div>
<div class="col-lg-8">
<table id="SubQuestionTable">
<tbody class="SubQuestionTableAllActions">
<tr>
<td class="text-center">
  <select class="form-control" size="0" id="SubQuestionList" multiple>
    <?php echo $all_child_question_options; ?>
  </select>
  <span class="error_msg err_SubQuestionList err" style="color: red;"></span>
</td>
</tr>
</tbody>           
</table>

<span>
  <div class="selectedChildQuestionOrder">
   
  </div>
</span>
</div>    
</div>
</div>


<div id="CalculatedQuestionSection" class="additionalSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Child Question</div>
<div class="col-lg-8">
<table id="CalculatedQuestionTable">
<tbody class="CalculatedQuestionTableAllActions">
<tr>
<td class="text-center">
  <select class="form-select" id="CalculatedQuestionOption"  name="CalculatedQuestionOption">
    <option value="add">Addition</option>
    <option value="sub">Subtraction</option>
    <option value="mul">Multiplication</option>
    <option value="div">Division</option>
    <option value="per">Percentage</option>
  </select>
  <span class="error_msg err_CalculatedQuestionOption err" style="color: red;"></span>
</td>
<td class="text-center">
  <select class="form-control" size="0" id="CalculatedQuestionList" multiple>
    <?php echo $all_child_question_options; ?>
  </select>
  <span class="error_msg err_CalculatedQuestionList err" style="color: red;"></span>
</td>
</tr>

</tbody>           
</table>
<span>
  <div class="selectedChildQuestionOrder">
   
  </div>
</span>
</div>    
</div>
</div>




<div id="ParentChildQuestionSection" class="additionalSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Options</div>
<div class="col-lg-8">
<table id="ParentChildQuestionTable">
<tr>
  <td><b>Option</b></td>
  <td class="text-center"><b>Question</b></td>
  <td class="text-center"><b>Action&nbsp;&nbsp;</b><font class="addMoreParentChildQuestionRow" title="Add More..." style="font-size: 18px; font-weight: bold; color: green; cursor: pointer;">&plus;</font></td>
</tr>
<tbody class="ParentChildQuestionAllActions">
<tr>
<td><input type="text" class="form-control ParentChildQuestionOptions alphaOnly" name="ParentChildQuestionOption[]" placeholder="Enter option"><span class="" style="color: red;"></span></td>
<td class="text-center">
  <select class="optionChildQues form-control AddChildQuestionList_0" size="0" id="AddChildQuestionList_0" multiple>
    <?php echo $all_child_question_options; ?>
  </select>
</td>
<td class="text-center"></td>
</tr>

<tr><td class="text-center"><span class="more_ParentChildQuestion_row_err"></span></td></tr>
</tbody>           
</table>
</div>    
</div>
</div>







<div id="optionSection" class="additionalSection mb-4 for1" style="display:none;">
<div class="row">
<div class="col-lg-4 col-form-label form-label">Options</div>
<div class="col-lg-8">
<table>
<tr>
  <td><b>Option</b></td>
  <td class="text-center"><b>Action</b></td>
</tr>
<tbody class="allActions">
<tr>
<td><input type="text" class="form-control options alphaOnly" name="option[]" placeholder="Enter option"><span class="more_row_err" style="color: red;"></span></td>
  <td class="text-center"><font class="addMoreRow" title="Add More..." style="font-size: 18px; font-weight: bold; color: green; cursor: pointer;">&plus;</font></td>
</tr>
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
<select class="form-select" aria-label="Default select example" >
<option value="No">No</option>
<option value="Yes">Yes</option>
</select>      
</div>
</div>
</div>



<div class="for1 templateData" style="display:none;">
<div class="row">           
  <div class="col-lg-4">
    <span>Kindly upload template</span>         
  </div>  
  <div class="col-lg-8">
    <input type="file" value="" name="template" id="template">
    <span class="error_template" style="color: red;"></span> 
  </div> 
</div>  
</div>


<div class="for1 additionalSection" id="QuestionMatrixSection"  style="display:none;">
<div class="row">           
  <div class="col-lg-4">
    <span>XLS File</span>         
  </div>  
  <div class="col-lg-8">
    <input type="file" name="question_matrix_file" id="question_matrix_file" accept=".xlsx, .xls" />
    <span class="error_question_matrix_file" style="color: red;"></span> 
  </div> 
  </div>  
</div>

<div class="for1 additionalSection" id="BarcodeSection"  style="display:none;">
<div class="row">           
  <div class="col-lg-4">
    <span>Upload File</span>         
  </div>  
  <div class="col-lg-8">
    <input type="file" name="barcode_file" id="barcode_file" accept=".pdf, .png, .jpg" />
    <span class="error_barcode_file" style="color: red;"></span> 
  </div> 
  </div>  
</div>



<div class="col-lg-12 text-center my-4">
<button type="button" id="saveQuestion" class="btn btn-primary bg-col1">Save Question</button>
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
<script type="text/javascript" src="<?php echo base_url('assets/vanilla_selectbox/js/vanillaSelectBox.js'); ?>"></script>
</body>

<script type="text/javascript">
  var selectedCalculatedQuestions =[];
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
$(document).on('click', '.addMoreParentChildQuestionRow', function(){
var allChildQuestions="<?php echo $all_child_question_options; ?>";
//console.log(allChildQuestions);
var rowCount=$('.ParentChildQuestionAllActions tr').length;
var additionRow='<tr>\
<td><input type="text" class="form-control ParentChildQuestionOptions alphaOnly" name="ParentChildQuestionOption[]" placeholder="Enter option"><span class="" style="color: red;"></span></td>\
<td class="text-center">\
<select class="optionChildQues form-control AddChildQuestionList_'+rowCount+'" size="0" id="AddChildQuestionList_'+rowCount+'" multiple>\
'+allChildQuestions+'\
</select>\
</td>\
<td class="text-center d-none"><i title="Delete Row" style="color:red; cursor:pointer;" class="bi bi-trash ParentChildQuestionOptionDeleteRow"></i></td>\
</tr>';
$(".ParentChildQuestionAllActions tr:last").after(additionRow);
var newVanilla = new vanillaSelectBox("#AddChildQuestionList_"+rowCount+"",{"maxOptionWidth":300, "maxHeight": 200,"search": false,translations: { "all": "All selected", "items": "Questions", "item": "Question" }, "placeHolder": "Select question" });


$(document).on('click', '.ParentChildQuestionOptionDeleteRow', function(){
  $(this).closest('tr').remove();

  var trRowData = $('.ParentChildQuestionAllActions').find('tr');
  $.each(trRowData,function(i,trdata){
    $(trdata).find('select').attr('id','AddChildQuestionList_'+i)
  })
});


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
    $('.selectedChildQuestionOrder').html('');
    selectedCalculatedQuestions=[];
    var getQuestionTypeSelection=$("#questionTypeSelection").val();
    $(".additionalSection").hide();
    //alert($(this).val().trim());
    var input_type=$(this).val().trim();
    // alert(input_type);
    if((input_type=="8" || input_type=="1"  || input_type=="17") && getQuestionTypeSelection=="yes"){
      $("#UOMDetailSection").show();
    }else{
      $("#UOMDetailSection").hide();
    }
    if(input_type=="17" || input_type=="34"){
      $("#placeholderSection").show();
      $(".templateData").hide();
    }else if(input_type=="8" || input_type=="25"  || input_type=="36"){      
      $("#optionSection").show();
      $('.addgroupquestion').show();
      $(".templateData").hide();
    }else if(input_type=="35"){      
      $("#rangeSection").show();
      $(".templateData").hide();
    }else if(input_type=="39"){   //Barcode
      $("#placeholderSection").hide(); 
      $("#IsFileUploadMandatory").hide();     
      $(".templateData").hide();
      $("#BarcodeSection").show();
    }else if(input_type=="41"){   //Question Matrix
      $("#placeholderSection").hide(); 
      $("#IsFileUploadMandatory").hide();     
      $(".templateData").hide();
      $("#QuestionMatrixSection").show();
    }else if(input_type=="42"){   // Parent Child Conditional Question
      $("#placeholderSection").hide(); 
      $("#IsFileUploadMandatory").hide();     
      $("#ParentChildQuestionSection").show();
      new vanillaSelectBox("#AddChildQuestionList_0",{"maxHeight": 200,"search": false,translations: { "all": "All selected", "items": "Questions", "item": "Question" }, "placeHolder": "Select question" });

      $(".templateData").hide();
    }else if(input_type=="43"){   // Parent Child Question
      $("#placeholderSection").hide(); 
      $("#IsFileUploadMandatory").hide();     
      $("#SubQuestionSection").show();
      new vanillaSelectBox("#SubQuestionList",{"search": false,translations: { "all": "All selected", "items": "Questions", "item": "Question" }, "placeHolder": "Select question" });
      $(".templateData").hide();
    }else if(input_type=="44"){   // Parent Child Question
      $("#placeholderSection").hide(); 
      $("#IsFileUploadMandatory").hide();     
      $("#CalculatedQuestionSection").show();
      new vanillaSelectBox("#CalculatedQuestionList",{"search": false,translations: { "all": "All selected", "items": "Questions", "item": "Question" }, "placeHolder": "Select question" });
      $(".templateData").hide();
    }else if(input_type=="30"){      
      $("#fileExtensionSection").show();
      $(".templateData").show();
    }else if(input_type=="28"){      
      $("#fileExtensionOfAudio").show();
      $(".templateData").hide();
    }else if(input_type=="29"){      
      $("#fileExtensionOfVideo").show();
      $(".templateData").hide();
    }else if(input_type=="31"){      
      $("#dateRangeSection").show();
      $(".templateData").hide();
    }else if(input_type=="4"){      
      $(".templateData").hide();
    }else if(input_type=="33" || input_type=="32" || input_type=="14" || input_type=="20" || input_type=="9" || input_type=="11" || input_type=="5" || input_type=="1" || input_type=="10" || input_type=="7" || input_type=="15" || input_type=="2" || input_type=="16" || input_type=="23" || input_type=="6"|| input_type=="24" || input_type=="27" || input_type=="22"|| input_type=="13" || input_type=="3" || input_type=="12" || input_type=="21" || input_type=="18" || input_type=="19"){
      $(".templateData").hide();
    }
  });
</script>
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

<script type="text/javascript">
$(document).on('click', '#saveQuestion', function(e){
$(".err").html('');
var qestion_sector=$("#qestion_sector").val();
var framework=$("#qestion_framework").val();
var question_title=$("#question_title").val();
var question_note=$("#question_note").val();
//var question_instruction=$("#question_instruction").val();
var inputTypeSelector=$("#inputTypeSelector").val();
//var alphanumeric=/^([a-zA-Z0-9 _-]+)$/;
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
      $(".more_row_err").html("");
      if($(v).val()==""){
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
if(inputTypeSelector=="42"){   
   $('.optionChildQues').each(function(i, obj) {
      var selectId=obj.id;
      formData.append('option_'+i+'_child_question', $('#'+selectId+'').val());
   });
}

if(inputTypeSelector=="43"){
      var subQlist=$("#SubQuestionList").val();
      if(subQlist==""){
         showToast('error','Please select atleast one question!');
         return false;
      }   
      // formData.append('sub_question', $('#SubQuestionList').val());
      formData.append('sub_question', selectedCalculatedQuestions.join());
}

if(inputTypeSelector=="44"){
      var subQlist=$("#CalculatedQuestionList").val();
      if(subQlist==""){
         showToast('error','Please select atleast one question!');
         return false;
      }   
      formData.append('calculated_sub_question', selectedCalculatedQuestions.join());
}


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
      }else if(response.status==2){
        showToast('error',response.validation.errorMsg);
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

<script>
var lastUOM=0;
function addChildQuestionToList(qb_id){
  var selectedUOM = $('#inputTypeSelector').val();
  // console.log(selectedUOM,'selectedUOM')
  
  // if(selectedUOM == lastUOM){
  //   console.log( '  same uom data')
  //   lastUOM = selectedUOM;
  // }else{
  //   console.log( 'changed uom data')
  //   $('.selectedChildQuestionOrder').html('');
  //   selectedCalculatedQuestions=[];
  //   lastUOM = selectedUOM;
  // }

  if($.inArray(qb_id, selectedCalculatedQuestions)  !== -1 ) {
     selectedCalculatedQuestions = jQuery.grep(selectedCalculatedQuestions, function(value) {
      return value != qb_id;
    });  
  }else{ 
    selectedCalculatedQuestions.push(qb_id);    
  }
  $.ajax({
  type:'POST',
  url: '<?=base_url()?>admin/showSelectedQuestionOrder',
  data:{'selectedCalculatedQuestions':selectedCalculatedQuestions},
  success: function(response){
    var res = JSON.parse(response);
      if(res.qData!=''){
            $('.selectedChildQuestionOrder').html(res.qData);
      }else{
        $('.selectedChildQuestionOrder').html('');
      }
  }
});
}
</script>


</html>