<?php
$logedInUserDetail=session('admin_detail');
//print_data($logedInUserDetail);
$loginUserCity=$logedInUserDetail['City_ID'];
$surveyId=$surveyId;
$sectorId=$sectorId;
//die("Sector Id : ".$sectorId." Survey Id :: ".$surveyId);
$getStatus=getSurveySubmissionStatus($surveyId,$loginUserCity);
if(!empty($getStatus)){
  $openRemark=1;
  $openUploadDocumentPopup=1;
}else{
  $openRemark=0;
  $openUploadDocumentPopup=0;
}

$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City'];
$loginUserRole=$logedInUserDetail['role'];
$loginUserCityId=$logedInUserDetail['City_ID'];
$i=1;
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
  $ans=trim($getCityAnswer["Value"]);
}else{
  $ans="";
}
//echo $ans;
//print_r($uomDetail);
?>
<div class="card-body1" data-qb_id="<?=$allQuestiondetails["QB_ID"]?>">
<div class="d-flex">
<div class="card-icon2">
<div class="down-top-er1">
<a href="javascript:void(0);"><i qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="bi <?php echo $bookmarkStatus; ?> addToBookmark"></i></a>
</div>
</div>
<?php if(trim($allQuestiondetails['UOM_ID'])==1){ //Number ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button style="pointer-events: all;" type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==2){ //Number In Cr ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==3){ //Number In Rupees  ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==4){ //Percentage  ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==5){ //Mega Watt Hr  ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==6){ //SQ Km  ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==7){ //Micro gm/cu.m ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==8){ //Select One Option ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div> 
<?php } else if(trim($allQuestiondetails['UOM_ID'])==10){ //Ipcd ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==11){ //MLD ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==12){ //Number(Score & Rating) ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==13){ //Number(In Year) ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==14){ //Detail ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><textarea qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" rows="3" cols="50" class="form-control textBoxInput"><?php echo $ans; ?></textarea>&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==15){ //Number(In Days) ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==16){ //Number(In Meters) ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control numberOnly textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==17){ //Text ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==18){ //kW ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==19){ //kWh ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==20){ //kl ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==21){ //Sq.m ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==22){ //Ratio ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==23){ //Persons Per Sq KM ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==24){ //Public Transport Unit (PTU) per 1000 people ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control textBoxInput" placeholder="<?php echo $allQuestiondetails["question_placeholder"]; ?>">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==25){ //Select Multiple ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $audiofile=base_url('assets/uploads/').$ans; ?><a href="<?php echo $audiofile; ?>" download><i title="Download File" class="fa fa-download mt-2"></i></a><?php } ?></div>
<span class="audio_note question_note" style=""><b>Note :</b> Allowded extensions : <?php echo $audio_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==29){ //Video
$video_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $videofile=base_url('assets/uploads/').$ans; ?><a href="<?php echo $videofile; ?>" download><i title="Download File" class="fa fa-download mt-2"></i></a><?php } ?></div>
<span class="video_note question_note" style=""><b>Note :</b> Allowded extensions : : <?php echo $video_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==30){ //File
$file_ext=getQuestionAllOptions($allQuestiondetails["QB_ID"]);

?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="file" class="form-control fileInput"><?php if($ans!=""){ $fileInput=base_url('assets/uploads/').$ans; ?><a href="<?php echo $fileInput; ?>" download><i title="Download File" class="fa fa-download mt-2"></i></a><?php } ?></div>
<span class="file_note question_note" style=""><b>Note :</b> Allowded extensions : <?php echo $file_ext[0]["file_extension"]; ?></span>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==31){ //Date With Range
$dt_range=$ans;
if($ans!=""){
 $dt_range=explode("-",$ans);
 //print_r($dt_range); 
 $start_dt=$dt_range[0];
 $end_dt=$dt_range[1];
 //echo "Start :: ".$start_dt." End Date :: ".$end_dt;
}else{
  $start_dt="";
  $end_dt="";
}
?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" type="text" class="form-control dateRange" placeholder="Select date range"></div>
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
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value"><input value="<?php echo $ans; ?>" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" oncopy="return false" onpaste="return false" readonly type="text" class="form-control dateinput" placeholder="Select date"></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==34){ //E-mail ?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1"><input value="<?php echo $ans; ?>" oncopy="return false" onpaste="return false" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" type="Email" class="form-control textBoxInput" placeholder="Enter e-mail">&nbsp;&nbsp;<?php echo ucfirst($uomDetail["UOM"]); ?></div>
<span class="error_msg err" style="color: red;"></span> 
</div>
<?php } else if(trim($allQuestiondetails['UOM_ID'])==35){ //Range
$range_options=getQuestionAllOptions($allQuestiondetails["QB_ID"]);
?>
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
<div class="total-nu1 ps-3 col-lg-9">
<span><?php echo $i; ?>. <?php echo $allQuestiondetails["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($allQuestiondetails["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
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
if(!empty($options)){
foreach($options as $option_detail){
?>
<div class="form-check-inline col-12 multiSelectPrioritySection">
<input <?php if(str_contains($ans, trim($option_detail["options"]))){ echo "checked"; } ?> value="<?php echo trim($option_detail["options"]); ?>" data-arr='<?php echo implode(",",$ex_priority_quest); ?>'  qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="form-check-input multiSelectPriority" type="checkbox" name="checkbox_options_<?php echo $allQuestiondetails["QB_ID"] ?>">&nbsp;&nbsp;<?php echo ucfirst($option_detail["options"]); ?>
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
<div class="show_childQuestion">
<span class="questiontitle"><?php echo $i.".".$child_i." : ".$childDetail["Description"]; ?><button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" style="pointer-events: all;" onclick="questionDetail('<?php echo trim($childDetail["QB_ID"]); ?>')"><i class="bi bi-info-circle-fill"></i></button></span>
<div class="value1">
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
<div class="show_childQuestion">
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
<span class="questiontitle">Result:&nbsp;&nbsp;</span><input value="<?php echo $ans; ?>" class="form-control calculatedQuestionAnswer" style="pointer-events: none;" type="text" readonly oncopy="return false" onpaste="return false">
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
<div class="remove">
<div class="rem" style="pointer-events:all;">
<button data-action="<?php echo $openRemark; ?>" type="button" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="btn btn-primary new-but1 addQuestionRemark"><i class="bi bi-chat-right-text-fill"></i>&nbsp;Remark</button>
<button data-action="<?php echo $openUploadDocumentPopup; ?>" type="button" qb-id="<?php echo $allQuestiondetails["QB_ID"] ?>" class="btn btn-primary new-but1 uploadQuestionDocument"><i class="bi bi-cloud-arrow-up"></i>&nbsp;Upload</button>
</div>
</div>
</div>
</div>
<?php $i++;}}else{ ?>
<p class="text-center mt-6" style="color:red;">No question found!</p>
<?php } ?>
