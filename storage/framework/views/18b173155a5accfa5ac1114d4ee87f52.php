<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['formId', 'confirmButtonText' => 'Yes, delete it!']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['formId', 'confirmButtonText' => 'Yes, delete it!']); ?>
<?php foreach (array_filter((['formId', 'confirmButtonText' => 'Yes, delete it!']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<script>
    function confirmDelete(formId) {
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: <?php echo json_encode($confirmButtonText, 15, 512) ?>,
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            },
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
<?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/components/sweet-alert.blade.php ENDPATH**/ ?>