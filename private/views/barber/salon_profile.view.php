<?php
if (!AUTH::logged_in()) {
  $this->redirect('/login');
}
//   if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
//     $errors = $_SESSION['errors'];
//     unset($_SESSION['errors']);
//   }
?>
<?php $this->view('barber/includes/header', ["title" => "Salon Profile"]) ?>

<div class="container-scroller" style="min-height:100vh;">
  <?php $this->view('barber/includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
    <?php $this->view('barber/includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <div class="col col-sm-12 col-md-6 col-lg-8">
            <div class="card">
              <div class="card-header">Salon Profile</div>
              <div class="card-body">
                <form class="forms-sample mt-3" method="post" action="<?= URL ?>/salon/profile" enctype="multipart/form-data">
                  <input type="text" class="form-control" name="id" id="id" placeholder="id" value="<?php echo @$salon_profile['id']; ?>" hidden />
                  <div class="row mt-3">
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control form-input" name="name" id="name" placeholder="Name" value="<?php echo @$salon_profile['name']; ?>" required />
                        <span class="text-danger text-small"><?php echo @$errors['name']; ?></span>
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="address">Address*</label>
                        <input type="text" class="form-control form-input" name="address" id="address" placeholder="Address" required value="<?php echo @$salon_profile['address']; ?>" />
                        <span class="text-danger text-small"><?php echo @$errors['address']; ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="city">City*</label>
                        <input type="text" class="form-control form-input" name="city" id="city" placeholder="City" required value="<?php echo @$salon_profile['city']; ?>" />
                        <span class="text-danger text-small"><?php echo @$errors['city']; ?></span>
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                      <div class="form-group">
                        <label for="open_time">Open Hour</label>
                        <input type="time" name="open_time" id="open_time" class="form-control" value="<?php echo @$salon_profile['open_time']; ?>" />
                        <span class="text-danger text-small"><?php echo @$errors['open_time']; ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                      <div class="form-group">
                        <label for="close_time">Closing Hour</label>
                        <input type="time" name="close_time" id="close_time" class="form-control" value="<?php echo @$salon_profile['close_time']; ?>"/>
                        <span class="text-danger text-small"><?php echo @$errors['close_time']; ?></span>
                      </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                      <div class="form-group">
                        <label>Salon Profile Image</label>
                        <input type="file" name="img" accept="image/*" class="file-upload-default" style="display: none;" id="profile_img" />
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control update_file-upload-info" id="update_file-upload-info" disabled placeholder="Upload Image" value="<?php echo @$salon_profile['image']; ?>" />
                          <span class="input-group-append">
                            <button class="file-upload-browse btn text-light" style="background-color: #101928;" type="button"> Upload </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-sm-12 col-md-12 col-lg-12 ">
                      <div class="form-group">
                        <label>About Salon</label>
                        <textarea id="about" name="about" class="form-control" placeholder="Tell about your salon" rows="5"><?php echo @$salon_profile['about']; ?> </textarea>
                      </div>
                    </div>
                  </div>
                  <input type="text" name="certificate" id="certificate" value="<?php echo @$salon_profile['certificate']; ?>" hidden>
                  <input type="text" name="file" id="new_image" value="<?php echo @$salon_profile['image']; ?>" hidden>
                  <input type="text" name="temp" id="old_image" hidden>
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
<script type="text/javascript">
  <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
    swal({
      text: "<?php echo $_SESSION['message']; ?>",
      icon: "<?php echo $_SESSION['message_type']; ?>",
      buttons: "Ok",
    }).then((value)=>{
      if(value || value == null){
        // window.location.href = "http://localhost/smartsalon/public/salon/profile";
        window.location.reload();
      }
    });
  <?php
  }
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
  ?>
</script>
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
        var directory = "uploads/barber/salon/";
        var base64data = reader.result;
        var image = base64data.split(";base64,");
        var image_type_aux = image[0].split("image/");
        var image_type = image_type_aux[1];
        var base64data = image[1];
        var uniqueid = Math.floor(Math.random() * Date.now());
        var file = directory + uniqueid + "." + image_type;
        var new_image = [file, base64data];
        $("#new_image").val(file);
        $("#old_image").val(base64data);
        bs_modal.modal('hide');
      };
    });


  });
</script>