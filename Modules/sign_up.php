<?php
require '../connect.php';
session_start();

$login = htmlspecialchars(addslashes($_POST['login']));
$password = htmlspecialchars(addslashes($_POST['password']));
$password = md5(md5($password));
$email = htmlspecialchars(addslashes($_POST['email']));
$type = htmlspecialchars(addslashes($_POST['type']));
if ($type == 'owner') {$type = 1;} else {$type = 0;}

mysqli_query($db, "INSERT INTO users (`login`, `password`, `email`, `owner`) VALUES ('$login', '$password', '$email', '$type')");

$_SESSION['login'] = $login;
header('Location: ../index.php');