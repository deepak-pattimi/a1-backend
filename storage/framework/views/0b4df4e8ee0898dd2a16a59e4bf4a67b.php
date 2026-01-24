<?php $__env->startSection('content'); ?>
<div class="container">

        <h2>Highlights Records</h2>

        <a href="<?php echo e(route('highlights.create')); ?>" class="btn btn-primary">Create New</a>

        <table class="table table-bordered">

        <thead>
<tr>
<th>ID</th>
<th>Title</th>
<th>Countnumber</th>
<th>Image</th>
<th>Content</th>
<th>Actions</th>
</tr>
</thead>
<tbody>

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

        <td><?php echo e($item->id); ?></td>
<td><?php echo e($item->title); ?></td>
<td><?php echo e($item->countnumber); ?></td>

                    <?php
                        // Get file extension
                        $fileExtension = pathinfo($item->image, PATHINFO_EXTENSION);
                        
                        // Determine file type
                        $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']);
                        $isVideo = in_array($fileExtension, ['mp4', 'webm', 'ogg']);
                    ?>
                
                    <?php if($isImage): ?>
                        <td><img src="<?php echo e($item->image); ?>" style="height: 50px; object-fit: cover;" /></td>
                    <?php elseif($isVideo): ?>
                        <td>
                            <video width="100" height="50" controls>
                                <source src="<?php echo e($item->image); ?>" type="video/<?php echo e($fileExtension); ?>">
                                Your browser does not support the video tag.
                            </video>
                        </td>
                    <?php else: ?>
                        <td><?php echo e($item->image); ?></td>
                    <?php endif; ?>
                <td><?php echo e($item->content); ?></td>
<td>

        <a href="<?php echo e(route('highlights.edit', $item->id)); ?>" class="btn btn-info">Edit</a>

        <button class="btn btn-danger deleteItem" data-id="<?php echo e($item->id); ?>">Delete</button>

        </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

        </div>
<?php $__env->stopSection(); ?>

        <?php $__env->startPush('script'); ?>

        <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


            $('body').on('click', '.deleteItem', function () {
                var item_id = $(this).data("id");
                swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: "<?php echo e(url('admin/highlights')); ?>" + '/' + item_id,
                            success: function (data) {
                                // Reload the table or remove the row
                                location.reload(); // Option 1: Reload page
                                // Option 2: Remove row without reload
                                // $('tr[data-id="' + item_id + '"]').remove();
                                toastr.options.timeOut = 5000;
                                toastr.success("Record has been deleted");
                            },
                            error: function (response) {
                                toastr.options.timeOut = 5000;
                                toastr.success("Record has been deleted");
                                location.reload(); 
                            }
                        });
                    }
                });
            });
        </script>

        <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/pages/highlights/index.blade.php ENDPATH**/ ?>