<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-12">

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>


            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Hay errores en el formulario. Por favor, corrígelos.
                </div>
            <?php endif; ?>


        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Por Atender</h3>
        </div>
        <div class="card-body">
            
            <div id="notification-toast"></div>

                <table style="" id="content" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Alerta</th>
                            <th>SubAlerta</th>
                            <th>Ubicación</th>
                            <th>Inicio</th>
                            <th>Tiempo Transcurrido</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($andons as $andon) : ?>
        <tr>
            <td><?php echo $andon['id_andon']; ?></td>
            <td><?php echo $andon['alert_name']; ?></td>
            <td><?php echo $andon['child_alert_name']; ?></td>
            <td><?php echo $andon['plant_name'] .", ". $andon['line_name'] . ", <b>" . $andon['work_station_name'] . "</b>"; ?></td>
            <td><?php echo date_format(date_create($andon['created_at']), "d/m/Y H:i:s"); ?></td>
            <td>
                <!--counter goes here-->
                <div id="counter_<?php echo $andon['id_andon']; ?>" data-created-at="<?php echo $andon['created_at']; ?>"></div>
                <script>
                    (function() {
                        const createdAt = new Date("<?php echo $andon['created_at']; ?>");
                        const counterId = "counter_<?php echo $andon['id_andon']; ?>";

                        function updateCounter() {
                            const now = new Date();
                            const diff = now - createdAt;

                            const hours = Math.floor(diff / (1000 * 60 * 60));
                            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                            document.getElementById(counterId).innerText = 
                                `${hours} horas, ${minutes} mins, ${seconds} segs`;
                        }

                        // Update the counter every second
                        setInterval(updateCounter, 1000);

                        // Initial call to display the counter immediately
                        updateCounter();
                    })();
                </script>
            </td>
            <td>
                <?php if ($andon['service_status'] == 0) : ?>
                    <span class="badge badge-danger">Por atender</span>
                <?php elseif ($andon['service_status'] == 1) : ?>
                    <span class="badge badge-warning">En proceso</span>
                <?php else : ?>
                    <span class="badge badge-success">Atendido</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($andon['service_status'] == 0) : ?>
                    <a href="<?php echo base_url('andons/respond/' . $andon['id_andon']); ?>" class="btn btn-success">Atender</a>
                <?php elseif ($andon['service_status'] == 1) : ?>
                    <a href="<?php echo base_url('andons/solve/' . $andon['id_andon']); ?>" class="btn btn-primary">Solucionar</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
                </table>
                

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/socketio/socket_io_v2.js"></script>
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
        xhr.open("GET", "path_to_your_php_file", true);
        xhr.send();
    });

    function initializeCounter(id_andon, created_at) {
        console.log(`Initializing counter for id_andon: ${id_andon}, created_at: ${created_at}`);
        const createdAt = new Date(created_at);
        const counterId = `counter_${id_andon}`;

        function updateCounter() {
            const now = new Date();
            const diff = now - createdAt;

            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById(counterId).innerText = 
                `${hours} horas, ${minutes} mins, ${seconds} segs`;
        }

        // Update the counter every second
        setInterval(updateCounter, 1000);

        // Initial call to display the counter immediately
        updateCounter();
    }

    function reinitializeCounters() {
        // Find all counter elements and reinitialize them
        $('[id^=counter_]').each(function() {
            const id = $(this).attr('id').split('_')[1];
            const createdAt = $(this).data('created-at');
            initializeCounter(id, createdAt);
        });
    }

    function showToast(alert_id, time) {
        var toastHTML = `<div class="toast fade hide" data-delay="3000">
            <div style="color:white;" class="toast-header bg-danger">
                <i class="anticon anticon-info-circle  m-r-5"></i>
                <strong style="color:white;" class="mr-auto">Alerta!</strong>
                <small></small>
                <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
               SE HA CREADO UNA NUEVA ALERTA DE ANDON.            
            </div>
        </div>`

        $('#notification-toast').append(toastHTML)
        $('#notification-toast .toast').toast('show');
        
        setTimeout(function(){
            $('#notification-toast .toast:first-child').remove();
        }, 10000);

        // Reload the table body and reinitialize counters
        $('#content').load(' #content', function() {
            reinitializeCounters();
        });
    }
</script>