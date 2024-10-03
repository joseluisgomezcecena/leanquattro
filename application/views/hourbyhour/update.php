<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/socketio/socket_io_v2.js"></script>

<div class="page-header">
    <h2 class="header-title">Hora por Hora</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Inicio</a>
            <a class="breadcrumb-item" href="<?php echo base_url("parts") ?>">Hora por Hora</a>
            <span class="breadcrumb-item active">Actualizar Orden De Trabajo</span>
        </nav>
    </div>
</div>

<form action="<?php echo base_url("hourbyhour/update/" . $work_order_id) ?>" method="post" enctype="multipart/form-data">

<div class="row">
    <div class="col-lg-12">
    
        <div id="notification-toast"></div>

        <!-- echo flash messages -->
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Operación exitosa!</strong> <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>


    </div>
</div>

<div id="content" class="row">
    <div class="col-lg-4">
        <div class="card" style="position: sticky; top: 0;">
            <div class="card-body">
                <h4>Orden de trabajo</h4>
                <div class="m-t-25">

                    <!-- echo validation errors here -->
                    <?php echo validation_errors(); ?>

                        <div class="row">

                            <div class="form-group col-lg-12 m-b-15">
                                <label for="workorder_number">Estación de trabajo</label>
                                <select class="select2" name="wo_workstation" required>
                                    <option value="">Seleccionar Estación de trabajo</option>
                                    <?php foreach($workstations as $workstation) { ?>
                                       
                                        <!-- echo the selected workstation -->
                                        <option value="<?php echo $workstation['work_station_id']; ?>" <?php echo $workstation['work_station_id'] == $work_order['wo_workstation'] ? 'selected' : ''; ?>><?php echo $workstation['work_station_name']; ?></option>

                                    <?php } ?>
                                </select>
                                <?php echo form_error('wo_workstation', '<div class="text-danger">', '</div>'); ?>
                            </div>
                            
                           

                            <div class="form-group col-lg-12">
                                <label for="start_date">Fecha de inicio </label>
                                <!-- echo the selected start date in dd/mm/aaaa format -->
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d', strtotime($work_order['start_date'])); ?>">


                                <?php echo form_error('start_date', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            <div class="form-group col-lg-12" >
                                <label for="part_description">Notas de la orden</label>
                                <textarea type="text" class="form-control" id="notes" name="notes" rows="5" placeholder="Descripción"><?php echo $work_order['notes'] ?></textarea>
                                <?php echo form_error('notes', '<div class="text-danger">', '</div>'); ?>
                            </div>


                            
                        

                            <div class="form-group col-lg-6" >
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4>Hora por hora</h4>
                <div class="" >
                    <div class=" mt-5">

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Hora</td>
                                    <td>Numero de orden</td>
                                    <td>Numero de parte</td>
                                    <td>Cantidad</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $hours = 24;
                                for($i = 0; $i < $hours; $i++) :
                                    $hour = $i < 10 ? "0".$i : $i;
                                    $part_number = isset($hourbyhour[$hour."p"]) ? $hourbyhour[$hour."p"] : '';
                                    $quantity = isset($hourbyhour[$hour."h"]) ? $hourbyhour[$hour."h"] : '';
                                    $work_order = isset($hourbyhour[$hour."wop"]) ? $hourbyhour[$hour."wop"] : '';
                                ?>
                                    <tr id="id_<?php echo $hour ?>">

                                        <td><?php echo $hour . ":00 - " . ($hour+1) . ":00"; ?> </td>
                                        

                                        <td>
                                            <select class="select work_order_select form-control"   name="workorder_<?php echo $hour ?>" >
                                                <option value="<?php echo $work_order ?>"><?php echo $work_order ?></option>
                                                <?php 
                                                foreach($odoo_work_orders as $order):
                                                    #if($order['id'] == $work_order['wo_id']) {
                                                    #    echo $order['name'];
                                                    #}
                                                    //echo $order['name'];
                                                ?>

                                                    <option value="<?php echo $order['name']; ?>" ?><?php echo $order['name']; ?></option>

                                                <?php endforeach; ?>
                                            </select>
                                        </td>

                                        <td>
                                            <select  class="select part_select form-control" name="part_number_<?php echo $hour ?>">
                                                <option value="<?php echo $part_number ?>"><?php echo $part_number ?></option>
                                            </select>
                                            <!--
                                            <select class="select2" id="part_select"  name="part_number_<?php echo $hour ?>" >
                                                <option value="">Seleccionar Numero de Parte</option>
                                                <?php
                                                 //foreach($parts as $part) { 
                                                 ?>
                                                    <option value="<?php echo $part['part_number']; ?>" <?php echo $part['part_number'] == $part_number ? 'selected' : ''; ?>><?php echo $part['part_number']; ?></option>
                                                <?php// } ?>  
                                            </select>
                                                -->
                                        </td>
                                        
                                        <td>
                                            <input type="number" class="form-control" name="quantity_<?php echo $hour ?>"  placeholder="Cantidad" value="<?php echo $quantity; ?>">
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
</div>

</form>

<!--
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
-->
<script>
    $(document).ready(function() {
        // Initialize Select2 for all select elements with class 'select2'
        
        $(document).on('change', '.work_order_select', function() {
            var workOrderName = $(this).val();
            var partSelect = $(this).closest('tr').find('.part_select');
            
            //remove form-control class
            partSelect.removeClass('form-control');


            console.log('Selected work order:', workOrderName); // Log the selected work order
            
            

            if (workOrderName) {
                $.ajax({
                    url: '<?php echo base_url('hourbyhour/get_product_name'); ?>',
                    type: 'POST',
                    data: { work_order_name: workOrderName },
                    dataType: 'json',
                    success: function(response) {
                        console.log('AJAX response:', response); // Log the AJAX response
                        if (response.product_name) {
                            partSelect.html('<option value="' + response.product_name + '">' + response.product_name + '</option>');
                        } else {
                            partSelect.html('<option value="">Seleccione Producto</option>');
                        }
                        partSelect.select2(); // Reinitialize Select2
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error); // Log any AJAX errors
                    }
                });
            } else {
                partSelect.html('<option value="">Seleccione Producto</option>');
                partSelect.select2(); // Reinitialize Select2
            }
        });
    });
