 <?php $__env->startSection('title', 'General Settings'); ?> <?php $__env->startSection('content'); ?>

<!-- push external head elements to head -->
<?php $__env->startPush('head'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/DataTables/datatables.min.css')); ?>" />
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<?php $__env->stopPush(); ?>

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>General Settings</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">General Settings</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div>
        <form method="post" action="<?php echo e(url('admin/general/update')); ?>"  class="row" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <!-- Header Section -->
            
            <?php if (isset($component)) { $__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-input','data' => ['name' => 'header_logo','columns' => 'col-md-3','value' => ''.e($general->header_logo).'','label' => 'Header Logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'header_logo','columns' => 'col-md-3','value' => ''.e($general->header_logo).'','label' => 'Header Logo']); ?>
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
            <?php if (isset($component)) { $__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-input','data' => ['name' => 'footer_logo','columns' => 'col-md-3','value' => ''.e($general->footer_logo).'','label' => 'Footer Logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'footer_logo','columns' => 'col-md-3','value' => ''.e($general->footer_logo).'','label' => 'Footer Logo']); ?>
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
            <?php if (isset($component)) { $__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-input','data' => ['name' => 'favicon','columns' => 'col-md-3','value' => ''.e($general->favicon).'','label' => 'Favicon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'favicon','columns' => 'col-md-3','value' => ''.e($general->favicon).'','label' => 'Favicon']); ?>
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
            
            <div class="form-group col-md-3">
                <label for="header_phone">Header Phone</label>
                <input type="number" class="form-control" id="header_phone" name="header_phone" value="<?php echo e($general->header_phone); ?>"
                    placeholder="Header Phone" />
            </div>
            <div class="form-group col-md-3">
                <label for="header_email">Header Email</label>
                <input type="email" class="form-control" id="header_email" name="header_email" value="<?php echo e($general->header_email); ?>"
                    placeholder="Header Email" />
            </div>

            <!-- Social Media Section -->
            <div class="form-group col-md-3">
                <label for="fb_link">Facebook Link</label>
                <input type="url" class="form-control" id="fb_link" name="fb_link" placeholder="Facebook Link" value="<?php echo e($general->fb_link); ?>" />
            </div>
            <div class="form-group col-md-3">
                <label for="insta_link">Instagram Link</label>
                <input type="url" class="form-control" id="insta_link" name="insta_link" placeholder="Instagram Link" value="<?php echo e($general->insta_link); ?>" />
            </div>
            <div class="form-group col-md-3">
                <label for="twitter_link">Twitter Link</label>
                <input type="url" class="form-control" id="twitter_link" name="twitter_link" value="<?php echo e($general->twitter_link); ?>"
                    placeholder="Twitter Link" />
            </div>
            <div class="form-group col-md-3">
                <label for="pintrest_link">Pinterest Link</label>
                <input type="url" class="form-control" id="pintrest_link" name="pintrest_link" value="<?php echo e($general->pintrest_link); ?>"
                    placeholder="Pinterest Link" />
            </div>
            <div class="form-group col-md-3">
                <label for="youtube_link">YouTube Link</label>
                <input type="url" class="form-control" id="youtube_link" name="youtube_link" value="<?php echo e($general->youtube_link); ?>"
                    placeholder="YouTube Link" />
            </div>
            <div class="form-group col-md-3">
                <label for="linkdin_link">LinkedIn Link</label>
                <input type="url" class="form-control" id="linkdin_link" name="linkdin_link" value="<?php echo e($general->linkdin_link); ?>"
                    placeholder="LinkedIn Link" />
            </div>

            <!-- Contact Section -->
            <div class="form-group col-md-3">
                <label for="whatsapp_no">WhatsApp Number</label>
                <input type="number" class="form-control" id="whatsapp_no" name="whatsapp_no" value="<?php echo e($general->whatsapp_no); ?>"
                    placeholder="WhatsApp Number" />
            </div>

            <!-- Footer Section -->
            
            <div class="form-group col-md-3">
                <label for="footer_email">Footer Email</label>
                <input type="email" class="form-control" id="footer_email" name="footer_email" value="<?php echo e($general->footer_email); ?>"
                    placeholder="Footer Email" />
            </div>
            <div class="form-group col-md-3">
                <label for="footer_phone">Footer Phone</label>
                <input type="number" class="form-control" id="footer_phone" name="footer_phone" value="<?php echo e($general->footer_phone); ?>"
                    placeholder="Footer Phone" />
            </div>
            <div class="form-group col-md-3">
                <label for="footer_copyright">Footer Copyright</label>
                <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" value="<?php echo e($general->footer_copyright); ?>"
                    placeholder="Footer Copyright" />
            </div>

            <!-- Website Section -->
            <div class="form-group col-md-3">
                <label for="website_name">Website Name</label>
                <input type="text" class="form-control" id="website_name" name="website_name" value="<?php echo e($general->website_name); ?>"
                    placeholder="Website Name" />
            </div>
            

            <!-- Submit Button -->
            <div class="text-center col-12 mt-2">
                <button type="submit" class="btn btn-primary btn-lg">Update Settings</button>
            </div>
        </form>

    </div>
</div>


<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/settings/index.blade.php ENDPATH**/ ?>