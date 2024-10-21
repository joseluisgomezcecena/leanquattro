<div class="page-header">
<h2 class="header-title">Planeación</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Hora por Hora</a>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('workorders/hourbyhour/create') ?>" class="btn btn-primary">Planear Orden</a>
    </div>
</div>
<div class="card mt-5">
    <div class="card-body">

        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>




        <table style="font-size:11px;" id="data-orders-planning" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Orden de trabajo</th>
                    <th>Operación</th>
                    <th>Qty</th>
                    <th>Estación</th>
                    <th>Parte</th>
                    <th>Ubicación</th>
                    <th>Planeada</th>
                    <th>Piezas Planeadas</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($workstations as $work_station):?>
                <tr>
                    <td>ID-<?php echo $work_station['wo_id']; ?></td>

                    <td><?php echo $work_station['odoo_workorder']; ?></td>

                    <td><?php echo $work_station['odoo_operation']; ?></td>
                    
                    <td><a href="<?php echo base_url('workstations/' . $work_station['work_station_id']) ?>"><?php echo $work_station['work_station_name']; ?></a></td>
                    
                    <td><?php echo $work_station['work_station_number'] ?></td>
                    
                    <td><?php echo $work_station['part_number'] ?> </td>

                    <td><?php echo $work_station['plant_name'] ?> - <?php echo $work_station['line_name'] ?></td>
                    
                    <td>
                        <?php 
                        //start date
                        echo date('d/m/Y', strtotime($work_station['start_date']));
                        ?>
                    </td>
                    
                   
                 
                    <td><?php echo $work_station['total_pieces'] ?></td>
                    
                    <td>
                        <?php
                         switch ($work_station['status']) 
                         {
                             case 1:
                                 $status = '<span class="badge badge-primary">Registrada</span>';
                                 break;
                             case 2:
                                 $status = '<span class="badge badge-success">Activa</span>';
                                 break;
                            case 3:
                                $status = '<span class="badge badge-success">Terminada</span>';
                                break;
                            case 4:
                                $status = '<span class="badge badge-warning">Hold</span>';
                                break;
                             case 5:
                                 $status = '<span class="badge badge-danger">Cancelada</span>';
                                 break;
                             default:
                                 $status = '<span class="badge badge-warning">Pendiente</span>';
                                 break;
                         }
                         echo $status; 
                         
                         ?>
                    </td>
                    
                    <td>
                        <?php if($work_station['status'] == 5 || $work_station['status'] == 3): ?>
                            <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Esta orden no puede ser actualizada." disabled>Actualizar</a>
                        <?php else: ?>
                            <a href="<?php echo base_url('workorders/hourbyhour/update/' . $work_station['wo_id']) ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Puedes actualizar la orden de trabajo en el transcurso del dia, si la orden en marcada como terminada no podras planear mas piezas.">Actualizar</a>
                        <?php endif; ?>
                        
                        <?php if($work_station['status'] == 1 || $work_station['status'] == 2 || $work_station['status'] == 4 ): ?>
                            <a href="<?php echo base_url('workorders/hourbyhour/cancel/' . $work_station['wo_id']) ?>" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Cancelar unar orden no la elimina de la base de datos. Esta orden puede ser activada de nuevo.">Cancelar</a>
                        <?php 
                        elseif($work_station['status'] == 5): ?>
                            <a href="<?php echo base_url('workorders/hourbyhour/activate/' . $work_station['wo_id']) ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Activar una orden cancelada la pone en estado activa de nuevo.">Activar</a>
                        <?php endif; ?>


                        <a href="<?php echo base_url('workorders/hourbyhour/delete/' . $work_station['wo_id']) ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar una orden la cancela y borra de la base de datos todo el avance si es que lo hay, esta acción no se puede deshacer.">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><a style="font-weight:lighter;" href="#">Lista imprimible</a></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

