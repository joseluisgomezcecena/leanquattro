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
        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-dark dark:hover:text-blue-600">Hora x Hora</a>
      </div>
    </li>
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-blue-600"><?php echo $work_order['odoo_workorder']; ?></span>
      </div>
    </li>
  </ol>
</nav>


<form action="<?php echo base_url("operator/hourbyhour/" . $work_order_id) ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="work_order" value="<?php echo $work_order_id ?>">

<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
    <div class="col-span-1 lg:col-span-4 mt-14">
        <div class="card sticky top-0 border rounded-lg shadow-md">
            <div class="card-body">
                <!--
                <h4 class="text-lg font-semibold">Información de la orden:</h4>
-->
                <h4 class="mt-4">Orden: <span class="text-blue-700"><?php echo $work_order['odoo_workorder']; ?></span></h4>
                <h4 class="">Parte: <span class="text-blue-700"><?php echo $work_order['part_number']; ?></span></h4>
                <h4 class="">Operación: <span class="text-blue-700"><?php echo $work_order['operation_name']; ?></span></h4>
                <h4 class="">Estación:<span class="text-blue-700"> <?php echo $work_order['work_station_name']; ?></span></h4>
                <h4 class="">Fecha de planeacion:<span class="text-blue-700"> <?php echo date('d/m/Y', strtotime($work_order['start_date'])); ?></span></h4>
                <div class="mt-6">

                    <!-- echo validation errors here -->
                    <?php echo validation_errors(); ?>

                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="part_description">Notas de la orden</label>
                            <textarea type="text" class="form-control textarea textarea-bordered w-full" id="notes" name="notes" rows="5" placeholder="Descripción" disabled><?php echo $work_order['notes'] ?></textarea>
                            <?php echo form_error('notes', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-lg-12 mt-4">
                            <button type="submit" name="save" class="btn btn-dark w-full">Guardar</button>
                            <br><br/>
                            <a href="<?php echo base_url("production/end/" . $work_order_id) ?>" class="btn bg-blue-700 hover:bg-indigo-900  w-full">Terminar</a>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-1 lg:col-span-8">
        <div class="card overflow-x-auto  ">
            <div class="card-body">
                <h4 class="text-lg font-semibold"></h4>
                <div class="mt-5">
                    <table class="table w-full rounded-lg shadow-md table-pin-rows">
                        <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Cantidad Planeada</th>
                                <th>Cantidad Realizada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $hours = 24;

                            $all_part_numbers = [];
                            for($i = 0; $i < $hours; $i++) {
                                $hour = $i < 10 ? "0".$i : $i;
                                $part_number = isset($hourbyhour[$hour."p"]) ? $hourbyhour[$hour."p"] : '';
                                if ($part_number != '') {
                                    $all_part_numbers = array_merge($all_part_numbers, explode(' ', $part_number));
                                }

                                //filter out repeated part numbers
                                //$all_part_numbers = array_unique($all_part_numbers);
                            }

                            $all_part_numbers = array_filter($all_part_numbers);
                            $all_part_numbers = array_unique($all_part_numbers);

                            for($i = 0; $i < $hours; $i++) :
                                $hour = $i < 10 ? "0".$i : $i;
                                $part_number = isset($hourbyhour[$hour."p"]) ? $hourbyhour[$hour."p"] : '';
                                $quantity = isset($hourbyhour[$hour."h"]) ? $hourbyhour[$hour."h"] : '';
                                $done = isset($hourbyhour[$hour."r"]) ? $hourbyhour[$hour."r"] : '';
                            ?>

                                <tr id="id_<?php echo $hour ?>">
                                    <td><?php echo $hour . ":00 - " . ($hour+1) . ":00"; ?> </td>
                                    
                                    <td>
                                        <?php echo $quantity != '' ? $quantity : "<b style='color:red'>No planeado</b>"; ?>
                                    </td>
                                    
                                    <td>
                                        <input type="number" class="form-control input input-bordered w-full" name="done_<?php echo $hour ?>"  placeholder="Cantidad Realizada" value="<?php echo $done; ?>">
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
<script>

//on click on button with id of end remove the disabled attribute.
document.getElementById("end").addEventListener("click", function() {
    alert("clicked")
    document.getElementById("end").removeAttribute("disabled");
});

</script>