<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Edit Aboutitems</h2>

        <form method="POST" action="<?php echo e(route('aboutitems.update', $item->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group row">
    <label for="image" class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-10">
        <?php if (isset($component)) { $__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-input','data' => ['name' => 'image','columns' => 'col-md-12','value' => ''.e($item->image).'','id' => 'image','label' => 'Image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','columns' => 'col-md-12','value' => ''.e($item->image).'','id' => 'image','label' => 'Image']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0)): ?>
<?php $attributes = $__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0; ?>
<?php unset($__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0)): ?>
<?php $component = $__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0; ?>
<?php unset($__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0); ?>
<?php endif; ?>
    </div>
</div>
<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
        <input type="text" name="title" id="title" class="form-control" value="<?php echo e($item->title); ?>" />
    </div>
</div>
<div class="form-group row">
    <label for="content" class="col-sm-2 col-form-label">Content</label>
    <div class="col-sm-10">
        <?php if (isset($component)) { $__componentOriginal2b7249cba85d390ab10fb9faa1bb3da2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b7249cba85d390ab10fb9faa1bb3da2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ckeditor','data' => ['name' => 'content','id' => 'content','value' => $item->content]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ckeditor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'content','id' => 'content','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->content)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b7249cba85d390ab10fb9faa1bb3da2)): ?>
<?php $attributes = $__attributesOriginal2b7249cba85d390ab10fb9faa1bb3da2; ?>
<?php unset($__attributesOriginal2b7249cba85d390ab10fb9faa1bb3da2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b7249cba85d390ab10fb9faa1bb3da2)): ?>
<?php $component = $__componentOriginal2b7249cba85d390ab10fb9faa1bb3da2; ?>
<?php unset($__componentOriginal2b7249cba85d390ab10fb9faa1bb3da2); ?>
<?php endif; ?>
    </div>
</div>


            <div class="form-group row">
<div class="col-sm-10 offset-sm-2">
<button type="submit" class="btn btn-success">Submit</button>

            </div></div>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/aboutitems/edit.blade.php ENDPATH**/ ?>