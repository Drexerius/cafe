<?php
require '../connect.php';
session_start();
$user_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"))['id'];
mysqli_query($db, "DELETE FROM files WHERE user_id = " . $user_id);
$old_path = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM files WHERE user_id = " . $user_id))['path'];
unlink('../' . $old_path);
header('Location:../index.php?page=main');