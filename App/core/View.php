<?php

class View
{

    private static string $body = "", $nav = "";

    public function __construct()
    {
    }


    public static function view(string $viewName, $data = null): void
    {

        include P_ROOT . "/App/views/" . $viewName . ".php";
        include P_ROOT . "/App/template/template.php";
    }

    public static function redirect(string $view): void
    {
        header("Location:" . ROOT_URL . $view);
        exit();
    }

    public static function render(string $element = "body"): string
    {
        switch ($element) {
            case "nav":
            {
                return self::$nav;
            }
            default:
            {
                return self::$body;
            }
        }
    }

    public static function start(): void
    {
        ob_start();
    }

    public static function end(string $element = "body"): void
    {
        switch ($element) {
            case "nav":
            {
                self::$nav = ob_get_clean();
                break;
            }
            default:
            {
                self::$body = ob_get_clean();
                break;
            }
        }
    }

    public static function includeView(string $viewName): void
    {
        include P_ROOT . "/App/views/" . $viewName . ".php";
    }


    public static function getPostData(): array
    {
        return $_POST;
    }

    public static function getGetData(): array
    {
        return $_GET;
    }
}