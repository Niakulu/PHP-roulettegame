<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=p1809164;charset=utf8','p1809164','371635');
  } catch (Exception $e) {
    die('Erreur !: ' . $e->getMessage());
}
$requete = 'Select id,name,password, money from Player WHERE name=? and password=?';
$req=$bdd->prepare($requete);
if(isset($_POST['Identifiant']) && isset($_POST['Motdepasse']))
{
		$req->execute( array($_POST['Identifiant'],$_POST['Motdepasse']));
        $data=$req->fetch();
		if($_POST['Identifiant'] =$data['name']&&$_POST['Motdepasse'] =$data['password']){
            $_SESSION['id'] = $data['id'];
            $_SESSION['Identifiant'] = $data['name'];
            $_SESSION['Motdepasse'] = $data['password'];
            $_SESSION['money'] = $data['money'];
            header('Location: roulette.php');
		}
		
	else 
	{
		echo "Les identifiants ne sont pas reconnus, recommencez ou créez un compte".'<br>';
		echo '<a href="inscription.php">Inscription<a>'.'<br>';
	}
}
if (isset($_GET['deco']))
{
	session_unset ();
	session_destroy ();
}
if(isset($_SESSION['Motdepasse']))
{
	header('Location: roulette.php');
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<link rel="stylesheet" type="text/css" href="style.css" />
<head>
		<title>Connexion</title>
		<meta charset="utf-8">
		</head>
<body>
<header>

</header>
<main>
		Connectez vous pour jouer à la roulette
		<br><br>
		<form class='formulaire' method="POST"  action="index.php">
		<label for ="UserInput">Identifiant :</label>
		<input id="UserInput" type="text" name="Identifiant">
		<br>
		<label for ="MDPInput">Mot de passe :</label>
		<input id="MDPInput" type="password" name="Motdepasse">
		<br><br>
		<input type="reset" name="btEFFACE" value="Effacer">
		<input type="submit" name="btnsubmit" value="Jouer">
		</form>
		<br><br>
		Pas encore de compte?
		<a href="inscription.php">Je m'inscris<a>
</main>			
</body>
</html>