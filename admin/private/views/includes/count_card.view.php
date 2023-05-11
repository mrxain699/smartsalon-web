<div class="col-sm-12 col-md-6 col-lg-3">
    <div class="card">
        <div class="card-body d-flex justify-content-between border-5 border-left  border-<?= $class;?>">
            <div class="user_count d-flex flex-column w-100 h-100 justify-content-center flex-grow-1">
                <h4><?= $heading;?></h4>
                <span><?= $total;?></span>
            </div>
            <div class="icon d-flex justify-content-center align-items-center " >
                <span class="d-flex justify-content-center align-items-center  bg-<?= $class; ?> rounded-circle " style="width:50px; height:50px;">
                    <i class="mdi mdi-<?= $icon ?> text-light" style="font-size:24px;"></i>
                </span>
            </div>
        </div>
    </div>
</div>