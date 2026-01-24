<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="uppunuthula prashanth">
<meta name="keywords" content="uppunuthula prashanth">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
    $settings = DB::table('general_settings')->first();
?>

<link rel="icon" href="<?php echo e(asset($settings->favicon)); ?>" />

<!-- font awesome library -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<!-- Prashanth admin  asstes -->
<link rel="stylesheet" href="<?php echo e(asset('dist/css/bootstrap4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('dist/css/theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/icon-kit/dist/css/iconkit.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/ionicons/dist/css/ionicons.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/toaster/toastr.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/select2/dist/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('dist/css/style.css')); ?>">
<!-- Stack array for including inline css or head elements -->
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php echo $__env->yieldPushContent('head'); ?>


<?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/layouts/include/head.blade.php ENDPATH**/ ?>