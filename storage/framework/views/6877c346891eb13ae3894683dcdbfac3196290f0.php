<?php $__env->startSection('title', 'Dashboard'); ?>



<?php $__env->startSection('css'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/css/vendors/animate.css')); ?>">
<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
<?php $__env->stopSection(); ?>



<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-title'); ?>

<h3>Manage Accounts</h3>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('breadcrumb-items'); ?>

<li class="breadcrumb-item">Manage Accounts</li>

<li class="breadcrumb-item">Add Account</li>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>



<div class="container-fluid">

    <div class="card">

       <div class="card-header">

          <h5>Billing Details</h5>

          <?php if($errors->any()): ?>

                <div class="alert alert-danger">

                    <ul>

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>

                </div>

          <?php endif; ?>

       </div>

       <form action="<?php echo e(route('admin.accounts.save_minutes')); ?>" method="post" id="myform">

        <?php echo csrf_field(); ?>

       <div class="card-body">
            <input type="hidden" name="customer_id" value=<?php echo e($customer_id); ?> />
          <div class="row">

             <div class="col-lg-7 col-sm-12">

                 <h6>Account Information</h6>

                   <div class="row">

                    <div class="form-group col-md-12">

                        <label for="exampleFormControlSelect9">Which country will you be calling?</label>

                        <select class="form-control digits" name="country_id" id="exampleFormControlSelect9">

                            <?php $__empty_1 = true; $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <option value="<?php echo e($country->ID); ?>"><?php echo e($country->Name); ?></option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>

                        </select>

                    </div>

                   </div>

                   <hr class="mt-4 mb-4">

                   <h6 class="mb-2">Packages</h6>

                   <div class="form-group mb-0 row">

                        <div class="col-md-12">

                            <div class="height-equal">

                                <div class="row" id="packageList">

                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php if(strtolower($countries[0]->Name) == strtolower($package->call_country)): ?>

                                    <div class="col-sm-6">

                                        <div class="card">

                                            <div class="media p-20">

                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <h6 class="mt-0 mega-title-badge"><?php echo e($package->package_name); ?> 
                                                                <br>  <span class="badge badge-secondary pull-right digits mt-1" style="float: left;">USD <?php echo e($package->price); ?> </span>
                                                            </h6>
                                                            <br>
                                                            <p class="mt-1">Package Type: <?php echo e($package->package_type); ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label><b>Qty:</b></label>
                                                            <input type="hidden" name="package_id[]" value="<?php echo e($package->package_id); ?>" />
                                                            <input style="width:45px;border: solid #000 1px;"  min="0" id="number23<?php echo e($key); ?>" class="package-number packageInput" onchange="changePrice('number23<?php echo e($key); ?>');" type="number" name="package_qty[]" value="0" data-a="<?php echo e($key); ?>" data-price="<?php echo e($package->price); ?>" data-name="<?php echo e($package->package_name); ?>" data-id="<?php echo e($package->package_id); ?>" max="20">
                                                        </div>
                                                    </div>                                                    
                                                    
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                            </div>

                        </div>

                    </div>

             </div>

             <div class="col-lg-5 col-sm-12">

                <div class="checkout-details" style="background-color: #f9f9f9; border: 1px solid #dddddd; padding: 40px;">

                   <div class="order-box">

                      <ul class="qty">

                         <li>Package Cost:<span class="package-cost">$0</span></li>

                         <li>User Cost:<span class="user-cost">$0</span></li>

                      </ul>

                      <ul class="qty">

                         <li>Subtotal: <span class="subtotal">$0</span></li>

                         <li>Taxes: <span class="taxes">$0</span></li>

                         <li>Delivery: <span class="dilevery">$0</span></li>



                      </ul>

                      <ul class="sub-total total">

                         <li>Total <span id="total-cost" class="count">$0</span></li>

                      </ul>

                      <div class="animate-chk">

                         <div class="row">

                            <div class="col">

                                <input class="form-check-input" id="gridCheck" name="concent" type="checkbox">

                                <label class="form-check-label" name="consent" for="gridCheck" required>Use the payment method on file</label>

                            </div>

                         </div>

                      </div>

                   </div>

                </div>

             </div>
          </div>

       </div>

       <div class="card-footer">

        <button class="btn btn-secondary">Next</button>

    </div>

    </form>

    </div>

 </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('backend/js/dashboard/default.js')); ?>"></script>
