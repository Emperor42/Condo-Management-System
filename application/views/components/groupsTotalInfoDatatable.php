<!--Khadija SUBTAIN-40040952 -->
<table id="user_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Group ID</th>
        <th>Group Name</th>
        <th>Group Description</th>
        <th>Edit</th>
        <th>Join</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($data['join'])): ?>
        <?php foreach ($data['join'] as $userData): ?>
            <tr>
                <td><?php echo $userData->groupId; ?></td>
                <td><?php echo $userData->groupName; ?></td>
                <td><?php echo $userData->groupDescription; ?></td>
                <td><a href="<?php echo BASEURL; ?>/group/groupDetails/<?php echo $userData->groupId; ?>"
                       class="btn-editRemove btn-primary">Details</a></td>
                <td><a href="<?php echo BASEURL; ?>/group/selfAddToGroup/<?php echo $userData->groupId; ?>"
                       class="btn-editRemove btn-primary">Request</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>

</table>