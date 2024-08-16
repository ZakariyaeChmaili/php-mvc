<?php

class UserController extends Controller {

    private $userService;
    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    public function index(){

        $users = $this->userService->getUsers();
        $this->view->view("users",['users' => $users]);
    }
}