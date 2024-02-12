<h3> All Question (<span class="countQuestion"><?php echo $totalQuestion; ?></span>)</h3>

<?php if(isset($Sector_ID) && $Sector_ID > 0){
  ?>
<div class="SelectAllQuestionList">
  <div class="form-check check-1" style="font-size: small;">
  <input class="form-check-input" type="checkbox" value="" id="allsectorQuestions">
    <label class="form-check-label" for="allsectorQuestions"> Select All</label>
  </div>
  <div class="check-2" id="addMultipleQuestion" style="font-size: small;"> <a title="add All" href="javascript:void(0);"> <i class="bi bi-plus" title="Add aa questions" aria-hidden="true"></i> Add All</a> </div>
</div>
<?php } ?>


<?php
if(isset($allquestion) && !empty($allquestion)){
foreach($allquestion as $questionDetails){
$qid=$questionDetails['QB_ID'];
$sid=$questionDetails['Sector_ID'];
$sectorName=getSectorName($sid);
$uomDetail=getQuestionUnitOfMeasurement(trim($questionDetails['UOM_ID']));
$QStatus = checkQuestionStatus($Survey_ID,$qid);
?>
<div class="card-body3" id="questionID<?=$qid?>">
<div class="total-nu2">
<div class="d-flex">
  <?php if(isset($Sector_ID) && $Sector_ID != 0){  ?>
    <div class="SelectQuestionFromQlist" style="margin-right: 5px;">
      <input class="form-check-input selectQuestion" type="checkbox" id="selectQuestion" value="<?=trim($qid)?>" <?=($QStatus==1)?'disabled':'';?>>
    </div>
  <?php }?>
  <span><?php echo $questionDetails['Description']; ?></span>  
</div>   

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