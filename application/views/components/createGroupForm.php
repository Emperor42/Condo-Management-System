<!-- Tiffany Ah King(40082976) & Khadija Subtain(40040952) Codes-->
<form method="post">
    <h3>Create Group</h3>
    <div class="form-group">
        <input data-toggle="tooltip" title="Group Name" type="text" name="groupName"
               class="form-control" placeholder="Group Name..."
               value="" required>

        <input  data-toggle="tooltip" title="Group Description" type="text" name="groupDescription"
                class="form-control" placeholder="Group Description..."
                value="" required>

    </div>
    <!-- Close form-group -->
    <div class="form-group">
        <input type="submit" name="Create" class="btn btn-primary" value="Create" formaction="<?php echo BASEURL;?>/group/createGroupRequest">
   </div>
    <!-- Close form-group -->

</form>