<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\UploadMultipleImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\DynamicCrudController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\PageDynamicItemController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.login');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.login');
    // Authentication Routes
    Route::post('login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);
    

    Route::get('/clear-cache', [HomeController::class, 'clearCache']);

    // Password Reset Routes
    Route::get('password/forget', function () {
        return view('auth.forgot-password');
    })->name('password.forget');
    
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
        Route::post('/update-profile', [DashboardController::class, 'update_profile'])->name('admin.update-profile');
       
        // User Management Routes
        Route::middleware(['can:manage_user'])->group(function () {
            Route::get('/users', [UserController::class, 'index']);
            Route::get('/user/get-list', [UserController::class, 'getUserList']);
            Route::get('/user/create', [UserController::class, 'create']);
            Route::post('/user/create', [UserController::class, 'store'])->name('create-user');
            Route::get('/user/{id}', [UserController::class, 'edit']);
            Route::post('/user/update', [UserController::class, 'update']);
            Route::get('/user/delete/{id}', [UserController::class, 'delete']);
        });

        // Role Management Routes
        Route::middleware(['can:manage_role|manage_user'])->group(function () {
            Route::get('/roles', [RolesController::class, 'index']);
            Route::get('/role/get-list', [RolesController::class, 'getRoleList']);
            Route::post('/role/create', [RolesController::class, 'create']);
            Route::get('/role/edit/{id}', [RolesController::class, 'edit']);
            Route::post('/role/update', [RolesController::class, 'update']);
            Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
        });

        // Permission Management Routes
        Route::middleware(['can:manage_permission|manage_user'])->group(function () {
            Route::get('/permission', [PermissionController::class, 'index']);
            Route::get('/permission/get-list', [PermissionController::class, 'getPermissionList']);
            Route::post('/permission/create', [PermissionController::class, 'create']);
            Route::get('/permission/update', [PermissionController::class, 'update']);
            Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
        });

        // Banners and Contact Management Routes
        Route::get('/banner-status/{status}/{id}', [BannersController::class, 'bannerStatus']);
        Route::resource('/banners', BannersController::class);
        Route::resource('/contact', ContactController::class);
        Route::get('/general', [GeneralController::class, 'index']);
        Route::post('/general/update',[ GeneralController::class, 'update']);

        // home route
        Route::resource('highlights', Admin\HighlightsController::class);
        Route::resource('firstgallery', Admin\FirstgalleryController::class);
        Route::resource('aboutitems', Admin\AboutitemsController::class);
        Route::resource('specialized', Admin\SpecializedController::class);
        Route::resource('depratments', Admin\DepratmentsController::class);
        Route::resource('imagegallery', Admin\ImagegalleryController::class);
        Route::resource('category', Admin\CategoryController::class);
        Route::resource('testimonials', Admin\TestimonialController::class);
        Route::resource('reviews', Admin\ReviewsController::class);

        // Change any record status
        Route::get('change-status/{tableName}/{id}', [GeneralController::class, 'changeStatus'])->name('change-status');

        // Appointments routes - excluding the default update method since we use custom update routes
        Route::resource('appointments', AppointmentController::class)->except(['update']);
        Route::post('appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
        // Note: We removed updatePaymentStatus method from the controller, so removing this route too
        // If we need separate payment status update, we would add it back

        // Appointment Diseases
        Route::resource('appointment-diseases', Admin\AppointmentDiseaseController::class);
        Route::resource('doctors', Admin\DoctorController::class);
        
        Route::get('home-h2-section', [\App\Http\Controllers\Admin\HomeH2SectionController::class, 'edit']);
        Route::post('home-h2-section', [\App\Http\Controllers\Admin\HomeH2SectionController::class, 'update']);
        
        Route::get('about-clinic', [\App\Http\Controllers\Admin\AboutPageController::class, 'editClinic']);
        Route::post('about-clinic', [\App\Http\Controllers\Admin\AboutPageController::class, 'updateClinic']);
        Route::get('about-doctor', [\App\Http\Controllers\Admin\AboutPageController::class, 'editDoctor']);
        Route::post('about-doctor', [\App\Http\Controllers\Admin\AboutPageController::class, 'updateDoctor']);

        Route::get('contact-page', [\App\Http\Controllers\Admin\ContactPageController::class, 'edit']);
        Route::post('contact-page', [\App\Http\Controllers\Admin\ContactPageController::class, 'update']);

        // Dynamic pages
        Route::resource('pages', PageController::class);
        // Dynamic items for pages
        Route::prefix('pages/{page}')->name('pages.')->group(function () {
            Route::resource('dynamic-items', PageDynamicItemController::class)->names([
                'index' => 'dynamic-items.index',
                'create' => 'dynamic-items.create',
                'store' => 'dynamic-items.store',
                'edit' => 'dynamic-items.edit',
                'update' => 'dynamic-items.update',
                'destroy' => 'dynamic-items.destroy'
            ]);
        });
        
        // CKEditor Image Upload
        Route::post('/ckeditor/upload', [GeneralController::class, 'ckeditorUpload'])->name('ckeditor.upload');

        // Blog
        Route::resource('/blog-categories', Admin\BlogCategoryController::class);
        Route::resource('/blog', BlogController::class);
        // SEO
        Route::resource('gallery', Admin\GalleryController::class);
        Route::resource('/seo', SeoController::class);
        Route::get('/create-dynamic-crud', [DynamicCrudController::class, 'create'])->name('dynamic.crud.create');
        Route::post('/dynamic-crud/store', [DynamicCrudController::class, 'store'])->name('dynamic.crud.store');
        Route::resource('ytvideo', Admin\YtvideoController::class);
    });


});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
