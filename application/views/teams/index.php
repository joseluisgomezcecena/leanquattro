<div class="page-header">
    <h2 class="header-title">Equipos</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Equipos</a>
        </nav>
    </div>
    <!--button that floats to the right-->
    <div class="float-right">
        <a href="<?php echo base_url('teams/create') ?>" class="btn btn-primary">Nuevo Equipo</a>
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
                    <th>Equipo</th>
                    <th>Descripción</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team):?>
                <tr>
                    <td><a href="<?php echo base_url('teams/' . $team['team_id']) ?>"><?php echo $team['team_name']; ?></a></td>
                    <td><?php echo $team['team_description']; ?></td>
                    <td><?php echo date_format(date_create($team['created_at']), "M-d-Y H:i:s"); ?></td>
                    <td><?php echo date_format(date_create($team['updated_at']), "M-d-Y H:i:s"); ?></td>
                    <td>
                        <a href="<?php echo base_url('teams/update/' . $team['team_id']) ?>" class="btn btn-dark">Editar</a>
                        <a href="<?php echo base_url('teams/delete/' . $team['team_id']) ?>" class="btn btn-danger">Eliminar</a>
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