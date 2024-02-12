<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title> NIUA | Dashboard </title>
<meta content="" name="description">
<meta content="" name="keywords">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="icon">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/niua/css/daterangepicker.css'); ?>" />
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<style>
  
#toolbarContainer{
  display: none !important;
}
.range .field .value {
  position: absolute;
  font-size: 18px;
  color: dodgerblue;
  font-weight: 600;
  text-align: center;
}
.validatorActiveSector{
  background-color: #717ff5;
  border: 1px solid #000;
}
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(<?php echo base_url('assets/uploads/loader.gif'); ?>) center no-repeat #3a3939;
    opacity: .7;
}
.cancel1{display: none !important;}

.resubmitted {
    border-left: 5px solid #ffd15f;
    padding-bottom: 0px !important;
}

.revertedByValidator{
  cursor: pointer;
}


.show_childQuestion .remove-2 {
    float: right;
    margin-top: -4%;
}

.show_childQuestion .remove-2 .rem {
    float: initial;;
}
.card-body1.submited .nav-item.dropdown{position: relative;}
.card-body1.submited .nav-item.dropdown .dropdown-menu.show {transform:initial !important;top:34px !important;}
.card-body1.submited .total-nu4 {float: left;width: 60%;}
.card-body1.submited .remove-2 .rejt-1 {float: right;display: flex;width: auto;padding-bottom: 10px;}
.show_childQuestion .col-md-6.show_childsquestn{width: 100% !important;}
.value1 .conditional_option_section input { display: inline-block; width:5%;height:20px; position:relative; line-height:13px; top:10px; }
.show_childQuestion .value1 .row{margin: 0px;}
.remove-2 .rejt-1 {float: right;width: 100%;display: inline-flex;}
.allRejectAndApprove{display: flex;}
.allRejectAndApprove .nav-item.dropdown.pe-3 .dropdown-menu-arrow.profile.show{
  inset: inherit !important;
  transform: inherit !important;
}

</style>
</head>
<body>
<?php echo view('backend/partials/top_header.php'); ?>
<!-- ======= Sidebar ======= -->

<main id="main" class="main">
<div class="pagetitle">
    <p>
<a href="<?=base_url('admin/dashboard')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<?php echo $title; ?>
<div class="valid-qust1">
<!-- <div class="progress prg1" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
<div class="progress-bar w-75"></div>
</div> -->
<progress class="top_progress" style="" value="<?php echo $total_validated; ?>" max="<?php echo count($totalQuestions); ?>"></progress>
<p>Validated <span class="validatedCnt"><?php echo $total_validated; ?></span>&nbsp;/&nbsp;<?php echo count($totalQuestions); ?> Question</p> </div>
<div class="save-part">

<select class="form-select" aria-label="Default select example" id="filter_validator_question">
<option value="">Select a filter</option>
<option value="notAttempt">Not Validated</option>
<option value="bookmark">Bookmarked</option>
<option value="approved">Approved</option>
<option value="rejected">Rejected</option>
<option value="revert">Revert with comment</option>
</select>
</div>
</div>
<!-- End Page Title -->
<section class="section dashboard">
<div class="row">
<div class="col-lg-3">         
  <!-- Budget Report -->
    <div class="card-body2 pb-0">
      <h5 class="card-title"> <strong> All SECTORS </strong> </h5>
      <ul class="all-sectr-prt1">
        <?php
          $uri=service('uri');
          $geturi=$uri->getSegments();
          $url_cityUserId=$geturi[2];
          $url_sectorId=trim($geturi[3]);
          $url_survey=trim($geturi[4]);
          $logedInUserDetail=session('admin_detail');
          $loginUserCity=$logedInUserDetail['City'];
          $loginUserRole=$logedInUserDetail['role'];
          $loginUserCityId=$logedInUserDetail['City_ID'];
          $loginUserId=$logedInUserDetail['user_id'];

          if(isset($allsector) && !empty($allsector)){
          foreach($allsector as $allsectorDetails){
            $getsec=$allsectorDetails["Sector_ID"];
            $getSectorAllQuestion=getSurveySectorQuestions($surveyId,$getsec);
            $validated=getValidatedQuestionsInSector($url_survey,$getsec,$city,1);
            $redirect=base_url()."admin/city-questions/".$url_cityUserId."/".$getsec."/".$url_survey;
        ?>
        <li class="<?php if($url_sectorId==$getsec){ echo "left_menu_active_sector"; } ?>">
          <a href="<?php echo $redirect; ?>">
            <div class="a-s-p-icon"><img src="<?=base_url('assets/niua/img/'.$allsectorDetails['sectorIcon'])?>"></div>
            <div class="a-s-p-text  updateSectorListCount_<?=$getsec?>"> 
              <span><?php echo word_limiter($allsectorDetails['Sector'],2); ?></span>
              <progress style="" value="<?php echo $validated; ?>" max="<?php echo count($getSectorAllQuestion); ?>"></progress>
              <div class="val-num1 "><span class="validatedCnt"><?php echo $validated; ?></span>&nbsp;/&nbsp;<?php echo count($getSectorAllQuestion); ?></div>
            </div>
          </a>
        </li>
        <?php }} ?>
      </ul>                
    </div>
</div>
<div class="col-lg-9">
<div class="row">
  <div class="col-md-12">
    <div class="selet-del-1">
        <div class="form-check check-1">
          <input class="form-check-input" type="checkbox" value="" id="selectAll">
          <label class="form-check-label" for="selectAll">Select All</label>
        </div>
          <div class="rejt-1 allRejectAndApprove">
            <button id="approveAll" type="button" class="btn btn-primary new-but1 remark px-2"><i class="bi bi-check-lg"></i> Approve </button>

            <span class="nav-item dropdown pe-3 px-2">
              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <button id="" type="button" class="btn btn-primary new-but1 fileupload"> <i class="bi bi-x"></i> Reject </button>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">
              <li class="">
              <a class="dropdown-item d-flex align-items-center" id="rejectAll" data-value="NA" href="#">
              <span>NA</span>
              </a>
              </li>
              <li class="">
              <a class="dropdown-item d-flex align-items-center" id="rejectAll" data-value="N/A" href="#">
              <span>N/A</span>
              </a>
              </li>
              <li class="">
              <a class="dropdown-item d-flex align-items-center" id="rejectAll" data-value="NF" href="#">
              <span>NF</span>
              </a>
              </li>
              </ul>
            </span>










          </div>
          <div class="all-no1 val-pad2">
            <ul>
              <li class="countFilter" data-val="approved" style="">Approved &nbsp;<span class="val-col2 approvedCnt"><?php echo $total_aproved; ?></span></li>
              <li class="countFilter" data-val="rejected" style="">Rejected &nbsp;<span class="val-col3 rejectedCnt"><?php echo $total_rejected; ?></span></li>
              <li class="countFilter" data-val="revertWithCmt" style="">Revert with comment &nbsp;<span class="val-col4 revertWithCommentCnt"><?php echo $total_revert_with_comment; ?></span></li>
            </ul>
          </div>
    </div>
  </div>
