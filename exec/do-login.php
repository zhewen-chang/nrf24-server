<?php
ob_start();
session_start();

$usr = "dclab";
$pw = "a4a6e754b6b9e76e056ec7e9c9332cec2da79607c2f96035fdff5bdd4cbf0c8f";

if($usr==$_POST["user"]&&$pw==hash("sha256", $_POST["password"])){
    $_SESSION['user']=$_POST["user"];
    header("Location:/setting.html");
}
else {
    header("Location:/login.html");
}
?>