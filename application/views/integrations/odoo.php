<?php if (!empty($work_orders)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($work_orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['product_id']; ?></td>
                        <td><?php echo $order['product_name']; ?></td>
                        <td><?php echo $order['state']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No work orders found.</p>
    <?php endif; ?>