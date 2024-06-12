<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="#">Aplicaciones</a>
        </nav>
    </div>
    <!--button that floats to the right-->
</div>


<div class="row">

    <div class="col-md-6 col-lg-6">
        <a href="<?php echo base_url("workorders/hourbyhour/create") ?>">
        <div style="min-height:150px; vertical-align:middle;" class="card card-hover">
            <div style="background-color: #262A36" class="card-body">
                <div class="media align-items-center">
                    <div style="background-image: linear-gradient(to right, #262A36 , #262A36);color:black;"  class="avatar avatar-icon avatar-lg ">
                        <i style="color:#24c770" class="anticon anticon-file-add"></i>
                    </div>
                    <div class="m-l-15">
                    <h5 style="color: white;" class="m-b-0 font-weight-bolder">Planeación</h5>
                        <p class="m-b-0 text-muted">Planear ordenes a producir.</p>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-6">
        <a href="<?php echo base_url("floor/hourbyhour") ?>">
        <div style="min-height:150px;" class="card card-hover">
            <div style="background-color: #262A36" class="card-body">
                <div class="media align-items-center">
                    <div style="background-image: linear-gradient(to right, #262A36 , #262A36);color:black;"  class="avatar avatar-icon avatar-lg ">
                        <i style="color:#24c770" class="anticon anticon-edit"></i>
                    </div>
                    <div class="m-l-15">
                    <h5 style="color: white;" class="m-b-0 font-weight-bolder">Capturar Avance</h5>
                        <p class="m-b-0 text-muted">Capturar el avance de las ordenes.</p>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    
</div>

