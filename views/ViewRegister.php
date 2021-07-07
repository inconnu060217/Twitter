<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
    <header>
        <a href="../index.php"><i class="fas fa-arrow-circle-left"></i>Retour</a>
    </header>
    <main class='container'>
        <div class='row'>
            <?php
            include_once("../controllers/getRegister.php");
            ?>
            <div class="formregister col-8">
                <div class="headform col-8">
                    <img class="logo-register col-2" src="../img/img-connexion.jpg" alt="logo">
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <h1 id='create-h1'>Crée votre compte</h1>
                    <?php
                    if (isset($error)) { ?>
                        <p class="error"><?php echo $error ?></p>
                    <?php } ?>

                    <div class="input-group">
                        <input type="text" id="validationCustom01" required class="register-input form-control col-9 " name="fullname" placeholder="Nom & Prénom" value="<?php if (isset($_POST["fullname"])) {
                                                                                                                                                                                echo $_POST["fullname"];
                                                                                                                                                                            } ?>">
                        <div class="invalid-feedback">
                            Veuillez entrer votre nom et ou prénom.
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" id="validationCustom02" required class="register-input form-control col-9" name="username" placeholder="Pseudo" value="<?php if (isset($_POST["username"])) {
                                                                                                                                                                        echo $_POST["username"];
                                                                                                                                                                    } ?>">
                        <div class="invalid-feedback">
                            Veuillez choisir un pseudo.
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="date" id="validationCustom03" required class="register-input form-control col-9" name="birthdate" value="<?php if (isset($_POST["birthdate"])) {
                                                                                                                                                    echo $_POST["birthdate"];
                                                                                                                                                } ?>">
                        <div class="invalid-feedback">
                            Veuillez entrer votre date de naissance.
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="tel" id="validationCustom04" required class="register-input form-control col-9" name="phone" placeholder="06 10 30 40 50" value="<?php if (isset($_POST["phone"])) {
                                                                                                                                                                            echo $_POST["phone"];
                                                                                                                                                                        } ?>">
                        <div class="invalid-feedback">
                            Veuillez entrer votre numéro de telephone.
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="email" id="validationCustom05" required class="register-input form-control col-9" name="email" placeholder="exemple@exemple.com" value="<?php if (isset($_POST["email"])) {
                                                                                                                                                                                    echo $_POST["email"];
                                                                                                                                                                                } ?>">
                        <div class="invalid-feedback">
                            Veuillez entrer entre votre email.
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="password" id="validationCustom06" required class=" register-input form-control col-9" name="password" placeholder="Mot de passe">
                        <div class="invalid-feedback">
                            Veuillez entrer votre mot de passe.
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="submit" class="radius register-input col-4" name="formregister" value="S'inscrire">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="../js/register.js"></script>
    </div>
</body>

</html>