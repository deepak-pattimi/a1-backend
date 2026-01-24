<?php $__env->startSection('title', 'Pages'); ?>

<!-- push external head elements to head -->
<?php $__env->startPush('head'); ?>
<link rel="stylesheet" href="<?php echo e(asset('plugins/DataTables/datatables.min.css')); ?>">

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>



<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h5>Pages List</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(url('/')); ?>"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Pages List</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary mb-3" href="javascript:void(0)" id="createNewPage"> Create new page &nbsp; <i class="fa fa-plus"></i></a>
            <div class="card p-3">
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <!-- Dynamic DataTable from jquery -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="pageForm" name="pageForm" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="item_id" id="item_id">
                    <div class="form-group">
                        <label for="category_id" class="col-sm-6 control-label">Category</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Select Category</option>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="page_name" class="col-sm-6 control-label">Page Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter Page Name" required="true">
                        </div>
                    </div>

                        <div class="form-group ">
                            <label  class="col-sm-6 control-label">Content (EN)</label>
                            <div class="col-sm-12">
                            <?php if (isset($component)) { $__componentOriginal2b7249cba85d390ab10fb9faa1bb3da2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b7249cba85d390ab10fb9faa1bb3da2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ckeditor','data' => ['id' => 'content','name' => 'content','value' => null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('ckeditor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'content','name' => 'content','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(null)]); ?>
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



                        <div class="form-group ">
                        <label for="meta_title" class="col-sm-6 control-label">Meta Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                     required="true">
                            </div>
                        </div>



                        <div class="form-group ">
                        <label for="meta_description" class="col-sm-6 control-label">Meta Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3" required="true"></textarea>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="meta_keywords" class="col-sm-6 control-label">Meta Keywords</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                     required="true">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="meta_author" class="col-sm-6 control-label">Meta Author</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meta_author" name="meta_author"
                                   required="true">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="meta_robots" class="col-sm-6 control-label">Meta Robots</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="meta_robots" value="index,follow" name="meta_robots"
                                     required="true">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="og_title" class="col-sm-6 control-label">OG Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="og_title" name="og_title"  required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="og_description" class="col-sm-6 control-label">OG Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="og_description" name="og_description"  required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="og_image" class="col-sm-6 control-label">OG Image URL</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="og_image" name="og_image"  required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="og_url" class="col-sm-6 control-label">OG URL</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="og_url" name="og_url"  required="true">
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="og_type" class="col-sm-6 control-label">OG Type</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="og_type" name="og_type"  required="true">
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="twitter_title" class="col-sm-6 control-label">Twitter Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="twitter_title" name="twitter_title" required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="twitter_description" class="col-sm-6 control-label">Twitter Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="twitter_description" name="twitter_description"  required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="twitter_image" class="col-sm-6 control-label">Twitter Image</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="twitter_image" name="twitter_image"  required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="twitter_card" class="col-sm-6 control-label">Twitter Card</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="twitter_card" name="twitter_card"  required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="canonical" class="col-sm-6 control-label">Canonical</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="canonical" name="canonical" required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="og_local" class="col-sm-6 control-label">OG Local</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="og_local" name="og_local" required="true">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script type="text/javascript">

    /* ===============================
       Notification Helper
    =============================== */
    function showNotification(title, message, type = 'success') {
        toastr[type](message, title);
    }

    $(function () {

        /* ===============================
           CSRF Token
        =============================== */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* ===============================
           DataTable
        =============================== */
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('pages.index')); ?>",
            columns: [
                { data: 'id', name: 'id', title: 'ID' },
                { data: 'page_name', name: 'page_name', title: 'Page Name' },
                { data: 'category.name', name: 'category.name', title: 'Category' },
                { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Action' },
            ]
        });

        /* ===============================
           Create Page
        =============================== */
        $('#createNewPage').click(function () {
            $('#pageForm')[0].reset();
            $('#item_id').val('');
            $('#formErrors').addClass('d-none').html('');
            $('#modelHeading').html("Create New Page");
            $('#ajaxModel').modal('show');

            if (CKEDITOR.instances['content']) {
                CKEDITOR.instances['content'].setData('');
            }
        });

        /* ===============================
           Edit Page
        =============================== */
        $('body').on('click', '.editProduct', function () {
            let item_id = $(this).data('id');

            $.get("<?php echo e(route('pages.index')); ?>/" + item_id + "/edit", function (data) {
                $('#modelHeading').html("Edit Page");
                $('#ajaxModel').modal('show');
                $('#formErrors').addClass('d-none').html('');

                $('#item_id').val(data.id);
                $('#page_name').val(data.page_name);
                $('#category_id').val(data.category_id);

                if (CKEDITOR.instances['content']) {
                    CKEDITOR.instances['content'].setData(data.content ?? '');
                }

                $('#meta_title').val(data.meta_title);
                $('#meta_description').val(data.meta_description);
                $('#meta_keywords').val(data.meta_keywords);
                $('#meta_author').val(data.meta_author);
                $('#meta_robots').val(data.meta_robots);
                $('#og_title').val(data.og_title);
                $('#og_description').val(data.og_description);
                $('#og_image').val(data.og_image);
                $('#og_url').val(data.og_url);
                $('#og_type').val(data.og_type);
                $('#twitter_title').val(data.twitter_title);
                $('#twitter_description').val(data.twitter_description);
                $('#twitter_image').val(data.twitter_image);
                $('#twitter_card').val(data.twitter_card);
                $('#canonical').val(data.canonical);
                $('#og_local').val(data.og_local);
            });
        });

        /* ===============================
           Save Page
        =============================== */
        $('#saveBtn').click(function (e) {
            e.preventDefault();

            // ✅ Sync CKEditor
            if (CKEDITOR.instances['content']) {
                CKEDITOR.instances['content'].updateElement();
            }

            $('#saveBtn').html('Sending...');

            $.ajax({
                url: "<?php echo e(route('pages.store')); ?>",
                type: "POST",
                data: $('#pageForm').serialize(),
                dataType: 'json',

                success: function (data) {
                    $('#ajaxModel').modal('hide');
                    $('#pageForm')[0].reset();
                    table.draw();

                    showNotification('Success', data.success, 'success');
                    $('#saveBtn').html('Save');
                },

                error: function (xhr) {
                    $('#saveBtn').html('Save');

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul>';
                        let firstError = '';

                        $.each(errors, function (key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                            if (!firstError) firstError = value[0];
                        });

                        errorHtml += '</ul>';

                        $('#formErrors')
                            .removeClass('d-none')
                            .html(errorHtml);

                        // ✅ Toastr uses "error" NOT "danger"
                        showNotification('Validation Error', firstError, 'error');
                    } else {
                        showNotification('Error', 'Something went wrong!', 'error');
                    }
                }
            });
        });

        /* ===============================
           Delete Page
        =============================== */
        $('body').on('click', '.deleteProduct', function () {
            let item_id = $(this).data("id");

            if (!confirm("Are you sure you want to delete?")) return;

            $.ajax({
                type: "DELETE",
                url: "<?php echo e(route('pages.store')); ?>/" + item_id,
                success: function (data) {
                    table.draw();
                    showNotification('Success', data.success, 'success');
                },
                error: function () {
                    showNotification('Error', 'Delete failed!', 'error');
                }
            });
        });

    });
</script>

<!-- push external js -->
<script src="<?php echo e(asset('plugins/DataTables/datatables.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/dynamic-pages/index.blade.php ENDPATH**/ ?>