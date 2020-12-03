<!DOCTYPE html>
<!--Matthew Giancola 40019131 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Condo Association Financial Report</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/admin-nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<div class="container mt-5">
    <div class="jumbotron">
        <h1>Financial Reports</h1><br>
        <p>Generate Report for: </p>
            <?php foreach( $data as $key=>$core):?>
                <?php if(!empty($core)):?>
                    <button class="tablinks" onclick="openCity(event, 'f<?php echo $key;?>')"><?php echo $core['name'];?></button>
                <?php endif;?>
            <?php endforeach;?>
    </div>
    <?php foreach( $data as $key=>$core):?>
        <div id ='f<?php echo $key;?>' class="tabcontent">
            <div class="row">
                <div class="col-md-11">
                    <h3>Summary</h3>
                    <?php include "components/sumDataTable.php"; ?>
                </div>
                <!-- Close col-md-5 -->
            </div>
            <!-- Close row -->
            <div class="row">
                <div class="col-md-11">
                    <h3>Revenue In</h3>
                    <?php include "components/inDataTable.php"; ?>
                </div>
                <!-- Close col-md-5 -->
            </div>
            <!-- Close row -->
            <div class="row">
                <div class="col-md-11">
                    <h3>Revenue Out</h3>
                    <?php include "components/outDataTable.php"; ?>
                </div>
                <!-- Close col-md-5 -->
            </div>
            <!-- Close row -->
        </div>
    <?php endforeach;?>
</div>


<?php include "components/footer.php"; ?>
<?php linkJS('assets/js/tabs.js'); ?>
<?php linkJS('assets/js/dataTable.load.js'); ?>
<?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
<?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>

</body>
</html>
