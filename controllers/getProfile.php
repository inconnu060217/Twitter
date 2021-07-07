<?php
    function getProfile($username) {
        require_once(find_file("/controllers/Tweet_Item.php"));
        spl_autoload_register(function ($class_name) {
            require_once(find_file("/models/$class_name.php"));
        });

        $user = new Users();
        $follows = new Follows();
        $tweets = new Tweets();

        $profile = $user->getByUsername($username);
        if($profile) {
            setlocale(LC_TIME, 'fr_FR.utf8');
            $profile['register_date'] = strftime("%B %Y",strtotime($profile['register_date']));
            $profile['followers'] = $follows->getFollowers($profile['user_id']);
            $profile['follows'] = $follows->getFollows($profile['user_id']);
            $profile['status'] = $follows->isFollowing($user->getByUsername($_SESSION['username'])['user_id'] , $profile['user_id']);
            $profile['tweets'] = [];
            foreach($tweets->getByUserId($profile['user_id']) as $tweet) array_push($profile['tweets'], new Tweet_Item($tweet));
        } else {
            $profile['username'] = $username;
            $profile['fullname'] = '';
        }

        return $profile;
    }