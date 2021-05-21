<?php
require '../connect.php';
session_start();
$id = htmlspecialchars(addslashes($_GET['id']));
$owner_id = htmlspecialchars(addslashes($_GET['owner']));
$owner = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE id = " . $owner_id));
$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
$item = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM menu_money WHERE id = " . $id));

if (!$user['owner'] && $user['money'] >= $item['money']) {
    $new_money = $user['money'] - $item['money'];
    $owner_money = $owner['money'] + $item['money'];
    mysqli_query($db, "UPDATE users SET money = $new_money WHERE id = " . $user['id']);
    mysqli_query($db, "UPDATE users SET money = $owner_money WHERE id = " . $owner['id']);
    $user_id = $user['id'];
    $item_id = $item['id'];
    mysqli_query($db, "INSERT INTO orders_money (`user_id`, `menu_id`) VALUES ('$user_id', '$item_id')");
    $order = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM orders_money WHERE id=(SELECT max(id) FROM orders_money)"));
    echo '<h2>Successfully bought an item.</h2>';
    echo '<h2>Your id: ' . $user['id'] . '</h2>';
    echo '<h2>Order id: ' . $order['id'] . '</h2>';
    echo '<h2>When you reach our cafe just enter that into the terminal.</h2>';
} else {
    if ($user['owner']) {
        echo '<h2>Failure. You can`t buy from owner`s account</h2>';
    } else {
        echo '<h2>Not enought money</h2>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button><a href="../index.php?page=menu" style="font-size: 2em; text-decoration: none; color: black;">Return</a></button>
</body>
</html>