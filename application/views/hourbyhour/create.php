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

<form action="<?php echo base_url("hourbyhour/create") ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4>Orden de trabajo</h4>
                <div class="m-t-25">

                    <!-- echo validation errors here -->
                    <?php echo validation_errors(); ?>


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

                            <div class="form-group col-lg-12 m-b-15">
                                <label for="workorder_number">Estación de trabajo</label>
                                <select class="select2" name="wo_workstation" required>
                                    <option value="">Seleccionar Estación de trabajo</option>
                                    <?php foreach($workstations as $workstation) { ?>
                                        <option value="<?php echo $workstation['work_station_id']; ?>"><?php echo $workstation['work_station_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('wo_workstation', '<div class="text-danger">', '</div>'); ?>
                            </div>
                            
                           

                            <div class="form-group col-lg-12">
                                <label for="start_date">Fecha de inicio </label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo set_value('start_date'); ?>">
                                <?php echo form_error('start_date', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            <div class="form-group col-lg-12" >
                                <label for="part_description">Notas de la orden</label>
                                <textarea type="text" class="form-control" id="notes" name="notes" rows="5" placeholder="Descripción"><?php echo set_value('notes'); ?></textarea>
                                <?php echo form_error('notes', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            
                        

                            <div class="form-group col-lg-6" >
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card" style="position: sticky; top: 0;">
            <div class="card-body">
                <h4>Hora por hora</h4>
                <div class="" >
                    <div class=" mt-5">

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Numero de parte</td>
                                    <td>Hora</td>
                                    <td>Cantidad</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                                //counter for the number of rows according to the number of hours the format is 24 hours.
                                $hours = 24;
                                for($i = 0; $i < $hours; $i++) :
                                    $hour = $i < 10 ? "0".$i.":00" : $i.":00";
                                    $next_hour = $i < 10 ? "0".($i+1).":00" : ($i+1).":00";
                                    $single_number = $i < 10 ? "0".$i : $i;
                                ?>

                                    <tr id="id_<?php echo $single_number ?>">
                                        <td><?php echo $hour . " - " . $next_hour; ?> </td>
                                        
                                        <td>
                                            <select class="select2"  name="part_number_<?php echo $single_number ?>" >
                                                <option value="">Seleccionar Numero de Parte</option>
                                                <?php foreach($parts as $part) { ?>
                                                    <option value="<?php echo $part['part_number']; ?>"><?php echo $part['part_number']; ?></option>
                                                <?php } ?>  
                                            </select>
                                        </td>
                                        
                                        <td>
                                            <input type="number" class="form-control" name="quantity_<?php echo $single_number ?>" placeholder="Cantidad">
                                        </td>
                                    </tr>

                                <?php endfor; ?>
                               
                                
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>