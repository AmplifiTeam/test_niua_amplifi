
<!DOCTYPE html>
<html lang="en">
<!-- ValidatorProgressStatus -->
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
<link rel="stylesheet" href="<?php echo base_url('assets/vanilla_selectbox/css/vanillaSelectBox.css'); ?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<style >
#toolbarContainer{
  display: none!important;
}
.data-subm1 {
    display: inline-block !important;
    overflow-x: auto;
    overflow-y: hidden;
    width: 100%;
    white-space: nowrap;
}
.nav{
  display: inline-flex!important;
  flex-wrap: nowrap;
}
::-webkit-scrollbar {
  height: 5px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
::-webkit-scrollbar-thumb {
  background: #888; 
}
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>  
</head>
<body>
<?php echo view('backend/partials/top_header.php'); ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <p>
        <a href="<?=base_url('admin/myjobs')?>"><i class="bi bi-chevron-left"></i> Back </a>
      </p>
      <h1> All Jobs : Status </h1>
      <?php if(!empty($jobData)){?>
            <p class="job1">Job Id:&nbsp<?=$jobData['job_id']?> &nbsp; Sector:&nbsp<?=getSectorName($jobData['sector_id'])?> &nbsp; Creation Date:&nbsp<?=date('d-m-Y',strtotime($jobData['created_on']))?></p>
        <?php } ?>
    </div>
    <!-- End Page Title -->
    <section class="section2 dashboard">
      <div class="row">
        <div class="col-lg-12">         
          <div class="data-subm1">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <?php if(!empty($cityListData)){
                foreach($cityListData as $Ckey=>$city){
                ?>
              <li class="nav-item" role="presentation">
                <button class="nav-link <?=($Ckey==0)?'active':''?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home<?=$city['city_id']?>" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?=$city['city_Name']?></button>
              </li>
            <?php }} ?>
            </ul>            
          </div>
          <div class="tab-content" id="pills-tabContent">
            <?php if(!empty($cityListData)){
                foreach($cityListData as $Ckey=>$cityListData){
                ?>
            <div class="tab-pane fade show <?=($Ckey==0)?'active':''?>" id="pills-home<?=$cityListData['city_id']?>" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="vald1" data-city_Name="<?=$cityListData['city_Name']?>">Validator 1 - <?=$jobData['v1_name']?></h3>
                  <div class="all-no1">
                    <ul>
                     <li> All  &nbsp; <span class="val-col1"> <?=$cityListData['allQuestionCount']?> </span> </li>
                     <li> Approved  &nbsp; <span class="val-col2"> <?=$cityListData['approvedByV1']?>  </span> </li>
                     <li> Rejected  &nbsp; <span class="val-col3"> <?=$cityListData['rejectedByV1']?> </span> </li>
                     <li> Revert with comment  &nbsp; <span class="val-col4"> <?=$cityListData['revertToCityByV1']?> </span> </li>
                  </ul>
                  </div>
                  <div class="tot-nub1">
                     <?php
                     
                    foreach($cityListData['questionList'] as $qkey=>$allQuestiondetails){
                      
                      $ans = $allQuestiondetails['Value'];
                      $uomDetail=getQuestionUnitOfMeasurement(trim($allQuestiondetails['UOM_ID']));
                      $getCityAnswer=getAnswer($allQuestiondetails['Survey_ID'],$allQuestiondetails['Sector_ID'],$allQuestiondetails['QB_ID'],$cityListData['city_id']);
                      ?>
                    <div class="tol-sec1 d-flex" style="pointer-events:none;">
                        
                          <?php if(trim($allQuestiondetails['UOM_ID'])==1){ //Number ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn tooltipBtn" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==2){ //Number In Cr ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==3){ //Number In Rupees  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==4){ //Percentage  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control percentage_niua numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==5){ //Mega Watt Hr  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==6){ //SQ Km  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==7){ //Micro gm/cu.m
 ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==8){ //Select One Option ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
$options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12">
<label class="customradio">
<span class="radiotextsty"><?php echo ucfirst($option_detail["options"]); ?></span>
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="radioInput" type="radio" name="v1_radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle "><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


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
<input <?php if(trim($ans)==trim($option_detail["options"])){ echo "checked"; } ?> qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="ChildQuestionListDataShow parent_child_conditional_option" type="radio" name="v1_radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" id="radio_option_<?php echo $allQuestiondetails["QB_ID"] ?>" value="<?php echo trim($option_detail["options"]); ?>" />
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
$getChildAnswer=getAnswer($cityListData['survey_id'],$cityListData['sector_id'],$child,$cityListData['city_id'],$allQuestiondetails["QB_ID"],$ans);
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
<span class="questiontitle"><?php echo ($qkey +1).".".$child_i." : ".$childDetail["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?> parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="v1_radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
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
<span class="questiontitle "><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
if($allQuestiondetails['sub_question']!=''){
  $childQuestionsArray = json_decode($allQuestiondetails['sub_question']);
}else{
  $childQuestionsArray = [];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
$getChildAnswer=getAnswer($cityListData['survey_id'],$cityListData['sector_id'],$childQuestion,$cityListData['city_id'],$allQuestiondetails["QB_ID"]);
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
<span class="questiontitle"><?= ($qkey + 1).'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


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
<div class="conditional_option_section avlok">
<input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?> parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="v1_radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />

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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>

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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?= $qkey.'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php if(($keyOption+1)==1){echo $calculatedFirstValue;}else{ echo $calculatedSecondValue;} ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="numberOnly form-control calculatedQuestionTextBoxInput calculatedQuestionInput_<?=$keyOption+1?>" oncopy="return false" onpaste="return false" placeholder="<?php echo $childDetail["question_placeholder"]; ?>" data-calculation_action="<?php echo $allQuestiondetails["calculation_type"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }}} ?>

</div>
</div>
<?php } ?>   

                        <div class="remove">
                          <?php if($allQuestiondetails['validator_1_status']==1){?>
                            <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Approved by V1 </a>
                            <?php }elseif($allQuestiondetails['validator_1_status']==2){?>
                              <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i>Rejected by V1 </a>
                            <?php }elseif($allQuestiondetails['validator_1_status']==3){?>
                              <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Revert With Comment by V1 </a>
                            <?php }else{ ?>
                              <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Not Attempted </a>
                           <?php } ?>          
                        </div>                   
                    </div>
                  <?php }?>
                  </div>
                </div> 







































                <div class="col-lg-6" >
                  <h3 class="vald1 " data-city_Name="<?=$cityListData['city_Name']?>">  Validator 2 -<?=$jobData['v2_name']?></h3>
                  <div class="all-no1">
                    <ul>
                     <li> All  &nbsp; <span class="val-col1"> <?=$cityListData['allQuestionCount']?> </span> </li>
                     <li> Approved  &nbsp; <span class="val-col2"> <?=$cityListData['approvedByV2']?>  </span> </li>
                     <li> Rejected  &nbsp; <span class="val-col3"> <?=$cityListData['rejectedByV2']?> </span> </li>
                     <li> Revert with comment  &nbsp; <span class="val-col4"> <?=$cityListData['revertToCityByV2']?> </span> </li>
                  </ul>
                  </div>
                  <div class="tot-nub1" >
                    <?php
                    foreach($cityListData['questionList'] as $qkey=>$allQuestiondetails){

                      $ans = $allQuestiondetails['Value'];
                      $uomDetail=getQuestionUnitOfMeasurement(trim($allQuestiondetails['UOM_ID']));
                      $getCityAnswer=getAnswer($allQuestiondetails['Survey_ID'],$allQuestiondetails['Sector_ID'],$allQuestiondetails['QB_ID'],$cityListData['city_id']);





                      ?>
                    <div class="tol-sec1 d-flex" style="pointer-events:none;">
<?php if(trim($allQuestiondetails['UOM_ID'])==1){ //Number ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn tooltipBtn" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==2){ //Number In Cr ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==3){ //Number In Rupees  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control onlyNumberRequired textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==4){ //Percentage  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control percentage_niua numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==5){ //Mega Watt Hr  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==6){ //SQ Km  ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==7){ //Micro gm/cu.m
 ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly valid_KM_niua textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==8){ //Select One Option ?>
<div class="total-nu1 ps-2">
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle "><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


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
$getChildAnswer=getAnswer($cityListData['survey_id'],$cityListData['sector_id'],$child,$cityListData['city_id'],$allQuestiondetails["QB_ID"],$ans);
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
<span class="questiontitle"><?php echo ($qkey +1).".".$child_i." : ".$childDetail["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<div class="conditional_option_section ">
<input style="cursor: pointer;" <?php if(str_contains($childAnswer, trim($get_parent_child_option_detail["options"]))){ echo "checked"; } ?>  parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" class="childTextBoxInput" type="radio" name="radio_option_<?php echo $childDetail["QB_ID"].$allQuestiondetails["QB_ID"]; ?>" value="<?php echo trim($get_parent_child_option_detail["options"]); ?>" />
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
<span class="questiontitle "><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
<?php
if($allQuestiondetails['sub_question']!=''){
  $childQuestionsArray = json_decode($allQuestiondetails['sub_question']);
}else{
  $childQuestionsArray = [];
}
if(!empty($childQuestionsArray)){
foreach($childQuestionsArray as $keyOption=>$childQuestion){
$getChildAnswer=getAnswer($cityListData['survey_id'],$cityListData['sector_id'],$childQuestion,$cityListData['city_id'],$allQuestiondetails["QB_ID"]);
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
<span class="questiontitle"><?= ($qkey + 1).'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>


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
<div class="conditional_option_section pachouri">
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>

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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?php echo $qkey + 1; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span class="questiontitle"><?= $qkey.'.'.$keyOption + 1?> : <?php echo $childDetail["Description"]; ?>&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php if(($keyOption+1)==1){echo $calculatedFirstValue;}else{ echo $calculatedSecondValue;} ?>" style="width: 118px" parent-qb_id="<?php echo $allQuestiondetails["QB_ID"] ?>" qb-id="<?php echo $childDetail["QB_ID"] ?>" type="text" class="numberOnly form-control calculatedQuestionTextBoxInput calculatedQuestionInput_<?=$keyOption+1?>" oncopy="return false" onpaste="return false" placeholder="<?php echo $childDetail["question_placeholder"]; ?>" data-calculation_action="<?php echo $allQuestiondetails["calculation_type"]; ?>"></div>
<span class="error_msg err" style="color: red;"></span>
</div>
<?php }}} ?>

</div>
</div>
<?php } ?>   
                        











                        <div class="remove">
                          <?php if($allQuestiondetails['validator_2_status']==1){?>
                            <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Approved by V2 </a>
                            <?php }elseif($allQuestiondetails['validator_2_status']==2){?>
                              <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Rejected by V2 </a>

                            <?php }elseif($allQuestiondetails['validator_2_status']==3){?>
                              <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Revert With Comment by V2 </a>
                            <?php }else{ ?>
                              <a class="dem-but1 dem-but2" href="#"><i class="bi bi-check-circle-fill"></i> Not Attempted </a>
                           <?php } ?>           
                        </div>                   
                    </div>
                  <?php }?>
                  </div>
                </div>
              </div>
            </div>
            <?php }} ?>
          </div>
        </div>        
      </div>
    </section>
  </main><!-- End #main -->
<?php echo view('backend/partials/footer.php'); ?>
 <script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
  <script src=" https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script >
  $(document).ready(function(){
    var dataList = $('.col-lg-6');
    $.each(dataList,function(j,list){
      var questionCard = $(list).find('.tol-sec1').find('.ChildQuestionListDataShow');
      $.each(questionCard,function(i,card){
        if($(card).is(':checked')){
          var qb_id = $(card).attr('qb-id');
          var checkedValue = $(card).val();
          var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
          $(list).find('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).show();
        }else{
          var qb_id = $(card).attr('qb-id');
          var checkedValue = $(card).val();
          var checkedValue2 = checkedValue.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
          $(list).find('#ParentQuestionOptionData_'+qb_id+'_'+checkedValue2).hide();
        }
      })
    })
})
  </script>
</body>
</html>