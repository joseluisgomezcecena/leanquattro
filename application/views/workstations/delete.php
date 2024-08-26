<div class="page-header">
    <h2 class="header-title">Actualizar Estación De Trabajo</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("workstations") ?>">Estaciones De Trabajo</a>
            <span class="breadcrumb-item active">Actualizar Estación De Trabajo</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("workstations/delete/" . $work_station['work_station_id']) ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4>Estación De Trabajo</h4>
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

                    

                   
                        <div class="row">
                            <!--select box for plants-->
                            <div class="form-group col-lg-6">
                                <label for="plant_id">Planta</label>
                                <select class="form-control" id="plant_id" name="plant_id">
                                    <option value="">Selecciona una planta</option>
                                    <?php foreach ($plants as $plant): ?>
                                        <option value="<?php echo $plant['plant_id']; ?>" <?php if($work_station['plant_id'] == $plant['plant_id']){echo"selected";}else{echo"";} ?>><?php echo $plant['plant_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('plant_id', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <!--select box for production lines-->
                            <div class="form-group col-lg-6">
                                <label for="line_id">Linea de producción</label>
                                <select class="form-control" id="line_id" name="line_id">
                                    <option value="<?php echo $work_station['ws_line_id'] ?>"><?php echo $work_station['line_name']; ?></option>
                                </select>
                                <?php echo form_error('line_id', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            
                            <div class="form-group col-lg-6">
                                <label for="part_number">Nombre de la estación de trabajo</label>
                                <input type="text" class="form-control" id="work_station_name" name="work_station_name" placeholder="Nombre de la estación" value="<?php echo $work_station['work_station_name']; ?>">
                                <?php echo form_error('work_station_name', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="part_number">Numero de la estación de trabajo</label>
                                <input type="text" class="form-control" id="work_station_number" name="work_station_number" placeholder="Numero de la estación" value="<?php echo $work_station['work_station_number']; ?>">
                                <?php echo form_error('work_station_number', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-12" >
                                <label for="part_description">Descripción</label>
                                <textarea type="text" class="form-control" id="work_station_description" name="work_station_description" rows="8" placeholder="Descripción"><?php echo $work_station['work_station_description']; ?></textarea>
                                <?php echo form_error('work_station_description', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-6" >
                                <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
    
</div>

</form>