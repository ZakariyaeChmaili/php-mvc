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

$fullUrlPath = $_SERVER["REQUEST_URI"];
$urlPathList = array_slice(explode("/", $fullUrlPath), 3);
$endPoint = processUrl($fullUrlPath);
if (checkIfControllerExists($endPoint["controller"])){
$controller = ucfirst($endPoint["controller"]) . "Controller";
$method = $endPoint["method"];
$controllerObj = new $controller();
if (method_exists($controllerObj, $method)) {
    $controllerObj->$method();
}
}

function processUrl(string $url): array
{
    $urlPathList = array_slice(explode("/", $url), 3);
    $endPoint = [
        "controller" => "main",
        "method" => "index",
    ];
    if (!empty($urlPathList[0])) {
        $endPoint["controller"] = $urlPathList[0];
        if (!empty($urlPathList[1])) {
            $endPoint["method"] = $urlPathList[1];
        }
    }

    return $endPoint;
}

function checkIfControllerExists($controller): bool
{

    $file = ROOT_PATH . "/controllers/" . ucfirst($controller) . 'Controller.php';
    return file_exists($file);
}










