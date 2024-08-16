<?php


class MainController extends Controller
{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        $this->view->view("home");

    }


}
