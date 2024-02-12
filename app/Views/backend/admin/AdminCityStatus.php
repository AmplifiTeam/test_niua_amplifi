<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> NIUA | City Status</title>
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
  .back-to-top{
    display: none;
  }
  .sec1 select {
    font-size: 11px;
    width: 100%;
    color: #000;
    height: 30px;
}

.orange{
  color: orange!important;
}
.red{
  color: red!important;
}
.green{
  color: #6ce96c!important;
}


#myJobsDataTable_wrapper{position:relative;top: -24px;}
#myJobsDataTable_filter{
    float: right;
    margin-top: -8px;
    padding-bottom: 10px;
}
.dataTables_wrapper .dataTables_length {
    margin:0px 0px;
    width: 30%;
    height:24px;
    /*padding-top: 0px;*/
}
.dataTables_info{width: 50%;}
.dataTables_paginate.paging_simple_numbers{
      position: relative;
    float: right;
    top: 2px;
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
/*.sec1{
     width: 18%;
    position: relative;
    left: 40%;
    top: 0px;
    height: 30px;
    line-height: 30px;
}*/
.sec1 {
    width: 21%;
    position: relative;
    left: 34%;
    top: 0px;
    height: 30px;
    line-height: 30px;
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

<body>
  <?php echo view('backend/partials/top_header.php'); ?>
  <main id="main" class="main">
    <div class="se-pre-con" style="display: none;"></div>
    <div class="pagetitle">
      <h1> All Cities Status </h1>
    </div>
    <!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">        
        <div class="col-lg-12 ad-table1">
          <div class="data-subm1"> 
            <a  href="<?=base_url('admin/job')?>"> Data Submission Details by Cities </a>
            <a  href="<?=base_url('admin/myjobs')?>"> My Jobs </a>
            <a class="actv-1" href="<?=base_url('admin/city-status')?>">City Status </a>
          </div>

          <div class="sec1 d-flex" style="z-index: 1">
            <label for="" class="">Survey </label>&nbsp;         
            <select class="form-select" aria-label="Default select example" name="survey_id" id="survey_id">
              <?php if(!empty($surveyList)){
                foreach($surveyList as $skey=>$survey){?>
                    <option value="<?=$survey['Survey_ID']?>"><?=$survey['Survey_Name']?></option>
                <?php }
              }?>
            </select>



            <div class="downloadSurveyExcelFileIconShowHide" id="downloadCityStatusData" style="cursor: pointer; z-index: 1; font-size: x-large;margin-left: 5px;">
              <a href="#">
                <i class="bi bi-download" title="download city data"></i>
              </a>
            </div>
          </div>


         
          <table class="table table-db1" id="myJobsDataTable">
            <thead>
              <tr class="tbl-bg1">
                <th class="tb-wid2">City ID</th>
                <th class="tb-wid2">City Name</th>            
                <th class="tb-wid2">State</th>
                <th class="tb-wid4">Status</th>
                <th class="tb-wid4">Progress</th>
                <!-- <th class="tb-wid4">Submit Status</th> -->
              </tr>
            </thead>
            <tbody class="table-group-divider" id="cityAjaxListData">
              <tr>
                <td class="tb-wid2"></td>
                <td class="tb-wid2"></td>
                <td class="tb-wid2">No data found</td>
                <td class="tb-wid4"></td>
                <td class="tb-wid4"></td>
              </tr>
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
   <script>

    $(document).ready(function(){
      $('#survey_id').trigger('change');
    })
  </script>
<script>
$(document).on('change','#survey_id',function(){
  var survey_id = $.trim($('#survey_id').val());
  if(survey_id!='' && survey_id > 0){
  $('.se-pre-con').show();
      $.ajax({
          type:'POST',
          url: '<?=base_url("admin/getSurveyCityListData")?>',
          data: {'survey_id':survey_id},
          dataType: "json",
          success: function(response){
            console.log(response);
              $('#cityAjaxListData').html(response.cityListHtml);
              if( $.fn.DataTable.isDataTable('#myJobsDataTable') ) {
                  $('#myJobsDataTable').DataTable().destroy();
              }
              $('#myJobsDataTable').find('tbody').find('tr').remove();
              $('#cityAjaxListData').html(response.cityListHtml);
              // $('#myJobsDataTable').DataTable();
              oTable = $('#myJobsDataTable').dataTable();
              oTable.fnSort( [ [4,'desc'] ] );
              $('.se-pre-con').hide();
          }
        });
    }
})



// downloadCityStatusData
$(document).on('click','#downloadCityStatusData', function(){
   var survey=$("#survey_id").val().trim();
   if(survey!="" && survey > 0){
    var base='<?=base_url()?>';
    var redirect=`${base}admin/download_cityStatusData_excel/${survey}`;
    window.location.href=redirect;
   }else{
      updatetoast('error','Please select survey');
        return false;
   }
});

</script>


</body>



</html>