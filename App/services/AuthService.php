<?php

class AuthService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    /**
     * @throws Exception
     */
    public function authenticate($username, $password): void
    {
        $res = $this->userRepository->getUserByUsername(username: $username);
        $user = array_key_exists(0, $res) ? $res[0] : null;
        if ($user and password_verify($password, $user->getPassword())) {
            $_SESSION["user"] = $user->toDto();
        } else {
            throw new Exception("Invalid username or password");
        }

    }

    public function register(string $username, #[SensitiveParameter] string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($hashedPassword);
        $this->userRepository->saveUser($user);

    }

}