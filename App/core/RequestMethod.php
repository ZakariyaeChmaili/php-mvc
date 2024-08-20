<?php

enum RequestMethod
{
    case GET;
    case POST;
    case PUT;
    case DELETE;

    public static function valueOf(string $requestMethod): RequestMethod
    {
        switch ($requestMethod) {
            case "POST":
                return RequestMethod::POST;
            case "PUT":
                return RequestMethod::PUT;
            case "DELETE":
                return RequestMethod::DELETE;
            default:
                return RequestMethod::GET;
        }

    }

}
