<!--Khadija SUBTAIN-40040952 -->
<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>User Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>User Type</th>
        <th>Password</th>
        <th>Edit</th>
        <th>Delete</th>
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
                <td><?php echo $userData->pwrd; ?></td>
                <td><a href="<?php echo BASEURL; ?>/user/editUserRequest/<?php echo $userData->userId; ?>"
                       class="btn-editRemove btn-warning">Edit</a></td>
                <td><a href="<?php echo BASEURL; ?>/user/deleteUserRequest/<?php echo $userData->userId; ?>"
                       class="btn-editRemove btn-danger">Delete</a></td>

            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>