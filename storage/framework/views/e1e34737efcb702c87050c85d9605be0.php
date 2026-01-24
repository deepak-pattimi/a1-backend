<?php $__env->startSection('title', 'Roles'); ?>
<?php $__env->startSection('content'); ?>
    <!-- push external head elements to head -->
    <?php $__env->startPush('head'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('plugins/DataTables/datatables.min.css')); ?>">
    <?php $__env->stopPush(); ?>


    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5><?php echo e(__('Roles')); ?></h5>
                            <span><?php echo e(__('Define roles of user')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#"><?php echo e(__('Roles')); ?></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
	        <!-- start message area-->
            <?php echo $__env->make('layouts.include.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- end message area-->
            <!-- only those have manage_role permission will get access -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_role')): ?>
			<div class="col-md-12">
	            <div class="card">
	                <div class="card-header"><h3><?php echo e(__('Add Role')); ?></h3></div>
	                <div class="card-body">
	                    <form class="forms-sample" method="POST" action="<?php echo e(url('admin/role/create')); ?>">
	                    	<?php echo csrf_field(); ?>
	                        <div class="row">
	                            <div class="col-sm-5">
	                                <div class="form-group">
	                                    <label for="role"><?php echo e(__('Role')); ?><span class="text-red">*</span></label>
	                                    <input type="text" class="form-control is-valid" id="role" name="name" placeholder="Role Name" required>
	                                </div>
	                            </div>
	                            <div class="col-sm-7">
	                                <label for="exampleInputEmail3"><?php echo e(__('Assign Permission')); ?> </label>
	                                <div class="row">
	                                	<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                	<div class="col-sm-4">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="permissions[]" value="<?php echo e($key); ?>">
                                                <span class="custom-control-label">
                                                	<!-- clean unescaped data is to avoid potential XSS risk -->
                                                	<?php echo e(clean($permission,'titles')); ?>

                                                </span>
                                            </label>

	                                	</div>
	                                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                </div>

	                                <div class="form-group">
	                                	<button type="submit" class="btn btn-primary btn-rounded"><?php echo e(__('Save')); ?></button>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
            <?php endif; ?>
		</div>
		<div class="row">
	        <div class="col-md-12">
	            <div class="card p-3">
	                <div class="card-header"><h3><?php echo e(__('Roles')); ?></h3></div>
	                <div class="card-body">
	                    <table id="roles_table" class="table">
	                        <thead>
	                            <tr>
	                                <th><?php echo e(__('Role')); ?></th>
	                                <th><?php echo e(__('Permissions')); ?></th>
	                                <th><?php echo e(__('Action')); ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
    <!-- push external js -->
    <?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('plugins/DataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/select2/dist/js/select2.min.js')); ?>"></script>
    <!--server side roles table script-->
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
	<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/roles.blade.php ENDPATH**/ ?>