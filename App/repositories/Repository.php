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
        $prepare = $this->db->prepare($query);
        $prepare->setFetchMode(PDO::FETCH_CLASS, $className);
        $prepare->execute($params);
        return $prepare->fetchAll();

    }

    protected function query($className, $query, $params = []): User|bool
    {
        $prepare = $this->db->prepare($query);
        $prepare->setFetchMode(PDO::FETCH_CLASS, $className);
        $prepare->execute($params);
        return $prepare->fetch();

    }

}