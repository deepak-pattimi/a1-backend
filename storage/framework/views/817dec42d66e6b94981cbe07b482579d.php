 
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <!-- push external head elements to head -->
    <?php $__env->startPush('head'); ?>

        <link rel="stylesheet" href="<?php echo e(asset('plugins/weather-icons/css/weather-icons.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('plugins/chartist/dist/chartist.min.css')); ?>">
    <?php $__env->stopPush(); ?>

    <div class="container-fluid">
    	<h2>Welcome</h2>
    </div>
	<!-- push external js -->
    <?php $__env->startPush('script'); ?>
        <script src="<?php echo e(asset('plugins/owl.carousel/dist/owl.carousel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/chartist/dist/chartist.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.js')); ?>"></script>
        <!-- <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.categories.js')); ?>"></script> -->
        <script src="<?php echo e(asset('plugins/flot-charts/curvedLines.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.tooltip.min.js')); ?>"></script>

        <script src="<?php echo e(asset('plugins/amcharts/amcharts.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/amcharts/serial.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/amcharts/themes/light.js')); ?>"></script>
       
        
        <script src="<?php echo e(asset('js/widget-statistic.js')); ?>"></script>
        <script src="<?php echo e(asset('js/widget-data.js')); ?>"></script>
        <script src="<?php echo e(asset('js/dashboard-charts.js')); ?>"></script>
        
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/dashboard/index.blade.php ENDPATH**/ ?>