<?php if($_SESSION['loggedUser']==0):?>
    <div id="newProperty" class="postMain"> 
    <h3>Build Something</h3>
    <form action="<?php echo BASEURL; ?>/main/newProperty" method="post" 
    enctype="multipart/form-data">
    ADDRESS: <input required name="address" type="text" value=""><br>
    OWNER: <input required name="owner" type="text" value=""><br>
    SHARE (1-100%): <input required name="share" type="text" value=""><br>
    MANAGER: <input required name="manager" type="text" value=""><br>
    <input type="reset" value="Clear Post"><br>
    <input type="submit" value="Submit"><br>
    </form> 
    </div>
<?endif;?>