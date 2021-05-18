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
<?php
echo '<br>';
$balance = getBalance();
echo 'Money: ' . $balance[0] . '; Points: ' . $balance[1];
?>
<h2>Money menu</h2>
<table border="1">
    <tr>
        <td>Name</td>
        <td>Money required</td>
        <td>Points required</td>
        <td>Money</td>
        <td>Points</td>
        <td></td>
    </tr>
    <?php foreach ($items = getMoneyMenu() as $item) { ?>
    <tr>
        <td><?= $item['name']; ?></td>
        <td><?= $item['money_required']; ?></td>
        <td><?= $item['points_required']; ?></td>
        <td><?= $item['money']; ?></td>
        <td><?= $item['points']; ?></td>
        <td><button><a href="modules/buy_money.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Buy</a></button></td>
    </tr>
    <?php } ?>
</table>
<?= '<br>' ?>
<h2>Points menu</h2>
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
            <td><button><a href="modules/buy_points.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Buy</a></button></td>
        </tr>
    <?php } ?>
</table>
<?= '<br>' ?>
<h2>Acquired money menu</h2>
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
            <td><button><a href="modules/sell_money.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Sell</a></button></td>
        </tr>
    <?php } ?>
</table>
<?= '<br>' ?>
<h2>Acquired points menu</h2>
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
            <td><button><a href="modules/sell_points.php?id=<?= $item['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Sell</a></button></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
<?php
function getBalance() : array
{
    global $db;
    $res = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
    $arr[0] = $res['money'];
    $arr[1] = $res['points'];
    return $arr;
}
function getMoneyMenu() : array
{
    global $db;
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT * FROM menu_money");
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getAcquiredMoney() : array
{
    global $db;
    $arr[] = 0;
    $res = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
    $id = $res['id'];
    $res = mysqli_query($db, "SELECT menu_money.*, acquired_money.menu_id FROM menu_money
INNER JOIN acquired_money ON menu_money.id = acquired_money.menu_id AND acquired_money.user_id = " . $id);
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getPointsMenu() : array
{
    global $db;
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT * FROM menu_points");
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getAcquiredPoints() : array
{
    global $db;
    $arr[] = 0;
    $res = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"));
    $id = $res['id'];
    $res = mysqli_query($db, "SELECT menu_points.*, acquired_points.menu_id FROM menu_points
INNER JOIN acquired_points ON menu_points.id = acquired_points.menu_id AND acquired_points.user_id = " . $id);
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}
?>