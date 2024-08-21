<?php


class Router
{

    public static array $urls = array();

    public static function addRoute(RequestMethod $requestMethod, string $url, string $controllerName, string $methodName): void
    {
        $params = self::extractUrlParamsKeyAndIndexAndUpdateUrl($url);

        self::$urls[RequestMethod::toString($requestMethod)][] = [
            'controller' => $controllerName,
            'action' => $methodName,
            'endpoint' => $url
        ];

        if ($params) {
            $lastEndPointIndex = sizeof(self::$urls[RequestMethod::toString($requestMethod)]) - 1;
            foreach ($params as $paramIndex => $paramKey) {
                self::$urls[RequestMethod::toString($requestMethod)][$lastEndPointIndex]['params'][] = [$paramIndex => $paramKey];

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


    public static function routeToController(string $url, RequestMethod $requestMethod): void
    {
        $urlToCompare = $url;
        foreach (self::$urls[RequestMethod::toString($requestMethod)] as $savedUrl) {
            $params = self::extractUrlParamsValueAndUpdateUrl(urlToCompare: $urlToCompare, url: $savedUrl['endpoint'], paramsList: $savedUrl['params'] ?? null);
            if (self::compareUrls($urlToCompare, $savedUrl['endpoint'])) {
                $controller = $savedUrl["controller"];
                $controllerObj = new $controller();
                $method = $savedUrl['action'];
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

    private static function extractUrlParamsValueAndUpdateUrl(string &$urlToCompare, string $url, array|null $paramsList): array
    {

        $parameters = [];
        if ($paramsList) {
            if (str_starts_with($urlToCompare, $url) or str_starts_with("/" . $urlToCompare, $url)) {
                $urlToCompareList = explode("/", $urlToCompare);
                foreach ($paramsList as $index => $params) {
                    foreach ($params as $paramIndex => $paramKey) {
                        if (!isset($urlToCompareList[$paramIndex])) {
                            self::httpResponseAbort(401);
                        }
                        $paramValue = $urlToCompareList[$paramIndex];

                        $parameters[] = $paramValue;
                        unset($urlToCompareList[$paramIndex]);
                    }
                }

                $urlToCompare = implode("/", $urlToCompareList);

            }
        }

        return $parameters;
    }


    public static function httpResponseAbort(int $statusCode): void
    {
        http_response_code($statusCode);
        die();
    }

}