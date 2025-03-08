<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');

include('includes/navbar.php');

// var_dump($_POST);

$query = ' SELECT * FROM users WHERE email = "'. $_POST['email'] . '" AND password = "' . $_POST['password'] . '"';
var_dump($query);
die();

include('includes/login.php');

include('includes/footer.php');
?>
