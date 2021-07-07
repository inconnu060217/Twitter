<?php

include_once('../controllers/Router.php');
include_once("../models/Users.php");
class Login
{
    public $userName;
    public $password;
    public function __construct($userName, $password)
    {
        $userName = htmlspecialchars($userName);

        $password = hash_hmac('ripemd160', $password, 'vive le projet tweet_academy');
        // $password = $password;


        $this->userName = $userName;
        $this->password = $password;
    }
    public function getLogin()
    {
        if (!empty($this->userName) AND !empty($this->password)) {
            $bdd = new Users;
            $infos = $bdd->getLogin($this->userName);
            if ($infos !== false) {
                if ($this->password === $infos['password']) {
                    $_SESSION['username'] = $infos['username'];
                    header("location: ../profile.php?username=" . $_SESSION['username']);
                } else {
                    return "Le mot de passe que vous avez saisi ne correspondent pas à ceux présents dans nos fichiers. Veuillez vérifier et réessayer.";
                }
            } else {
                return "Le nom d'utilisateur que vous avez saisi ne correspondent pas à ceux présents dans nos fichiers. Veuillez vérifier et réessayer.";
            }
        } else {
            return "Vieuillez entre vos identifiants.";
        }
    }
}
if (isset($_POST['usernameLogin']) AND isset($_POST['passwordLogin'])) {
    $login = new Login($_POST['usernameLogin'], $_POST['passwordLogin']);
    $message = $login->getLogin();
}
