<!DOCTYPE html>
<!--Matthew Giancola (40019131)-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Group Chat</title>
    <?php include "components/header.php" ?>

</head>
<body>
<?php include "components/nav.php"; ?>
<?php linkCSS("public/assets/css/chatStyle.css") ?>

<h3 style="text-align: center; margin-top: 5px">Group Chat</h3>
<div id="scrollDiv" class="container " style="background-color: white">
    <div class="row">
        <div style="height: 300px;">
            <!--Below is where the actual conversation will be loaded using data from php-->
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $msgData): ?>
                    <?php if (!empty($msgData) && $msgData != null): ?>
                        <?php if ($msgData->msgFrom == $_SESSION['loggedUser']): ?>
                            <div class="containerChat darker">
                                <h6 style="color: royalblue" align="right"><?php echo $msgData->firstName; ?></h6>
                                <p><?php echo $msgData->msgText; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($msgData->msgFrom != $_SESSION['loggedUser']): ?>
                            <div class="containerChat">
                                <h6 style="color: royalblue" align="left"><?php echo $msgData->firstName; ?></h6>
                                <p><?php echo $msgData->msgText; ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Close col-md-5 -->
    </div>
</div>
<!-- Close row -->

<div class="containerBottom" class="col-md-9" style="border: #f1f1f1">
    <form id="conForm" action="<?php echo BASEURL; ?>/userPost/registerGCRequest/<?php echo $_SESSION['talkTo']; ?>"
          method="post" enctype="multipart/form-data">
        <input name="replyTo" formid="conForm" type="hidden" value="-1">
        <input name="msgTo" formid="conForm" type="hidden" value="<?php echo $_SESSION['talkTo']; ?>">
        <input name="msgFrom" formid="conForm" type="hidden" value="<?php echo $_SESSION['loggedUser']; ?>">
        <input name="msgSubject" formid="conForm" type="hidden" value="PM">

        <p>Write in the text box below </p>
        <input type="text" formid="conForm" name="msgText" value="" style="width: 550px">
        <details class="card" style="width: 200px">
            <summary>Upload an Image</summary>
            <input type="file" name="msgAttach" formid="conForm">
        </details>
        <br>
        <input class="btn btn-danger" type="reset" value="Clear Post">
        <input class="btn btn-success" type="submit" value="Submit">
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#scrollDiv').scrollTop($('#scrollDiv')[0].scrollHeight - $('#scrollDiv')[0].clientHeight);
</script>

</body>
</html>
