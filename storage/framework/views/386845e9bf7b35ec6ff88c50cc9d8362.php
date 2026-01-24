<?php $__env->startSection('title', 'Home banners slider'); ?>

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
                        <h5>Banners list</h5>
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
                            <a href="#">Banners list</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- end message area-->
        <div class="col-md-12">
            <a class="btn btn-primary mb-3" href="javascript:void(0)" id="createNewProduct"> Create new Banner &nbsp; <i class="fa fa-plus"></i></a>
            <div class="card p-3">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="table-responsive">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('banner-list', ['banners'=>$banners])->html();
} elseif ($_instance->childHasBeenRendered('LYmtRFa')) {
    $componentId = $_instance->getRenderedChildComponentId('LYmtRFa');
    $componentTag = $_instance->getRenderedChildComponentTagName('LYmtRFa');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('LYmtRFa');
} else {
    $response = \Livewire\Livewire::mount('banner-list', ['banners'=>$banners]);
    $html = $response->html();
    $_instance->logRenderedChild('LYmtRFa', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                             


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 500px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="packageForm" name="packageForm" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="item_id" id="item_id">


                        <?php if (isset($component)) { $__componentOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2920db5875f14aaabb622c4d8c2dc4a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image-input','data' => ['name' => 'image','columns' => 'col-md-12','value' => ''.e(old('image')).'','id' => 'image','label' => 'Banner image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'image','columns' => 'col-md-12','value' => ''.e(old('image')).'','id' => 'image','label' => 'Banner image']); ?>
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


                        <div class="form-group ">
                            <label for="title_en" class="col-sm-6 control-label">Banner Title (EN)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title_en" name="title_en"
                                    placeholder="Enter Title " required="true">
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="title_ar" class="col-sm-6 control-label">Banner Title (AR)</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title_ar" name="title_ar"
                                    placeholder="Enter Title " required="true">
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="link" class="col-sm-6 control-label">Banner Deep link</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="link" name="link"
                                    placeholder="example https://google.com" required="true">
                            </div>
                        </div>

                    <div class="row container">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger float-right"
                                data-dismiss="modal">close</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>


<!-- scripts -->
<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(function () {

        /*------------------------------------------
         --------------------------------------------
         Pass Header Token
         --------------------------------------------
         --------------------------------------------*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        /*------------------------------------------
        --------------------------------------------
        Click to Button
        --------------------------------------------
        --------------------------------------------*/
        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#item_id').val('');
            $('#packageForm').trigger("reset");
            $('#modelHeading').html("Add new banner");
            $('#ajaxModel').modal('show');
            $('#saveBtn').html('Save Changes');

        });

        /*------------------------------------------
        --------------------------------------------
        Click to Edit Button
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '.editProduct', function () {
            var item_id = $(this).data('id');
            $.get("<?php echo e(route('banners.index')); ?>" + '/' + item_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Banner");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#item_id').val(data.id);
                $('#title_en').val(data.title_en);
                $('#title_ar').val(data.title_ar);
                $('input[name="image"]').val(data.image);
                $('#link').val(data.link);
                $('#saveBtn').html('Save Changes');
            })
        });




        /*------------------------------------------
        --------------------------------------------
        Create Product Code
        --------------------------------------------
        --------------------------------------------*/
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            var formdata = new FormData(document.getElementById('packageForm'))

            $.ajax({
                enctype: 'multipart/form-data',
                url: "<?php echo e(route('banners.store')); ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                     $('#saveBtn').html('Save Changes');
                    $('#packageForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    toastr.options.timeOut = 5000;
                    toastr.success(data.success);
                    location.reload();
                },
                error:function (response){
                    console.log(response)
                    $.each(response.responseJSON.message,function(field_name,error){
                        toastr.error(error);
                    })
                    $('#saveBtn').html('Save Changes');

                }
            });
        });

        /*------------------------------------------
        --------------------------------------------
        Delete Product Code
        --------------------------------------------
        --------------------------------------------*/
        $('body').on('click', '#mediumButton', function () {

            let href = $(this).attr('data-attr');

            swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({    
                        type: "DELETE",
                        url: "<?php echo e(url('admin/banners')); ?>/" + href,
                        success: function (data) {
                            toastr.options.timeOut = 5000;
                            toastr.success("Record has been deleted");
                            location.reload();
                        },
                        error: function (response) {
                            $.each(response.responseJSON.message,function(field_name,error){
                                toastr.error(error);
                            })
                        }
                    });
                }
            });

        });

    });
</script>


<!-- push external js -->
<script src="<?php echo e(asset('plugins/DataTables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/banners/index.blade.php ENDPATH**/ ?>