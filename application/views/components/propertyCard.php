<?php if(!empty($info)):?>
    <div class="card">
        <div class="card-header bg-primary">
            <?php echo $info->owner;?>
        </div>
        <div class="card-body">
            Property: <?php echo $info->address;?>
            Share: <?php echo $info->share;?>
        </div>
    <div class="card-footer bg-info">
        <?php echo $info->manager;?>
    </div>
    </div>
<?php endif;?>