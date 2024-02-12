<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<?php
$getCurrentUrl=service('uri');
$getCurrentUrl_action=$getCurrentUrl->getSegments();
$getCurrentUrlSurveyId=$getCurrentUrl_action[2];
$getCurrentUrlSectorId=$getCurrentUrl_action[3];
//die("Sector Id : ".$u_sectorId." Survey Id :: ".$u_surveyId);
$getLogedInUserDetail=session('admin_detail');
$getLoginUserCity=$getLogedInUserDetail['City'];
$getLoginUserCityId=$getLogedInUserDetail['City_ID'];
$showPageTitle='NIUA | '.getSectorName($getCurrentUrlSectorId).' | '. ucfirst($getLoginUserCity).'-'.$getLoginUserCityId.' | '.getSurveyName($getCurrentUrlSurveyId);
?>
<title><?php echo $showPageTitle; ?></title>
<meta content="" name="description" />
<meta content="" name="keywords" />
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="icon">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/niua/css/daterangepicker.css'); ?>" />

<style>
 @media print {
  @page { size: A4 landscape; padding:1cm; }
  body * { visibility: hidden; }
  #getFilteredQuestions { 
    border:2px solid green;margin:0;left:0;top:0;position:absolute;
    width:calc(100% - 20px);padding:8px; 
  }
  #getFilteredQuestions, #getFilteredQuestions * { visibility: visible; }
}



  #toolbarContainer{
    display: none !important;
  }
  .checked {
  color: #ffd500;
  }
  .fa-star{
    font-size: 25px;
  }
  .rat-star1 {
    padding: 0px 10px;
    display: inline-block;
    color: #ffd500;
  }  

  .range .field .value {
  position: absolute;
  font-size: 18px;
  color: dodgerblue;
  font-weight: 600;
  text-align: center;
}
.total-nu1 .star_end_date{font-size: 14px;padding: 0px;}
.gray-box #file-upload-button{
  display:none;
}
 .value1 .conditional_option_section input {
    width: 3%;
    height: 30px;
    display: inline-block;
    font-size: 11px;
}
.conditional_option_section{
      height: 30px;
    line-height: 30px;
    display: flex;
}
.conditional_option_section .radiotextsty{padding-left: 8px}

 


@media (min-width: 576px){
  #questionDetailModalPopup .modal-dialog {
      max-width: 70%;
      margin-right: auto;
      margin-left: auto;
  }
}

</style>
</head>
<body>
<!-- ======= Header ======= -->
<?php
$headerData=array('question'=>$allQuestion,'cityAnswered'=>$totalAnswered);
?>

<?php echo view('backend/partials/top_header',$headerData); ?>
<!-- End Header -->
<main id="main" class="main">
<div class="row">
  <div class="col-lg-4 col-md-4">
    <div class="pagetitle">
   <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);"><h1><?php echo $surveyName; ?></h1></a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0);"><h1><?php echo $sectorName; ?></h1></a></li>
    <li class="breadcrumb-item active d-none" aria-current="page"><h1>Questions</h1></li>
  </ol>
   </nav>
   <p>
<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
   </div> 
  </div>
  <div class="col-lg-4 col-md-4"></div>
  <div class="col-lg-4 col-md-4">
    <div class="save-part ">
<div class="save-part d-flex">
<div class="d-flex justify-content-center">
  <i style="cursor:pointer; font-size: 25px;" title="Download preview as PDF" class="bi bi-file-earmark-pdf" id="printPage"></i>
  <select class="form-control" id="selectTheme" style="margin-right: 5px;">
    <option value="0">Select Theme</option>
    <option value="Cyan">Cyan</option>
    <option value="LightBlue">LightBlue</option>
    <option value="Aquamarine">Aquamarine</option>
    <option value="Magenta">Magenta</option>
    <option value="Orange">Orange</option>  
  </select>


  <select class="form-control" id="getFilteredQuestion">
    <option value="all">All</option>
    <!-- <option value="completed">Completed</option>
    <option value="pending">Pending</option> -->
    <option value="bookmark">Bookmarks</option>
  </select>

  <div id="google_translate_element"></div>
</div>
</div>
</div>
  </div>
</div>





<div class="pagetitle d-none">

<div class="save-part ">
<div class="save-part d-flex">
<div class="d-flex justify-content-center">
  <i style="cursor:pointer; font-size: 25px;" title="Download preview as PDF" class="bi bi-file-earmark-pdf" id="printPage"></i>
  <select class="form-control" id="selectTheme" style="margin-right: 5px;">
    <option value="0">Select Theme</option>
    <option value="Cyan">Cyan</option>
    <option value="LightBlue">LightBlue</option>
    <option value="Aquamarine">Aquamarine</option>
    <option value="Magenta">Magenta</option>
    <option value="Orange">Orange</option>  
  </select>


  <select class="form-control" id="getFilteredQuestion">
    <option value="all">All</option>
    <!-- <option value="completed">Completed</option>
    <option value="pending">Pending</option> -->
    <option value="bookmark">Bookmarks</option>
  </select>

  <div id="google_translate_element"></div>
</div>
</div>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);"><h1><?php echo $surveyName; ?></h1></a></li>
    <li class="breadcrumb-item"><a href="javascript:void(0);"><h1><?php echo $sectorName; ?></h1></a></li>
    <li class="breadcrumb-item active d-none" aria-current="page"><h1>Questions</h1></li>
  </ol>
</nav>
<p>
<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
</div>


<section class="section dashboard">
<div class="row">
<div class="col-lg-12">
<div class="row">
<div class="col-md-3">         
<div class="card-body2 pb-0">
<h5 class="card-title"> <strong> All SECTORS </strong> </h5>
<ul class="all-sectr-prt1">
<?php
$geturl=service('uri');
$geturi_act=$geturl->getSegments();
$u_surveyId=$geturi_act[2];
$u_sectorId=$geturi_act[3];
//die("Sector Id : ".$u_sectorId." Survey Id :: ".$u_surveyId);
$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City'];
$loginUserRole=$logedInUserDetail['role'];
$loginUserCityId=$logedInUserDetail['City_ID'];
if(isset($allsector) && !empty($allsector)){
foreach ($allsector as $allsectorDetails){
$chk=getSurveySectorQuestions($u_surveyId,$allsectorDetails['Sector_ID']);
if(count($chk)>0){
  $redirect=base_url()."admin/sector-question/".$u_surveyId."/".$allsectorDetails["Sector_ID"];
  $getSectorAllQuestion=getSurveySectorQuestions($u_surveyId,$allsectorDetails["Sector_ID"]);
  $answered=getCityAttemptedQuestions($u_surveyId,$allsectorDetails["Sector_ID"],$loginUserCityId);
?>
<li class="<?php if($u_sectorId==trim($allsectorDetails['Sector_ID'])){ echo "left_menu_active_sector"; } ?>">
  <a href="<?php echo $redirect; ?>">
    <div class="a-s-p-icon"><img src="<?=base_url('assets/niua/img/'.$allsectorDetails['sectorIcon'])?>"></div>
    <div class="a-s-p-text"> 
      <span><?php echo word_limiter($allsectorDetails['Sector'],2); ?></span>
      <progress class="<?php if($u_sectorId==$allsectorDetails["Sector_ID"]){ echo "selectedSectorProgress";} ?>" style="" value="<?php echo $answered; ?>" max="<?php echo count($getSectorAllQuestion); ?>"></progress>
      <div class="val-num1"><span class="<?php if($u_sectorId==$allsectorDetails["Sector_ID"]){ echo "sectorTotalAnswered";} ?>"><?php echo $answered; ?></span>/<?php echo count($getSectorAllQuestion); ?></div> 
    </div>
  </a>
</li>
<?php }}} ?>
</ul>
</div>
</div>



<?php
$today=date("Y-m-d");
//echo "Today :: ".$today." Survey End Date :: ".$surveyEndDate;
$start_dt="";
$end_dt="";
$uri=service('uri');
$geturi=$uri->getSegments();
$surveyId=$geturi[2];
$sectorId=$geturi[3];
//die("Sector Id : ".$sectorId." Survey Id :: ".$surveyId);

