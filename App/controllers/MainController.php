<?php




#[Controller]
class MainController
{
    function __construct()
    {
    }

    #[Get("/home")]
    function index()
    {
        View::view("home");

    }


}
