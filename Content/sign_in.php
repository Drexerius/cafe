<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
</head>
<body>
    <h1 style="font-size: 4em; text-align: center;">Sign in</h1>
    <fieldset>
        <form action="modules/sign_in.php" method="POST">
            <input type="text" name="login" placeholder="Login" required = true style="margin: 10px; font-size: 1em;"><?= '<br>'?>
            <input type="password" name="password" placeholder="Password" required = true style="margin: 10px; font-size: 1em;"><?= '<br>'?>
            <input type="submit" value="Sign in" style="margin: 10px; font-size: 1.2em;">
        </form>
    </fieldset>
</body>
</html>