<!DOCTYPE html>
<html>
<head>
  <title>Con Login</title>
  <style type="text/css">
    table, th, td{
      border: 1px solid black
    }
  </style>
</head>
  <body>
  <h1> Welcome to CON system or smthg like that</h1>
    <form action="<?php echo BASEURL; ?>/main/loginForm" method="post">
      <h3>Condo associations members</h3>
      <div class="member login">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
        <br>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <br>
        <button type="submit">Login</button>
      </div>
      <div class="container" style="background-color:#f1f1f1">
        <span class="psw"> <a href="#">Forgot password?</a></span>
      </div>
    </form>
  </body>
</html>