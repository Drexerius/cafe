<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Owner Menu</title>
</head>
<body>
<h3>Here you can unlock new items for you menu or remove them to get money and points back.</h3>
<h2>Money menu</h2>
<?php
$empty = false;
getMoneyMenu();
if (!$empty) {?>
    <table border="1">
        <tr>
            <td>Name</td>
            <td>Money required</td>
            <td>Points required</td>
            <td>Money</td>
            <td>Points</td>
        </tr>
        <?php foreach ($items = getMoneyMenu() as $item) { ?>
            <tr>
                <td><?= $item['name']; ?></td>
                <td><?= $item['money_required']; ?></td>
                <td><?= $item['points_required']; ?></td>
                <td><?= $item['money']; ?></td>
                <td><?= $item['points']; ?></td>
                <td><button><a href="modules/unlock_money.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Unlock</a></button></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <h3>You have unlocked everything</h3>
<?php } ?>
<?= '<br>' ?>
<h2>Points menu</h2>
<?php
$empty = false;
getPointsMenu();
if (!$empty) {?>
<table border="1">
    <tr>
        <td>Name</td>
        <td>Points required</td>
        <td>Points</td>
        <td></td>
    </tr>
    <?php foreach ($items = getPointsMenu() as $item) { ?>
        <tr>
            <td><?= $item['name']; ?></td>
            <td><?= $item['points_required']; ?></td>
            <td><?= $item['points']; ?></td>
            <td><button><a href="modules/unlock_points.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Unlock</a></button></td>
        </tr>
    <?php } ?>
</table>
<?php } else { ?>
    <h3>You have unlocked everything</h3>
<?php } ?>
<?= '<br>' ?>
<h2>Acquired money menu</h2>
<?php
$empty = false;
getAcquiredPoints();
if (!$empty) {?>
<table border="1">
    <tr>
        <td>Name</td>
        <td>Money required</td>
        <td>Points required</td>
        <td>Money</td>
        <td>Points</td>
        <td></td>
    </tr>
    <?php foreach ($items = getAcquiredMoney() as $item) { ?>
        <tr>
            <td><?= $item['name']; ?></td>
            <td><?= $item['money_required']; ?></td>
            <td><?= $item['points_required']; ?></td>
            <td><?= $item['money']; ?></td>
            <td><?= $item['points']; ?></td>
            <td><button><a href="modules/remove_money.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Remove</a></button></td>
        </tr>
    <?php } ?>
</table>
<?php } else { ?>
    <h3>You haven`t unlocked anything yet</h3>
<?php } ?>
<?= '<br>' ?>
<h2>Acquired points menu</h2>
<?php
$empty = false;
getAcquiredPoints();
if (!$empty) {?>
<table border="1">
    <tr>
        <td>Name</td>
        <td>Points required</td>
        <td>Points</td>
        <td></td>
    </tr>
    <?php foreach ($items = getAcquiredPoints() as $item) { ?>
        <tr>
            <td><?= $item['name']; ?></td>
            <td><?= $item['points_required']; ?></td>
            <td><?= $item['points']; ?></td>
            <td><button><a href="modules/remove_points.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Remove</a></button></td>
        </tr>
    <?php } ?>
</table>
<?php } else { ?>
<h3>You haven`t unlocked anything yet</h3>
<?php } ?>
</body>
</html>

<?php
function getMoneyMenu() : array
{
    global $db; global $empty;
    $arr[] = 0;
    $user_id = $_SESSION['id'];
    $res = mysqli_query($db, "SELECT * FROM menu_money WHERE id NOT IN (SELECT menu_id FROM acquired_money WHERE user_id = $user_id)");
    if (!mysqli_num_rows($res)) {$empty = true;}
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getPointsMenu() : array
{
    global $db; global $empty;
    $user_id = $_SESSION['id'];
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT * FROM menu_points WHERE id NOT IN (SELECT menu_id FROM acquired_points WHERE user_id = $user_id)");
    if (!mysqli_num_rows($res)) {$empty = true;}
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getAcquiredMoney() : array
{
    global $db; global $empty;
    $user_id = $_SESSION['id'];
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT menu_money.*, acquired_money.menu_id FROM menu_money
INNER JOIN acquired_money ON menu_money.id = acquired_money.menu_id AND acquired_money.user_id = " . $user_id);
    if (!mysqli_num_rows($res)) {$empty = true;}
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getAcquiredPoints() : array
{
    global $db; global $empty;
    $user_id = $_SESSION['id'];
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT menu_points.*, acquired_points.menu_id FROM menu_points
INNER JOIN acquired_points ON menu_points.id = acquired_points.menu_id AND acquired_points.user_id = " . $user_id);
    if (!mysqli_num_rows($res)) {$empty = true;}
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}
?>