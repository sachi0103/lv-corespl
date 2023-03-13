

<?php $__env->startSection('title', 'Dashboard'); ?>



<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/datatables.css')); ?>">

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

                            <div class="row">
                                
                                <div class="col-sm-8"><h5>Accounts Information</h5></div>

                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <a href="<?php echo e(route('admin.accounts.renew_all_plan' , base64_encode(auth()->user()->id))); ?>" class="btn btn-info">Renew All</a>
                                        <a href="<?php echo e(route('admin.accounts.create')); ?>" class="btn btn-primary">Create New</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped" id="account-table">

                                <thead>

                                    <tr>

                                        <th scope="col">#</th>

                                        <th scope="col">User Name</th>

                                        <th scope="col">User Email</th>

                                        <th scope="col">Purchase Date</th>

                                        <th scope="col">Plan Purchased</th>

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

                                        <td><?php echo e(date('Y-m-d',strtotime($account->created_at))); ?></td>

                                        <td><?php echo e($account->package_name); ?></td>

                                        <td><?php echo e($account->remaining_minutes); ?></td>

                                        <td> <?php echo e(( $account->expire_date ) ? date("Y-m-d",strtotime($account->expire_date) ) : ''); ?></td>

                                        <td> 
                                            
                                            <a href="<?php echo e(route('admin.accounts.renew_plan', base64_encode($account->customer_packages_id))); ?>" class="btn-sm btn-info">Renew</a>

                                            <?php 
                                            $allowedMinutes = ($account->allowed_minutes * ($changePlanLimit/100));
                                            if($account->remaining_minutes <= $allowedMinutes ) { ?>    
                                                <a href="<?php echo e(route('admin.accounts.add_minutes', base64_encode($account->customer_id))); ?>" class="btn-sm btn-info">Change Plan</a> 
                                            <?php } ?>
                                        </td>

                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colpsan="8">No data found </td></tr>
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


<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\jayoffice\lv-corespl\jsdgdshfewiqruqwrujdfhsxzmv\resources\views/backend/accounts/index.blade.php ENDPATH**/ ?>