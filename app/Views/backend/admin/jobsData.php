<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title> NIUA | JOBS </title>
<meta content="" name="description">
<meta content="" name="keywords">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="icon">
<link href="<?php echo base_url('assets/niua/img/logo.png'); ?>" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/niua/css/style.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/vanilla_selectbox/css/vanillaSelectBox.css'); ?>">
<style>
  #toolbarContainer{
    display: none!important;
  }
  #submitted_cities_list > tbody > tr{
    max-height: 50px;
  }
  .col-lg-2 {
    flex: 0 0 auto;
    width: 15%;
}
.sec1 select {
    font-size: 11px;
    width: 100%;
    color: #000;
}
.vsb-main button {
  min-width: 170px;
    border-radius: 0;
    width: 100%;
    text-align: left;
    z-index: 1;
    color: #1e1212;
    background: #ffffff !important;
    border: 1px solid #e2e7eb !important;
    line-height: 20px;
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 6px;
}
.alreadyAssignedJob{
  background-color: #d9fae9;
  color: #5aba87;
  border: 1px solid #5aba87;
  border-radius: 20px;
  padding: 4px 10px 4px 10px;
  float: left;
  font-size: 11px;
  margin: 5px 10px 5px 0px;
  text-transform: uppercase;
}
#submitted_cities_list_wrapper{position:relative;}
#submitted_cities_list_filter{
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
#submitted_cities_list_wrapper .paginate_button.current{color:#fff !important;}
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
         <span> Create Jobs </span>
        </div>
        <div class="col-lg-2 sec1">
          <label for="" class="">Survey</label>         
          <select class="form-select" aria-label="Default select example" id="survey_id" name="survey_id">
            <option value="0">Please select</option>
            <?php if(!empty($surevyListData)){
              foreach($surevyListData as $surveykey => $surevy){ ?>
                <option value="<?=$surevy['Survey_ID']?>"> <?=$surevy['Survey_Name']?> </option>
              <?php }
            }?>
          </select>
        </div>
        <div class="col-lg-2 sec1">
          <label for="" class="">Sector</label>         
          <select class="form-select" aria-label="Default select example" id="sector_id" name="sector_id">
            <option value="0">Please select</option>
          </select>
        </div>
        <div class="col-lg-2 sec1">
          <label for="" class="">Cities</label>         
          <select class="form-select" aria-label="Default select example" id="city_id" name="city_id" multiple size="2">
          </select>
        </div>
        <div class="col-lg-2 sec1">
          <label for="" class=""> Validator 1 </label>         
          <select class="form-select" aria-label="Default select example" id="validator_1" name="validator_1">
            <option value="0"> Please select </option>
            <?php if(!empty($validaor_1_list)){
              foreach($validaor_1_list as $vkey => $validaor_1){ ?>
                <option value="<?=$validaor_1['user_id']?>"> <?=$validaor_1['City']?> </option>
              <?php }
            }?>
          </select>
        </div>
        <div class="col-lg-2 sec1">
          <label for="" class=""> Validator 2 </label>         
          <select class="form-select" aria-label="Default select example" id="validator_2" name="validator_2">
            <option value="0"> Please select </option>
            <?php if(!empty($validaor_2_list)){
              foreach($validaor_2_list as $v2key => $validaor_2){ ?>
                <option value="<?=$validaor_2['user_id']?>"> <?=$validaor_2['City']?> </option>
              <?php }
            }?>
          </select>
        </div>
        <div class="col-lg-2 crt-1">         
          <span> <button type="submit" class="btn btn-primary" id="createJobs"> Create Jobs </button> </span>
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-lg-5"> </div>
        <div class="col-lg-1 crt-1">
          <!-- <label for="" class="">Date Range</label>          -->
        </div>        
        <div class="col-lg-3 sec1">
          <!-- <input type="input" class="form-control citySubmittionListDateRange" id="citySubmittionListDateRange" name="citySubmittionListDateRange" placeholder="DD-MM-YY - DD-MM-YY "> -->
        </div>
      </div>
      <div class="row">        
        <div class="col-lg-12 ad-table1">
          <div class="data-subm1"> 
            <a class="actv-1" href="<?=base_url('admin/job')?>"> Data Submission Details by Cities </a>
            <a  href="<?=base_url('admin/myjobs')?>"> My Jobs </a>
            <a  href="<?=base_url('admin/city-status')?>">City Status </a>
          </div>
          <table class="table table-db1" id="submitted_cities_list">
            <thead>
              <tr class="tbl-bg1">
                <th class="tb-wid4"> Survey Name </th>
                <th class="tb-wid3"> City Name </th>
                <th class="tb-wid3"> Submission Date</th>
                <th class="tb-wid3"> Sectors to allocated for validation </th>
                <th class="tb-wid8"> Sectors Allocated</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <?php if(!empty($surveyDetails)){ 
                foreach($surveyDetails as $sKey=>$surevyDetails){ ?>
                  <tr>
                    <td class="tb-wid4"><?=$surevyDetails['Survey_Name']?></td>
                    <td class="tb-wid3"><?=$surevyDetails['City']?></td>
                    <td class="tb-wid3"><?=date('d-m-Y H:i',strtotime($surevyDetails['submission_date']))?></td>
                    <td class="tb-wid3"><?=count($surevyDetails['sectorList'])?></td>
                    <td class="tb-wid8"> 
                      <?php if(count($surevyDetails['sectorList']) > 0){
                        foreach($surevyDetails['sectorList'] as $sctrKey =>$sector){?>
                            <a class=" <?= (isJobsCreated($surevyDetails['Survey_ID'],$sector['Sector_ID'],$surevyDetails['City_ID']))?'alreadyAssignedJob':'dem-but1'?>" href="#" ><?=$sector['Sector']?></a>
                      <?php  }
                      } ?>
                    </td>
                  </tr>
             <?php } } else{ ?>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center">No record found</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                </tr>
             <?php  } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>
  <a href="javascript:void(0);" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php echo view('backend/partials/footer.php'); ?>  
  <script src="<?php echo base_url('assets/niua/js/jquery-3.5.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/js/main.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/js/datatable/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/niua/js/jquery-ui.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/vanilla_selectbox/js/vanillaSelectBox.js'); ?>"></script>
