<?php if (!empty($data)): ?>
    <div class='card'>
        <div class="media border p-3">
            <div class="media-body">
                <h4>EID</h4>
                <p><?php echo $data->eid;?></p>
            </div>
            <i class="fa fa-id-badge"></i>
        </div>
        <div class="media border p-3">
            <div class="media-body">
                <h4>User Id</h4>
                <p><?php echo $data->userId;?></p>
            </div>
            <i class="fa fa-user"></i>
        </div>
        <div class="media border p-3">
            <div class="media-body">
                <h4>Vital Info</h4>
                <p><?php echo $data->firstName;?> <?php echo $data->lastName;?>, Age <?php echo $data->age;?></p>
            </div>
            <i class="fa fa-address-card-o"></i>
        </div>
        <div class="media border p-3">
            <div class="media-body">
                <h4>Contact Info</h4>
                <p><i class="fa fa-envelope-o"></i> <?php echo $data->email;?> | <i class="fa fa-phone"></i> <?php echo $data->phone;?></p>
            </div>
            <i class="fa fa-address-book"></i>
        </div>
        <div>
        <details class = "card">
        <summay>Edit your information...</summary>
            <form method="post">
            <h3>Editing User: <?php echo $data->userId; ?></h3>
            <div class="form-group">
                <input data-toggle="tooltip" title="User ID" type="text" name="userId"
                    class="form-control" placeholder="User Id..."
                    value="<?php echo $data->userId; ?>" readonly>

                <input  data-toggle="tooltip" title="First Name" type="text" name="firstName"
                        class="form-control" placeholder="First Name..."
                        value="<?php echo $data->firstName; ?>" required>

                <input  data-toggle="tooltip" title="Last Name" type="text" name="lastName"
                        class="form-control" placeholder="Last Name..."
                        value="<?php echo $data->lastName; ?>" required>

                <input data-toggle="tooltip" title="Email" type="email" name="email"
                    class="form-control" placeholder="Email..."
                    value="<?php echo $data->email; ?>" required>

                <input data-toggle="tooltip" title="Phone" type="phone" name="phone"
                    class="form-control" placeholder="Phone..."
                    value="<?php echo $data->phone; ?>" required>

                <input data-toggle="tooltip" title="User Type" type="text" name="entityType"
                    class="form-control" placeholder="User Type..."
                    value="<?php echo $data->entityType; ?>" required>

                <input data-toggle="tooltip" title="Password" type="text" name="pwrd"
                    class="form-control" placeholder="Create new password..."
                    value="<?php echo $data->pwrd; ?>" required>

            </div>
            <!-- Close form-group -->
            <div class="form-group">
                <input type="submit" name="Update" class="btn btn-primary" value="Update" formaction="<?php echo BASEURL;?>/user/updateUserRequest">
                <input type="submit" name="Cancel" class="btn btn-danger" value="Cancel" formaction="<?php echo BASEURL;?>/user/editOrRemove">
            </div>
            <!-- Close form-group -->

        </form>
    </details>
        </div>
    </div>
<?php endif;?>