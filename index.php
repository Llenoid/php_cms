<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');

include('includes/navbar.php');

// var_dump($_POST);

if (isset($_SESSION['id'])) {
	header('Location: dashboard.php');
	die();
}

if (isset($_POST['email'])) {
	if ($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ? and active = 1')) {
		$hashed = SHA1($_POST['password']);
		$stm->bind_param('ss', $_POST['email'], $hashed);
		$stm->execute();

		$result = $stm->get_result();
		$user = $result->fetch_assoc();

		if ($user) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['username'] = $user['username'];

			set_message("You are signed in " . $_SESSION['username']);
			header('Location: dashboard.php');
			die();
		}
		$stm->close();
	} else {
		echo 'Could not prepare statement!';
	}
}

include('includes/login.php');

include('includes/footer.php');
