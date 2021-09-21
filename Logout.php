<html>
<head>
	<title>LOGOUT</title>
	<meta charset="utf-8" />
</head>

<body>
<?php
	session_start();
	session_destroy();
	setcookie('user','',-1);
	setcookie('admin','',-1);
	setcookie('panier','',-1);
	header('Location: index.php');
?>
</body>
</html>