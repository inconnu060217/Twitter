<?php
    if(!isset($_GET['action']) || !isset($_GET['username'])) header("location:javascript://history.go(-1)");

    spl_autoload_register(function ($class_name) {
        require_once(find_file("/models/$class_name.php"));
    });

    $follows = new Follows();
    $users = new Users();
    $response = [];

    $target = $users->getByUsername($_GET['username'])['user_id'];

    if($_GET['action'] == 'followers') {
        $array_id = $follows->getFollowersById($target);
        foreach($array_id as $k => $e) $response[$k] = $users->getById($e['follower_id'])[0];
    } else if ($_GET['action'] == 'followings') {
        $array_id = $follows->getFollowingsById($target);
        foreach($array_id as $k => $e) $response[$k] = $users->getById($e['user_id'])[0];
    }

    $users->closeConnection();
    $follows->closeConnection();