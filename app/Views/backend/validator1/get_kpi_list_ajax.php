<div class="col-lg-12 col-md-12 col-12 pagetitle"><h1><?php echo $Survey_Name; ?></h1></div>
<div class="row">
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong><?php echo isset($total_city_assigned)?$total_city_assigned:0; ?></strong> 
<span class="abd-co2">Total Jobs Assigned</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong><?php echo isset($recent_added_city)?$recent_added_city:0; ?></strong> 
<span class="abd-co2">Recently Added Jobs</span> 
<label>Within 1 week</label>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong><?php echo isset($city_validated)?$city_validated:0; ?></strong> 
<span class="abd-co2">Jobs Validated</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong><?php echo isset($sendtov2)?$sendtov2:0; ?></strong> 
<span class="abd-co2">Jobs Send to V2</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong><?php echo isset($pending_city_for_validate)?$pending_city_for_validate:0; ?></strong> 
<span class="abd-co2">Pending Jobs</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong class="totalPriorityCity"><?php echo isset($priority_city)?$priority_city:0; ?></strong> 
<span class="abd-co2">Priority Jobs</span>
<div class="errow-right-1">
<img src="<?php echo base_url('assets/niua/img/icon-1.svg'); ?>">
</div>
</div>              
</div>            
</div>
</div>
</div>


<div class="row justify-content-end">
<div class="col-lg-3 selet1"> 
<select class="form-select allCityList" aria-label="Default select example">
<option value="">Select City</option>
<?php
$AllDownloadCityList=[];
$i=1;
if(isset($showTableCities) && !empty($showTableCities)){
//print_data($showTableCities);
foreach ($showTableCities as $showTableCities_details){
$cityName=getCityNameByUserId($showTableCities_details["city_user_id"]);
if(!in_array(trim($showTableCities_details["city_id"]),$AllDownloadCityList)){
array_push($AllDownloadCityList, trim($showTableCities_details["city_id"]));
?>
<option value="<?php echo $showTableCities_details["city_id"]; ?>"><?php echo $cityName; ?></option>
<?php 
}
}
}
//print_data($AllDownloadCityList);
?>
</select>
</div>
<div class="col-lg-1 crt-2">
<label for="" class=""><button type="button" class="btn btn-primary btn-sm downloadCityData">Download</button></label>         
</div>        
<div class="col-lg-8 sec1"></div>   
</div>





