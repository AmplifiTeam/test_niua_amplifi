<style >
	.notificationTimeClass{
		font-size: 11px;
    	float: right;
	}
</style>

<?php
$uri=service('uri');
$geturi=$uri->getSegments();
$action=$geturi[1];
//echo "Action : ".$action; die;
$logedInUserDetail=session('admin_detail');
$loginUserCity=$logedInUserDetail['City'];
$loginUserid =$logedInUserDetail['user_id'];
?>
<header id="header" class="header fixed-top d-flex align-items-center">
<div class="d-flex align-items-center justify-content-between">
<a href="<?php echo base_url('admin/dashboard'); ?>" class="logo d-flex align-items-center">
<img src="<?php echo base_url('assets/niua/img/logo.png'); ?>" alt="">
<img src="<?php echo base_url('assets/niua/img/logo-2 ministoy-B.png'); ?>" alt="">
</a>
</div>
<div class="search-bar">
<?php if($logedInUserDetail['role']==1 || $logedInUserDetail['role']==5){ ?>
<p>
	<a title="Question" style="text-decoration: none; color: inherit;" href="<?php echo base_url('admin/dashboard'); ?>" class="color-1 <?php if($action=="dashboard"){echo "jobSelected";} ?>"> Questions </a>
	 &nbsp; <span><a title="Job" style="text-decoration: none; color: inherit;" href="<?php echo base_url('admin/job'); ?>" class="color-1 <?php if($action=="job" || $action=="city-status" || $action=="myjobs"){echo "jobSelected";} ?>">Jobs</a></span>
</p> 
<?php } ?>


<?php
if($logedInUserDetail['role']==4 && ($action=="sector-question" || $action=="sector-revert-question")){
?>



<progress class="surveySectorAllAnsweredQues" style="" id="file" value="<?php echo $cityAnswered; ?>" max="<?php echo count($question); ?>"></progress>

<p><span>Responded <span class="sectorTotalAnswered"><?php echo $cityAnswered; ?></span>/<?php echo count($question); ?> Question (<?php echo round(($cityAnswered/count($question) * 100)) .'%'; ?>)</span></p>


<?php } ?>

</div><!-- End Search Bar -->
<nav class="header-nav ms-auto">
<ul class="d-flex align-items-center">
<li class="nav-item dropdown">
<?php if($logedInUserDetail['role']==2 || $logedInUserDetail['role']==3){ 

	$notificationData = getNotification($loginUserid);
 	$totalNotificationCount = count($notificationData);


	?>
<a href="#" class="nav-link nav-icon" data-bs-toggle="dropdown">
<i class="bi bi-bell"></i>
<span class="badge bg-primary badge-number"><?=$totalNotificationCount?></span>
</a>
<?php if($totalNotificationCount > 0){ ?>
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="min-height: 50px;height: 158px;max-height: 204px;overflow: scroll;">
<li class="dropdown-header">
You have <?=$totalNotificationCount?> new notifications
<a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2 markAllReadNotification"> Mark all read </span></a>
</li>
<li>
<hr class="dropdown-divider">
</li>

<?php 
	if($totalNotificationCount > 0){
		foreach($notificationData as $nkey=>$notification){ ?>
			<li class="notification-item">
			<i class="bi bi-check-circle text-success"></i>
			<div>
			<p> <?=$notification['msg'] ?></p>
			<span class="notificationTimeClass"> <?=date('d-m-Y H:i',strtotime($notification['created_on'])) ?></span>
			</div>
			</li>
			<li>
			<hr class="dropdown-divider">
			</li>
<?php 	} 
	}  ?>

</ul><!-- End Notification Dropdown Items -->

<?php }  }?>

</li><!-- End Notification Nav -->
<li class="nav-item dropdown pe-3">
<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
<img src="<?php echo base_url('assets/niua/img/messages-1.jpg'); ?>" alt="Profile" class="rounded-circle">
<span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo ucwords('Welcome, '.$loginUserCity); ?> </span>
</a><!-- End Profile Iamge Icon -->
<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
<?php if($logedInUserDetail['role']==5){ ?>
<li class="">
<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/view-question'); ?>">
<i class="bi bi-question-circle"></i>
<span>Question Master</span>
</a>
</li>

<li class="">
<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/view-survey'); ?>">
<i class="bi bi-pencil-square"></i>
<span>Survey Master</span>
</a>
</li>

<li class="">
<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/view-sector'); ?>">
<i class="bi bi-amd"></i>
<span>Sector Master</span>
</a>
</li>

<li class="">
<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/user-list'); ?>">
<i class="bi bi-person-square"></i>
<span>User Master</span>
</a>
</li>
<?php } ?>
<li>
<a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/logout'); ?>">
<i class="bi bi-box-arrow-right"></i>
<span>Sign Out</span>
</a>
</li>
</ul>
</li><!-- End Profile Nav -->
<li class="pe-3 d-none"> 
<i class="bi bi-list toggle-sidebar-btn"></i>
</li>
</ul>
</nav><!-- End Icons Navigation -->
</header><!-- End Header -->