<?php
function dd($data)
{
    echo '<pre>' . var_export($data, true) . '</pre>';
    die();

}

define("P_ROOT", $_SERVER["DOCUMENT_ROOT"] . "/projects/UsersDemoApp");
const ROOT_URL = "/projects/UsersDemoApp/";

spl_autoload_register(function ($class_name) {
    $projectRoot = P_ROOT;
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

function loadControllers(string $path): void
{
    $controllersFiles = scandir($path);
    foreach ($controllersFiles as $controllerFile) {
        if (str_ends_with($controllerFile, ".php")) {
            $controller = str_replace(".php", "", $controllerFile);

            $refection = new ReflectionClass($controller);
            $methods = $refection->getMethods();
            $flag = true;
            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Route::class);
                if ($flag) {
                    $flag = false;
                    continue;
                }
                foreach ($attributes as $attribute) {
                    $arguments = $attribute->getArguments();
                    Router::addRoute($arguments[1], $arguments[0], $controller, $method->getName());
                }
            }
        }
    }



}