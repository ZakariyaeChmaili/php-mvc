<?php

class Repository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

    }


    protected function fetch($className, $query, $params = []): false|array
    {

        $prepare = $this->db->prepare($query, $params);
        $prepare->setFetchMode(PDO::FETCH_CLASS, $className);
        $prepare->execute();
        return $prepare->fetchAll();

    }

}