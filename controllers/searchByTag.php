<?php
    function searchByTag($tag) {
        require_once(find_file("/controllers/Tweet_Item.php"));
        spl_autoload_register(function ($class_name) {
            require_once(find_file("/models/$class_name.php"));
        });

        if(!$tag) return;
        $hashtags = new Hashtags();
        $tweets_hashtags = new TweetsHashtags();

        $hashtag = $hashtags->getById('#' . $tag);
        $hashtags->closeConnection();

        $search = $tweets_hashtags->getById($hashtag[0]['hashtag_id']);
        $tweets_hashtags->closeConnection();

        $finalArray = [];
        $tweets = new Tweets();
        foreach ($search as $k) array_push($finalArray, new Tweet_Item($tweets->getById($k['tweet_id'])[0]));

        return $finalArray;
    }