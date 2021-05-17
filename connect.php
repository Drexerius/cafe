<?php
$db = mysqli_connect('localhost', 'root', '', 'cafe');
if (mysqli_connect_errno()) {
    die('Error connecting to database');
} else {
    mysqli_query($db, "SET NAMES 'utf8'");
}

// Tips
// "INPUT INTO table (`xx`, `zz`) VALUES ('xx', '$zz')"
// "SELECT * FROM table WHERE xx = " . $zz
// "DELETE FROM table WHERE xx = $zz"
// "UPDATE table SET xx = 'zz', xx = '$zz' WHERE xx = " . $zz

// ALTER TABLE users AUTO_INCREMENT = 1 