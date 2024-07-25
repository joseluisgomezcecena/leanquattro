<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $alert['alert_name']; ?></h4>
        </div>
        <div class="card-body">
            <p><?php echo $alert['alert_description']; ?></p>

            <form action="<?php echo base_url("andons/create/" . $alert['alert_id']) ?>" method="post">

                <div class="row">
                    <!--select box for plants-->
                    <div class="form-group col-lg-4">
                        <label for="plant_id">Planta</label>
                        <select class="form-control" id="plant_id" name="plant_id">
                            <option value="">Selecciona una planta</option>
                            <?php foreach ($plants as $plant): ?>
                                <option value="<?php echo $plant['plant_id']; ?>" <?php echo set_select('plant_id', $plant['plant_id']); ?>><?php echo $plant['plant_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('plant_id', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <!--select box for production lines-->
                    <div class="form-group col-lg-4">
                        <label for="line_id">Linea de producción</label>
                        <select class="form-control" id="line_id" name="line_id">
                            <option value="">Selecciona una linea de producción</option>
                        </select>
                        <?php echo form_error('line_id', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-4">
                        <label for="part_number">Estación de trabajo</label>
                        <select class="form-control" id="work_station_id" name="work_station_id">
                            <option value="">Selecciona una estación de trabajo</option>
                        </select>
                        <?php echo form_error('work_station_name', '<div class="text-danger">', '</div>'); ?>
                    </div>


                    <div class="form-group col-lg-6">
                        <label for="subalert">Sub Alerta</label>
                        <select class="select2" id="subalert" name="subalert">
                            <?php foreach ($subalerts as $subalert): ?>
                                <option value="<?php echo $subalert['child_id']; ?>" <?php echo set_select('subalert', $subalert['child_id']); ?>><?php echo $subalert['child_alert_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-lg-6">
                        <label for="parte">Numero de parte</label>
                        <select class="select2" id="parte" name="parte">
                            <?php foreach ($parts as $parte): ?>
                                <option value="<?php echo $parte['pn_id']; ?>" <?php echo set_select('parte', $parte['pn_id']); ?>><?php echo $parte['part_number']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group col-lg-12 mt-5">
                        <button class="btn btn-success float-right btn-lg" type="submit">Pedir Soporte</button>
                    </div>

                </div>

                


            </form>


        </div>
    </div>
</div>