<div class="se-pre-con" style="display: none;"></div>
<div class="pagetitle dashboardPageTitle">
<?php
$surveyName='Survey form';
if(!empty($surveyList) && !empty($surveyList[0])){
$surveyName=' '.$surveyList[0]["Survey_Name"]." form";
}
?>
<h1><a title="<?php echo $surveyName; ?>"><?php echo $surveyName; ?></a></h1>
<div class="save-part">
<form>
<?php
$logedInUserDetail=session('admin_detail');
$loginUserRole=$logedInUserDetail['role'];
if($loginUserRole==1){
?>
<button id="addNewSurvey" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New Survey</button>
<button type="button" class="btn btn-primary" id="saveSurvey">Save</button>
<?php }else if($loginUserRole==5){ ?>
<button id="addNewSurvey" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New Survey</button>
<button type="button" class="btn btn-primary" id="saveSurvey">Save</button>
<button type="button" class="btn btn-primary" id="publishSurvey">Publish</button>
<?php } ?>  
</form>
<div class="modal fade model-wid1" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title fs-5" id="exampleModalLabel"> New Survey </h2>
<button type="button" class="btn-close" id="closePopUpButton" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="mb-2">
<label for="Survey_Name" class="col-form-label lable_left">Survey Name<label class="star-red">*</label>:</label>
<input type="text" class="form-control" id="Survey_Name" name="Survey_Name" placeholder="Please enter survey name">
</div>

<div class="mb-2">
<label for="is_uof_survey" class="col-form-label lable_left">Is this a UOF survey<label class="star-red">*</label>:</label>
<select class="form-select" name="is_uof_survey" id="is_uof_survey" aria-label="Default select example" style="width: 100%;">
  <option value="0">No</option>
  <option value="1">Yes</option>
</select>                
</div>

<div class="mb-2">
<label for="survey_year" class="col-form-label lable_left">Survey Year<label class="star-red">*</label>:</label>
<select class="form-select" name="survey_year" id="survey_year" aria-label="Default select example" style="width: 100%;">
<?php  for($j=2010; $j<=2050; $j++){ ?>
<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
<?php } ?>
</select>                
</div>

