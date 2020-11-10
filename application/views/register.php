<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
</head>
<body>
<div class="header">
    <h2>Register</h2>
</div>

<form action="/comp353CONsystem/createUser/registerUser" method="post" >
    <div class="input-group">
        <label>userId</label>
        <input type="text" name="userId" id="userId">
    </div>

    <div class="input-group">
        <label>firstName</label>
        <input type="text" name="firstName" id="firstName">
    </div>

    <div class="input-group">
        <label>lastName</label>
        <input type="text" name="lastName">
    </div>

    <div class="input-group">
        <label>email</label>
        <input type="text" name="email">
    </div>

    <div class="input-group">
        <label>phone</label>
        <input type="text" name="phone">
    </div>

    <div class="input-group">
        <label>entityType</label>
        <input type="text" name="entityType">
    </div>

    <div class="input-group">
        <label>pwrd</label>
        <input type="text" name="pwrd">
    </div>

    <div class="input-group">
        <button type="submit" class="btn" name="myMethod">Register</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>