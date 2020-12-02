<?php if(!empty($postData)):?>
    <div id="message<?php echo $postData->mid;?>" class="card" style="width:400px">
        
        <div class="card-body">
            <h4 class="card-title"><?php echo ($postData->msgSubject)." from ".($postData->name)." ".($postData->coname); ?></h4><!--This should convert the user id number into a name-->
            <?php if($postData->msgAttach!=""):?>
            <img class="card-img-bottom" src="<?php echo $postData->msgAttach; ?>" alt="Card image">
            <?php endif; ?>
            <p class="card-text"><b><?php 
            
            echo $postData->msgText;
            
            ?></b></p>
            <!--Show edit button iff I poste this post-->
            <?php if($_SESSION['loggedUser']==(int)$postData->msgFrom):?>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal<?php echo $postData->mid;?>">Edit Text</button>
                <!--Show edit button iff I poste this post-->
                <!--Modal POPUP-->
                <!-- The Modal for comment-->
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
    </div>     
<?php endif;?>