$getStatus=getSurveySubmissionStatus($surveyId,$loginUserCityId);
if(!empty($getStatus)){
  $allow="none";
  $openRemark=1;
  $openUploadDocumentPopup=1;
}else if(strtotime($today) > strtotime($surveyEndDate)){
 $allow="none";
 $openRemark=1;
 $openUploadDocumentPopup=1;
}else if(strtotime($surveyStartDate) > strtotime($today)){
 $allow="none";
 $openRemark=1;
 $openUploadDocumentPopup=1;
}else{
  $allow="";
  $openRemark=0;
  $openUploadDocumentPopup=0;
}
?>
<div class="col-md-9" style="pointer-events:<?php echo $allow; ?>;">
<div id="getFilteredQuestions">
<?php
$i=1;
//print_data($allQuestion);
if(isset($allQuestion) && !empty($allQuestion)){
foreach($allQuestion as $allQuestiondetails){
$uomDetail=getQuestionUnitOfMeasurement(trim($allQuestiondetails['UOM_ID']));
$qbId=$allQuestiondetails["QB_ID"];
$getCityAnswer=getAnswer($surveyId,$sectorId,$qbId,$loginUserCityId);
$checkBookmarkQuestion=checkBookmark($surveyId,$sectorId,$qbId,$loginUserCityId);
if(!empty($checkBookmarkQuestion)){
  $bookmarkStatus="bi-star-fill";
}else{
  $bookmarkStatus="bi-star";
}
//print_data($getCityAnswer);
if(!empty($getCityAnswer)){
  //die("Yes");
  $ans=trim($getCityAnswer["Value"]);
}else{
  //die("No");
  $ans="";
}
//echo $ans;
//print_r($uomDetail);
?>
<div class="card-body1 uploadAndRemarks_<?=$surveyId?>_<?=$sectorId?>_<?=$allQuestiondetails["QB_ID"]?> <?php if($ans==""){ echo 'not-submited'; }else{ echo 'submited'; } ?>" data-qb_id="<?=$allQuestiondetails["QB_ID"]?>">
<div class="d-flex">
<div class="card-icon2">
<div class="down-top-er1">
<a href="javascript:void(0);"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="bi <?php echo $bookmarkStatus; ?> addToBookmark"></i></a>
</div>
</div>
<?php if(trim($allQuestiondetails['UOM_ID'])==1){ //Number ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn tooltipBtn" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==2){ //Number In Cr ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==3){ //Number In Rupees  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==4){ //Percentage  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control percentage_niua numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==5){ //Mega Watt Hr  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==6){ //SQ Km  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==7){ //Micro gm/cu.m ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==8){ //Select One Option ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
<span class="checkmark"></span>
</label>
</div>
<?php }}else{ ?>
<div class="form-check-inline col-12">
<label class="customradio">
<span class="radiotextsty">Yes</span>
<input <?php if(str_contains($ans, "Yes")){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="Yes" />
<span class="checkmark"></span>
</label>

<label class="customradio">
<span class="radiotextsty">No</span>
<input <?php if(str_contains($ans, "No")){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="No" />
<span class="checkmark"></span>
</label>
</div>
<?php } ?>
</div>
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==9){ //Km ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" id="km" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==10){ //lpcd ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==11){ //MLD ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==12){ //Number(Score & Rating) ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" maxlength="10" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_score_rating_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==13){ //Number(In Year) ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>"  maxlength="4" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==14){ //Detail ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><textarea qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" rows="3" cols="50" class="form-control validlongtext_niua textBoxInput"><?php echo $ans; ?></textarea>&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==15){ //Number(In Days) ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==16){ //Number(In Meters) ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==17){ //Text ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control validtext_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==18){ //kW ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==19){ //kWh ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==20){ //kl ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==21){ //Sq.m ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==22){ //Ratio ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control valid_ratio_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==23){ //Persons Per Sq KM ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==24){ //Public Transport Unit (PTU) per 1000 people ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly PTO_niua_validate textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==25){ //Select Multiple ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="checkbox">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $allQuestiondetails["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }} ?>
</div>
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==27){ //Rating ?>
<div class="total-nu11 ps-3 col-lg-9">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="mt-2">
<span class="rat-star1"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" data-value="1" style="cursor: pointer;" data-starIndex="1" class="ratingUOM bi <?php if($ans>=1){echo "bi-star-fill";}else{echo "bi-star";} ?>"></i></span> 
<span class="rat-star1"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" data-value="2" style="cursor: pointer;" data-starIndex="2" class="ratingUOM bi <?php if($ans>=2){echo "bi-star-fill";}else{echo "bi-star";} ?>"></i></span> 
<span class="rat-star1"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" data-value="3" style="cursor: pointer;" data-starIndex="3" class="ratingUOM bi <?php if($ans>=3){echo "bi-star-fill";}else{echo "bi-star";} ?>"></i></span> 
<span class="rat-star1"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" data-value="4" style="cursor: pointer;" data-starIndex="4" class="ratingUOM bi <?php if($ans>=4){echo "bi-star-fill";}else{echo "bi-star";} ?>"></i></span>
<span class="rat-star1"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" data-value="5" style="cursor: pointer;" data-starIndex="5" class="ratingUOM bi <?php if($ans>=5){echo "bi-star-fill";}else{echo "bi-star";} ?>"></i></span>

</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==28){ //Audio
$audio_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $audiofile=base_url('assets/uploads/').$ans; ?><a href="<?php echo $audiofile; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="audio_note question_note" style=""><b>Note :</b> Allowded extensions : <?php echo $audio_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==29){ //Video
$video_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $videofile=base_url('assets/uploads/').$ans; ?><a href="<?php echo $videofile; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="video_note question_note" style=""><b>Note :</b> Allowded extensions : : <?php echo $video_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==30){ //File
$file_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);

?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $fileInput=base_url('assets/uploads/').$ans; ?><a href="<?php echo $fileInput; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="file_note question_note" style=""><b>Note :</b> Allowded extensions : <?php echo $file_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==31){ //Date With Range
$dt_range=$ans;
if($ans!="" && str_contains($ans, ':')){
 $dt_range=explode(":",$ans);
 //print_data($dt_range);
 if(!empty($dt_range)){ 
   $start_dt=$dt_range[0];
   $end_dt=$dt_range[1];
   //echo "Start :: ".$start_dt." End Date :: ".$end_dt;
 }else{
  $start_dt="";
  $end_dt="";
}
}else{
  $start_dt="";
  $end_dt="";
}
?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="d-flex dateRangeSection">
<div class="value checkRangeDetailsData"><span class="star_end_date">Start</span><input value="<?php echo $start_dt; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control sdate seprateDateRange" placeholder="Select start date"></div>

<div class="value checkRangeDetailsData px-4"><span class="star_end_date">End</span><input value="<?php echo $end_dt; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control edate seprateDateRange" placeholder="Select End date"></div>
</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==32){ //Date With Time
if($ans!=""){ 
  $ex_DateWithTime=explode(" ",$ans);
  $selectedDate=$ex_DateWithTime[0];
  if(array_key_exists(1,$ex_DateWithTime)){
    $selectedTime=$ex_DateWithTime[1];
  }else{
    $selectedTime='';
  }
}else{
  $ex_DateWithTime=array();
  $selectedDate='';
  $selectedTime='';
}
//print_r($ex_DateWithTime);
if($selectedTime!=""){
   $ex_DateWithTimeInput=explode(":",$selectedTime); 
   $get_DateWithTime_hour=$ex_DateWithTimeInput[0];
   $get_DateWithTime_min=$ex_DateWithTimeInput[1];
   $get_DateWithTime_ampm=$ex_DateWithTimeInput[2];
}else{
   $get_DateWithTime_hour=1;
   $get_DateWithTime_min=0;
   $get_DateWithTime_ampm="";
}
?>
<div class="total-nu1 ps-2 DateWithTimeSection">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value">


<input readonly value="<?php echo $selectedDate; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control dateWithTime" placeholder="Select date">

<div class="inputTimeSection">
<select class="form-control DateTimeHourInput" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>">
  <?php for($hour=1; $hour<=12; $hour++){ ?>
  <option <?php if($get_DateWithTime_hour==$hour){ echo "selected"; } ?> value="<?php echo $hour; ?>"><?php echo $hour; ?></option>
 <?php } ?>
</select>

<select class="form-control DateTimeMinInput" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>">
  <?php for($min=0; $min<=59; $min++){ ?>
  <option <?php if($get_DateWithTime_min==$min){ echo "selected"; } ?>  value="<?php echo $min; ?>"><?php echo $min; ?></option>
 <?php } ?>
</select>

<select style="width:auto;" class="form-control am_pm_selection DateTimeAmPmInput" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>">
  <option <?php if($get_DateWithTime_ampm=="AM"){ echo "selected"; } ?> value="AM">AM</option>
  <option <?php if($get_DateWithTime_ampm=="PM"){ echo "selected"; } ?> value="PM">PM</option>
</select>

</div>
</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==33){ //Date ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value">
  <input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" readonly type="text" class="form-control dateinput" placeholder="Select date">
</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==34){ //E-mail ?>
<div class="total-nu1 ps-2">
<span class="questiontitle "><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="Email" class="form-control textBoxInput  validemail_niua" placeholder="Enter e-mail">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==35){ //Range
$range_options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<main class="cd__main">
<div class="range">
  <div class="sliderValue">
    <span class="rangeSelectedValue">0</span>
  </div>
  <div class="field">
    <div class="value left"><?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?></div>
      <div class="value" style="width:100%" >
        <input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="rangeInput" type="range" min="<?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?>" max="<?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?>" value="<?php echo $ans; ?>" steps="1">
        <span class="selectedValue"><?php echo $ans; ?></span>
      </div>
    <div class="value right"><?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?></div>
  </div>
</div>
</main>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==36){ //Select Multiple Priority ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="checkbox rankingContainer">

<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if($ans!=""){ 
  $order="Rank order :: ";
  $ex_priority_quest=explode(",",$ans);
  if(!empty($ex_priority_quest)){    
    foreach($ex_priority_quest as $selectedOptionkey => $selectedOptionValue) {
      if($selectedOptionkey==0){
        $order.=($selectedOptionkey+1)."=>".trim($selectedOptionValue);
      }else{
        $order.=", ".($selectedOptionkey+1)."=>".trim($selectedOptionValue)."";
      }
      
    }
  }
}else{
  $order="";
  $ex_priority_quest=array();
}
echo '<p class="prioritySelectionOrder" style="font-size:11px;">'.$order.'</p>';
// print_r($ex_priority_quest);
// echo "<script type='text/javascript'>";
// echo "var priorityQuestion_[".$allQuestiondetails["QB_ID"]."]=".json_encode($ex_priority_quest);
// echo "</script>";
if(!empty($options)){
foreach($options as $priorityOptionKey=>$option_detail){
?>
<div class="form-check-inline col-12 multiSelectPrioritySection">
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> value="<?php echo trim($option_detail["options"]); ?>" data-arr='<?php echo implode(",",$ex_priority_quest); ?>'  qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="form-check-input multiSelectPriority" type="checkbox" name="checkbox_options_<?php echo $allQuestiondetails["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?> <span class="priorityCircle optionkey_<?=$priorityOptionKey?>" style="display: none; font-size: 20px;  font-weight: bold;"></span>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }} ?>
</div>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==42){ //Parent Child Conditional ?>
<div class="total-nu1 ps-2 ParentChildConditionalList">
<span class="questiontitle "><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


<div class="value1 ParentChildConditionalCls">
<div class="yes_no  <?=(trim($ans) !='')?'':'noParentChildSelection'?>">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input <?php if(trim($ans)==trim($option_detail["options"])){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="ChildQuestionListDataShow parent_child_conditional_option" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" id="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
<span class="checkmark"></span>
</label>
</div>
<?php } ?>
</div> 
<?php
if($allQuestiondetails['child_questions']!=''){
  $childQuestionsArray = json_decode($allQuestiondetails['child_questions']);
}else{
  $childQuestionsArray = [];
}

if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
?>
<div class="ps-2" id="ParentQuestionOptionData_<?=$allQuestiondetails['QB_ID']?>_<?=preg_replace('/[^a-zA-Z0-9_\[\]\\\-]/s', '',$keyOption)?>" style="display: none;">
<?php if(!empty($childQuestion)){
$child_i=1;
foreach($childQuestion as $qkey =>$child){
$getChildAnswer=getAnswer($surveyId,$sectorId,$child,$loginUserCityId,$allQuestiondetails["QB_ID"],$ans);
//print_r($getChildAnswer);
if(!empty($getChildAnswer)){
  $childAnswer=trim($getChildAnswer["Value"]);
}else{
  $childAnswer="";
}
$childDetail = getQuestionDetail($child);
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion cycle1">
<span class="questiontitle"><?php echo $i.".".$child_i." : ".$childDetail["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){
foreach($parent_child_options as $get_parent_child_option_detail){
?>
<div class="conditional_option_section">
<input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?> parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
<span class="radiotextsty"><?php echo ucfirst($get_parent_child_option_detail["options"]); ?></span>
</div>
<?php }}} ?>
</div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php $child_i++;}} ?>
</div>
<?php }} ?>
</div>
<?php } ?>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==43){ //Parent Child ?>
<div class="total-nu1 ps-2 ParentChildConditionalList">
<span class="questiontitle "><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
if($allQuestiondetails['sub_question']!=''){
  $childQuestionsArray = json_decode($allQuestiondetails['sub_question']);
}else{
  $childQuestionsArray = [];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
$getChildAnswer=getAnswer($surveyId,$sectorId,$childQuestion,$loginUserCityId,$allQuestiondetails["QB_ID"]);
//print_r($getChildAnswer);
if(!empty($getChildAnswer)){
  $childAnswer=trim($getChildAnswer["Value"]);
}else{
  $childAnswer="";
}
?>
<div class="ps-2" >
<?php if(!empty($childQuestion)){
$childDetail = getQuestionDetail($childQuestion);
$childchildDetail=getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
//echo $childchildDetail["UOM_ID"];
?>
<div class="show_childQuestion cycle1">
<span class="questiontitle"><?= $i.'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


<div class="value1">
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){
foreach($parent_child_options as $get_parent_child_option_detail){
?>
<div class="conditional_option_section">
<input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?> parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
<span class="radiotextsty"><?php echo ucfirst($get_parent_child_option_detail["options"]); ?></span>
</div>
<?php }}} ?>
</div>


<span class="error_msg err" style="color: red;"></span>
</div>
<?php } ?>
</div>
<?php }} ?>
</div>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==41){$q_matrix=base_url('assets/uploads/').$ans; //Question Matrix ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>

<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control question_matrix_fileInput"><?php if($ans!=""){ ?><a href="<?php echo $q_matrix; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="question_note" style=""><b>Note :</b> Allowded extensions : xlx,xlsx</span>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==39){$barcode=base_url('assets/uploads/').$ans; //Barcode ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control barcode_fileInput"><?php if($ans!=""){ ?><a href="<?php echo $barcode; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="question_note" style=""><b>Note :</b> Allowded extensions : pdf, png, jpg</span>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==40){ //Acknowledgement ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1 acknowledgement_checkbox_sec"><input <?php if($ans!=""){ echo "checked";} ?> class="acknowledgement_checkbox" type="checkbox">&nbsp;&nbsp;<input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" value="<?php echo $ans; ?>" class="form-control acknowledgement_input" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==37){ //Time
if($ans!=""){ 
  $ex_time=explode(":",$ans);
}else{
  $ex_time=array();
}
if(!empty($ex_time)){ 
   $get_hour=$ex_time[0];
   $get_second=$ex_time[1];
   $get_ampm=$ex_time[2];
}else{
   $get_hour=1;
   $get_second=0;
   $get_ampm="";
} 
?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="inputTimeSection">
<select class="form-control timeInput Timehour" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>">
  <?php for($hour=1; $hour<=12; $hour++){ ?>
  <option <?php if($get_hour==$hour){ echo "selected"; } ?> value="<?php echo $hour; ?>"><?php echo $hour; ?></option>
 <?php } ?>
</select>

<select class="form-control timeInput Timesecond" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>">
  <?php for($sec=0; $sec<=59; $sec++){ ?>
  <option <?php if($get_second==$sec){ echo "selected"; } ?> value="<?php echo $sec; ?>"><?php echo $sec; ?></option>
 <?php } ?>
</select>

<select style="width:auto;" class="form-control am_pm_selection timeInput" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>">
  <option value="">Select AM/PM</option>
  <option <?php if($get_ampm=="AM"){ echo "selected"; } ?> value="AM">AM</option>
  <option <?php if($get_ampm=="PM"){ echo "selected"; } ?> value="PM">PM</option>
</select>

</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php }else if(trim($allQuestiondetails['UOM_ID'])==38){ //Decimal/Float ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control valid_decimal_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php }else if(trim($allQuestiondetails['UOM_ID'])==44){ //Calculated Question
  if(!empty($getCityAnswer)){
    $calculatedFirstValue=trim($getCityAnswer["calculation_value1"]);
    $calculatedSecondValue=trim($getCityAnswer["calculation_value2"]);
  }else{
    $calculatedFirstValue="";
    $calculatedSecondValue="";
  }
?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1 calculatedQuestionSection">
<span class="questiontitle">Result:&nbsp;&nbsp;</span><input value="<?php echo $ans; ?>" class="form-control calculatedQuestionAnswer" style="pointer-events: none;width: 60px;height: 22px;" type="text" readonly oncopy="return false" onpaste="return false">
<?php
if($allQuestiondetails['sub_question']!=''){
  $childQuestionsArray=json_decode($allQuestiondetails['sub_question']);
}else{
  $childQuestionsArray=[];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
if(!empty($childQuestion)){
$childDetail=getQuestionDetail($childQuestion);
?>
<div>
<span class="questiontitle"><?= $i.'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php if(($keyOption+1)==1){echo $calculatedFirstValue;}else{ echo $calculatedSecondValue;} ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="numberOnly form-control calculatedQuestionTextBoxInput calculatedQuestionInput_<?=$keyOption+1?>" oncopy="return false" onpaste="return false" placeholder="<?php echo $childDetail["question_placeholder"]; ?>" data-calculation_action="<?php echo $allQuestiondetails["calculation_type"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }}} ?>

</div>
</div>
<?php } ?> 
<div class="remove-2">
<div class="rem mb-1">
<button data-action="<?php echo $openRemark; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" style="visibility: <?php if($allQuestiondetails["question_comment"]!=0){ echo "visible"; }else{ echo "hidden"; } ?>; pointer-events:all; cursor: pointer;" type="button" class="btn btn-primary new-button-2 addQuestionRemark" id="remarkViewButton"> <i class="bi bi-chat-left-text-fill" ></i><?php echo $allQuestiondetails["question_comment"]; ?></button>

<button data-action="<?php echo $openUploadDocumentPopup; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" style="visibility: <?php if($allQuestiondetails["question_document"]!=0){ echo "visible"; }else{ echo "hidden"; } ?>; pointer-events:all; cursor: pointer;" type="button" class="btn btn-primary new-button-2 uploadQuestionDocument" id="uploadsViewButton"><i class="bi bi-files"></i><?php echo $allQuestiondetails["question_document"]; ?></button>

</div>

<div class="rem" style="pointer-events:all;">
<?php
if(!empty($allQuestiondetails["question_template"])){
$questionTemplate=base_url('assets/uploads/templateFiles/').$allQuestiondetails["question_template"];
?>
<a href="<?php echo $questionTemplate; ?>" download><i style="cursor: pointer;" title="Download template" class="bi bi-download"></i></a>
<?php } ?>

<?php if(trim($allQuestiondetails['UOM_ID'])==39 || $allQuestiondetails['UOM_ID']==41){ $q_matrix=base_url('assets/uploads/').$allQuestiondetails['question_matrix_barcode']; ?>
<a href="<?php echo $q_matrix; ?>" download><i style="cursor: pointer;" title="Download file" class="bi bi-file-earmark-arrow-down-fill"></i></a>
<?php } ?>

<button data-action="<?php echo $openRemark; ?>" type="button" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="btn btn-primary new-but1 addQuestionRemark"><i class="bi bi-chat-right-text-fill"></i>&nbsp;Remark</button>

<button data-action="<?php echo $openUploadDocumentPopup; ?>" type="button" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="btn btn-primary new-but1 uploadQuestionDocument"><i class="bi bi-cloud-arrow-up"></i>&nbsp;Upload</button>
</div>

</div>
</div>
</div>
<?php $i++;}}else{ ?>
  <p class="text-center mt-6" style="color:red;">No question found in this sector!</p>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</section>


<!-- Question Detail Popup -->
<div class="modal fade model-wid1" id="questionDetailModalPopup" tabindex="-1" aria-labelledby="questionDetail" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="questionDetail">Question Detail</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<table class="table table-bordered">
  <thead class="thead-light">
    <th>Year</th>
    <th>Source</th>
    <th>UOM</th>
    <th>Description</th>
    <th>Supporting Document</th>
  </thead>
  <tbody class="table" id="questionDetailRow">
            
  </tbody>
</table>
</div>
</div>
</div>
</div>
<!-- Question Detail Popup -->


<!-- Remark Popup -->
<div class="modal fade model-wid1" id="remarkModalPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="exampleModalLabel">Remark</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div>

</div>
<div class="mb-2">
<textarea class="form-control" id="question_remark" placeholder="Enter your remark" rows="5"></textarea>
<span class="error_msg remark_err" style="color: red;"></span> 
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary saveQuestionRemarkBtn" question="">Submit</button>
</div>
</div>
</div>
</div>
<!-- End Remark popup -->

<!-- File Upload Popup -->
<div class="modal fade model-wid1" id="fileUploadModalPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Upload Files</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="form-horizontal" name="addQuestionDoc"  id="addQuestionDoc" enctype="multipart/form-data">
<div class="modal-body">
<div class="gray-box">
  <div class="image-upload">
    <input id="qdoc_file" name="qdoc_file" type="file" class="questionDocument">
    <label for="qdoc_file"><img title="Click here for browse" src="<?php echo base_url('assets/niua/img/upload-icon.svg'); ?>"></label>
    <div class="file-name1" id="file-upload-filename"></div>     
  </div>
<div class="col-12 text-content">
  <span class="col-12 txt">Click here for browse</span>
  <span class="col-12 txt">Supported Files .pdf, .doc, xls, .xlsx, .shp</span>
  <span class="col-12 txt">Max file size can not be more than 10 MB</span>
  <span class="col-12 txt"><b>Note : </b> You can upload upto 4 documents</span>
</div>
</div>
<div class="upld-status">
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col" class="">Document</th>
      <th class="text-center" scope="col">Download</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="allQuestionDocument" data-survey_id="" data-sector_id='' data-qb_id="">
      
  </tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary cancel2" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary cancel2 saveQuestionDocumentBtn" question="">Upload</button>
</div>
</form>
</div>
</div>
</div>
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/form-validation.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/daterangepicker.min.js'); ?>"></script>
<script>
  $(document).on('click','.ratingUOM', function(){
    var startIndex = $.trim($(this).attr('data-starIndex'));
    var totalLength = $(this).parents('.mt-2').find('.ratingUOM');
    $.each(totalLength,function(i,star){
      if(i+1 <= startIndex ){
        $(star).addClass('bi-star-fill');
        $(star).removeClass('bi-star');
      }else{
        $(star).removeClass('bi-star-fill');
        $(star).addClass('bi-star');
      }
    })

  });
</script>


<script type="text/javascript">
    function showServerErrorMessage() {
        $("#server-error").modal('show');
    }
</script>

<script>
  var dtRange='<?php echo $ans; ?>'
  $(function(){
    $(".dateWithTime").datepicker({
      dateFormat:'dd-mm-yy',
      changeMonth:true,
      changeYear:true,
      yearRange: "c-100:c+100" 
    });

    $(".dateinput").datepicker({
      dateFormat:'dd-mm-yy',
      changeMonth:true,
      changeYear:true,
      yearRange: "c-100:c+100" 
    });

    
    $(".seprateDateRange").datepicker({
      dateFormat:'dd-mm-yy',
      changeMonth:true,
      changeYear:true 
    });

  });
</script>


<script>
  $(document).on('click', '.remark', function(){

    Swal.fire({
    title: 'Enter Your Remark',
    input: 'textarea',
    confirmButtonText: 'Submit',
    showCancelButton: true,
    allowOutsideClick: false,
    customClass: {
    validationMessage: 'my-validation-message'
    },
    }).then(function(result) {
    if(result.value) {
       Swal.fire(result.value);
    }else{
       Swal.fire({icon: 'error', title: ' Please enter your remark!'});
    }
    });

  });
</script>

<script>
  $(document).on('click', '.fileupload', function(){

   Swal.fire({
    title: 'Upload File',
    input: 'file',
    confirmButtonText: 'Submit',
    showCancelButton: true,
    allowOutsideClick: false,
    customClass: {
    validationMessage: 'my-validation-message'
    },
    }).then(function(result) {
    if(result.value) {
       Swal.fire(result.value);
    }else{
       Swal.fire({icon: 'error', title: ' Please select a file!'});
    }
    });

  });
</script>

<script>
$('.numberOnly').keypress(function(e) {
  // if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    showToast('error','Please enter numeric values!')
      return false;
    }
  if(isNaN(this.value+""+String.fromCharCode(e.charCode || event.which)))
   return false;
});



