<!--Khadija SUBTAIN-40040952 -->
<!-- Daniel Gauvin-40061905-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">CON</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASEURL; ?>/user/home">Welcome <?php echo $_SESSION['loggedName'];?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/email/inbox"> Email</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo BASEURL; ?>/main/logout">Logout</a>
                </li>
            </ul>
        </form>
    </div>
</nav>