<?php if($chkvalidated==1 && $v2_status != 2){ ?>
<div class="alert alert-warning" role="alert">Validated & sent to validator-2. You will not able to change any content post send to validator-2.</div>
<?php } ?>
<div class="sales-card" id="questionContainer">
<div class="se-pre-con" style="display: none;"></div>  
<?php
$i=1;
//print_data($allQuestion);
if(isset($allQuestion) && !empty($allQuestion)){
foreach($allQuestion as $allQuestiondetails){
$uomDetail=getQuestionUnitOfMeasurement(trim($allQuestiondetails['UOM_ID']));
$qbId=$allQuestiondetails["QB_ID"];
$getCityAnswer=getAnswer($surveyId,$sectorId,$qbId,$city);
$checkBookmarkQuestion=checkValidatorBookmark($surveyId,$sectorId,$qbId,$getcityUserId,$loginUserId);
if(!empty($checkBookmarkQuestion)){
$bookmarkStatus="bi-star-fill clr2";
}else{
$bookmarkStatus="bi-star";
}

if(!empty($getCityAnswer)){

$ans=trim($getCityAnswer["Value"]);
}else{

$ans="";
}

?>
<div class="card-body1 <?php if($allQuestiondetails['validator_action']==0 && $allQuestiondetails['validator_2_status']==3){ echo 'resubmitted'; }else{ echo 'submited'; } ?>  checkForChangeInStatusForRevert_<?=$allQuestiondetails['QB_ID'] ?>" parent_qb_id="<?=$allQuestiondetails['QB_ID'] ?>" >
<div class="d-flex">
<div class="card-icon2 mt-2">
  <div class="down-top-er1"> 
    <input class="form-check-input questionSelection" type="checkbox" value="<?php echo trim($allQuestiondetails["QB_ID"]); ?>">
  </div>
  <div class="down-top-er2 mt-2">
   <a href="javascript:void(0);"><i class="bi <?php echo $bookmarkStatus; ?> addToBookmark" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>"></i></a>
  </div>
</div>
<?php if(trim($allQuestiondetails['UOM_ID'])==1){ //Number ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==2){ //Number In Cr ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==3){ //Number In Rupees  ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==4){ //Percentage  ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==5){ //Mega Watt Hr  ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==6){ //SQ Km  ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==7){ //Micro gm/cu.m ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==8){ //Select One Option ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<label class="customradio" style="pointer-events: none;">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
<span class="checkmark"></span>
</label>
</div>
<?php }}else{ ?>
<div class="form-check-inline col-12">
<label class="customradio" style="pointer-events: none;">
<span class="radiotextsty">Yes</span>
<input <?php if(str_contains($ans, "Yes")){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="Yes" />
<span class="checkmark"></span>
</label>

<label class="customradio" style="pointer-events: none;">
<span class="radiotextsty">No</span>
<input <?php if(str_contains($ans, "No")){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="No" />
<span class="checkmark"></span>
</label>
</div>
<?php } ?>
</div>
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==9){ //Km ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==10){ //Ipcd ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==11){ //MLD ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==12){ //Number(Score & Rating) ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==13){ //Number(In Year) ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==14){ //Detail ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><textarea readonly qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" rows="3" cols="50" class="form-control textBoxInput"><?php echo $ans; ?></textarea>&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==15){ //Number(In Days) ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==16){ //Number(In Meters) ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==17){ //Text ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==18){ //kW ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==19){ //kWh ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==20){ //kl ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==21){ //Sq.m ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==22){ //Ratio ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==23){ //Persons Per Sq KM ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==24){ //Public Transport Unit (PTU) per 1000 people ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==25){ //Select Multiple ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="checkbox">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12" style="pointer-events:none;">
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $allQuestiondetails["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }} ?>
</div>
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==27){ //Rating ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="mt-2" style="pointer-events: none;">
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
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $audiofile=base_url('assets/uploads/').$ans; ?><a href="<?php echo $audiofile; ?>" download><i title="Download File" class="fa fa-download mt-2"></i></a><?php } ?></div>
<span class="audio_note question_note" style=""><b>Note :</b> Allowded extensions : <?php echo $audio_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==29){ //Video
$video_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $videofile=base_url('assets/uploads/').$ans; ?><a href="<?php echo $videofile; ?>" download><i title="Download File" class="fa fa-download mt-2"></i></a><?php } ?></div>
<span class="video_note question_note" style=""><b>Note :</b> Allowded extensions : : <?php echo $video_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==30){ //File
$file_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);

?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $fileInput=base_url('assets/uploads/').$ans; ?><a href="<?php echo $fileInput; ?>" download><i title="Download File" class="fa fa-download mt-2"></i></a><?php } ?></div>
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
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="d-flex dateRangeSection">
<div class="value checkRangeDetailsData"><span class="star_end_date">Start</span><input style="pointer-events: none;" value="<?php echo $start_dt; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control sdate seprateDateRange" placeholder="Select start date"></div>

<div class="value checkRangeDetailsData px-4"><span class="star_end_date">End</span><input style="pointer-events: none;" value="<?php echo $end_dt; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control edate seprateDateRange" placeholder="Select End date"></div>
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
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value">


<input style="pointer-events: none;" readonly value="<?php echo $selectedDate; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control dateWithTime" placeholder="Select date">