<div class="row">        
<div class="col-lg-12 ad-table1">
<table class="table table-striped assignedCityListTbl datatable-v1" style="width:100%">
<thead>
<tr>
<th>S No.</th>
<th> &nbsp; </th>
<th class="text-center"> Job Id  </th>
<th> City Name </th>
<th> Response Submitted on  </th>
<th> Approved </th>
<th> Rejected </th>
<th> Reverted with comment </th>
<th> Validation Status </th>
<th> Action </th>
</tr>
</thead>
<tbody>
<?php
$i=1;
if(isset($showTableCities) && !empty($showTableCities)){
//print_data($showTableCities);
foreach ($showTableCities as $showTableCities_details){
$cityName=getCityNameByUserId($showTableCities_details["city_user_id"]);
$sectorName=getSectorName($showTableCities_details["sector_id"]);
$cityUserId=$showTableCities_details["city_user_id"];
$citySectorId=$showTableCities_details["sector_id"];
$survey=$Survey_ID;
$redirect=base_url()."admin/city-questions/".$cityUserId."/".$citySectorId."/".$survey;
$job=$showTableCities_details['job_id'];
$city=$showTableCities_details["city_id"];
$chkPriority=checkValidatorPriorityCity($job,$survey,$loginUserId,$city);
?>	
<tr>
<td class="tb-wid01"><?php echo $i; ?></td>
<!-- <td class="tb-wid01">&nbsp;</td> -->
<td><i city-id="<?php echo $showTableCities_details['id']; ?>" style="cursor: pointer;" title="Add to priority city" class="bi <?php if($chkPriority==0){ echo "bi-star"; }else{ echo "bi-star-fill clr2";} ?> addToPriority"></i></td>
<!-- <td><input class="form-check-input" type="checkbox" value=""></td> -->
<td class=""><?php echo isset($showTableCities_details['job_id'])?$showTableCities_details['job_id']:""; ?></td>
<td style="cursor: pointer;" onclick="parent.location='<?php echo $redirect; ?>'">
<span><?php echo $cityName; ?></span> 
<p class="clr4"><?php echo $sectorName; ?></p> 
</td>
<td><?php echo isset($showTableCities_details['survey_submission_date'])?date('d-m-Y h:i',strtotime($showTableCities_details['survey_submission_date'])):""; ?></td>
<td>
<progress style="" value="<?php echo isset($showTableCities_details['total_approved'])?$showTableCities_details['total_approved']:0;?>" max="<?php echo isset($showTableCities_details['city_total_questions'])?$showTableCities_details['city_total_questions']:0;?>"></progress>
<div><?php echo isset($showTableCities_details['total_approved'])?$showTableCities_details['total_approved']:0;?>/<?php echo $showTableCities_details['city_total_questions'];?></div>  
</td>
<td>
<progress style="" value="<?php echo isset($showTableCities_details['total_rejected'])?$showTableCities_details['total_rejected']:0;?>" max="<?php echo isset($showTableCities_details['city_total_questions'])?$showTableCities_details['city_total_questions']:0;?>"></progress>
<div><?php echo isset($showTableCities_details['total_rejected'])?$showTableCities_details['total_rejected']:0;?>/<?php echo isset($showTableCities_details['city_total_questions'])?$showTableCities_details['city_total_questions']:0;?></div>  
</td>
<td>
<progress style="" value="<?php echo isset($showTableCities_details['total_reverted'])?$showTableCities_details['total_reverted']:0;?>" max="<?php echo isset($showTableCities_details['city_total_questions'])?$showTableCities_details['city_total_questions']:0;?>"></progress> 
<div><?php echo isset($showTableCities_details['total_reverted'])?$showTableCities_details['total_reverted']:0;?>/<?php echo isset($showTableCities_details['city_total_questions'])?$showTableCities_details['city_total_questions']:0;?></div>  
</td>

<td class="text-center">
	<?php 
	$totalAttandedQuestion = ($showTableCities_details['total_approved'] + $showTableCities_details['total_rejected'] + $showTableCities_details['total_reverted'])?$showTableCities_details['total_approved'] + $showTableCities_details['total_rejected'] + $showTableCities_details['total_reverted']:0; ?>

	<?php if($totalAttandedQuestion == $showTableCities_details['city_total_questions']){ ?>

    <span style="background-color: #d9fae9; color: #5aba87; border: 1px solid #5aba87;" class="dem-but2a" href="javascript:void(0);">Completed</span>

    <?php }elseif($totalAttandedQuestion < $showTableCities_details['city_total_questions'] && $totalAttandedQuestion!=0){ ?>

    <span class="dem-but2a" href="javascript:void(0);" style="border: 1px solid #f2a563;color: #ff7b06fa;background-color: #ebda61cf;">Inprogress</span> 

    <?php }else{ ?>

    	<span class="dem-but2a checkdata-<?=$totalAttandedQuestion?>" href="javascript:void(0);">Not started</span> 
    	
    <?php } ?> 
	
</td>

<td>
<?php if($showTableCities_details["sand_to_v2"]==1 && $totalAttandedQuestion == $showTableCities_details['city_total_questions']){ ?>

<span style="background-color: #d9fae9; color: #5aba87; border: 1px solid #5aba87;" class="dem-but4" href="javascript:void(0);"><i class="bi bi-check"></i>Sent</span>

<?php }else if(($totalAttandedQuestion == $showTableCities_details['city_total_questions'])){ ?>

<a style="cursor: pointer;" class="dem-but4 sentToV2" onclick="sendToV2('<?php echo $showTableCities_details["survey_id"] ?>','<?php echo $showTableCities_details["sector_id"] ?>','<?php echo $showTableCities_details["city_id"] ?>','<?php echo $showTableCities_details["job_id"] ?>');"><i class="bi bi-text-indent-left"></i>Send to V2</a>

<?php }else if($totalAttandedQuestion < $showTableCities_details['city_total_questions']){ ?>

	<span style="background-color: #d9fae9; color: #5aba87; border: 1px solid #5aba87;" class="dem-but4" href="javascript:void(0);"><a href="<?=$redirect?>">Validate</a></span>

<?php } ?>
</td>

</tr>
<?php $i++; }}else{ ?>
<tr class="odd">
<td valign="top" colspan="0" class="dataTables_empty">No data available in table</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
