<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Group Details</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
    <?php include "components/nav.php"; ?>
    <?php include "components/flashMessage.php"; ?>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-11">
                <h3>Group Details
                    <button type="button" class="btn-editRemove btn-primary" data-toggle="modal" data-target="#addUserModal">Add New User</button>
                </h3>

                <?php include "components/groupDetailsDT.php"; ?>
            </div>
            <!-- Close col-md-5 -->
        </div>
        <!-- Close row -->

    </div>
    <!--Modal POPUP For selecting users-->
    <!-- The Modal for comment-->
    <div class="modal" id="addUserModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add user to group <?php echo $userData->groupId; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <form id="addUserForm" action="<?php echo BASEURL; ?>/group/addUser/<?php echo $userData->groupId; ?>" method="post">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input name="gid" formid="addUserForm" type="hidden" value="<?php echo $userData->groupId; ?>">
                        <input name="uid" formid="addUserForm" type="text" required value="">
                        <label for="uid">User to add to the group:</label><br>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input class="btn btn-danger" type="reset" value="Clear Post">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "components/footer.php"; ?>
    <?php linkJS('assets/js/dataTable.load.js'); ?>
    <?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
    <?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>

</body>
</html>