<div class="inputTimeSection mb-2 mt-2" style="pointer-events: none;">
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
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value">
<input style="pointer-events: none;" value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" readonly type="text" class="form-control dateinput" placeholder="Select date">
</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==34){ //E-mail ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input style="pointer-events: none;" value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="Email" class="form-control textBoxInput" placeholder="Enter e-mail">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==35){ //Range
$range_options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<main class="cd__main">
<div class="range">
<div class="sliderValue">
<span class="rangeSelectedValue">0</span>
</div>
<div class="field">
<div class="value left"><?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?></div>
<div class="value" style="width:100%" >
<input style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="rangeInput" type="range" min="<?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?>" max="<?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?>" value="<?php echo $ans; ?>" steps="1">
<span class="selectedValue"><?php echo $ans; ?></span>
</div>
<div class="value right"><?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?></div>
</div>
</div>
</main>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==36){ //Select Multiple Priority ?>
<div class="total-nu4 ps-3">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="checkbox">
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
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12" style="pointer-events: none;">
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $allQuestiondetails["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }} ?>
</div>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==42){ //Parent Child Conditional ?>
<div class="total-nu1 ps-2">
<span class="questiontitle "><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


<div class="value1 ParentChildConditionalCls">
<div class="yes_no">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline " style="pointer-events: none;">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input <?php if(trim($ans)==trim($option_detail["options"])){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="ChildQuestionListDataShow radioInput" type="radio" name="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" id="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
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
$getChildAnswer=getAnswer($surveyId,$sectorId,$child,$city,$allQuestiondetails["QB_ID"],$ans);
// print_r($getChildAnswer);
if(!empty($getChildAnswer)){
  $childAnswer=trim($getChildAnswer["Value"]);
}else{
  $childAnswer="";
}
$childDetail = getQuestionDetail($child);
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion">
  <div class="down-top-er1"> 
    <input class="form-check-input questionSelection" type="checkbox" value="<?php echo trim($childDetail["QB_ID"]); ?>">
  </div>
<span class="questiontitle"><?php echo $i.".".$child_i." : ".$childDetail["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
  <div class="row">
      
        
      

<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input readonly oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input readonly oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){ ?>
  <div class="col-md-6">
    <?php
foreach($parent_child_options as $get_parent_child_option_detail){
?>
  
    <div class="conditional_option_section" style="pointer-events:none;">
    <input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?> parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
    <span class="radiotextsty"><?php echo ucfirst($get_parent_child_option_detail["options"]); ?></span>
    </div>
  
<?php } ?> </div>
<?php }

} ?>



<div class="col-md-6 show_childsquestn">
  <div class="remove-2  childQuestionDivOptions" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>">
    <div class="rem">
      <?php
       if(!empty($getChildAnswer) && $getChildAnswer['validator_2_status']==1){ ?>
        <span style="background-color: #d9fae9; color: #5aba87;border: 1px solid #5aba87;" class="dem-but2a" href="javascript:void(0);">Approved by V2</span>
      <?php }else if(!empty($getChildAnswer) && $getChildAnswer['validator_2_status']==2){ ?>
        <span style="background-color: #FDECEB;color: #F26C63;border: 1px solid #F26C63;" class="dem-but2a" href="javascript:void(0);">Rejected by V2</span>
      <?php }else if(!empty($getChildAnswer) && $getChildAnswer['validator_2_status']==3){ ?>
        <span style="color: #121211;background-color: #f1b915a1;border: 1px solid #df991a;" class="dem-but2a revertedByValidator" href="javascript:void(0);">Revert with comment by V2</span>
      <?php }?>
    </div>         
    <div class="rejt-1" id="updateV2Status_<?=$surveyId?>_<?=$sectorId?>_<?=$child?>">
   
    <button type="button" class="btn btn-primary new-but1 approveQuestion <?=(!empty($getChildAnswer) && $getChildAnswer['validator_1_status']==1)?'bg-success':''?>" qb-id="<?=$child?>"><i class="bi bi-check-lg"></i>Approve</button>


<span class="nav-item dropdown pe-3" style="position:relative;">
  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    <button type="button" class="btn btn-primary new-but1 rejectButtonClassToBeUpdated <?=(!empty($getChildAnswer) && $getChildAnswer['validator_1_status']==2)?'bg-danger':''?>" qb-id="<?=$child?>"><i class="bi bi-x"></i>Reject</button>
</a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="NA" qb-id="<?=$child?>" href="#">
<span>NA</span>
</a>
</li>
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="N/A" qb-id="<?=$child?>" href="#">
<span>N/A</span>
</a>
</li>
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="NF" qb-id="<?=$child?>" href="#">
<span>NF</span>
</a>
</li>
</ul>
</span>





    <button type="button" class="btn btn-primary new-but1 openRevertWithCommentPopup <?=(!empty($getChildAnswer) && $getChildAnswer['validator_1_status']==3)?'bg-warning':''?>" qb-id="<?=$child?>"> 
    <i class="bi bi-chat-right-text-fill"></i>&nbsp;Revert with Comment</button>
    </div>
</div>
</div>



</div>

<span class="error_msg err" style="color: red;"></span>







</div>
</div>
<?php $child_i++;}} ?>
</div>
<?php }} ?>
</div>
<?php } ?>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==43){ //Parent Child ?>
<div class="total-nu1 ps-2">
<span class="questiontitle "><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
if($allQuestiondetails['sub_question']!=''){
  $childQuestionsArray = json_decode($allQuestiondetails['sub_question']);
}else{
  $childQuestionsArray = [];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
$getChildAnswer=getAnswer($surveyId,$sectorId,$childQuestion,$city,$allQuestiondetails["QB_ID"]);
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
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion">
  <div class="down-top-er1"> 
    <input class="form-check-input questionSelection" type="checkbox" value="<?php echo trim($childDetail["QB_ID"]); ?>">
  </div>
<span class="questiontitle"><?= $i.'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
  <div class="row">
    
      
   
  
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input readonly oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input readonly oncopy="return false" onpaste="return false" value="<?php echo $childAnswer; ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){ ?>
  <div class="col-md-6">
   <?php
foreach($parent_child_options as $get_parent_child_option_detail){
?>

<div class="conditional_option_section" style="pointer-events:none;">
<input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?> parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
<span class="radiotextsty"><?php echo ucfirst($get_parent_child_option_detail["options"]); ?></span>
</div>
 
<?php } ?>
</div>
<?php }} ?>

