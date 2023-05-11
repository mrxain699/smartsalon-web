<?php 
  if(!AUTH::logged_in()){
    $this->redirect('/login');
  }
  
?>
<?php $this->view('barber/includes/header', ["title"=>"Dashboard"]) ?>
<div class="container-scroller" style="min-height: 100vh;">
  <?php $this->view('barber/includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
  <?php $this->view('barber/includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-warning">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">SERVICES</p>
                        <h2 class="text-white"><?php echo $total_services; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-content-cut bg-inverse-icon-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-danger">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Workers</p>
                        <h2 class="text-white"><?php echo $total_workers; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-account bg-inverse-icon-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-primary">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Today Booked Appointment</p>
                        <h2 class="text-white"><?php echo $total_today_booked; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-calendar-check bg-inverse-icon-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-success">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Request</p>
                        <h2 class="text-white"><?php echo $total_appointments; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-calendar bg-inverse-icon-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 grid-margin stretch-card mx-auto">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                Today Booked Appointments
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($today_booked) && count($today_booked) > 0) { ?>
                                        <table class="table table-hover table-bordered table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Customer</th>
                                                    <th>Services</th>
                                                    <th>Duration</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody id="worker_table">
                                                <?php $count = 0; ?>
                                                <?php foreach (@$today_booked as $appointment): ?>
                                                    <?php 
                                                        $duration = 0;
                                                        $price = 0;
                                                        
                                                        $services = $this->get_services($appointment['id']);
                                                        foreach($services as $service){
                                                            $duration += $service['duration'];
                                                            $price += $service['price'];
                                                        }
                                                    ?>
                                                    <?php $count = $count + 1;?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo ucfirst($appointment['name'])?></td>
                                                        <td>
                                                        <select class="form-control" style="color:#000 !important;">
                                                        <?php foreach($services as $service): ?>
                                                            
                                                            <option value="<?=$service['name']?>"><?=$service['name']?></option>
                                                           
                                                        <?php endforeach; ?> 
                                                        </select>     
                                                        </td>
                                                        <td><?php echo $duration; ?></td>
                                                        <td><?php echo $price; ?></td>
                                                        <td><?php echo $appointment['date']; ?></td>
                                                        <td><?php echo $appointment['time']; ?></td>
                                                
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No Appointments";
                                    }
                                    ?>
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
                                Pending Appointments
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($pending_appointments) && count($pending_appointments) > 0) { ?>
                                        <table class="table table-hover table-bordered w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Customer</th>
                                                    <th>Services</th>
                                                    <th>Duration</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="worker_table">
                                                <?php $count = 0; ?>
                                                <?php foreach (@$pending_appointments as $appointment): ?>
                                                    <?php 
                                                        $duration = 0;
                                                        $price = 0;
                                                        
                                                        $services = $this->get_services($appointment['id']);
                                                        foreach($services as $service){
                                                            $duration += $service['duration'];
                                                            $price += $service['price'];
                                                        }
                                                    ?>
                                                    <?php $count = $count + 1;?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo ucfirst($appointment['name'])?></td>
                                                        <td>
                                                        <select class="form-control" style="color:#000 !important;">
                                                        <?php foreach($services as $service): ?>
                                                            
                                                            <option value="<?=$service['name']?>"><?=$service['name']?></option>
                                                           
                                                        <?php endforeach; ?> 
                                                        </select>     
                                                        </td>
                                                        <td><?php echo $duration; ?></td>
                                                        <td><?php echo $price; ?></td>
                                                        <td><?php echo $appointment['date']; ?></td>
                                                        <td><?php echo $appointment['time']; ?></td>
                                                        <td>
                                                            <a href="<?= URL ?>/appointment/booked_by_salon/<?= $appointment['id'] ?>"><i class="mdi mdi-check-circle text-success" style="font-size:28px; cursor:pointer"></i></a>
                                                            <a href="<?= URL ?>/appointment/cancel_by_salon/<?= $appointment['id'] ?>"><i class="mdi mdi-close-circle text-danger" style="font-size:28px;  cursor:pointer"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No Appointments";
                                    }
                                    ?>
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
<!-- container-scroller -->
<?php $this->view('barber/includes/footer') ?>
