<?php

namespace kah\src\model;

abstract class BddManager
{
    private $bdd;

    public function __construct()
    {

        $this->bdd = new \PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '');
 
    }

    public function getBdd()
    {
        return $this->bdd;
    }
    public function delete($table, $id)
    {
        $db = $this->bdd;
        $delt = $db->exec("DELETE FROM $table WHERE id = $id ");
        return $delt;
    }
   
}