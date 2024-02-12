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
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/jquery-ui.css'); ?>">


<style>
  #toolbarContainer{
    display: none !important;
  }
  .activeSector{
    background-color: #f6f9ff;
  }
  .AllQuestionCount{
    /*float: right;
    font-size: 12px;
    padding: 5px 6px 0px 0px;
    color: #f9f9f9;*/
  }
  .plus_icn{
    float: right;
    font-size: 18px;
  }
  .se-pre-con{
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(<?=base_url('assets/uploads/loader.gif')?>) center no-repeat #3a3939;
    opacity: .7;
  }
  .w-80{
    width: 80%;
  }

  .questionUOMtypeDataAdminSide{
    /*    pointer-events: none;*/
  }

.card-icon2 {
    margin-top: 15px;
    margin-right: 5px;
}
.total-nu1 {
    display: inline-block;
    width: 100%;
}
.total-nu11 {
    width: 100%;
}
.total-nu1 {
    width: 100%;
}

.suffleSectorQuestions{
  display: inline-block;
  float: right;
  font-size: larger;
}

#suffleModalForSectorDataPuttingSpace .mdl-hedr{
      display: flex;
    justify-content: space-around;
    width: 100%;
    align-items: center;
    padding: 10px 0px;
  }
#suffleModalForSectorDataPuttingSpace .mdl-hedr .fnt-sz{
    font-size: 21px;
    color: #0083c4;
    font-weight: 600;
    text-transform: uppercase;
    margin: 0;
}
#suffleModalForSectorDataPuttingSpace .mdl-hedr .fnt-subhead{
  font-size: 13px;
  margin: 0;
}

.ui-accordion .ui-accordion-content {
    padding: 1em 2.2em;
    border-top: 0;
    overflow: auto;
    height: auto!important;
}


.ui-state-active{
    border: 1px solid #c5c5c5;
    background: #f6f6f6;
    font-weight: normal;
    color: #454545;
}
</style>
</head>
<body>
<!-- ======= Header ======= -->
<?php echo view('backend/partials/top_header.php'); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar d-none">
<ul class="sidebar-nav" id="sidebar-nav">
<li class="nav-item">
<a class="nav-link " href="<?php echo base_url('admin/dashboard'); ?>">
<i class="bi bi-grid"></i>
<span>My Dashboard</span>
</a>
</li><!-- End Dashboard Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-menu-button-wide"></i><span> My Beneficiaries </span>
</a>
</li><!-- End Components Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-journal-text"></i><span> My Requests  </span>
</a>
</li><!-- End Forms Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-layout-text-window-reverse"></i><span> My Documents </span>
</a>
</li><!-- End Tables Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-bar-chart"></i><span> My Contributions </span>
</a>
</li><!-- End Charts Nav -->
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-envelope"></i> <span> Help & Support</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
<span> Other</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li>
<a href="">
<i class="bi bi-circle"></i><span> Menu 1 </span>
</a>
</li>
<li>
<a href="">
<i class="bi bi-circle"></i><span> Menu 2 </span>
</a>
</li>
</ul>
</li>
</ul>
</aside>
<main id="main" class="main">

  <div class="SurveyDropDownSelection d-flex justify-content-center mt-3 mb-2">
  <?php if(!empty($surveyListCheck) && count($surveyListCheck)){
    $selectedSurvey = ($SurveySelectedByAdmins && $SurveySelectedByAdmins >  0)?$SurveySelectedByAdmins:'';
    ?>

<select class="form-select" id="Survey_ID" name="Survey_ID" aria-label="Default select example" style="z-index: 1;">
  <option value="0">Select Survey</option>
  <?php foreach($surveyListCheck as $key=>$Survey){?>
  <option class="surveyClassName" value="<?=$Survey['Survey_ID']?>" <?=($Survey['Survey_ID']==$selectedSurvey)?'selected':''?>><?=$Survey['Survey_Name']?></option>
<?php }?>
</select>

<div class="downloadSurveyExcelFileIconShowHide" id="downloadSurveyExcelFile" style="cursor: pointer;z-index: 1;font-size: x-large;
    margin-left: 10px" ><a href="<?php echo base_url('admin/download-survey-question/'.$selectedSurvey); ?>"><i class="bi bi-download"  title="download surevy"></i></a></div>
<?php }else{?>
  <select class="form-select" id="Survey_ID" name="Survey_ID" aria-label="Default select example" style="z-index: 1;">
    <option value="0">No survey found</option>
</select>

<?php }?>
</div>

