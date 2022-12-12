<div class="page-header">

  <div class="header-wrapper row m-0">

    <div class="nav-right col-12 pull-right right-header p-0">

      <ul class="nav-menus">

        <li class="profile-nav onhover-dropdown p-0 mr-0">

          <div class="media profile-media">

            <img class="b-r-10" src="<?php echo e(asset('backend/images/dashboard/profile.jpg')); ?>" alt="" />

            <div class="media-body">

              <span><?php echo e(Auth::user()->name); ?></span>

              <p class="mb-0 font-roboto">Portal </p>
              <!-- <i class="middle fa fa-angle-down"></i> -->

            </div>

          </div>

          <!-- <ul class="profile-dropdown onhover-show-div">

            <li>

                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();

              document.getElementById('logout-form').submit();"><i data-feather="log-out"> </i><span>Log Out</span>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">

                <?php echo csrf_field(); ?>

                </form>

            </li>

          </ul> -->

        </li>

      </ul>

    </div>

  </div>

</div>

<?php /**PATH D:\wamp\www\jayoffice\lv-corespl\jsdgdshfewiqruqwrujdfhsxzmv\resources\views/backend/layouts/dashboard/header.blade.php ENDPATH**/ ?>