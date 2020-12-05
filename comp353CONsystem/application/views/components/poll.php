<!-- Matthew GIANCOLA-40019131-->
<!--Tiffany AH KING-40082976 -->
<!--NOT SURE : TOOK REFERENCE TO EVENTCARD.PHP-->
<!-- NOT SURE THE POLLDATA VARIABLE -->
<?php if(!empty($pollData)):?>
    <?php if($pollData->msgSubject=="POLLS"):?>
<!--   I DONT KNOW WHAT TO DO AFTER THIS POINT. SORRY MATTHEW. I AM A BIT CONFUSED     -->
        <div class="card poll">
            <div class="card-header text-light <?php if((int)$pollData->votes > 0){ echo 'bg-success '.strval($pollData->votes);} elseif((int)$pollData->votes == 0){echo 'bg-primary '.strval($pollData->votes);} else {echo 'bg-danger '.strval($pollData->votes);}?>" id="eDate<?php echo $pollData->mid;?>">
                <h3>Resolution</h3>
            </div>
            <div class="card-body">
                <div class="poll-body"><?php echo $pollData->msgText;?></div>
            </div>
            <div class="card-footer">
                <div class="poll-footer">
                    Total Vote Margin: <?php if((int)$pollData->votes>=0){ 
                        echo strval($pollData->votes)." For";
                    }else { 
                        echo strval(-$pollData->votes)." Against";
                    }
                    ?><br>
                    <?php if(!$pollData->voted):?>
                        <a href="<?php echo BASEURL; ?>/main/yeaVote/<?php echo $pollData->mid;?>" class="btn-editRemove btn-success">Yea</a>
                        <a href="<?php echo BASEURL; ?>/main/nayVote/<?php echo $pollData->mid;?>" class="btn-editRemove btn-danger">Nay</a>
                    <?php endif;?>
                    <?php if($pollData->voted):?>
                        <a href="<?php echo BASEURL; ?>/main/revokePollVote/<?php echo $pollData->mid;?>" class="btn-editRemove btn-warning">Revoke Vote</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endif;?>
<?php endif;?>