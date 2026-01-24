<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'value', 'label', 'columns']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'value', 'label', 'columns']); ?>
<?php foreach (array_filter((['name', 'value', 'label', 'columns']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="form-group <?php echo e($columns); ?>">
    <label for="<?php echo e($name); ?>" class="col-sm-12"><?php echo e($label); ?></label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="button" class="input-group-text admin-file-manager" onclick="singleOpenFileManager('<?php echo e($name); ?>')">
                    <i class="fa fa-chevron-up"> &nbsp;Click here to choose</i>
                </button>
            </div>
            <input type="text" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" hidden value="<?php echo e($value ? $value : old($name)); ?>" readonly class="form-control"/>
            <div class="input-group-append">
                <button type="button" class="input-group-text admin-file-view" onclick="singleViewSelectedFile('<?php echo e($name); ?>')">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="mt-2 position-relative" id="preview-<?php echo e($name); ?>">
            <?php if($value): ?>
                <img src="<?php echo e(asset($value)); ?>" alt="" onerror="this.src='/img/logo.png';" style="height:30px; margin-right: 10px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('<?php echo e($name); ?>')">X</button>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
<script>
function singleOpenFileManager(inputId) {
    console.log(inputId);

    // Ensure previous SetUrl function is removed
    window.SetUrl = undefined;

    window.open('/laravel-filemanager', 'fm', 'width=1100,height=600');

    window.SetUrl = function (items) {
        if (!items || items.length === 0) {
            console.error("No items selected");
            return;
        }

        const input = document.getElementById(inputId);
        const preview = document.getElementById('preview-' + inputId);

        let filePath = items[0].url;
        input.value = filePath;

        preview.innerHTML = `
            <div class="position-relative" style="display: inline-block;">
                <img src="${filePath}" style="height:50px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:0; right:0;" onclick="singleRemoveImage('${inputId}')">X</button>
            </div>
        `;

        console.log("Selected file URL:", filePath);
    };
}

function singleRemoveImage(inputId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById('preview-' + inputId);

    input.value = '';
    preview.innerHTML = '';
}

function singleViewSelectedFile(inputId) {
    const input = document.getElementById(inputId);
    const filePath = input.value;
    if (filePath) {
        $('#fileViewModalBody').html('<img src="' + filePath + '" style="width:100%;" />');
        $('#fileViewModal').modal('show');
    } else {
        alert('No file selected');
    }
}

</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/components/image-input.blade.php ENDPATH**/ ?>