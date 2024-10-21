<div class="page-header">
<h2 class="header-title">Capturar Producción</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Capturar Producción</a>
        </nav>
    </div>
    
</div>
<div class="card mt-5">
    <div class="card-body">


        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <?php echo validation_errors(); ?>

        <form method="post" action="<?php echo base_url("hourbyhour_clients/tracking_index") ?>">

            <div class="col-lg-12 form-group">
                <label for="workorder_number">Orden de trabajo</label>
                <input type="text" class="form-control" id="workorder_number" name="workorder_number" value="" required>
            </div>

            <div class="col-lg-12">
                <button class="btn btn-primary float-right">Buscar</button>
            </div>

        </form>
    </div>
</div>