<div class="SurveyMainDataUpdates" id="SurveyMainDataUpdates" style="margin-top: -60px;">
  <div class="se-pre-con" style="display: none;"></div>
  <div class="pagetitle">
     <?php
     $surveyName='Survey form';
     if(!empty($surveyList) && !empty($surveyList[0])){
        $surveyName=' '.$surveyList[0]["Survey_Name"]." form";
     }
     ?>

    <h1><a title="<?php echo $surveyName; ?>"><?php echo word_limiter($surveyName,5); ?></a></h1>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel"> New Survey </h1>
            <button type="button" class="btn-close" id="closePopUpButton" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-2">
                <label for="Survey_Name" class="col-form-label lable_left">Survey Name<label class="star-red">*</label>:</label>
                <input type="text" class="form-control" id="Survey_Name" name="Survey_Name" placeholder="Please enter survey name">
                <div style="display: block; text-align: left; font-size: 11px;">
                <span><b>Note : </b>Max 100 character allowed.</span></div>
              </div>

              <div class="mb-2">
                <label for="Survey_Name" class="col-form-label lable_left">Is this a UOF survey<label class="star-red">*</label>:</label>
                <select class="form-select" name="is_uof_survey" id="is_uof_survey">
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
                      <option value="0">Select Survey</option>
                      <?php foreach($surveyListCheck as $key=>$Survey){?>
                      <option value="<?=$Survey['Survey_ID']?>"><?=$Survey['Survey_Name']?></option>
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
                <label for="Sector_name" class="col-form-label lable_left">Sector Name<label class="star-red">*</label>:</label>
                <input type="text" class="form-control" id="Sector_Name" name="Sector_Name" placeholder="Please enter sector name">
                <div style="display: block; text-align: left; font-size: 11px;">
                <span><b>Note : </b>Max 100 character allowed.</span></div>
              </div>
              <div class="mb-2">
                <label for="Sector_Description" class="col-form-label lable_left">Description<label class="star-red">*</label>:</label>
                <input type="text" class="form-control" id="Sector_Description" name="Sector_Description" placeholder="Please enter description">
              </div>
              <div class="mb-2">
                <label for="Sector_Icon" class="col-form-label lable_left">Sector Icon<label class="star-red">*</label>:</label>
                <input type="file" class="form-control" id="Sector_Icon" name="Sector_Icon" placeholder="">
                <div style="display: block; text-align: left; font-size: 11px;">
                <span><b>Note : </b>.svg format allowed.</span></div>
              </div>
              <div class="mb-2">
                <label for="Sector_Images" class="col-form-label lable_left">Sector Image<label class="star-red">*</label>:</label>
                <input type="file" class="form-control" id="Sector_Images" name="Sector_Images" placeholder="">
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

    <?php if(!empty($surveyList) && !empty($surveyList[0]) && $surveyList[0]['saved_on']!='' && $surveyList[0]['publish_status']==0){?>
      <p>Last saved on <?=date('d-M-Y h:i:s',strtotime($surveyList[0]['saved_on']))?></p>
    <?php }?>
    

    <?php if(!empty($surveyList) && !empty($surveyList[0]) && $surveyList[0]['saved_on']!='' && $surveyList[0]['publish_status']==1){?>
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
<h5 class="card-title" style="cursor: pointer;"  >
<strong onclick="showSelectedSectorQuestion(0,0)">All SECTORS&nbsp;<span style="color: #fff;" class="AllQuestionCount">(0)</span></strong><i class="bi bi-plus plus_icn" title="Add new sector" id="addNewSector" data-bs-toggle="modal" data-bs-target="#SectorModal" aria-hidden="true"></i></h5>
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

      <div class="suffleSectorQuestions " id="suffleSectorQuestions" data-sector_id="" data-qCount="" data-bs-toggle="modal" data-bs-target="#suffleModalForSector"> <a title="Shuffle Question Order" href="javascript:void(0);"> <i class="bi bi-shuffle"></i>  </a> </div>

      <div class="check-2" id="removeMultipleQuestion"> <a title="Remove All" href="javascript:void(0);"> <i class="bi bi-trash"></i>Remove </a> </div>

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
                      <span class="updateSequence"><?=$key + 1?></span>.&nbsp;&nbsp;<span class="w-80  "><?=$question['Description']?></span>   &nbsp;
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
                            <div class="card-icon2">
                              <div class="down-top-er1"> 
                                <input class="form-check-input flexCheckDefaultClass" type="checkbox" value="<?=trim($question['QB_ID'])?>" >
                              </div>
                            </div>

                            <div class="questionUOMtypeDataAdminSide">
                              <?php
                              $uomDetail=getQuestionUnitOfMeasurement(trim($question['UOM_ID']));
                              if(trim($question['UOM_ID'])==1){ //Number ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" oncopy="return false" onpaste="return false" qb-id="<?php echo $question["QB_ID"] ?>" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==2){ //Number In Cr ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==3){ //Number In Rupees  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($question['UOM_ID'])==4){ //Percentage  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($question['UOM_ID'])==5){ //Mega Watt Hr  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($question['UOM_ID'])==6){ //SQ Km  ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($question['UOM_ID'])==7){ //Micro gm/cu.m ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
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
                                <input  qb-id="<?php echo $question["QB_ID"] ?>" class="radioInput" type="radio" name="radio_option_<?php echo $question["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
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
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div> 
                                <?php } else if(trim($question['UOM_ID'])==10){ //Ipcd ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==11){ //MLD ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==12){ //Number(Score & Rating) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==13){ //Number(In Year) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==14){ //Detail ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><textarea qb-id="<?php echo $question["QB_ID"] ?>" rows="3" cols="50" class="form-control textBoxInput"></textarea>&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==15){ //Number(In Days) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==16){ //Number(In Meters) ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==17){ //Text ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==18){ //kW ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==19){ //kWh ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==20){ //kl ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==21){ //Sq.m ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==22){ //Ratio ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==23){ //Persons Per Sq KM ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
                                <span class="error_msg err" style="color: red;"></span> 
                                </div>
                                <?php } else if(trim($question['UOM_ID'])==24){ //Public Transport Unit (PTU) per 1000 people ?>
                                <div class="total-nu1 ps-3 col-lg-10">
                                
                                <div class="value1"><input value="" qb-id="<?php echo $question["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $question["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
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
                                <?php } ?>
                            </div>
                          </div>        
                        </div>
                      </div>
                  </div>

          <!-- <div class="card-body1 sectorID-<?=$question['Sector_ID']?> toBeRemovedCheck QuestionCard Question_id_<?=trim($question['QB_ID'])?>" >
              <div class="d-flex">
                  <div class="card-icon2">
                      <div class="down-top-er1"> <a href="javascript:void(0);"> <i class="bi bi-chevron-down"></i> </a> </div> 
                      <div class="down-top-er1"> <input class="form-check-input flexCheckDefaultClass" type="checkbox" value="<?=trim($question['QB_ID'])?>" > </div>
                      <div class="down-top-er1"> <a href="javascript:void(0);"> <i class="bi bi-chevron-up"></i> </a> </div>
                  </div>
                  <div class="total-nu1 ps-3 col-lg-10">
                      <span> <span class="updateSequence"><?=$key + 1?></span>. <?=$question['Description']?></span> 
                      <div class="value1">
                        <input readonly type="text" class="form-control d-none" placeholder="">
                        <strong>UOM : </strong><strong><?php echo ucfirst($uomDetail["UOM"]); ?></strong>   
                      </div>                     
                  </div>
                  <div class="remove">
                      <div class="rem" id="removeSigleQuestion" data-qid="<?=trim($question['QB_ID'])
                  ?>"> <a title="Remove Question" href="javascript:void(0);"> <i class="bi bi-trash"></i> Remove </a> </div>                   
                  </div>                   
              </div>
          </div> -->

        <?php  }
      }
      ?>
      </div>
    </div>
  </div>
</form> 
</div>
</div><!-- End Left side columns -->
<!-- Right side columns -->
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
<div class="card-body3" id="questionID<?=$qid?>">
<div class="total-nu2">
<span><?php echo $questionDetails['Description']; ?></span>                
<div class="value1">
  <input readonly type="text" class="form-control d-none" placeholder="">
  <strong>UOM : </strong><strong><?php echo ucfirst($uomDetail["UOM"]); ?></strong>   
</div>                                 
</div>
<div class="remove2 addRemoveCless">
    <div class="dem-1"><a href="javascript:void(0);" title="<?php echo $sectorName; ?>"><?php echo word_limiter($sectorName,1); ?></a></div> 
    <?php 
    $QStatus = checkQuestionStatus('3',$qid);
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
</div>

  <!-- Suffle modal starts here -->
  <div class="modal fade model-wid1" id="suffleModalForSector" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="suffleModalForSectorDataPuttingSpace">
          <!-- suffle sector quistion list data here using ajax call -->


      </div>
    </div>
  <!-- Suffle modal ends here -->



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
</main>











<?php echo view('backend/partials/footer.php'); ?>
<a href="javascript:void(0);" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/jquery-ui.js'); ?>"></script>
<!-- Script for suffle -->
<script src="<?php echo base_url('assets/niua/js/jquery-ui.min.js'); ?>"></script>

<!-- script for suffle ends here -->
<script>
  //Sortable accordions
  $("#accordionFlushExampleSuffle")
  .accordion({
      collapsible: true,
      header: "> div > h2",
      dropOnEmpty: true,
      autoHeight: true,
      active: false
  })
  .sortable({
      axis: "y",
      stop: function() {
          stop1 = true;
      },
      connectWith: '.connectedSortable',
      helper: 'clone',
      axis: undefined
  });
</script>

<script>
$(document).ready(function(){
    $('#suffleSectorQuestions').hide();
     sectorWiseQuestionCount();
     showSelectedSectorQuestion(0,0);
     $('#Survey_ID').trigger('change');
     var surevy_id=$('#Survey_ID').val().trim();
     if(surevy_id > 0){
      $('#downloadSurveyExcelFile').show()
     }else{
      $('#downloadSurveyExcelFile').hide()
     }
})
  function updatetoast(type,text){
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
  $(document).on('click','.ToBeAdd',function(){
      var thisElement = $(this);
      var qid = $(this).attr('data-qid');
      var Survey_ID = $.trim($('#Survey_ID').val());
     
      if(Survey_ID=='' || Survey_ID==0){
        updatetoast('error','Please select atleast one survey');
        return false;
      }
 
        if(qid){
          $.ajax({
              type:'POST',
              url: '<?php echo base_url(); ?>admin/addQuestionToSurvey',
              data: {'qid':qid,'Survey_ID':Survey_ID},
              dataType: "json",
              beforeSend: function(){
                $('.se-pre-con').show();
              },
              complete: function(){
                $('.se-pre-con').hide();
              },
              success: function(response){
                if(response.status==1){
                  var Qcount = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard').length;
                  if(Qcount > 0){
                    $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard:last').after(response.questionHtml);
                  }else{
                    $('#SurveyFormData').find('#accordionFlushExample').html(response.questionHtml);
                  }
                  $(thisElement).parent().find('.ToBeAdd').addClass('d-none');
                  $(thisElement).parent().find('.AlreadyAdded').removeClass('d-none');
                  $('#questionID'+qid).find('#selectQuestion').prop('checked',false);
                  $('#questionID'+qid).find('#selectQuestion').prop('disabled',true);
                  var rows = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
                  fixRowsNums(rows);
                  sectorWiseQuestionCount()
                  updatetoast('success',response.msg);
                  // $('#SelectedSector_'+response.Sector_ID).trigger('click'); removed by client
                  $('.AllQuestionCount').trigger('click');
                }else{
                  updatetoast('error',response.msg);
                }
              }
          });
        }
  })
</script>
<script>
  $(document).on('change','#sectorList', function(){
    var searchVal=$("#searchQuestion").val().trim();
    var Survey_ID=$("#Survey_ID").val().trim();
    //$("#searchQuestion").val('');
    $('.loadingSection').show();
    //alert(this.value);
    var sec=this.value;
    $.ajax({
    type:'POST',
    url: '<?php echo base_url(); ?>admin/getSectorQuestion',
    data: {'sector':sec,'search':searchVal,'Survey_ID':Survey_ID},
    dataType: "json",
   beforeSend: function(){
     $('.loadingSection').show();
   },
   complete: function(){
     $('.loadingSection').hide();
   },
    success: function(response){
      //console.log(response);
      $('.questionContainer').html('');
      $('.questionContainer').append(response.html);
    }
    });
});
</script>

<script>
  //Search Question...
  //Setup before functions
  var typingTimer; //timer identifier
  var doneTypingInterval=5000;  //time in ms, 5 seconds for example

  //on keyup, start the countdown
  $(document).on('keyup','#searchQuestion' ,function () {
      $('.loadingSection').show();
      clearTimeout(typingTimer);
      typingTimer=setTimeout(doneTyping, doneTypingInterval);
  });
  //on keydown, clear the countdown 
  $(document).on('keydown','#searchQuestion', function () {
      $('.loadingSection').show();
      clearTimeout(typingTimer);
  });



  //user is "finished typing," do something
  function doneTyping(){
   $('.loadingSection').show();
   var sec=$("#sectorList").val().trim();
   var inputVal=$('#searchQuestion').val().trim();
   var Survey_ID=$('#Survey_ID').val().trim();
   var Sector_ID=$('#sectorList').val().trim();
   //alert(`${sec}   :::: ${inputVal}`);
   $.ajax({
   type:'POST',
   url: '<?php echo base_url(); ?>admin/searchSectorQuestion',
   data: {'sector':sec,'searchKey':inputVal,'Survey_ID':Survey_ID,'Sector_ID':Sector_ID},
   dataType: "json",
   beforeSend: function(){
   $('.loadingSection').show();
   },
   complete: function(){
   $('.loadingSection').hide();
   },
    success: function(response){
      //console.log(response);
      $('.questionContainer').html('');
      $('.questionContainer').append(response.html);
    }
    });
  }
</script>
<script>
$(document).on('click', '.sectorSection', function(e){
    e.preventDefault();

    $('.sectorSection').removeClass('activeSector');
    $(this).addClass('activeSector');
    var Sector_ID = $(this).attr('data-sector');
    var qCount = $(this).find('.sectorWiseQuestionCount').text().trim();
    showSelectedSectorQuestion(Sector_ID,qCount);
});


function showSelectedSectorQuestion(id,qCount){
    if(id > 0 && qCount > 0){
      $('#suffleSectorQuestions').show();
      $('#suffleSectorQuestions').attr('data-sector_id',id);
      $('#suffleSectorQuestions').attr('data-qCount',qCount);
    }else{
      
      $('#suffleSectorQuestions').attr('data-sector_id',0);
      $('#suffleSectorQuestions').attr('data-qCount',0);
      $('#suffleSectorQuestions').hide();
    }
  var rows = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
  if(id > 0){
      var countOFQuestionOfSector = $('#SurveyFormData').find('#accordionFlushExample').find('.sectorID-'+id);
      if(countOFQuestionOfSector.length==0){
        $('#noDataFound').show();
      }else{
        $('#noDataFound').hide();
      }
  }else{
    if(rows.length==0){
        $('#noDataFound').show();
      }else{
        $('#noDataFound').hide();
      }
  }
  
  if(id > 0){
    fixRowsNums(countOFQuestionOfSector);
    $.each(rows, function (i, v) {
      if($(v).hasClass("sectorID-"+id)){
        $(v).addClass('toBeRemovedCheck').show();
      }else{
        $(v).removeClass('toBeRemovedCheck').hide();
      }
    });
  }else{
    fixRowsNums(rows);
    $.each(rows, function (i, v) {
        $(v).addClass('toBeRemovedCheck').show();
    });
  }
}

function sectorWiseQuestionCount(){
    var totalQuestions = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard').length;
    $('.AllQuestionCount').text('('+totalQuestions+')');
    if(totalQuestions==0){
      $('#noDataFound').show();
    }else{
      $('#noDataFound').hide();
    }
    var sector_names = $('#selectListData').find('li');
    $.each(sector_names,function(i,val){
      var Sector_ID = $(val).attr('data-sector');
      var countOFQuestions = $('#SurveyFormData').find('#accordionFlushExample').find('.sectorID-'+Sector_ID).length;
      $(val).find('.sectorWiseQuestionCount').text(countOFQuestions)
    })
}

$(document).on('click','#removeSigleQuestion',function(e){
  e.preventDefault();
    var thisElement = $(this);
    var qid = $(this).attr('data-qid');
    var Survey_ID = $('#Survey_ID').val();
    if(Survey_ID=='' || Survey_ID==0){
      updatetoast('error','Please select atleast one survey');
      return false;
    }

    Swal.fire({
       icon: "question",     
       type: 'question',
       text: 'Are you sure,you want to remove this question?',
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
            url: '<?php echo base_url(); ?>admin/removeSigleQuestion',
            data: {'Survey_ID':Survey_ID,'qid':qid},
            dataType: "json",
            beforeSend: function(){
            $('.loadingSectionMainForm').show();
            },
            complete: function(){
            $('.loadingSectionMainForm').hide();
            },
            success: function(response){
              if(response.status==1){
                $(thisElement).parents('.QuestionCard').remove();
                $('#questionID'+qid).find('.AlreadyAdded').addClass('d-none');
                $('#questionID'+qid).find('.ToBeAdd').removeClass('d-none');
                sectorWiseQuestionCount();
                var rows = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
                if(rows.length > 0){
                  fixRowsNums(rows);
                }else{
                  $('#noDataFound').show();
                }              
                $('.AllQuestionCount').trigger('click');
                updatetoast('success',response.msg);
              }else{
                updatetoast('error',response.msg);
              }
            }
        });
      } 
    });
})

