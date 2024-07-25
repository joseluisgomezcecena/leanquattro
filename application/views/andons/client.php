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
