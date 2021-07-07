<?php
require_once('./controllers/Router.php');
require_once('./controllers/getProfile.php');
require_once('./views/ViewTweets.php');
$profile = getProfile($_GET['username']);
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
                <?php require_once('./views/view_profile.php'); ?>
            </div>
            <div class='col-3'>
                <?php require_once(find_file('views/footer.php')) ?>
            </div>
        </div>
        <div class='row'>
            <div class='col-3'></div>
            <div class='col-6'>
                <?php
                if (isset($profile['tweets'])) {
                    $tweets = new ViewTweets(array_reverse($profile['tweets']));
                    $tweets->basicLayout();
                }
                ?>
            </div>
        </div>
    </main>
    <script src='./js/darkmode.js'></script>
    <script src='./js/tweet.js'></script>
    <script src='./js/profile.js'></script>
</body>

</html>