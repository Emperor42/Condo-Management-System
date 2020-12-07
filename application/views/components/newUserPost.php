<div id="newPost" class="postMain"> 
<!--Matthew Giancola (40019131)-->
<h3>Say Something</h3>
<form action="<?php echo BASEURL; ?>/userPost/registerPostRequest" method="post" 
enctype="multipart/form-data">
  <input name="replyTo" id="newPostReplyTo" type="hidden" value="-1">
  Post to group:
  <fieldset name="msgTo" id="newPostMsgTo" required>
    <?php foreach($data['top'] as $opt):?>
    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="msgTo">
    <?php endforeach;?>
  </fieldset>
  Post as:
  <fieldset name="msgFrom" id="newPostMsgFrom" required>
    <?php foreach($data['fop'] as $opt):?>
    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="msgFrom">
    <?php endforeach;?>
  </fieldset>
  <input name="msgSubject" id="newPostMsgSubject" type="hidden" value="POST">
  <label for="newPostMsgText">Say Something To The Group: </label>
  <input type="text" id="newPostMsgText" name="msgText" value="">
  <label for="newPostFileToUpload">Upload a File: </label>
  <input type="file" name="msgAttach" id="newPostFileToUpload">

  <input type="reset" value="Clear Post">
  <input type="submit" value="Submit">
</form> 
</div>