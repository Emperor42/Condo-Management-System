<!DOCTYPE html>
<!--Matthew Giancola (40019131)-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Contracts</title>
        <?php include "components/header.php" ?>
    </head>
    <body>
        <?php include "components/nav.php"; ?>
        <?php include "components/admin-nav.php";?>
        <?php include "components/flashMessage.php"; ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-5">
                    <div class="card event-card">
                        <div class="card-header"><h3 style="color: blue;">Create a New Contract</h3></div>
                        <form action="<?php echo BASEURL; ?>/main/startContract" method="post">
                            <div class="card-body">
                                <h4> Post to group: </h4>
                                <fieldset name="eventGroup"  required>
                                    <?php foreach($data['top'] as $opt):?>
                                    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="eventGroup">
                                    <br>
                                    <?php endforeach;?>
                                </fieldset><br>
                                <h4> Post as: </h4>
                                <fieldset name="eventStart"  required>
                                    <?php foreach($data['fop'] as $opt):?>
                                    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="eventStart">
                                   <br>
                                    <?php endforeach;?>
                                </fieldset><br>
                                <label for="newEvent">Explaination for your contract: </label>
                                <input id="newEvent" type="text" name="eventNamed" value="">
                            </div>
                            <div class="card-footer">
                                <input class="btn btn-danger" type="reset" value="Clear Post">
                                <input class="btn btn-success" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Close col-md-5 -->
            </div>
            <!-- Close row -->
        <!--The list of events-->
        <div id="eventsList">
                <?php
                 foreach($data['core'] as $key=>$eventData): ?>
                       <?php include "components/contractCard.php"; ?>
                <?php endforeach;?>
            </div>
        </div>
 
<?php include "components/footer.php"; ?>
<?php linkJS('assets/js/dataTable.load.js'); ?>
<?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
<?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>

    </body>
</html>