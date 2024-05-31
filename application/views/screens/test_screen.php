<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/socketio/socket_io_v2.js"></script>


<div class="container-fluid">
    <h1 class="mt-4 mb-2">
        <img src="<?php echo base_url('assets/images/default_images/leanquattro_logo.png'); ?>" alt="Logo" style="width: 150px;">
    </h1>
    <table id="table-hourbyhour" class="table table-bordered">
        <thead style="background-color:black;">
            <tr>
                <th style="border: solid 1px black; color: white;">Workstation</th>
                <th style="border: solid 1px black; color: white;">Part</th>
                <th style="border: solid 1px black; color: white;">Planned vs Done</th>
                <th style="border: solid 1px black; color: white;">Progress</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            #var_dump($work_orders); // Check if $work_orders is empty
            #print_r($work_orders); // 
            foreach ($work_orders as $work_order): 
            ?>
                <tr>
                    <td><h2><?= $work_order['workstation'] ?></h2></td>
                    <td>
                        <h2>
                            <?php
                             if ($work_order['part']=='' || $work_order['part']==null){
                                 echo "No hay piezas asignadas";
                             } else {
                                 echo $work_order['part'];
                             }
                             ?>
                        </h2>
                    </td>
                    <td><h2><?= $work_order['done'] ?>/<?= $work_order['planned'] ?></h2></td>
                    
                        <?php
                            $result =  ($work_order['done']/$work_order['planned']) * 100;

                            //no division by zero
                            if ($work_order['done'] == 0) {
                                $result = 0;
                            }                        
                        ?>
                    <td style="background-color: <?php if($result >= 90 ){echo "green;";}else{echo "red;";} ?>; color: white">
                       <h2 style="color: white;">
                            <?php echo round($result, 2) . "%"; ?>
                       </h2>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Notification toast -->
<div class="notification-toast top-right" id="notification-toast"></div>

<script>
	//const socket = io.connect('http://app.leanquattro.com:3001/');
	const socket = io.connect('http://localhost:3001/');
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
		//xhr.open('GET', 'get_orders.php', true);
		//xhr.send();
        
        //reload the table body with id table-body
        $('#table-body').load(' #table-body');




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
        $('#table-hourbyhour').load(' #table-hourbyhour');

    
}
</script>