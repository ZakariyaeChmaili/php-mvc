<?php

#[Attribute]
class Post extends Route
{
    public function __construct(string $url)
    {
        parent::__construct($url, RequestMethod::POST);
    }

}