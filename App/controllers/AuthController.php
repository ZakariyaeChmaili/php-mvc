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
        View::view(viewName: "auth/view.login",template: "authTemplate");
    }

    #[Route("/auth/register", RequestMethod::GET)]
    public function register()
    {
        View::view(viewName: "auth/view.register",template: "authTemplate");
    }

    #[Route("/auth/register", RequestMethod::POST)]
    public function signUp()
    {
        $post = View::getPostData();
        $this->authService->register(username: $post["username"], password: $post["password"]);
        View::redirect("/auth/register");
    }

    #[Route("/auth/signIn", RequestMethod::POST)]
    public function signIn()
    {
        $post = View::getPostData();
        $this->authService->authenticate($post['username'], $post['password']);

    }

}