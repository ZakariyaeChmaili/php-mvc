<?php




class UserDto
{
    private int $id=0;
    private string $firstName="";
    private string $lastName="";
    private int $age=0;
    private string $username="";


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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function toEntity(): User
    {
        $user = new User();
        isset($this->id) and $user->setId($this->id);
        $user->setFirstName($this->firstName);
        $user->setLastName($this->lastName);
        $user->setAge($this->age);
        $user->setUsername($this->username);
        return $user;

    }


}