$('.decimalOnly').keypress(function(e) {
  // if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    showToast('error','Please enter numeric values!')
      return false;
    }
  if(isNaN(this.value+""+String.fromCharCode(e.charCode || event.which)))
   return false;
});



$('.alphaOnly').keypress(function(e) {
var regex = new RegExp("^[a-zA-Z 0-9_-]+$");
var str=String.fromCharCode(!e.charCode ? e.which : e.charCode);
//alert(str);
if(regex.test(str)){
return true;
}
return false;
});
</script>

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
function saveQuestion(surveyId,sectorId,qbId,answer){

    if(surveyId!="" && sectorId!="" && qbId!=""){
          $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/question-answer',
          data: {'qb_id':qbId,'ans':answer,'survey_id':surveyId,'sector_id':sectorId, 'cycle':'first'},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            
            if(response.status==1){
              if(answer!=''){
                $(".surveySectorAllAnsweredQues").val(response.totalAnswered);            
                $(".sectorTotalAnswered").text(0);
                $(".sectorTotalAnswered").text(response.totalAnswered);
                $(".selectedSectorProgress").val(response.totalAnswered);
                $('.uploadAndRemarks_'+surveyId+'_'+sectorId+'_'+qbId).removeClass('not-submited').addClass('submited');
              }
              showToast('success',response.msg);
              
            }else{
              showToast('error',response.msg);
            }
          }
          });
    }
}


