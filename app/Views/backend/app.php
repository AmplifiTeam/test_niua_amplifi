<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8" />

<?php $this->renderSection('page_title'); ?>
<!-- <link rel="icon" href="<?php //echo base_url(); ?>assets/frontend/images/favicon.png"> -->
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

<meta content name="description" />

<meta content name="author" />

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

<?php $this->renderSection('external_css'); ?>

<?php $this->renderSection('internal_css'); ?>

<style>

#toolbarContainer{

display: none !important;

}
.breadcrumb-item + .breadcrumb-item::before {
float: left;
padding-right: var(--bs-breadcrumb-item-padding-x);
color: var(--bs-breadcrumb-divider-color);
content: '';
}

.panel-heading-btn{
 display: none !important;	
}

</style>

</head>

<body>

<div id="loader" class="app-loader">

<span class="spinner"></span>

</div>

<div id="app" class="app app-header-fixed app-sidebar-fixed ">

<!-- #######################################Top-Header################################# -->

<?php echo view('backend/partials/top_header.php'); ?>

<!-- #######################################End SideBar############################### -->



<!-- #######################################Top-Header################################# -->

<?php echo view('backend/partials/left_sidebar.php'); ?>

<!-- #######################################End SideBar################################ -->



<div class="app-sidebar-bg"></div>

<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

<!-- ########################################Main Content############################## -->

<?php $this->renderSection('content'); ?>

<!-- ##############################################End Main Content#################### -->

<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

</div>

<?php $this->renderSection('external_js'); ?>

</body>

<?php $this->renderSection('internal_js'); ?>

</html>