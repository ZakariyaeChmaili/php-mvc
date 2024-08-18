<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/projects/UsersDemoApp/core/core.php";


spl_autoload_register(function ($class_name) {
    $projectRoot = __DIR__;
    $directoryIterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($projectRoot)
    );

    foreach ($directoryIterator as $file) {
        if ($file->isFile() && $file->getFilename() === $class_name . '.php') {
            require_once $file->getPathname();
            return;
        }
    }
});

Router::addRoute("home",MainController::class,"index");
Router::addRoute("user",UserController::class,"index");
Router::addRoute("user/addFormUser",UserController::class,"addFormUser");
Router::addRoute("user/updateFormUser",UserController::class,"updateFormUser");
Router::addRoute("user/delete",UserController::class,"delete");
Router::addRoute("user/save",UserController::class,"save");
Router::addRoute("user/test/:id/:name",UserController::class,"test");


Router::checkRoute($_GET["url"]);










