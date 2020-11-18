<form method="post">
    <h3>Editing Group: <?php echo $data['data']->groupID; ?></h3>
    <div class="form-group">
        <input data-toggle="tooltip" title="Group ID" type="text" name="groupID"
               class="form-control" placeholder="Group ID..."
               value="<?php echo $data['data']->groupID; ?>" readonly>

        <input data-toggle="tooltip" title="User ID" type="text" name="userId"
               class="form-control" placeholder="User Id..."
               value="<?php echo $data['data']->userId; ?>" required>

        <input  data-toggle="tooltip" title="First Name" type="text" name="firstName"
                class="form-control" placeholder="First Name..."
                value="<?php echo $data['data']->firstName; ?>" required>

        <input  data-toggle="tooltip" title="Last Name" type="text" name="lastName"
                class="form-control" placeholder="Last Name..."
                value="<?php echo $data['data']->lastName; ?>" required>

        <input data-toggle="tooltip" title="Email" type="email" name="email"
               class="form-control" placeholder="Email..."
               value="<?php echo $data['data']->email; ?>" required>

        <input data-toggle="tooltip" title="GroupOwner" type="text" name="groupOwner"
               class="form-control" placeholder="Group Owner..."
               value="<?php echo $data['data']->groupOwner; ?>" required>


        <input data-toggle="tooltip" title="Password" type="text" name="pwrd"
               class="form-control" placeholder="Create new password..."
               value="<?php echo $data['data']->pwrd; ?>" required>

    </div>
    <!-- Close form-group -->
    <div class="form-group">
        <input type="submit" name="Update" class="btn btn-primary" value="Update" formaction="<?php echo BASEURL;?>/user/updateUserRequest">
        <input type="submit" name="Cancel" class="btn btn-danger" value="Cancel" formaction="<?php echo BASEURL;?>/user/editGroup">
    </div>
    <!-- Close form-group -->

</form>