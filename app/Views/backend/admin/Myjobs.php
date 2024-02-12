<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> NIUA | My Jobs </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="icon">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/vanilla_selectbox/css/vanillaSelectBox.css'); ?>">
<!-- <link href=" https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
<style >
  #toolbarContainer{
    display: none!important;
  }
  .back-to-top{
    display: none;
  }
  .sec1 select {
    font-size: 11px;
    width: 100%;
    color: #000;
}
#myJobsDataTable_wrapper{position:relative;}
#myJobsDataTable_filter{
  float: right;
}
.dataTables_wrapper .dataTables_length {
    margin: 10px 0px;
    width: 30%;
    height:30px;
}
.dataTables_info{width: 50%;}
.dataTables_paginate.paging_simple_numbers{
      position: relative;
    float: right;
    top: -26px;
}
.dataTables_paginate a {
    padding: 3px 14px !important;
    background: #0081c4 !important;
    color: #120e0e !important;
    border: none !important;
    cursor: pointer;
}
.dataTables_paginate .paginate_button {
    padding: 3px 14px !important;
    background: #0081c4 !important;
    color: #000 !important;
    border: none !important;
}

#myJobsDataTable_wrapper .paginate_button.current{color:#fff !important;}
.ad-table1 .table-db1 tr {
    box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
    border: 1px solid #c7c8cd;
    text-align: justify;
    margin: 10px 0px 0px 0px;
    padding: 10px 0px 10px 0px!important;
     display:table-row; 
    width: 100%;
}
.data-subm1 {
    width: 100%;
    float: left;
    border-bottom: 1px solid #8a8b8e;
    margin: 10px 0px 10px 0px;
    z-index: 1;
    position: relative;
}
</style>
</head>
<body>
  <?php echo view('backend/partials/top_header.php'); ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1> All Jobs </h1>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-1 crt-1">         
         <span> My Jobs </span>
        </div>
        <div class="col-lg-3 sec1">
          <label for="" class="">Survey</label>         
          <select class="form-select" aria-label="Default select example" name="survey_id" id="survey_id">
            <option value="0">Please select</option>
            <?php if(!empty($surveyList)){
              foreach($surveyList as $keyopt => $survey){ ?>
                  <option value="<?=$survey['survey_id']?>"><?=$survey['survey_Name']?></option>
            <?php  }
            } ?>
          </select>
        </div>
        <div class="col-lg-3 sec1">
          <label for="" class="">Sector</label>         
          <select class="form-select" aria-label="Default select example" name="sector_id" id="sector_id">
            <option value="0">Please select</option>
          </select>
        </div>
        <div class="col-lg-3 sec1">
          <label for="" class="">Cities</label>         
          <select class="form-select" aria-label="Default select example" name="city_id" id="city_id">
            <option value="0">Please select</option>
          </select>
        </div>
        <div class="col-lg-1 sec1 align-self-end">
            <label for="" class=""><button type="button" class="btn btn-primary btn-sm downloadSurveyExcelFileIconShowHide" id="downloadMyJobsData">Download</button></label>         
        </div>
        <div class="col-lg-1 sec1 align-self-end">
            <label for="" class=""><button type="button" class="btn btn-primary btn-sm downloadSurveyExcelFileIconShowHide" id="downloadConsolodatedData">Consolidated</button></label>         
        </div>
      </div>
      <div class="row justify-content-end">
      <div class="col-lg-5"> </div>
        <div class="col-lg-1 crt-1">
          <!-- <label for="" class="">Date Range</label>-->
        </div>        
        <div class="col-lg-3 sec1">
          <!-- <input type="input" class="form-control" id="exampleFormControlInput1" placeholder="DD/MM/YY - DD/MM/YY ">          -->
        </div>
      </div>
      <div class="row">        
        <div class="col-lg-12 ad-table1">
          <div class="data-subm1"> 
            <a  href="<?=base_url('admin/job')?>"> Data Submission Details by Cities </a>
            <a class="actv-1" href="<?=base_url('admin/myjobs')?>"> My Jobs </a>
            <a  href="<?=base_url('admin/city-status')?>">City Status </a>
          </div>
          <table class="table table-db1" id="myJobsDataTable">
            <thead>
              <tr class="tbl-bg1">
                <th class="tb-wid2">Job Id </th>
                <th class="tb-wid2"> Creation Date</th>            
                <th class="tb-wid2"> Sector</th>
                <th class="tb-wid4"> City </th>
                <th class="tb-wid8"> Validator 1 Status </th>
                <th class="tb-wid8"> Validator 2 Status </th>
                <th class="tb-wid3"> View Status</th>
              </tr>
            </thead>
            <tbody class="table-group-divider" id="MyJobsAjaxListData">
              <?php if(!empty($jobDetails)){
                foreach($jobDetails as $jkey=>$job){ ?>
              <tr>
                <td class="tb-wid2" ><?=$job['job_id']?> </td>
                <td class="tb-wid2"><?=$job['created_on']?> </td>
                <td class="tb-wid2"><?=$job['sector_Name']?></td>
                <td class="tb-wid4"><?=implode(", ",$job['cityNameArray'])?></td>
                <td class="tb-wid8">
                  <progress style="" value="<?=$job['total_v1_attempt']?>" max="<?=$job['total_QuestionCount']?>"></progress><?=round(($job['total_v1_attempt']/$job['total_QuestionCount'])*100)?>%
                </td>
                <td class="tb-wid8">
                  <progress style=""  value="<?=$job['total_v2_attempt']?>" max="<?=$job['total_QuestionCount']?>"></progress><?=round(($job['total_v2_attempt']/$job['total_QuestionCount'])*100)?>%
                </td>
                <td class="tb-wid3"> <a href="<?=base_url('admin/validators-status/'.$job['job_id'])?>"> View Status </a>  </td>
              </tr>
            <?php } }else{ ?>
              <tr>
                  <td class="tb-wid2" ></td>
                  <td class="tb-wid2" ></td>
                  <td class="tb-wid2" ></td>
                  <td class="tb-wid2" >No job found</td>
                  <td class="tb-wid2" ></td>
                  <td class="tb-wid2" ></td>
                  <td class="tb-wid2" ></td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
 <?php echo view('backend/partials/footer.php'); ?>
  <a href="#" class="back-to-top align-items-center justify-content-center d-none"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
  <script src=" https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <!-- <script src=" https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script> -->
   <script>
    // new DataTable('#myJobsDataTable');
    $('#myJobsDataTable').dataTable( {
      "bSort": false
    } );
  </script>
<script>
function updatetoast(type,text){
    const Toast=Swal.mixin({
      toast: true,
      position: 'top',
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
$(document).on('change','#survey_id,#sector_id,#city_id',function(){
  var survey_id = $.trim($('#survey_id').val());
  var sector_id = $.trim($('#sector_id').val());
  var city_id = $.trim($('#city_id').val());
  // var validator_1_id = $.trim($('#validator_1_id').val());
  // var validator_2_id = $.trim($('#validator_2_id').val());
  $.ajax({
      type:'POST',
      url: '<?=base_url("admin/job/jobDataFilterAjax")?>',
      data: {'survey_id':survey_id,'sector_id':sector_id,'city_id':city_id},
      dataType: "json",
      success: function(response){
        console.log(response);
          $('#sector_id').html(response.sectorListHtml);
          $('#city_id').html(response.cityListHtml);
          // $('#validator_1_id').html(response.validatorOneListHtml); 
          // $('#validator_2_id').html(response.validatorTwoListHtml);
          if( $.fn.DataTable.isDataTable('#myJobsDataTable') ) {
              $('#myJobsDataTable').DataTable().destroy();
          }
          $('#myJobsDataTable tbody').empty();
          $('#MyJobsAjaxListData').html(response.jobDetailsHtmlAjax);
          $('#myJobsDataTable').dataTable( {
            "bSort": false
          });
      }
    });
})

$(document).on('click','#downloadMyJobsData', function(){
   var survey=$("#survey_id").val().trim();
   var sector_id=$("#sector_id").val().trim();
   var city_id=$("#city_id").val().trim();
   if(survey!="" && survey > 0){
    var base='<?=base_url()?>';
    var redirect=`${base}admin/download_myJobsData_excel/${survey}/${sector_id}/${city_id}`;
    window.location.href=redirect;
   }else{
      updatetoast('error','Please select survey');
        return false;
   }
});

$(document).on('click','#downloadConsolodatedData', function(){
   var survey=$("#survey_id").val().trim();
   var sector_id=$("#sector_id").val().trim();
   var city_id=$("#city_id").val().trim();
   if(survey!="" && survey > 0){
    var base='<?=base_url()?>';
    var redirect=`${base}admin/download_ConsolodatedData_excel/${survey}/${sector_id}/${city_id}`;
    window.location.href=redirect;
   }else{
      updatetoast('error','Please select survey');
        return false;
   }
});
</script>
</body>
</html>