$(document).on('click','.flexCheckDefaultClass',function(){
  var all_checked = 1;
  if($(this).is(':checked')){
    var dataLength = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
      $.each(dataLength,function(i,che){
          if(!$(che).find('.flexCheckDefaultClass').is(":checked")){
            all_checked =0;
          }
      });
  }else{
    all_checked =0;
  }
  if(all_checked==1){
    $('#allflexCheckDefault').prop('checked',true);
  }else{
    $('#allflexCheckDefault').prop('checked',false);
  }
})

$(document).on('click','#removeMultipleQuestion',function(e){
  e.preventDefault();
    var Survey_ID = $('#Survey_ID').val();
    if(Survey_ID=='' || Survey_ID==0){
      updatetoast('error','Please select atleast one survey');
      return false;
    }
    var questionList = [];
    var dataLength = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
      $.each(dataLength,function(i,che){
        if($(che).hasClass('toBeRemovedCheck')){
          if($(che).find('.flexCheckDefaultClass').is(":checked")){
            questionList.push($(che).find('.flexCheckDefaultClass').attr('value'))
          }
        }
      });

      if(questionList.length > 0){
        Swal.fire({
          icon: "question",     
          type: 'question',
          text: 'Are you sure,you want to remove all selected questions?',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes, remove all!',
          cancelButtonText: "No, keep it",
          closeOnConfirm: false,
          closeOnCancel: false
        }).then((result) => {
              if (result.value) {
                  $.ajax({
                      type:'POST',
                      url: '<?php echo base_url(); ?>admin/removeMultipleQuestion',
                      data: {'Survey_ID':Survey_ID,'questionList':questionList},
                      dataType: "json",
                      beforeSend: function(){
                      $('.loadingSectionMainForm').show();
                      },
                      complete: function(){
                      $('.loadingSectionMainForm').hide();
                      },
                      success: function(response){
                        if(response.status==1){
                          $.each(questionList,function(i,v){
                            $('#SurveyFormData').find('#accordionFlushExample').find('.Question_id_'+v).remove();
                            $('#questionID'+v).find('.AlreadyAdded').addClass('d-none');
                            $('#questionID'+v).find('.ToBeAdd').removeClass('d-none');
                          })
                          var rows = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
                          showSelectedSectorQuestion(rows.length,0)
                          sectorWiseQuestionCount();
                          $('#allflexCheckDefault').prop('checked',false)
                          if(rows.length > 0){
                            fixRowsNums(rows);  
                          }
                          $('.AllQuestionCount').trigger('click');
                          updatetoast('success',response.msg);
                        }else{
                          updatetoast('error',response.msg);
                        }
                      }
                  });
              } 
        });
      }
})

