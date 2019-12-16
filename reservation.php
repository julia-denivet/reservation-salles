<?php
session_start();
if(!isset($_SESSION["login"]))
{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Planning</title>
    <link rel='stylesheet' type='text/css' media='screen' href='reservation1.css'>
    
</head>
<body id="bodyreservation">
<header>
        <nav>
			<ul>
                <li ><a class="aheader" href="index.php">Accueil</a></li>
                <?php
                if (isset($_SESSION['login'])) 
                {
                    echo  "<li ><a class='aheader' href='index.php'>Inscription</a></li>";

                } 
                else echo "<li ><a class='aheader' href='inscription.php'>Inscription</a></li>";
                
                ?>
				<?php
				if(isset($_SESSION['login']))
				{
				echo "<li ><a class='aheader' href='deconnexion.php'>Déconnexion</a></li>";
				
				} else echo "<li ><a class='aheader' href='connexion.php'>Connexion</a></li>";
				?>
				<li ><a class="aheader" href="profil.php">Profil</a></li>
         		<li ><a class="aheader" href="planning.php">Planning</a></li>
				<li ><a class="aheader" href="reservation-form.php">Reservation</a></li>
			</ul>
		</nav>
</header>
<main>
    <?php
    $connect = mysqli_connect('localhost','root','', 'reservationsalles');
    $request = "SELECT * FROM reservations WHERE id = '".$_GET['id']."'";
    $query = mysqli_query($connect, $request);
    $result = mysqli_fetch_assoc($query);

    $requestuser = "SELECT login FROM utilisateurs WHERE id = '".$result['id_utilisateur']."'";
    $queryuser = mysqli_query($connect, $requestuser);
    $resultuser = mysqli_fetch_assoc($queryuser);
    ?>
    <div id="reservationdiv">
    <div class="reservationecho"><?php echo $result['titre']; ?></div>
	<div class="reservationecho">Réserver par : <?php echo $resultuser['login']; ?></div>
	<div class="reservationecho">Du : <?php echo $result['debut']; ?></div>
	<div class="reservationecho">Au : <?php echo $result['fin']; ?></div>
    <div class="reservationecho">Description : <br/><?php echo $result['description']; ?></div>
    </div>
</main>
</body>
</html>