<?php


class User
{
    private int $id;
    private string $first_name;
    private string $last_name;
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

    public function toDto(): UserDto
    {
        $userDto = new UserDto();
        $userDto->setId($this->id);
        $userDto->setFirstName($this->first_name);
        $userDto->setLastName($this->last_name);
        $userDto->setAge($this->age);
        return $userDto;

    }
}