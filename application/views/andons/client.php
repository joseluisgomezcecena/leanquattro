<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>



<div class="row">
    <?php foreach($alerts as $alert): ?>
    <div class="col-lg-6">
        <a href="<?php echo base_url('andon/client/' . $alert['alert_id']) ?>">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $alert['alert_name']; ?></h4>
                </div>
                <div class="card-body">
                    <p><?php echo $alert['alert_description']; ?></p>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
