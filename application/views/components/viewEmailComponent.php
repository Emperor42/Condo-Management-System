<!--Khadija SUBTAIN-40040952 -->
<h3><?php echo $data->subject ?></h3>
<form action="<?php echo BASEURL; ?>/email/replyEmail" method="post">

    <div class="form-group">

        <input type="hidden" name="emailAddress" class="form-control" placeholder="subject..."
               value="<?php echo $data->email ?>" required/>

        <input type="hidden" name="emailSubject" class="form-control" placeholder="subject..."
               value="<?php echo $data->subject ?>" required/>

        <input type="email" name="subject" class="form-control" value="
        <?php if ($data->page == 'outbox') {
            echo "To: ";
        } else {
            echo "from: [";
        }
        echo $data->email . "] \t on: [" . $data->createDate . "]" ?>" readonly/>

        <textarea type="textarea" name="messageBody" class="form-control" rows="8"
                  readonly><?php echo $data->body ?></textarea>

    </div>
    <!-- Close form-group -->
    <div class="form-group">
        <input type="submit" name="send" class="btn btn-primary" value="reply">
        <input type="submit" name="send" class="btn btn-primary" value="forward">
    </div>
    <!-- Close form-group -->

</form>