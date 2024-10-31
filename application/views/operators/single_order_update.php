<div class="page-header mb-4">
    <h2 class="header-title text-2xl font-bold">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <span class="breadcrumb-item active"><b>Orden De Trabajo</b> <b class="text-primary"><?php echo $work_order['odoo_workorder']; ?></b></span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhour_clients/update_order/" . $work_order_id) ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="work_order" value="<?php echo $work_order_id ?>">

<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
    <div class="col-span-1 lg:col-span-4 mt-14">
        <div class="card sticky top-0 border rounded-lg shadow-md">
            <div class="card-body">
                <h4 class="text-lg font-semibold">Información de la orden:</h4>
                <h4 class="mt-4">Orden: <span class="text-primary"><?php echo $work_order['odoo_workorder']; ?></span></h4>
                <h4 class="">Parte: <span class="text-primary"><?php echo $work_order['part_number']; ?></span></h4>
                <h4 class="">Operación: <span class="text-primary"><?php echo $work_order['operation_name']; ?></span></h4>
                <h4 class="">Estación:<span class="text-primary"> <?php echo $work_order['work_station_name']; ?></span></h4>
                <h4 class="">Fecha de planeacion:<span class="text-primary"> <?php echo date('d/m/Y', strtotime($work_order['start_date'])); ?></span></h4>
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
                            <button type="submit" name="save" class="btn btn-primary w-full">Guardar</button>
                            <br><br/>
                            <a href="<?php echo base_url("production/end/" . $work_order_id) ?>" class="btn btn-success w-full">Terminar</a>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-1 lg:col-span-8">
        <div class="card  ">
            <div class="card-body">
                <h4 class="text-lg font-semibold"></h4>
                <div class="mt-5">
                    <table class="table w-full rounded-lg shadow-md">
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