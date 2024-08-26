<div class="page-header">
    <h2 class="header-title">Eliminar Linea De Producción</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Lineas De Producción</a>
            <span class="breadcrumb-item active">Eliminar Linea De Producción</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("productionlines/delete/" . $line['line_id']) ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4>Linea De Producción</h4>
                <div class="m-t-25">

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

                    

                   
                        <div class="row">

                            <div class="form-group col-lg-6 m-b-15">
                                <label for="workorder_number">Planta</label>
                                <select class="select2" name="plant_id" disabled>
                                    <option value="">Seleccionar Estación de trabajo</option>
                                    <?php foreach($plants as $plant) { ?>
                                        <option <?php if($line['plant_id'] == $plant['plant_id']){echo "selected";}else{echo "";} ?> value="<?php echo $plant['plant_id']; ?>"><?php echo $plant['plant_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="line_name">Nombre de la linea de producción</label>
                                <input type="text" class="form-control" id="line_name" name="line_name" placeholder="Nombre de la linea de producción" value="<?php echo $line['line_name']; ?>" disabled>
                                <?php echo form_error('line_name', '<div class="text-danger">', '</div>'); ?>
                            </div>
                            
                        
                        

                            <div class="form-group col-lg-12" >
                                <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
</div>

</form>