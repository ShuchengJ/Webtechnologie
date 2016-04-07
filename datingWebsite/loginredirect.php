<?php 
	$username = trim($_POST['username']);
    $_SESSION['hoi'] = $username;
    $_SESSION['isUser'] = TRUE;
	$cookie_name = "user";
	setcookie($cookie_name, $username);
	setcookie($cookie_name, $_SESSION['isUser']);
    header('Location: '."http://localhost/datingWebsite/home.php");
?>