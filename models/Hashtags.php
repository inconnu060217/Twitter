<?php
    require_once(find_file('/models/Database.php'));
    Class Hashtags extends Database {
        protected $_table;
        protected $_condition;

        public function __construct() {
            $this->_table = 'hashtags';
            $this->_condition = 'hashtag = ?';
            $this->connectToDatabase();
        }   

    }