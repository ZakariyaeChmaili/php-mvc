<?php


require_once $_SERVER["DOCUMENT_ROOT"] . "/projects/UsersDemoApp/core/core.php";


loadControllers(P_ROOT . "/controllers");

Router::routeToController($_GET["url"], RequestMethod::valueOf($_SERVER['REQUEST_METHOD']));







