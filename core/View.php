<?php

class View
{

    private string $body="", $nav = "";

    public function __construct()
    {
    }


    public function view(string $viewName, $data= null): void
    {

        include ROOT_PATH . "/views/" . $viewName . ".php";
        include ROOT_PATH . "/template/template.php";
    }

    function redirect(string $view): void
    {
        header("Location:" . ROOT_URL . $view);
        exit();
    }

    public function render(string $element = "body"): string
    {
        switch ($element) {
            case "nav":
            {
                return $this->nav;
            }
            default:
            {
                return $this->body;
            }
        }
    }

    public function start(): void
    {
        ob_start();
    }

    public function end(string $element = "body"): void
    {
        switch ($element) {
            case "nav":
            {
                $this->nav = ob_get_clean();
                break;
            }
            default:
            {
                $this->body = ob_get_clean();
                break;
            }
        }
    }

    public function includeView(string $viewName): void
    {
        include ROOT_PATH . "/views/" . $viewName . ".php";
    }


    public function getPostData(){
        return $_POST;
    }

    public function getGetData(){
        return $_GET;
    }
}