$(document).on('click','#allflexCheckDefault',function(){
  var dataLength = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
  if($('#allflexCheckDefault').is(":checked")){
      $.each(dataLength,function(i,che){
        if($(che).hasClass('toBeRemovedCheck')){
            $(che).find('.flexCheckDefaultClass').prop('checked', true)
        }
      })
  }else{
      $.each(dataLength,function(i,che){
        $(che).find('.flexCheckDefaultClass').prop('checked', false)
      })    
  }
})

function fixRowsNums(rows) {
    $.each(rows, function (i, v) {
        $(v).find('.updateSequence:first').text(i + 1);
    });
}
</script>


<script>
  $(document).on('click','#saveSurvey',function(){
    var Survey_ID = $('#Survey_ID').val().trim();
    Swal.fire({
       icon: "question",     
       type: 'question',
       text: 'Are you sure,you want to save this survey form?',
       showCancelButton: true,
       confirmButtonClass: 'btn-danger',
       confirmButtonText: 'Yes',
       cancelButtonText: "No",
       closeOnConfirm: false,
       closeOnCancel: false
    }).then((result) => {
      if (result.value) {
        $('.se-pre-con').show();
        $.ajax({
            type:'POST',
            url: '<?php echo base_url(); ?>admin/save-survey',
            data: {'Survey_ID':Survey_ID},
            dataType: "json",
            success: function(response){ 
              $('.se-pre-con').hide();
              if(response.status==1){
                updatetoast('success', response.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
              }else{
                updatetoast('error', response.msg);
              }             
            }
        });
      } 
    });
  });  
</script>

<script>
  $(document).on('click','#publishSurvey',function(){
    var Survey_ID = $('#Survey_ID').val().trim();
    Swal.fire({
       icon: "question",     
       type: 'question',
       text: 'Are you sure you want to publish the form for cities?(The form can not be edited once published)',
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
            url: '<?php echo base_url(); ?>admin/publish-survey',
            data: {'Survey_ID':Survey_ID},
            dataType: "json",
            success: function(response){ 
              if(response.status==1){
                updatetoast('success', response.msg);
              }else{
                updatetoast('error', response.msg);
              }             
            }
        });
      } 
    });
  });  
