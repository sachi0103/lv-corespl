<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Corespl  | Portal</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <?php echo $__env->make('backend.layouts.dashboard.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    @livewireStyles
  </head>
  <body class="ltr light-only" cz-shortcut-listen="true">
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader-box">
            <div class="loader-2"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php echo $__env->make('backend.layouts.dashboard.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Page Header Ends   -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <?php echo $__env->make('backend.layouts.dashboard.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <?php echo $__env->yieldContent('breadcrumb-title'); ?>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#
                      "> <i data-feather="home"></i></a>
                    </li>
                    <?php echo $__env->yieldContent('breadcrumb-items'); ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <?php echo $__env->yieldContent('content'); ?>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php echo $__env->make('backend.layouts.dashboard.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
    <!-- latest jquery-->
    <?php echo $__env->make('backend.layouts.dashboard.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.partials.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\wamp\www\jayoffice\lv-corespl\jsdgdshfewiqruqwrujdfhsxzmv\resources\views/backend/layouts/dashboard/master.blade.php ENDPATH**/ ?>