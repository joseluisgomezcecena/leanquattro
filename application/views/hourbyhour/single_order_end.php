<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("parts") ?>">Hora por Hora</a>
            <span class="breadcrumb-item active">Terminar Orden De Trabajo <b class="text-primary"><?php echo $work_order['odoo_workorder']; ?></b></span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhour_clients/end_order/" . $work_order_id) ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="work_order" value="<?php echo $work_order_id ?>">

<div class="row">
    <div class="col-lg-12">
        
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


    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="position: sticky; top: 0;">
            <div class="card-body">
                <h3>Información de la orden:</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mt-4">Orden: <span class="text-primary"><?php echo $work_order['odoo_workorder']; ?></span></h4>
                        <p class="">Parte: <span class="text-primary"><?php echo $work_order['part_number']; ?></span></p>
                        <p class="">Operación: <span class="text-primary"><?php echo $work_order['operation_name']; ?></span></p>
                        <p class="">Estación:<span class="text-primary"> <?php echo $work_order['work_station_name']; ?></span></p>
                    </div>
                    <div class="col-lg-6">
                       
                        <p class="">Fecha de planeacion:<span class="text-primary"> <?php echo date('d/m/Y', strtotime($work_order['start_date'])); ?></span></p>
                            <div class="form-group " >
                                <label for="part_description">Notas de la orden</label>
                                <textarea type="text" class="form-control" id="notes" name="notes" rows="5" placeholder="Descripción" disabled><?php echo $work_order['notes'] ?></textarea>
                                <?php echo form_error('notes', '<div class="text-danger">', '</div>'); ?>
                            </div>
                    </div>
                </div>
                
                <div class="m-t-25">

                    <!-- echo validation errors here -->
                    <?php echo validation_errors(); ?>

                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label for="scan">Escanea la orden</label>
                                <input type="text" name="order_number" id="order" class="form-control" />
                            </div>
                                                   

                            <div class="form-group col-lg-12" >
                                <button type="submit" name="end" class="btn btn-primary  float-left">Terminar</button>
                                <a href="<?php echo base_url("production/single/" . $work_order_id) ?>" class="float-right btn btn-dark ">Cancelar</a>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
</div>

</form>

<script>
    /*
    document.addEventListener('DOMContentLoaded', function() {
        const orderInput = document.getElementById('order');
        let typingTimer;
        const typingInterval = 500; // 1.5 seconds

        // Prevent pasting into the input field
        orderInput.addEventListener('paste', function(event) {
            event.preventDefault();
        });

        // Handle input event
        orderInput.addEventListener('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                // Clear the input field if not filled within 1.5 seconds
                orderInput.value = '';
            }, typingInterval);
        });
    });
    */
</script>