<?php


class SettingsModels extends Database
{
    protected $_table;
    protected $_condition;

    public function __construct()
    {
        $this->_table = 'users';
        $this->_condition = 'user_id = ?';
        $this->connectToDatabase();
    }

    public function compareSettings($username)
    {
        return $this->_db->query("SELECT * FROM " . $this->_table . " WHERE username = '" . $username . "';")->fetch();
    }
}
