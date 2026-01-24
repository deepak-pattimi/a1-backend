<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <title><?php echo $__env->yieldContent('title', ''); ?> | Prashanth CMS-Admin</title>
    <!-- initiate head with meta tags, css and script -->
    <?php echo $__env->make('layouts.include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body id="app">
    <div class="wrapper">
        <!-- initiate header (conditionally loaded) -->
        <?php if (! empty(trim($__env->yieldContent('no-header')))): ?>
            <?php echo $__env->yieldContent('no-header'); ?>
        <?php else: ?>
            <?php echo $__env->make('layouts.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <div class="page-wrap">
            <!-- initiate sidebar -->
            <?php echo $__env->make('layouts.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="main-content">
                <!-- yield contents here -->
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <!-- initiate footer section (conditionally loaded) -->
            <?php if (! empty(trim($__env->yieldContent('no-footer')))): ?>
                <?php echo $__env->yieldContent('no-footer'); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- initiate scripts -->
    <?php echo $__env->make('layouts.include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/layouts/main.blade.php ENDPATH**/ ?>