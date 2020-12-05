<!--Tiffany AH KING-40082976 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Owners Concerns and Discussion</title>
    <?php include "components/header.php" ?>
</head>
<body>
<?php include "components/nav.php"; ?>
<?php include "components/admin-nav.php"; ?>
<?php include "components/flashMessage.php"; ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="ownersConcernsDiscuss">
                <div class="ownersConcernsDiscuss-header">
                    <form action="<?php echo BASEURL; ?>/main/OwnersDiscussionAndConcerns" method="post">
                        <h1> <u> Owners  Discussion </u> </h1> <br> <br>

                        <h3> What topic do you want to discuss? </h3>
                        <br>
                            <label for="fullname">Full name:</label>
                            <input type="text" id="fullname" name="fullname"><br><br>
                            <label for="topic">Topic:</label>
                            <input type="text" id="topic" name="topic"><br><br>
                            <input type="submit" value="Submit">
                        </form>
                        <br> <br>
                        <h1> <u> Owners Concerns</u> </h1> <br> <br>

                        <div class="container">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="Your name..">
                            <br> <br>

                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lastname" placeholder="Your last name..">
                            <br> <br>

                            <label for="concerns"> Concerns </label>
                            <textarea id="concerns" name="concerns" placeholder="Write something.." style="height:200px"></textarea>
                            <br> <br>

                        </div>
                        <br><br>
                        <div class="ownersConcernsDiscuss-footer">
                            <input class="btn btn-danger" type="reset" value="Clear Post">
                            <input class="btn btn-success" type="submit" value="Submit">
                        </div>
                    </form>
                </div>

</body>
</html>