<?php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
    $settings = DB::table('general_settings')->first();
?>
<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="<?php echo e(route('admin.dashboard')); ?>">
            <div class="logo-img">
            <img height="45" src="<?php echo e(asset($settings->header_logo)); ?>" onerror="this.src='/img/logo.png';" class="header-brand-img" title="Prashanth">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item <?php echo e(($segment2 == 'dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="ik ik-bar-chart-2"></i><span><?php echo e(__('Dashboard')); ?></span></a>
                </div>
                <div class="nav-lavel"><?php echo e(__('Menu Items')); ?> </div>

                <div
                    class="nav-item <?php echo e(($segment2 == 'users' || $segment2 == 'roles'||$segment2 == 'permission' ||$segment2 == 'user') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-user"></i><span><?php echo e(__('Adminstrator')); ?></span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_user')): ?>
                        <a href="<?php echo e(url('admin/users')); ?>"
                            class="menu-item <?php echo e(($segment1 == 'users') ? 'active' : ''); ?>"><?php echo e(__('Users')); ?></a>
                        <a href="<?php echo e(url('admin/user/create')); ?>"
                            class="menu-item <?php echo e(($segment2 == 'user' && $segment3 == 'create') ? 'active' : ''); ?>"><?php echo e(__('Add User')); ?></a>
                        <?php endif; ?>
                        <!-- only those have manage_role permission will get access -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_roles')): ?>
                        <a href="<?php echo e(url('admin/roles')); ?>"
                            class="menu-item <?php echo e(($segment2 == 'roles') ? 'active' : ''); ?>"><?php echo e(__('Roles')); ?></a>
                        <?php endif; ?>
                        <!-- only those have manage_permission permission will get access -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_permission')): ?>
                        <a href="<?php echo e(url('admin/permission')); ?>"
                            class="menu-item <?php echo e(($segment2 == 'permission') ? 'active' : ''); ?>"><?php echo e(__('Permission')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- home page -->
                <div class="nav-item <?php echo e(($segment2 == 'banners') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/banners')); ?>"><i class="ik ik-image"></i><span>Banners</span> </a>
                </div>

                <div class="nav-item <?php echo e(($segment2 == 'highlights') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/highlights')); ?>"><i class="ik ik-image"></i><span>Highlights</span> </a>
                </div>

                <div class="nav-item <?php echo e(($segment2 == 'firstgallery') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/firstgallery')); ?>"><i class="ik ik-image"></i><span>First Gallery</span> </a>
                </div>
                
                <div class="nav-item <?php echo e(($segment2 == 'aboutitems') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/aboutitems')); ?>"><i class="ik ik-image"></i><span>About Items</span> </a>
                </div>

                <div class="nav-item <?php echo e(($segment2 == 'specialized') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/specialized')); ?>"><i class="ik ik-image"></i><span>Specialized section</span> </a>
                </div>
                
                <div class="nav-item <?php echo e(($segment2 == 'depratments') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/depratments')); ?>"><i class="ik ik-image"></i><span>Depratments</span> </a>
                </div>

                <div class="nav-item <?php echo e(($segment2 == 'imagegallery') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/imagegallery')); ?>"><i class="ik ik-image"></i><span>Image Gallery</span> </a>
                </div>
                <div class="nav-item <?php echo e(($segment2 == 'category') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/category')); ?>"><i class="ik ik-image"></i><span>Dynamic page Category</span> </a>
                </div>

                <div class="nav-item <?php echo e(($segment2 == 'pages') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/pages')); ?>"><i class="ik ik-book"></i><span>Dynamic Pages</span> </a>
                </div>
                <!-- reviews -->
                <div class="nav-item <?php echo e(($segment2 == 'reviews') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/reviews')); ?>"><i class="ik ik-star"></i><span>Reviews</span> </a>
                </div>

<!-- 
                <div class="nav-item <?php echo e(($segment2 == 'blog') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/blog')); ?>"><i class="ik ik-rss"></i><span>Blogs</span> </a>
                </div> -->
                <!-- <div class="nav-item <?php echo e(($segment2 == 'seo') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/seo')); ?>"><i class="ik ik-code"></i><span>SEO Sections</span> </a>
                </div> -->

                <div class="nav-item <?php echo e(($segment2 == 'contact') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/contact')); ?>"><i class="ik ik-phone"></i><span>Contact</span> </a>
                </div>
                <!-- <div class="nav-item <?php echo e(($segment2 == 'create-dynamic-crud') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/create-dynamic-crud')); ?>"><i class="ik ik-book"></i><span>Create Crud</span> </a>
                </div> -->

                

                <div class="nav-item <?php echo e(($segment2 == 'general') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/general')); ?>"><i class="ik ik-settings"></i><span>General Settings</span> </a>
                </div>

        </div>
    </div>
</div><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/layouts/include/sidebar.blade.php ENDPATH**/ ?>