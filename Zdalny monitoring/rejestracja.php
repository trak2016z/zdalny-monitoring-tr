<?php
	session_start();

	//Połączenie z bazą
	$db = mysqli_connect("localhost", "root", "domino93", "autoryzacja" );

	if (isset($_POST['register_btn'])) 
	{
		//session_start();
			$username=mysql_real_escape_string($_POST['username']);        // zabezpieczenie przed SQL injection
			$email=mysql_real_escape_string($_POST['email']);              // zabezpieczenie przed SQL injection
			$password=mysql_real_escape_string($_POST['password']);        // zabezpieczenie przed SQL injection
			$password2=mysql_real_escape_string($_POST['password2']);      // zabezpieczenie przed SQL injection

		if ($username==""||$email==""||$password==""||$password2=="")      // Gdy nie zostanie wpisany login/email/hasło lub 
		{                                                                  // potwierdzenie hasła -> wyświetl komunikat
			$_SESSION['message']="Wprowadzono niepoprawne dane";
		}else
		{
			
			if ($password==$password2) // Jeżeli potwierdzene hasła = hasło, wtedy wprowadź nowy rekord do bazy 
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

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="materialize.min.css">
</head>
<body>
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">Zdalny monitoring - Rejestracja</a>
 		<ul class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn" href="logowanie.php">Zaloguj się</a></li>
      </ul>
    </div>
</nav>
<?php    //  Okienko do wyświetlania wiadomości o błędach:
	if (isset($_SESSION['message']))
	{
		echo "<div class='container'><div class='card-panel red lighten-1'><h5 class='center-align'>".$_SESSION['message']."</h5></div></div>";
		unset($_SESSION['message']);

	}
?>
<form action="rejestracja.php" method="POST">
	<table>
		<tr>
			<td><div><label for="username"><h6>Nazwa użytkownika:</h6></label></div></td>
			<td><input type="text" name="username" class="validate"></td>
		</tr>
		<tr>
			<td><div><label for="email"><h6>Adres Email:</h6></label></div></td>
			<td><input type="email" name="email" class="validate"></td>
		</tr>
		<tr>
			<td><div><label for="password"><h6>Hasło:</h6></label></div></td>
			<td><input type="password" name="password" class="validate"></td>
		</tr>
		<tr>
			<td><div><label for="password2"><h6>Potwierdź hasło:</h6></label></div></td>
			<td><input type="password" name="password2" class="validate"></td>
		</tr>
		<tr>
			<td></td>
			<td><button class="btn waves-effect waves-light" type="submit" name="register_btn">Zarejestruj
  			</button></td>
		</tr>	
		
	</table>
</form>

</body>
</html>