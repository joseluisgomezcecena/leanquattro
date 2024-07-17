<div class="page-header">
    <h2 class="header-title">Alertas</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item " href="<?php echo base_url("alerts") ?>">Alertas</a>
            <span class="breadcrumb-item active">Nueva Alerta</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Alertas</h4>
        <div class="m-t-25">

            <!-- echo flash messages -->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            

            <form action="<?php echo base_url("alerts/create") ?>" method="post">
                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label for="client_name">Nombre de la alerta</label>
                        <input type="text" class="form-control" id="alert_name" name="alert_name" placeholder="Nombre de la alerta" value="<?php echo set_value('plant_name'); ?>">
                        <?php echo form_error('alert_name', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group col-lg-8">
                        <label for="alert_description">Descripción de la alerta</label>
                        <input type="text" class="form-control" id="alert_description" name="alert_description" placeholder="Descripción de la alerta" value="<?php echo set_value('alert_description'); ?>">
                        <?php echo form_error('alert_description', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <input type="hidden" id="subAlertIndex" name="alert_counter" value="1">

                    <div class="form-group col-lg-12">
                        <label>Sub Alertas</label>
                        <div id="sub_alerts_container">
                            <!-- Dynamic fields will be added here -->
                        </div>
                        <button type="button" id="add_sub_alert" class="btn btn-success mb-5">Agregar Sub-Alertas</button>
                    </div>

                    <div class="form-group col-lg-12 mt-5" >
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>