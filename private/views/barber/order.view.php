<?php $this->view('barber/includes/header', ["title" => "Orders"]) ?>
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
                                Orders
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($orders) && count($orders) > 0) { ?>
                                        <table class="table table-hover table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Sr</th>
                                                    <th>Customer</th>
                                                    <th>phone</th>
                                                    <th>Shipping Address</th>
                                                    <th>Date</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $count  = 0;
                                                foreach (@$orders as $order): $count++;?>
                                                
                                                    <?php 
                                                        $customer_id = $order['customer_id'];
                                                        $customer = $this->getCustomer($customer_id);
                                                    ?>
                                                    
                                                    <tr class="orders" data-id="<?php echo $order['id'];?>">
                                                        <td><?php echo $count?></td>
                                                        <td><?php echo ucfirst($customer['name'])?></td>
                                                        <td><?php echo $order['phone']?></td>
                                                        <td><?php echo $order['address']?></td>
                                                        <td><?php echo date('M j Y g:i A', strtotime($order['datetime'])); ?></td>
                                                        <td>
                                                            <?php
                                                            if($order["confirmed"] == 0 && $order["reject"] == 0){
                                                                $status_class = "warning";
                                                                $status = "Pending";
                                                            }
                                                            else if($order["confirmed"] == 1 && $order["reject"] == 0){
                                                                $status_class = "success";
                                                                $status = "Confirmed";
                                                            }
                                                            else if($order["confirmed"] == 0 && $order["reject"] == 1){
                                                                $status_class = "danger";
                                                                $status = "Reject";
                                                            }
                                                            ?>
                                                            <label class="badge badge-<?php echo $status_class; ?>"><?php echo $status; ?></label>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No orders";
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
<script type="text/javascript">
var rows = document.getElementsByClassName('orders');
var url = 'http://localhost/smartsalon/public/order/detail';
for (var i=0,len=rows.length; i<len; i++){
    rows[i].onclick = function(){
        let order_id = this.getAttribute('data-id');
        url+="/"+order_id;
        console.log(order_id);
        window.location = url;
    };
}
</script>
