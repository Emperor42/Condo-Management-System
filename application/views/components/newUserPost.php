<div id="newPost" class="postMain"> 
<!--Matthew Giancola (40019131)-->
<h3 style="color: blue;">Post your thoughts</h3>
<form action="<?php echo BASEURL; ?>/userPost/registerPostRequest" method="post" 
enctype="multipart/form-data">
  <input name="replyTo" id="newPostReplyTo" type="hidden" value="-1">
    <h4>Post to group:</h4>
  <fieldset name="msgTo" id="newPostMsgTo" required>
    <?php foreach($data['top'] as $opt):?>
    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="msgTo">
   <br>
    <?php endforeach;?>
      <br>
  </fieldset>
    <h4>Post as:</h4>
  <fieldset name="msgFrom" id="newPostMsgFrom" required>
    <?php foreach($data['fop'] as $opt):?>
    <?php echo $opt->userId;?>: <input type="radio" value="<?php echo $opt->eid;?>" name="msgFrom">
        <br>
    <?php endforeach;?>
  </fieldset>
    <br>
  <input name="msgSubject" id="newPostMsgSubject" type="hidden" value="POST">
  <label for="newPostMsgText" style="color: steelblue">Write Your Post To The Group Here: </label>
  <input type="text" id="newPostMsgText" name="msgText" value="">
  <label for="newPostFileToUpload">Upload a File: </label>
  <input type="file" name="msgAttach" id="newPostFileToUpload">
<br>
  <input type="reset" value="Clear Post">
  <input type="submit" value="Submit">
</form> 
</div>