$(".textBoxInput").blur(function(){
  // return false
   var questionId=$(this).attr('qb-id').trim();
   var questionAnswer=$(this).val().trim();
   var survey='<?php echo trim($surveyId) ?>';
   var sector='<?php echo trim($sectorId) ?>';

   if($(this).hasClass('Not_ValidaFormData')){
    return false;
   }
   //alert(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
   if(questionId!="" && survey!=""  && sector!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
   }
});

/*Parent Child Conditional Options */
$(document).on('change','.parent_child_conditional_option',function(){
    var thisElement = $(this);
    var questionId=$(this).attr('qb-id').trim();
    var questionAnswer=$(this).val().trim();
    var selectedOption=questionAnswer;
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
      if(questionId!="" && survey!=""  && sector!=""){
          $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/child_question_previous_option_delete',
          data: {'option':selectedOption,'qb_id':questionId,'ans':questionAnswer,'survey_id':survey,'sector_id':sector, 'cycle':'first'},
          dataType: "json",
          success: function(response){
              //console.log(response);
              if(questionId!="" && survey!=""  && sector!=""){
                  saveQuestion(survey,sector,questionId,questionAnswer);
              }            
          }
          });          
      }
});
/*Parent Child Conditional Options */


/* Radio Input */
$(document).on('change','.radioInput',function(){
   var questionId=$(this).attr('qb-id').trim();
   var questionAnswer=$(this).val().trim();
   var survey='<?php echo trim($surveyId) ?>';
   var sector='<?php echo trim($sectorId) ?>';
   //alert(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
   if(questionId!="" && survey!=""  && sector!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
   }
});


