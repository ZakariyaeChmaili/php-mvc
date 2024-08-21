<?php



#[Controller]
class UserController
{

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    #[Route("/user", RequestMethod::GET)]
    public function index()
    {

        $users = $this->userService->getUsers();
        View::view("users", ['users' => $users]);
    }

    #[Route("/user/addFormUser", RequestMethod::GET)]
    public function addFormUser()
    {
        View::view("formUser");
    }

    #[Route("user/updateFormUser/:name/:id", RequestMethod::GET)]
    public function updateFormUser(string $id)
    {
        $userToUpdate = $this->userService->getUser($id);
        View::view("formUser", ['userToUpdate' => $userToUpdate]);
    }

    #[Route("user/save", RequestMethod::POST)]
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

    #[Route("user/update", RequestMethod::POST)]
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

    #[Route("user/delete/:id", RequestMethod::GET)]
    public function delete(string $id): void
    {
        $this->userService->deleteUser($id);
        View::redirect("user");
    }


}