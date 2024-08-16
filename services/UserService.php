<?php


class UserService
{

    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }

    public function getUsers(): array
    {
        return array_map(function (User $user) {
            return $user->toDto();
        }, $this->userRepo->getUsers());
    }

}