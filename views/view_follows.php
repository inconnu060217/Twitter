<?php
    if ($_GET['action'] == 'followers') {
        echo '<h2 class="my-5 text-center">Liste des abonnés :</h2>';
    } else if ($_GET['action'] == 'followings') {
        echo '<h2 class="my-5 text-center">Liste des abonnements :</h2>';
    }

    // var_dump($response);
    foreach ($response as $e) {
        echo <<<HTML
        <div class="tweet_container row p-3">
            <div class="col-2 link-profile">
                <a href="profile.php?username=$e[username]" class="link-profile">
                    <div class="tweet_profile_pic light">
                        <img src="images/pictures/$e[picture]" style="width: 100%; height:100%;">
                    </div>
                </a>
            </div>
            <div class="tweet_body col-10 row">
                <div class="col-12">
                    <a href="profile.php?username=$e[username]" class="link-profile row">
                        <span class="col-12">$e[fullname]</span>
                        <span class="col-12 text-muted">@$e[username]</span>
                        <span class="col-12">$e[biography]</span>
                    </a>
                </div>
            </div>
        </div>
        HTML;
    }