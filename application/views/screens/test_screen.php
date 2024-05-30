<div class="container-fluid">
    <h1 class="mt-4 mb-2">
        <img src="<?php echo base_url('assets/images/default_images/leanquattro_logo.png'); ?>" alt="Logo" style="width: 150px;">
    </h1>
    <table class="table table-bordered">
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
                    <td><h2><?= $work_order['planned'] ?>/<?= $work_order['done'] ?></h2></td>
                    
                        <?php
                            $result =  ($work_order['planned']/$work_order['done']) * 100;

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
