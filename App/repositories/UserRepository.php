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

    public function getUser(int $id): array
    {
        $sql = "SELECT * FROM users where id = :id";
        $params = ["id" => $id];
        return $this->fetch("User", $sql, $params);
    }

    public function saveUser(User $user): bool
    {
        $sql = "INSERT INTO users (first_name, last_name, age) VALUES (:firstName, :lastName, :age)";
        $params = [
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "age" => $user->getAge()
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


//    public function getUserByUsernameAndPassword(string $username, string $password): User{
//
//        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
//        password_hash()
//    }

}