<div class="col-md-6 show_childsquestn">
<div class="remove-2  childQuestionDivOptions" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>">
    <div class="rem">
      <?php
       if(!empty($getChildAnswer) && $getChildAnswer['validator_2_status']==1){ ?>

        <span style="background-color: #d9fae9; color: #5aba87;border: 1px solid #5aba87;" class="dem-but2a" href="javascript:void(0);">Approved by V2</span>
        
      <?php }else if(!empty($getChildAnswer) && $getChildAnswer['validator_2_status']==2){ ?>
        <span style="background-color: #FDECEB;color: #F26C63;border: 1px solid #F26C63;" class="dem-but2a" href="javascript:void(0);">Rejected by V2</span>

      <?php }else if(!empty($getChildAnswer) && $getChildAnswer['validator_2_status']==3){ ?>
        <span style="color: #121211;background-color: #f1b915a1;border: 1px solid #df991a;" class="dem-but2a revertedByValidator" href="javascript:void(0);">Revert with comment by V2</span>
      <?php }?>
    </div>         
    <div class="rejt-1" id="updateV2Status_<?=$surveyId?>_<?=$sectorId?>_<?=$childDetail["QB_ID"]?>">
   
    <button type="button" class="btn btn-primary new-but1 approveQuestion <?=(!empty($getChildAnswer) && $getChildAnswer['validator_1_status']==1)?'bg-success':''?>" qb-id="<?=$childDetail["QB_ID"]?>"><i class="bi bi-check-lg"></i>Approve</button>

<span class="nav-item dropdown pe-3">
  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    <button type="button" class="btn btn-primary new-but1 rejectButtonClassToBeUpdated <?=(!empty($getChildAnswer) && $getChildAnswer['validator_1_status']==2)?'bg-danger':''?>" qb-id="<?=$childDetail["QB_ID"]?>"><i class="bi bi-x"></i>Reject</button>
</a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="NA" qb-id="<?=$childDetail["QB_ID"]?>" href="#">
<span>NA</span>
</a>
</li>
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="N/A" qb-id="<?=$childDetail["QB_ID"]?>" href="#">
<span>N/A</span>
</a>
</li>
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="NF" qb-id="<?=$childDetail["QB_ID"]?>" href="#">
<span>NF</span>
</a>
</li>
</ul>
</span>





    <button type="button" class="btn btn-primary new-but1 openRevertWithCommentPopup <?=(!empty($getChildAnswer) && $getChildAnswer['validator_1_status']==3)?'bg-warning':''?>" qb-id="<?=$childDetail["QB_ID"]?>"> 
    <i class="bi bi-chat-right-text-fill"></i>&nbsp;Revert with Comment</button>
    </div>
</div>
</div>
</div>
<span class="error_msg err" style="color: red;"></span>
</div>
</div>
<?php } ?>
</div>
<?php }} ?>
</div>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==41){$q_matrix=base_url('assets/uploads/').$ans; //Question Matrix ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>

<div class="value"><input style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control question_matrix_fileInput"><?php if($ans!=""){ ?><a href="<?php echo $q_matrix; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="question_note" style=""><b>Note :</b> Allowded extensions : xlx,xlsx</span>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==39){$barcode=base_url('assets/uploads/').$ans; //Barcode ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control barcode_fileInput"><?php if($ans!=""){ ?><a href="<?php echo $barcode; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a><?php } ?></div>
<span class="question_note" style=""><b>Note :</b> Allowded extensions : pdf, png, jpg</span>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }elseif(trim($allQuestiondetails['UOM_ID'])==40){ //Acknowledgement ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1 acknowledgement_checkbox_sec"><input style="pointer-events: none;" <?php if($ans!=""){ echo "checked";} ?> class="acknowledgement_checkbox" type="checkbox">&nbsp;&nbsp;<input readonly style="pointer-events: none;" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" value="<?php echo $ans; ?>" class="form-control acknowledgement_input" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
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
<div class="total-nu1 ps-2" style="pointer-events: none;">
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly style="pointer-events: none;" value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control valid_decimal_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>"></div>
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
<span class="questiontitle">Result:&nbsp;&nbsp;</span><input value="<?php echo $ans; ?>" class="form-control calculatedQuestionAnswer" style="pointer-events: none;height: 22px;width: 60px;" type="text" readonly oncopy="return false" onpaste="return false">
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
<div style="pointer-events:none;">
<span class="questiontitle"><?= $i.'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php if(($keyOption+1)==1){echo $calculatedFirstValue;}else{ echo $calculatedSecondValue;} ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="numberOnly form-control calculatedQuestionTextBoxInput calculatedQuestionInput_<?=$keyOption+1?>" oncopy="return false" onpaste="return false" placeholder="<?php echo $childDetail["question_placeholder"]; ?>" data-calculation_action="<?php echo $allQuestiondetails["calculation_type"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }}} ?>

</div>
</div>
<?php } ?>







<div class="remove-2">
<div class="rem">
<?php if($allQuestiondetails["UOM_ID"]!=42 && $allQuestiondetails["UOM_ID"]!=43){ ?>
  <?php if($allQuestiondetails['validator_2_status']==1){ ?>
    <span style="background-color: #d9fae9; color: #5aba87;border: 1px solid #5aba87;" class="dem-but2a" href="javascript:void(0);">Approved by V2</span>
  <?php }else if($allQuestiondetails['validator_2_status']==2){ ?>
    <span style="background-color: #FDECEB;color: #F26C63;border: 1px solid #F26C63;" class="dem-but2a" href="javascript:void(0);">Rejected by V2</span>
  <?php }else if($allQuestiondetails['validator_2_status']==3){ ?>
    <span style="color: #121211;background-color: #f1b915a1;border: 1px solid #df991a;" class="dem-but2a revertedByValidator" href="javascript:void(0);">Revert with comment by V2</span>
  <?php }?>
<?php }?>




<button style="visibility: <?php if($allQuestiondetails["question_comment"]!=0){ echo "visible"; }else{ echo "hidden"; } ?>;" type="button" class="btn btn-primary new-button-2 openRemarkModalPopup" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>"><i class="bi bi-chat-left-text-fill"></i><?php echo $allQuestiondetails["question_comment"]; ?></button>                                         

<button style="visibility: <?php if($allQuestiondetails["question_document"]!=0){ echo "visible"; }else{ echo "hidden"; } ?>;" type="button" class="btn btn-primary new-but1 showUploadFiles" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>"><i class="bi bi-files"></i>&nbsp;<?php echo $allQuestiondetails["question_document"]; ?></button>

