<!-- Daniel GAUVIN -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php include "components/header.php" ?>
</head>
<body>
<?php include "components/flashMessage.php"; ?>
<div class=" justify-content-center container mt-5">
    <div class="row">
        <div class="col-md-5">
            <form class="form-group" action="<?php echo BASEURL; ?>/main/loginForm" method="post">
            <h3>Condo associations members</h3>
            <div class="member login">
              <label for="uname"><b>Username</b></label>
              <input class="form-control" type="text" placeholder="Enter Username" name="uname" required>
              <br>
              <label for="psw"><b>Password</b></label>
              <input class="form-control" type="password" placeholder="Enter Password" name="psw" required>
              <br>
              <button class="btn btn-primary" type="submit">Login</button>
              <button class="btn btn-warning" type="reset">Reset</button>
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Forgot Password?</button>
            </div>
            <div class="container" style="background-color:#f1f1f1">
              <span class="psw"> </span>
            </div>
          </form>
        </div>
        <!-- Close col-md-5 -->
        <div class="col-md-5">
            <form class="form-group" action="<?php echo BASEURL; ?>/main/loginForm" method="post">
            <h3>Public Portal</h3>
            <div class="member login">
              <input type="hidden" placeholder="Enter Username" name="uname" value="Public">
              <br>
              <input type="hidden" placeholder="Enter Password" name="psw" value="">
              <br>
              <button type="submit" class="btn btn-primary">Public Portal</button>
            </div>
            <div class="container" style="background-color:#f1f1f1">
            </div>
          </form>
        </div>
        <!-- Close col-md-5 -->
    </div>
    <!-- Close row -->
</div>
<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Oh No You Forgot Password!</h4>
      </div>
      <div class="modal-body">
        <p>If you forgot your password and/or username please contact the administrator for your property.</p><br>
        <p>For Security reasons this system does not allow users to reset their own passwords.</p><br>
        <p>If you are a member of the public please use the public portal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Thank-You for using CONMAN</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>
