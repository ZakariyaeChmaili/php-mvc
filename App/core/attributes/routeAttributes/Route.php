<?php



#[Attribute]
class Route
{
    public function __construct(public string $url, public RequestMethod $requestMethod)
    {
    }

}