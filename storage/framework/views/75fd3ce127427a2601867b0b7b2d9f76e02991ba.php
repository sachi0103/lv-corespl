<div class="sidebar-wrapper">

   <div class="logo-wrapper">

      <a href="#"><img class="img-fluid for-light" src="<?php echo e(asset('backend/images/logo/logo.jpeg')); ?>" alt="" width="150"><img class="img-fluid for-dark" src="../backend/images/logo/logo.jpeg" alt=""></a>

      <div class="back-btn"><i class="fa fa-angle-left"></i></div>

   </div>

   <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid" src="<?php echo e(asset('backend/images/logo/logo.jpeg')); ?>" alt=""></a></div>

   <nav class="sidebar-main">

      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>

      <div id="sidebar-menu">

         <ul class="sidebar-links custom-scrollbar">

            <li class="back-btn">

               <a href="#"><img class="img-fluid" src="<?php echo e(asset('backend/images/logo/logo.png')); ?>" alt=""></a>

               <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>

            </li>

            <li class="sidebar-list">

               <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.dashboard' ? 'active' : ''); ?>" style="cursor: pointer;">

                  <i data-feather="home"></i>

                  <span class="lan-3">Portal</span>

               </a>

            </li>

            <li class="sidebar-list">

                <a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.users.index' ? 'active' : ''); ?>"  href="<?php echo e(route('admin.users.index')); ?>">

                  <i data-feather="users"></i><span>Manage User</span>

                </a>

            </li>

            <li class="sidebar-list">

               <a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.package.index' ? 'active' : ''); ?>"  href="<?php echo e(route('admin.accounts.index')); ?>">

                  <i data-feather="flag"></i><span>Manage Package</span>

               </a>

            </li>

            <li class="sidebar-list">

                <a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.accounts.index' ? 'active' : ''); ?>"  href="<?php echo e(route('admin.accounts.index')); ?>">

                  <i data-feather="users"></i><span>Manage Accounts</span>

                </a>

             </li>



             <li class="sidebar-list">

                <a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.payment.index' ? 'active' : ''); ?>"  href="<?php echo e(route('admin.payment.index')); ?>">

                  <i data-feather="dollar-sign"></i><span>Payments </span>

                </a>
             </li>

             <li class="sidebar-list">

                <a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.reports.index' ? 'active' : ''); ?>"  href="<?php echo e(route('admin.reports.index')); ?>">

                  <i data-feather="file-text"></i><span>Reports </span>
                </a>
             </li>

             <li class="sidebar-list">

                <a class="sidebar-link sidebar-title <?php echo e(Route::currentRouteName()=='admin.user.profile' ? 'active' : ''); ?>"  href="<?php echo e(route('admin.user.profile')); ?>">

                  <i data-feather="user"></i><span>Profile</span>

                </a>

             </li>

             <li class="sidebar-list">

                <a class="sidebar-link sidebar-title" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();

              document.getElementById('logout-form').submit();">

                <i data-feather="log-out"> </i><span>Log Out</span>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">

                <?php echo csrf_field(); ?>

                </form>

             </li>

            </div>

      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>

   </nav>

</div>

<?php /**PATH D:\wamp\www\jayoffice\lv-corespl\resources\views/backend/layouts/dashboard/sidebar.blade.php ENDPATH**/ ?>