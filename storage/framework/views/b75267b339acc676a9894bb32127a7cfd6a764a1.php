

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/datatables.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-title'); ?>

<h3>Manage Users</h3>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">Manage Users</li>

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

                        <div class="row">
                            
                            <div class="col-sm-8"><h5>User Information</h5></div>

                            <div class="col-sm-4">
                                <div class="pull-right"> 
                                    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">Create New</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" id="account-table">

                            <thead>

                                <tr>

                                    <th scope="col">#</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Email</th>

                                    <th scope="col">Phone</th>

                                    <th scope="col">Address</th>

                                    <th scope="col">Action</th>

                                </tr>

                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <th scope="row"><?php echo e($key+1); ?></th>

                                        <td><?php echo e($account->name); ?></td>

                                        <td><?php echo e($account->email); ?></td>

                                        <td><?php echo e($account->phone); ?></td>

                                        <td><?php echo e($account->user_address); ?></td>

                                        <td></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr align="center"><td colspan="6">No data found </td></tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>

                    </div>

                </div>

            </div>

        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('backend/js/dashboard/default.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/datatable/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript">
  $(function () {
    var table = $('#account-table').DataTable();
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\jayoffice\lv-corespl\jsdgdshfewiqruqwrujdfhsxzmv\resources\views/backend/users/index.blade.php ENDPATH**/ ?>