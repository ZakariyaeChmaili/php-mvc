<?php

#[Attribute]
class Column
{
    public function __construct(string $columnName, ColumnTypes $columnType)
    {
    }

}