</script>
<script>
  // $(function(){
  //   $(".start_datepicker").datepicker({
  //     dateFormat:'dd-mm-yy'
  //   });
  // });

   $(document).ready(function(){
      $("#To_Date").datepicker({
          dateFormat:'dd-mm-yy'
      });
      $('#From_Date').datepicker({
          dateFormat:'dd-mm-yy',
        minDate:new Date()
      })
  });

  $(document).on('click','#saveNewSurvey',function(){
    var survey_Name = $.trim($('#Survey_Name').val());
    var description = $.trim($('#Description').val());
    var From_Date = $.trim($('#From_Date').val());
    var To_Date = $.trim($('#To_Date').val());
    var Import_From_Survey_ID = $.trim($('#Import_From_Survey_ID').val());
    if(survey_Name==''){
      updatetoast('error', 'Pease enter survey name');
      $('#Survey_Name').focus();
      return false;
    }else{
      var survey_Name_length = survey_Name.length;
      if(survey_Name_length > 100){
        updatetoast('error', 'Survey name should be less than 100 characters');
        $('#Survey_Name').focus();
        return false;
      }
    }
    if(description==''){
      updatetoast('error', 'Pease enter description');
      $('#Description').focus();
      return false;
    }else{
      var description_length = description.length;
      if(description_length > 500){
        updatetoast('error', 'description should be less than 500 characters');
        $('#Description').focus();
        return false;
      }
    }
    if(From_Date==''){
      updatetoast('error', 'Pease enter survey start date');
      $('#From_Date').focus();
      return false;
    }
    if(To_Date==''){
      updatetoast('error', 'Pease enter survey end date');
      $('#From_Date').focus();
      return false;
    }
    var is_uof=$("#is_uof_survey").val();
    var survey_year=$("#survey_year").val();
    $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/addNewSurvey',
        data: {'Survey_Name':survey_Name,'Description':description,'From_Date':From_Date,'To_Date':To_Date,'Import_From_Survey_ID':Import_From_Survey_ID,'is_uof':is_uof,'survey_year':survey_year},
        dataType: "json",
        success: function(response){ 
          if(response.status==1){
            $('#closePopUpButton').trigger('click');
            updatetoast('success', response.msg);
            $('#Survey_ID').find('.surveyClassName:first').before(response.data);
            setTimeout(function() {
                        location.reload();
            }, 1000);
          }else{
            updatetoast('error', response.msg);
          }             
        }
    });
  })

  $(document).on('change','#Survey_ID',function(){
    var Survey_ID = $.trim($('#Survey_ID').val());
    if(Survey_ID > 0){
      $('#downloadSurveyExcelFile').show();
      $('#downloadSurveyExcelFile').find('a').attr('href','<?=base_url('admin/download-survey-question/')?>'+Survey_ID)
    }else{
      $('#downloadSurveyExcelFile').hide()
    }
    // if(Survey_ID > 0){
      $('.se-pre-con').show();
      $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/surveyDetailsDataAjax',
        data: {'Survey_ID':Survey_ID},
        dataType: "json",
        success: function(response){ 
          $('.se-pre-con').show();
          if(response.status==1){
            $('#SurveyMainDataUpdates').html(response.survey_html);
            $('#SurveyMainDataUpdates').show();
            $('#suffleSectorQuestions').hide();
            var rows = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
            sectorWiseQuestionCount();
            // $(".start_datepicker").datepicker({
            //   dateFormat:'dd-mm-yy'
            // });


                $("#To_Date").datepicker({
                    dateFormat:'dd-mm-yy'
                });
                $('#From_Date').datepicker({
                    dateFormat:'dd-mm-yy',
                  minDate:new Date()
                })


            if(rows.length > 0){
              fixRowsNums(rows);  
            }
          }             
        }
      });
    // }else{
    //   $('#SurveyMainDataUpdates').hide();
    // }
  })
