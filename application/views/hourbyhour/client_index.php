<div class="page-header">
<h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Estaciones de trabajo</a>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('workstations/create') ?>" class="btn btn-primary">Nueva estación de trabajo</a>
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



        <form class="form-inline mb-5" action="<?php echo base_url('hourbyhour_clients/index') ?>" method="post">
            <div class="form-group m-2">
                <select style="min-width:180px;" type="text" class="form-control" name="plant_id" id="plant_id" >
                    <option value="">Todas las plantas</option>
                    <?php foreach ($plants as $plant): ?>
                        <option value="<?php echo $plant['plant_id'] ?>"><?php echo $plant['plant_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group m-2">
                <select style="min-width:180px;" type="text" class="form-control" name="line_id" id="line_id" >
                    <option value="">Todas las lineas o celdas</option>
                </select>
            </div>
            
            
            <button type="submit" name="search" class="btn btn-primary m-2">Aplicar Filtro</button>
        </form>




        <table style="font-size:11px;" id="data-clients" class="table">
            <thead>
                <tr>
                    <th>Estación</th>
                    <th>Numero</th>
                    <th>Ubicación</th>
                    <th>Imagen</th>
                    <th>Piezas Planeadas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($workstations as $work_station):?>
                <tr>
                    <td><a href="<?php echo base_url('workstations/' . $work_station['work_station_id']) ?>"><?php echo $work_station['work_station_name']; ?></a></td>
                    <td><?php echo $work_station['work_station_number'] ?></td>
                    <td><?php echo $work_station['plant_name'] ?> - <?php echo $work_station['line_name'] ?></td>
                    <td>
                        <?php if (empty($work_station['work_station_image']) || !file_exists('uploads/workstations/' . $work_station['work_station_image']) || $work_station['work_station_image'] == 'noimage.jpg') {
                            echo '<img src="' . base_url('assets/images/default_images/noimage.jpg') .'" alt="part image" width="100" class="img-fluid">';
                        } else {
                            echo '<img src="'. base_url('uploads/workstations/' . $work_station['work_station_image']) .'" alt="part image" width="100" class="img-fluid">';
                        }
                        ?>
                    </td>
                    
                    
                    <td><?php echo $work_station['total_pieces'] ?></td>                    
                    <td>
                        <a href="<?php echo base_url('floor/hourbyhour/update/' . $work_station['wo_id']) ?>" class="btn btn-dark">Capturar</a>
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
                Solo se muestran centros de trabajo que tienen ordenes de trabajo asignadas para el dia de hoy.<br>
                Si no ve su centro de trabajo, por favor contacte a su supervisor.

                <br><br/>
                <input type="checkbox" id="dont-show-again">
                No volver a mostrar este mensaje.
               

            </div>
            <div class="modal-footer">
                <button style="color:black;" type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>