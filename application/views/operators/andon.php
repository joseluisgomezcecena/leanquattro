<?php if ($this->session->flashdata('success')) : ?>

<div id="toast" style="z-index:10000000" class="toast">
    <div class="alert bg-blue-600 text-white">
        <span>
            <?php echo $this->session->flashdata('success'); ?>
        </span>
    </div>
</div>

<?php endif; ?>


<section class="mb-6">
    <h2 class="text-gray-800 text-lg font-semibold mb-2">Invoices</h2>
    <div class="grid grid-cols-2 gap-6">
        <?php foreach($alerts as $alert): ?>
        <a href="<?php echo base_url('operator/andon/' . $alert['alert_id']) ?>">    
            <div class="p-4 bg-gray-100 rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105">
                <p class="text-sm font-medium"><?php echo $alert['alert_name']; ?></p>
                <p class="text-xs text-gray-600"><?php echo $alert['alert_description']; ?></p>
            </div>
        </a>
        <?php endforeach; ?>    
    </div>
</section>