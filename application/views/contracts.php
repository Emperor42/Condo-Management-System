<!DOCTYPE html>
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
                        <div class="card-header">Create a new contract</div>
                        <form action="<?php echo BASEURL; ?>/main/startContract" method="post">
                            <div class="card-body">
                                Post to group:
                                <fieldset name="eventGroup"  required>
                                    <?php foreach($data['top'] as $opt):?>
                                    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="msgTo">
                                    <?php endforeach;?>
                                </fieldset><br>
                                Post as:
                                <fieldset name="eventStart"  required>
                                    <?php foreach($data['fop'] as $opt):?>
                                    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="msgFrom">
                                    <?php endforeach;?>
                                </fieldset><br>
                                <label for="newEvent">Explain for your contract: </label>
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
 
    </body>
</html>