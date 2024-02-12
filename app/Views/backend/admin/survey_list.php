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
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/datatable/jquery.dataTables.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/niua/css/jquery-ui.css'); ?>">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<style>
  #toolbarContainer{
    display: none !important;
  }
  div.container {
  width: 80%;
  }
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current{
  color: white !important;
}
a.paginate_button.current {
  color: white !important;
}
.save-part{
  padding: 1px 20px 2px 20px;
  margin: 0px 0px 0px 5px;
  text-align: center;
  background-color: #0081c4;
  border-radius: 3px;
}
</style>
</head>
<body>
<!-- ======= Header ======= -->
<?php echo view('backend/partials/top_header.php'); ?>
<!-- ======= End Header ======= -->
<!-- ======= Sidebar ======= -->
<aside style="display: none;" id="sidebar" class="sidebar">
<ul class="sidebar-nav" id="sidebar-nav">
<li class="nav-item">
<a class="nav-link " href="index.html">
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
<div class="pagetitle">

<p>
<a href="<?=base_url('/admin/dashboard')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>


<h1>All Survey</h1>
<a style="margin-left:5px;" href="#" class="btn btn-primary save-part" data-bs-toggle="modal" data-bs-target="#exampleModal" >Add New</a>
</div>
<section class="section dashboard">
<form>
<div class="row">
<div class="col-lg-12">
<div class="data-tabl2">
<table class="table table-striped" id="question_list">
<thead>
<tr>
<th scope="col">S.No</th>
<th scope="col">Survey Title/Name</th>
<th scope="col" class="text-center">Is UOF</th>
<th scope="col" class="text-center">Survey Year</th>
<th scope="col" class="text-center">Survey Description</th>
<th scope="col" class="text-center">Survey Start Date</th>
<th scope="col" class="text-center">Survey End Date</th>
<th scope="col" class="text-center">Publish Status</th>
<th scope="col" class="text-center">Active/Inactive Status</th>
<th scope="col" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$today=date("Y-m-d");
$i=1;
$k=1;
if(isset($allsurvey) && !empty($allsurvey)){
foreach ($allsurvey as $allsurvey_details){
  $surveyId=trim($allsurvey_details["Survey_ID"]);
  $surveyEndDate=$allsurvey_details["To_Date"];
  if(strtotime($today)>strtotime($surveyEndDate)){
    $showBtn="yes";
  }else{
    $showBtn="no";
  }


  if($allsurvey_details["is_uof"]==1){
    $showUof="Yes";
  }else{
    $showUof="No";
  }

  if($allsurvey_details["active_inactive_status"]==1){
    $showActive_inactive_status='<span style="color: green; font-weight: bold;">Active</span>';
  }else{
    $showActive_inactive_status='<span style="color: gray; font-weight: bold;">InActive</span>';
  }
  
?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo isset($allsurvey_details["Survey_Name"])?ucfirst($allsurvey_details["Survey_Name"]):""; ?></td>
    <td class="text-center"><b><?php echo $showUof; ?></b></td>
    <td><?php echo isset($allsurvey_details["survey_year"])?$allsurvey_details["survey_year"]:""; ?></td>
    <td class="text-center"><textarea rows="3" cols="40"><?php echo isset($allsurvey_details["Description"])?$allsurvey_details["Description"]:""; ?></textarea></td>
    <td class="text-center"><?php echo isset($allsurvey_details["From_Date"])?date('d-m-Y',strtotime($allsurvey_details["From_Date"])):""; ?></td>
    <td class="text-center"><?php echo isset($allsurvey_details["To_Date"])?date('d-m-Y',strtotime($allsurvey_details["To_Date"])):""; ?></td>
    <td class="text-center"><?php if($allsurvey_details["admin_status"]==0 && $allsurvey_details["publish_status"]==0){ echo "Draft";}elseif($allsurvey_details["admin_status"]==1 && $allsurvey_details["publish_status"]==0){echo "Saved by admin";}elseif($allsurvey_details["admin_status"]==1 && $allsurvey_details["publish_status"]==1){ echo "Saved by super admin";}elseif($allsurvey_details["admin_status"]==2 && $allsurvey_details["publish_status"]==2){echo "Published";}else{echo "--";}?></td>
    <td class="text-center"><?php echo $showActive_inactive_status; ?></td>
    <td class="text-center">
      <a href="<?php echo base_url()."admin/edit-survey/".$allsurvey_details["Survey_ID"]; ?>"><span style="cursor: pointer;" title="Edit Survey" class="colr2"><i class="bi bi-pencil-square"></i></span></a>
      


      <?php if($allsurvey_details["showPublishBtn"]==1){ ?>
      <i style="cursor:pointer;" title="Download survey data" class="bi bi-box-arrow-down downloadSurveyData dwnBtn" data-surveyId="<?php echo $surveyId; ?>"></i>
      <?php if($allsurvey_details["is_uof"]==1){ ?>      
      <i style="cursor:pointer;" data-surveyId="<?php echo $surveyId; ?>" title="Publish to dashboard" class="bi bi-arrow-up-right-circle-fill PublishToDashboard dwnBtn"></i>
      <?php }} ?>



    </td>
  </tr>
<?php $i++;}} ?>  
</tbody>
</table>

</div>
</div>
</div>
</form>
</section>


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
                <?php if(!empty($allsurvey) && count($allsurvey)){?>
                    <select class="form-control" id="Import_From_Survey_ID" name="Import_From_Survey_ID" aria-label="Default select example" style="width: 100%;">
                      <option value="0">Select survey</option>
                      <?php foreach($allsurvey as $key=>$Survey){?>
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
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/datatable/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/jquery-ui.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script>  

  $(function(){
    $("#To_Date").datepicker({
      dateFormat:'dd-mm-yy'
    });

    $('#From_Date').datepicker({
      dateFormat:'dd-mm-yy',
      minDate:new Date()
    })
  });
  new DataTable('#question_list');

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
            setTimeout(function() {
                        location.reload();
            }, 1000);
          }else{
            updatetoast('error', response.msg);
          }             
        }
    });
  })
</script>


<script>  
  $(document).on('click','.PublishToDashboard',function(){
    var surveyId=$(this).attr('data-surveyId');
    //alert(surveyId);
    if(surveyId!=""){

        Swal.fire({
        icon: "question",     
        type: 'question',
        text: 'Are you sure, you want to publish this survey data to dashboard?',
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
            url: '<?php echo base_url(); ?>admin/publishToDashboard',
            data: {'survey':surveyId},
            dataType: "json",
            beforeSend: function(){
            $('.PublishToDashboard').prop('disabled',true);
            $('.PublishToDashboard').css('cursor', 'wait');
            },
            complete: function(){
            $('.PublishToDashboard').prop('disabled',false);
            $('.PublishToDashboard').css('cursor', '');
            },
            success: function(response){
               if(response.status==1){
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
  $(document).on('click','.downloadSurveyData',function(){
    var surveyId=$(this).attr('data-surveyId');
    if(surveyId!=""){
       var url=`<?php echo base_url('admin/downLoadSurveyResultDataExcel/'); ?>${surveyId}`;
       window.location.href=url;
    }
  });
</script>
</body>
</html>