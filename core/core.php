<?php
function dd($data)
{
    echo '<pre>' . var_export($data, true) . '</pre>';
    die();

}

define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/projects/UsersDemoApp");
const ROOT_URL = "/projects/UsersDemoApp/";

