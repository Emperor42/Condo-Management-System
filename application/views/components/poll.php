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
                <!--Show edit button iff I poste this post-->
                <?php if($_SESSION['loggedUser']==(int)$pollData->msgFrom || $_SESSION['loggedUser']==0):?>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal<?php echo $pollData->mid;?>">Edit Text</button>
                <button type="button" class="btn btn-outline-danger">
                    <a href="<?php echo BASEURL; ?>/main/removeMessage/<?php echo (int)$pollData->mid;?>/<?php echo (int)$pollData->msgFrom;?>">Delete</a>
                </button>
                <!--Show edit button iff I poste this post-->
                <!--Modal POPUP-->
                <!-- The Modal for comment-->
                <div class="modal" id="editModal<?php echo $pollData->mid;?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit the <?php echo strtolower($pollData->msgSubject);?> you made</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form id="editForm<?php echo $pollData->mid;?>" action="<?php echo BASEURL; ?>/userPost/changePostRequest" method="post" enctype="multipart/form-data">
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <input name="mid" formid="editForm<?php echo $pollData->mid;?>" type="hidden" value="<?php echo $pollData->mid;?>">
                                    <p>Say Something Else: </p>
                                    <input type="text" formid="editForm<?php echo $pollData->mid;?>" name="msgText" value="">
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <input class="btn btn-danger" type="reset" value="Clear Edit">
                                    <input class="btn btn-success" type="submit" value="Submit">
                                </div>
                            </form>
                        </div>                                
                    </div>
                </div>
            <?php endif;?>
                    Total Vote Margin: <?php echo strval($pollData->votes)?><br>
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