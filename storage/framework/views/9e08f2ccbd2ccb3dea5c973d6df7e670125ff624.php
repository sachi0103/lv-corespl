

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/datatables.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-title'); ?>

<h3>Create new user</h3>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('admin.users.index')); ?>">Manage Users</a></li>
<li class="breadcrumb-item">Create New User</li>

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
                            
                            <div class="col-sm-8"><h5>Create New User</h5></div>
                            <div class="col-sm-4">
                                <button type='button' id="AddBtn" class="btn-info btn-md" onclick="addRow();"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo e(route('admin.accounts.store')); ?>" method="post" id="myform">
                            <?php echo csrf_field(); ?>
                            <div class="mt-2 mb-4  append-list user-section">

                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('backend/js/dashboard/default.js')); ?>"></script>
<script>
var PackageList = <?php echo  (count($packages) > 0) ? json_encode($packages) : ''; ?>;
var addId = 0;
function addRow() {
    let selectOption = '<option value="">select Package</option>';
    $.each(PackageList,function(index,value){
        selectOption += '<option value="'+value['package_id']+'" data-index="'+index+'">'+value['package_name']+'</option>';
    });

    let htmlDiv = "<div class='form-group row' id='remove"+addId+"'><div class='col-md-3'><label class='col-form-label'>Name</label><input class='form-control' id='' type='text' name='user_name[]' placeholder='Enter name' required></div><div class='col-md-3'><label class='col-form-label'>Email</label><input class='form-control' id='user_email"+addId+"' type='email' required name='user_email[]' placeholder='Enter email' onblur='CheckUniqueEmail(this.value,"+addId+");'></div><div class='col-md-4'><label class='col-form-label'>Select Package</label><input type='hidden' name='user_package[]' id='user"+addId+"' /><select class='form-control packageSelect' name='user_share[]' id='exampleFormControlSelect"+addId+"' required data-main='"+addId+"' onchange='changeOtion(this);' onfocus='oldValueDeSelect(this);'>"+selectOption+"</select></div><div class='col-md-2'><button type='button' style='margin-top: 25%;' class='btn-danger btn-md' onclick='removeRow("+addId+");'><i class='fa fa-close'></i></button></div></div>";

    addId++;
    $('.append-list').append(htmlDiv);

}

function removeRow(ids)
{
    $('#remove'+ids).remove();
}

function oldValueDeSelect(obj)
{
    let selOptionId = $(obj).attr('id');
    let selOptionIndex = $('#'+selOptionId+' option:selected').data('index');
    let index = $(obj).data('main');
    $('.packageSelect').each(function(ind,value){
        $('.packageSelect option[data-index="'+index+'"]').attr('disabled',false);
    });
}

function CheckUniqueEmail(email,id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: '/call-recall/ajaxUniqueEmail',
        dataType: 'json',
        data: {email: email},
        success:function(data){
            if(data.status){
                alert('This email is already used. Please enter unique email address');
                $('#user_email'+id).val('');
            }
        }
    })
}
$(document).ready(function () {
    addRow();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\jayoffice\lv-corespl\jsdgdshfewiqruqwrujdfhsxzmv\resources\views/backend/users/create.blade.php ENDPATH**/ ?>