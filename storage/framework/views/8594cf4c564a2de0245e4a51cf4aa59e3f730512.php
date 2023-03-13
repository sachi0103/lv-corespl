
<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>View Users</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Manage Users</li>
<li class="breadcrumb-item">View Users</li>
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
                            <h5>Users Information</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        
                                        <th scope="col">Given Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Will Share</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $packageUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $packageUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <th scope="row"><?php echo e($key+1); ?></th>
                                        
                                        <td><?php echo e($packageUser->package_user_id); ?></td>
                                        <td><?php echo e($packageUser->name); ?></td>
                                        <td><?php echo e($packageUser->email); ?></td>
                                        <td><?php echo e($packageUser->willshare == 1 ? 'true' : 'false'); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/backend/packageUser/index.blade.php ENDPATH**/ ?>