$(document).on('click','#saveNewSector',function(){
  var sector_Name = $.trim($('#Sector_Name').val());
  var sector_Description = $.trim($('#Sector_Description').val());
  var sector_Icon = $.trim($('#Sector_Icon').val());
  var extcat_Sector_Icon = sector_Icon.split('.').pop();
  var sector_Images = $.trim($('#Sector_Images').val());
  var extcat_sector_Images = sector_Images.split('.').pop();
  if(sector_Name==''){
    updatetoast('error','Please enter sector name');
    $('#Sector_Name').focus();
    return false;
  }else{
    if(sector_Name.length > 100){
      updatetoast('error','Sector name should be less than 100 characters');
    $('#Sector_Name').focus();
    return false;
    }
  }
  if(sector_Description==''){
    updatetoast('error','Please enter sector description');
    $('#Sector_Description').focus();
    return false; 
  }else{
    if(sector_Description.length > 500){
      updatetoast('error','Description should be less than 500 characters');
      $('#Sector_Description').focus();
      return false;
    }
  }


  if(sector_Icon!=''){
    if($.inArray(extcat_Sector_Icon,['svg']) == -1){
      updatetoast('error','Please attach .svg image format only');
      $('#Sector_Icon').val('');
      return false; 
    }
  }else{
      updatetoast('error','Please attach sector icon');
      return false;
  }
  if(sector_Images!=''){
    if($.inArray(extcat_sector_Images,['png','PNG','jpg','JPG','jpeg','JPEG']) == -1){
      updatetoast('error','Please attach .png, .jpg, .jpeg  image format only'); 
      $('#Sector_Images').val('');    
      return false; 
    }
  }else{
      updatetoast('error','Please attach sector image');
      return false;
  }

    var form_data = new FormData();
    form_data.append('Sector',sector_Name);
    form_data.append('Description',sector_Description);
    if($("#Sector_Images")[0].files.length > 0){
     form_data.append('sectorIcon',$('#Sector_Icon')[0].files[0]);
    }
    if($("#Sector_Images")[0].files.length!=0){
       form_data.append('sectorBackground',$('#Sector_Images')[0].files[0]);
    }

    $.ajax({
      url         : '<?php echo base_url(); ?>admin/addNewSector',   
      dataType    : 'text',         
      cache       : false,
      contentType : false,
      processData : false,
      data        : form_data,                        
      type        : 'post',
      success     : function(res){
        var response = JSON.parse(res);
        if(response.status==1){
          updatetoast('success',response.msg); 
          setTimeout(function() {
                        location.reload();
            }, 1000);                
        }else{
          updatetoast('error',response.msg);    
        }
      }       
    });
})

