<?php
require 'connect.php';
session_start();
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
    <h1 style="font-size: 4em; text-align: center;">Black-Tech Cafe</h1>
    <button><a href="content/menu.php" style="font-size: 2em; text-decoration: none; color: black;">Menu</a></button>
    <button><a href="content/address.php" style="font-size: 2em; text-decoration: none; color: black;">Address</a></button>
    <button><a href="content/contacts.php" style="font-size: 2em; text-decoration: none; color: black;">Contacts</a></button>
    <?php if (checkOwner()) {echo '<button><a href="content/owner_menu.php" style="font-size: 2em; text-decoration: none; color: black;">Owner Menu</a></button>';}?>
    <?= '<br>'?>
    <h1>Hello<?php if ($_SESSION['login'] != null) {echo ', ' . $_SESSION['login'];}?></h1>
    <h2>Avatar</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar">
        <input type="submit" value="Upload">
    </form>
    <?php if ($_SESSION['login'] != null) {
        echo
        '<button style="margin-top: 20px;"><a href="Modules/log_out.php" style="font-size: 2em; text-decoration: none; color: black;">Log out</a></button>';
    } else {
        echo
        '<button style="margin-top: 20px;"><a href="Content/sign_up.php" style="font-size: 2em; text-decoration: none; color: black;">Sign up</a></button>
        <br>
        <button style="margin-top: 10px;"><a href="Content/sign_in.php" style="font-size: 2em; text-decoration: none; color: black;">Sign in</a></button>';
    }?>
</body>
</html>

<?php
$file = $_FILES['avatar'];
$ext = pathinfo($file['name'])['extension'];
if (is_uploaded_file($file['tmp_name'])) {
    if ($file['size'] > 1024 ** 2 * 1) {
        echo('File is too huge');
    }
    if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif']) === false) {
        echo('Wrong file. You should add an image');
    }
    move_uploaded_file($file['tmp_name'], 'files/' . $file['name']);
}

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
?>