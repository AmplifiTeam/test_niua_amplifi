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
<link href="<?php echo base_url('assets/niua/css/datatable/dataTables.bootstrap5.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<style>
  #toolbarContainer{
    display: none !important;
  }  

</style>
</head>
<body>
<!-- ======= Header =========== -->
<?php echo view('backend/partials/top_header.php'); ?>
<!-- ======= End Header ======= -->
<!-- ======= Sidebar ======= -->



<main id="main" class="main">

<!-- #################### Page Title & Survey Selection ############################# -->
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 mt-2">

    <?php $selectedSurvey = (session('V1_selected_Survey') && session('V1_selected_Survey')!='')?session('V1_selected_Survey'):''; ?>
      <select class="form-select" id="Survey_ID" name="Survey_ID" aria-label="Default select example" style="width: 100%;height: 100%;">
      <option value="">Select survey</option>
      <?php
      if(isset($assigned_survey) && !empty($assigned_survey)){
      foreach ($assigned_survey as $survey_details){
      ?>
      <option value="<?php echo $survey_details["survey_id"]; ?>" <?=($selectedSurvey==$survey_details["survey_id"])?'selected':''?>><?php echo getSurveyName($survey_details["survey_id"]); ?></option>
      <?php }} ?>
      </select>
  </div>
  <div class="col-md-4"></div>
</div>
<!-- #################### End Page Title & Survey Selection ############################# -->





<section class="section dashboard allkpis">
<div class="col-lg-12 col-md-12 col-12 pagetitle"><h1>Welcome to Urban Outcomes Frameworks <?php echo date('Y'); ?></h1></div>
<div class="row">
<div class="col-lg-2 totl-numb1">
<div class="card info-card revenue-card r-bg2">
<div class="card-body4">
<div class="card-title pd1">
<strong>0</strong> 
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
<strong>0</strong> 
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
<strong>0</strong> 
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
<strong>0</strong> 
<span class="abd-co2">Send to V2</span>
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
<strong>0</strong> 
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
<strong>0</strong> 
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
<select class="form-select" aria-label="Default select example">
  <option selected>All city</option>
</select>
</div>
<div class="col-lg-1 crt-2">
<label for="" class=""><button type="button" class="btn btn-primary btn-sm">Download</button></label>         
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
<th> Job Id  </th>
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
</tbody>
</table>
</div>
</div>
</section>
</main>
<a onclick="scrollToTop()" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php echo view('backend/partials/footer.php'); ?>
<script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/datatable/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/datatable/dataTables.bootstrap5.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
</body>
<script>
  $(document).ready(function(){
    if($.trim($('#Survey_ID').val()) !=''){
      $('#Survey_ID').trigger('change');
    }
  })
    function showToast(type,text){
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

<!-- Add to Priority City -->
<script>
  $(document).on('click','.addToPriority',function(){
    var survey=$("#Survey_ID").val().trim();
    var city=$.trim($(this).attr('city-id'));    
    if($(this).hasClass('bi-star-fill clr2')){ // Checked
       $(this).removeClass('bi-star-fill clr2');
       $(this).addClass('bi-star');
       //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/add-priority-city',
          data: {'action':'remove','city':city},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            //console.log($(".totalPriorityCity").text());
            var total=$(".totalPriorityCity").text();
            $(".totalPriorityCity").text(total-1);
            if(response.status==1){
              showToast('success',response.msg);
            }else{
              showToast('error',response.msg);
            }            
          }
          })
    }else{ // Not Checked
       //alert('Add');
       $(this).removeClass('bi-star');
       $(this).addClass('bi-star-fill clr2');
       //Ajax
       $.ajax({
          type:'POST',
          url: '<?php echo base_url(); ?>admin/add-priority-city',
          data: {'action':'add','city':city},
          dataType: "json",
          beforeSend: function(){
            //$('.loadingSection').show();
          },
          complete: function(){
            //$('.loadingSection').hide();
          },
          success: function(response){
            //console.log(response);
            var total=$(".totalPriorityCity").text();
            var addon=parseInt(total)+1;
            $(".totalPriorityCity").text(addon);
            if(response.status==1){
              showToast('success',response.msg);
            }else{
              showToast('error',response.msg);
            }            
          }
          })
    }
  });
</script>

<script>
  $('#Survey_ID').change(function(){
    var survey=$(this).val().trim();
    //alert(`Survey :: ${survey}`);
    if(survey==""){
      window.location.reload();
    }
    $.ajax({
              type:'POST',
              url: '<?php echo base_url(); ?>admin/get-kpi-list',
              data: {'Survey_ID':survey},
              dataType: "json",
              beforeSend: function(){
                //$('.se-pre-con').show();
              },
              complete: function(){
                //$('.se-pre-con').hide();
              },
              success: function(response){
                console.log(response);
                $(".allkpis").html("");                
                $(".allkpis").html(response.kpi);
                $('assignedCityListTbl').dataTable().fnClearTable();
                $('assignedCityListTbl').dataTable().fnDestroy();
                new DataTable('.assignedCityListTbl');
              }
          });
  });
</script>

<script>
  $(document).ready(function () {
      new DataTable('.assignedCityListTbl');
  });
</script>


<script>
  $(document).on('click','.downloadCityData', function(){
     var survey=$("#Survey_ID").val().trim();
     var city=$(".allCityList").val().trim();
     // alert(`Survey :: ${survey} City :: ${city}`);
     if(survey!="" && city!=""){
      var base='<?php echo base_url(); ?>';
      var redirect=`${base}admin/download-excel/${survey}/${city}`;
      window.location.href=redirect;
     }
  });
</script>


<script>
  function sendToV2(survey_id,sector_id,city_id,job_id){
    // alert(`Survey=>${survey_id}, Sector=>${sector_id}, City=>${city_id}, Job =>${job_id}`);
    // return false;

    if(survey_id!="" && sector_id!="" && city_id!="" && job_id!=""){

    Swal.fire({
    icon: "question",     
    text: 'Are you sure, you want to send validator2 ?',
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
          url: '<?php echo base_url(); ?>admin/sent-v2',
          data: {'job':job_id,'survey_id':survey_id,'sector_id':sector_id,'city':city_id},
          dataType: "json",
          beforeSend: function(){
            //$('.se-pre-con').show();
          },
          complete: function(){
            //$('.se-pre-con').hide();
          },
          success: function(response){
            if(response.status==1){
                Swal.fire({icon: 'success',text: response.msg}).then((result) => {
                  window.location.reload();                        
                });
            }else{
                Swal.fire({icon: 'error',text: response.msg});
            }
          }
          });

      } 
    });

    }
  }
</script>



</html>