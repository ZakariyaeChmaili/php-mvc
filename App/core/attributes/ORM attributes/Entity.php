<?php


#[Attribute]
class Entity
{
    public function __construct(public string $tableName)
    {
    }

}