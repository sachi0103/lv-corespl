<?php $__env->startSection('title', 'Login | High Streeting'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

   <div class="row">

      <div class="col-xl-6"><img class="bg-img-cover bg-center" src="<?php echo e(asset('backend/images/login/login-banner.png')); ?>" alt="looginpage"></div>

      <div class="col-xl-6 p-0">

         <div class="login-card">

            <div>

               <div>

                   <a class="logo text-left" href="<?php echo e(route('login')); ?>">

                        <img class="img-fluid for-light" src="<?php echo e(asset('backend/images/logo/logo.jpeg')); ?>" alt="looginpage" width="300">

                        <img class="img-fluid for-dark" src="<?php echo e(asset('backend/images/logo/logo.jpeg')); ?>" alt="looginpage" width="300">

                    </a>

                </div>

               <div class="login-main">

                  <form class="theme-form needs-validation"  method="POST" action="<?php echo e(route('authenticate')); ?>" novalidate="">
                     
                        <input type="hidden" value="1" name="is_admin" />
                      <?php echo csrf_field(); ?>

                     <h4>Sign in to account</h4>

                     <p>Enter your email & password to login</p>

                     <div class="form-group">

                        <label class="col-form-label">Email Address</label>

                        <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email" name="email" required="" placeholder="dummy@dummy.com" value="<?php echo e(old('email')); ?>">

                        <div class="invalid-tooltip">Please enter proper email.</div>

                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                        <span class="form-text text-danger"><?php echo e($message); ?></span>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                     </div>

                     <div class="form-group">

                        <label class="col-form-label">Password</label>

                        <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" name="password" required="" placeholder="*********">

                        <div class="show-hide"><span class="show"></span></div>

                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                        <span class="form-text text-danger"><?php echo e($message); ?></span>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="invalid-tooltip">Please enter password.</div>

                     </div>

                     <div class="form-group mb-0">

                        <div class="checkbox p-0">

                           <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                           <label class="text-muted" for="checkbox1">Remember password</label>

                        </div>

                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>

                     </div>

                     

                  </form>

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

</script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('backend.layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/corespl/login.corespl.com/jsdgdshfewiqruqwrujdfhsxzmv/resources/views/backend/auth/login.blade.php ENDPATH**/ ?>