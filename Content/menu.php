<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
</head>
<body>
    <h1>Basic menu</h1>
   <table border = "1">
        <tr>
            <td>Owner name</td>
            <td>Item name</td>
            <td>Money cost</td>
        </tr>
        <?php foreach ($owners = getOwners() as $owner) {          
            foreach ($item = getItems($owner['id']) as $item) { ?>
                <tr>
                <td><?=$owner['login'];?></td>
                <td><?=$item['name'];?></td>
                <td><?=$item['money'];?></td>
                    <?php if ($_SESSION['login']) {?>
                    <td><button><a href="modules/buy_money.php?id=<?= $item['id']?>&owner=<?=$owner['id']?>" style="font-size: 1em; text-decoration: none; color: black;">Buy</a></button></td>
                    <?php } ?>
                </tr>
        <?php } } ?>
   </table>
</body>
</html>
<?php

function getOwners() : array
{
    global $db;
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT * FROM users WHERE owner = 1");
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}

function getItems(int $id) : array {
    global $db;
    $arr[] = 0;
    $res = mysqli_query($db, "SELECT menu_money.* FROM menu_money
    INNER JOIN acquired_money ON acquired_money.menu_id = menu_money.id AND acquired_money.user_id = " . $id);
    for ($k = 0; $k < mysqli_num_rows($res); $k++) {
        $arr[$k] = mysqli_fetch_assoc($res);
    }
    return $arr;
}
?>