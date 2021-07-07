<?php
require_once('./controllers/Router.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/index.css">
</head>
    <main class='container-fluid'>
        <div class='row'>
            <div class='col-lg-6 col-md-6 col-sm-6'>
                <img class="big-blue-twitter" src="img/big_blue_twitter.png" alt="Image twitter">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 justify-content-center">
                <div class="col-lg-12">
                    <div class="top-connexion">
                        <form action="">
                            <input type="text" class="form-control col-lg-4 col-sm-12" name="username" placeholder="Téléphone, email ou nom d'utilisateur">
                            <input type="password" class="form-control col-lg-4 col-sm-12" name="passwordLogin" placeholder="Mot de passe">
                            <input type="submit" class="form-control col-lg-3 col-sm-12 radius" name="formLogin" value="Se connecter">
                        </form>
                    </div>
                    <div class="col-2 img-padding">
                        <img id="img-connexion" src="img/img-connexion.jpg" alt="img-twitter">
                    </div>
                    <div class="col-lg-5 col-sm-12 index-text1">
                        <span id="index-span1">Voir ce qui se passe actuellement dans le monde</span>
                    </div>
                    <div class="col-lg-5 col-dm-7 index-text2">
                        <span id="index-span2">Rejoignez TweetAcademy dès aujourd'hui.</span>
                    </div>
                    <div class="redirect-btn">
                        <a href="views/ViewRegister.php"><input type="button" class="form-control col-lg-7 register" name="formindex" value="S'inscrire"></a>
                        <a href="views/ViewLogin.php"><input type="button" class="form-control col-lg-7 radius" name="formindex" value="Se connecter"></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div id="center-footer" class="col-12">
                    <a href="#"><span>A propos</span></a>
                    <a href="#"><span>Centre d'assistance</span></a>
                    <a href="#"><span>Conditions d’utilisation</span></a>
                    <a href="#"><span>Politique de Confidentialité</span></a>
                    <a href="#"><span>Politique relative aux cookies</span></a>
                    <a href="#"><span>Informations sur les publicités</span></a>
                    <a href="#"><span>Blog</span></a>
                    <a href="#"><span>Statut</span></a>
                    <a href="#"><span>Carrières</span></a>
                    <a href="#"><span>Ressources de la marque</span></a>
                    <a href="#"><span>Publicité</span></a>
                    <a href="#"><span>Marketing</span></a>
                    <a href="#"><span>Twitter pour les professionnels</span></a>
                    <a href="#"><span>Développeur</span></a>
                    <a href="#"><span>Répertoire</span></a>
                    <a href="#"><span>Paramètres</span></a>
                    <a href="#"><span>&copy 2021 Twitter, Inc</span></a>
                </div>
            </div>
        </div>
    </footer>


    <script type="text/javascript" src="./js/index.js"></script>
</body>

</html>