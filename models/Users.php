<?php

require_once(find_file('models/Database.php'));
// require_once('Database.php');
class Users extends Database
{
    protected $_table;
    protected $_condition;

    public function __construct()
    {
        $this->_table = 'users';
        $this->_condition = 'user_id = ?';
        $this->connectToDatabase();
    }

    public function getByUsername($username)
    {
        $handle = $this->_db->prepare("SELECT * FROM users WHERE username = ?");
        $handle->execute([$username]);
        $res = $handle->fetch();
        $handle->closeCursor();
        return $res;
    }

    public function getLogin($username)
    {
        $handle = $this->_db->prepare("SELECT * FROM users WHERE username = '$username' OR email = '$username' OR phone = '$username'");
        $handle->execute();
        $res = $handle->fetch();
        $handle->closeCursor();
        return $res;
    }

    public function searchMention($string)
    {
        $handle = $this->_db->prepare("SELECT * FROM users WHERE username LIKE ?");
        $handle->execute(["%$string%"]);
        $res = $handle->fetchAll();
        $handle->closeCursor();
        return $res;
    }

    public function searchUsername($search)
    {
        $handle = $this->_db->prepare("SELECT username FROM users WHERE username LIKE %" . $search . "%");
        $handle->execute();
    }

    public function getByEmail($email)
    {
        $handle = $this->_db->prepare("SELECT email FROM users WHERE email='$email'");
        $handle->execute();
        return $handle->rowCount();
    }
}

    // EXAMPLES

    // $user = new Users();
    // var_dump($user->getAll());
    
    // var_dump($user->getById(2));
    // var_dump($user->deleteById(5));
    // var_dump($user->insertInto([
    //     'fullname' => 'John Smith', 
    //     'birthdate' => '2000/01/02', 
    //     'number' => '123456789',
    //     'email' => 'test@gmail',
    //     'password' => 'test1234',
    //     'picture' => '',
    //     'header' => '',
    //     'biography' => 'Test John Smith',
    //     'pseudo' => 'deijfgzerio4']
    // ));
    // var_dump($user->updateTable([
    //     'fullname' => 'John Smith', 
    //     'birthdate' => '2000/01/02', 
    //     'number' => '123456789',
    //     'email' => 'test@gmail',
    //     'password' => 'test1234',
    //     'picture' => '',
    //     'header' => '',
    //     'biography' => 'Test John Smith',
    //     'pseudo' => 'ça marche on est bon'] , 2
    // ));
