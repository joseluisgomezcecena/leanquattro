<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("parts") ?>">Hora por Hora</a>
            <span class="breadcrumb-item active">Cancelar Orden De Trabajo</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhour/cancel/" . $work_order_id) ?>" method="post">

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
        <div class="card">
            <div class="card-body">
                <h4>Orden de trabajo a cancelar</h4>
                <button type="submit" name="cancel" class="btn btn-dark">Cancelar</button>
                <div class="m-t-25">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Se cancelara la orden de trabajo  para la estación de trabajo: <b> <?php echo $work_order['work_station_name']; ?></b> </p>
                                <p>con fecha de inicio: <b> <?php echo date('d-m-Y', strtotime($work_order['start_date'])); ?></b> </p>
                                <p>con las siguientes notas: <b><br> 
                                <?php
                                    if($work_order['notes'] == ''){
                                        echo "Sin notas";
                                    }else{
                                        echo $work_order['notes'];
                                    } 
                                ?>
                                  </b></p>
                            </div>

                            <div class="col-lg-12">
                                <h3>Detalles de la orden</h3>
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
                                        $hours = 24;
                                        for($i = 0; $i < $hours; $i++) :
                                            $hour = $i < 10 ? "0".$i : $i;
                                            $part_number = isset($hourbyhour[$hour."p"]) ? $hourbyhour[$hour."p"] : '';
                                            $quantity = isset($hourbyhour[$hour."h"]) ? $hourbyhour[$hour."h"] : '';
                                        ?>
                                            <tr id="id_<?php echo $hour ?>">
                                                <td><?php echo $hour . ":00 - " . ($hour+1) . ":00"; ?> </td>
                                                
                                                <td>
                                                    <select class="select2"  name="part_number_<?php echo $hour ?>" disabled>
                                                        <option value="">Seleccionar Numero de Parte</option>
                                                        <?php foreach($parts as $part) { ?>
                                                            <option value="<?php echo $part['part_number']; ?>" <?php echo $part['part_number'] == $part_number ? 'selected' : ''; ?>><?php echo $part['part_number']; ?></option>
                                                        <?php } ?>  
                                                    </select>
                                                </td>
                                                
                                                <td>
                                                    <input type="number" class="form-control" name="quantity_<?php echo $hour ?>"  placeholder="Cantidad" value="<?php echo $quantity; ?>" disabled>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                        

                            </div>


                        </div>    
                </div>
            </div><!-- card-body end -->
        </div>
    </div>
    
</div>

</form>



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
                Al cancelar la orden de trabajo de hora por hora esta quedara registrada en la base de datos, si deseas eliminar
                el registro debes seleccionar la opción de eliminar, puedes cambiar el estatus de cancelada en cualquier momento.
                <br><br/>

            </div>
            <div class="modal-footer">
                <button style="color:black;" type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>