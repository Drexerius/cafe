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
    <!-- <h2>Avatar</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar">
        <input type="submit" value="Upload">
    </form> -->
    <?php if ($_SESSION['login'] != null) {
        echo
        '<button style="margin-top: 20px;"><a href="Modules/log_out.php" style="font-size: 2em; text-decoration: none; color: black;">Log out</a></button>';
    } else {
        echo
        '<button style="margin-top: 20px;"><a href="index.php?page=sign_up" style="font-size: 2em; text-decoration: none; color: black;">Sign up</a></button>
        <br>
        <button style="margin-top: 10px;"><a href="index.php?page=sign_in" style="font-size: 2em; text-decoration: none; color: black;">Sign in</a></button>';
    }?>
</body>
</html>

<?php
// $file = $_FILES['avatar'];
// $ext = pathinfo($file['name'])['extension'];
// if (is_uploaded_file($file['tmp_name'])) {
//     if ($file['size'] > 1024 ** 2 * 1) {
//         echo('File is too huge');
//     }
//     if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif']) === false) {
//         echo('Wrong file. You should add an image');
//     }
//     move_uploaded_file($file['tmp_name'], 'files/' . $file['name']);
// }
?>