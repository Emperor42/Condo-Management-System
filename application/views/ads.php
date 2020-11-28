<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Wall</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
    <?php include "components/nav.php"; ?>
    <?php include "components/flashMessage.php"; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-11">
            <div id="wall">
                <?php include "components/newAdPost.php";?>
                    <?php if(!empty($data)):?>
                        <?php foreach($data as $key=>$postData): ?>
                            <?php if($postData->msgSubject=="AD"||$postData->msgSubject=="PAD")://create a new post on the wall?>
                                <?php include "components/adPost.php"; ?>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Close col-md-5 -->
        </div>
        <!-- Close row -->
    </div>
    <?php include "components/footer.php"; ?>
    <?php linkJS('assets/js/dataTable.load.js'); ?>
    <?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
    <?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>
</body>
</html>
