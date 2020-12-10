<?php if (!empty($data)): ?>
    <div class='card'>
        <div class="media border p-3">
            <div class="media-body">
                <h4>EID</h4>
                <p><?php echo $data->eid;?></p>
            </div>
            <i class="fas fa-fingerprint"></i>
        </div>
        <div class="media border p-3">
            <div class="media-body">
                <h4>User Id</h4>
                <p><?php echo $data->userId;?></p>
            </div>
            <i class="far fa-id-card"></i>
        </div>
        <div class="media border p-3">
            <div class="media-body">
                <h4>Vital Info</h4>
                <p><?php echo $data->firstName;?> <?php echo $data->lastName;?>, Age <?php echo $data->age;?></p>
            </div>
            <i class="fas fa-head-side"></i>
        </div>
        <div class="media border p-3">
            <div class="media-body">
                <h4>Contact Info</h4>
                <p><i class="fas fa-envelope-open-text"></i> <?php echo $data->email;?> | <i class="fas fa-phone"></i> <?php echo $data->phone;?></p>
            </div>
            <i class="far fa-address-book"></i>
        </div>
        <div>
        <?php include "components/userHomeEdit.php"; ?>
        </div>
    </div>
<?php endif;?>