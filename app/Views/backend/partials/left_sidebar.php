<div id="sidebar" class="app-sidebar">
<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
<div class="menu">
<div class="menu-profile">
<a href="javascript:void(0);" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
<div class="menu-profile-cover with-shadow"></div>
<div class="menu-profile-image">
<img src="<?php echo base_url(); ?>assets/img/user/default-user.jpg" alt />
</div>
<?php
$uri=service('uri');
$geturi=$uri->getSegments();
$route=$geturi[1];
//echo "Route : ".$route;
$logedInUserDetail=session('admin_detail');
$loginUserId=$logedInUserDetail['user_id'];
$loginUserName=$logedInUserDetail['user_name'];
$seoRoutes=['seo-management','add-seo','edit-seo'];
$productRoutes=['product-list','add-product','edit-product'];
$blogRoutes=['blog-management','add-blog','edit-blog'];
$systemInfoRoutes=['terms-conditions','privacy-policy'];
$enquiryRoutes=['travel-buddy-enquiry','bulk-enquiry','contacts','product-enquiry'];
$formRoutes=['add-form','forms','edit-form'];
?>
<div class="menu-profile-info">
<div class="d-flex align-items-center">
<div class="flex-grow-1"><?php echo ucwords($loginUserName) ?></div>
<div class="menu-caret ms-auto"></div>
</div>
<small>NIUA Dashboard</small>
</div>
</a>
</div>
<div id="appSidebarProfileMenu" class="collapse">
<div class="menu-item pb-5px">
<a href="<?php echo base_url('admin/logout'); ?>" class="menu-link">
<div class="menu-icon"><i class="fa fa-question-circle"></i></div>
<div class="menu-text">Logout</div>
</a>
</div>
<div class="menu-divider m-0"></div>
</div>
<div class="menu-header">Navigation</div>


<div class="menu-item">
<a href="<?php echo base_url('admin/dashboard'); ?>" class="menu-link">
<div class="menu-icon">
<i class="fa fa-dashboard"></i>
</div>
<div class="menu-text">Dashboard</div>
</a>
</div>

<div class="menu-item d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-list-alt"></i>
</div>
<div class="menu-text">Sectors</div>
</a>
</div>

<div class="menu-item d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-users"></i>
</div>
<div class="menu-text">Users</div>
</a>
</div>

<div class="menu-item d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-list-alt"></i>
</div>
<div class="menu-text">City</div>
</a>
</div>

<div class="menu-item has-sub closed d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-check-square"></i>
</div>
<div class="menu-text">Form Management</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: none; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/add-form'); ?>" class="menu-link"><div class="menu-text">Create Form</div></a>
</div>
</div>
</div>

<div class="menu-item has-sub closed">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-question"></i>
</div>
<div class="menu-text">Question Management</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: none; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/create-question'); ?>" class="menu-link"><div class="menu-text">Create Question</div></a>
</div>

</div>
</div>


</div>
</div>



<div class="menu-item has-sub closed">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-user"></i>
</div>
<div class="menu-text">Users</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: none; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/registered-users'); ?>" class="menu-link"><div class="menu-text">Registered Users</div></a>
</div>
</div>
</div>

<div class="menu-item has-sub closed">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fas fa-coins"></i>
</div>
<div class="menu-text">Inventory</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: <?php if(in_array($route, $productRoutes)){ echo "block"; }else{ echo "none"; } ?>; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/product-list'); ?>" class="menu-link"><div class="menu-text">Product Management</div></a>
</div>
</div>
</div>


<div class="menu-item has-sub closed  d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fa fa-info-circle"></i>
</div>
<div class="menu-text">System Information</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: <?php if(in_array($route, $systemInfoRoutes)){ echo "block"; }else{ echo "none"; } ?>; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/terms-conditions'); ?>" class="menu-link"><div class="menu-text">Terms & Conditions</div></a>
</div>
<div class="menu-item">
<a href="<?php echo base_url('admin/privacy-policy'); ?>" class="menu-link"><div class="menu-text">Privacy & Policy</div></a>
</div>
<div class="menu-item">
<a href="javascript:void(0);" class="menu-link"><div class="menu-text">Other Information</div></a>
</div>
</div>
</div>



<div class="menu-item has-sub closed  d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fas fa-search-location"></i>
</div>
<div class="menu-text">SEO</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: <?php if(in_array($route, $seoRoutes)){ echo "block"; }else{ echo "none"; } ?>; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/seo-management'); ?>" class="menu-link"><div class="menu-text">SEO Mangement</div></a>
</div>
</div>
</div>


<div class="menu-item has-sub closed  d-none">
<a href="javascript:void(0);" class="menu-link">
<div class="menu-icon">
<i class="fas fa-blog"></i>
</div>
<div class="menu-text">Blog</div>
<div class="menu-caret"></div>
</a>
<div class="menu-submenu" style="display: <?php if(in_array($route, $blogRoutes)){ echo "block"; }else{ echo "none"; } ?>; box-sizing: border-box;">
<div class="menu-item">
<a href="<?php echo base_url('admin/blog-management'); ?>" class="menu-link"><div class="menu-text">Blog Mangement</div></a>
</div>
</div>
</div>



<div class="menu-item  d-none">
<a href="<?php echo base_url('admin/testimonial'); ?>" class="menu-link">
<div class="menu-icon">
<i class="fa fa-quote-left"></i>
</div>
<div class="menu-text">Testimonial</div>
</a>
</div>

<div class="menu-item  d-none">
<a href="<?php echo base_url('admin/view-travel-buddy'); ?>" class="menu-link">
<div class="menu-icon">
<i class="fas fa-bus-alt"></i>
</div>
<div class="menu-text">Travel Buddy</div>
</a>
</div>






<div class="menu-item d-flex">
<a href="javascript:void(0);" class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
</div>
</div>
</div>
</div>