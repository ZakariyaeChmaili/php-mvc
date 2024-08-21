<?php



require_once $_SERVER["DOCUMENT_ROOT"] . "/projects/UsersDemoApp/App/core/core.php";

loadControllers();
Router::routeToController($_GET["url"], RequestMethod::valueOf($_SERVER['REQUEST_METHOD']));