</div>                      
<div class="rejt-1" id="updateV2Status_<?=$allQuestiondetails["Survey_ID"]?>_<?=$allQuestiondetails["Sector_ID"]?>_<?=$allQuestiondetails["QB_ID"]?>">
<?php if($allQuestiondetails["UOM_ID"]!=42 && $allQuestiondetails["UOM_ID"]!=43){ ?>
<button type="button" class="btn btn-primary new-but1 approveQuestion <?=($chkvalidated==1 && $v2_status != 2)?'NotToBeReperiledAgain':''?> <?php if($allQuestiondetails["validator_action"]==1){ echo "bg-success";} ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>"><i class="bi bi-check-lg"></i>Approve</button>


<span class="nav-item dropdown pe-3">
  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" aria-expanded="false">
<button type="button" class="btn btn-primary new-but1 rejectButtonClassToBeUpdated <?=($chkvalidated==1 && $v2_status != 2)?'NotToBeReperiledAgain':''?> <?php if($allQuestiondetails["validator_action"]==2){ echo "bg-danger";} ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>"><i class="bi bi-x"></i>Reject</button>
</a>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="NA" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" href="#">
<span>NA</span>
</a>
</li>
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="N/A" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" href="#">
<span>N/A</span>
</a>
</li>
<li class="">
<a class="dropdown-item d-flex align-items-center rejectQuestion" data-value="NF" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" href="#">
<span>NF</span>
</a>
</li>
</ul>
</span>








<button type="button" class="btn btn-primary new-but1 openRevertWithCommentPopup <?=($chkvalidated==1 && $v2_status != 2)?'NotToBeReperiledAgain':''?> <?php if($allQuestiondetails["validator_action"]==3){ echo "bg-warning";} ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>"> 
<i class="bi bi-chat-right-text-fill"></i>&nbsp;Revert with Comment</button>
<?php } ?>
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
</section>


<div class="modal fade model-wid1 show" id="revertWithCommentPopup" tabindex="-1" aria-labelledby="exampleModalLabel" style="padding-left: 0px;" aria-modal="true" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="exampleModalLabel"> Revert with comments </h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="city-officl d-none">
<div class="city-icon"> <i class="bi bi-person-fill"></i> <span> City Official </span> </div>
<div class="city-text1">
<h4> <label>City Official  </label> <span> 12.13.pm, 16th April 2023</span></h4>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
Lorem Ipsum has been the industry's standard</p>
</div>
</div>
<div class="v2commentSection"></div>
<div class="input-group">
<textarea rows="3" cols="50" id="revertWithComment" class="form-control" placeholder="Enter your comment..."></textarea>
<!-- <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="bi bi-cursor"></i></button>                           -->
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" data-isChild="" question="" id="saveRevertWithComment">Save</button>
</div>
</div>
</div>
</div>




<div class="modal fade model-wid1 show" id="fileUploadModalPopup" tabindex="-1" aria-labelledby="exampleModalLabel" style="padding-left: 0px;" aria-modal="true" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">City uploaded files</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="upld-status">
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col" class="">Document</th>
      <th class="text-center" scope="col">Download</th>
    </tr>
  </thead>
  <tbody id="allQuestionDocument">
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>


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



<div class="modal fade model-wid1 show" id="remarkModalPopup" tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-modal="true" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="exampleModalLabel">City Remark</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div>

</div>
<div class="mb-2">
<textarea class="form-control" id="question_remark" placeholder="Remark" rows="5"></textarea>
<span class="error_msg remark_err" style="color: red;"></span> 
</div>
</div>
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
<script src="<?php echo base_url('assets/niua/js/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/daterangepicker.min.js'); ?>"></script>
</body>

<script>
  function showToast(type,text){
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
  var dtRange='<?php echo (isset($ans) && $ans!='')?$ans:''; ?>';
  $(function(){
    $(".dateinput").datepicker({
      dateFormat:'dd-mm-yy',
      changeMonth:true,
      changeYear:true 
    });

    
    $(".seprateDateRange").datepicker({
      dateFormat:'dd-mm-yy',
      changeMonth:true,
      changeYear:true 
    });

  });
</script>


<script>  
  $(document).on("click",".openRevertWithCommentPopup", function(){
    var nottobeReplied = $(this).hasClass('NotToBeReperiledAgain');
    if($(this).parents('.childQuestionDivOptions').length){
      var isChild = $(this).parents('.childQuestionDivOptions').attr('parent-qb_id').trim();
    }else{
      var isChild=0;
    }
   
     var questionId=$(this).attr('qb-id').trim();
     $("#saveRevertWithComment").attr('question',questionId);
     var survey='<?php echo $url_survey ?>';
     var sector='<?php echo $url_sectorId ?>';
     var cityUserId='<?php echo $url_cityUserId ?>';
     //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
    $.ajax({
      type:'POST',
      url: '<?php echo base_url(); ?>admin/get-validator-comment',
      data: {'question':questionId,'survey_id':survey,'sector_id':sector,'city_user_id':cityUserId,'parent_qb_id':isChild},
      dataType: "json",
      beforeSend: function(){
        //$('.loadingSection').show();
      },
      complete: function(){
        //$('.loadingSection').hide();
      },
      success: function(response){
        //console.log(response);
        //alert(response.comment);
        $(".v2commentSection").html('');
        $(".v2commentSection").html(response.v2_comment);
        $("#revertWithComment").val(response.comment);
        $('#revertWithCommentPopup').modal('toggle'); 
        $('#revertWithCommentPopup').find('#saveRevertWithComment').attr('data-isChild',isChild); 

        if(nottobeReplied){
          $('#revertWithCommentPopup').find('.modal-footer').css('pointer-events','none')
        }else{
          $('#revertWithCommentPopup').find('.modal-footer').css('pointer-events','all')
        }



      }
    });
  });

  
  $(document).on("click",".showUploadFiles", function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo $url_survey ?>';
    var sector='<?php echo $url_sectorId ?>';
    var cityUserId='<?php echo $url_cityUserId ?>';
    //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
     $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/validate-question-documents',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector,'city_user_id':cityUserId},
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
            $('#fileUploadModalPopup').modal('toggle');           
          }
          });
  });

  
  $(document).on("click",".openRemarkModalPopup", function(){
      var questionId=$(this).attr('qb-id').trim();
      var survey='<?php echo $url_survey ?>';
      var sector='<?php echo $url_sectorId ?>';
      var cityUserId='<?php echo $url_cityUserId ?>';
      //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
     $.ajax({
          type:'POST',
          //url: '<?php echo base_url(); ?>admin/get-question-remark',
          url: '<?php echo base_url(); ?>admin/validate-question-remark',          
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector,'city_user_id':cityUserId},
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


<!-- Approve -->
<script>  
  $(document).on("click",".approveQuestion", function(){
    if($(this).hasClass('NotToBeReperiledAgain')){
      return false
    }
    var ele = $(this);
      var question=$(this).attr('qb-id').trim();

      // alert(question);
      // return false;
      var survey='<?php echo $url_survey ?>';
      if($(this).parents('.childQuestionDivOptions').length){
        var parent_qb_id = $(this).parents('.childQuestionDivOptions').attr('parent-qb_id');
      }else{
          var parent_qb_id = 0;
      }
      var sector='<?php echo $url_sectorId ?>';
      var cityUserId='<?php echo $url_cityUserId ?>';
      //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);    
      Swal.fire({
        icon: "question",     
        text: 'Are you sure, you want to approve this question?',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes,approve it',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/validator-approve',
            data: {'q_survey':survey,'q_sector':sector,'question':question,'city_user':cityUserId,'user_type':'v1','parent_qb_id':parent_qb_id},
            dataType: "json",
            beforeSend: function(){
            //$('.loadingSectionMainForm').show();
            },
            complete: function(){
            //$('.loadingSectionMainForm').hide();
            },
            success: function(response){
              //console.log(response);
              if(response.status==1){
                $(ele).addClass('bg-success')
                // $(ele).parent().find('.rejectQuestion').removeClass('bg-danger')
                $(ele).parents('.rejt-1').find('.rejectButtonClassToBeUpdated').removeClass('bg-danger') 
                $(ele).parents('.rejt-1').find('.openRevertWithCommentPopup').removeClass('bg-warning')
                $(".approvedCnt").text(response.total_approved);
                $(".rejectedCnt").text(response.total_rejected);
                $(".revertWithCommentCnt").text(response.total_reverted);
                var total_approved=$(".approvedCnt").text();
                var total_rejected=$(".rejectedCnt").text();
                var revertWithCmt=$(".revertWithCommentCnt").text();
                var total=parseInt(total_approved)+parseInt(total_rejected)+parseInt(revertWithCmt);
                $('.valid-qust1').find(".validatedCnt").text(total);
                $('.updateSectorListCount_'+sector).find(".validatedCnt").text(total);
                $('.updateSectorListCount_'+sector).find("progress").attr('value',total);
                $(".top_progress").attr("value",total);
                // Swal.fire({icon: 'success', text: response.msg});  
                showToast('success',response.msg)              
              }else{
                showToast('error', response.msg);                 
              }
            }
        });
      } 
    });
  });
  // if($(this).hasClass('NotToBeReperiledAgain')){
  //     return false
  //   }
