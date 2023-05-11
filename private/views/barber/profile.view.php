<?php
if (!AUTH::logged_in()) {
  $this->redirect('/login');
}
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
}
?>
<?php $this->view('barber/includes/header', ["title" => "Profile"]) ?>

<div class="container-scroller" style="min-height:100vh;">
  <?php $this->view('barber/includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
    <?php $this->view('barber/includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <div class="col col-sm-12 col-md-6 col-lg-8">
            <div class="card">
              <div class="card-header">Profile</div>
              <div class="card-body">
                <div class="profile_card d-flex align-items-center justify-content-center mb-5">
                  <div class="profile-image border">
                    <img src="<?php echo isset($data['image']) && !empty(@$data['image']) ? URL . '/' . @$data['image'] : DASHBOARD_ROOT . '/images/faces/default.png'; ?>" id="p_image">
                    <label class="profile_img_btn" type="button">
                      <input type="file" name="image" id="profile_img" accept="image/*" hidden value="<?php echo @$data['image']; ?>">
                      <i class="mdi mdi-camera" style="font-size: 32px; color:#ffffff;"></i>
                    </label>
                  </div>
                </div>
                <form class="forms-sample mt-3" method="post" action="<?= URL ?>/profile/update" enctype="multipart/form-data">
                  <?php if (@$alert) echo $alert; ?>
                  <input type="text" class="form-control" name="id" id="id" placeholder="id" value="<?php echo @$data['id']; ?>" hidden />
                  <div class="row mt-3">
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control form-input" name="name" id="name" placeholder="Name" value="<?php echo @$data['name']; ?>" required />
                        <span class="text-danger text-small"><?php echo @$errors['name']; ?></span>
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control form-input" name="email" id="email" placeholder="Email" required value="<?php echo @$data['email']; ?>" />
                        <span class="text-danger text-small"><?php echo @$errors['email']; ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="cnic">CNIC*</label>
                        <input type="text" class="form-control form-input" name="cnic" id="cnic" placeholder="CNIC" required value="<?php echo @$data['cnic']; ?>" />
                        <span class="text-danger text-small"><?php echo @$errors['cnic']; ?></span>
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control form-input" id="phone" placeholder="eg:03075313442" value="<?php echo @$data['phone']; ?>" maxlength="11" required />
                        <span class="text-danger text-small"><?php echo @$errors['phone']; ?></span>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2"> Save </button>
                </form>
              </div>
            </div>
          </div>
          <div class="col col-sm-12 col-md-6 col-lg-4">
            <div class="card rounded">
              <div class="card-header">Change Password</div>
              <div class="card-body">
                <form class="forms-sample mt-3" method="post" action="<?= URL ?>/profile/change_password">
                  <?php if (@$message) echo $message; ?>
                  <div class="form-group mt-2">
                    <label for="newpassword">New Password</label>
                    <input type="password" class="form-control " name="password" id="password" placeholder="New Password" required />
                    <span class="text-danger text-small mt-2"><?php echo @$errors['password']; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="confirmpass">Confirm Password</label>
                    <input type="password" name="cpass" class="form-control " id="cpass" placeholder="Confirm Password" required />
                    <span class="text-danger text-small mt-2"><?php echo @$errors['cpass']; ?></span>
                  </div>
                  <button type="submit" class="btn btn-primary mr-2"> Save </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="profile_image_container">
          <img id="image">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="crop">Save</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
<?php $this->view('barber/includes/footer') ?>
<script>
  var bs_modal = $('#modal');
  var image = document.getElementById('image');
  var cropper, reader, file;
  $("#profile_img").on("change", function(e) {
    var files = e.target.files;
    var done = function(url) {
      image.src = url;
      bs_modal.modal('show');
    };
    if (files && files.length > 0) {
      file = files[0];
      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

  bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
    });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });

  $("#crop").click(function() {
    canvas = cropper.getCroppedCanvas({
      width: 200,
      height: 200,
    });

    canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function() {
        var base64data = reader.result;
        $.ajax({
          url: "http://localhost/smartsalon/public/profile/update_image",
          type: "POST",
          data: {
            image: base64data
          },
          success: function(data) {
            if (data == 1) {
              bs_modal.modal('hide');
              swal({
                text: "Profile Pitcure Updated!",
                icon: "success",
                button: "Ok",
              }).then((value) => {
                if (value || value === null) {
                  window.location.href = "http://localhost/smartsalon/public/profile";
                }
              });
            } else {
              alert("Image Upload failed!");
            }
          }
        });
      };
    });


  });
</script>