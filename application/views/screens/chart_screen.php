<style>
.blinking-red {
    color: red;
    animation: blink 1s infinite;
}

@keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0; }
    100% { opacity: 1; }
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/socketio/socket_io_v2.js"></script>

<div id="" class="container-fluid">
    
    <h1 class="mt-2 mb-5">
        <img src="<?php echo base_url('assets/images/default_images/leanquattro_logo.png'); ?>" alt="Logo" style="width: 150px;">
    </h1>

    <div class="row">
        
        <div class="col-lg-5">
            <!--chart-->
            <div class="chart-container" style="position: relative; width: 100%; height: auto">
                <canvas class="chart" id="andon-chart"></canvas>
            </div>
        </div>

        <div class="col-lg-7 ">
            <table style="" id="table-hourbyhour" class="table table-bordered text-center">
                <thead style="background-color:black;">
                    <tr>
                        <th style="border: solid 1px black; color: white;">Estación</th>
                        <th style="border: solid 1px black; color: white;">Parte</th>
                        <th style="border: solid 1px black; color: white;">Plan vs Real</th>
                        <th style="border: solid 1px black; color: white;">Progreso</th>
                        <th style="border: solid 1px black; color: white;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($work_orders as $work_order): 
                    ?>
                        <tr>
                            <td><h2><?= $work_order['workstation'] ?></h2></td>
                            <td>
                                <h2>
                                    <?php
                                        $part = $controller->get_part_number($work_order['workorder']);
                                        echo $part;
                                    ?>
                                </h2>
                            </td>
                            <td><h2><?= $work_order['done'] ?>/<?= $work_order['planned'] ?></h2></td>
                            
                            <?php
                                $result = ($work_order['done'] / $work_order['planned']) * 100;

                                // Avoid division by zero
                                if ($work_order['done'] == 0) {
                                    $result = 0;
                                }                        
                            ?>
                            <td style="background-color: <?php if($result >= 90 ){echo "green;";}else{echo "red;";} ?>; color: white">
                            <h2 style="color: white;">
                                    <?php echo round($result, 2) . "%"; ?>
                            </h2>
                            </td>
                            
                            <?php 
                            $andon = $controller->get_andon_event($work_order['work_station_id']); 
                            if (!empty($andon)) {
                                $icon = '';
                                $andon_status = $andon[0]['service_status'];

                                if ($andon_status == 0) {
                                    $blinking = 'blinking-red';
                                    $status_message = 'CAIDO';
                                    $title_color = 'red';
                                    $text_color = 'black';
                                    $response_user = "";
                                    $icon = 'anticon anticon-alert';
                                    $icon_color = 'red';
                                } elseif ($andon_status == 1) {
                                    $blinking = '';
                                    $status_message = 'MANTENIMIENTO';
                                    $title_color = 'orange';
                                    $text_color = 'black';
                                    $response_user = $andon[0]['service_user'];
                                    $icon = 'anticon anticon-tool';
                                    $icon_color = 'orange';
                                }
                            } else {
                                $blinking = '';
                                $status_message = 'Working';
                                $title_color = 'green';
                                $text_color = 'black';
                                $response_user = '';
                                $icon = 'anticon anticon-check';
                                $icon_color = 'green';
                            }
                            ?>
                            <td style="text-align:center;" class="">
                                <?php 
                                if (!empty($andon)) :
                                    $andon_message = $controller->Andon_model->get_andon_message($andon[0]['id_andon']);
                                ?>  
                                    <h1 style="font-weight:800;"><i style="font-size:40px; color:<?php echo $icon_color ?>" class="<?php echo $icon ?> <?php echo $blinking ?>"></i> <span style="color:<?php echo $title_color ?>"><?php echo $status_message ?></span></h1>  
                                    
                                    <h2 style="color: <?php echo $text_color; ?>; font-weight:800;"><?php echo $andon_message['alert_name']?></h2>
                                    <h2 style="color: <?php echo $text_color; ?>; font-weight:700;"><?php echo $andon_message['child_alert_name']?> </h2>
                                    <h3><?php // echo $response_user ?></h3>
                                    
                                <?php
                                else:
                                    echo '<h2 style="color: green; font-weight:800">OK</h2>';
                                endif;
                                ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Notification toast -->
<div class="notification-toast top-right" id="notification-toast"></div>

<script>
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
       
    });
</script>

<script>
var chart; // Define chart variable in the global scope

function createChart() {
    $.ajax({
        url: "<?php echo base_url('Screens/fetch_data_for_screens/') . $screen ?>", // Replace with the path to your PHP script
        method: 'GET',
        success: function(response) {
            var cData = JSON.parse(response);

            var ctx = $("#andon-chart");

            var data = {
                labels: cData.labels,
                datasets: [
                    {
                        label: "Planned",
                        data: cData.data_planned.map(Number), // Convert strings to numbers
                        backgroundColor: "rgba(0,210,146,0.5)",
                        borderColor: "#00c085",
                        borderWidth: 1
                    },
                    {
                        label: "Done",
                        data: cData.data_done.map(Number), // Convert strings to numbers
                        backgroundColor: "rgba(210,0,0,0.5)",
                        borderColor: "#c00000",
                        borderWidth: 1
                    }
                ]
            };

            var options = {
                responsive: true,
                title: {
                    display: false,
                    position: "top",
                    text: "Ideas por mes",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: false,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 12
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            /*display: false ,*/
                            drawBorder: false,
                            offsetGridLines: false,
                            drawTicks: false,
                            borderDash: [3, 4],
                            zeroLineWidth: 1,
                            zeroLineBorderDash: [3, 4]
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false ,
                            color: "#51ffcb"
                        },
                    }]
                },
            };

            if (chart) {
                chart.destroy(); // Destroy old chart if it exists
            }

            chart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        }
    });
}

$(function(){    
    createChart(); // Create chart on page load
});

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

    //reload the table body with id table-hourbyhour
    $('#table-hourbyhour').load(' #table-hourbyhour');
    createChart(); //reload the chart
}
</script>