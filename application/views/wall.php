<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Wall</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
    <?php include "components/nav.php"; ?>
    <?php include "components/admin-nav.php";?>
    <?php include "components/flashMessage.php"; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-11">
            <div id="wall">
                <?php include "components/newUserPost.php";?>
                    <?php if(!empty($data['core'])):?>
                        <?php foreach($data['core'] as $key=>$postData): ?>
                            <?php if($postData->msgSubject=="POST")://create a new post on the wall?>
                                <?php include "components/wallPost.php"; ?>
                            <?php endif;?>
                            <?php if($postData->msgSubject=="COMMENT")://create a new post on the post to which its a comment?>
                                <?php include "components/wallPost.php"?>
                                <script>
                                    window.addEventListener('load', function(){
                                        
                                            var ele = document.getElementById("m<?php echo $postData->replyTo;?>Comments");//get the details elelment id with js
                                            var target = document.getElementById("message<?php echo $postData->mid;?>");//get the target ellment
                                            var mainWall = document.getElementById("wall");
                                            //referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
                                            if (document.getElementById("message<?php echo $postData->replyTo;?>")!=null){
                                                ele.appendChild(target);//add the child to the post
                                            }
                                            mainWall.removeChild(target);//remove the child from the wall
                                    });
                                </script>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Close col-md-5 -->
        </div>
        <!-- Close row -->
    </div>
    <?php include "components/footer.php"; ?>
    <?php linkJS('assets/js/dataTable.load.js'); ?>
    <?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
    <?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>
</body>
</html>
