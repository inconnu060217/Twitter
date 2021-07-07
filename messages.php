<?php
require_once('./controllers/Router.php');
require_once('./controllers/getProfile.php');
$profile = getProfile($_GET['username']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once('views/head.php');
    ?>
</head>

<body>
    <main class='container'>
        <div class="row">
            <div class="col-3">
                <?php require_once(find_file('views/header.php')) ?>
            </div>
            <?php require_once('./views/viewMessages.php');
            ?>

        </div>
    </main>
    <script src='./js/darkmode.js'></script>
</body>

</html>