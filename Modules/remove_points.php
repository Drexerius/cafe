<?php
require '../connect.php';
session_start();
$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
$item = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM menu_points WHERE id = " . $id));
$acquired = mysqli_query($db, "SELECT * FROM acquired_points WHERE user_id = " . $user['id']);
$repeat = false;
for ($k = 0; $k < mysqli_num_rows($acquired); $k++) {
    $res = mysqli_fetch_assoc($acquired);
    if ($res['menu_id'] == $id) {
        $repeat = true;
    }
}
if ($repeat == true) {
    $new_points = $user['points'] + $item['points_required'];
    mysqli_query($db, "UPDATE users SET points = $new_points WHERE id = " . $user['id']);
    mysqli_query($db, "DELETE FROM acquired_points WHERE user_id = " . $user['id'] . " AND menu_id = " . $item['id']);
}
header('Location: ../index.php?page=owner_menu');