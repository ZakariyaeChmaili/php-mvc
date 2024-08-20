<?php



use entities\User;

class UserDto
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private int $age;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }


    public function toEntity(): User
    {
        $user = new User();
        isset($this->id) and $user->setId($this->id);
        $user->setFirstName($this->firstName);
        $user->setLastName($this->lastName);
        $user->setAge($this->age);
        return $user;

    }


}