<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe</title>
</head>
<body>
    <h1>Hello<?php if ($_SESSION['login'] != null) {echo ', ' . $_SESSION['login'];}?></h1>
    <?php if ($_SESSION['login'] != null) {?>
        <h2>Avatar</h2>
        <form action="modules/avatar.php" method="post" enctype="multipart/form-data">
            <input type="file" name="avatar">
            <input type="submit" value="Upload">
        </form>
        <?php
        $user_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"))['id'];
        $avatars = mysqli_query($db, "SELECT * FROM files WHERE user_id = " . $user_id);
        $path = mysqli_fetch_assoc($avatars)['path'];
        if (mysqli_num_rows($avatars)) {?>
            <img src="<?=$path?>" alt="">
            <button style="margin-top: 10px;"><a href="modules/remove_avatar.php" style="font-size: 1em; text-decoration: none; color: black;">Delete avatar</a></button>
            <?= '<br>' ?>
        <?php } ?>
        <button style="margin-top: 10px;"><a href="modules/log_out.php" style="font-size: 2em; text-decoration: none; color: black;">Log out</a></button>
    <?php } else { ?>
        <button style="margin-top: 20px;"><a href="index.php?page=sign_up" style="font-size: 2em; text-decoration: none; color: black;">Sign up</a></button>
        <?='<br>'?>
        <button style="margin-top: 10px;"><a href="index.php?page=sign_in" style="font-size: 2em; text-decoration: none; color: black;">Sign in</a></button>
    <?php } ?>
</body>
</html>