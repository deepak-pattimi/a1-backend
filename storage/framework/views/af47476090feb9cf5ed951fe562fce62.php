<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Edit Category</h2>

        <form method="POST" action="<?php echo e(route('category.update', $item->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" value="<?php echo e($item->name); ?>" />
    </div>
</div>


            <div class="form-group row">
<div class="col-sm-10 offset-sm-2">
<button type="submit" class="btn btn-success">Submit</button>

            </div></div>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/category/edit.blade.php ENDPATH**/ ?>