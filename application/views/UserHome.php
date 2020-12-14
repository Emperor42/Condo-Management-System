<!-- khadija Subtain-40040952 -->
<!-- Daniel GAUVIN- 40061905-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CONMAN</title>
    <?php include "components/header.php" ?>
</head>
<body>
<?php include "components/nav.php";?>
<?php include "components/admin-nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<div class="container mt-5">
    <?php if((int)$_SESSION['loggedUser']>=0):?>
        <h3>User Profile:</h3>
        <br>
        <?php include "components/userData.php";?><br>
    <?php endif;?>
    <!-- Close col-md-5 -->
    <div class="jumbotron jumbotron-fluid">
        We will display here what features are avaliable to the end user With Special Admin features below:
        <div class="container">
            <?php include "components/propertyForm.php";?>
            <?php include "components/payForm.php";?>
        </div>
    </div>
    <!-- Close row -->
</div>

<?php include "components/footer.php"; ?>
<?php linkJS('assets/js/dataTable.load.js'); ?>
<?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
<?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>

</body>
</html>