<script>
  // new DataTable('#submitted_cities_list');
  $('#submitted_cities_list').dataTable( {
      "bSort": false
    } );
</script>
<script>
$(document).ready(function () {
  let city=new vanillaSelectBox("#city_id",{"maxOptionWidth":100, "maxHeight": 100,"search": false,translations: { "all": "All selected", "items": "cities", "item": "City" }, "placeHolder": "Please select (Multiple)" });
});
</script>
<script>
$(document).on('change','#survey_id , #sector_id',function(){
  var survey_id = $.trim($('#survey_id').val());
  var sector_id = $.trim($('#sector_id').val());
    $.ajax({
      type:'POST',
      url: '<?php echo base_url(); ?>admin/job/getSectorListBySurveyId',
      data: {'survey_id':survey_id,'sector_id':sector_id},
      dataType: "json",
      success: function(response){
       
        $('#sector_id').html(response.sectorListhtml);
        $('#city_id').html(response.cityListhtml);
        $('#validator_1').html(response.validatorOneListhtml);
        $('#validator_2').html(response.validatorTwoListhtml);
        if( $.fn.DataTable.isDataTable('#submitted_cities_list') ) {
            $('#submitted_cities_list').DataTable().destroy();
        }
        $('#submitted_cities_list tbody').empty();
        $('#submitted_cities_list').find('tbody').html(response.cityData);
        // $('#submitted_cities_list').DataTable();
        $('#submitted_cities_list').dataTable( {
          "bSort": false
        } );
        new vanillaSelectBox("#city_id",{"maxOptionWidth":100, "maxHeight": 100,"search": false,translations: { "all": "All selected", "items": "cities", "item": "City" }, "placeHolder": "Please select (Multiple)" });
        
      }
    });
})
</script>
<script>
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
$(document).on('click','#createJobs',function(){
  var survey_id = $.trim($('#survey_id').val());
  var sector_id = $.trim($('#sector_id').val());
  var city_id = $.trim($('#city_id').val());
  var validator_1 = $.trim($('#validator_1').val());
  var validator_2 = $.trim($('#validator_2').val());
  if(survey_id=='' || survey_id==0){
        updatetoast('error','Please select survey');
        return false;
  }
  if(sector_id=='' || sector_id==0){
        updatetoast('error','Please select sector');
        return false;
  }
  if(city_id=='' || city_id==0){
        updatetoast('error','Please select atleast one city');
        return false;
  }
  if(validator_1=='' || validator_1==0){
        updatetoast('error','Please select validator 1');
        return false;
  }
  if(validator_2=='' || validator_2==0){
        updatetoast('error','Please select validator 2');
        return false;
  }
  $.ajax({
      type:'POST',
      url: '<?php echo base_url(); ?>admin/job/saveJobs',
      data: {'survey_id':survey_id,'sector_id':sector_id,'city_id':city_id,'validator_1':validator_1,'validator_2':validator_2},
      dataType: "json",
      success: function(response){
        console.log(response)
        if(response.status==1){
          updatetoast('success',response.msg);
          setTimeout(function() {
              location.reload();
          }, 1500);
        }else{
          updatetoast('error',response.msg);
        }
      }
  });
 
    
})
</script>
</body>
</html>