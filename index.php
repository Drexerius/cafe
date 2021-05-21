<?php
require 'connect.php';
session_start();
$page = htmlspecialchars(addslashes($_GET['page']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe</title>
</head>
<body>
    <fieldset style="text-align: center;">
        <h1 style="font-size: 2em; text-align: center;">Black-Tech Cafe</h1>
        <button><a href="index.php?page=main" style="font-size: 2em; text-decoration: none; color: black;">Main</a></button>
        <button><a href="index.php?page=menu" style="font-size: 2em; text-decoration: none; color: black;">Basic Menu</a></button>
        <button><a href="index.php?page=special_menu" style="font-size: 2em; text-decoration: none; color: black;">Special Menu</a></button>
        <button><a href="index.php?page=address" style="font-size: 2em; text-decoration: none; color: black;">Address</a></button>
        <button><a href="index.php?page=contacts" style="font-size: 2em; text-decoration: none; color: black;">Contacts</a></button>
        <?php if (checkOwner()) {echo '<button><a href="index.php?page=owner_menu" style="font-size: 2em; text-decoration: none; color: black;">Owner Menu</a></button>';}
        echo '<br>';
        if ($_SESSION['login'] != null) {
            $balance = getBalance();
            echo '<h3>Money: ' . $balance[0] . ' Points: ' . $balance[1] . '</h3>';
        }
        
        ?>
    </fieldset>
    <div>
        <?php
            include 'content/' . $page . '.php';
        ?>
    </div>
</body>
</html>

<?php

function checkOwner() : bool
{
    global $db;
    $res = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
    if ($res['owner'] == 1) {
        return true;
    } else {
        return false;
    }
}

function getBalance() : array
{
    global $db;
    $res = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
    $arr[0] = $res['money'];
    $arr[1] = $res['points'];
    return $arr;
}
?>