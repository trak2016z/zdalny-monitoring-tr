<?php
	session_start();

	//Połączenie z bazą
	$db = mysqli_connect("localhost", "root", "domino93", "autoryzacja" );

	if (isset($_POST['register_btn'])) 
	{
		//session_start();
			$username=mysql_real_escape_string($_POST['username']);
			$email=mysql_real_escape_string($_POST['email']);
			$password=mysql_real_escape_string($_POST['password']);
			$password2=mysql_real_escape_string($_POST['password2']);

		if ($username==""||$email==""||$password==""||$password2=="") 
		{
			$_SESSION['message']="Wprowadzono niepoprawne dane";
		}else
		{
			
			if ($password==$password2) 
			{
				//utwórz użytkownika
				$password=md5($password); // dla bezpieczeństwa zahaszuj hasło przed zapisaniem
				$sql= "INSERT INTO users(username, email, password) VALUES('$username','$email', '$password')";
				mysqli_query($db, $sql);
				$_SESSION['message']="Zostałeś zalogowany";
				$_SESSION['username']= $username;
				header("location: home.php"); //przekierowanie na stronę "home"

			}else
			{
				$_SESSION['message'] = "Hasła muszą być takie same";
			}
		}
	}


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
<?php
	if (isset($_SESSION['message']))
	{
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);

	}
?>
<form action="rejestracja.php" method="POST">
	<table>
		<tr>
			<td>Nazwa użytkownika:</td>
			<td><input type="text" name="username" class="textInput"></td>
		</tr>
		<tr>
			<td>Adres Email:</td>
			<td><input type="email" name="email" class="textInput"></td>
		</tr>
		<tr>
			<td>Hasło:</td>
			<td><input type="password" name="password" class="textInput"></td>
		</tr>
		<tr>
			<td>Potwierdź hasło:</td>
			<td><input type="password" name="password2" class="textInput"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="register_btn" value="Zarejestruj"></td>
		</tr>
		<tr>
			<td><div><a href="logowanie.php">Zaloguj się</a></div></td>
		</tr>
	
		
		
	</table>
</form>

</body>
</html>