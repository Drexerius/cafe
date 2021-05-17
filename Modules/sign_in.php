<?php
require '../connect.php';

$login = htmlspecialchars(addslashes($_POST['login']));
$password = htmlspecialchars(addslashes($_POST['password']));
$password = md5(md5($password));

$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '$login'"));

if ($user['password'] == $password) {
    session_start();
    $_SESSION['login'] = $login;
    header('Location: ../index.php');
} else {
    header('Location: ../Content/sign_in.php');
}