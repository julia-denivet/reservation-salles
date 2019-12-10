<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Page Title</title>
    <link rel='stylesheet' type='text/css' media='screen' href='reservation1.css'>
    
</head>
<body class="bodyindex">
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

    <h1  class="aindex" target="_blank">Bienvenue  sur  arcadelife,  ici  tu  peux  reserver  ta  salle  pour  jouer  a  des  jeux  rétros  ! </h1>
 
<footer>

</footer>
</body>
</html>