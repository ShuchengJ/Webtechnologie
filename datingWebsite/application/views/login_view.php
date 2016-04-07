<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" href="jquery-ui.min.css">
<script src="jquery-ui.min.js"></script>
<script src="jquerysearch.js"></script>
<title>Datadateorsomething</title>
</head>
<body>
<div class="header">
<div class="menu">
<a href="Homepage.html"><span>temp home</span></a>
<a href="login.html"><span>log in!</span></a>
<a href="register.html"><span>Register!</span></a>
</div>
</div>

<div class="content">
<div id="loginWrapper">
<h2>Log in as user</h2>
 <?php echo validation_errors(); ?>
<form action="verifylogin" method="post" accept-charset="utf-8">
<input type='hidden' name='submitted' id='submitted' value='1'/>

<label for='username'>Username:</label>
<br>
<input type='text' name='username' id='username'  maxlength="50" />
<br>
<label for='password'>Password:</label>
<br>
<input type='password' name='password' id='password' maxlength="50" />
<br>
<input type='submit' name='Submit' id='submit' value='Login' />

</form>
</div>
</div>
</body>
</html>