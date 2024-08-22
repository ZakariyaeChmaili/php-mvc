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

    public function getUserById(int $id): array
    {
        $sql = "SELECT * FROM users where id = :id";
        $params = ["id" => $id];
        return $this->fetch("User", $sql, $params);
    }

    public function saveUser(User $user): bool
    {
        $sql = "INSERT INTO users (first_name, last_name, age, username, password) VALUES (:firstName, :lastName, :age, :username, :password)";
        $params = [
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "age" => $user->getAge(),
            "username" => $user->getUsername(),
            "password" => $user->getPassword()
        ];
        return $this->query("User", $sql, $params);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $params = [
            "id" => $id
        ];
        return $this->query("User", $sql, $params);
    }

    public function updateUser(User $user): User|bool
    {
        $sql = "UPDATE users SET first_name = :firstName, last_name = :lastName, age = :age WHERE id = :id";
        $params = [
            "id" => $user->getId(),
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "age" => $user->getAge()
        ];
        return $this->query("User", $sql, $params);
    }

    public function getUserByUsername(string $username): false|array
    {
        $sql = "SELECT * FROM users where username = :username ;";
        $params = [
            "username" => $username,
        ];
        return $this->fetch("User", $sql, $params);
    }

}