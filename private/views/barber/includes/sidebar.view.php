<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
    <h2 class="sidebar-brand brand-logo" style="font-family: 'Pacifico', cursive !important; color:#423A8E !important">SmartSalon</h2>
    <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="<?= URL ?>"><img src="<?= DASHBOARD_ROOT ?>/images/icons8-barbershop-100.png" alt="logo" /></a>
  </div>
  <ul class="nav mt-5">

    <li class="nav-item">
      <a class="nav-link" href="<?= URL ?>/dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#appointments" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-calendar-check menu-icon"></i>
        <span class="menu-title">Appointments</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="appointments">
        <ul class="nav flex-column sub-menu">

          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/appointment/booked_appointment">Booked Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/appointment/cancelled_appointment">Cancelled Appointments</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#services" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-content-cut menu-icon"></i>
        <span class="menu-title">Services</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="services">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/category">Service Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>/service">Services</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= URL ?>/gallery" >
        <i class="mdi mdi mdi-file-image menu-icon"></i>
        <span class="menu-title">Gallery</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/worker">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Workers</span>
      </a>
    </li>
       <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/product">
        <i class="mdi mdi-cart-outline menu-icon"></i>
        <span class="menu-title">Product</span>
      </a>
    </li>
<!--     <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/order">
        <i class="mdi mdi-basket-outline menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>
 -->    <li class="nav-item">
      <a class="nav-link"  href="<?= URL ?>/report">
        <i class="mdi mdi-file-outline menu-icon"></i>
        <span class="menu-title">Reports</span>
      </a>
    </li>
   


  </ul>
</nav>
