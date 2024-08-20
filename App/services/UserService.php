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

    public function getUser(int $id): UserDto
    {
        return array_map(function (User $user) {
            return $user->toDto();
        }, $this->userRepo->getUser($id))[0];
    }


    public function saveUser(UserDto $user): UserDto|bool
    {
        return $this->userRepo->saveUser($user->toEntity());
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepo->delete($id);
    }

    public function updateUser(UserDto $userDto)
    {
        return $this->userRepo->updateUser($userDto->toEntity());

    }


}