</script>

<script>
    /*
        $(document).ready(function() {
            $('#work_order_select').change(function() {
                var workOrderName = $(this).val();
                if (workOrderName) {
                    $.ajax({
                        url: '<?php echo base_url('hourbyhour/get_product_name'); ?>',
                        type: 'POST',
                        data: { work_order_name: workOrderName },
                        dataType: 'json',
                        success: function(response) {
                            if (response.product_name) {
                                $('#part_select').html('<option value="' + response.product_name + '">' + response.product_name + '</option>');
                            } else {
                                $('#part_select').html('<option value="">Seleccione Producto</option>');
                            }
                        }
                    });
                } else {
                    $('#part_select').html('<option value="">Seleccione Producto</option>');
                }
            });
        });

        */


    </script>



<script>
	//const socket = io.connect('http://app.leanquattro.com:3001/');
	const socket = io.connect('http://localhost:3001/');
    
    //const socket = io.connect('http://192.168.1.65:3001/');
	socket.on('connect', () => {
		console.log(`Connected with id ${socket.id}`);
		socket.emit('join', { company_id: 77 });
	});

	socket.on('newOrder', (data) => {
		console.log(`New order received: ${data.alert_id} company: ${data.company_id}`);
		
        // Do something with the data, e.g. update the UI
		showToast(data.alert_id);
		const messageElement = document.getElementById('message');
		messageElement.innerHTML = data.message;

		// Make AJAX request to PHP file to get all other requests
		const xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText);
				// Process the response from the PHP file
			}
		};
	});
   
</script>


<script>

function showToast(alert_id, time) {
    var toastHTML = `<div class="toast fade hide" data-delay="3000">
        <div class="toast-header">
            <i class="anticon anticon-info-circle text-primary m-r-5"></i>
            <strong class="mr-auto">Actualización</strong>
            <small></small>
            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
           Se ha actualizado la orden de trabajo.
            
        </div>
    </div>`

    $('#notification-toast').append(toastHTML)
    $('#notification-toast .toast').toast('show');
    
    setTimeout(function(){
        $('#notification-toast .toast:first-child').remove();
    }, 10000);

    //reload the table body with id table-body
    //$('#content').load(' #content');
    //createChart(); //reload the chart
    $('#content').load(' #content', function() {
        $('.select2').select2(); // Reinitialize Select2
    });
}
</script>