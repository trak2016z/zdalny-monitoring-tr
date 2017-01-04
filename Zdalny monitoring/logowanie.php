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
	<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="materialize.min.css">
</head>
<body>
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">Zdalny monitoring - Logowanie</a>
 		<ul class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn" href="rejestracja.php">Zarejestruj się</a></li>
      </ul>
    </div>
</nav>
<?php     //  Okienko do wyświetlania wiadomości o błędach:
	if (isset($_SESSION['message']))
	{
		echo "<div class='container'><div class='card-panel red lighten-1'><h6 class='center-align'>".$_SESSION['message']."</h6></div>";
		unset($_SESSION['message']);

	}
?>
<form action="logowanie.php" method="POST">
	<table>
		<tr>
			<td><div><label for="username"><h6>Nazwa użytkownika:</h6></label></div></td>
			<td><input type="text" name="username" class="validate"></td>
		</tr>
		<tr>
			<td><div><label for="password"><h6>Hasło:</h6></label></div></td>
			<td><input type="password" name="password" class="validate"></td>
		</tr>
		<tr>
			<td></td>
			<td><button class="btn waves-effect waves-light" type="submit" name="login_btn">Zaloguj
  			</button></td>
		</tr>
	</table>
</form>

</body>
</html>