</script>

<!-- Approve All -->
<script>  
  $(document).on("click","#approveAll", function(){
    var selectQuestinList=[];
    // var checklist=$('.sales-card').find('.card-body1');
    // $.each(checklist,function(i,che){
    //     if($(che).find('.questionSelection').is(":checked")){
    //       if($(che).find('.NotToBeReperiledAgain').length == 0){
    //         selectQuestinList.push($(che).find('.questionSelection').attr('value'));
    //       }
    //     }
    // });
    var questionContainer = $('#questionContainer').find('.questionSelection');
     $.each(questionContainer,function(i,che){
        if($(che).is(":checked")){
          if($(che).parents('.card-body1').find('.NotToBeReperiledAgain').length == 0){
            selectQuestinList.push($(che).attr('value'));
          }
        }
    });
   
    var question=selectQuestinList;
    var survey='<?php echo $url_survey ?>';
    var sector='<?php echo $url_sectorId ?>';
    var cityUserId='<?php echo $url_cityUserId ?>';
    //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
    var questions=$('.questionSelection').length;
    var totalChecked=$('input.questionSelection:checked').length;
    //console.log(`Total ::${questions} Checked Questions ${totalChecked}`);
    if(totalChecked==0){
       Swal.fire({icon: 'info', text: 'Please select atleast one question'});
       return false;
    }else{

      Swal.fire({
        icon: "question",     
        text: 'Are you sure, you want to approve all selected question?',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes,approve all',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/validator-approve-all',
            data: {'q_survey':survey,'q_sector':sector,'question':question,'city_user':cityUserId,'user_type':'v1'},
            dataType: "json",
            beforeSend: function(){
            //$('.loadingSectionMainForm').show();
            },
            complete: function(){
            //$('.loadingSectionMainForm').hide();
            },
            success: function(response){
              //console.log(response);
              if(response.status==1){
                var questionSection = $('.remove-2');
                $.each(selectQuestinList,function(i,qbid){
                  $.each(questionSection,function(j,question){
                    $(question).find('#updateV2Status_'+survey+'_'+sector+'_'+qbid).find('.approveQuestion').addClass('bg-success');
                    $(question).find('#updateV2Status_'+survey+'_'+sector+'_'+qbid).find('.rejectButtonClassToBeUpdated').removeClass('bg-danger');
                    $(question).find('#updateV2Status_'+survey+'_'+sector+'_'+qbid).find('.openRevertWithCommentPopup').removeClass('bg-warning');
                  })
                })


                Swal.fire({icon: 'success',text: response.msg}).then((result) => {
                // window.location.reload();                       
                });

                $(".approvedCnt").text(response.total_approved);
                $(".rejectedCnt").text(response.total_rejected);
                $(".revertWithCommentCnt").text(response.total_reverted);
                var total_approved=$(".approvedCnt").text();
                var total_rejected=$(".rejectedCnt").text();
                var revertWithCmt=$(".revertWithCommentCnt").text();
                var total=parseInt(total_approved)+parseInt(total_rejected)+parseInt(revertWithCmt);
                $('.valid-qust1').find(".validatedCnt").text(response.total_approved);

                $('.updateSectorListCount_'+sector).find(".validatedCnt").text(response.total_approved);
                $('.updateSectorListCount_'+sector).find("progress").attr('value',response.total_approved);

                $(".top_progress").attr("value",total);
                Swal.fire({icon: 'success', text: response.msg});                
              }else{
                Swal.fire({icon: 'error', text: response.msg});                 
              }
            }
        });
      } 
    });       
    }
  });
</script>



