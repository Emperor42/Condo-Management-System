<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Property Management</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>
<body>
    <?php include "components/nav.php"; ?>
    <?php include "components/admin-nav.php";?>
    <?php include "components/flashMessage.php"; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-11">
            <div id="wall">
                    <?php if(!empty($data)):?>
                        <?php if(!empty($data['mine'])):?>
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1>Properties <?php echo $_SESSION["screenName"];?> owns</h1>
                                    <p>The cards list different properties that you own</p>
                                </div>
                            </div>
                            <?php foreach($data['mine'] as $info): ?>
                                <?php include "components/propertyCard.php"; ?>
                            <?php endforeach;?>
                        <?php endif; ?>
                        <?php if(!empty($data['ours'])):?>
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1>Properties Registered</h1>
                                    <p>The cards list different managed properties</p>
                                </div>
                            </div>
                            <?php foreach($data['ours'] as $info): ?>
                                <?php include "components/propertyCard.php"; ?>
                            <?php endforeach;?>
                        <?php endif; ?>
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