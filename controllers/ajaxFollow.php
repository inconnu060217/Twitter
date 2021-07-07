<?php
    require_once('./Router.php');
    spl_autoload_register(function ($class_name) {
        require_once(find_file("/models/$class_name.php"));
    });

    $users = new Users();
    $me = $users->getByUsername($_SESSION['username'])['user_id'];
    $you = $users->getByUsername($_POST['username'])['user_id'];
    $users->closeConnection();

    $follows = new Follows();

    if(!$follows->isFollowing($me, $you)) {
        $follows->insertInto([
            'follower_id' => $me,
            'user_id' => $you
        ]);
    
        echo json_encode(['following' => $follows->isFollowing($me, $you)]);
    } else {
        $follows->deleteById($me);
        echo json_encode(['following' => $follows->isFollowing($me, $you)]);
    }

