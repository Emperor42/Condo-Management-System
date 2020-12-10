<!--Khadija SUBTAIN-40040952-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit/Delete User</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/flashMessage.php"; ?>

<div class="container mt-5">
    <div class="row">
    <!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'view')">View Groups</button>
  <button class="tablinks" onclick="openCity(event, 'join')">Join Groups</button>
</div>
        <div id='view' class="col-md-11 tabcontent">
            <h3>Manage Groups
            <a href="<?php echo BASEURL; ?>/group/createGroup"
               class="btn-editRemove btn-primary">Create Group</a>
            </h3>
            <?php include "components/groupsInfoDataTable.php"; ?>
        </div>
        <div id='join' class="col-md-11 tabcontent">
            <h3>Join Groups
            <a href="<?php echo BASEURL; ?>/group/createGroup"
               class="btn-editRemove btn-primary">Create Group</a>
            </h3>
            <?php include "components/groupsTotalInfoDataTable.php"; ?>
        </div>
        <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
</div>

<?php include "components/footer.php"; ?>
<?php linkJS('assets/js/dataTable.load.js'); ?>
<?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
<?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>
<?php linkJS('assets/js/script.js'); ?>

</body>
</html>
