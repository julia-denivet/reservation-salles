<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Planning</title>
    <link rel='stylesheet' type='text/css' media='screen' href='reservation1.css'>
    
</head>
<body id="bodyplanning">
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
<main id="mainplanning">
<table class="steelBlueCols">
    <thead>
        <tr>
            <th></th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
        </tr>
    </thead>
    <tbody>
    <?php
		$connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
		$requete = "SELECT * FROM utilisateurs INNER JOIN reservations ON utilisateurs.id = reservations.id_utilisateur WHERE WEEK(reservations.debut) = WEEK(CURDATE())";
		$resultat = mysqli_query($connexion, $requete);

		for($l = 8; $l < 19; ++$l)
			{
			    echo '<tr>';
                echo '<td>', $l, '</td>';
                
					for($i = 0; $i <= 5; ++$i)
						{
							echo '<td>';
							$d = 0;

							foreach($resultat as $donnees)
							    {
									$date = date_create($donnees['debut'])->format('d/m/Y');
									list($jour, $mois, $annee) = explode('/', $date);
									$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
									$joursem = date("w",$timestamp);
									$heure = date_create($donnees['debut'])->format('G');

									if($joursem == $i && $heure == $l)
									    {
											$id = $donnees['id'];
											echo "<a href='reservation.php?id=", $id, "'><div>";
											echo $donnees['login'], '<br/>';
											echo $donnees['titre'];
											echo '</div></a>';
										}
									++$d;
								}
							echo '</td>';
						}
					echo'</tr>';
			}
	?>
    </tbody>
</table>
</main>
</body>
</html>
