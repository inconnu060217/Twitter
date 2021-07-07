<?php
include_once('../controllers/Router.php');
include_once("../models/Users.php");


class Register
{
    public $fullname;
    public $username;
    public $birthdate;
    public $phone;
    public $email;
    public $password;

    public function __construct($fullname, $username, $birthdate, $phone, $email, $password)
    {
        $fullname = htmlspecialchars($fullname);
        $username = htmlspecialchars($username);
        $birthdate = htmlspecialchars($birthdate);
        $phone = htmlspecialchars($phone);
        $email = htmlspecialchars($email);
        $password = hash_hmac('ripemd160', $password, 'vive le projet tweet_academy');

        $this->fullname = $fullname;
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
    }

    public function getRegister()
    {
        if (!empty($this->fullname) && !empty($this->username) && !empty($this->birthdate) && !empty($this->phone) && !empty($this->email) && !empty($this->password)) {

            $age = $this->birthdate;
            $now = date("Y-m-d");
            $calculAge = date_diff(date_create($age), date_create($now));
            $calculAge = $calculAge->format('%y');

            $bdd = new Users;
            $reqEmail = $bdd->getByEmail($this->email);
            if ($reqEmail == 0) {
                if ($calculAge >= 18) {
                    $bdd->insertInto([
                        'fullname' => $this->fullname,
                        'birthdate' => $this->birthdate,
                        'phone' => $this->phone,
                        'email' => $this->email,
                        'password' => $this->password,
                        'picture' => '',
                        'banner' => '',
                        'biography' => '',
                        'username' => $this->username

                    ]);
                    return  "Votre compte à bien été créer ! <a href=\"../views/ViewLogin.php\">Me connecter</a>";
                } else {
                    return "Inscription réservée aux +18ans";
                }
            } else {
                return "Cette email est déja utilisé!";
            }
        } else {
            return "Tous les champs doivent être complétés !";
        }
    }
}

if (isset($_POST['formregister'])) {
    if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['birthdate']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {
        $registers = new Register($_POST['fullname'], $_POST['username'], $_POST['birthdate'], $_POST['phone'], $_POST['email'], $_POST['password']);
        $error = $registers->getRegister();
    }
}
