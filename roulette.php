<?php
session_start();
$name= $_SESSION['Identifiant'];
$today = date("Y-m-d H:i:s"); 
if (empty($_SESSION['Identifiant']))
{
	header('Location: index.php');
}
	if(isset($_POST['Nombre']))
	{
		if (($_SESSION['money'])==0)
		{
		echo "Vous n'avez pas assez d'argent pour jouer".'<br>';
		}
		if($_POST['Mise']>$_SESSION['money'])
					{
						echo "Vous n'avez pas assez d'argent pour faire une telle mise".'<br>';
					}

					elseif(empty($_POST['Mise']))
					{
						echo "Entrez une mise pour jouer".'<br>';
					}
			if(!empty($_POST['Nombre']))
				{
					if(isset($_POST['Mise']))
					{
						$mise= $_POST['Mise'];
					}					
							
							$_SESSION['money']=$_SESSION['money']-$mise;
							$roulette = rand (1, 36 );
							if($_POST['Nombre']==$roulette)
								{
									echo "Youpi!".'<br>'."C'est bien le nombre " .$roulette." qui est tombé!".'<br>';
									$profit= $_SESSION['money']+$mise*35;
									$_SESSION['money']=($_SESSION['money']+($mise*35));
									$money= $_SESSION['money'];
								}
							else
								{
									echo '<br>'."Dommage, vous avez parié sur le " .$_POST['Nombre']. " et c'est le ".$roulette." qui est sorti.".'<br>';
									$money= $_SESSION['money'];
									$profit= 0;
								}
							try {
								$conn = new PDO('mysql:host=localhost;dbname=p1809164;charset=utf8','p1809164','371635');
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = " UPDATE Player  SET money = '$money' WHERE name = '$name' ";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$sql = "INSERT INTO Game (Player, Date, Bet, Profit ) values('$name','$today','$mise', '$profit')";
								$conn->exec($sql);
								}
							catch(PDOException $e)
								{
								echo $sql . "<br>" . $e->getMessage();
								}

							$conn = null;
						}

	else
						{
							if(isset($_POST['Mise']))
							{
								$mise= $_POST['Mise'];
							}
						$_SESSION['money']=$_SESSION['money']-$mise;
					
						$roulette = rand (1, 36 );
							if((($roulette%2==0)&&($_POST['parite']=="1"))||(($roulette%2==1)&&($_POST['parite']=="2")))
							{
								if($_POST['parite']=="1")
								{
								echo "Félicitations, vous aviez parié sur un nombre pair et " .$roulette." l'est!".'<br>';
								$profit= $_SESSION['money']+$mise*2;
								$_SESSION['money']=($_SESSION['money']+($mise*2));
								$money= $_SESSION['money'];
								}	
								else
								{
								echo "Félicitations, vous aviez parié sur un nombre  impair et " .$roulette." l'est!".'<br>';
								$profit= $_SESSION['money']+$mise*2;
								$_SESSION['money']=($_SESSION['money']+($mise*2));	
								$money= $_SESSION['money'];
								}
							}
							else
							{
								if($_POST['parite']=="1")
								{
								echo "Raté, vous aviez parié sur un nombre pair et " .$roulette." ne l'est pas!".'<br>';
								}
								else
								{
								echo "Raté, vous aviez parié sur un nombre impair et " .$roulette." ne l'est pas!".'<br>';
								}
							}
							try {
								$conn = new PDO('mysql:host=localhost;dbname=p1809164;charset=utf8','p1809164','371635');
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$sql = " UPDATE Player  SET money = '$money' WHERE name = '$name' ";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$sql = "INSERT INTO Game (Player, Date, Bet, Profit ) values('$name','$today','$mise', '$profit')";
								$conn->exec($sql);
								}
							catch(PDOException $e)
								{
								echo $sql . "<br>" . $e->getMessage();
								}

							$conn = null;
					}
			
		}
	

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
		<title>Roulette</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>

</header>
<main>
<!-- ?php
echo" Vous avez ". $_SESSION['money']." €";
?--> 
<form class='formulaire'method="POST"  action="roulette.php">
<label for ="UserInput">Votre mise :</label>
<input id="UserInput" type="texte" name="Mise">
<br>
Miser sur un nombre
<input type="number" min="1" max="36" name="Nombre">
<br>
ou 
<br>
Miser sur la parité
<input type="radio" name="parite" id="Pair" value="1" checked>Pair
<input type="radio" name="parite" id="Impair" value="2" checked>Impair
<br><br>
<input type="submit" name="btnsubmit" value="Jouer">
</form>
<br><br>
<a href="index.php?deco">Déconnexion</a>
</main>
</body>

<?php
if (isset($_GET['deco'])){}
?>
</html>