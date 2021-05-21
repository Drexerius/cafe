<?php
require '../connect.php';
session_start();
$file = $_FILES['avatar'];
$ext = pathinfo($file['name'])['extension'];
if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif']) === true && $file['size'] <= 1024 ** 2 * 1) {
    move_uploaded_file($file['tmp_name'], '../files/' . $file['name']);
    $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
    $user_id = $user['id'];
    $path = 'files/' . $file['name'];
    $repeat = false;
    $res = mysqli_query($db, "SELECT * FROM files WHERE user_id = $user_id");
    if (mysqli_num_rows($res)) {
        mysqli_query($db, "UPDATE files SET path = '" . $path . "' WHERE user_id = " . $user_id);
    } else {
        mysqli_query($db, "INSERT INTO files (`path`, `user_id`) VALUES ('$path', '$user_id')");
        $avatar = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM files WHERE path = '" . $path . "'"));
        $id = $avatar['id'];
        mysqli_query($db, "UPDATE users SET avatar_id = '$id' WHERE login = '" . $_SESSION['login'] . "'");
    }
}

header('Location: ../index.php?page=main');