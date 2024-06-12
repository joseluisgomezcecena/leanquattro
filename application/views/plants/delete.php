<div class="page-header">
    <h2 class="header-title">Eliminar Planta</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item " href="<?php echo base_url("plants") ?>">Plantas</a>
            <span class="breadcrumb-item active">Eliminar Planta</span>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4>Planta</h4>
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

            

            <form action="<?php echo base_url("plants/delete/" . $plant['plant_id']) ?>" method="post">
                <div class="row">
                    
                    <div class="form-group col-lg-6">
                        <label for="client_name">Nombre de la planta</label>
                        <input type="text" class="form-control" id="plant_name" name="plant_name" placeholder="Nombre de planta de producción" value="<?php echo $plant['plant_name']; ?>">
                        <?php echo form_error('plant_name', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-12" >
                        <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="hourbyhour-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mensaje de Quattro.</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                Se eliminara la planta seleccionada, esta acción no se puede deshacer ¿Desea continuar?
                
               

            </div>
            <div class="modal-footer">
                <button style="color:black;" type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                <a href="<?php echo base_url("plants") ?>" style="color:black;" type="button" class="btn btn-light" data-dismiss="modal">Regresar</a>
            </div>
        </div>
    </div>
</div>