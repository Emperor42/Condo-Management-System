<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Payment Number</th>/
        <th>Payment Class</th>/
        <th>Time & Date Posted</th>/
        <th>Payee Number</th>/
        <th>Payor Number</th>/
        <th>Payee Contact</th>/
        <th>Payor Contact</th>/
        <th>Payment Total</th>
        <th>Outstanding Payment</th>
        <th>Memo</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data)): ?>
        <?php if (!empty($data['in'])): ?>
        <?php foreach ($data['in'] as $userData): ?>

            <tr>
                <td><?php echo $userData->pid; ?></td>
                <td><?php echo $userData->paymentType; ?></td>
                <td><?php echo $userData->posted; ?></td>
                <td><?php echo $userData->payeeAccount; ?></td>
                <td><?php echo $userData->payorAccount; ?></td>
                <td><?php echo $userData->payeeName; ?></td>
                <td><?php echo $userData->payorName; ?></td>
                <td><?php echo $userData->total; ?></td>
                <td><?php echo $userData->outstanding; ?></td>
                <td><?php echo $userData->memo; ?></td>
                

            </tr>

        <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
    </tbody>

</table>