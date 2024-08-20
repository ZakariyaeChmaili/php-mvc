<?php




#[Controller]
class MainController
{
    function __construct()
    {
    }

    #[Route("/home", RequestMethod::GET)]
    function index()
    {
        View::view("home");

    }


}
