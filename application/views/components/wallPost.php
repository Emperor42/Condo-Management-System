<?php if(!empty($postData)):?>
    <div id="message<?php echo $postData->mid;?>" class="card" style="width:400px">
        
        <div class="card-body">
            <h4 class="card-title"><?php echo ($postData->fromName)."->".($postData->toName); ?></h4><!--This should convert the user id number into a name-->
            <?php if($postData->msgAttach!=""):?>
            <img class="card-img-bottom" src="<?php echo $postData->msgAttach; ?>" alt="Card image">
            <?php endif; ?>
            <p class="card-text"><?php echo $postData->msgText;?></p>
            <!-- Button to Open the Modal, uses mid to ensure that a uniue modal value is generated -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal<?php echo $postData->mid;?>">Comment</button>
            <details class="card" id="m<?php echo $postData->mid?>Comments">
                <summary>Show Comments...</summary>
            </details>
            <!--Show edit button iff I poste this post-->
            <?php if($_SESSION['loggedUser']==(int)$postData->msgFrom):?>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal<?php echo $postData->mid;?>">Edit Text</button>
                <!--Show edit button iff I poste this post-->
                <!--Modal POPUP-->
                <!-- The Modal for comment-->
                <button type="button" class="btn btn-outline-danger">
                    <a href="<?php echo BASEURL; ?>/main/removeMessage/<?php echo (int)$postData->mid;?>/<?php echo (int)$postData->msgFrom;?>">Delete</a>
                </button>
                <div class="modal" id="editModal<?php echo $postData->mid;?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit the <?php echo strtolower($postData->msgSubject);?> you made</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form id="editForm<?php echo $postData->mid;?>" action="<?php echo BASEURL; ?>/userPost/changePostRequest" method="post" enctype="multipart/form-data">
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <input name="mid" formid="editForm<?php echo $postData->mid;?>" type="hidden" value="<?php echo $postData->mid;?>">
                                    <p>Say Something Else: </p>
                                    <input type="text" formid="editForm<?php echo $postData->mid;?>" name="msgText" value="">
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
        </div>
        <!--Modal POPUP-->
        <!-- The Modal for comment-->
        <div class="modal" id="replyModal<?php echo $postData->mid;?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Comment on the <?php echo strtolower($postData->msgSubject);?> by <?php echo strtolower(($postData->fromName));?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <form id="replyForm<?php echo $postData->mid;?>" action="<?php echo BASEURL; ?>/userPost/registerPostRequest" method="post" enctype="multipart/form-data">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input name="replyTo" formid="replyForm<?php echo $postData->mid;?>" type="hidden" value="<?php echo $postData->mid;?>">
                            <input name="msgTo" formid="replyForm<?php echo $postData->mid;?>" type="hidden" value="<?php echo $postData->msgFrom;?>">
                            <input name="msgFrom" formid="replyForm<?php echo $postData->mid;?>" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
                            <input name="msgSubject" formid="replyForm<?php echo $postData->mid;?>" type="hidden" value="COMMENT">
                            <p>Say Something: </p>
                            <input type="text" formid="replyForm<?php echo $postData->mid;?>" name="msgText" value="">
                            <p>Upload an Image: </p>
                            <input type="file" name="msgAttach"formid="replyForm<?php echo $postData->mid;?>">
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input class="btn btn-danger" type="reset" value="Clear Post">
                            <input class="btn btn-success" type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>     
<?php endif;?>