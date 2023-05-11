<?php $this->view('includes/header', ["title"=>"Smart Salon"]) ?>
<div class="container-fluid wrapper p-0">
    <div class="wrapper-content">
        <header class="header">
            <div class="container pt-2 header-content mx-auto">
                <?php $this->view('includes/navbar') ?>
                <div class="header-heading w-100 d-flex flex-column align-items-center mt-5">
                    <h1>The #1 Software for Salons and Spas</h1>
                    <h1>Simple, flexible and powerful booking software for your business.</h1>
                </div>
                <div class="demo-box w-100 pt-5">
                    <img src="<?=ROOT?>/images/header.jpg"/>
                </div>
            </div>
            <!--header-content--> 
            <div class="custom-shape-divider-bottom-1671892191">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" class="shape-fill"></path>
                </svg>
            </div>
        </header>
        <section class="section feature " id="feature">
            <div class="container pt-5 px-0">
                <div class="feature-content w-100">
                    <div class="feature-heading w-100 text-center ">
                        <h1>A full solution to manage and <br> grow your business</h1>
                    </div>
                    <div class="sub-heading w-100">
                        <h5>Packed with all the tools you need to boost sales, manage your calendar and retain clients so you can focus on what you do best</h5>
                    </div>
                </div>
                <div class="row mt-5 mx-0">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="feature-box d-flex flex-column p-4">
                            <div class="feature-icon">
                                <i class="fa fa-calendar-check-o" style="font-size:36px; color:blue"></i>
                            </div>
                            <div class="feature-title mt-3">
                                <h1>Appointment scheduling</h1>
                            </div>
                            <div class="feature-description">
                                <p>A sleek calendar easy to use across all devices.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 ">
                        <div class="feature-box d-flex flex-column p-4">
                            <div class="feature-icon">
                            <i class="fa fa-shopping-basket" style="font-size:36px; color:chocolate"></i>
                            </div>
                            <div class="feature-title mt-3">
                                <h1>Product inventory and online store</h1>
                            </div>
                            <div class="feature-description">
                                <p>Manage your stock and set up your own online store to sell products.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="feature-box d-flex flex-column p-4">
                            <div class="feature-icon">
                            <i class="fa fa-line-chart" style="font-size:36px; color:darkcyan"></i>
                            </div>
                            <div class="feature-title mt-3">
                                <h1>Reporting and analytics</h1>
                            </div>
                            <div class="feature-description">
                                <p>Monitor how your business is doing with live dashboard</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-12 col-md-12 col-lg-6  col-xs-12">
                        <div class="article-image w-100">
                            <img src="<?=ROOT?>/images/article_image.jpg" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <div class="card border-0 w-100">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>ONLINE BOOKING</h5>
                                    <h1>Grow sales by attracting new clients online</h1>
                                </div>
                                <div class="card-description">
                                    <p>Be seen, be available, build your brand online. Create an online profile on our marketplace to get noticed by thousands of potential clients in your area.</p>
                                </div>
                                <div class="card-list d-flex flex-column">
                                    <span class="d-flex"><i class="fa fa-check" style="font-size:24px; color:green;" ></i>  <p class="ml-3">Attract and retain clients</p></span>
                                    <span class="d-flex"><i class="fa fa-check" style="font-size:24px; color:green;"></i>   <p class="ml-3">Online self-booking</p></span>
                                    <span class="d-flex"><i class="fa fa-check" style="font-size:24px; color:green;"></i>   <p class="ml-3">Get trusted ratings and reviews</p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer d-flex justify-content-center align-items-center">
            <span  style="color:#fff !important;">&copy; copyright Smart Salon All-right reserved</span>
        </footer>
       
    </div>
    <!-- content_wrapper -->
</div>
<!--wrapper -->
<?php $this->view('includes/footer') ?>
