<?php
require_once('./controllers/Router.php');
require_once(find_file('/controllers/getFollowers.php'));
// $_SESSION["username"] = 'antoine2000';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('./views/head.php'); ?>
</head>

<body>
    <main class='container'>
        <div class='row'>
            <div class='col-3'>
                <?php require_once(find_file('views/header.php')) ?>
            </div>
            <div class='col-6'>
                <?php require_once(find_file('views/view_follows.php')) ?>
            </div>
            <div class='col-3'>
                <?php require_once(find_file('views/footer.php')) ?>
            </div>
        </div>
    </main>
    <script src='./js/darkmode.js'></script>
</body>

</html>