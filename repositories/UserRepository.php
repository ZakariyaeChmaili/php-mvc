<?php


class UserRepository extends Repository
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getUsers(): array
    {
        $sql = "SELECT * FROM users";
        return $this->fetch("User", $sql);
    }


}