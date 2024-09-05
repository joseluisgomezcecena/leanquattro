<div class="page-header">
    <h2 class="header-title">Actualizar Pantalla</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("screens") ?>">Pantallas</a>
            <span class="breadcrumb-item active">Actualizar Pantalla</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Configurar pantalla</h4>
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

            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> Por favor revisa los campos del formulario.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            

            <form action="<?php echo base_url("screens/create") ?>" method="post">
                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label for="team_name">Nombre de la pantalla</label>
                        <input type="text" class="form-control" id="screen_name" name="screen_name" placeholder="Nombre de la pantalla" value="<?php echo $screen['screen_name'] ?>">
                        <?php echo form_error('screen_name', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-8" >
                        <label for="client_name">Descripción</label>
                        <input type="text" class="form-control" id="description" name="screen_description" placeholder="Descripción corta" value="<?php echo $screen['screen_description'] ?>">
                        <?php echo form_error('screen_description', '<div class="text-danger">', '</div>'); ?>
                    </div>



                    <div class="form-group col-lg-6" >
                        <label for="team_plant">Planta</label>
                        <select class="select2" name="screen_plant" id="plant_id">
                            <option value="">Seleccione</option>
                            <?php foreach ($plants as $plant) { ?>
                                <option value="<?php echo $plant['plant_id'] ?>" ><?php echo $plant['plant_name']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('screen_plant', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-6" >
                        <label for="team_line">Línea</label>
                        <select class="select2" name="screen_line[]" id="line_id" multiple="multiple">
                            <option value="">Seleccione</option>
                           
                        </select>
                        <?php echo form_error('screen_line[]', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <!--assign alerts to the team-->
                    <div class="form-group col-lg-6 mb-5" >
                        <label for="team_location">Estación de trabajo</label>
                        <select class="select2" id="work_station_id" name="screen_workstation[]" multiple="multiple">
                            <option value="">Seleccione</option>

                        </select>
                        <?php echo form_error('screen_workstation[]', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-6 mb-5" >
                        <ul class="list-group">
                        <?php foreach ($workstations_by_screen_id as $ws) { ?>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <button class="btn btn-danger"><i class="anticon anticon-delete"></i></button> 
                                    </div>
                                    <div class="m-l-10">
                                        <div class="m-b-0 text-dark font-weight-semibold"><?php echo $ws['work_station_name'] ?></div>
                                        <div class="m-b-0 opacity-07 font-size-13">...</div>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                        </ul>
                                                            
                        
                    </div>

                   


                    <div class="form-group col-lg-12" >
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>