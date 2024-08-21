<?php

enum RequestMethod
{
    case GET;
    case POST;
    case PUT;
    case DELETE;


    public static function toString(RequestMethod $requestMethod): string
    {
        return match ($requestMethod) {
            RequestMethod::POST => "POST",
            RequestMethod::PUT => "PUT",
            RequestMethod::DELETE => "DELETE",
            default => "GET",
        };
    }
    public static function valueOf(string $requestMethod): RequestMethod
    {
        return match ($requestMethod) {
            "POST" => RequestMethod::POST,
            "PUT" => RequestMethod::PUT,
            "DELETE" => RequestMethod::DELETE,
            default => RequestMethod::GET,
        };

    }

}
