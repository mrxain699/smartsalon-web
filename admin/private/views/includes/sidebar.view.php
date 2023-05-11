<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
    <h2 class="sidebar-brand brand-logo" style="font-family: 'Pacifico', cursive; color:#423A8E !important">SmartSalon</h2>
    <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="<?= URL ?>"><img src="<?= ROOT ?>/images/icons8-barbershop-100.png" alt="logo" /></a>
  </div>
  <ul class="nav mt-2">

    <li class="nav-item">
      <a class="nav-link" href="<?= URL ?>">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/user">
        <i class="mdi mdi-account-circle menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/salon" >
        <i class="mdi mdi-content-cut menu-icon"></i>
        <span class="menu-title">Salons</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/customer">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Customers</span>
      </a>
    </li>

  </ul>
</nav>