<header>
    <div class='row header'>
        <!-- Cette partie ne change que si on est connecter ou pas -->
        <div class="logo-dark">
            <a class='fixe-size-19 black-link' href='index.php'>
                <div class='navbar-left radius logo'>
                    <i class="fab fa-twitter fa-2x"></i>
                </div>
            </a>
            <input type='checkbox' id='darkModeToggle' />
            <label for='darkModeToggle'>Night</label>
            <!-- <button id="darkModeToggle">Night</button> -->
        </div>
        <a class='fixe-size-19 black-link' href='index.php'>
            <div class='navbar-left radius'>
                <i class="fas fa-hashtag fa-2x"></i>
                Explorer
            </div>
        </a>
        <?php if ($_SESSION['username']) { ?>
            <!-- Ici mettre la view de connecter/pas connecter ? -->
            <a class='fixe-size-19 black-link' href='messages.php?username=<?php echo $_SESSION["username"] ?>'>
                <div class='navbar-left radius'>
                    <i class="far fa-envelope fa-2x"></i>
                    Messages
                </div>
            </a>

            <a class='fixe-size-19 black-link' href='profile.php?username=<?php echo $_SESSION["username"] ?>'>
                <div class='navbar-left radius'>
                    <i class="far fa-user fa-2x"></i>
                    Profile
                </div>
            </a>

            <a class='fixe-size-19 black-link' href='settings.php?username=<?php echo $_SESSION["username"] ?>'>
                <div class='navbar-left radius'>
                    <i class="fas fa-cogs fa-2x"></i>
                    Settings
                </div>
            </a>

            <div class='col-12 my-2'>
                <button class='btn tweet_btn' data-role='tweet'>Tweeter</button>
            </div>
        <?php } ?>
    </div>
</header>
