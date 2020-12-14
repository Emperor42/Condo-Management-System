<?php if(!empty($info)):?>
<!--Matthew Giancola (40019131)-->
    <div class="card text-light">
        <div class="card-header bg-primary ">
            <p><?php echo $info->owner;?></p>
        </div>
        <div class="card-body text-dark">
            <p>Property: <?php echo $info->address;?></p>
            <br>
            <p>Share: <?php echo $info->shares;?></p>
        </div>
    <div class="card-footer bg-info">
        <p><?php echo $info->manage;?></p>
    </div>
    </div><br>
<?php endif;?>