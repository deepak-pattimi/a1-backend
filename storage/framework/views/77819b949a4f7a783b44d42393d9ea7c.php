<script src="<?php echo e(asset('dist/js/all.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/theme.js')); ?>"></script>
<script src="<?php echo e(asset('js/toaster.js')); ?>"></script>
<script src="<?php echo e(asset('js/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/select2/dist/js/select2.min.js')); ?>"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('plugins/lazy/jquery.lazy.min.js')); ?>"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<?php echo \Livewire\Livewire::scripts(); ?>

<script src="<?php echo e(asset('dist/js/livewire.js')); ?>"></script>

<script>
    // Show success message using Toastr
    <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(session('success')); ?>");
    <?php endif; ?>

    // Show error message using Toastr
    <?php if(Session::has('error')): ?>
        toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>

    // Display validation errors using Toastr
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error("<?php echo e($error); ?>");
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>

<?php echo $__env->yieldPushContent('script'); ?>
<?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/layouts/include/script.blade.php ENDPATH**/ ?>