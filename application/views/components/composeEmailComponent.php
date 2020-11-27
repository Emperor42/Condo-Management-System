<!--Khadija SUBTAIN-40040952 -->
<h3>Create new email</h3>
<form action="<?php echo BASEURL; ?>/email/sendEmailRequest" method="post">

    <div class="form-group">

        <input type="email" name="email" class="form-control" placeholder="Email..."
               value="<?php if (!empty($data)) {echo $data['email'];} ?>" required/>

        <input type="subject" name="subject" class="form-control" placeholder="subject..."
               value="<?php if (!empty($data)) {echo $data['subject'];} ?>" required/>

        <textarea type="textarea" name="messageBody" class="form-control" rows="7" required>
        <?php if (!empty($data)) {echo $data['body'];} ?> </textarea>

    </div>
    <!-- Close form-group -->
    <div class="form-group">
        <input type="submit" name="send" class="btn btn-primary" value="attachment">
        <input type="submit" name="send" class="btn btn-primary" value="send">
    </div>
    <!-- Close form-group -->

</form>