<?php
	session_start();

	//Połączenie z bazą
	$db = mysqli_connect("localhost", "root", "domino93", "autoryzacja" );

	if (isset($_POST['login_btn'])) 
	{
		//session_start();										
		$username=mysql_real_escape_string($_POST['username']);  // zabezpieczenie przed SQL injection
		$password=mysql_real_escape_string($_POST['password']);  // zabezpieczenie przed SQL injection
			
			if ($username==""||$password=="") // Gdy nie zostanie wpisany login lub hasło -> wyświetl komunikat
			{
				$_SESSION['message']="Wprowadzono niepoprawną nazwę użytkownika lub hasło";
			}else{
				$password = md5($password); // hashowanie hasła przed zapisem
				$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
				$result = mysqli_query($db, $sql);

			
				if (mysqli_num_rows($result)==1) 
				{
					$_SESSION['message'] = "Zostałeś zalogowany";
					$_SESSION['username'] = $username;
					header("location: home.php");			
				}
				else
				{
					$_SESSION['message'] = "Wprowadzono niepoprawną nazwę użytkownika lub hasło";
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
<?php     //  Okienko do wyświetlania wiadomości o błędach:
	if (isset($_SESSION['message']))
	{
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);

	}
?>
<form action="logowanie.php" method="POST">
	<table>
		<tr>
			<td>Nazwa użytkownika:</td>
			<td><input type="text" name="username" class="textInput"></td>
		</tr>
		
		<tr>
			<td>Hasło:</td>
			<td><input type="password" name="password" class="textInput"></td>
		</tr>
		
		<tr>
			<td></td>
			<td><input type="submit" name="login_btn" value="Zaloguj"></td>
		</tr>
		<tr>
			<td><div><a href="rejestracja.php">Zarejestruj się</a></div></td>
		</tr>
	</table>
</form>

</body>
</html>