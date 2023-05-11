<?php $this->view('barber/includes/header', ["title" => "Booked Appointments"]) ?>
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
                                Booked Appointments
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($booked_appointments) && count($booked_appointments) > 0) { ?>
                                        <table class="table table-hover table-bordered table-responsive">
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
                                            <tbody>
                                                <?php $count = 0; ?>
                                                <?php foreach (@$booked_appointments as $appointment): ?>
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
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<?php $this->view('barber/includes/footer') ?>
