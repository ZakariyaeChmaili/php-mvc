<?php

class Router
{

    public static array $urls = array();

    public static function addRoute(string $url, string $controllerName, string $methodName)
    {


        $urlList = explode("/", $url);
        $params=[];
        foreach ($urlList as $index => $urlItem) {
            if (str_starts_with($urlItem, ":")) {
                $paramKey = str_replace(":", "", $urlItem);
                $params[$index]=$paramKey;
                unset($urlList[$index]);
                $url = implode("/", $urlList);
            }

        }
        self::$urls[$url] = [
            "controller" => $controllerName,
            "method" => $methodName
        ];

        if ($params) {
            foreach ($params as $paramIndex => $paramKey) {
            self::$urls[$url]["params"][$paramIndex] = $paramKey;

            }

        }

    }


    public static function checkRoute(string $url)
    {
        $urlToCompare = $url;

        foreach (self::$urls as $currentUrl => $data) {
            $params = [];
            if (isset($data['params'])) {
                if(str_starts_with($urlToCompare, $currentUrl)) {

                    $urlToCompareList = explode("/", $urlToCompare);
                    foreach ($data['params'] as $paramIndex =>$paramKey ) {
                        if(!isset($urlToCompareList[$paramIndex])) {
                            die("missing param");
                        }
                        $paramValue = $urlToCompareList[$paramIndex];

                        $params[] = $paramValue;
                        unset($urlToCompareList[$paramIndex]);
                    }

                    $urlToCompare = implode("/", $urlToCompareList);
                }
            }
            if ($urlToCompare == $currentUrl) {
                $controller = $data["controller"];
                $controllerObj = new $controller();
                $method = $data['method'];
                call_user_func_array([$controllerObj, $method], $params);

//                $controllerObj->$method($params);
                exit();
            }

        }
        echo "404";
        die();
    }

}