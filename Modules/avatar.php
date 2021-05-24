<?php
require '../connect.php';
session_start();
$file = $_FILES['avatar'];
$ext = pathinfo($file['name'])['extension'];
if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif']) === true && $file['size'] <= 1024 ** 2 * 1) {
    $user_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE login = '" . $_SESSION['login'] . "'"))['id'];
    $old_path = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM files WHERE user_id = " . $user_id))['path'];
    $path = 'files/' . time() . '.' . $ext;
    move_uploaded_file($file['tmp_name'], '../' . $path);
    $res = mysqli_query($db, "SELECT * FROM files WHERE user_id = $user_id");
    if (mysqli_num_rows($res)) {
        unlink('../' . $old_path);
        mysqli_query($db, "UPDATE files SET path = '" . $path . "' WHERE user_id = " . $user_id);
    } else {
        mysqli_query($db, "INSERT INTO files (`path`, `user_id`) VALUES ('$path', '$user_id')");
        $avatar_id = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM files WHERE path = '" . $path . "'"))['id'];
        mysqli_query($db, "UPDATE users SET avatar_id = '$id' WHERE login = '" . $_SESSION['login'] . "'");
    }
    header('Location: ../index.php?page=main');
} else {
    $error = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if($error) { ?>
    <h2>File is either too big or has wrong extension.</h2>
    <button><a href="../index.php?page=main" style="font-size: 2em; text-decoration: none; color: black;">Return</a></button>
<?php }?>
</body>
</html>
