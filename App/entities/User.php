<?php


#[Entity("users")]
class User
{
    #[Id]
    #[Column("id", ColumnTypes::INT)]
    private int $id=0;
    #[Column("first_name", ColumnTypes::STRING)]
    private string $first_name="";
    #[Column("last_name", ColumnTypes::STRING)]
    private string $last_name="";
    #[Column("age", ColumnTypes::INT)]
    private int $age=0;
    #[Column("username", ColumnTypes::STRING)]
    private string $username = "";
    #[Column("password", ColumnTypes::STRING)]
    private string $password = "";


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
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function toDto(): UserDto
    {
        $userDto = new UserDto();
        $userDto->setId($this->id);
        $userDto->setFirstName($this->first_name);
        $userDto->setLastName($this->last_name);
        $userDto->setAge($this->age);
        $userDto->setUsername($this->username);
        return $userDto;

    }
}