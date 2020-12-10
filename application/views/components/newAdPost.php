<div id="newPost" class="postMain"> 
<!--Matthew Giancola (40019131)-->
<h3>Say Something</h3>
<form action="<?php echo BASEURL; ?>/userPost/registerAdRequest" method="post" 
enctype="multipart/form-data">
  <input name="replyTo" id="newPostReplyTo" type="hidden" value="-1">
  <input name="msgTo" id="newPostMsgTo" type="hidden" value="-1">
  <input name="msgFrom" id="newPostMsgFrom" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
  <fieldset name="msgSubject" id="msgSubject" required>
    PUBLIC AD: <input type="radio" value="PAD" name="msgSubject">
    <?php if((int)$_SESSION['loggedUser']>=0):?>
      CONMAN AD: <input type="radio" value="AD" name="msgSubject">
    <?php endif;?>
  </fieldset>
  <label for="newPostMsgText">Say Something To The Group: </label>
  <input type="text" id="newPostMsgText" name="msgText" value="">
  <label for="newPostFileToUpload">Upload a File: </label>
  <input type="file" name="msgAttach" id="newPostFileToUpload">

  <input type="reset" value="Clear Post">
  <input type="submit" value="Submit">
</form> 
</div>