<?php
session_start();
if(isset($_POST['Identifiant']) && isset($_POST['Motdepasse']))
{		$_SESSION['Identifiant'] = $_POST['Identifiant'];
		if(isset($_POST['Identifiant']))
		{
		$name=$_POST['Identifiant'];
		}
		$_SESSION['Motdepasse'] = $_POST['Motdepasse'];
		$password=$_POST['Motdepasse'];
		$_SESSION['money'] = $_POST['Argent'];
		$money=$_POST['Argent'];
		try {
			$conn = new PDO('mysql:host=localhost;dbname=p1809164;charset=utf8','p1809164','371635');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Player (name, password, money) values('$name','$password','$money')";
			$conn->exec($sql);
			}
		catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}
		$conn = null;
		header('Location: roulette.php');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
		<title>Inscription</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>

</header>
<main>
Inscription
<br><br>
<form class='formulaire' method="post"  action="inscription.php">
<label for ="UserInput">Identifiant :</label>
<input id="UserInput" type="text" name="Identifiant">
<br>
<label for ="MDPInput">Mot de passe :</label>
<input id="MDPInput" type="password" name="Motdepasse">
<br>
<label for ="ArgInput">Argent :</label>
<input id="ArgInput" type="text" name="Argent">
<br>
<br><br>
<input type="submit" name="btncrea" value="Jouer">
</form>
<br><br>
<a href="index.php">Retour à l'acceuil<a>
</main>
</body>
</html>