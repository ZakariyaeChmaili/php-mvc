<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/projects/UsersDemoApp/core/core.php";


$dsn = "mysql:dbname=user_app_demo;host=localhost";
$username = "root";
$password = "";

$conn = new PDO($dsn, $username, $password);


$method = $_GET['method'];
dd($method);
switch ($method) {
    case "post":
    {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $age = $_POST["age"];
        $prepare = $conn->prepare("INSERT INTO users (first_name, last_name, age) VALUES (:first_name, :last_name, :age)");
        $prepare->bindValue(':first_name', $firstName);
        $prepare->bindValue(':last_name', $lastName);
        $prepare->bindValue(':age', $age);
        $prepare->execute();

        break;
    }
    case "get":{
        $id = $_GET["id"];
        $prepare = $conn->prepare("select * from users where id=:id");
        $prepare->bindValue(':id', $id);
        $prepare->execute();

        $user = $prepare->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userToUpdate'] = $user;
//        dd($_SESSION);

        break;
    }
    case "put":{
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $age = $_POST["age"];
        $id = $_POST["id"];
        $prepare = $conn->prepare("update users set first_name=:first_name, last_name=:last_name, age=:age where id=:id");
        $prepare->bindValue(':id',$id);
        $prepare->bindValue(':first_name', $firstName);
        $prepare->bindValue(':last_name', $lastName);
        $prepare->bindValue(':age', $age);
        $prepare->execute();
//        $_SESSION["userToUpdate"]
        unset($_SESSION["userToUpdate"]);
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');

        dd($_SESSION);
        break;
    }
    case "delete":{
        $id = $_GET["id"];
        $prepare = $conn->prepare("delete from users where id = '$id'");
        $prepare->execute();
        break;
    }
}

header("Location:" . ROOT_URL);

exit();
