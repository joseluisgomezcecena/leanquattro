<div class="page-header">
    <h2 class="header-title">Panel de control</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Panel de control</a>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url() ?>" class="btn btn-primary">Cambiar Vista</a>
    </div>
</div>
<div class="card mt-5">
    <div class="card-body">

        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <table style="font-size:12px; width: 100%" id="data-tables" class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Estación de trabajo</th>
                    <th>Plan vs Real</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($active_workorders as $active_order):?>
                <tr>
                    <td>
                        <a href="<?php echo base_url('work_order/' . $active_order['wo_id']) ?>">
                            <?php if($active_order['odoo_workorder'] != null && $active_order['odoo_workorder'] != ""): ?>
                                <span class="badge badge-primary">Odoo</span>
                                <?php echo $active_order['odoo_workorder']; ?><br/>
                                <span class="badge badge-success">Local</span>
                                <?php echo $active_order['wo_id']; ?>
                            <?php else: ?>
                                <span class="badge badge-success">Local</span>
                                <?php echo $active_order['wo_id']; ?>
                            <?php endif; ?>    
                        </a>
                    </td>
                    
                    <td>
                        <?php echo $active_order['work_station_name']; ?>
                    </td>

                    <td>
                        <?php
                            $data = $controller->get_hourbyhour_data($active_order['wo_id']);
                            echo $data['planned'] . ' / ' . $data['done'];
                        ?>
                    </td>

                    <td>
                        
                    </td>

                    <td><?php echo date_format(date_create($active_order['created_at']), "M-d-Y H:i:s"); ?></td>
                    <td><?php echo date_format(date_create($active_order['updated_at']), "M-d-Y H:i:s"); ?></td>
                    
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