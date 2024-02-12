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
<link href="<?php echo base_url('assets/niua/css/custom.css'); ?>" rel="stylesheet">
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
</style>
</head>
<body class="toggle-sidebar">
<?php echo view('backend/partials/top_header.php'); ?>
<!-- End Header -->

<main id="main" class="main">
<div class="pagetitle surveySelectionSection">
<div class="save-part">
<p class="citySubmissionNote"></p>
<div class="save-part d-flex">
  <div class="SurveyDropDownSelection d-flex justify-content-center">    
    <select class="form-select" id="Survey_ID" name="Survey_ID" aria-label="Default select example" style="width: 100%;height: 100%;">
        <?php
         //print_r($allSurveyList);
         if(!empty($allSurveyList) && count($allSurveyList)){ ?>
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
      <?php if((count($surveyAllAssignQuestions)==count($surveyAllAnsweredQuestions)) && empty($chkSubmitStatus)){ ?>
      <button type="button" class="btn btn-primary sub-p" id="cityOfficialSubmit">Submit</button>
      <?php }else{ ?>
        <button type="button" class="btn btn-secoundry sub-p" disabled>Submit</button>
      <?php } ?>
  </div>
  </div>
  <div class="notes">
    <p class="surveyDateSection"><b>Note : </b>Start Date : <?php echo isset($survey_start_date)?$survey_start_date:""; ?> & End Date : <?php echo isset($survey_end_date)?$survey_end_date:""; ?></p>

  </div>
</div>
</div>



<div class="se-pre-con" style="display: none;"></div>
<section id="surveyWiseSectorListData">
</section>
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>


<script>
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
</script>

<script>
  $(document).ready(function(){
    var survey_id=$.trim($('#Survey_ID').val());
    updateSurveyData(survey_id);
  })

  $(document).on('change','.Survey_ID_selection',function(){
    var survey_id=$.trim($(this).val());
    updateSurveyData(survey_id);
  })


  function updateSurveyData(survey_id){
    //console.log(survey_id,' survey_id')
    if(survey_id!=''){
        $.ajax({
              type:'POST',
              url: '<?php echo base_url(); ?>admin/cityOfficialSurveyAjaxData',
              data: {'survey_id':survey_id},
              dataType: "json",
              beforeSend: function(){
                $('.se-pre-con').show();
              },
              complete: function(){
                $('.se-pre-con').hide();
              },
              success: function(response){
                if(response.status==2){
                  Swal.fire({icon: 'info',text: response.msg}).then((result) => {
                  window.location.reload();                        
                  });
                  //window.location.reload(); 
                  return false;
                }
                $(".surveySelectionSection").hide();
                if(response.status==1){
                  $('#surveyWiseSectorListData').html(response.citySectorAjax_html);
                }else{
                  showToast('error',response.msg);
                }
              }
          });
    }
  }
</script>



<script>
  $(document).on('click','.cityOfficialSubmit', function(){
    var Survey_ID=$.trim($('#Survey_ID').val());
    Swal.fire({
        icon: "question",     
        type: 'question',
        title: 'Are you sure, you want to submit?',
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
            url: '<?php echo base_url(); ?>admin/city-submission',
            data: {'Survey_ID':Survey_ID},
            dataType: "json",
            beforeSend: function(){
            $('.loadingSectionMainForm').show();
            },
            complete: function(){
            $('.loadingSectionMainForm').hide();
            },
            success: function(response){
              if(response.status==1){
                Swal.fire({icon: 'success',text: response.msg}).then((result) => {
                window.location.reload();                        
                });
              }else{
                Swal.fire({icon: "error",text: response.msg});
              }
            }
        });
      }else{
        Swal.fire({icon: "warning",text: "Please fill out the check box for data submission."});
        return false;
      }
      }else{
        //Swal.fire({icon: "warning",text: "Please acknowledge!"});
        return false;
      } 
    });
});
</script>

<script>  
  $(document).on('click','.question_not_exist', function(){
     Swal.fire({icon: "info",text: "No question added in this sector!"});
  });
</script>
</body>
</html>