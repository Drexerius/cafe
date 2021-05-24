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
    $used = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if ($used) { ?>
    <h2>Login is already in use.</h2>
    <button><a href="../index.php?page=sign_up" style="font-size: 2em; text-decoration: none; color: black;">Return</a></button>
<?php } ?>
</body>
</html>