/* Time Input */
$(document).on('change','.timeInput',function(){
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  var questionId=$(this).attr('qb-id');
  var hour=$(this).parents('.inputTimeSection').find('.Timehour').val();
  var second=$(this).parents('.inputTimeSection').find('.Timesecond').val();
  var am_pm_selection=$(this).parents('.inputTimeSection').find('.am_pm_selection').val();

  if(hour!="" && second!="" && am_pm_selection!=""){  
      var questionAnswer=`${hour}:${second}:${am_pm_selection}`;
     //alert(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
     if(questionId!="" && survey!=""  && sector!=""){
        saveQuestion(survey,sector,questionId,questionAnswer);     
     }
  }
});
/* End Time Input */


/* Acknowledge Input */
$(document).on('blur','.acknowledgement_input',function(){
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  var questionId=$(this).attr('qb-id');
  var questionAnswer=$(this).val().trim();
  var chkbox_checked=$(this).parents('.acknowledgement_checkbox_sec').find('.acknowledgement_checkbox').is(":checked");
  //console.log(chk);
  if(chkbox_checked){
    //alert(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
     if(questionId!="" && survey!=""  && sector!=""){
        saveQuestion(survey,sector,questionId,questionAnswer);      
     }
  }
});
/* End Acknowledge Input */

/* Child Question Input */
//$(".childTextBoxInput").blur(function(){
$(document).on('blur, change','.childTextBoxInput',function(){
   var parent_questionId=$(this).attr('parent-qb_id').trim();
   var questionId=$(this).attr('qb-id').trim();
   var questionAnswer=$(this).val().trim();
   var survey='<?php echo trim($surveyId) ?>';
   var sector='<?php echo trim($sectorId) ?>';
   var selectedOption=$(this).parents('.ParentChildConditionalCls').find('.ChildQuestionListDataShow:checked').val();
   //console.log(`Parent QB-Id :: ${parent_questionId}, QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}, Selected Option :: ${selectedOption}`);
   if(survey!="" && sector!="" && parent_questionId!="" && questionId!=""){
          $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/child-question-answer',
          data: {'option':selectedOption,'parent_qb_id':parent_questionId, 'qb_id':questionId,'ans':questionAnswer,'survey_id':survey,'sector_id':sector, 'cycle':'first'},
          dataType: "json",
          success: function(response){
            //console.log(response);            
            if(response.status==1){
              if(questionAnswer!=''){
                $(".surveySectorAllAnsweredQues").val(response.totalAnswered);            
                $(".sectorTotalAnswered").text(0);
                $(".sectorTotalAnswered").text(response.totalAnswered);
                $(".selectedSectorProgress").val(response.totalAnswered);
                $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).removeClass('not-submited').addClass('submited');
              }
              showToast('success',response.msg);              
            }else{
              showToast('error',response.msg);
            }
          }
          });
        }
});
/* End Child Question Input */



/* Ranking Input */
$(document).on('change','.multiSelectPriority',function(){
    var selectedVal=$(this).val();
    var allSelected=$(this).attr('data-arr');
    if($(this).is(':checked')){ // When Check
        var question_priority=[];
        if(question_priority.length==0){
          if(allSelected!=""){
            var createArr=allSelected.split(',');
            $(createArr).each(function(i,v){
                 if(!question_priority.includes(v)){
                 question_priority.push(v);
                 }
            });
           }
        }
        question_priority.push(selectedVal);
        //console.log(question_priority);
        //console.log(`question_priority ${question_priority}`);
        $(this).parents('.rankingContainer').find('.multiSelectPriority').attr("data-arr",question_priority);

        /* Update Message */
        var checkedMsg="Rank order :: ";
        //if(question_priority.length!=0){
          $.each(question_priority,function(checkedIndex,checkedIndexValue){
             if(checkedIndex===0){
              checkedMsg+=`${(checkedIndex+1)}=>${checkedIndexValue}`;
            }else{
               checkedMsg+=`, ${(checkedIndex+1)}=>${checkedIndexValue}`;
            }
          })
          $(this).parents('.rankingContainer').find('.prioritySelectionOrder').html(checkedMsg);
        //}
      }else{ // When UnCheck
        var question_priority=[];
        if(question_priority.length==0){
           if(allSelected!=""){
            var createArr2=allSelected.split(',');
            $.each(createArr2,function(j,k){
              //console.log(k ,' value on index'+j)
                 if(!question_priority.includes(k)){
                    question_priority.push(k);
                 }
            });
           }   
        }
        question_priority=question_priority.filter(function(s) { return s !== selectedVal})
        // question_priority.remove(selectedVal);
        //console.log(question_priority);
        //console.log(`question_priority ${question_priority}`);
        $(this).parents('.rankingContainer').find('.multiSelectPriority').attr("data-arr",question_priority);
        /* Update Message */
        var msg="Rank order :: ";
        //if(question_priority.length!=0){
          $.each(question_priority,function(index,indexValue){
            if(index===0){
              msg+=`${(index+1)}=>${indexValue}`;
            }else{
               msg+=`, ${(index+1)}=>${indexValue}`;
            }
          })
          $(this).parents('.rankingContainer').find('.prioritySelectionOrder').html(msg);
        //}
      }

      var questionId=$(this).attr('qb-id').trim();
      var questionAnswer=question_priority.toString();
      var survey='<?php echo trim($surveyId) ?>';
      var sector='<?php echo trim($sectorId) ?>';
      //alert(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
      if(questionId!="" && survey!=""  && sector!=""){
         saveQuestion(survey,sector,questionId,questionAnswer);      
      }

});
/* End Ranking Input */



