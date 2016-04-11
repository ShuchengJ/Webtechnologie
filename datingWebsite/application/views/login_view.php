<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="/datingWebsite/jquery-1.12.0.js"></script>
<link rel="stylesheet" type="text/css" href="/datingWebsite/style.css">
<link rel="stylesheet" href="/datingWebsite/jquery-ui.min.css">
<script src="/datingWebsite/jquery-ui.min.js"></script>
<script src="/datingWebsite/jquerysearch.js"></script>
<title>Datadateorsomething</title>
</head>
<body>

<div class="content">
<div id="loginWrapper">
<h2>Log in as user</h2>
 <?php echo validation_errors(); ?>
<form action="verifylogin" method="post" accept-charset="utf-8">
<input type='hidden' name='submitted' id='submitted' value='1'/>

<label for='email'>Email:</label>
<br>
<input type='email' name='email' id='email'  maxlength="100" />
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