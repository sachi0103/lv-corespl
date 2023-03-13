<?php $__env->startSection('title', 'Login | High Streeting'); ?>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6Lcih4UjAAAAAHrmFs1oAm5-S0qk6HiAUmRchtgI"></script>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">

   <div class="row">
      <div class="col-xl-6">
         <img class="bg-img-cover bg-center" src="<?php echo e(asset('backend/images/login/login-banner.png')); ?>" alt="looginpage">
      </div>
      <div class="col-xl-6">
            <div class="row">
               <div class="col-xl-9">
                  <a class="logo text-center" href="<?php echo e(route('login')); ?>">

                     <img class="img-fluid for-light" src="<?php echo e(asset('backend/images/logo/logo.jpeg')); ?>" alt="looginpage" width="300">

                     <img class="img-fluid for-dark" src="<?php echo e(asset('backend/images/logo/logo.jpeg')); ?>" alt="looginpage" width="300">
                  </a>
               </div>
               <div class="col-xl-3">
                  <img class="img-fluid for-light" src="<?php echo e(asset('backend/images/logo/become_partner.jpeg')); ?>" alt="looginpage">
                  <img class="img-fluid for-dark" src="<?php echo e(asset('backend/images/logo/become_partner.jpeg')); ?>" alt="looginpage">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div style="margin:3%">
                     <div class="col-md-12">
                        <?php if(session('success')): ?>
                           <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                           </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                           <div class="alert alert-danger">
                              <?php echo e(session('error')); ?>

                           </div>
                        <?php endif; ?>
                     </div>
                     <form action="<?php echo e(route('contactus.save')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($user->id); ?>" name="id" />
                        <div class="form-group form-row">
                              <label for="name" class="col-sm-5 col-form-label">Your Name:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="name" value="" name="name" require>
                              </div>
                        </div>

                        <div class="form-group form-row">
                              <label for="email" class="col-sm-5 col-form-label">Your email address:</label>
                              <div class="col-sm-7">
                                 <input type="email" class="form-control" id="email" value="<?php echo e($user->email); ?>" readonly name="email" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="phone" class="col-sm-5 col-form-label">Your phone number:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="phone" value="" name="phone" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="role" class="col-sm-5 col-form-label">Your position/role:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="role" value="" name="role" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="business_name" class="col-sm-5 col-form-label">Name of business:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="business_name" value="" name="business_name" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="address" class="col-sm-5 col-form-label">Address:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="address" value="" name="address" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="city" class="col-sm-5 col-form-label">City:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="city" value="" name="city" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="state" class="col-sm-5 col-form-label">State/province:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="state" value="" name="state" require>
                              </div>
                        </div>
                        <div class="form-group form-row">
                              <label for="country" class="col-sm-5 col-form-label">Country:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="country" value="" name="country" require>
                              </div>
                        </div>

                        <div class="form-group form-row">
                              <label for="no_of_employee" class="col-sm-5 col-form-label">No of Employees:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="no_of_employee" value="" name="no_of_employee" require>
                              </div>
                        </div>
                        
                        <div class="form-group form-row">
                              <label for="purpose" class="col-sm-5 col-form-label">Purpose of calling:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="purpose" value="" name="purpose" require>
                              </div>
                        </div>
                     
                        <div class="form-group form-row">
                              <label for="company_name" class="col-sm-5 col-form-label">Exsisting Phone Company's Name:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="company_name" value="" name="company_name" require>
                              </div>
                        </div>
                              
                        <div class="form-group form-row">
                              <label for="company_website" class="col-sm-5 col-form-label">Exsisting Phone Company's Website:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="company_website" value="" name="company_website" require>
                              </div>
                        </div>
                              
                        <div class="form-group form-row">
                              <label for="office_phone" class="col-sm-5 col-form-label">Exsisting number of phone in your office:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="office_phone" value="" name="office_phone" require>
                              </div>
                        </div>
                              
                        <div class="form-group form-row">
                              <label for="own_phone" class="col-sm-5 col-form-label">Do you own the Phones or provided to you by the existing phone company:</label>
                              <div class="col-sm-7">
                                 <select class="form-control" id="own_phone" name="own_phone" require>
                                    <option value="owned">owned</option>
                                    <option value="leased">leased</option>
                                 </select>
                              </div>
                        </div>
                              
                        <div class="form-group form-row">
                              <label for="no_of_phone" class="col-sm-5 col-form-label">How many employees would need a phone:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="no_of_phone" value="" name="no_of_phone" require>
                              </div>
                        </div>

                              
                        <div class="form-group form-row">
                              <label for="emp_same_time" class="col-sm-5 col-form-label">How many employees are on the phone at the same time:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="emp_same_time" value="" name="emp_same_time" require>
                              </div>
                        </div>
                              
                        <div class="form-group form-row">
                              <label for="new_phone" class="col-sm-5 col-form-label">Do you want a new phone number or would you keep exsisting number:</label>
                              <div class="col-sm-7">
                                 <select class="form-control" id="new_phone" name="new_phone" require>
                                    <option value="Require New Number">Require New Number</option>
                                    <option value="Keep Existing Number">Keep Existing Number</option>
                                 </select>
                              </div>
                        </div>

                        <div class="form-group form-row new_phone">
                              <label for="new_phone_last" class="col-sm-5 col-form-label">Enter your desired area code and last 4 digits<a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Our technicians will try to find the number of your choice but we cannot guarantee aquire">?</a></label>
                              <div class="col-sm-2">
                                 <input type="text" class="form-control" maxlength="3" id="new_area_code" value="" name="new_area_code" require placeholder="Area Code">
                              </div>
                              <div class="col-sm-2">
                              <span style="background:gray;width:100%;height:71%;" class="form-control">&nbsp;</span>
                              </div>
                              <div class="col-sm-3">
                                 <input type="text" class="form-control" maxlength="4" id="new_phone_last" value="" name="new_phone_last" require placeholder="Last 4 digits">
                              </div>
                        </div>

                        <div class="form-group form-row exsisting_phone" style="display:none;">
                              <label for="exsisting_phone" class="col-sm-5 col-form-label">What is the exsisting phone number:</label>
                              <div class="col-sm-7">
                                 <input type="text" class="form-control" id="exsisting_phone" value="" name="exsisting_phone" require>
                              </div>
                        </div>
                        <?php if(config('services.recaptcha.key')): ?>
                           <div class="g-recaptcha"
                              data-sitekey="<?php echo e(config('services.recaptcha.key')); ?>">
                           </div>
                        <?php endif; ?>
                        <div class="form-group form-row">
                              <div class="col-sm-12">
                                 <div class="pull-right" style="text-align: end;">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                 </div>
                              </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>

    (function() {'use strict';

      $('[data-toggle="tooltip"]').tooltip();

    window.addEventListener('load', function() {

    // Fetch all the forms we want to apply custom Bootstrap validation styles to

    var forms = document.getElementsByClassName('needs-validation');

    // Loop over them and prevent submission

    var validation = Array.prototype.filter.call(forms, function(form) {

    form.addEventListener('submit', function(event) {

    if (form.checkValidity() === false) {

    event.preventDefault();

    event.stopPropagation();

    }

    form.classList.add('was-validated');

    }, false);

    });

    }, false);

})();

$('#new_phone').on('change',function(){
   if (this.value == "Require New Number") {
      $('.new_phone').show();
      $('.exsisting_phone').hide();
   } else {
      $('.new_phone').hide();
      $('.exsisting_phone').show();
   }
});

</script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('backend.layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/backend/auth/adminlogin.blade.php ENDPATH**/ ?>