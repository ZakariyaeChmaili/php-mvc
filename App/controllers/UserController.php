<?php



#[Controller]
class UserController
{

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    #[Get("/user")]
    public function index()
    {

        $users = $this->userService->getUsers();
        View::view("users", ['users' => $users]);
    }

    #[Get("/user/addFormUser")]
    public function addFormUser()
    {
        View::view("formUser");
    }

    #[Get("user/updateFormUser/:id")]
    public function updateFormUser(string $id)
    {
        $userToUpdate = $this->userService->getUser($id);
        View::view("formUser", ['userToUpdate' => $userToUpdate]);
    }

    #[Post("user/save")]
    public function save()
    {
        $post = View::getPostData();
        $userDto = new UserDto();
        $userDto->setFirstName($post['firstName']);
        $userDto->setLastName($post['lastName']);
        $userDto->setAge($post['age']);
        $this->userService->saveUser($userDto);
        View::redirect("user");


    }

    #[Post("user/update")]
    public function update()
    {
        $post = View::getPostData();
        $userDto = new UserDto();
        $userDto->setId($post['id']);
        $userDto->setFirstName($post['firstName']);
        $userDto->setLastName($post['lastName']);
        $userDto->setAge($post['age']);
        $this->userService->updateUser($userDto);
        View::redirect("user");


    }

    #[Get("user/delete/:id")]
    public function delete(string $id): void
    {
        $this->userService->deleteUser($id);
        View::redirect("user");
    }


}