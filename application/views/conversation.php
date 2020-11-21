<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new account </title>
    <?php include "components/header.php" ?>
    <?php 
        $otherUser = (int)htmlspecialchars($_GET["user"]);
        if(!is_numeric($otherUser)){
            $this->setFlash('failure', "User Error ");
            $this->redirect('userPost/wall');//reduirect if the value is not numeris (something is wrong with the get)
        }
    ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <?php include "components/flashMessage.php"; ?>
            <!--Below is where the actual conversation willbe loaded using data from php-->
            <?php if(!empty($data)):?>
                <?php foreach($data as $msgData): ?>
                    <?php if((int)$msgData->msgFrom == $_COOKIE['loggedUser']):?>
                        <span class="badge badge-pill badge-primary sendMessage">Primary</span>
                    <?php endif; ?>
                    <?php if((int)$msgData->msgTo == $_COOKIE['loggedUser']):?>
                        <span class="badge badge-pill badge-primary recieveMessage">Primary</span>
                    <?php endif; ?>
                <?php endforeach;?>
            <?php endif; ?>
        </div>
        <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
    <div>
        <form id="conForm" action="<?php echo BASEURL; ?>/userPost/registerPostRequest" method="post" enctype="multipart/form-data">
            <input name="replyTo" formid="conForm<?php echo $postData->mid;?>" type="hidden" value="-1">
            <input name="msgTo" formid="conForm<?php echo $postData->mid;?>" type="hidden" value="<?php echo $otherUser;?>">
            <input name="msgFrom" formid="conForm<?php echo $postData->mid;?>" type="hidden" value="<?php echo $_COOKIE['loggedUser'];?>">
            <input name="msgSubject" formid="conForm<?php echo $postData->mid;?>" type="hidden" value="PM">
            <p>Say Something: </p>
            <input type="text" formid="conForm<?php echo $postData->mid;?>" name="msgText" value="">
            <details class="card">
                <summary>Upload an Image: </summary>
                <input type="file" name="msgAttach"formid="conForm<?php echo $postData->mid;?>">
            </details>
            <input class="btn btn-danger" type="reset" value="Clear Post">
            <input class="btn btn-success" type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>