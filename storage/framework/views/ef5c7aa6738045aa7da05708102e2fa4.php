<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
             
                <button class="nav-link" title="clear cache">
                    <a  href="<?php echo e(url('admin/clear-cache')); ?>">
                    <i class="ik ik-battery-charging"></i> 
                </a>
                </button> &nbsp;&nbsp;
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo e(url('admin/profile')); ?>"><i class="ik ik-user dropdown-icon"></i> <?php echo e(__('Profile')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(url('admin/logout')); ?>">
                            <i class="ik ik-power dropdown-icon"></i> 
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>


<?php if (isset($component)) { $__componentOriginal9c8e73815168efeea949b2b9f7bded26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c8e73815168efeea949b2b9f7bded26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sweet-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c8e73815168efeea949b2b9f7bded26)): ?>
<?php $attributes = $__attributesOriginal9c8e73815168efeea949b2b9f7bded26; ?>
<?php unset($__attributesOriginal9c8e73815168efeea949b2b9f7bded26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c8e73815168efeea949b2b9f7bded26)): ?>
<?php $component = $__componentOriginal9c8e73815168efeea949b2b9f7bded26; ?>
<?php unset($__componentOriginal9c8e73815168efeea949b2b9f7bded26); ?>
<?php endif; ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/layouts/include/header.blade.php ENDPATH**/ ?>