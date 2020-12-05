<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo BASEURL; ?>/user/home">CON</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php echo `whoami`; ?>


    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <?php if($_SESSION['loggedUser']==0)://only let the ystem admin add or edit users?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/user/register">New User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/user/editOrRemove">Edit Users</a>
            </li>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/group/manageGroups">Manage Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/main/events">Events</a>
            </li>
            <?php if($_SESSION['gp']<4):?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/email/inbox">Email</a>
            </li>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/main/classified">Classified</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/main/wall">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/main/contracts">Contracts</a>
            </li>
            <?php if($_SESSION['gp']<4):?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/main/resolution">Resolutions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASEURL; ?>/main/property">Manage Property</a>
            </li>
            <?php endif;?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <li>
                    <label class="nav-link"><?php echo $_SESSION["screenName"]; ?></label>
                </li>
                    <a class="nav-link" href="<?php echo BASEURL; ?>/main/logout">Logout</a>
                </li>
            </ul>
        </form>
    </div>
</nav>