/* Checkbox Input */
var checkboxAllOptions=[];
//console.log(checkboxAllOptions,' check priority question')
$(document).on('change','.multiSelect',function(){
  var qbid= $(this).attr('qb-id').trim();
  //var arr=`priorityQuestion_${qbid}`;
  //console.log(`priorityQuestion_[${qbid}]`);

  if($(this).prop('checked')){ // Selected
      var checkedCheckBoxes=$(this).parents('.checkbox').find(':checkbox:checked');
      //alert(checkedCheckBoxes.length);
      var addItem=$(this).val().trim();
      checkboxAllOptions.push(addItem);
  } else { // Deselect
       var removeItem=$(this).val().trim();
       checkboxAllOptions.splice( $.inArray(removeItem, checkboxAllOptions), 1 );
  }
  //console.log(`${checkboxAllOptions.toString()}`);
  var questionId=$(this).attr('qb-id').trim();
  var questionAnswer=checkboxAllOptions.toString();
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  //alert(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
  if(questionId!="" && survey!=""  && sector!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
  }
});

/*Rating Input*/
$(document).on('click','.ratingUOM',function(){
  var questionId=$(this).attr('qb-id').trim();
  var questionAnswer=$(this).attr('data-value').trim();
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  //console.log(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
  if(questionId!="" && survey!=""  && sector!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
  }
});


/* Date Input */
$(document).on('change','.dateinput',function(){
  var questionId=$(this).attr('qb-id').trim();
  var questionAnswer=$(this).val().trim();
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  // console.log(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
  // return false;
  if(questionId!="" && survey!=""  && sector!="" && questionAnswer!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
  }
});

$(document).on('change','.dateWithTime',function(){
  var questionId=$(this).attr('qb-id').trim();
  var selectedDate=$(this).val().trim();
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  var hour=$(this).parents('.DateWithTimeSection').find('.DateTimeHourInput').val();
  var min=$(this).parents('.DateWithTimeSection').find('.DateTimeMinInput').val();
  var am_pm=$(this).parents('.DateWithTimeSection').find('.DateTimeAmPmInput').val();
  var questionAnswer=`${selectedDate} ${hour}:${min}:${am_pm}`;
  //console.log(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}, Date :: ${selectedDate}, Hour :: ${hour}, Min :: ${min}, Am_Pm :: ${am_pm}`);
  //return false;
  if(questionId!="" && survey!=""  && sector!="" && questionAnswer!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
  }
});

$(document).on('change','.dateRange',function(){
  return false;
  var questionId=$(this).attr('qb-id').trim();
  var questionAnswer=$(this).val().trim();
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  // console.log(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
  // return false;
  if(questionId!="" && survey!=""  && sector!="" && questionAnswer!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
  }
});

$(document).on('change','.seprateDateRange',function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    var start_date=$(this).parents('.dateRangeSection').find('.sdate').val();
    var end_date=$(this).parents('.dateRangeSection').find('.edate').val();

    if($(this).hasClass('sdate')){
      $(this).parents('.dateRangeSection').find('.edate').val(start_date);
    }

    $(this).parents('.dateRangeSection').find('.edate').datepicker("option", "minDate", start_date);
    var questionAnswer=`${start_date}:${end_date}`;
    if((start_date!="" && end_date!="") && start_date!=end_date){
        if(questionId!="" && survey!=""  && sector!="" && questionAnswer!=""){
           saveQuestion(survey,sector,questionId,questionAnswer);      
        }
    }
});



</script>

<script>
$(document).on('change','.rangeInput',function(){
  var thisElement = $(this);
  var maxvalue = $.trim($(thisElement).attr('max'));
  //console.log(maxvalue,'maxvalue')
  const slideValue=$(this).parents('.range').find(".rangeSelectedValue");
  let value = $(this).val();
  slideValue.text(value);
  $(thisElement).parent().find('.selectedValue').text(value);
  slideValue.css('margin-left',((value / maxvalue)*100) + "%")
  slideValue.addClass("show");
  var questionId=$(this).attr('qb-id').trim();
  var questionAnswer=$(this).val().trim();
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  //console.log(`QB-Id :: ${questionId}, Answer :: ${questionAnswer}, Sector :: ${sector}, Survey :: ${survey}`);
  if(questionId!="" && survey!=""  && sector!=""){
      saveQuestion(survey,sector,questionId,questionAnswer);      
  }
  
});
$(document).on('blur','.rangeInput',function(){
   $(this).parents('.range').find(".rangeSelectedValue").removeClass("show");
});
</script>




<script type="text/javascript">
/* File Upload */
$(document).on('change', '.fileInput', function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    //alert(`QB-Id :: ${questionId}, Sector :: ${sector}, Survey :: ${survey}`);
    //On change event  
    formdata=new FormData();
    if($(this).prop('files').length>0){
        file=$(this).prop('files')[0];
        formdata.append("uploadedFile", file);
        formdata.append("questionId", questionId);
        formdata.append("survey", survey);
        formdata.append("sector", sector);
        formdata.append("cycle", 'first');
        //Ajax Call
        $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/upload-file',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response){
            //console.log(response);
            var data=$.parseJSON(response);  //Return JSON data.            
            if(data.status==1){
              $(".sectorTotalAnswered").text(0);
              $(".sectorTotalAnswered").text(data.totalAnswered);
              $(".selectedSectorProgress").val(data.totalAnswered);
              if(file!=""){
                $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).removeClass('not-submited').addClass('submited');
              }
               showToast('success',data.msg);
            }else{
               showToast('error',data.msg);
            }
        }
        });
    }
}); 


//Barcode File Upload...
$(document).on('change', '.barcode_fileInput', function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    //alert(`QB-Id :: ${questionId}, Sector :: ${sector}, Survey :: ${survey}`);
    //On change event  
    formdata=new FormData();
    if($(this).prop('files').length>0){
        file=$(this).prop('files')[0];
        formdata.append("uploadedFile", file);
        formdata.append("questionId", questionId);
        formdata.append("survey", survey);
        formdata.append("sector", sector);
        formdata.append("cycle", 'first');
        formdata.append("type", 'barcode');
        //Ajax Call
        $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/barcode-questionmatrix-upload-file',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response){
            //console.log(response);
            var data=$.parseJSON(response);  //Return JSON data.            
            if(data.status==1){
              $(".sectorTotalAnswered").text(0);
              $(".sectorTotalAnswered").text(data.totalAnswered);
              $(".selectedSectorProgress").val(data.totalAnswered);
              if(file!=""){
                $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).removeClass('not-submited').addClass('submited');
              }
               showToast('success',data.msg);
            }else{
               showToast('error',data.msg);
            }
        }
        });
    }
});

//Question Matrix File Upload...
$(document).on('change', '.question_matrix_fileInput', function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    //alert(`QB-Id :: ${questionId}, Sector :: ${sector}, Survey :: ${survey}`);
    //On change event  
    formdata=new FormData();
    if($(this).prop('files').length>0){
        file=$(this).prop('files')[0];
        formdata.append("uploadedFile", file);
        formdata.append("questionId", questionId);
        formdata.append("survey", survey);
        formdata.append("sector", sector);
        formdata.append("cycle", 'first');
        formdata.append("type", 'questionMatrix');
        //Ajax Call
        $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/barcode-questionmatrix-upload-file',
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response){
            //console.log(response);
            var data=$.parseJSON(response);  //Return JSON data.            
            if(data.status==1){
              $(".sectorTotalAnswered").text(0);
              $(".sectorTotalAnswered").text(data.totalAnswered);
              $(".selectedSectorProgress").val(data.totalAnswered);
              if(file!=""){
                $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).removeClass('not-submited').addClass('submited');
              }
               showToast('success',data.msg);
            }else{
               showToast('error',data.msg);
            }
        }
        });
    }
});
</script>

