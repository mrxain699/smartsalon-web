<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= ROOT ?>/vendors/mdi/css/materialdesignicons.min.css" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
</head>

<body>
  <section style="background-color: #E2E1DB;  min-height:100vh; display:flex; justify-content:center; align-items:center; flex-direction:column">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="<?= ROOT ?>/images/login/mensalon.jpg" alt="login form" class="img-fluid" style="border-radius: 0.9rem 0 0 0.9rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center" style="background-color: #ffffff; border-radius: 0 1rem 1rem 0;">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form method="post">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-2x fa-scissors" style="color:#ff6219; transform:rotate(-45deg);"></i>
                      <span class="h1 fw-bold mb-0" style="color:#ff6219; margin-left: 10px !important;"> Smart Salon</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                    <?php if (@$alert) echo $alert; ?>
                    <div class="form-outline mb-4 mt-2">
                      <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>
                    <div class="form-outline mb-2">
                      <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" maxlength="11" required />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
                    <a class="small text-center text-muted " href="<?= URL ?>/forgotpassword">Forgot password?</a>
                    <div class="pt-1 mt-2">
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- MDB -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    let form = document.getElementsByTagName('form');
    form.onsubmit = () => {
      form.reset();
    }
    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
      swal({
        text: "<?php echo $_SESSION['message']; ?>",
        icon: "<?php echo $_SESSION['message_type']; ?>",
        buttons: "Ok",
      }).then((value) => {

      });
    <?php
    }
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>
  </script>
</body>

</html>