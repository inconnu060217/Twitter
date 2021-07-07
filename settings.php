<?php

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

require_once('./controllers/Router.php');
require_once(find_file('./controllers/getProfile.php'));
require_once(find_file('./views/ViewTweets.php'));
require_once(find_file('./controllers/getSettings.php'));

$profile = getProfile($_GET['username']);

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
                <div id='content-settings'>
                    <h2>Edition du profil</h2>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <label>Nouveau pseudo : </label>
                        <input type="text" class="inputNew" name="newpseudo" placeholder="Pseudo" /><br>
                        <label>Nouveau email : </label>
                        <input type="text" class="inputNew" name="newemail" placeholder="Email" /><br>
                        <label>Nouveau numéro : </label>
                        <input type="text" class="inputNew" name="newnumber" placeholder="Numéro de telephone" /><br>
                        <label>Nouveau mot de passe: </label>
                        <input type="password" class="inputNew" name="newmdp" placeholder="Mot de passe" /><br>
                        <label>Nouveau mot de passe: </label>
                        <input type="password" class="inputNew" name="newmdp1" placeholder="Confirmation mot de passe" /><br>
                        <label>Photo de profil : </label>
                        <input type="file" class="inputNew" name="picture"><br>
                        <label>Bannière : </label>
                        <input type="file" class="inputNew" name="banner">
                        <!-- <label>Confirmation modification : </label> -->
                        <!-- <input type="password" name="password" placeholder="Mot de passe actuel" required /><br> -->
                        <input type="submit" class="btn tweet_btn" value="Mettre à jour mon profil">
                    </form>
                </div>
                <?php
                if (isset($message)) {
                    echo '<font color="red">' . $message . '</font>';
                } ?>
            </div>
            <div class='col-3'>
                <?php require_once(find_file('views/Home/footer-home.php')) ?>
            </div>
        </div>
    </main>
    <script src='./js/darkmode.js'></script>
    <script src='./js/tweet.js'></script>
</body>

</html>