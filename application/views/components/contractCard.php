<?php if(!empty($eventData)):?>
    <?php if($eventData->msgSubject=='CONTRACTS'):?>
        <div class="card">
            <div class="card-header">
                <h1><?php echo $eventData->msgText;?></h1>
            </div>
            <div class="card-body">
                <!--Date-->
                <h3>Contract Offers</h3>
                <div id="cDate<?php echo $eventData->mid;?>">
                </div>
                <hr class="rounded">
                <!--Time-->
                <h3>Accepted Contract Offers</h3>
                <div id="cTime<?php echo $eventData->mid;?>">
                </div>
                <hr class="rounded">
                <!--Area-->
                <h3>Completed Contract Offers</h3>
                <div id="cArea<?php echo $eventData->mid;?>">
                </div>
            </div>
            <div class="card-footer">
            <!--Show edit button iff I poste this post-->
            <?php if($_SESSION['loggedUser']==(int)$eventData->msgFrom || $_SESSION['loggedUser']==0):?>
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
                <h4>Outline your offer to complete the contract</h4>
                <div class="btn-group">
                    <form action="<?php echo BASEURL; ?>/main/addContractDetails" method="post">
                        <input name="eventGroup" type="hidden" value="-1">
                        <input name="eventStart" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
                        <input type="hidden" name="eventReply" value="<?php echo $eventData->mid;?>">
                        <!--Visible inputs-->
                        <input name="eventDate"  type="text" value="">
                        <!--<input name="eventDate"  type="text" value="">-->
                        <!--<input name="eventArea" type="text" value="">-->
                        <hr class="rounded">
                        <input class="btn btn-danger" type="reset" value="Clear Post">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                </div> 
            </div>
        </div>
    <?php endif;?>
    <?php if($eventData->msgSubject=="CONTRACTSOFFER")://create a new post on the post to which its a comment?>
        <div id="cDate<?php echo $eventData->mid;?>" class="card">
            <div class="card-header">Work Offer</div>
            <div class="card-body"><?php echo $eventData->msgText;?></div>
            <div class="card-footer">
                <?php echo $eventData->poster;?><br>
                <div class="btn-group">
                    <form action="<?php echo BASEURL; ?>/main/addContractDetails" method="post">
                        <input name="eventGroup" type="hidden" value="-1">
                        <input name="eventStart" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
                        <input type="hidden" name="eventReply" value="<?php echo $eventData->mid;?>">
                        <!--Visible inputs-->
                        <input name="eventTime"  type="hidden" value="<?php echo $eventData->msgText;?>">
                        <!--<input name="eventArea" type="text" value="">-->
                        <hr class="rounded">
                        <input class="btn btn-success" type="submit" value="Accept Offer">
                    </form>
                </div> 
            </div>
        </div>
        <script>
            window.addEventListener('load', function(){
                var ele = document.getElementById("cDate<?php echo $eventData->replyTo;?>");//get the details elelment id with js
                var target = document.getElementById("cDate<?php echo $eventData->mid;?>");//get the target ellment
                var mainWall = document.getElementById("eventsList");
                ele.appendChild(target);//add the child to the post
                mainWall.removeChild(target);//remove the child from the wall
            });
        </script>
    <?php endif;?>
    <?php if($eventData->msgSubject=="CONTRACTSAWARD")://create a new post on the post to which its a comment?>
        <div id="cTime<?php echo $eventData->mid;?>" class="card">
            <div class="card-header">Time</div>
            <div class="card-body"><?php echo $eventData->msgText;?></div>
            <div class="card-footer">
            <?php echo $eventData->poster;?><br>
            <div class="btn-group">
                    <form action="<?php echo BASEURL; ?>/main/addContractDetails" method="post">
                        <input name="eventGroup" type="hidden" value="-1">
                        <input name="eventStart" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
                        <input type="hidden" name="eventReply" value="<?php echo $eventData->mid;?>">
                        <!--Visible inputs-->
                        <input name="eventArea"  type="hidden" value="<?php echo $eventData->msgText;?>">
                        <!--<input name="eventArea" type="text" value="">-->
                        <hr class="rounded">
                        <input class="btn btn-success" type="submit" value="Contract Complete">
                    </form>
                </div> 
            </div>
        </div>
        <script>
            window.addEventListener('load', function(){
                var ele = document.getElementById("cTime<?php echo $eventData->replyTo;?>");//get the details elelment id with js
                var target = document.getElementById("cTime<?php echo $eventData->mid;?>");//get the target ellment
                var mainWall = document.getElementById("eventsList");
                ele.appendChild(target);//add the child to the post
                mainWall.removeChild(target);//remove the child from the wall
            });
        </script>
    <?php endif;?>
    <?php if($eventData->msgSubject=="CONTRACTSCOMPLETE")://create a new post on the post to which its a comment?>  
        <div id="cArea<?php echo $eventData->mid;?>" class="card">
            <div class="card-header">Location</div>
            <div class="card-body"><?php echo $eventData->msgText;?></div>
            <div class="card-footer">
            <?php echo $eventData->poster;?><br>
            </div>
        </div>
        <script>
            window.addEventListener('load', function(){
                var ele = document.getElementById("cArea<?php echo $eventData->replyTo;?>");//get the details elelment id with js
                var target = document.getElementById("cArea<?php echo $eventData->mid;?>");//get the target ellment
                var mainWall = document.getElementById("eventsList");
                ele.appendChild(target);//add the child to the post
                mainWall.removeChild(target);//remove the child from the wall
            });
        </script>
    <?php endif;?>
<?php endif;?>