<style>
   .main-sidebar {
    background-color: black !important;
  }

  .main-sidebar a {
    color: white !important;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-navy-primary bg-navy elevation-4 sidebar-no-expand">
  <!-- Brand Logo -->
  <a href="<?php echo base_url ?>admin" class="brand-link bg-primary text-sm">
    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo" class="brand-image img-circle elevation-3 border-1" style="opacity: .8;width: 2.5rem;height: 2.5rem;max-height: unset">
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-resize-observer-host observed">
      <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <!-- Sidebar user panel (optional) -->
          <div class="clearfix"></div>
          <!-- Sidebar Menu -->
          <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item dropdown">
                <a href="./" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=maintenance" class="nav-link nav-maintenance">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>
                    Category Management
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=budget" class="nav-link nav-budget">
                  <i class="nav-icon fas fa-wallet"></i>
                  <p>
                    Add Budget
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=expense" class="nav-link nav-expense">
                  <i class="nav-icon fas fa-money-bill-wave"></i>
                  <p>
                    Expense Tracking
                  </p>
                </a>
              </li>
              <li class="nav-header">Reports</li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=budgetReport" class="nav-link nav-budgetReport">
                  <i class="nav-icon fas fa-file"></i>
                  <p>
                    Budget Report
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=expenseReport" class="nav-link nav-expenseReport">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                    Expense Report
                  </p>
                </a>
              </li>
              <!-- <li class="nav-header">Maintenance</li> -->

              <!-- <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Settings
                  </p>
                </a>
              </li> -->
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  $(document).ready(function() {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
    var pageParts = page.split('/'); // Split the page parameter by '/'
    var pageClass = pageParts[0]; // Take the first part as the main class
    console.log(pageParts)

    if (s != '')
      pageClass += '_' + s;

    // Remove the 'active' class from all nav links
    $('.nav-link').removeClass('active');

    // Add the 'active' class to the current nav link based on the page
    $('.nav-link.nav-' + pageClass).addClass('active');

    // Add the 'active' class to any parent nav item if it's a tree item
    $('.nav-link.nav-' + pageClass).parents('.nav-item').addClass('active');

    // Add the 'menu-open' class to any parent nav item if it's a tree item
    $('.nav-link.nav-' + pageClass).parents('.nav-treeview').siblings('.nav-link').addClass('active').parent('.nav-item').addClass('menu-open');
  });
</script>