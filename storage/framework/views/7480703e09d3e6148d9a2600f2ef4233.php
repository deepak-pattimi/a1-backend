<div <?php echo e($attributes); ?>>
    <textarea id="<?php echo e($id); ?>" name="<?php echo e($name); ?>" class="ckeditor"><?php echo e(htmlspecialchars_decode($value)); ?></textarea>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('<?php echo e($id); ?>', {
            on: {
                instanceReady: function (evt) {
                    evt.editor.setData(`<?php echo $value; ?>`);
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/u961167455/domains/srmtechsolutions.com/public_html/a1-backend/resources/views/components/ckeditor.blade.php ENDPATH**/ ?>