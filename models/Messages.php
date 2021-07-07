<?php
require_once(find_file('./models/Database.php'));
class Messages extends Database
{
    protected $_table;
    protected $_condition;

    public function __construct()
    {
        $this->_table = 'messages';
        $this->_condition = 'user_id = ?';
        $this->connectToDatabase();
    }
}
