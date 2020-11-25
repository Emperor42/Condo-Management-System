<!--Khadija SUBTAIN-40040952 -->
<h3>Create new email</h3>
<form action="<?php echo BASEURL; ?>/user/registerUserRequest" method="post">

    <div class="form-group">


        <input type="email" name="email" class="form-control" placeholder="Email..." required/>

        <input type="subject" name="subject" class="form-control" placeholder="subject..." required>

        <textarea type="textarea" name="messageBody" class="form-control" rows="8" Enter text..."  required></textarea>

    </div>
    <!-- Close form-group -->
    <div class="form-group">
        <input type="submit" name="send" class="btn btn-primary" value="attachment">
        <input type="submit" name="send" class="btn btn-primary" value="send">
    </div>
    <!-- Close form-group -->

</form>