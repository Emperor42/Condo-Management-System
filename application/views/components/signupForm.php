<h2>Create new account</h2>
<form action="<?php echo BASEURL; ?>/user/registerUserRequest" method="post">

    <div class="form-group">
        <input type="text" name="userId" class="form-control" placeholder="User Id..." required>

        <input type="text" name="firstName" class="form-control" placeholder="First Name..." required>

        <input type="text" name="lastName" class="form-control" placeholder="Last Name..." required>

        <input type="email" name="email" class="form-control" placeholder="Email..." required>

        <input type="phone" name="phone" class="form-control" placeholder="Phone..." required>

        <input type="text" name="entityType" class="form-control" placeholder="User Type..." required>

        <input type="password" name="pwrd" class="form-control" placeholder="Create new password..." required>

    </div>
    <!-- Close form-group -->
    <div class="form-group">
        <input type="submit" name="singupBtn" class="btn btn-primary" value="Register">
    </div>
    <!-- Close form-group -->

</form>