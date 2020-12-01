<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Events</title>
    <?php include "components/header.php" ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="poll">
                <div class="poll-header">Create a new poll</div>
                <form action="<?php echo BASEURL; ?>/main/startPoll" method="post">
                    <div class="poll-body">
                        <label for="newPoll">Topic for the poll: </label>
                        <input id="newPoll" type="text" name="PollName" value="">
                    </div>
                    <div class="poll-footer">
                        <input class="btn btn-danger" type="reset" value="Clear Post">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
    <!-- NOT SURE : TOOK REFERENCE TO EVENTS.PHP-->
    <div id="pollvote">
        <?php
        foreach($data as $key=> $pollData): ?>
            <?php if(!$skipThis){
                include "components/poll.php";
                if ($pollData->voted==1){
                    $skipThis = true;
                }
            } else {
                $skipThis =false;
            }

            ?>
        <?php endforeach;?>
    </div>
</div>

</body>
</html>