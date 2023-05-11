<?php $this->view('barber/includes/header', ["title" => "Gallery"]) ?>

<div class="container-scroller" style="min-height:100vh;">
  <?php $this->view('barber/includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
    <?php $this->view('barber/includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 grid-margin stretch-card mx-auto">
            <div class="card">
              <div class="card-header justify-content-between d-flex align-items-center">
                <input type="text" id="salon_id" name="salon_id" hidden class="m-0 p-0" value="<?php echo isset($_SESSION['SALON_ID']) ? $_SESSION['SALON_ID'] : ''; ?>">
                <label for="upload_gallery_image" class="m-2 p-0">
                  <input type="file" accept="image/*" id="upload_gallery_image" name="image" hidden class="m-0 p-0">
                  <span class="w-25 bg-primary py-2 px-3 text-light rounded" style="cursor: pointer;"><i class="mdi mdi-cloud-upload menu-icon"></i> Upload</span>
                </label>
              </div>
              <div class="card-body">
                <!-- Gallery -->
                <div class="row" id="gallery_row">
                  <?php if(is_array($images) && count($images) > 0){ ?>
                  <?php foreach ($images as $image) : ?>
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 p-0 gallery_image_container" style="overflow:hidden;">
                      <img src="<?= $image['image']; ?>" class="w-100 shadow-1-strong  mb-0" style="position:relative !important; overflow:hidden;" />
                      <div class="gallery_image_overlay"><i class="mdi mdi-delete gallery-item-icon" data-id="<?= $image['id']; ?>"></i></div>
                    </div>

                  <?php endforeach; ?>
                  <?php }else{ ?>
                    No image exist
                    <?php } ?>
                </div>
                <!-- Gallery -->
              </div>
            </div>
          </div>
        </div>
        <!--row-end-->
      </div>
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
        <button type="button" class="btn btn-primary" id="crop">Upload</button>
      </div>
    </div>
  </div>
</div>
<?php $this->view('barber/includes/footer'); ?>
<script src="<?= DASHBOARD_ROOT ?>/js/ajax/gallery.js"></script>
<script>
  var bs_modal = $('#modal');
  var s_id = $("#salon_id").val();
  var image = document.getElementById('image');
  var cropper, reader, file;
  $("#upload_gallery_image").on("change", function(e) {
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
          url: "http://localhost/smartsalon/public/gallery/upload",
          type: "POST",
          data: {
            salon_id: s_id,
            image: base64data
          },
          success: function(data) {
            if (data == 1) {
              bs_modal.modal('hide');
              swal({
                text: "Image Uploaded!",
                icon: "success",
                button: "Ok",
              }).then((value) => {
                if (value || value === null) {
                  window.location.href = "http://localhost/smartsalon/public/gallery";
                }
              });
            } else {
              swal({
                text: "Image Uploaded Failed!",
                icon: "error",
                button: "Ok",
              });
            }
          }
        });
      };
    });


  });
</script>