<script>
var packagePrice = parseFloat(0);
var userCost = parseFloat(0);
var userNumber = parseInt(0);
var subtotal = parseFloat(0);
var taxes = parseFloat(0);
var dilevery = parseFloat(0);
var selectPackageArr = [];
var PackageList = <?php echo  (count($packages) > 0) ? json_encode($packages) : ''; ?>;
var countries = <?php echo  (count($countries) > 0) ? json_encode($countries) : ''; ?>;
var perUserCost = parseFloat(countries[0]['user_cost']);
$('#exampleFormControlSelect9').on('change',function(){
    let country = ($('#exampleFormControlSelect9 option:selected').text()).toLowerCase();
    let selCountry = countries.filter( function (val,ind) {
            return (val['ID'] == $('#exampleFormControlSelect9 option:selected').val());
    });
    if(selCountry[0] != undefined) {
        perUserCost = parseFloat(selCountry[0]['user_cost']);
    }

    let filterPackage = PackageList.filter( function(value,index) {
        return (country == (value['call_country']).toLowerCase())
        //console.log(value['call_country']);
    } );

    let packageList = '';
    $.each(filterPackage,function(index,value){
        let idVal = 'number23'+index;
        packageList += '<div class="col-sm-6">'+
                            '<div class="card">'+
                                '<div class="media p-20">'+
                                    '<div class="media-body">'+
                                        '<div class="row">'+
                                            '<div class="col-md-8">'+
                                                '<h6 class="mt-0 mega-title-badge">'+value['package_name'] +
                                                    '<br>  <span class="badge badge-secondary pull-right digits mt-1" style="float: left;">USD '+value['price']+' </span>'+
                                                '</h6>'+
                                                '<br>'+
                                                '<p class="mt-1">Package Type: '+value['package_type']+'</p>'+
                                            '</div>'+
                                            '<div class="col-md-4">'+
                                                '<label><b>Qty:</b></label>'+
                                                '<input type="hidden" name="package_id[]" value="'+value['package_id']+'" />'+
                                                '<input style="width:45px;border: solid #000 1px;"  min="0" id="number23'+index+'" class="package-number packageInput" type="number" onchange="changePrice(\''+idVal+'\');" name="package_qty[]" value="0" data-a="'+index+'" data-price="'+value['price']+'" data-name="'+value['package_name']+'" data-id="'+value['package_id']+'" max="20">'+
                                            '</div>'+
                                        '</div>'+                                              
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
    });

    $('#packageList').html(packageList);
    changePrice();
});

$(".package-number").bind('keyup mouseup', function () {
    changePrice($(this).attr('id'));           
});
function changePrice(id = '') {
    packagePrice = parseFloat(0);
    let pid = 0;
    selectPackageArr = [];
    let noEmp = parseInt(0);
    $(".package-number").each(function(index,value){
        let tempNumber = parseInt($(value).val()); 
        let tempPrice = $(value).data("price");
        packagePrice = parseFloat(packagePrice) + (parseFloat(tempPrice) * parseInt(tempNumber))

        if (tempNumber > 0)
        {
            if(jQuery.inArray(parseInt($(value).data("id")), [7,8] ) != -1) {
                pid = $(value).data("id");
                selectPackageArr.push({'package_id':$(value).data("id"),'name':$(value).data("name")});
            } else{

                for (let index = 0; index < tempNumber; index++) {
                    selectPackageArr.push({'package_id':$(value).data("id"),'name':$(value).data("name")});
                }
            }       
            
            noEmp += tempNumber;
        }
    });   
    
    if(jQuery.inArray(parseInt(pid), [7,8] ) !== -1) {
        $('#user-number').removeAttr('max');
    } else {
        $('#user-number').prop('max',noEmp);
    }
        $('#user-number').prop('min',noEmp);
    $('#user-number').val(noEmp);
    userNumber = noEmp;
    $(".package-cost").text('$ ' + packagePrice);
        changeUserCost();
}
function changeUserCost(){
    let UnlimitedShareCount = parseInt(0);
    $('.packageSelect').each(function(ind,value){
        let id = $(value).attr('id');
        let selValue = $('#'+id+' option:selected').val();

        if(jQuery.inArray( parseInt(selValue), [7,8] ) !== -1) {
            UnlimitedShareCount+= 1;
        }        
    });

    userCost = (UnlimitedShareCount > 1) ? perUserCost * (UnlimitedShareCount - 1) : 0;
    $(".user-cost").text('$ ' + userCost );
    changeSubtotalPrice();
}
function changeSubtotalPrice(){
    subtotal = parseFloat( packagePrice + userCost );
    $(".subtotal").text('$ ' + subtotal);
    changeTotalPrice();
}
function changeTotalPrice(){
    let total = parseFloat(subtotal + taxes + dilevery);
    $("#total-cost").text('$' + total);
}
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.dashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/backend/accounts/add_minutes.blade.php ENDPATH**/ ?>