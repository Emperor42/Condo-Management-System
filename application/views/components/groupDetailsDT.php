<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Owner IDs</th>
        <th>Member ID</th>
        <th>Member Fist Name</th>
        <th>Member Last Name</th>
        <th>Member Email</th>
        <th>Message</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data)): ?>

        <?php foreach ($data as $userData): ?>

            <tr>
                <td><?php echo $userData->eid; ?></td>
                <td><?php echo $userData->userId; ?></td>
                <td><?php echo $userData->firstName; ?></td>
                <td><?php echo $userData->lastName; ?></td>
                <td><?php echo $userData->email; ?></td>
                <td><a href="<?php echo BASEURL; ?>/main/conversation/<?php echo $userData->eid; ?>"
                       class="btn-editRemove btn-danger">Private Message</a></td>
                <td><a href="<?php echo BASEURL; ?>/group/deleteGroupRequest/<?php echo $userData->userId, $userData->gid; ?>"
                       class="btn-editRemove btn-danger">Delete</a></td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>

