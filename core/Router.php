<?php

use JetBrains\PhpStorm\NoReturn;

class Router
{

    public static array $urls = array();

    public static function addRoute(RequestMethod $requestMethod, string $url, string $controllerName, string $methodName)
    {

        $params = self::extractUrlParamsKeyAndIndexAndUpdateUrl($url);

        self::$urls[$url] = [
            "controller" => $controllerName,
            "action" => $methodName,
            "requestMethod" => $requestMethod
        ];

        if ($params) {
            foreach ($params as $paramIndex => $paramKey) {
                self::$urls[$url]["params"][$paramIndex] = $paramKey;

            }

        }

    }

    private static function extractUrlParamsKeyAndIndexAndUpdateUrl(string &$url): array
    {
        $urlList = explode("/", $url);
        $params = [];
        foreach ($urlList as $index => $urlItem) {
            if (str_starts_with($urlItem, ":")) {
                $paramKey = str_replace(":", "", $urlItem);
                $params[$index] = $paramKey;
                unset($urlList[$index]);
                $url = implode("/", $urlList);
            }

        }
        return $params;
    }


    #[NoReturn] public static function routeToController(string $url, RequestMethod $requestMethod): void
    {
        $urlToCompare = $url;
        foreach (self::$urls as $savedUrl => $data) {

            $params = self::extractUrlParamsValueAndUpdateUrl($urlToCompare, [$savedUrl, $data]);
            if (self::compareUrls($urlToCompare,$savedUrl) and $requestMethod === $data['requestMethod']) {
                $controller = $data["controller"];
                $controllerObj = new $controller();
                $method = $data['action'];
                call_user_func_array([$controllerObj, $method], $params);
                exit();
            }

        }
        self::httpResponseAbort(401);
    }


    private static function compareUrls(string $url1, string $url2): bool
    {
        if ($url1 == $url2) return true;
        elseif ($url1 == "/" . $url2) return true;
        elseif ("/" . $url1 == $url2) return true;
        return false;
    }

    private static function extractUrlParamsValueAndUpdateUrl(string &$urlToCompare, array $savedUrl): array
    {

        $params = [];
        if (isset($savedUrl[1]['params'])) {
            if (str_starts_with($urlToCompare, $savedUrl[0])) {
                $urlToCompareList = explode("/", $urlToCompare);
                foreach ($savedUrl[1]['params'] as $paramIndex => $paramKey) {
                    if (!isset($urlToCompareList[$paramIndex])) {
                        self::httpResponseAbort(401);
                    }
                    $paramValue = $urlToCompareList[$paramIndex];

                    $params[] = $paramValue;
                    unset($urlToCompareList[$paramIndex]);
                }

                $urlToCompare = implode("/", $urlToCompareList);

            }
        }

        return $params;
    }


    public static function httpResponseAbort(int $statusCode): void
    {
        http_response_code($statusCode);
        die();
    }

}