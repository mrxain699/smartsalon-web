<?php $this->view('barber/includes/header', ["title"=>"Report"])?>
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
                Rating Reports
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 col-lg-4 col-md-12">
                      <div>
                          <canvas id="Weekly Report"></canvas>
                        </div>
                      </div>
                  <div class="col-sm-12 col-lg-4 col-md-12">
                  <div>
                          <canvas id="Monthly Report"></canvas>
                        </div>
                  </div>
                  <div class="col-sm-12 col-lg-4 col-md-12">
                  <div>
                          <canvas id="Total Rating Report"></canvas>
                        </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!--row-end-->
      
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 grid-margin stretch-card mx-auto">
            <div class="card">
              <div class="card-header justify-content-between d-flex align-items-center">
                Appointments Reports
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                  <div>
  <canvas id="Appointment Trends"></canvas>
</div>
                  </div>
                  
                </div>

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
<script type="text/javascript">
    var weekly_review = <?php echo $weekly_reviews; ?>
</script>
<script type="text/javascript">
    var monthly_review = <?php echo $monthly_reviews; ?>
</script>
<script type="text/javascript">
    var daily_incomes = <?php echo $daily_income; ?>
</script>
<script type="text/javascript">
    var rating_count = <?php echo $rating_count; ?>;
</script>
<script type="text/javascript">
    var appointment_trends = <?php echo $appointment_trends; ?>
</script>
<script type="text/javascript">
    var popular_services = <?php echo $popular_services; ?>
</script>
<?php $this->view('barber/includes/footer'); ?>
<!-- container-scroller -->


<script type="text/javascript" src="<?=DASHBOARD_ROOT?>/js/chart.js"></script>
