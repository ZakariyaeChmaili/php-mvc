<?php

class UserController extends Controller
{

    private $userService;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    public function index()
    {

        $users = $this->userService->getUsers();
        $this->view->view("users", ['users' => $users]);
    }

    public function addFormUser()
    {

        $this->view->view("formUser");
    }

    public function updateFormUser()
    {
        $get = $this->view->getGetData();
        $userId = $get["id"];
        $userToUpdate = $this->userService->getUser($userId);

        $this->view->view("formUser", ['userToUpdate' => $userToUpdate]);
    }
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

    public function delete(): void
    {
        $get = $this->view->getGetData();
        $id = $get['id'];
        $this->userService->deleteUser($id);
        $this->view->redirect("user");
    }


}