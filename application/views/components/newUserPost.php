<div id="newPost" class="postMain"> 
<h3>Say Something</h3>
<form action="<?php echo BASEURL; ?>/userPost/registerPostRequest" method="post" 
enctype="multipart/form-data">
  <input name="replyTo" id="newPostReplyTo" type="hidden" value="-1">
  <input name="msgTo" id="newPostMsgTo" type="hidden" value="-1">
  <input name="msgFrom" id="newPostMsgFrom" type="hidden" value="<?php echo $_SESSION['loggedUser'];?>">
  <input name="msgSubject" id="newPostMsgSubject" type="hidden" value="POST">
  <label for="newPostMsgText">Say Something To The Group: </label>
  <input type="text" id="newPostMsgText" name="msgText" value="">
  <label for="newPostFileToUpload">Upload a File: </label>
  <input type="file" name="msgAttach" id="newPostFileToUpload">

  <input type="reset" value="Clear Post">
  <input type="submit" value="Submit">
</form> 
</div>