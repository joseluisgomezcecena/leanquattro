<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("parts") ?>">Hora por Hora</a>
            <span class="breadcrumb-item active">Crear Orden De Trabajo</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhoir/create") ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4>Orden de trabajo</h4>
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
                            
                            <div class="form-group col-lg-12">
                                <label for="part_number">Numero de parte</label>
                                <select class="form-control" id="part_number" name="part_number" >
                                    <option value="">Seleccionar Numero de Parte</option>
                                    <?php foreach($parts as $part) { ?>
                                        <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                    <?php } ?>  
                                </select>
                                <?php echo form_error('part_number', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            <div class="form-group col-lg-12">
                                <label for="wo_quantity">Cantidad a producir</label>
                                <input type="number" class="form-control" id="wo_quantity" name="wo_quantity" placeholder="Cantidad a producir" value="<?php echo set_value('wo_quantity'); ?>">
                                <?php echo form_error('wo_quantity', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="start_date">Hora de inicio de orden de trabajo</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo set_value('start_date'); ?>">
                                <?php echo form_error('start_date', '<div class="text-danger">', '</div>'); ?>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="end_date">Hora de finalización de orden de trabajo</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo set_value('end_date'); ?>">
                                <?php echo form_error('end_date', '<div class="text-danger">', '</div>'); ?>
                            </div>
                           


                            <div class="form-group col-lg-12" >
                                <label for="part_description">Notas de la orden</label>
                                <textarea type="text" class="form-control" id="notes" name="notes" rows="5" placeholder="Descripción"><?php echo set_value('notes'); ?></textarea>
                                <?php echo form_error('part_description', '<div class="text-danger">', '</div>'); ?>
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
                <h4>Hora por hora</h4>
                <div class="form-group" >
                    <div class="custom-file mt-5">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>