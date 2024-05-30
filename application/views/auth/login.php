<div style="height:89vh" class="row align-items-center w-100">
    <div class="col-md-8 col-lg-4 m-h-auto">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between m-b-30 text-center ">
                    <img style="display: block; margin: auto;" class="img-fluid" alt="logo" width="160" src="<?php echo base_url() ?>assets/images/default_images/leanquattro_logo.png">
                    <h2 class="m-b-0"></h2>
                </div>
                <form action="<?php echo base_url('auth/login') ?>" method="post" autocomplete="off">
                
                    <input style="opacity:0;" type="text" name="user_name">
                    <input style="opacity:0;" type="password" name="passwords">

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <?php echo validation_errors(); ?>


                    <div class="form-group">
                        <label class="font-weight-semibold" for="userName">Usuario:</label>
                        <input type="text" class="form-control" id="userName" name="username" placeholder="Username">
                    </div>
                   
                    <div class="form-group">
                        <label class="font-weight-semibold" for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                   
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between p-t-15">
                            <button style="color:#24f26c; font-weight:900" type="submit" class="btn btn-dark btn-lg btn-block">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>