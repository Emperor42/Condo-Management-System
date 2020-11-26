<!--Khadija SUBTAIN-40040952 -->
<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>From</th>
        <th>Subject</th>
        <th>Date</th>
        <th>Status</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data)): ?>

        <?php foreach ($data as $emailData): ?>

            <tr>
                <td><?php echo $emailData->firstName . " " . $emailData->lastName; ?>  </td>
                <td><a href="<?php echo BASEURL; ?>/email/viewEmail/<?php echo $emailData->userId; ?>"><?php echo $emailData->subject; ?></a></td>
                <td><?php echo $emailData->createDate; ?></td>
                <td><?php echo $emailData->emailStatus; ?></td>
               <td><a href="<?php echo BASEURL; ?>/email/deleteEmail/<?php echo $emailData->userId; ?>"
                       class="btn-editRemove btn-danger">Delete</a></td>
            </tr>

        <?php endforeach; ?>

        <?php include "emailDetailModal.php"; ?>
    <?php endif; ?>
    </tbody>

</table>