<div class="mb-2">
<label for="Description" class="col-form-label lable_left">Description<label class="star-red">*</label>:</label>
<input type="text" class="form-control" id="Description" name="Description" placeholder="Please enter description">
</div>
<div class="mb-2">
<label for="From_Date" class="col-form-label lable_left">Survey Start Date<label class="star-red">*</label>:</label>
<input readonly placeholder="Select start date" type="text" class="form-control start_datepicker" id="From_Date" name="From_Date">
</div>
<div class="mb-2">
<label for="To_Date" class="col-form-label lable_left">Survey End Date<label class="star-red">*</label>:</label>
<input readonly placeholder="Select end date" type="text" class="form-control start_datepicker" id="To_Date" name="To_Date">
</div>
<div class="mb-2">
<label for="Import_From_Survey_ID" class="col-form-label lable_left">Import From :</label>
<?php if(!empty($surveyListCheck) && count($surveyListCheck)){?>
<select class="form-select" id="Import_From_Survey_ID" name="Import_From_Survey_ID" aria-label="Default select example" style="width: 100%;">
<option value="0">Select survey</option>
<?php foreach($surveyListCheck as $key=>$Survey){?>
<option value="<?=$Survey['Survey_ID']?>" ><?=$Survey['Survey_Name']?></option>
<?php }?>
</select>
<?php }?>
</div>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" id="saveNewSurvey">Create Survey</button>
</div>
</div>
</div>
</div>
<!-- Add new sector modal start here -->
<div class="modal fade model-wid1" id="SectorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="exampleModalLabel">Add New Sector </h1>
<button type="button" class="btn-close" id="closePopUpButton" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="mb-2">
<label for="Sector_Name" class="col-form-label lable_left">Sector Name<label class="star-red">*</label>:</label>
<input type="text" class="form-control" id="Sector_Name" name="Sector_Name" placeholder="Please enter Sector name">
<div style="display: block; text-align: left; font-size: 11px;">
<span><b>Note : </b>Max 100 character allowed.</span></div>
</div>
<div class="mb-2">
<label for="Sector_Description" class="col-form-label lable_left">Description<label class="star-red">*</label>:</label>
<input type="text" class="form-control" id="Sector_Description" name="Sector_Description" placeholder="Please enter Sector name">
</div>
<div class="mb-2">
<label for="Sector_Icon" class="col-form-label lable_left">Sector Icon<label class="star-red">*</label>:</label>
<input type="file" class="form-control"  id="Sector_Icon" name="Sector_Icon" placeholder="Please enter Sector name">
<div style="display: block; text-align: left; font-size: 11px;">
<span><b>Note : </b>.svg format allowed.</span></div>
</div>
<div class="mb-2">
<label for="Sector_Images" class="col-form-label lable_left">Sector Image<label class="star-red">*</label>:</label>
<input type="file" class="form-control" id="Sector_Images" name="Sector_Images" placeholder="Please enter Sector name">
<div style="display: block; text-align: left; font-size: 11px;">
<span><b>Note : </b>.png, .jpg, and .jpeg format allowed.</span></div>
</div>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" id="saveNewSector">Create Sector</button>
</div>
</div>
</div>
</div>
<!-- add new sector end here  -->
<?php 
$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City'];
$loginUserRole=$logedInUserDetail['role'];
?>
<?php if(!empty($surveyList) && !empty($surveyList[0]) && $surveyList[0]['saved_on']!='' && $surveyList[0]['admin_status']==1 && $surveyList[0]['publish_status']==0 && ($loginUserRole==1 || $loginUserRole==5)){?>
<p>Last saved on <?=date('d-M-Y h:i:s',strtotime($surveyList[0]['saved_on']))?></p>
<?php }?>
<?php if(!empty($surveyList) && !empty($surveyList[0]) && $surveyList[0]['saved_on']!='' && $surveyList[0]['publish_status']==1 && ($loginUserRole==1 || $loginUserRole==5)){?>
<p>Last saved on <?=date('d-M-Y h:i:s',strtotime($surveyList[0]['saved_on']))?></p>
<?php }?>
<?php if(!empty($surveyList) && !empty($surveyList[0]) && $surveyList[0]['published_on']!='' && $surveyList[0]['publish_status']==2){?>
<p>
<span>Last saved on <?=date('d-M-Y h:i:s',strtotime($surveyList[0]['saved_on']))?></span>
<br>
<span>Last published on <?=date('d-M-Y h:i:s',strtotime($surveyList[0]['published_on']))?></span>
</p>
<?php }?>
</div>
</div>
<section class="section dashboard " id="SurveyDataAjax">
<div class="row">
<div class="col-lg-2">         
<div class="card-body2 pb-0">
<h5 class="card-title" style="cursor: pointer;"  onclick="showSelectedSectorQuestion(0)">
<strong onclick="showSelectedSectorQuestion(0)">All SECTORS&nbsp;<span style="color: #fff;" class="AllQuestionCount">(0)</span></strong> <i class="bi bi-plus plus_icn" title="Add new sector" id="addNewSector" data-bs-toggle="modal" data-bs-target="#SectorModal" aria-hidden="true"></i></h5>
<ul class="all-sectr-prt1" id="selectListData">
<?php
if(isset($allsector) && !empty($allsector)){
foreach ($allsector as $allsectorDetails){              
?>
<li class="sectorSection" data-sector="<?php echo trim($allsectorDetails['Sector_ID']); ?>" id="SelectedSector_<?php echo trim($allsectorDetails['Sector_ID']); ?>">
<div class="a-s-p-icon"><img src="<?=base_url('assets/niua/img/'.$allsectorDetails['sectorIcon'])?>"></div>
<div class="a-s-p-text"><a style="text-decoration: none;" title="<?php echo ucwords($allsectorDetails['Sector']); ?>" href="#"><?php echo word_limiter($allsectorDetails['Sector'],2); ?></a></div>
<div class="a-s-p-numb sectorWiseQuestionCount">0</div>
</li>
<?php }
} ?>
</ul>
</div>
</div>
<div class="col-lg-6">
<div class="row">
<form>
<div class="col-md-12">
<div class="selet-del-1">
<div class="form-check check-1">
<input class="form-check-input" type="checkbox" value="" id="allflexCheckDefault">
<label class="form-check-label" for="flexCheckDefault"> Select All </label>
</div>
<div class="suffleSectorQuestions " id="suffleSectorQuestions"  data-sector_id="" data-qCount="" data-bs-toggle="modal" data-bs-target="#suffleModalForSector"> <a title="Shuffle Question Order" href="javascript:void(0);"> <i class="bi bi-shuffle"></i>  </a> </div>
<div class="check-2" id="removeMultipleQuestion"> <a title="Remove All" href="javascript:void(0);"> <i class="bi bi-trash"></i> Remove </a> </div>
</div>
<div style="display:none;" class="loadingSectionMainForm text-center">
<img style="height:35px;" src="<?php echo base_url('assets/niua/img/loading.gif'); ?>">
</div>
<div class="sales-card" id="SurveyFormData">
<p class="mt-4"  id="noDataFound" style="text-align: center;display: none; color:red;">No question found!</p>
<div class="accordion accordion-flush" id="accordionFlushExample">
<?php
if(isset($questionList) && !empty($questionList)){
foreach($questionList as $key=>$question){ ?>
<div class="accordion-item card-body1 pad-3 sectorID-<?=$question['Sector_ID']?> toBeRemovedCheck QuestionCard Question_id_<?=trim($question['QB_ID'])?>">
<h2 class="accordion-header d-flex align-items-center">
<div class="card-icon2">
<div class="down-top-er1"> 
<input class="form-check-input flexCheckDefaultClass" type="checkbox" value="<?=trim($question['QB_ID'])?>" >
</div>
</div>
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?=trim($question['QB_ID'])?>" aria-expanded="false" aria-controls="flush-collapse<?=trim($question['QB_ID'])?>">
<span class="updateSequence"><?=$key + 1?></span>.&nbsp;&nbsp;<span class="w-auto"><?=$question['Description']?></span>&nbsp;<span onclick="questionDetail('<?php echo trim($question["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></span>
</button>
<div class="rem-2 d-flex ms-2" style="width: 15%;" id="removeSigleQuestion" data-qid="<?=trim($question['QB_ID'])
?>">
<a href=""> 
<i class="bi bi-trash"></i> Remove 
</a> 
</div>
</h2>
<div id="flush-collapse<?=trim($question['QB_ID'])?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
<div class="accordion-body">
<div class="d-flex">
<div class="questionUOMtypeDataAdminSide">
<?php
$uomDetail=getQuestionUnitOfMeasurement(trim($question['UOM_ID']));
if(trim($question['UOM_ID'])==1){ //Number ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" oncopy="return false" onpaste="return false" qb-id="<?php echo $question["QB_ID"] ?>" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==2){ //Number In Cr ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==3){ //Number In Rupees  ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($question['UOM_ID'])==4){ //Percentage  ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($question['UOM_ID'])==5){ //Mega Watt Hr  ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($question['UOM_ID'])==6){ //SQ Km  ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($question['UOM_ID'])==7){ //Micro gm/cu.m ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($question['UOM_ID'])==8){ //Select One Option ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1">
<?php
$options=getQuestionAllOptions($question["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input qb-id="<?php echo $question["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $question["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
<span class="checkmark"></span>
</label>
</div>
<?php }}else{ ?>
<div class="form-check-inline col-12">
<label class="customradio">
<span class="radiotextsty">Yes</span>
<input  qb-id="<?php echo $question["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $question["QB_ID"] ?>" value="Yes" />
<span class="checkmark"></span>
</label>
<label class="customradio">
<span class="radiotextsty">No</span>
<input qb-id="<?php echo $question["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $question["QB_ID"] ?>" value="No" />
<span class="checkmark"></span>
</label>
</div>
<?php } ?>
</div>
</div>
<?php } else if(trim($question['UOM_ID'])==9){ //Km ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($question['UOM_ID'])==10){ //Ipcd ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==11){ //MLD ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==12){ //Number(Score & Rating) ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==13){ //Number(In Year) ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==14){ //Detail ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><textarea qb-id="<?php echo $question["QB_ID"] ?>" rows="3" cols="50" class="form-control textBoxInput"></textarea>&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==15){ //Number(In Days) ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==16){ //Number(In Meters) ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==17){ //Text ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==18){ //kW ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==19){ //kWh ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==20){ //kl ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==21){ //Sq.m ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==22){ //Ratio ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==23){ //Persons Per Sq KM ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==24){ //Public Transport Unit (PTU) per 1000 people ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question['question_placeholder']; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==25){ //Select Multiple ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="checkbox">
<?php
$options=getQuestionAllOptions($question["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<input  value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $question["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $question["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }} ?>
</div>
</div>
<?php } else if(trim($question['UOM_ID'])==27){ //Rating ?>
<div class="total-nu11 ps-3 col-lg-10">
<div class="mt-2">
<span class="rat-star1"><i qb-id="<?php echo $question["QB_ID"] ?>" data-value="1" style="cursor: pointer;" data-starIndex="1" class="ratingUOM bi bi-star "></i></span> 
<span class="rat-star1"><i qb-id="<?php echo $question["QB_ID"] ?>" data-value="2" style="cursor: pointer;" data-starIndex="2" class="ratingUOM bi bi-star "></i></span> 
<span class="rat-star1"><i qb-id="<?php echo $question["QB_ID"] ?>" data-value="3" style="cursor: pointer;" data-starIndex="3" class="ratingUOM bi bi-star "></i></span> 
<span class="rat-star1"><i qb-id="<?php echo $question["QB_ID"] ?>" data-value="4" style="cursor: pointer;" data-starIndex="4" class="ratingUOM bi bi-star "></i></span>
<span class="rat-star1"><i qb-id="<?php echo $question["QB_ID"] ?>" data-value="5" style="cursor: pointer;" data-starIndex="5" class="ratingUOM bi bi-star "></i></span>
</div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==28){ //Audio
$audio_ext=getQuestionAllOptions($question["QB_ID"]);
?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value"><input qb-id="<?php echo $question["QB_ID"] ?>" type="file" class="form-control fileInput"><a href="" download><i title="Download File" class="fa fa-download mt-2"></i></a></div>
<span class="audio_note question_note" style=""><b>Note :</b> Allowed extensions : <?php echo $audio_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==29){ //Video
$video_ext=getQuestionAllOptions($question["QB_ID"]);
?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value"><input qb-id="<?php echo $question["QB_ID"] ?>" type="file" class="form-control fileInput"><a href="" download><i title="Download File" class="fa fa-download mt-2"></i></a></div>
<span class="video_note question_note" style=""><b>Note :</b> Allowed extensions : : <?php echo $video_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==30){ //File
 
$file_ext=getQuestionAllOptions($question["QB_ID"]);
?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value"><input qb-id="<?php echo $question["QB_ID"] ?>" type="file" class="form-control fileInput"><a href="" download><i title="Download File" class="fa fa-download mt-2"></i></a></div>
<span class="file_note question_note" style=""><b>Note :</b> Allowed extensions : <?php echo $file_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==31){ //Date With Range ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control dateRange textBoxInput" placeholder="Select date range"></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==32){ //Date With Time ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="datetime-local" class="form-control dateWithTime textBoxInput"></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==33){ //Date ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" readonly type="text" class="form-control dateinput textBoxInput" placeholder="Select date"></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==34){ //E-mail ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="value1"><input value="" oncopy="return false" onpaste="return false" qb-id="<?php echo $question["QB_ID"] ?>" type="Email" class="form-control textBoxInput" placeholder="Enter e-mail">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==35){ //Range
$range_options=getQuestionAllOptions($question["QB_ID"]);
?>
<div class="total-nu1 ps-3 col-lg-10">
<main class="cd__main">
<div class="range">
  <div class="sliderValue">
    <span class="rangeSelectedValue">0</span>
  </div>
  <div class="field">
    <div class="value left"><?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?></div>
      <div class="value" style="width:100%" >
        <input qb-id="<?php echo $question["QB_ID"] ?>" class="rangeInput" type="range" min="<?php echo isset($range_options[0]["range_min_value"])?trim($range_options[0]["range_min_value"]):""; ?>" max="<?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?>" value="" steps="1">
        <span class="selectedValue"></span>
      </div>
    <div class="value right"><?php echo isset($range_options[0]["range_max_value"])?trim($range_options[0]["range_max_value"]):""; ?></div>
  </div>
</div>
</main>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($question['UOM_ID'])==36){ //Select Multiple Priority ?>
<div class="total-nu1 ps-3 col-lg-10">
<div class="checkbox">
<?php
$options=getQuestionAllOptions($question["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<input value="<?php echo trim($option_detail["options"]); ?>" qb-id="<?php echo $question["QB_ID"] ?>" class="form-check-input multiSelect" type="checkbox" name="checkbox_options_<?php echo $question["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }} ?>
</div>
</div>
<?php }elseif(trim($question['UOM_ID'])==42){ //Parent Child Conditional ?>
<div class="total-nu1 ps-2">
<div class="value1 ParentChildConditionalCls">
<div class="yes_no">
<?php
$options=getQuestionAllOptions($question["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline ">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input qb-id="<?php echo $question["QB_ID"] ?>" class="ChildQuestionListDataShow radioInput" type="radio" name="radio_option_<?php echo $question["QB_ID"] ?>" id="radio_option_<?php echo $question["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
<span class="checkmark"></span>
</label>
</div>
<?php } ?>
</div> 
<?php
if($question['child_questions']!=''){
  $childQuestionsArray = json_decode($question['child_questions']);
}else{
  $childQuestionsArray = [];
}

if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
?>
<div class="ps-2" id="ParentQuestionOptionData_<?=$question['QB_ID']?>_<?=preg_replace('/[^a-zA-Z0-9_\[\]\\\-]/s', '',$keyOption)?>" style="display: none;">
<?php if(!empty($childQuestion)){
$child_i=1;
foreach($childQuestion as $qkey =>$child){
$childDetail = getQuestionDetail($child);
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion">
<span class="questiontitle"><?php echo ($key + 1).".".$child_i." : ".$childDetail["Description"]; ?></span>
<div class="value1" style="pointer-events:none;">
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){
foreach($parent_child_options as $get_parent_child_option_detail){
?>
<div class="conditional_option_section">
<input style="cursor: pointer;" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$question["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
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
<?php }elseif(trim($question['UOM_ID'])==43){ //Parent Child 

  print_data($question);?>
<div class="total-nu1 ps-2">
<div class="value1">
<?php
if($question['sub_question']!=''){
  $childQuestionsArray = json_decode($question['sub_question']);
}else{
  $childQuestionsArray = [];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){

?>
<div class="ps-2" >
<?php if(!empty($childQuestion)){
$childDetail = getQuestionDetail($childQuestion);
$childchildDetail = getQuestionUnitOfMeasurement($childDetail['UOM_ID']);
?>
<div class="show_childQuestion">
<span class="questiontitle"><?= ($key + 1).'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?></span>
<div class="value1" style="pointer-events:none;">
<?php if($childchildDetail["UOM_ID"]==17){ //For Short text ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control validtext_niua childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==1){ //For Integer ?>
<input oncopy="return false" onpaste="return false" value="" style="width: 118px" type="text" class="form-control numberOnly childTextBoxInput" placeholder="<?php echo $childDetail["question_placeholder"]; ?>">
<?php } if($childchildDetail["UOM_ID"]==8){ //For Select One Option
$parent_child_options=getQuestionAllOptions($childDetail["QB_ID"]);
if(!empty($parent_child_options)){
foreach($parent_child_options as $get_parent_child_option_detail){
?>
<div class="conditional_option_section">
<input style="cursor: pointer;" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$question["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
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
<?php }elseif(trim($question['UOM_ID'])==41){$q_matrix=base_url('assets/uploads/').$question["question_matrix_barcode"]; //Question Matrix ?>
<div class="total-nu1 ps-2">
<div class="value"><a href="<?php echo $q_matrix; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a></div>
</div>
<?php }elseif(trim($question['UOM_ID'])==39){$barcode=base_url('assets/uploads/').$question["question_matrix_barcode"]; //Barcode ?>
<div class="total-nu1 ps-2">
<div class="value"><a href="<?php echo $barcode; ?>" download><i title="Download File" class="bi bi-download mt-2"></i></a></div>
</div>
<?php }elseif(trim($question['UOM_ID'])==40){ //Acknowledgement ?>
<div class="total-nu1 ps-2">
<div class="value1 acknowledgement_checkbox_sec"><input  class="acknowledgement_checkbox" type="checkbox">&nbsp;&nbsp;<input readonly oncopy="return false" onpaste="return false" type="text" class="form-control acknowledgement_input" placeholder=""></div>
</div> 
<?php }elseif(trim($question['UOM_ID'])==37){ //Time
$get_hour=1;
$get_second=0;
$get_ampm="";
?>
<div class="total-nu1 ps-2">
<div class="inputTimeSection">
<select class="form-control timeInput Timehour">
  <?php for($hour=1; $hour<=12; $hour++){ ?>
  <option value="<?php echo $hour; ?>"><?php echo $hour; ?></option>
 <?php } ?>
</select>

<select class="form-control timeInput Timesecond">
  <?php for($sec=0; $sec<=59; $sec++){ ?>
  <option value="<?php echo $sec; ?>"><?php echo $sec; ?></option>
 <?php } ?>
</select>

<select style="width:auto;" class="form-control am_pm_selection timeInput">
  <option value="">Select AM/PM</option>
  <option value="AM">AM</option>
  <option value="PM">PM</option>
</select>

</div>
</div>
<?php }else if(trim($question['UOM_ID'])==38){ //Decimal/Float ?>
<div class="total-nu1 ps-2">
<div class="value1"><input readonly oncopy="return false" onpaste="return false" type="text" class="form-control valid_decimal_niua textBoxInput" placeholder=""></div>
</div>
<?php }else if(trim($question['UOM_ID'])==44){ //Calculated Question
  if(!empty($getCityAnswer)){
    $calculatedFirstValue=trim($getCityAnswer["calculation_value1"]);
    $calculatedSecondValue=trim($getCityAnswer["calculation_value2"]);
  }else{
    $calculatedFirstValue="";
    $calculatedSecondValue="";
  }
?>
<div class="total-nu1 ps-2">
<div class="value1 calculatedQuestionSection" style="pointer-events:none;">
<?php
if($question['sub_question']!=''){
  $childQuestionsArray=json_decode($question['sub_question']);
}else{
  $childQuestionsArray=[];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
if(!empty($childQuestion)){
$childDetail=getQuestionDetail($childQuestion);
?>
<div>
<span class="questiontitle"><?= ($key + 1).'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input readonly value="<?php if(($keyOption+1)==1){echo $calculatedFirstValue;}else{ echo $calculatedSecondValue;} ?>" style="width: 118px" type="text" class="numberOnly form-control calculatedQuestionTextBoxInput calculatedQuestionInput_<?=$keyOption+1?>" oncopy="return false" onpaste="return false" placeholder="<?php echo $childDetail["question_placeholder"]; ?>" data-calculation_action="<?php echo $question["calculation_type"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }}} ?>

</div>
</div>
<?php } ?>
<!-- End UOM Condition -->









</div>
</div>        
</div>
</div>
</div>
<?php  }} ?>
</div>
</div>
</div>
</form> 
</div>
</div>

<div class="col-lg-4 right-1">
<div class="header2">
<div class="search-bar">
<div class="search-form d-flex align-items-center">
<input type="text" name="searchQuestion" id="searchQuestion" placeholder="Search" title="Enter search keyword">
<button type="submit" title="Search"><i class="bi bi-search"></i></button>
</div>
</div>
<div class="sector1">
<select class="form-select" aria-label="Default select example" name="sectorList" id="sectorList">
<option selected="" value="">All Sectors</option>
<?php
if(isset($allsector) && !empty($allsector)){
foreach($allsector as $allsectorDetails){
$sid=$allsectorDetails['Sector_ID'];
?>
<option value="<?php echo trim($sid); ?>"><?php echo ucwords($allsectorDetails['Sector']); ?></option>
<?php }} ?>
</select>
</div>
</div>
<div class="card scrol-bar1 questionContainer">
<div style="display:none;" class="loadingSection text-center"><img style="height:35px;" src="<?php echo base_url('assets/niua/img/loading.gif'); ?>"></div>
<h3> All Question (<span class="countQuestion"><?php echo count($allquestion); ?></span>)</h3>
<?php
if(isset($allquestion) && !empty($allquestion)){
foreach($allquestion as $questionDetails){
$qid=$questionDetails['QB_ID'];
$sid=$questionDetails['Sector_ID'];
$sectorName=getSectorName($sid);
$uomDetail=getQuestionUnitOfMeasurement(trim($questionDetails['UOM_ID']));
?>
<div class="card-body3 d-flex" id="questionID<?=$qid?>">
<div class="total-nu2 col-lg-9">
<span><?php echo $questionDetails['Description']; ?></span>                
<div class="value1">
<input readonly type="text" class="form-control d-none" placeholder="">
<strong>UOM : </strong><strong><?php echo ucfirst($uomDetail["UOM"]); ?></strong>   
</div>                                  
</div>
<div class="remove2 addRemoveCless">
<div class="dem-1"><a href="javascript:void(0);" title="<?php echo $sectorName; ?>"><?php echo word_limiter($sectorName,1); ?></a></div> 
<?php 
$QStatus = checkQuestionStatus($Survey_ID,$qid);
?>
<div style="cursor: pointer;" class="rem AlreadyAdded <?=($QStatus==1)?'':'d-none';?>">Added</div>
<div style="cursor: pointer;" class="rem ToBeAdd <?=($QStatus==1)?'d-none':'';?>" data-qid = "<?php echo $qid; ?>">+ Add</div>
</div>
</div>
<?php }}else{ ?>
<p style="color:red; text-align: center; margin-top: 60px;">No question found!</p>
<?php } ?>
</div>
</div>
</div>
</section>