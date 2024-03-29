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
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/"<?php echo $eventData->mid;?> class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/"<?php echo $eventData->mid;?> class="btn-editRemove btn-warning">Revoke Vote</a>
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
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/"<?php echo $eventData->mid;?> class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/"<?php echo $eventData->mid;?> class="btn-editRemove btn-warning">Revoke Vote</a>
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
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/"<?php echo $eventData->mid;?> class="btn-editRemove btn-primary">Vote For Option</a>
                <?php endif;?>
                <?php if($eventData->voted):?>
                    <a href="<?php echo BASEURL; ?>/main/toggleVote/"<?php echo $eventData->mid;?> class="btn-editRemove btn-warning">Revoke Vote</a>
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