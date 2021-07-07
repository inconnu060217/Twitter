<?php
if (count($profile) > 2) {
?>
    <div class='row border-x'>
        <div class='col-12 my-2'>
            <h5><?php echo $profile['fullname'] ?></h5>
        </div>
        <div class='col-12 profile-background light' style="background-image: url('images/banners/<?php echo $profile['banner'] ?>')">
            <div class='profile-container light'>
                <img class='profile-picture img-fluid' src='images/pictures/<?php echo $profile['picture'] ?>'>
            </div>
        </div>
        <div class='col-12 text-right mt-2'>
        <?php
        if($profile['status']) $arr = ['class' => 'button-light', 'val' => 'Abonné'];
        if(!$profile['status']) $arr = ['class' => 'button-outline-light', 'val' => 'Suivre'];
        if($_SESSION['username'] === $_GET['username']) $arr['style'] = "visibility: hidden";
        echo <<<HTML
            <button class="{$arr['class']} btn-rounded follow_btn" style="{$arr['style']}">{$arr['val']}</button>
        HTML;
        ?>
        </div>

        <div class='col-12 mt-5'>
            <h5><?php echo $profile['fullname'] ?></h5>
        </div>
        <div class='col-12'>
            <h6 class='text-muted username'><?php echo '@' . $profile['username'] ?></h6>
        </div>
        <div class='col-12'>
            <p><?php echo $profile['biography'] ?></p>
        </div>
        <div class='col-12'>
            <p class='text-muted'>
                <svg viewBox="0 0 24 24" class='small_icons light'"><g><path d=" M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path>
                    <circle cx="7.032" cy="8.75" r="1.285"></circle>
                    <circle cx="7.032" cy="13.156" r="1.285"></circle>
                    <circle cx="16.968" cy="8.75" r="1.285"></circle>
                    <circle cx="16.968" cy="13.156" r="1.285"></circle>
                    <circle cx="12" cy="8.75" r="1.285"></circle>
                    <circle cx="12" cy="13.156" r="1.285"></circle>
                    <circle cx="7.032" cy="17.486" r="1.285"></circle>
                    <circle cx="12" cy="17.486" r="1.285"></circle>
                    </g>
                </svg>
                A rejoint Twitter en <?php echo $profile['register_date'] ?>
            </p>
        </div>
        <div class='row col-12'>
            <div class='col-6'>
                <a href='<?php echo "./follows.php?username=$profile[username]&action=followings"?>'>
                    <p><?php echo "<span class='text-muted'>$profile[follows]</span>" ?> Abonnements</p>
                </a>
            </div>
            <div class='col-6'>
                <a href='<?php echo "./follows.php?username=$profile[username]&action=followers"?>'>
                    <p><?php echo "<span class='text-muted followers'>$profile[followers]</span>" ?> Abonnés</p>
                </a>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class='row border-x'>
        <div class='col-12 my-2'>
            <h5>Profile</h5>
        </div>
        <div class='col-12 profile-background light'>
            <div class='profile-container light'>
                <img class='profile-picture img-fluid'>
            </div>
        </div>
        <div class='col-12 mt-5'>
            <h5 class='mt-4'><?php echo '@' . $profile['username'] ?></h5>
        </div>
    </div>
    <div class="tweet_container row p-3" style="border: 0.5px solid #ebeef0; cursor: default;">
        <div class="tweet_body col row">
            <div class="col-12 text-center">
                <h5>This account doesn’t exist</h5>
            </div>
            <div class="col-12 text-center">
                <h6 class="text-muted">Try searching for another.</h6>
            </div>
        </div>
    </div>

<?php } ?>