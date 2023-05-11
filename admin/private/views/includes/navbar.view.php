
<nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
  <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
    <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="<?=URL?>"><img src="<?=ROOT?>/images/icons8-scissors-40.png" alt="logo" /></a>
    <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
      <i class="mdi mdi-menu"></i>
    </button>

    <ul class="navbar-nav navbar-nav-right ml-lg-auto">
      <li class="nav-item  nav-profile dropdown border-0">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
          <?php $image  =  isset($_SESSION['IMAGE']) && !empty($_SESSION['IMAGE']) ? URL.'/uploads/'.$_SESSION['IMAGE'] : ROOT.'/images/faces/default.png'; ?>
          <img class="nav-profile-img mr-2" alt="" src="<?php echo $image ?>">
          <span class="profile-name"><?php echo isset($_SESSION['USER']) ? $_SESSION['USER'] : ''; ?></span>
        </a>
        <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="<?=URL?>/profile">
            <i class="mdi mdi-account-circle mr-2 text-primary"></i> Profile </a>
          <a class="dropdown-item" href="<?=URL?>/login">
            <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>