<?php
?><!DOCTYPE html>
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
<main id="main" class="main">
<div class="pagetitle">
<p>
<a href="<?=base_url('/admin/dashboard')?>"><i class="bi bi-chevron-left"></i> Back </a>
</p>
<h1>All Sector</h1>
<a style="margin-left:5px;" href="#" class="btn btn-primary save-part" data-bs-toggle="modal" data-bs-target="#SectorModal" aria-hidden="true">Add New</a>
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
<th scope="col">Sector Name</th>
<th scope="col">Sector Description</th>
<th scope="col" class="text-center">Sector Icon</th>
<th scope="col" class="text-center">Sector Background Image</th>
<th scope="col" class="text-center">Created At</th>
<th scope="col" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$i=1;
$k=1;
if(isset($allsector) && !empty($allsector)) {
foreach ($allsector as $allsector_details) {
$icon=base_url('assets/niua/img/').$allsector_details["sectorIcon"];
$bg=base_url('assets/niua/img/').$allsector_details["sectorBackground"];
?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo isset($allsector_details["Sector"])?ucfirst($allsector_details["Sector"]):""; ?></td>
    <td class="text-center"><textarea rows="3" cols="80"><?php echo isset($allsector_details["Description"])?$allsector_details["Description"]:""; ?></textarea></td>
    <td class="text-center"><a target="_blank" href="<?php echo $icon; ?>"><img src="<?php echo $icon; ?>" height="60px;" width="100px;"></a></td>
    <td class="text-center"><a target="_blank" href="<?php echo $bg; ?>"><img src="<?php echo $bg; ?>" height="100px;" width="100px;"></a></td>
    <td class="text-center"><?php echo !empty($allsector_details["created_on"])?$allsector_details["created_on"]:"--"; ?></td>
    <td class="text-center">
      <a href="<?php echo base_url()."admin/edit-sector/".$allsector_details["Sector_ID"]; ?>"><span style="cursor: pointer;" title="Edit Sector" class="colr2"><i class="bi bi-pencil-square"></i></span></a>      
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
<!-- Add new sector modal start here -->
      <div class="modal fade model-wid1" id="SectorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Sector </h1>
            <button type="button" class="btn-close" id="closePopUpButton" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-2">
                <label for="Sector_name" class="col-form-label lable_left">Sector Name<label class="star-red">*</label>:</label>
                <input type="text" class="form-control" id="Sector_Name" name="Sector_Name" placeholder="Please enter sector name">
                <div style="display: block; text-align: left; font-size: 11px;">
                <span><b>Note : </b>Max 100 character allowed.</span></div>
              </div>
              <div class="mb-2">
                <label for="Sector_Description" class="col-form-label lable_left">Description<label class="star-red">*</label>:</label>
                <input type="text" class="form-control" id="Sector_Description" name="Sector_Description" placeholder="Please enter description">
              </div>
              <div class="mb-2">
                <label for="Sector_Icon" class="col-form-label lable_left">Sector Icon<label class="star-red">*</label>:</label>
                <input type="file" class="form-control" id="Sector_Icon" name="Sector_Icon" placeholder="">
                <div style="display: block; text-align: left; font-size: 11px;">
                <span><b>Note : </b>.svg format allowed.</span></div>
              </div>
              <div class="mb-2">
                <label for="Sector_Images" class="col-form-label lable_left">Sector Image<label class="star-red">*</label>:</label>
                <input type="file" class="form-control" id="Sector_Images" name="Sector_Images" placeholder="">
                <div style="display: block; text-align: left; font-size: 11px;">
                <span><b>Note : </b>.png, .jpg, and .jpeg format allowed.</span></div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveNewSector">Create Sector</button>
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
<script src="<?php echo base_url('assets/sweet_alert/sweetalert.js'); ?>"></script>
<script src="<?php echo base_url('assets/sweet_alert/sweetalert_animation.js'); ?>"></script>
<script src="<?php echo base_url('assets/niua/js/jquery-ui.js'); ?>"></script>
<script>  
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
</script>

<script >
  $(document).on('click','#saveNewSector',function(){
  var sector_Name = $.trim($('#Sector_Name').val());
  var sector_Description = $.trim($('#Sector_Description').val());
  var sector_Icon = $.trim($('#Sector_Icon').val());
  var extcat_Sector_Icon = sector_Icon.split('.').pop();
  var sector_Images = $.trim($('#Sector_Images').val());
  var extcat_sector_Images = sector_Images.split('.').pop();
  if(sector_Name==''){
    updatetoast('error','Please enter sector name');
    $('#Sector_Name').focus();
    return false;
  }else{
    if(sector_Name.length > 100){
      updatetoast('error','Sector name should be less than 100 characters');
    $('#Sector_Name').focus();
    return false;
    }
  }
  if(sector_Description==''){
    updatetoast('error','Please enter sector description');
    $('#Sector_Description').focus();
    return false; 
  }else{
    if(sector_Description.length > 500){
      updatetoast('error','Description should be less than 500 characters');
      $('#Sector_Description').focus();
      return false;
    }
  }


  if(sector_Icon!=''){
    if($.inArray(extcat_Sector_Icon,['svg']) == -1){
      updatetoast('error','Please attach .svg image format only');
      $('#Sector_Icon').val('');
      return false; 
    }
  }else{
      updatetoast('error','Please attach sector icon');
      return false;
  }
  if(sector_Images!=''){
    if($.inArray(extcat_sector_Images,['png','PNG','jpg','JPG','jpeg','JPEG']) == -1){
      updatetoast('error','Please attach .png, .jpg, .jpeg  image format only'); 
      $('#Sector_Images').val('');    
      return false; 
    }
  }else{
      updatetoast('error','Please attach sector image');
      return false;
  }

    var form_data = new FormData();
    form_data.append('Sector',sector_Name);
    form_data.append('Description',sector_Description);
    if($("#Sector_Images")[0].files.length > 0){
     form_data.append('sectorIcon',$('#Sector_Icon')[0].files[0]);
    }
    if($("#Sector_Images")[0].files.length!=0){
       form_data.append('sectorBackground',$('#Sector_Images')[0].files[0]);
    }

    $.ajax({
      url         : '<?php echo base_url(); ?>admin/addNewSector',   
      dataType    : 'text',         
      cache       : false,
      contentType : false,
      processData : false,
      data        : form_data,                        
      type        : 'post',
      success     : function(res){
        var response = JSON.parse(res);
        if(response.status==1){
          updatetoast('success',response.msg); 

           setTimeout(function() {
                        location.reload();
            }, 1000);
                       
        }else{
          updatetoast('error',response.msg);    
        }
      }       
    });
})
</script>
</body>
</html>