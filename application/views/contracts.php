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
                                <input name="eventGroup" type="hidden" value="-1">
                                <input name="eventStart" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
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
                 foreach($data as $key=>$eventData): ?>

                       <?php include "components/contractCard.php"; 

                        
                        ?>
                <?php endforeach;?>
            </div>
        </div>
 
    </body>
</html>