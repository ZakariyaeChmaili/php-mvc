<?php

class UserController extends Controller
{

    private $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    #[Route("/user", RequestMethod::GET)]
    public function index()
    {

        $users = $this->userService->getUsers();
        $this->view->view("users", ['users' => $users]);
    }

    #[Route("/user/addFormUser", RequestMethod::GET)]
    public function addFormUser()
    {
        $this->view->view("formUser");
    }

    #[Route("user/updateFormUser/:id", RequestMethod::GET)]
    public function updateFormUser(string $id)
    {
        $userToUpdate = $this->userService->getUser($id);
        $this->view->view("formUser", ['userToUpdate' => $userToUpdate]);
    }

    #[Route("user/save", RequestMethod::POST)]
    public function save()
    {
        $post = $this->view->getPostData();
        $userDto = new UserDto();
        $userDto->setFirstName($post['firstName']);
        $userDto->setLastName($post['lastName']);
        $userDto->setAge($post['age']);
        $this->userService->saveUser($userDto);
        $this->view->redirect("user");


    }

    #[Route("user/update", RequestMethod::POST)]
    public function update()
    {
        $post = $this->view->getPostData();
        $userDto = new UserDto();
        $userDto->setId($post['id']);
        $userDto->setFirstName($post['firstName']);
        $userDto->setLastName($post['lastName']);
        $userDto->setAge($post['age']);
        $this->userService->updateUser($userDto);
        $this->view->redirect("user");


    }

    #[Route("user/delete/:id",RequestMethod::GET)]
    public function delete(string $id): void
    {
        $this->userService->deleteUser($id);
        $this->view->redirect("user");
    }


}