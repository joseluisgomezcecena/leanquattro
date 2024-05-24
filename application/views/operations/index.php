<div class="page-header">
    <h2 class="header-title">Procesos / Operaciones</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Procesos</a>
            <span class="breadcrumb-item active">Indexar</span>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('operations/create') ?>" class="btn btn-primary">Nueva Operación</a>
    </div>
</div>
<div class="card mt-5">
    <div class="card-body">

        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <table style="font-size:12px; width:100%" id="data-tables" class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Proceso / Operación</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Registro</th>
                    <th style="width:200px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($operations as $operation):?>
                <tr>
                    <td style="width:50px;"><?php echo $operation['operation_id'] ?></td>
                    <td><a href="<?php echo base_url('operations/' . $operation['operation_id']) ?>"><?php echo $operation['operation_name']; ?></a></td>
                    <td><?php echo date_format(date_create($operation['created_at']), "M-d-Y H:i:s"); ?></td>
                    <td><?php echo date_format(date_create($operation['updated_at']), "M-d-Y H:i:s"); ?></td>
                    <td><?php echo $operation['operation_user']; ?></td>
                    <td>
                        <a href="<?php echo base_url('operations/update/' . $operation['operation_id']) ?>" class="btn btn-dark">Editar</a>
                        <a href="<?php echo base_url('operations/delete/' . $operation['operation_id']) ?>" class="btn btn-danger">Eliminar</a>
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