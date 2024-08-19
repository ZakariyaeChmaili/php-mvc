<?php

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }


    #[Route("/auth/login",RequestMethod::GET)]
    public function login(){
        $this->view->view("auth/view.login");
    }

    #[Route("/auth/register",RequestMethod::GET)]
    public function register(){


        $this->view->view("auth/view.register");
    }

    #[Route("/auth/signUp",RequestMethod::POST)]
    public function signUp(){


        $this->view->view("auth/view.register");
    }
    #[Route("/auth/signIn",RequestMethod::POST)]
    public function signIn(){
        $post = $this->view->getPostData();
        $this->authService->authenticate($post['username'],$post['password']);

    }

}