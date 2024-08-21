<?php


function dd($data)
{
    echo '<pre>' . var_export($data, true) . '</pre>';
    die();

}

define("P_ROOT", substr(__DIR__, 0, -9));
const ROOT_URL = "/projects/UsersDemoApp/";
spl_autoload_register(function ($class_name) {
    $directoryIterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(P_ROOT . "/App/")

    );

    foreach ($directoryIterator as $file) {
        if ($file->isFile() && $file->getFilename() === $class_name . '.php') {
            require_once $file->getPathname();
            return;
        }
    }
});

function loadControllers(): void
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(P_ROOT . "/App/", RecursiveIteratorIterator::LEAVES_ONLY));
    foreach ($iterator as $file) {
        if (str_ends_with($file->getFilename(), ".php")) {

            $fileName = str_replace(".php", "", $file->getFilename());

            if (class_exists($fileName)) {
                $refection = new ReflectionClass($fileName);
                $reflectionAttributes = $refection->getAttributes(Controller::class);
                if ($reflectionAttributes) {
                    $controller = $fileName;
                    $methods = $refection->getMethods();
                    foreach ($methods as $method) {
                        $attributes = $method->getAttributes(Route::class);
                        foreach ($attributes as $attribute) {
                            $arguments = $attribute->getArguments();
                            $url = str_starts_with($arguments[0], "/") ? substr($arguments[0], 1) : $arguments[0];
                            Router::addRoute(requestMethod: $arguments[1], url: $url,controllerName:  $controller,methodName:  $method->getName());
                        }
                    }
                }
            }

        }

    }
}


