

<?php $__env->startSection('title', 'Dashboard'); ?>



<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">

<?php $__env->stopSection(); ?>



<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-title'); ?>

<h3>View Accounts</h3>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">Manage Accounts</li>

<li class="breadcrumb-item">View Accounts</li>

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

                            <h5>Accounts Information</h5>

                        </div>

                        <div class="table-responsive">

                            <table class="table">

                                <thead>

                                    <tr>

                                        <th scope="col">#</th>

                                        <th scope="col">User Name</th>

                                        <th scope="col">User Email</th>

                                        <th scope="col">Purchase Date</th>

                                        <td scope="col">Plan Purchased</td>

                                        <th scope="col">Remaining Minutes</th>

                                        <th scope="col">Expiry Date</th>

                                        <th scope="col">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                    <tr>

                                        <th scope="row"><?php echo e($key+1); ?></th>

                                        <td><?php echo e($account->name); ?></td>

                                        <td><?php echo e($account->email); ?></td>

                                        <td><?php echo e($account->purchase_date); ?></td>

                                        <td><?php echo e($account->package_name); ?></td>

                                        <td><?php echo e($account->remaining_minutes); ?></td>

                                        <td> <?php echo e(( in_array($account->package_id,[7,8]) ) ? date("Y-m-d",strtotime("+1 month", strtotime($account->purchase_date) ) ) : ''); ?></td>

                                        <td> 
                                            
                                            <a href="<?php echo e(route('admin.accounts.renew_plan', base64_encode($account->customer_packages_id))); ?>" class="btn-sm btn-info">Renew</a>

                                            <?php if($account->remaining_minutes <= $changePlanLimit ) { ?>    
                                                <a href="<?php echo e(route('admin.accounts.add_minutes', base64_encode($account->customer_id))); ?>" class="btn-sm btn-info">Change Plan</a> 
                                            <?php } ?>
                                        </td>

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


<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\jayoffice\lv-corespl\jsdgdshfewiqruqwrujdfhsxzmv\resources\views/backend/accounts/index.blade.php ENDPATH**/ ?>