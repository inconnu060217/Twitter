<?php
require_once('./controllers/Router.php');
require_once(find_file('controllers/searchByTag.php'));
require_once(find_file('views/ViewTweets.php'));
$tweets = searchByTag($_GET['q']);
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
                <div class='col-12 my-5 text-center'>
                    <h3>Recherche pour <?php echo $_GET['q'] ?> :</h3>
                </div>
                <div class='col-12'>
                    <?php
                    $view = new ViewTweets($tweets);
                    $view->basicLayout();
                    ?>
                </div>
            </div>
            <div class='col-3'>
                <?php require_once(find_file('views/footer.php')) ?>
            </div>
        </div>
    </main>
    <script src='./js/darkmode.js'></script>
    <script src='./js/tweet.js'></script>
</body>

</html>