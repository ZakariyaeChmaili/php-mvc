<?php

$dsn = "mysql:dbname=user_app_demo;host=localhost";
$username = "root";
$password = "";

$conn = new PDO($dsn, $username, $password);

$prepare = $conn->prepare("select * from users where id=:id");
$id = 1;
//$prepare->bindParam(":id", $id);
$prepare->execute(['id' => 1]);
$res = $prepare->fetchAll();

while($row = $res[0]){
    echo $row['id']."<br>";
}


