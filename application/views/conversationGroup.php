<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new account </title>
    <?php include "components/header.php" ?>
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
                <?php foreach ($data as $msgData): ?>
                    <?php if (!empty($msgData) && $msgData!=null):?>
                        <?php if($msgData->msgFrom == $_SESSION['loggedUser']):?>
                            <h1 class="sendMessage"><span class="badge jumbo badge-pill badge-primary"><?php echo $msgData->msgText; ?><sub><?php $msgData->msgFrom;?></sub></span></h1><br>
                        <?php endif;?>
                        <?php if($msgData->msgFrom != $_SESSION['loggedUser']):?>
                            <h1 class="recieveMessage"><span class="badge jumbo badge-pill badge-secondary"><?php echo $msgData->msgText; ?></span><sub><?php echo $msgData->msgFrom;?></sub></h1><br>
                        <?php endif;?>
                    <?php endif; ?>
                <?php endforeach;?>
            <?php endif; ?>
        </div>
        <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
    <div>
        <form id="conForm" action="<?php echo BASEURL; ?>/userPost/registerGCRequest/<?php echo $_SESSION['talkTo'];?>" method="post" enctype="multipart/form-data">
            <input name="replyTo" formid="conForm" type="hidden" value="-1">
            <input name="msgTo" formid="conForm" type="hidden" value="<?php echo $_SESSION['talkTo'];?>">
            <input name="msgFrom" formid="conForm" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
            <input name="msgSubject" formid="conForm" type="hidden" value="PM">
            <p>Say Something: </p>
            <input type="text" formid="conForm" name="msgText" value="">
            <details class="card">
                <summary>Upload an Image: </summary>
                <input type="file" name="msgAttach"formid="conForm">
            </details>
            <input class="btn btn-danger" type="reset" value="Clear Post">
            <input class="btn btn-success" type="submit" value="Submit">
        </form>
    </div>
</div>
</body>
</html>
