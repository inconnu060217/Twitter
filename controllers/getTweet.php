<?php
    require_once(find_file("/controllers/Tweet_Item.php"));
    spl_autoload_register(function ($class_name) {
        require_once(find_file("/models/$class_name.php"));
    });
    function getTweet($id) {
        if(!$id) return;
        $tweets = new Tweets();

        $info = $tweets->getById($id);
        $tweets->closeConnection();
        if(!$info) return [];
        return new Tweet_Item($info[0]);
    }