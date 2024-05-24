<div class="page-header">
<h2 class="header-title">Estaciones de trabajo</h2>
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

        <table style="font-size:11px;" id="data-clients" class="table">
            <thead>
                <tr>
                    <th>Estación</th>
                    <th>Numero</th>
                    <th>Ubicación</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($work_stations as $work_station):?>
                <tr>
                    <td><a href="<?php echo base_url('workstations/' . $work_station['work_station_id']) ?>"><?php echo $work_station['work_station_name']; ?></a></td>
                    <td><?php echo $work_station['work_station_number'] ?></td>
                    <td><?php echo $work_station['plant_name'] ?> - <?php echo $work_station['line_name'] ?></td>
                    <td><?php echo empty($work_station['work_station_description']) ? 'N/A' : $work_station['work_station_description']; //ternary operator to check if the address is empty.?></td>
                    <td>
                        <?php if (empty($work_station['work_station_image']) || !file_exists('uploads/workstations/' . $work_station['work_station_image']) || $work_station['work_station_image'] == 'noimage.jpg') {
                            echo '<img src="' . base_url('assets/images/default_images/noimage.jpg') .'" alt="part image" width="100" class="img-fluid">';
                        } else {
                            echo '<img src="'. base_url('uploads/workstations/' . $work_station['work_station_image']) .'" alt="part image" width="100" class="img-fluid">';
                        }
                        ?>
                    </td>
                    
                    
                    
                    <td><?php echo date_format(date_create($work_station['created_at']), "M-d-Y H:i:s"); ?></td>
                    <td><?php echo date_format(date_create($work_station['updated_at']), "M-d-Y H:i:s"); ?></td>
                    
                    <td>
                        <a href="<?php echo base_url('workstations/update/' . $work_station['work_station_id']) ?>" class="btn btn-dark">Editar</a>
                        <a href="<?php echo base_url('workstations/delete/' . $work_station['work_station_id']) ?>" class="btn btn-danger">Eliminar</a>
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