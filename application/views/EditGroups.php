<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-11">
            <h3>Edit/Delete Groups</h3
            <?php include "components/group_table.php"; ?>

        </div>
        <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
</div>

<?php include "components/footer.php"; ?>
<script>
    $(document).ready(function () {
        $('#user_group').DataTable();

    });

</script>

<?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
<?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>

</body>
</html>
