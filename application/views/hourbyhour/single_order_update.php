<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("parts") ?>">Hora por Hora</a>
            <span class="breadcrumb-item active">Capturar Orden De Trabajo <b class="text-primary"><?php echo $work_order['odoo_workorder']; ?></b></span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhour_clients/update_order/" . $work_order_id) ?>" method="post" enctype="multipart/form-data">

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
    <div class="col-lg-4">
        <div class="card" style="position: sticky; top: 0;">
            <div class="card-body">
                <h4>Información de la orden:</h4>
                <h4 class="mt-4">Orden: <span class="text-primary"><?php echo $work_order['odoo_workorder']; ?></span></h4>
                <h4 class="">Parte: <span class="text-primary"><?php echo $work_order['part_number']; ?></span></h4>
                <h4 class="">Operación: <span class="text-primary"><?php echo $work_order['operation_name']; ?></span></h4>
                <h4 class="">Estación:<span class="text-primary"> <?php echo $work_order['work_station_name']; ?></span></h4>
                <h4 class="">Fecha de planeacion:<span class="text-primary"> <?php echo date('d/m/Y', strtotime($work_order['start_date'])); ?></span></h4>
                <div class="m-t-25">

                    <!-- echo validation errors here -->
                    <?php echo validation_errors(); ?>

                    

                   
                        <div class="row">

                            
                           

                            <div class="form-group col-lg-12" >
                                <label for="part_description">Notas de la orden</label>
                                <textarea type="text" class="form-control" id="notes" name="notes" rows="5" placeholder="Descripción" disabled><?php echo $work_order['notes'] ?></textarea>
                                <?php echo form_error('notes', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            
                        

                            <div class="form-group col-lg-12" >
                                <button type="submit" name="save" class="btn btn-primary btn-block">Guardar</button>
                                <br><br/>
                                <a href="<?php echo base_url("production/end/" . $work_order_id) ?>" class="btn btn-success btn-block">Terminar</a>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4>Hora por hora</h4>
                <div class="" >
                    <div class=" mt-5">

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Hora</td>
                                    <td>Cantidad Planeada</td>
                                    <td>Cantidad Realizada</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $hours = 24;

                                $all_part_numbers = [];
                                for($i = 0; $i < $hours; $i++) {
                                    $hour = $i < 10 ? "0".$i : $i;
                                    $part_number = isset($hourbyhour[$hour."p"]) ? $hourbyhour[$hour."p"] : '';
                                    if ($part_number != '') {
                                        $all_part_numbers = array_merge($all_part_numbers, explode(' ', $part_number));
                                    }

                                    //filter out repeated part numbers
                                    //$all_part_numbers = array_unique($all_part_numbers);
                                }

                                $all_part_numbers = array_filter($all_part_numbers);
                                $all_part_numbers = array_unique($all_part_numbers);

                                for($i = 0; $i < $hours; $i++) :
                                    $hour = $i < 10 ? "0".$i : $i;
                                    $part_number = isset($hourbyhour[$hour."p"]) ? $hourbyhour[$hour."p"] : '';
                                    $quantity = isset($hourbyhour[$hour."h"]) ? $hourbyhour[$hour."h"] : '';
                                    $done = isset($hourbyhour[$hour."r"]) ? $hourbyhour[$hour."r"] : '';
                                ?>

                                    <tr id="id_<?php echo $hour ?>">
                                        <td><?php echo $hour . ":00 - " . ($hour+1) . ":00"; ?> </td>
                                        
                                        <td>
                                            <?php echo $quantity != '' ? $quantity : "<b style='color:red'>No planeado</b>"; ?>
                                           
                                        </td>
                                        
                                        <td>
                                            <input type="number" class="form-control" name="done_<?php echo $hour ?>"  placeholder="Cantidad Realizada" value="<?php echo $done; ?>">
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

<script>

//on click on button with id of end remove the disabled attribute.
document.getElementById("end").addEventListener("click", function() {
    alert("clicked")
    document.getElementById("end").removeAttribute("disabled");
});

</script>