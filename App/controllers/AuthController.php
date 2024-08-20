<?php



#[Controller]
class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }


    #[Route("/auth/login", RequestMethod::GET)]
    public function login()
    {
        View::view("auth/view.login");
    }

    #[Route("/auth/register", RequestMethod::GET)]
    public function register()
    {


        View::view("auth/view.register");
    }

    #[Route("/auth/signUp", RequestMethod::POST)]
    public function signUp()
    {


        View::view("auth/view.register");
    }

    #[Route("/auth/signIn", RequestMethod::POST)]
    public function signIn()
    {
        $post = View::getPostData();
        $this->authService->authenticate($post['username'], $post['password']);

    }

}