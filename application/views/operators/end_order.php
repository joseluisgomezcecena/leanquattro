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
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-dark dark:hover:text-blue-600">Hora x Hora</a>
      </div>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-blue-600">WH/MO/00116</span>
      </div>
    </li>
  </ol>
</nav>

<form action="<?php echo base_url("operator/hourbyhour/end/" . $work_order_id) ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="work_order" value="<?php echo $work_order_id ?>">

<div class="grid grid-cols-1 gap-4">
    <div class="col-span-1">
        
      

        <?php if ($this->session->flashdata('error')) : ?>
            <div id="error-alert" class="alert alert-error px-5 mb-2 mt-3">
                <div class="flex-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
                </div>
                <div class="flex-1">
                    <label>
                        <?php echo $this->session->flashdata('error'); ?>
                    </label>
                </div>
            </div>
        <?php endif; ?>



    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
    <div class="col-span-12">
        <div class="card bg-white shadow-md rounded-lg sticky top-0 border">
            <div class="card-body p-4">
                <h3 class="text-lg font-semibold">Información de la orden:</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <h3 class="mt-4">Orden: <span class="text-primary"><?php echo $work_order['odoo_workorder']; ?></span></h3>
                        <p class="">Parte: <span class="text-primary"><?php echo $work_order['part_number']; ?></span></p>
                        <p class="">Operación: <span class="text-primary"><?php echo $work_order['operation_name']; ?></span></p>
                        <p class="">Estación:<span class="text-primary"> <?php echo $work_order['work_station_name']; ?></span></p>
                    </div>
                    <div>
                        <p class="">Fecha de planeacion:<span class="text-primary"> <?php echo date('d/m/Y', strtotime($work_order['start_date'])); ?></span></p>
                        <div class="form-group">
                            <label for="part_description">Notas de la orden</label>
                            <textarea type="text" class="form-control textarea textarea-bordered w-full" id="notes" name="notes" rows="5" placeholder="Descripción" disabled><?php echo $work_order['notes'] ?></textarea>
                            <?php echo form_error('notes', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">

                    <!-- echo validation errors here -->
                    <?php echo validation_errors(); ?>

                    <div class="grid grid-cols-1 gap-4">

                        <div class="form-group">
                            <label for="scan">Escanea la orden</label>
                            <input type="text" name="order_number" id="order" class="form-control input input-bordered w-full" />
                        </div>

                        <div class="form-group flex justify-between">
                            <button type="submit" name="end" class="btn btn-primary">Terminar</button>
                            <a href="<?php echo base_url("production/single/" . $work_order_id) ?>" class="btn btn-dark">Cancelar</a>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

</form>

<script>
    
    //on page load focus on the input field
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('order').focus();
    });


    document.addEventListener('DOMContentLoaded', function() {
        const orderInput = document.getElementById('order');
        let typingTimer;
        const typingInterval = 500; // 1.5 seconds

        // Prevent pasting into the input field
        orderInput.addEventListener('paste', function(event) {
            event.preventDefault();
        });

        // Handle input event
        orderInput.addEventListener('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                // Clear the input field if not filled within 1.5 seconds
                orderInput.value = '';
            }, typingInterval);
        });
    });
    
</script>