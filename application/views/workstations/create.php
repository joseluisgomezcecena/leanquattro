<div class="page-header">
    <h2 class="header-title">Nueva Estación De Trabajo</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("workstations") ?>">Estaciones De Trabajo</a>
            <span class="breadcrumb-item active">Nueva Estación De Trabajo</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("workstations/create") ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-8">
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
                            
                            <div class="form-group col-lg-6">
                                <label for="part_number">Nombre de la estación de trabajo</label>
                                <input type="text" class="form-control" id="work_station_name" name="work_station_name" placeholder="Nombre de la estación" value="<?php echo set_value('work_station_name'); ?>">
                                <?php echo form_error('work_station_name', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="part_number">Numero de la estación de trabajo</label>
                                <input type="text" class="form-control" id="work_station_number" name="work_station_number" placeholder="Numero de la estación" value="<?php echo set_value('work_station_number'); ?>">
                                <?php echo form_error('work_station_number', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-12" >
                                <label for="part_description">Descripción</label>
                                <textarea type="text" class="form-control" id="work_station_description" name="work_station_description" rows="8" placeholder="Descripción"><?php echo set_value('work_station_description'); ?></textarea>
                                <?php echo form_error('work_station_description', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-6" >
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4>Numero de parte</h4>
                <div class="form-group" >
                    <div class="custom-file mt-5">
                        <input type="file" class="custom-file-input" id="customFile" name="work_station_image">
                        <label class="custom-file-label" for="customFile">Subir Imagen</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>