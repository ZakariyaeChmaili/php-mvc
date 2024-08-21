<?php

class AuthService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    public function authenticate($username, $password)
    {


    }

    public function register(string $username,#[SensitiveParameter] string $password){
        $hashedPassword = password_hash($password,PASSWORD_BCRYPT );
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($hashedPassword);
        $this->userRepository->saveUser($user);

    }

}