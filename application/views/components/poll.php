<!--NOT SURE : TOOK REFERENCE TO EVENTCARD.PHP-->
<!-- NOT SURE THE POLLDATA VARIABLE -->
<?php if(!empty($pollData)):?>
    <?php if($pollData->msgSubject=='polls'):?>
        <div class="poll">
            <div class="poll-header">
                <h1><?php echo $pollData->msgText;?></h1>
            </div>
            <div class="poll-body">
                <div id="newPoll<?php echo $pollData->mid;?>">
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <form action="<?php echo BASEURL; ?>/main/startPoll" method="post">
                        <input id="newPoll" type="text" name="PollName" value="">
                        <hr class="rounded">
                        <input class="btn btn-danger" type="reset" value="Clear Post">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    <?php endif;?>

    <?php if($pollData->msgSubject=="NEWPOLL"):?>
        <div id="eDate<?php echo $pollData->mid;?>" class="poll">
            <div class="poll-header">Date</div>
            <div class="poll-body"><?php echo $pollData->msgText;?></div>
            <div class="poll-footer">
                Total Votes: <?php echo $pollData->votes;?><br>
                <?php if(!$pollData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/<?php echo $pollData->mid;?>" class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($pollData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/revokeVote/<?php echo $pollData->mid;?>" class="btn-editRemove btn-warning">Revoke Vote</a>
                <?php endif;?>
            </div>
        </div>
<!--   I DONT KNOW WHAT TO DO AFTER THIS POINT. SORRY MATTHEW. I AM A BIT CONFUSED     -->
    <?php endif;?>
<?php endif;?>