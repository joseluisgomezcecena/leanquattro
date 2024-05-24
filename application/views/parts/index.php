<div class="page-header">
<h2 class="header-title">Numeros De Parte</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Numeros De Parte</a>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('parts/create') ?>" class="btn btn-primary">Nuevo Numero de parte</a>
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
                    <th>Numero de parte</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Ultima producción</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parts as $part):?>
                <tr>
                    <td><a href="<?php echo base_url('parts/' . $part['pn_id']) ?>"><?php echo $part['part_number']; ?></a></td>
                    <td><?php echo empty($part['part_description']) ? 'N/A' : $part['part_description']; //ternary operator to check if the address is empty.?></td>
                    <td>
                        <?php if (empty($part['part_image']) || !file_exists('uploads/products/' . $part['part_image']) || $part['part_image'] == 'noimage.jpg') {
                            echo '<img src="' . base_url('assets/images/default_images/noimage.jpg') .'" alt="part image" width="100" class="img-fluid">';
                        } else {
                            echo '<img src="'. base_url('uploads/products/' . $part['part_image']) .'" alt="part image" width="100" class="img-fluid">';
                        }
                        ?>
                    </td>
                    <td>
                        
                        <?php 
                        /* 
                            $last_production = $this->Productions_model->get_last_production_by_part($part['pn_id']);
                            if (empty($last_production)) {
                                echo 'N/A';
                            } else{
                            echo '<a href="'. base_url("productions/show/" . $last_production['production_id']) .'">' . $last_production['production_name'] . '</a> <br>Fecha: ' . date_format(date_create($last_production['created_at']), "M-d-Y");
                        }
                        */
                        echo "N/A";
                        ?>
                       
                    </td>
                    
                    
                    <td><?php echo date_format(date_create($part['created_at']), "M-d-Y H:i:s"); ?></td>
                    <td><?php echo date_format(date_create($part['updated_at']), "M-d-Y H:i:s"); ?></td>
                    <td>
                        <a href="<?php echo base_url('parts/update/' . $part['pn_id']) ?>" class="btn btn-dark">Editar</a>
                        <a href="<?php echo base_url('parts/delete/' . $part['pn_id']) ?>" class="btn btn-danger">Eliminar</a>
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