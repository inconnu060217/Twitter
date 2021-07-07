<?php
require_once("./Router.php");
require_once("../models/Users.php");

class SearchUser
{
    public $search;

    public function __construct($search)
    {
        $search = htmlspecialchars($search);
        $this->search = $search;
    }

    public function getSearch()
    {
        if (!empty($this->search)) {
            $bdd = new Users;
            return $bdd->searchMention($this->search);
        }
    }
}


// if (isset($_GET['search'])) {
//     $user = new SearchUser($_GET['search']);
//     $searchName = $user->getSearch();
//     var_dump($searchName);
// }
