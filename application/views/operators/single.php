<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
    <div class="col-span-12">
        <div class="col-span-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Hay errores en el formulario.</strong>
                    <span class="block sm:inline">Por favor, corrígelos.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



<div class="col-span-12">
    <div class="card bg-white shadow-md rounded-lg">
        <div class="card-header bg-gray-100 p-4 rounded-t-lg">
            <h4 class="card-title text-xl font-semibold">Andon: <b style="color:#1d4ed8"><?php echo $alert['alert_name']; ?></b></h4>
        </div>
        <div class="card-body p-4">
            <p class="mb-5">Razón del andon: <?php echo $alert['alert_description']; ?></p>

            <form action="<?php echo base_url("operator/andon/" . $alert['alert_id']) ?>" method="post">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <!--select box for plants-->
                    <div class="form-group">
                        <label for="plant_id" class="block text-sm font-medium text-gray-700">Planta</label>
                        <select class="select select-bordered w-full max-w-xs" id="plant_id" name="plant_id">
                            <option value="">Selecciona una planta</option>
                            <?php foreach ($plants as $plant): ?>
                                <option value="<?php echo $plant['plant_id']; ?>" <?php echo set_select('plant_id', $plant['plant_id']); ?>><?php echo $plant['plant_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('plant_id', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                    </div>

                    <!--select box for production lines-->
                    <div class="form-group">
                        <label for="line_id" class="block text-sm font-medium text-gray-700">Linea de producción</label>
                        <select class="select select-bordered w-full max-w-xs" id="line_id" name="line_id">
                            <option value="">Selecciona una linea de producción</option>
                        </select>
                        <?php echo form_error('line_id', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                    </div>

                    <!--select box for work stations-->
                    <div class="form-group">
                        <label for="work_station_id" class="block text-sm font-medium text-gray-700">Estación de trabajo</label>
                        <select class="select select-bordered w-full max-w-xs" id="work_station_id" name="work_station_id">
                            <option value="">Selecciona una estación de trabajo</option>
                        </select>
                        <?php echo form_error('work_station_name', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                    </div>

                    <!--select box for subalerts-->
                    <div class="form-group col-span-1 lg:grid-cols-3 gap-4">
                        <label for="subalert" class="block text-sm font-medium text-gray-700">Sub Alerta</label>
                        <select class="select2 select select-bordered w-full max-w-xs" id="subalert" name="subalert">
                            <?php foreach ($subalerts as $subalert): ?>
                                <option value="<?php echo $subalert['child_id']; ?>" <?php echo set_select('subalert', $subalert['child_id']); ?>><?php echo $subalert['child_alert_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!--select box for parts-->
                    <div class="form-group col-span-1 lg:grid-cols-3 gap-4">
                        <label for="part" class="block text-sm font-medium text-gray-700">Numero de parte</label>
                        <select class="select2 select select-bordered w-full max-w-xs" id="part" name="part">
                            <?php foreach ($parts as $parte): ?>
                                <option value="<?php echo $parte['pn_id']; ?>" <?php echo set_select('parte', $parte['pn_id']); ?>><?php echo $parte['part_number']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-span-1 lg:col-span-3 mt-5">
                        <button class="btn btn-dark float-right  w-full lg:w-auto" type="submit">Pedir Soporte</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>