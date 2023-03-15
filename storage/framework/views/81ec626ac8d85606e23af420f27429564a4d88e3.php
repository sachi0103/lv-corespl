

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">
<meta name="_token" content="<?php echo e(csrf_token()); ?>" />

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
                
                <form action="<?php echo e(route('admin.users.store')); ?>" method="post" id="myform">
                <?php echo csrf_field(); ?>
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
                            <div class="mt-2 mb-4  append-list user-section">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-secondary">Next</button>
                        </div>
                    </div>
                
                </form>

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
    let mainIndex = parseInt(0);
    $.each(PackageList,function(index,value){
        let pCnt = parseInt(value['number_of_packages']) - parseInt(value['usedCnt']);
        if(pCnt > 0)
        {
            for (let index = 1; index <= pCnt; index++) {
                selectOption += '<option value="'+value['package_id']+'" data-index="'+mainIndex+'">'+value['package_name']+'</option>';
                mainIndex++;
            }
        }
    });
    selectOption+= '<option value="-1">User you own SIP Account</option>';

    let htmlDiv = "<div class='form-group row remove"+addId+"'><div class='col-md-3'><label class='col-form-label'>Name</label><input class='form-control' id='' type='text' name='user_name[]' placeholder='Enter name' required></div><div class='col-md-3'><label class='col-form-label'>Email</label><input class='form-control' id='user_email"+addId+"' type='email' required name='user_email[]' placeholder='Enter email' onblur='CheckUniqueEmail(this.value,"+addId+");'></div><div class='col-md-4'><label class='col-form-label'>Select Package</label><input type='hidden' name='user_package[]' id='user"+addId+"' /><select class='form-control packageSelect' name='user_share[]' id='exampleFormControlSelect"+addId+"' required data-main='"+addId+"' onchange='changeOtion(this);' onfocus='oldValueDeSelect(this);'>"+selectOption+"</select></div><div class='col-md-2'><button type='button' style='margin-top: 25%;' class='btn-danger btn-md' onclick='removeRow("+addId+");'><i class='fa fa-close'></i></button></div></div><div class='form-group row remove"+addId+"' id='spiDiv"+addId+"' style='display:none;'><div class='col-md-2'><label class='col-form-label'>User Id</label><input class='form-control' id='user_id"+addId+"' type='text' name='user_id[]' placeholder='Enter User Id'></div><div class='col-md-2'><label class='col-form-label'>Password</label><input class='form-control' id='password"+addId+"' type='text' name='password[]' placeholder='Enter Password'></div><div class='col-md-2'><label class='col-form-label'>Host</label><input class='form-control' id=''host"+addId+" type='text' name='Host[]' placeholder='Enter Host'></div><div class='col-md-2'><label class='col-form-label'>Port</label><input class='form-control' id='port"+addId+"' type='text' name='Port[]' placeholder='Enter Port'></div><div class='col-md-2'><label class='col-form-label'>Protocol</label><div><input type='radio' id='TCP"+addId+"' name='protocol[]' value='TCP' /><label for='TCP' style='margin-right: 10px;'>TCP</label><input type='radio' id='UDP"+addId+"' name='protocol[]' value='phone' /><label for='UDP' style='margin-right: 10px;'>UDP</label><input type='radio' id='TLS"+addId+"' name='protocol[]' value='TLS' /><label for='TLS' style='margin-right: 10px;'>TLS</label></div></div></div></div>";

    addId++;
    $('.append-list').append(htmlDiv);

}

function removeRow(ids)
{
    $('.remove'+ids).remove();
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

function changeOtion(obj) {
    let isSelected = true;
    let selOptionId = $(obj).attr('id');
    let selOptionIndex = $('#'+selOptionId+' option:selected').data('index');
    let index = $(obj).data('main');
    $('#user'+index).val($('#'+selOptionId+' option:selected').val());
    if(selOptionIndex == undefined){
        isSelected = false;
        $($('#'+selOptionId).find('option')).each(function(index,value){
            if($(value).is(':disabled')){
                selOptionIndex = $(value).data('index');
            }
        });
    }
    $('.packageSelect').each(function(ind,value){
        UnlimitedShareCount = parseInt(1);
        let id = $(value).attr('id');
        let selIndex = $('#'+id+' option:selected').data('index');
        let selValue = $('#'+id+' option:selected').val();
        if(selIndex != undefined) {
            if(jQuery.inArray( parseInt(selValue), [7,8] ) === -1) {
                $('.packageSelect option[data-index="'+selIndex+'"]').attr('disabled',true);
            }
        }

        if(jQuery.inArray( parseInt(selValue), [7,8] ) !== -1) {
            UnlimitedShareCount+= 1;
        }
        
        if(!isSelected)
            $('.packageSelect option[data-index="'+selOptionIndex+'"]').attr('disabled',false);
        
    });
    
    if(parseInt($('#'+selOptionId+' option:selected').val()) === -1) {
        $('#spiDiv'+index).show();
    } else {
        $('#spiDiv'+index).hide();
    }
}

$(document).ready(function () {
    addRow();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp\www\jayoffice\lv-corespl\resources\views/backend/users/create.blade.php ENDPATH**/ ?>