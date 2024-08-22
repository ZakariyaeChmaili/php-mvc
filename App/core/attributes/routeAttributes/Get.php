<?php
#[Attribute]
class Get extends Route
{
    public function __construct(string $url)
    {
        parent::__construct($url, RequestMethod::GET);
    }

}