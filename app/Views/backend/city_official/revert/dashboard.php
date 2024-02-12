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
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<style>
  #toolbarContainer{
    display: none !important;
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
  .overAllProgress{
    height: 15px;
}
.progressRow{margin-top: -70px;}
.save-part {z-index: 9;}

/* New  Dashboard Design */
/**grid sec breack**/
  @media (min-width: 768px){
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1  {
    width: 100%;
    *width: 100%;
  }
}

@media (min-width: 992px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
  }
}
   
@media (min-width: 1200px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
  }
}
.seven-cols .navbar-brand{line-height:75px;margin-top:30px;}
.revertCnt{
    float: right;
    border-radius: 50%;
    background: #ffa729;
    padding: 5px;
    font-size: 10px;
    height: 22px;
    text-align: center;
    width: 22px;
    color: #fff;
  } 
.swal-wide{width:650px !important;}
</style>
</head>
<body class="toggle-sidebar">
<?php echo view('backend/partials/top_header.php'); ?>
<main id="main" class="main">
<div class="pagetitle">
<h1 id="ChangeSurveyName"></h1>
</div>
<div class="se-pre-con" style="display: none;"></div>
<section id="surveyWiseSectorListData">
<?php if(count($getReverted)>0){ ?>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8"></div>
<div class="col-md-2"><button class="btn btn-primary" type="button" id="reSubmit">Submit for Re-validation</button></div>
</div>
<?php } ?>


<?php
$uri=service('uri');
$geturi=$uri->getSegments();
$surveyId=$geturi[2];
//die("Survey Id :: ".$surveyId);
$logedInUserDetail=session('admin_detail');
$loginUserCityName=$logedInUserDetail['City'];
$backUrl=base_url('admin/dashboard/');
if(count($getReverted)>0){
?>
<div class="row revertedv2">
  <div class="col-md-2"><p><a href="<?=$backUrl?>"><i class="bi bi-chevron-left"></i> Back </a></p></div>
  <div class="col-md-8">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong><?php echo ucwords($loginUserCityName); ?>!</strong> You have received <b>comments on your response</b> in <?php echo count($getRevertedSector); ?> sector.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  </div>
  <div class="col-md-2"></div>
</div>
<?php } ?>

<div class="mt-n10">
<div class="row seven-cols">
<?php
//print_r($all_revertedSector);
$revSec=$all_revertedSector;
$i=1;
$k=1;
//print_data($logedInUserDetail);
$loginUserCity=$logedInUserDetail['City_ID'];
if(isset($allsector) && !empty($allsector)){
foreach ($allsector as $allsectorDetails){
  $sid=trim($allsectorDetails['Sector_ID']);
  if($allsectorDetails['QuestionsInSurvey']!=0){
    $exist="question_exist";
    $url=base_url('admin/sector-revert-question/'.$survey_id.'/'.$sid);
  }else{
    $exist="question_not_exist";
    $url="javascript:void(0)";
  }
  $totalAnswered=getSectorTotalAnswered($survey_id,$sid,$loginUserCity);
  if($allsectorDetails['QuestionsInSurvey']!=0){
  if(in_array($sid,$revSec)){
?> 
<div class="col-md-1">
<a style="background-image: url('<?=base_url('assets/niua/img/'.$allsectorDetails['sectorBackground']) ?>'); background-position: right center; background-repeat: no-repeat;  background-size: cover !important; width: 100%;" class="navbar-brand" href="<?php echo $url; ?>">           
  <div class="box-content">
  <span><img src="<?=base_url('assets/niua/img/'.$allsectorDetails['sectorIcon'])?>"></span>
  <h5><?php echo word_limiter($allsectorDetails['Sector'],4); ?></h5>
  <progress style="" id="file" value="<?php echo $totalAnswered; ?>" max="<?=($allsectorDetails['QuestionsInSurvey'])?$allsectorDetails['QuestionsInSurvey']:0; ?>"></progress>
  <h6>
    <?php echo $totalAnswered; ?>/<?=($allsectorDetails['QuestionsInSurvey'])?$allsectorDetails['QuestionsInSurvey']:0; ?>     
       <span class="revertCnt"><?php echo $allsectorDetails["QuestionsRevertedCount"]; ?></span>
   </h6>   
  </div>        
</a>
</div>
<?php }}}} ?>
</div>
</div>
</section>
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
</body>

<script>  
  $(document).on("click","#reSubmit", function(){
      var survey='<?php echo trim($surveyId) ?>';
      //alert(`Survey :: ${survey}`);
      if(survey!=""){

        Swal.fire({
        icon: "question",     
        type: 'question',
        title: 'Are you sure, you want to re-submit?',
        text: 'You will not be able to change any content post submission',
        input: 'checkbox',
        inputPlaceholder: 'I hereby declare that the information given and in the enclosed documents is true to the best of my knowledge.',
        customClass: 'swal-wide',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
        }).then((result)=>{
        if(result.isConfirmed){
        if(result.value){

        $.ajax({
        type:'POST',
        url: '<?php echo base_url(); ?>admin/re-submit',
        data: {'survey_id':survey},
        dataType: "json",
        beforeSend: function(){
            $('#reSubmit').html('Processing ...');
            $('#reSubmit').prop('Disabled');
            $('#reSubmit').attr('disabled', 'disabled');
        },
        complete: function(){
            $('#reSubmit').html('Submit for Re-validation');
            $('#reSubmit').prop('Enabled');
            $('#reSubmit').attr('disabled', '');
        },
        success: function(response){
            //console.log(response);
            if(response.status==1){
                Swal.fire({icon: 'success',text: response.msg}).then((result) => {
                    window.location.reload();                        
                });
            }else{
                Swal.fire({icon: 'error', text: response.msg});
            }
                    
        }
        });

        }else{
        Swal.fire({icon: "warning",text: "Please fill out the check box for data submission."});
        return false;
      }
      }else{
        Swal.fire({icon: "warning",text: "Please fill out the check box for data submission."});
        return false;
      }
       });
      }
  });
</script>
</html>