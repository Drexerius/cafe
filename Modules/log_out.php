<?php
require '../connect.php';
session_start();
$_SESSION['login'] = 0;

header('Location: ../index.php?page=main');