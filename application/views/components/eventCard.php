<?php if(!empty($eventData)):?>
    <?php if($eventData->msgSubject=='EVENTS'):?>
        <div class="card">
            <div class="card-header">
                <h1><?php echo $eventData->msgText;?></h1>
            </div>
            <div class="card-body">
                <!--Date-->
                <div id="eDate<?php echo $eventData->mid;?>">
                </div>
                <hr class="rounded">
                <!--Time-->
                <div id="eTime<?php echo $eventData->mid;?>">
                </div>
                <hr class="rounded">
                <!--Area-->
                <div id="eArea<?php echo $eventData->mid;?>">
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <form action="<?php echo BASEURL; ?>/main/addEventDetails" method="post">
                        <input name="eventGroup" type="hidden" value="-1">
                        <input name="eventStart" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
                        <input type="hidden" name="eventReply" value="<?php echo $eventData->mid;?>">
                        <!--Visible inputs-->
                        <input name="eventTime" type="time">
                        <input name="eventDate" type="date">
                        <input name="eventArea" type="text" value="">
                        <hr class="rounded">
                        <input class="btn btn-danger" type="reset" value="Clear Post">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                </div> 
                <!--Show edit button iff I poste this post-->
            <?php if($_SESSION['loggedUser']==(int)$eventData->msgFrom || $_SESSION['loggedUser']==0):?>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal<?php echo $eventData->mid;?>">Edit Text</button>
                <button type="button" class="btn btn-outline-danger">
                    <a href="<?php echo BASEURL; ?>/main/removeMessage/<?php echo (int)$eventData->mid;?>/<?php echo (int)$eventData->msgFrom;?>">Delete</a>
                </button>
                <!--Show edit button iff I poste this post-->
                <!--Modal POPUP-->
                <!-- The Modal for comment-->
                <div class="modal" id="editModal<?php echo $eventData->mid;?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Edit the <?php echo strtolower($eventData->msgSubject);?> you made</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form id="editForm<?php echo $eventData->mid;?>" action="<?php echo BASEURL; ?>/userPost/changePostRequest" method="post" enctype="multipart/form-data">
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <input name="mid" formid="editForm<?php echo $eventData->mid;?>" type="hidden" value="<?php echo $eventData->mid;?>">
                                    <p>Say Something Else: </p>
                                    <input type="text" formid="editForm<?php echo $eventData->mid;?>" name="msgText" value="">
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
    <?php if($eventData->msgSubject=="EVENTSDATE")://create a new post on the post to which its a comment?>
        <div id="eDate<?php echo $eventData->mid;?>" class="card">
            <div class="card-header">Date</div>
            <div class="card-body"><?php echo $eventData->msgText;?></div>
            <div class="card-footer">
                Total Votes: <?php echo $eventData->votes;?><br>
                <?php if(!$eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/<?php echo $eventData->mid;?>" class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/revokeVote/<?php echo $eventData->mid;?>" class="btn-editRemove btn-warning">Revoke Vote</a>
                <?php endif;?>
            </div>
        </div>
        <script>
            window.addEventListener('load', function(){
                var ele = document.getElementById("eDate<?php echo $eventData->replyTo;?>");//get the details elelment id with js
                var target = document.getElementById("eDate<?php echo $eventData->mid;?>");//get the target ellment
                var mainWall = document.getElementById("eventsList");
                ele.appendChild(target);//add the child to the post
                mainWall.removeChild(target);//remove the child from the wall
            });
        </script>
    <?php endif;?>
    <?php if($eventData->msgSubject=="EVENTSTIME")://create a new post on the post to which its a comment?>
        <div id="eTime<?php echo $eventData->mid;?>" class="card">
            <div class="card-header">Time</div>
            <div class="card-body"><?php echo $eventData->msgText;?></div>
            <div class="card-footer">
                Total Votes: <?php echo $eventData->votes;?><br>
                <?php if(!$eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/<?php echo $eventData->mid;?>" class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/revokeVote/<?php echo $eventData->mid;?>" class="btn-editRemove btn-warning">Revoke Vote</a>
                <?php endif;?>
            </div>
        </div>
        <script>
            window.addEventListener('load', function(){
                var ele = document.getElementById("eTime<?php echo $eventData->replyTo;?>");//get the details elelment id with js
                var target = document.getElementById("eTime<?php echo $eventData->mid;?>");//get the target ellment
                var mainWall = document.getElementById("eventsList");
                ele.appendChild(target);//add the child to the post
                mainWall.removeChild(target);//remove the child from the wall
            });
        </script>
    <?php endif;?>
    <?php if($eventData->msgSubject=="EVENTSLOCATION")://create a new post on the post to which its a comment?>
        <div id="eArea<?php echo $eventData->mid;?>" class="card">
            <div class="card-header">Location</div>
            <div class="card-body"><?php echo $eventData->msgText;?></div>
            <div class="card-footer">
                Total Votes: <?php echo $eventData->votes;?><br>
                <?php if(!$eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/<?php echo $eventData->mid;?>" class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/revokeVote/<?php echo $eventData->mid;?>" class="btn-editRemove btn-warning">Revoke Vote</a>
                <?php endif;?>
            </div>
        </div>
        <script>
            window.addEventListener('load', function(){
                var ele = document.getElementById("eArea<?php echo $eventData->replyTo;?>");//get the details elelment id with js
                var target = document.getElementById("eArea<?php echo $eventData->mid;?>");//get the target ellment
                var mainWall = document.getElementById("eventsList");
                ele.appendChild(target);//add the child to the post
                mainWall.removeChild(target);//remove the child from the wall
            });
        </script>
    <?php endif;?>
<?php endif;?>