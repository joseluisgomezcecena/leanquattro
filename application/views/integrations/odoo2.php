<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<h2>Work Orders and Operations</h2>
        <?php if (!empty($work_orders)) { ?>
            <div class="accordion" id="workOrdersAccordion">
                <?php foreach ($work_orders as $index => $work_order) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="true" aria-controls="collapse<?php echo $index; ?>">
                                <?php echo $work_order['name']; ?> (<?php echo $work_order['product_name']; ?>) - Quantity: <?php echo $work_order['quantity']; ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#workOrdersAccordion">
                            <div class="accordion-body">
                                <h5>Operations</h5>
                                <?php if (!empty($work_order['operations'])) { ?>
                                    <ul class="list-group">
                                        <?php foreach ($work_order['operations'] as $operation) { ?>
                                            <li class="list-group-item">
                                                <strong><?php echo $operation['name']; ?></strong><br>
                                                Workcenter: <?php echo $operation['workcenter_name']; ?><br>
                                                State: <?php echo $operation['state']; ?><br>
                                                Expected Duration: <?php echo $operation['duration_expected']; ?> hours
                                                
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <p>No operations found for this work order.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No work orders found.</p>
        <?php } ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
