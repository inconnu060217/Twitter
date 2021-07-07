<?php
require_once(find_file('models/Database.php'));
class Follows extends Database
{
    protected $_table;
    protected $_condition;

    public function __construct()
    {
        $this->_table = 'follows';
        $this->_condition = 'follower_id = ?';
        $this->connectToDatabase();
    }

    public function getFollowers($id)
    {
        $handle = $this->_db->prepare("SELECT  * FROM $this->_table WHERE user_id = ?");
        $handle->execute([$id]);
        $res = $handle->fetchAll();
        if (count($res) === 0) return 0;
        $handle->closeCursor();
        return count($res);
    }

    public function getFollows($id)
    {
        $handle = $this->_db->prepare("SELECT  * FROM $this->_table WHERE follower_id = ?");
        $handle->execute([$id]);
        $res = $handle->fetchAll();
        if (count($res) === 0) return 0;
        $handle->closeCursor();
        return count($res);
    }

    public function isFollowing($follower, $followed)
    {
        $handle = $this->_db->prepare("SELECT  * FROM $this->_table WHERE follower_id = ? AND user_id = ?");
        $handle->execute([$follower, $followed]);
        $res = $handle->fetch();
        $handle->closeCursor();
        return $res ? true : false;
    }

    public function setCondition($condition) { $this->_condition = $condition; }

    public function getFollowersById($id) {
        $this->setCondition('user_id = ?');
        return parent::getById($id);
    }
    
    public function getFollowingsById($id) {
        $this->setCondition('follower_id = ?');
        return parent::getById($id);
    }
}
