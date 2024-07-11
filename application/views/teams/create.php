<div class="page-header">
    <h2 class="header-title">Nuevo Equipo</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("teams") ?>">Equipos</a>
            <span class="breadcrumb-item active">Nuevo Equipo</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Equipos De Soporte</h4>
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

            

            <form action="<?php echo base_url("teams/create") ?>" method="post">
                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label for="team_name">Nombre del equipo</label>
                        <input type="text" class="form-control" id="team_name" name="team_name" placeholder="Nombre del equipo" value="<?php echo set_value('team_name'); ?>">
                        <?php echo form_error('team_name', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-8" >
                        <label for="client_name">Descripción</label>
                        <input type="text" class="form-control" id="description" name="team_description" placeholder="Descripción corta" value="<?php echo set_value('team_description'); ?>">
                        <?php echo form_error('team_description', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-4" >
                        <label for="team_leader">Líder del equipo</label>
                        
                        <div class="m-b-15">
                            <select class="select2" name="leader">
                            <option value="">Seleccione</option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?php echo $user['user_id'] ?>"><?php echo $user['username']?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <?php echo form_error('leader', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-8" >
                        <label for="team_members">Miembros del equipo</label>
                        <div>
                            <select class="select2" name="member_id[]" multiple="multiple">
                                <option value="">Seleccione</option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?php echo $user['user_id'] ?>"><?php echo $user['username']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php echo form_error('member_id', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-6" >
                        <label for="team_plant">Planta</label>
                        <select class="select2" name="team_plant" id="plant_id">
                            <option value="">Seleccione</option>
                            <?php foreach ($plants as $plant) { ?>
                                <option value="<?php echo $plant['plant_id'] ?>"><?php echo $plant['plant_name']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('team_plant', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-6" >
                        <label for="team_line">Línea</label>
                        <select class="select2" name="team_line[]" id="line_id" multiple="multiple">
                            <option value="">Seleccione</option>
                           
                        </select>
                        <?php echo form_error('team_line[]', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-3" >
                        <label for="team_location">Escalación 1</label>
                        <div class="form-group d-flex align-items-center">
                            <div class="switch m-r-10">
                                <input type="checkbox" id="switch-1" name="escalation_1">
                                <label for="switch-1"></label>
                            </div>
                            <label>Activar</label>
                        </div>
                        <small>5 minutos</small>
                    </div>

                    
                    <div class="form-group col-lg-3" >
                        <label for="team_location">Escalación 2</label>
                        <div class="form-group d-flex align-items-center">
                            <div class="switch m-r-10">
                                <input type="checkbox" id="switch-2" name="escalation_2">
                                <label for="switch-2"></label>
                            </div>
                            <label>Activar</label>
                        </div>
                        <small>15 minutos</small>
                    </div>

                    
                    <div class="form-group col-lg-3" >
                        <label for="team_location">Escalación 3</label>
                        <div class="form-group d-flex align-items-center">
                            <div class="switch m-r-10">
                                <input type="checkbox" id="switch-3" name="escalation_3">
                                <label for="switch-3"></label>
                            </div>
                            <label>Activar</label>
                        </div>
                        <small>30 minutos</small>
                    </div>

                    
                    <div class="form-group col-lg-3" >
                        <label for="team_location">Escalación 4</label>
                        <div class="form-group d-flex align-items-center">
                            <div class="switch m-r-10">
                                <input type="checkbox" id="switch-4" name="escalation_4">
                                <label for="switch-4"></label>
                            </div>
                            <label>Activar</label>
                        </div>
                        <small>60 minutos</small>
                    </div>


                    <div class="form-group col-lg-12" >
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>