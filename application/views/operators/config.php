<?php if ($this->session->flashdata('success')) : ?>

    <div id="toast" style="z-index:10000000" class="toast">
        <div class="alert bg-blue-600 text-white">
            <span>
                <?php echo $this->session->flashdata('success'); ?>
            </span>
        </div>
    </div>

<?php endif; ?>



<!-- Breadcrumb bg-gray-50 dark:bg-gray-800 border border-gray-200-->
<nav class="mt-5 mb-10 flex px-5 py-3 text-dark  rounded-lg  dark:border-gray-700 max-sm:hidden" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
    <li class="inline-flex items-center">
      <a href="#" class="inline-flex items-center text-sm font-medium text-gray-900 hover:text-blue-600 dark:text-gray-900 dark:hover:text-blue-600">
        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
        </svg>
        Nexus Quattro
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-dark dark:hover:text-blue-600">Configuración</a>
      </div>
    </li>
  </ol>
</nav>

<form action="<?php echo base_url("operator/config/") ?>" method="post" enctype="multipart/form-data">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
    <div class="col-span-1 lg:col-span-4 mt-14">
        <div class="card sticky top-0 border rounded-lg shadow-md">
            <div class="card-body">
       
                <div class="mt-6">

                    <!-- echo validation errors here -->
                    <b class="text-red"><?php echo validation_errors(); ?></b>

                    <?php
                    echo "session: " .  $this->session->userdata('device_id');
                    ?>

                    <div class="row">
                        <div class="form-group col-lg-12">
                            <p class="text-sm font-medium">Dispositivo de captura</p>                            
                            <select name="device_id" id="device_id" class="form-control input input-bordered w-full mt-5 mb-5">
                                <option value="">Selecciona el Dispositivo</option>
                                <?php foreach ($devices as $device) : ?>
                                    <option <?php if ($this->session->userdata('device_id') == $device['device_id'] ){echo "selected";}else{echo "";} ?> value="<?php echo $device['device_id'] ?>">
                                        <?php echo $device['device_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('device_id', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-lg-12 mt-4">
                            <button type="submit" name="save" class="btn btn-dark float-right">Guardar</button>
                            </div>
                        </div>    
                </div>
            </div>
        </div>
    </div>
   
</div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deviceId = "<?php echo $this->session->userdata('device_id'); ?>";
        if (deviceId) {
            localStorage.setItem('device_id', deviceId);
        }
        //alert("hola");
        //alert(localStorage.getItem('device_id'));
    });
</script>