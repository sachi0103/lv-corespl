<script>
    <?php if(session()->has('success')): ?>
        var notify = $.notify("<?php echo e(session('success')); ?>", {
            type: 'success',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: false,
            timer: 300,
            animate:{
                enter:'animated fadeInDown',
                exit:'animated fadeOutUp'
            }
        });
    <?php endif; ?>

    <?php if(session()->has('info')): ?>
        var notify = $.notify("<?php echo e(session('info')); ?>", {
            type: 'info',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: false,
            timer: 300,
            animate:{
                enter:'animated fadeInDown',
                exit:'animated fadeOutUp'
            }
        });
    <?php endif; ?>

    <?php if(session()->has('primary')): ?>
        var notify = $.notify("<?php echo e(session('primary')); ?>", {
            type: 'primary',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: false,
            timer: 300,
            animate:{
                enter:'animated fadeInDown',
                exit:'animated fadeOutUp'
            }
        });
    <?php endif; ?>

    <?php if(session()->has('warning')): ?>
        var notify = $.notify("<?php echo e(session('warning')); ?>", {
            type: 'warning',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: false,
            timer: 300,
            animate:{
                enter:'animated fadeInDown',
                exit:'animated fadeOutUp'
            }
        });
    <?php endif; ?>

    <?php if(session()->has('danger')): ?>
        var notify = $.notify("<?php echo e(session('danger')); ?>", {
            type: 'danger',
            allow_dismiss: true,
            delay: 2000,
            showProgressbar: false,
            timer: 300,
            animate:{
                enter:'animated fadeInDown',
                exit:'animated fadeOutUp'
            }
        });
    <?php endif; ?>
</script>
<?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/backend/partials/notify.blade.php ENDPATH**/ ?>