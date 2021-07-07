<?php
require_once('Router.php');
require_once(find_file('models/Users.php'));
require_once(find_file('models/Settings.php'));

class Settings
{
    private $newPseudo;
    private $newEmail;
    private $newNumber;
    private $newPassword;
    private $newPassword1;
    private $newPicture;
    private $newBanner;

    public function __construct(
        $newPseudo = null,
        $newEmail = null,
        $newNumber = null,
        $newPassword = null,
        $newPassword1 = null,
        $newPicture = null,
        $newBanner = null
    ) {

        $this->newPseudo = $newPseudo;
        $this->newEmail = $newEmail;
        $this->newNumber = $newNumber;
        $this->newPassword = $newPassword;
        $this->newPassword1 = $newPassword1;
        $this->newPicture = $newPicture;
        $this->newBanner = $newBanner;

        $maxSize = 2097152;
        $this->maxSize = $maxSize;

        $extensionFile = array('jpg', 'jpeg', 'gif', 'png');
        $this->extensionFile = $extensionFile;
    }

    public function getUpdate()
    {
        $dataSettings = [];
        $bdd = new SettingsModels();
        $result = $bdd->compareSettings($_SESSION['username']);

        if (isset($_SESSION['username'])) {
            if (isset($this->newPseudo) && !empty($this->newPseudo) && $this->newPseudo != $result['username']) {
                $dataSettings['username'] = $this->newPseudo;
            }
            if (isset($this->newEmail) && !empty($this->newEmail) && $this->newEmail != $result['email']) {
                $dataSettings['email'] = $this->newEmail;
            }
            if (isset($this->newNumber) && !empty($this->newNumber) && $this->newNumber != $result['phone']) {
                $dataSettings['phone'] = $this->newNumber;
            }
            if (isset($this->newPassword) && !empty($this->newPassword) && isset($this->newPassword1) && !empty($this->newPassword1)) {
                if ($this->newPassword == $this->newPassword1) {
                    $dataSettings['password'] = $this->newPassword;
                } else {
                    return "Les deux mots de passe ne correspondent pas !";
                }
            }
            if (isset($this->newPicture) and !empty($this->newPicture['name'])) {
                if ($this->newPicture['size'] <= $this->maxSize) {
                    $extensionUpload = strtolower(substr(strrchr($this->newPicture['name'], '.'), 1));

                    var_dump($this->extensionFile);

                    if (in_array($extensionUpload, $this->extensionFile)) {
                        $chemin = "images/pictures/" . $_SESSION['username'] . "." . $extensionUpload;
                        $resultat = move_uploaded_file($this->newPicture['tmp_name'], $chemin);
                        if ($resultat) {
                            $dataSettings['picture'] = $_SESSION['username'] . '.' . $extensionUpload;
                        } else {
                            return "Erreur durant l'importation de votre photo de profil";
                        }
                    } else {
                        return "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    }
                } else {
                    return "Votre photo de profil ne doit pas dépasser 2Mo";
                }
            }
        }
        if (isset($this->newBanner) and !empty($this->newBanner['name'])) {
            if ($this->newBanner['size'] <= $this->maxSize) {
                $extensionUploadBanner = strtolower(substr(strrchr($this->newBanner['name'], '.'), 1));

                if (in_array($extensionUploadBanner, $this->extensionFile)) {
                    $cheminBanner = "images/banners/" . $_SESSION['username'] . "." . $extensionUploadBanner;
                    $resultatBanner = move_uploaded_file($this->newBanner['tmp_name'], $cheminBanner);

                    if ($resultatBanner) {
                        $dataSettings['banner'] = $_SESSION['username'] . '.' . $extensionUploadBanner;
                        var_dump($_SESSION['username']);
                    } else {
                        return "Erreur durant l'importation de votre bannière.";
                    }
                } else {
                    return "Votre bannière doit être au format jpg, jpeg, gif ou png";
                }
            } else {
                return "Votre bannière ne doit pas dépasser 2Mo";
            }
        }

        if (!empty($dataSettings)) {
            if ($this->newPseudo == null) {
                $bdd->updateTable($dataSettings, $result['user_id']);
                header('Location: profile.php?username=' . $_SESSION['username']);
            } else {
                $bdd->updateTable($dataSettings, $result['user_id']);
                $_SESSION['username'] = $this->newPseudo;
                header('Location: profile.php?username=' . $this->newPseudo);
            }
        }
    }
}

$newPseudo = htmlspecialchars($_POST['newpseudo']);
$newEmail = htmlspecialchars($_POST['newemail']);
$newNumber = is_int($_POST['newnumber']);
$newPassword = $_POST['newmdp'];
$newPassword1 = $_POST['newmdp1'];
// $newPassword = hash_hmac('ripemd160', $_POST['newmdp'], 'vive le projet tweet_academy');
// $newPassword1 = hash_hmac('ripemd160', $_POST['newmdp1'], 'vive le projet tweet_academy');


$up = new Settings(
    $newPseudo,
    $newEmail,
    $newNumber,
    $newPassword,
    $newPassword1,
    $_FILES['picture'],
    $_FILES['banner']
);
$up->getUpdate();