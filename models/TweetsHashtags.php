<?php
    require_once(find_file('/models/Database.php'));
    Class TweetsHashtags extends Database {
        protected $_table;
        protected $_condition;

        public function __construct() {
            $this->_table = 'tweets_hashtags';
            $this->_condition = 'hashtag_id = ?';
            $this->connectToDatabase();
        }   

    }