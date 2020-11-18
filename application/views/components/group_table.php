<table id="group_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th> Group ID </th>
        <th>User Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data)): ?>

        <?php foreach ($data as $groupData): ?>

            <tr>
                <td><?php echo $groupData->groupId; ?></td>
                <td><?php echo $groupData->userId; ?></td>
                <td><?php echo $groupData->firstName; ?></td>
                <td><?php echo $groupData>lastName; ?></td>
                <td><a href="<?php echo BASEURL; ?>/group/editGroupRequest/<?php echo $groupData->userId; ?>"
                       class="btn-editRemove btn-warning">Edit</a></td>
                <td><a href="<?php echo BASEURL; ?>/group/deleteGroupRequest/<?php echo $groupData->userId; ?>"
                       class="btn-editRemove btn-danger">Delete</a></td>

            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>
