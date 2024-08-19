<?php


class MainController extends Controller
{
    function __construct()
    {
        parent::__construct();

    }

    #[Route("/home",RequestMethod::GET)]
    function index()
    {
        $this->view->view("home");

    }


}
