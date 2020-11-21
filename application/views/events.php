<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Events</title>
    <?php include "components/header.php" ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<!--INCOMPLETE:: TODO: placeholder code onyl going to edit to be media card based like posts and comments-->
<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>TYPE</th>
        <th>INFO</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data)): ?>

        <?php foreach ($data as $userData): ?>

            <tr>
                <td><?php echo $userData->msgText; ?></td>
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
        </body>
        </html>