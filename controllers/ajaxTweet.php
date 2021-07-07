<?php
    require_once('./Router.php');
    spl_autoload_register(function ($class_name) {
        require_once(find_file("/models/$class_name.php"));
    });

    if($_POST['util'] == 'profile') {
        $users = new Users(); 
        $profile = $users->getByUsername($_SESSION["username"]);

        $users->closeConnection();
        echo json_encode($profile);

    } else if($_POST['util'] == 'comment') {
        $comments = new Comments();
        $res = $comments->insertInto($_POST['data']);
        searchForHashtags($_POST['data']['content'], $comments->getLastId());

        $comments->closeConnection();
        echo json_encode($res);

    } else if ($_POST['util'] == 'tweet') {
        $tweets = new Tweets();
        $res = $tweets->insertInto($_POST['data']);
        searchForHashtags($_POST['data']['content'], $tweets->getLastId());

        $tweets->closeConnection();
        echo json_encode($res);

    } else if ($_POST['util'] == 'mention') {
        $users = new Users();
        $search = $users->searchMention($_POST['data']);

        $users->closeConnection();
        echo json_encode($search);

    } else if ($_POST['util'] == 'image') {
        $path = '../images/storage/';
        $alpha = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $shuffle = str_shuffle($alpha);
        $id = '';
        do $id = substr($shuffle, rand(0, strlen($alpha) - 6), 6);
        while(file_exists($path . $id . $_POST['type']));
        
        $filename = $path . $id . $_POST['type'];
        $content = file_get_contents($_FILES["file"]["tmp_name"]);
        file_put_contents($filename, $content);
        echo json_encode(['id' => $id]);
    }

    function searchForHashtags($content, $tweet_id) {
        $match = [];
        preg_match_all("/( +|\s+)?(#\w*)/", $content, $match);

        $hashtags = new Hashtags();
        $tweets_hashtags = new TweetsHashtags();

        $id_hashtags = [];

        foreach ($match[2] as $v) {
            $current = $hashtags->getById($v);
            if(!$current) {
                $hashtags->insertInto(['hashtag' => $v]);
                $current = $hashtags->getById($v); 
            }
            array_push($id_hashtags, $current[0]['hashtag_id']);
        }
        $hashtags->closeConnection();

        foreach($id_hashtags as $id) {
            $tweets_hashtags->insertInto(['tweet_id' => $tweet_id, 'hashtag_id' => $id]);
        }

        $tweets_hashtags->closeConnection();
    }