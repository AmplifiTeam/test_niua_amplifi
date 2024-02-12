<?php
$logedInUserDetail=session('admin_detail');
$loginUserCityName=$logedInUserDetail['City'];
?>


<div class="row progressRow mt-4">
<div class="col-lg-4 col-md-4"><div class="pagetitle"><h1 id="ChangeSurveyName"><?php echo $surveyDeatail['Survey_Name']; ?></h1></div></div>
<div class="col-lg-4 col-md-4">
  <progress class="overAllProgress" style="" value="<?php echo count($surveyAllAnsweredQuestions); ?>" max="<?php echo count($surveyAllAssignQuestions); ?>"></progress>
  <p class="text-center" style="font-weight: bold;">Responded&nbsp;<?php echo count($surveyAllAnsweredQuestions); ?>/<?php echo count($surveyAllAssignQuestions); ?>&nbsp;Question</p>
</div>
<div class="col-lg-4 col-md-4">
    <div class="save-part">
    <p class="citySubmissionNote"><?php echo $submission_note; ?></p>
    <div class="save-part d-flex">
    <div class="SurveyDropDownSelection d-flex justify-content-center">    
      <select class="form-select Survey_ID_selection" id="Survey_ID" name="Survey_ID" aria-label="Default select example" style="width: 100%;height: 100%;">
          <?php
           //print_r($allSurveyList);
           if(!empty($allSurveyList) && count($allSurveyList)){?>
            <?php 
            foreach($allSurveyList as $key=>$Survey){
            if($Survey["active_inactive_status"]==1){
             ?>
             <option value="<?=$Survey['Survey_ID']?>" <?=($city_official_selected_Survey==$Survey['Survey_ID'])?'selected':''?> ><a title="<?=ucfirst($Survey['Survey_Name'])?>"><?php echo word_limiter($Survey['Survey_Name'],6); ?></a></option>
            <?php }}}else{ ?>
            <option value="0">No survey found</option>
          <?php }?>
      </select>
    </div>
    <div class="citySubmitBtn">
        <?php echo $button_html; ?>
    </div>
    </div>
    <div class="notes">
      <p class="surveyDateSection"><?php echo $date_note; ?></p>
    </div>
    </div>
</div>


</div>









<?php if($survey_notification!=""){?>
<div class="row mt-4">
<div class="col-md-3"></div>
<div class="col-md-6 text-center">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong><?php echo $survey_notification; ?></strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<div class="col-md-3"></div>
</div>
<?php } ?>

<?php
if(count($getReverted)>0){
?>
<div class="row revertedv2 mt-4">
<div class="col-md-2"></div>
<div class="col-md-8">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?php echo ucwords($loginUserCityName); ?>!</strong> You have received <b>comments on your response</b> in <?php echo count($getRevertedSector); ?> sector. <a href="<?php echo base_url('admin/city-reverted-dashboard/'.$survey_id); ?>">Click Here</a> to view
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
</div>
<div class="col-md-2"></div>
</div>
<?php } ?>

<div class="mt-n10">
<div class="row seven-cols">
<?php
$i=1;
$k=1;
//print_data($logedInUserDetail);
$loginUserCity=$logedInUserDetail['City_ID'];
if(isset($allsector) && !empty($allsector)){
foreach ($allsector as $allsectorDetails){
$sid=trim($allsectorDetails['Sector_ID']);
if($allsectorDetails['QuestionsInSurvey']!=0){
  $exist="question_exist";
  $url=base_url('admin/sector-question/'.$survey_id.'/'.$sid);
}else{
  $exist="question_not_exist";
  $url="javascript:void(0)";
}
$totalAnswered=getSectorTotalAnswered($survey_id,$sid,$loginUserCity);
if($allsectorDetails['QuestionsInSurvey']!=0){
?> 
<div class="col-md-1">
<a style="background-image: url('<?=base_url('assets/niua/img/'.$allsectorDetails['sectorBackground']) ?>'); background-position: right center; background-repeat: no-repeat;  background-size: cover !important; width: 100%;" class="navbar-brand" href="<?php echo $url; ?>">           
<div class="box-content">
<span><img src="<?=base_url('assets/niua/img/'.$allsectorDetails['sectorIcon'])?>"></span>
<h5><?php echo word_limiter($allsectorDetails['Sector'],4); ?></h5>
<progress style="" id="file" value="<?php echo $totalAnswered; ?>" max="<?=($allsectorDetails['QuestionsInSurvey'])?$allsectorDetails['QuestionsInSurvey']:0; ?>"></progress>
<h6><?php echo $totalAnswered; ?>/<?=($allsectorDetails['QuestionsInSurvey'])?$allsectorDetails['QuestionsInSurvey']:0; ?></h6>
</div>           
</a>
</div>
<?php }}} ?>
</div>
</div>