$(document).on('click','#allsectorQuestions',function(){
  var sectorQuestionCards = $('.questionContainer').find('.card-body3');
  if($('#allsectorQuestions').is(':checked')){
      $.each(sectorQuestionCards,function(i,check){
        console.log($(check).find('.selectQuestion').prop('disabled'),' check desabled')
        if(!$(check).find('.selectQuestion').prop('disabled')){
          $(check).find('.selectQuestion').prop('checked',true);
        }
      })
  }else{
      $.each(sectorQuestionCards,function(i,check){
        if(!$(check).find('.selectQuestion').prop('disabled')){
          $(check).find('.selectQuestion').prop('checked',false);
        }
      })
  }
})

$(document).on('click','#selectQuestion',function(){
  var all_checked = 1;
  if($(this).is(':checked')){
    var dataLengthqlist = $('.questionContainer').find('.card-body3');
      $.each(dataLengthqlist,function(i,check){
          if(!$(check).find('.selectQuestion').is(":checked") && !$(check).find('.selectQuestion').prop('disabled')){
            all_checked =0;
          }
      });
  }else{
    all_checked =0;
  }
  if(all_checked==1){
    $('#allsectorQuestions').prop('checked',true);
  }else{
    $('#allsectorQuestions').prop('checked',false);
  }
})

