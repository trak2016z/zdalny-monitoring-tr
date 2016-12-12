<?php
	session_start();

?>



<!DOCTYPE html>
<html>
<head>
	<title>Zdalny monitoring</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h1>Zdalny monitoring</h1>
</div>






<h1>Home</h1>
<div><h4>Witamy <?php echo $_SESSION['username']; ?></h4></div>
<div><a href="wylogowanie.php">Wyloguj</a></div>
</body>
</html>