<!-- Reject -->
<script>  
  $(document).on("click",".rejectQuestion", function(){
    if($(this).hasClass('NotToBeReperiledAgain')){
      return false
    }
    var ele = $(this);
    var question=$(this).attr('qb-id').trim();

    var rejectedByv2_reason=$(this).attr('data-value').trim();


    if($(this).parents('.childQuestionDivOptions').length){
      var parent_qb_id = $(this).parents('.childQuestionDivOptions').attr('parent-qb_id');
    }else{
        var parent_qb_id = 0;
    }
    
      var survey='<?php echo $url_survey ?>';
      var sector='<?php echo $url_sectorId ?>';
      var cityUserId='<?php echo $url_cityUserId ?>';
      //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);    
      Swal.fire({
        icon: "question",     
        text: 'Are you sure, you want to reject this question?',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes,reject it',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/validator-reject',
            data: {'q_survey':survey,'q_sector':sector,'question':question,'city_user':cityUserId,'user_type':'v1','parent_qb_id':parent_qb_id,'rejectedByv2_reason':rejectedByv2_reason},
            dataType: "json",
            beforeSend: function(){
            //$('.loadingSectionMainForm').show();
            },
            complete: function(){
            //$('.loadingSectionMainForm').hide();
            },
            success: function(response){
              //console.log(response);
              if(response.status==1){
                $(ele).parents('.rejt-1').find('.rejectButtonClassToBeUpdated').addClass('bg-danger')
                $(ele).parents('.rejt-1').find('.approveQuestion').removeClass('bg-success')
                $(ele).parents('.rejt-1').find('.openRevertWithCommentPopup').removeClass('bg-warning')


                $(".approvedCnt").text(response.total_approved);
                $(".rejectedCnt").text(response.total_rejected);
                $(".revertWithCommentCnt").text(response.total_reverted);
                var total_approved=$(".approvedCnt").text();
                var total_rejected=$(".rejectedCnt").text();
                var revertWithCmt=$(".revertWithCommentCnt").text();
                var total=parseInt(total_approved)+parseInt(total_rejected)+parseInt(revertWithCmt);
                $('.valid-qust1').find(".validatedCnt").text(total);

                $('.updateSectorListCount_'+sector).find(".validatedCnt").text(total);
                $('.updateSectorListCount_'+sector).find("progress").attr('value',total);

                $(".top_progress").attr("value",total);
                // Swal.fire({icon: 'success', text: response.msg});  
                showToast('success',response.msg)               
              }else{
                // Swal.fire({icon: 'error', text: response.msg}); 
                showToast('error',response.msg)                 
              }
            }
        });
      } 
    });
  }); 
</script>


<!-- Reject All -->
<script>  
  $(document).on("click","#rejectAll", function(){
    var selectQuestinList=[];
    // var checklist=$('.sales-card').find('.card-body1');
    // $.each(checklist,function(i,che){
    //     if($(che).find('.questionSelection').is(":checked")){
    //       if($(che).find('.NotToBeReperiledAgain').length == 0){
    //         selectQuestinList.push($(che).find('.questionSelection').attr('value'));
    //       }
    //     }
    // });
    var rejectedByv2_reason = $(this).attr('data-value').trim();

    var questionContainer = $('#questionContainer').find('.questionSelection');
     $.each(questionContainer,function(i,che){
        if($(che).is(":checked")){
          if($(che).parents('.card-body1').find('.NotToBeReperiledAgain').length == 0){
            selectQuestinList.push($(che).attr('value'));
          }
        }
    });
    // console.log(selectQuestinList);
    // return false;
    var question=selectQuestinList;
    var survey='<?php echo $url_survey ?>';
    var sector='<?php echo $url_sectorId ?>';
    var cityUserId='<?php echo $url_cityUserId ?>';
    //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
    var questions=$('.questionSelection').length;
    var totalChecked=$('input.questionSelection:checked').length;
    //console.log(`Total ::${questions} Checked Questions ${totalChecked}`);
    if(totalChecked==0){
       Swal.fire({icon: 'info', text: 'Please select atleast one question'});
       return false;
    }else{

      Swal.fire({
        icon: "question",     
        text: 'Are you sure, you want to reject all selected question?',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes,reject all',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/validator-reject-all',
            data: {'q_survey':survey,'q_sector':sector,'question':question,'city_user':cityUserId,'user_type':'v1','rejectedByv2_reason':rejectedByv2_reason},
            dataType: "json",
            beforeSend: function(){
            //$('.loadingSectionMainForm').show();
            },
            complete: function(){
            //$('.loadingSectionMainForm').hide();
            },
            success: function(response){
              //console.log(response);
              if(response.status==1){
                var questionSection = $('.remove-2');
                $.each(selectQuestinList,function(i,qbid){
                  $.each(questionSection,function(j,question){
                      $(question).find('#updateV2Status_'+survey+'_'+sector+'_'+qbid).find('.approveQuestion').removeClass('bg-success');
                      $(question).find('#updateV2Status_'+survey+'_'+sector+'_'+qbid).find('.rejectButtonClassToBeUpdated').addClass('bg-danger');
                      $(question).find('#updateV2Status_'+survey+'_'+sector+'_'+qbid).find('.openRevertWithCommentPopup').removeClass('bg-warning');
                    })
                  })

                Swal.fire({icon: 'success',text: response.msg}).then((result) => {
                  window.location.reload();                       
                });
                $(".approvedCnt").text(response.total_approved);
                $(".rejectedCnt").text(response.total_rejected);
                $(".revertWithCommentCnt").text(response.total_reverted);
                var total_approved=$(".approvedCnt").text();
                var total_rejected=$(".rejectedCnt").text();
                var revertWithCmt=$(".revertWithCommentCnt").text();
                var total=parseInt(total_approved)+parseInt(total_rejected)+parseInt(revertWithCmt);
                $('.valid-qust1').find(".validatedCnt").text(response.total_rejected);

                $('.updateSectorListCount_'+sector).find(".validatedCnt").text(response.total_rejected);
                $('.updateSectorListCount_'+sector).find("progress").attr('value',response.total_rejected);

                $(".top_progress").attr("value",total);
                Swal.fire({icon: 'success', text: response.msg});                
              }else{
                Swal.fire({icon: 'error', text: response.msg});                 
              }
            }
        });
      } 
    });       
    }
  });
</script>


<script>
  $(document).on('click','#selectAll',function(){

    if($('#selectAll').is(":checked")){
      $(".questionSelection").prop('checked', true);
    }else{
      $(".questionSelection").prop('checked', false);
    }

  });

  $('.questionSelection').on('change', function(){
      var questions=$('.questionSelection').length;
      var totalChecked=$('input.questionSelection:checked').length;
      //console.log(`Total ::${questions} Checked Questions ${totalChecked}`);
      if(questions!=totalChecked){
        $("#selectAll").prop('checked', false);
      }else{
        $("#selectAll").prop('checked', true);
      }
  }); 
</script>

