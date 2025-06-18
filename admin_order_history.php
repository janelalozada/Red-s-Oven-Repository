<h3 class="mt-4">Order History</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Products</th>
            <th>Amount Paid</th>
            <th>Payment Mode</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($completed_orders->num_rows > 0) {
            while ($row = $completed_orders->fetch_assoc()): 
        ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['products']; ?></td>
            <td>₱<?= number_format($row['amount_paid'], 2); ?></td>
            <td><?= $row['pmode']; ?></td>
            <td><?= $row['status']; ?></td>
        </tr>
        <?php 
            endwhile;
        } else {
            echo "<tr><td colspan='6' class='text-center'>No completed orders</td></tr>";
        }
        ?>
    </tbody>
</table>
