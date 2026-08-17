@php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
    $settings = DB::table('general_settings')->first();
@endphp
<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('admin.dashboard')}}">
            <div class="logo-img">
            <img height="45" src="{{ asset($settings->header_logo) }}" onerror="this.src='/img/logo.png';" class="header-brand-img" title="Prashanth">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment2 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{
                            __('Dashboard')}}</span></a>
                </div>
                <div class="nav-lavel">{{ __('Menu Items')}} </div>

                <div
                    class="nav-item {{ ($segment2 == 'users' || $segment2 == 'roles'||$segment2 == 'permission' ||$segment2 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_user')
                        <a href="{{url('admin/users')}}"
                            class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('admin/user/create')}}"
                            class="menu-item {{ ($segment2 == 'user' && $segment3 == 'create') ? 'active' : '' }}">{{
                            __('Add User')}}</a>
                        @endcan
                        <!-- only those have manage_role permission will get access -->
                        @can('manage_roles')
                        <a href="{{url('admin/roles')}}"
                            class="menu-item {{ ($segment2 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('manage_permission')
                        <a href="{{url('admin/permission')}}"
                            class="menu-item {{ ($segment2 == 'permission') ? 'active' : '' }}">{{
                            __('Permission')}}</a>
                        @endcan
                    </div>
                </div>

                       <div class="nav-item {{ ($segment2 == 'home-h2-section') ? 'active' : '' }}">
                           <a href="{{url('admin/home-h2-section')}}"><i class="ik ik-layout"></i><span>Home H2 Section</span></a>
                       </div>
                       
                       <div class="nav-item {{ ($segment2 == 'about-clinic') ? 'active' : '' }}">
                           <a href="{{url('admin/about-clinic')}}"><i class="ik ik-file-text"></i><span>About Clinic</span></a>
                       </div>
                       <div class="nav-item {{ ($segment2 == 'about-doctor') ? 'active' : '' }}">
                           <a href="{{url('admin/about-doctor')}}"><i class="ik ik-file-text"></i><span>About Doctor</span></a>
                       </div>
                       
                       <div class="nav-item {{ ($segment2 == 'contact-page') ? 'active' : '' }}">
                           <a href="{{url('admin/contact-page')}}"><i class="ik ik-image"></i><span>Contact Page</span></a>
                       </div>

                       <div class="nav-item {{ ($segment2 == 'appointment-diseases') ? 'active' : '' }}">
                           <a href="{{url('admin/appointment-diseases')}}"><i class="ik ik-list"></i><span>Appointment Diseases</span></a>
                       </div>
                       <div class="nav-item {{ ($segment2 == 'doctors') ? 'active' : '' }}">
                           <a href="{{url('admin/doctors')}}"><i class="ik ik-users"></i><span>Doctors</span></a>
                       </div>

                       <div class="nav-item {{ ($segment2 == 'appointments') ? 'active' : '' }}">
                    <a href="{{url('admin/appointments')}}"><i class="ik ik-calendar"></i><span>Appointments</span> </a>
                </div>

                <div class="nav-item {{ ($segment2 == 'contact') ? 'active' : '' }}">
                    <a href="{{url('admin/contact')}}"><i class="ik ik-phone"></i><span>Contact Requests</span> </a>
                </div>


                <!-- home page -->
                <div class="nav-item {{ ($segment2 == 'banners') ? 'active' : '' }}">
                    <a href="{{url('admin/banners')}}"><i class="ik ik-sliders"></i><span>Banners</span> </a>
                </div>


                

                <div class="nav-item {{ ($segment2 == 'specialized') ? 'active' : '' }}">
                    <a href="{{url('admin/specialized')}}"><i class="ik ik-bookmark"></i><span>Specialized section</span> </a>
                </div>
                

                <div class="nav-item {{ ($segment2 == 'imagegallery') ? 'active' : '' }}">
                    <a href="{{url('admin/imagegallery')}}"><i class="ik ik-image"></i><span>Image Gallery</span> </a>
                </div>
                <!-- ytvideo -->
                 <div class="nav-item {{ ($segment2 == 'ytvideo') ? 'active' : '' }}">
                    <a href="{{url('admin/ytvideo')}}"><i class="ik ik-video"></i><span>Youtube videos gallery</span> </a>
                </div>
                <div class="nav-item {{ ($segment2 == 'pages') ? 'active' : '' }}">
                    <a href="{{url('admin/pages')}}"><i class="ik ik-book"></i><span>Dynamic Pages & Category</span> </a>
                </div>
                <!-- reviews -->
                <div class="nav-item {{ ($segment2 == 'reviews') ? 'active' : '' }}">
                    <a href="{{url('admin/reviews')}}"><i class="ik ik-star"></i><span>Reviews</span> </a>
                </div>
                <!-- testimonials -->
                <div class="nav-item {{ ($segment2 == 'testimonials') ? 'active' : '' }}">
                    <a href="{{url('admin/testimonials')}}"><i class="ik ik-video"></i><span>Case Studies / Testimonials</span> </a>
                </div>


                <div class="nav-item {{ ($segment2 == 'blog') ? 'active' : '' }}">
                    <a href="{{url('admin/blog')}}"><i class="ik ik-rss"></i><span>Blogs</span> </a>
                </div>
                <!-- <div class="nav-item {{ ($segment2 == 'seo') ? 'active' : '' }}">
                    <a href="{{url('admin/seo')}}"><i class="ik ik-code"></i><span>SEO Sections</span> </a>
                </div> -->

         
                <!-- <div class="nav-item {{ ($segment2 == 'create-dynamic-crud') ? 'active' : '' }}">
                    <a href="{{url('admin/create-dynamic-crud')}}"><i class="ik ik-book"></i><span>Create Crud</span> </a>
                </div> -->

                

                <div class="nav-item {{ ($segment2 == 'general') ? 'active' : '' }}">
                    <a href="{{url('admin/general')}}"><i class="ik ik-settings"></i><span>General Settings</span> </a>
                </div>

        </div>
    </div>
</div>