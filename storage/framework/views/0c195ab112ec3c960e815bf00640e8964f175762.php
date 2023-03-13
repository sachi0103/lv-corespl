<?php $__env->startSection('title', 'Dashboard'); ?>



<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>" />
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.1.6/css/dx.common.css" />
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.1.6/css/dx.light.css" />
<?php $__env->stopSection(); ?>



<?php $__env->startSection('style'); ?>
<style>
    #gridContainer {
        height: 440px;
    }

    .master-detail-caption {
        padding: 0 0 5px 10px;
        font-size: 14px;
        font-weight: bold;
    }
</style>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-title'); ?>

<h3>View Payments</h3>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">Manage Payments</li>

<li class="breadcrumb-item">View Payments</li>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>

                <div class="alert alert-danger">

                    <ul>

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

          <?php endif; ?>



          <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-header">

                            <h5>Payments Information</h5>

                        </div>

                        <div class="card-body">
                                <div id="payment-table"></div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('backend/js/dashboard/default.js')); ?>"></script>
<script src="https://cdn3.devexpress.com/jslib/22.1.6/js/dx.all.js"></script>
<script type="text/javascript">
$(function () {
    var payment = <?php echo (!empty($payments)) ? json_encode($payments) : '[]'; ?>;
    $('#payment-table').dxDataGrid({
        dataSource: payment,
        keyExpr: 'id',
        showBorders: true,
        paging: {
            pageSize: 15,
        },
        filterRow: {
            visible: false,
            applyFilter: 'auto',
        },
        searchPanel: {
            visible: true,
            width: 240,
            placeholder: 'Search...',
        },
        headerFilter: {
            visible: true,
        },
        columns: [
            {
                dataField: 'number_of_users',
                caption: 'Number of User',
            },
            {
                dataField: 'subtotal',
                caption: 'Subtotal',
            },
            {
                dataField: 'charge_per_user',
                caption: 'User Cost',
            },
            {
                dataField: 'total',
                caption: 'Total',
            },
            {
                dataField: 'created_at',
                caption: 'Created',
                dataType: 'date',
            },
        ],
        masterDetail: {
            enabled: true,
            template(container, options) {
                const currentUserData = options.data.payment_users;
                $('<div>')
                .addClass('master-detail-caption')
                .text(`User Details: `)
                .appendTo(container);

                $('<div>')
                .dxDataGrid({
                    columnAutoWidth: true,
                    showBorders: true,
                    dataSource: currentUserData,
                    keyExpr: 'id',
                    columns: [
                        {
                            dataField: 'id',
                            caption: 'Name',
                            calculateCellValue: function (colData) {
                                return colData.user.name;
                            }
                        },
                        {
                            dataField: 'payment_id',
                            caption: 'Email',
                            calculateCellValue: function (colData) {
                                return colData.user.email;
                            }
                        },            
                        {
                            dataField: 'package_id',
                            caption: 'Package',
                            calculateCellValue: function (rowData) {
                                return (rowData.package != null ) ? rowData.package.package_name : '';
                            }
                        },           
                        {
                            dataField: 'user_id',
                            caption: 'Price',
                            calculateCellValue: function (rowData) {
                                return (rowData.package != null ) ? rowData.package.price : '';
                            }
                        },
                    ],
                }).appendTo(container);
            },
        },
    });
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/backend/payments/index.blade.php ENDPATH**/ ?>