$(document).on('click','#addMultipleQuestion',function(){
  var Sector_ID = $.trim($('#sectorList').val());
  var Survey_ID = $.trim($('#Survey_ID').val());
  if(Survey_ID=='' || Survey_ID==0){
    updatetoast('error','Please select atleast one survey');
    return false;
  }
  var selectQuestinList =[];
  var dataLengthqlist = $('.questionContainer').find('.card-body3');
    $.each(dataLengthqlist,function(i,che){
        if($(che).find('.selectQuestion').is(":checked")){
          selectQuestinList.push($(che).find('.selectQuestion').attr('value'))
        }
    });

    if(selectQuestinList.length > 0 && Sector_ID!=''){
      $('.se-pre-con').show();
      $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/addMultipleQuestion',
        data: {'Sector_ID':Sector_ID,'Survey_ID':Survey_ID,'selectQuestinList':selectQuestinList},
        dataType: "json",
        success: function(response){ 
          $('.se-pre-con').hide();
          if(response.status==1){
                var Qcount = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard').length;
                  if(Qcount > 0){
                    $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard:last').after(response.data);
                  }else{
                    $('#SurveyFormData').find('#accordionFlushExample').html(response.data);
                  }
                $.each(selectQuestinList,function(i,v){
                  $('#questionID'+v).find('#selectQuestion').prop('checked',false);
                  $('#questionID'+v).find('#selectQuestion').prop('disabled',true);
                  $('#questionID'+v).find('.AlreadyAdded').removeClass('d-none');
                  $('#questionID'+v).find('.ToBeAdd').addClass('d-none');
                })
                var rows = $('#SurveyFormData').find('#accordionFlushExample').find('.QuestionCard');
                showSelectedSectorQuestion(rows.length,0)
                sectorWiseQuestionCount();
                $('#allsectorQuestions').prop('checked',false);
                if(rows.length > 0){
                  fixRowsNums(rows);  
                }
                $('#SelectedSector_'+response.Sector_ID).trigger('click');
                updatetoast('success',response.msg);
          }else{
            updatetoast('error',response.msg);
          }
        }
      });
    }
})

$(document).on('click','#suffleSectorQuestions',function(){
  var Survey_ID = $.trim($('#Survey_ID').val());
  var sector_id = $.trim($(this).attr('data-sector_id'));
  var qCount = $.trim($(this).attr('data-qcount'));
  if(Survey_ID > 0 && sector_id > 0 && qCount > 0){
    $.ajax({
          type:'post',
          url: '<?=base_url('admin/getSuffleSectorQuestionData')?>',
          data: {'sector_id':sector_id,'Survey_ID':Survey_ID,'qCount':qCount},
          success: function(response){ 
            var res = JSON.parse(response);
            if(res.status==1){
              $('#suffleModalForSectorDataPuttingSpace').html(res.modal_html)
              $("#accordionFlushExampleSuffle")
                .accordion({
                    collapsible: true,
                    header: "> div > h2",
                    dropOnEmpty: true,
                    autoHeight: true,
                    active: false
                })
                .sortable({
                    axis: "y",
                    stop: function() {
                        stop1 = true;
                    },
                    connectWith: '.connectedSortable',
                    helper: 'clone',
                    axis: undefined
                });               
            }else{
              $('#closePopUpButton').trigger('click');
            }
          }
        });
  }else{
    $('#closePopUpButton').trigger('click')
  }
})
</script>

<script>
$(document).on('click','#saveSuffledData',function(){
    var dataArray = [];
    var Survey_ID = $.trim($('#Survey_ID').val());
    var listData = $('#questionListToBeSuffledHere').find('.getSuffleIdexForSectorQuestions');
    $.each(listData,function(i,item){
      var question_id = $(item).attr('data-QB_ID');
      var sector_id = $(item).attr('data-Sector_ID');
      var sort_order = i+1;
      dataArray.push({'question_id':question_id,'sort_order':sort_order,'sector_id':sector_id});
    })
    $.ajax({
      type:'post',
      url: '<?=base_url('admin/update_sort_order')?>',
      data: {'Survey_ID':Survey_ID,'dataArray':dataArray},
      success: function(response){ 
        console.log(response);
        var res = JSON.parse(response);
        if(res.status==1){
          $('#suffleModalForSectorDataPuttingSpace').find('#closePopUpButton').click()
          updatetoast('success',res.msg);
          location.reload();
        }else{
          updatetoast('error',res.msg);
        }
      }
    });
})
</script>


<script>
$(document).on('click','.ChildQuestionListDataShow',function(){
  var this_ChilD_Div_Value = $(this).val();
  console.log(this_ChilD_Div_Value,' this_ChilD_Div_Value')
  // var this_ChilD_Div_Value2 = this_ChilD_Div_Value.replace(/[ ]/g,'');
  var this_ChilD_Div_Value2 = this_ChilD_Div_Value.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
  console.log(this_ChilD_Div_Value2,' this_ChilD_Div_Value2')
  var qb_id = $(this).attr('qb-id');
  var elementData = $(this).parents('.value1').find('.ps-2');
  $.each(elementData,function(i,childdiv){
    if($(childdiv).attr('id') == 'ParentQuestionOptionData_'+qb_id+'_'+this_ChilD_Div_Value2){
      $(childdiv).show();
    }else{
      $(childdiv).hide();
    }
  })
})
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
</body>
</html>