<script>
  $(document).on('click','.btn-close,.btn-secondary',function(){
  $('#question_remark').val('');
  $('#qdoc_file').val('');
  $('#file-upload-filename').text('');
});
</script>

<script>
  $(document).on("click",".addQuestionRemark", function(){
    var chkAction=$(this).attr('data-action').trim();
    //alert(chkAction);
    if(chkAction==1){ //Submitted Survey
      $('#remarkModalPopup').find('.saveQuestionRemarkBtn').hide();
    }

    $(".remark_err").text("");
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    $(".saveQuestionRemarkBtn").attr("question",questionId);
    $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/get-question-remark',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            $("#question_remark").val(response.remark);
            $('#remarkModalPopup').modal('toggle');            
          }
          });    
  });
</script>


<script>
  $(document).on("click",".saveQuestionRemarkBtn", function(){
     $(".remark_err").text("");
     var ele = $(this);
     var questionId=$(this).attr('question').trim();
     var remark=$("#question_remark").val().trim();
     var survey='<?php echo trim($surveyId) ?>';
     var sector='<?php echo trim($sectorId) ?>';
     if(remark==""){
       $("#question_remark").focus();
       $(".remark_err").text("Please enter your remark!");
       return false;
     }
     $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/add-remark',
          data: {'qb_id':questionId,'rem':remark,'survey_id':survey,'sector_id':sector,'cycle':'first'},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);            
            if(response.status==1){
              $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#remarkViewButton').css('visibility','visible');
              $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#remarkViewButton').html('<i class="bi bi-chat-left-text-fill" ></i>1');
              showToast('success',response.msg);
              $(ele).parent().find('.btn-secondary').trigger('click');
            }else{
              showToast('error',response.msg);
            }
          }
          });
  });
</script>

<script>  
  $(document).on("click",".uploadQuestionDocument", function(){
    var chkAction=$(this).attr('data-action').trim();
    //alert(chkAction);
    if(chkAction==1){ //Submitted Survey
      $('#fileUploadModalPopup').find('.saveQuestionDocumentBtn').hide();
      $('#fileUploadModalPopup').find('.cancel1').hide();
    }
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    $(".saveQuestionDocumentBtn").attr("question",questionId);
    //Get Previous Documents...
    $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/get-question-documents',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            $("#allQuestionDocument").html(response.html);
            $("#allQuestionDocument").attr('data-survey_id',response.survey_id);
            $("#allQuestionDocument").attr('data-sector_id',response.sector_id);
            $("#allQuestionDocument").attr('data-qb_id',response.qb_id);
            $('#fileUploadModalPopup').modal('toggle');           
          }
          });

    
  });
</script>

<script type="text/javascript">
$(document).on('click', '.saveQuestionDocumentBtn', function(e){
   var ele = $(this);
    var questionId=$(this).attr('question').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    var file=$("#qdoc_file").val();
    if(questionId!="" && file!=""){
    var action_uri='<?php echo base_url('admin/save-question-document'); ?>';
    var formData=new FormData($('#addQuestionDoc')[0]);
    formData.append('qb_id', questionId);
    formData.append('sector_id', sector);
    formData.append('survey_id', survey);
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
            $('#saveQuestionDocumentBtn').html('Processing ...');
            $('#saveQuestionDocumentBtn').prop('disabled',true);
            $('#saveQuestionDocumentBtn').css('cursor', 'wait');
        },
        complete: function(){
            $('#saveQuestionDocumentBtn').html('Upload');
            $('#saveQuestionDocumentBtn').prop('disabled',false);
            $('#saveQuestionDocumentBtn').css('cursor', '');
        },
        success: function(response){
            console.log(response);
            // totalFilesCount
            if(response.status==1){

              $("#qdoc_file").val('')
              $("#file-upload-filename").text('')

              $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#uploadsViewButton').css('visibility','visible');
              $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#uploadsViewButton').html('<i class="bi bi-files"></i>'+response.totalFilesCount);

              if(response.reQuiredFile==1){
                triggerDataSaveFunction('uploadAndRemarks_'+survey+'_'+sector+'_'+questionId);
              }





              // code to be done for question attepmted




              showToast('success',response.msg);
              $("#addQuestionDoc")[0].reset();
              $("#allQuestionDocument").html(response.html);
              $(ele).parent().find('.btn-secondary').trigger('click');
            }else{
              showToast('error',response.msg);
            }      
        }
    });
}else{
 showToast('error','Please select a document!'); 
}
});
</script>


<script>
  function deleteQuestionDocument(document_id,survey,sector,questionId){

    Swal.fire({
       icon: "question",     
       type: 'question',
       text: 'Are you sure, you want to delete this document permanently?',
       showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/delete-question-document',
            data: {'id':document_id,'survey_id':survey,'cycle':'first'},
            dataType: "json",
            beforeSend: function(){
            //$('.loadingSectionMainForm').show();
            },
            complete: function(){
            //$('.loadingSectionMainForm').hide();
            },
            success: function(response){
              if(response.status==1){
                showToast('success',response.msg);
                $("#allQuestionDocument").html(response.html);
                if(response.totalFilesCount > 0){

                  $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#uploadsViewButton').css('visibility','visible');


                  $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#uploadsViewButton').html('<i class="bi bi-files"></i>'+response.totalFilesCount);

                }else{
                  $('.uploadAndRemarks_'+survey+'_'+sector+'_'+questionId).find('#uploadsViewButton').css('visibility','hidden');
                }
              }else{
                showToast('error',response.msg);
              }
            }
        });
      } 
    });
  }
</script>


<script>
  $(document).on('click','.addToBookmark',function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    if($(this).hasClass('bi-star-fill')){ // Checked
       $(this).removeClass('bi-star-fill');
       $(this).addClass('bi-star');
       //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/add-bookmark-question',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector,'action':'remove'},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            if(response.status==1){
              showToast('success',response.msg);
            }else{
              showToast('error',response.msg);
            }
          }
          });
    }else{ // Not Checked
       //alert('Not Checked');
       $(this).removeClass('bi-star');
       $(this).addClass('bi-star-fill');
       //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/add-bookmark-question',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector,'action':'add'},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            if(response.status==1){
              showToast('success',response.msg);
            }else{
              showToast('error',response.msg);
            }
          }
          });
    }
  });
</script>


<script>
  $('#getFilteredQuestion').change(function() {
    var filter=$(this).val().trim();
    var survey='<?php echo trim($surveyId) ?>';
    var sector='<?php echo trim($sectorId) ?>';
    //alert(filter);
    //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/survey-filter-question',
          data: {'getfilter':filter,'survey_id':survey,'sector_id':sector},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            $("#getFilteredQuestions").html("");
            $("#getFilteredQuestions").html(response.html);

            
            $(".dateWithTime").datepicker({
            dateFormat:'dd-mm-yy',
            changeMonth:true,
            changeYear:true,
            yearRange: "c-100:c+100" 
            });

            $(".dateinput").datepicker({
            dateFormat:'dd-mm-yy',
            changeMonth:true,
            changeYear:true,
            yearRange: "c-100:c+100" 
            });


          }
          });



});
</script>

<script>
  $("#sectorDropdown").change(function(){
    var sector=$(this).val().trim();
    var survey='<?php echo $u_surveyId; ?>';
    var url='<?php echo base_url(); ?>';
    var redirectUrl=`${url}admin/sector-question/${survey}/${sector}`;
    window.location.href=redirectUrl;
  });
</script>

<script>
  var input=document.getElementById('qdoc_file');
  var infoArea=document.getElementById('file-upload-filename');
  input.addEventListener('change', showFileName );
  function showFileName(event){ 
    var input=event.srcElement; 
    var fileName=input.files[0].name; 
    infoArea.textContent=fileName;
  }
</script>

<script>
    $('.onlyNumberRequired').keypress(function (e) {      
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    showToast('error','Please enter numeric values!')
      return false;
    } 
    var charCode = (e.which) ? e.which : event.keyCode    
    if (String.fromCharCode(charCode).match(/[^0-9]/g))    
        return false;                        
     });    
</script>


