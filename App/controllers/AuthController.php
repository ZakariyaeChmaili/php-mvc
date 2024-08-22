<?php


#[Controller]
class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }



    #[Get("/auth/login")]
    public function login()
    {
        View::view(viewName: "auth/view.login", template: "authTemplate");
    }

    #[Get("/auth/register")]
    public function register()
    {
        View::view(viewName: "auth/view.register", template: "authTemplate");
    }

    #[Post("/auth/register")]
    public function signUp()
    {
        $post = View::getPostData();
        $this->authService->register(username: $post["username"], password: $post["password"]);
        View::redirect("/auth/register");
    }
    #[Post("/auth/login")]
    public function signIn()
    {
        $post = View::getPostData();
        try {

        $this->authService->authenticate($post['username'], $post['password']);
        View::redirect("/home");
        }catch (Exception $e){
            http_response_code(401);
            die($e->getMessage());
        }

    }

}