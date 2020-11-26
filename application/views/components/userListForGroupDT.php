<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>User Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>User Type</th>
        <th>Add</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data)): ?>

        <?php foreach ($data as $userData): ?>

            <tr>
                <td><?php echo $userData->userId; ?></td>
                <td><?php echo $userData->firstName; ?></td>
                <td><?php echo $userData->lastName; ?></td>
                <td><?php echo $userData->email; ?></td>
                <td><?php echo $userData->phone; ?></td>
                <td><?php echo $userData->entityType; ?></td>
                <td><a href="<?php echo BASEURL; ?>/group/addMemberToGroup/<?php echo $userData->userId, $userData->groupId ; ?>"
                       class="btn-editRemove btn-primary">Add</a></td>

            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>