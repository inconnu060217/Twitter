<?php
require_once('./controllers/Router.php');
require_once('./controllers/getTweet.php');
require_once('./views/ViewTweets.php');
$target = getTweet($_GET['id']);
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
                <div class='col-12 py-3 border-x'>
                    <h4>
                        <svg viewBox="0 0 24 24" class="small_icons light return">
                            <g>
                                <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path>
                            </g>
                        </svg>
                        Tweeter
                    </h4>
                </div>
                <div class='col-12'>
                    <?php
                    $view = new ViewTweets($target);
                    $view->tweetLayout();
                    ?>
                </div>
            </div>
            <div class='col-3'>
                <?php require_once(find_file('views/footer.php')) ?>
            </div>
        </div>
    </main>
    <script src='./js/tweet.js'></script>
    <script src='./js/darkmode.js'></script>
</body>

</html>