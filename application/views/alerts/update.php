<div class="page-header">
    <h2 class="header-title">Alertas</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item " href="<?php echo base_url("alerts") ?>">Alertas</a>
            <span class="breadcrumb-item active">Actualizar Alerta</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Actualizar Alerta</h4>
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

            <form action="<?php echo base_url("alerts/update/" . $alert['alert_id']) ?>" method="post">
                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label for="alert_name">Nombre de la alerta</label>
                        <input type="text" class="form-control" id="alert_name" name="alert_name" placeholder="Nombre de la alerta" value="<?php echo set_value('alert_name', $alert['alert_name']); ?>">
                        <?php echo form_error('alert_name', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group col-lg-8">
                        <label for="alert_description">Descripción de la alerta</label>
                        <input type="text" class="form-control" id="alert_description" name="alert_description" placeholder="Descripción de la alerta" value="<?php echo set_value('alert_description', $alert['alert_description']); ?>">
                        <?php echo form_error('alert_description', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <input type="hidden" id="subAlertIndex" name="alert_counter" value="<?php echo count($sub_alerts); ?>">

                    <div class="form-group col-lg-12">
                        <label>Sub Alertas</label>
                    </div>

                    
                       

                        <div class="col-lg-6">
                            <div id="sub_alerts_container">
                                <!-- Dynamic fields will be added here -->
                            </div>
                            <button type="button" id="add_sub_alert" class="btn btn-success mb-5">Agregar Sub-Alertas</button>
                        </div>

                    <div style="float:right" class="mt-5 mb-5">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                    </form>
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <?php foreach ($sub_alerts as $index => $sub_alert) { ?>
                                    <form action="<?php echo base_url("alerts/delete_subalert/" . $sub_alert['child_id']) ?>" method="post">
                                        <input type="hidden" name="c_alert_id"  value="<?php echo $sub_alert['c_alert_id'] ?>">
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <button type="submit" name="delete_subalert" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                </div>
                                                <div class="m-l-10">
                                                    <div class="m-b-0 text-dark font-weight-semibold"><?php echo $sub_alert['child_alert_name']; ?><div>
                                                </div>
                                            </div>
                                        </li>
                                    </form>
                                <?php } ?>
                            </ul>
                        </div>
                    
    
                   

                    
                </div>    
            
        </div>
    </div>
</div>

