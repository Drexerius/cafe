<?php
require '../connect.php';
session_start();

$login = htmlspecialchars(addslashes($_POST['login']));
$password = htmlspecialchars(addslashes($_POST['password']));
$password = md5(md5($password));
$email = htmlspecialchars(addslashes($_POST['email']));
$type = htmlspecialchars(addslashes($_POST['type']));
if ($type == 'owner') {$type = 1;} else {$type = 0;}

$users = mysqli_query($db, "SELECT * FROM USERS WHERE login = '" . $login . "'");
if (mysqli_num_rows($users) == null) {
    mysqli_query($db, "INSERT INTO users (`login`, `password`, `email`, `owner`) VALUES ('$login', '$password', '$email', '$type')");
    $_SESSION['login'] = $login;
    header('Location: ../index.php?page=main');   
} else {
    header('Location: ../index.php?page=sign_up');
}