<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages : 'hi,en,ta-IN,bn,mr-IN,pa,te-IN,'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<script>
  function questionDetail(qbId){
    $("#questionDetailRow").html("");    
    if(qbId!=""){
      //alert(`Question :: ${qbId}`);
      $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/get-question-detail',
          data: {'question':qbId},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            
          },
          success: function(response){
            //console.log(response);            
            $("#questionDetailRow").html(response.detail);
            $('#questionDetailModalPopup').modal('toggle');
          }
          });              
    }
  }
</script>


<script>  


  $('#selectTheme').change(function() {
    var color=$(this).val().trim();
    if(color!='' && color!=0){
      localStorage.setItem("themeColor",color);
      $('#main').css('background-color', `${color}`);
    }else{
      localStorage.setItem("themeColor",'');
      $('#main').removeAttr('style');
    }
  });


$(document).on('click','.ChildQuestionListDataShow',function(){
  var this_ChilD_Div_Value = $(this).val();
  //var this_ChilD_Div_Value2 = this_ChilD_Div_Value.replace(/[ ]/g,'');
  var this_ChilD_Div_Value2 = this_ChilD_Div_Value.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');

  var qb_id = $(this).parents('.card-body1').attr('data-qb_id');
  var elementData = $(this).parents('.value1').find('.ps-2');
  $.each(elementData,function(i,childdiv){
    if($(childdiv).attr('id') == 'ParentQuestionOptionData_'+qb_id+'_'+this_ChilD_Div_Value2){
      $(childdiv).show();
    }else{
      $(childdiv).hide();
    }
  })
})


$(document).ready(function(){
  var colorOftheme =  localStorage.getItem("themeColor").trim();
  if(colorOftheme!='' && colorOftheme!=0){
    $('#main').css('background-color', `${colorOftheme}`);
    $('#selectTheme').find('option')
    $("#selectTheme").val(colorOftheme);
  }else{
    $('#main').css('background-color', '');
  }




  var questionCard = $('.card-body1').find('.ChildQuestionListDataShow');
  $.each(questionCard,function(i,card){
    if($(card).is(':checked')){
      var qb_id = $(card).attr('qb-id');
      var checkedValue = $(card).val();
      var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
      $('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).show();
    }else{
      var qb_id = $(card).attr('qb-id');
      var checkedValue = $(card).val();
      var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
      $('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).hide();
    }
  })
})
</script>



<script>
$(document).on('blur','.calculatedQuestionTextBoxInput',function(){
  var survey='<?php echo trim($surveyId) ?>';
  var sector='<?php echo trim($sectorId) ?>';
  var questionId=$(this).attr('qb-id').trim();
  var parent_questionId=$(this).attr('parent-qb_id').trim();
  var operation=$(this).attr('data-calculation_action').trim();
  var input1=$(this).parents('.calculatedQuestionSection').find('.calculatedQuestionInput_1').val().trim();
  var input2=$(this).parents('.calculatedQuestionSection').find('.calculatedQuestionInput_2').val().trim();
  input1=(input1)?input1:0;
  input2=(input2)?input2:0;
  if(operation=="add"){
    var questionAnswer=0;
    var operationPerform="+";
    var questionAnswer=(parseFloat(input1) + parseFloat(input2));
  }else if(operation=="sub"){
    var questionAnswer=0;
    var operationPerform="-";
      if(parseFloat(input2)>parseFloat(input1)){
        showToast('info','First input value should greater then second input value!');
        $(this).parents('.calculatedQuestionSection').find('.calculatedQuestionAnswer').val('');
         return false;
      }
      if(input1 !='' && input2!=''){
        var questionAnswer=(parseFloat(input1) - parseFloat(input2));
      }else{
        $(this).parents('.calculatedQuestionSection').find('.calculatedQuestionAnswer').val('');
      }
      
  }else if(operation=="mul"){
    var questionAnswer=0;
    var operationPerform="*";
    var questionAnswer=(parseFloat(input1) * parseFloat(input2));
  }else if(operation=="div"){
    //console.log(`v1 ${input1}, v2 ${input2} `);
    var questionAnswer=0;
    var operationPerform="/";
    if(parseFloat(input2)>parseFloat(input1)){
      showToast('info','First input value should greater then second input value!');
      $(this).parents('.calculatedQuestionSection').find('.calculatedQuestionAnswer').val('');
       return false;
    }
    if(input1 !='' && input2!=''){
      var questionAnswer=(parseFloat(input1) / parseFloat(input2));
    }else{
      $(this).parents('.calculatedQuestionSection').find('.calculatedQuestionAnswer').val('');
    }
  }else if(operation=="per"){
    var questionAnswer=0;
    var operationPerform="/";
    // if(parseFloat(input2)>parseFloat(input1)){
    //   showToast('info','First input value should greater then second input value!');
    //    return false;
    // }
    var questionAnswer=(parseFloat(input1) / parseFloat(input2))*100;
    var questionAnswer=questionAnswer.toFixed(3);
  } 
  $(this).parents('.calculatedQuestionSection').find('.calculatedQuestionAnswer').val(questionAnswer); 
  //console.log(`Parent QB-Id :: ${parent_questionId}, QB-Id :: ${questionId}, Sector :: ${sector}, Survey :: ${survey}, Operation :: ${operation}, input1 :: ${input1}, input2 :: ${input2}, Answer :: ${questionAnswer}`);

  if(input1!="" && input2!=""){
      $.ajax({
      type:'POST',
      url: '<?php echo base_url(); ?>admin/calculated-question-answer',
      data: {'qb_id':parent_questionId,'ans':questionAnswer,'survey_id':survey,'sector_id':sector, 'cycle':'first', 'input1':input1, 'input2':input2, 'operation':operation},
      dataType: "json",
      success: function(response){
          //console.log(response);
          if(response.status==1){
              if(input1!="" && input2!=""){
                $(".surveySectorAllAnsweredQues").val(response.totalAnswered);            
                $(".sectorTotalAnswered").text(0);
                $(".sectorTotalAnswered").text(response.totalAnswered);
                $(".selectedSectorProgress").val(response.totalAnswered);
                $('.uploadAndRemarks_'+survey+'_'+sector+'_'+parent_questionId).removeClass('not-submited').addClass('submited');
              }
              showToast('success',response.msg);              
            }else{
              showToast('error',response.msg);
            }                      
      }
      });
  }
});



function triggerDataSaveFunction(className){
  if($('.'+className).find('.timeInput').length){
    $('.'+className).find('.timeInput').trigger('change');
  }

  if($('.'+className).find('.radioInput').length){
    $('.'+className).find('.radioInput').trigger('change');
  }

  if($('.'+className).find('.parent_child_conditional_option').length){
    $('.'+className).find('.parent_child_conditional_option').trigger('change');
  }

  if($('.'+className).find('.dateinput').length){
    $('.'+className).find('.dateinput').trigger('change');
  }

  if($('.'+className).find('.dateWithTime').length){
    $('.'+className).find('.dateWithTime').trigger('change');
  }

  if($('.'+className).find('.dateRange').length){
    $('.'+className).find('.dateRange').trigger('change');
  }

  if($('.'+className).find('.seprateDateRange').length){
    $('.'+className).find('.seprateDateRange').trigger('change');
  }
  if($('.'+className).find('.rangeInput').length){
    $('.'+className).find('.rangeInput').trigger('change');
  }

  if($('.'+className).find('.fileInput').length){
    $('.'+className).find('.fileInput').trigger('change');
  }

  if($('.'+className).find('.barcode_fileInput').length){
    $('.'+className).find('.barcode_fileInput').trigger('change');
  }

  if($('.'+className).find('.textBoxInput').length){
    $('.'+className).find('.textBoxInput').trigger('blur');
  }

  if($('.'+className).find('.acknowledgement_input').length){
    $('.'+className).find('.acknowledgement_input').trigger('blur');
  }

  if($('.'+className).find('.calculatedQuestionTextBoxInput').length){
    $('.'+className).find('.calculatedQuestionTextBoxInput').trigger('blur');
  }


}
</script>
<script>
  $("#printPage").click(function(){
    //$("#main").print();
    //return( false );
    window.print();
    // var divToPrint=document.getElementById("main");
    // newWin= window.open("");
    // newWin.document.write(divToPrint.outerHTML);
    // newWin.print();
    // newWin.close();
  });
</script>
</body>
</html>
