<?php
class Database
{
    protected $_db;

    public function connectToDatabase()
    {
        $credentials = [];
        $fopen = fopen(find_file("models/credentials"), 'r');
        // $fopen = fopen("../models/credentials", 'r');
        while (true) {
            $line = fgets($fopen);
            array_push($credentials, trim($line));
            if (feof($fopen)) break;
        }
        fclose($fopen);
        $db = new PDO('mysql:host=127.0.0.1;dbname=common-database;charset=utf8', $credentials[0], $credentials[1]);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->_db = $db;
    }

    public function closeConnection()
    {
        $this->_db = null;
    }

    public function insertInto($array)
    {
        // $this->connectToDatabase();
        $columns = implode('`, `', array_keys($array));
        $values = implode("', '", array_values($array));
        $handle = $this->_db->prepare("INSERT INTO $this->_table(`$columns`) VALUES('$values')");
        $handle->execute();
        $res = $handle->fetchAll();
        $handle->closeCursor();
        return $res;
    }

    public function getAll()
    {
        // $this->connectToDatabase();
        $handle = $this->_db->prepare('SELECT * FROM ' . $this->_table);
        $handle->execute();
        $res = $handle->fetchAll();
        $handle->closeCursor();
        return $res;
    }

    public function getById($id)
    {
        // $this->connectToDatabase();
        $handle = $this->_db->prepare('SELECT * FROM ' . $this->_table . ' WHERE ' . $this->_condition);
        $handle->execute([$id]);
        $res = $handle->fetchAll();
        $handle->closeCursor();
        return $res;
    }

    public function updateTable($array, $id)
    {
        // $this->connectToDatabase();
        $string = '';
        foreach ($array as $k => $v) $string .= " `$k` = '$v',";
        $string = substr($string, 0, -1);
        $handle = $this->_db->prepare("UPDATE $this->_table SET $string WHERE $this->_condition");
        return $handle->execute([$id]);
    }

    public function deleteById($id)
    {
        // $this->connectToDatabase();
        $handle = $this->_db->prepare('DELETE FROM ' . $this->_table . ' WHERE ' . $this->_condition);
        $handle->execute([$id]);
    }

    public function getLastId() { return $this->_db->lastInsertId(); }
}
