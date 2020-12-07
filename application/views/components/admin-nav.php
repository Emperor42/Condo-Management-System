<!--Khadija SUBTAIN-40040952 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
    <a class="navbar-brand py-0" href="#"><?php echo $_SESSION['adminFunc'];?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link py-0" href="<?php echo BASEURL; ?>/main/property">Properties</a>
            </li>
            <?php if($_SESSION['gp']<5):?>
                <?php if($_SESSION['loggedUser']>=0):?>
                <li class="nav-item">
                    <a class="nav-link py-0" href="<?php echo BASEURL; ?>/main/notices">Notices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-0" href="<?php echo BASEURL; ?>/main/concerns">Concerns</a>
                </li>
                <?php endif;?>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link py-0" href="<?php echo BASEURL; ?>/main/finance/<?php echo -1;?>">CA Finance</a>
            </li>
        </ul>
    </div>
</nav>