<script>
  /* Add To Bookmark */
  $(document).on('click','.addToBookmark',function(){
    var questionId=$(this).attr('qb-id').trim();
    var survey='<?php echo $url_survey ?>';
    var sector='<?php echo $url_sectorId ?>';
    var cityUserId='<?php echo $url_cityUserId ?>';
    //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
    if($(this).hasClass('bi-star-fill clr2')){ // Checked
       $(this).removeClass('bi-star-fill clr2');
       $(this).addClass('bi-star');
       //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/validator-bookmark-question',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector,'city':cityUserId,'action':'remove'},
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
       $(this).addClass('bi-star-fill clr2');
       //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/validator-bookmark-question',
          data: {'qb_id':questionId,'survey_id':survey,'sector_id':sector,'city':cityUserId,'action':'add'},
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
  $('#filter_validator_question').on('change', function(){
    var selected=$(this).val().trim();
    var survey='<?php echo $url_survey ?>';
    var sector='<?php echo $url_sectorId ?>';
    var cityUserId='<?php echo $url_cityUserId ?>';
    //alert(`Q=>${question}, Survey=>${survey}, Sector=>${sector}, City=>${cityUserId}`);
    //alert(selected);
    $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/filter-validator-question',
          data: {'selection':selected,'survey_id':survey,'sector_id':sector,'city':cityUserId},
          dataType: "json",
          beforeSend: function(){
            $('.se-pre-con').show();
          },
          complete: function(){
            $('.se-pre-con').hide();
          },
          success: function(response){
            //console.log(response);
            $("#questionContainer").html("");
            $("#questionContainer").html(response.html);
            var questionCard = $('.card-body1').find('.ChildQuestionListDataShow');
            $.each(questionCard,function(i,card){
              if($(card).is(':checked')){
                var qb_id = $(card).attr('qb-id');
                var checkedValue = $(card).val();
                var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')
                console.log('ParentQuestionOptionData_'+qb_id+'_'+checkedValue2)
                $('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).show();
              }else{
                var qb_id = $(card).attr('qb-id');
                var checkedValue = $(card).val();
                var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')
                $('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).hide();
              }
            })
          }
          });
  });
</script>


<script>  


  $(document).on('click','#saveRevertWithComment',function(){
    var thisElement = $(this)
    var questionId=$(this).attr('question').trim();
    var parent_qb_id=$(this).attr('data-isChild').trim();
    var comment=$("#revertWithComment").val().trim();
    var survey='<?php echo $url_survey ?>';
    var sector='<?php echo $url_sectorId ?>';
    var cityUserId='<?php echo $url_cityUserId ?>';
    if(questionId!=""){
        if(comment==""){
          $("#revertWithComment").focus();
          return false;
        }
        //alert(`Q=>${questionId} Cmt=>${comment}`);
        // Ajax...
        $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/validator-revert-with-comment',
          data: {'question':questionId,'survey_id':survey,'sector_id':sector,'city_user':cityUserId,'get_comment':comment,'parent_qb_id':parent_qb_id},
          dataType: "json",
          beforeSend: function(){
            //$('.se-pre-con').show();
          },
          complete: function(){
            //$('.se-pre-con').hide();
          },
          success: function(response){
            console.log(response);
            if(response.status==1){
                
              if(parent_qb_id > 0){

                  var checkListElements = $('body').find('.checkForChangeInStatusForRevert_'+parent_qb_id);
                  $.each(checkListElements,function(i,qdiv){
                    
                    if($(qdiv).find('#updateV2Status_'+survey+'_'+sector+'_'+questionId).length){
                    
                      $(qdiv).find('#updateV2Status_'+survey+'_'+sector+'_'+questionId).find('.openRevertWithCommentPopup').addClass('bg-warning');

                      $(qdiv).find('#updateV2Status_'+survey+'_'+sector+'_'+questionId).find('.approveQuestion').removeClass('bg-success');

                      $(qdiv).find('#updateV2Status_'+survey+'_'+sector+'_'+questionId).find('.rejectButtonClassToBeUpdated').removeClass('bg-danger');
                    }
                  })
              }else{
                 $('#updateV2Status_'+survey+'_'+sector+'_'+questionId).find('.openRevertWithCommentPopup').addClass('bg-warning');

                  $('#updateV2Status_'+survey+'_'+sector+'_'+questionId).find('.approveQuestion').removeClass('bg-success');
                  $('#updateV2Status_'+survey+'_'+sector+'_'+questionId).find('.rejectButtonClassToBeUpdated').removeClass('bg-danger');
              }

                $(".approvedCnt").text(response.total_approved);
                $(".rejectedCnt").text(response.total_rejected);
                $(".revertWithCommentCnt").text(response.total_reverted);
                var total_approved=$(".approvedCnt").text();
                var total_rejected=$(".rejectedCnt").text();
                var revertWithCmt=$(".revertWithCommentCnt").text();
                var total=parseInt(total_approved)+parseInt(total_rejected)+parseInt(revertWithCmt);
                $('.valid-qust1').find(".validatedCnt").text(total);

                $('.updateSectorListCount_'+sector).find(".validatedCnt").text(total);
                $('.updateSectorListCount_'+sector).find("progress").attr('value',total);

                $(".top_progress").attr("value",total);
                $('#revertWithCommentPopup').modal('hide');
                showToast('success',response.msg)              
              }else{
                showToast('error', response.msg);                 
              }            
          }
          });
    }
  });
</script>

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
            //$('.loadingSection').hide();
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
    //$("#main").style.background=color;
    $('#main').css('background-color', `${color}`);
  });


$(document).on('click','.ChildQuestionListDataShow',function(){
  var this_ChilD_Div_Value = $(this).val();
  var qb_id = $(this).parents('.card-body1').attr('data-qb_id');
  var elementData = $(this).parents('.value1').find('.ps-2');
  $.each(elementData,function(i,childdiv){
    if($(childdiv).attr('id') == 'ParentQuestionOptionData_'+qb_id+'_'+this_ChilD_Div_Value){
      console.log('got it')
      $(childdiv).show();
    }else{
      console.log('did not get it')
      $(childdiv).hide();
    }
  })
})


$(document).ready(function(){
  var questionCard = $('.card-body1').find('.ChildQuestionListDataShow');
  $.each(questionCard,function(i,card){
    if($(card).is(':checked')){
      var qb_id = $(card).attr('qb-id');
      var checkedValue = $(card).val();
      var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')
      console.log('ParentQuestionOptionData_'+qb_id+'_'+checkedValue2)
      $('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).show();
    }else{
      var qb_id = $(card).attr('qb-id');
      var checkedValue = $(card).val();
      var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '')
      $('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).hide();
    }
  })
})

$(document).on('click','.revertedByValidator',function(){
  $(this).parents('.remove-2').find('.openRevertWithCommentPopup').trigger('click');
})
</script>
</html>