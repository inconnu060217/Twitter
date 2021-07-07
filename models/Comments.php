<?php
    require_once(find_file('models/Database.php'));
    Class Comments extends Database {
        protected $_table;
        protected $_condition;

        public function __construct() {
            $this->_table = 'comments';
            $this->_condition = 'tweet_id = ?';
            $this->connectToDatabase();
        }
    }