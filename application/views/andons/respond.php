<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12">

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>


            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Hay errores en el formulario. Por favor, corrígelos.
                </div>
            <?php endif; ?>


        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $andon['child_alert_name']; ?> en:  <?php echo $andon['line_name'] . ", <b>" . $andon['work_station_name'] . "</b>" ?></h4>
        </div>
        <div class="card-body">
            

            <form action="<?php echo base_url("andons/respond/" . $andon['id_andon']) ?>" method="post">
                <div class="row">
                
                    <div class="form-group col-lg-12 mt-5">
                        <strong>Se reporto el siguiente paro: <?php echo $andon['child_alert_name']; ?> en la linea:  <?php echo $andon['line_name'] . ", en la estación: <b>" . $andon['work_station_name'] . "</b>" ?></strong>
                    </div>

                    <div class="form-group col-lg-12 mt-5 text-center" >
                        <h1 id="counter"></h1>
                    </div>

                    <div class="form-group col-lg-12 mt-5">
                        <label for="service_comment">Comentario</label>
                        <textarea class="form-control" name="service_comment" id="service_comment" rows="5" required></textarea>
                    </div>
                
                    <div class="form-group col-lg-12 mt-5">
                        <button class="btn btn-success float-right btn-lg" name="respond" type="submit">Responder</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    (function() {
        const createdAt = new Date("<?php echo $andon['created_at']; ?>");
        const counterId = "counter";

        function updateCounter() {
            const now = new Date();
            const diff = now - createdAt;

            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById(counterId).innerText = 
                `${hours} horas, ${minutes} mins, ${seconds} segs`;
        }

        // Update the counter every second
        setInterval(updateCounter, 1000);

        // Initial call to display the counter immediately
        updateCounter();
    })();
</script>