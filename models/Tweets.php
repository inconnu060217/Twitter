<?php
    require_once(find_file('./models/Database.php'));
    Class Tweets extends Database {
        protected $_table;
        protected $_condition;

        public function __construct() {
            $this->_table = 'tweets';
            $this->_condition = 'user_id = ?';
            $this->connectToDatabase();
        }

        public function getByUserId($userId) {
            $this->setCondition('user_id = ?');
            return parent::getById($userId);
        }

        public function getById($id) {
            $this->setCondition('tweet_id = ?');
            return parent::getById($id);
        }

        public function setCondition($condition) { $this->_condition = $condition; }
    }