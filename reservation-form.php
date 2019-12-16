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
<body id="bodyreservationform">
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
                <form action="reservation-form.php" method="post" class="form">
                <label>Titre :</label>
                <input class="inputco" type="text" name="titre" required><br>
                <label>Description :</label>
                <input class="inputco" type="text" name="desc" required><br>
                <label>Horaire début :</label>
                <input class="inputco" type="date" name="datedeb" required>
                <input class="inputco" type="time" name="timedeb" value="08:00" step="3600" min="08:00" max="18:00" required><br>
                <label>Horaire fin :</label>
                <input class="inputco" type="date" name="datefin" required>
                <input class="inputco" type="time" name="timefin" value="09:00" step="3600" min="09:00" max="19:00" required><br>
                <input class="inputco Validerco" type="submit" value="Réserver" name="valider">
                </form>
                <?php
                    $connect = mysqli_connect('localhost','root','', 'reservationsalles');
                    if(isset($_POST["valider"]))
                    {
                        $titre = $_POST["titre"];
                        $desc = $_POST["desc"];
                        $deb = $_POST["datedeb"]." ".$_POST["timedeb"];
                        $fin = $_POST["datefin"]." ".$_POST["timefin"];
                        $id = $_SESSION["id"];
                        $req = "SELECT * FROM reservations WHERE debut= '".$deb."'";
                        $query = mysqli_query($connect, $req);
                        $result = mysqli_fetch_all($query);
                        if(!empty($result))
                        {
                            echo "date déjà prise";
                        }
                        else
                        {
                            $reqins = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES ('$titre', '$desc', '$deb', '$fin', '$id')";
                            $queryins = mysqli_query($connect, $reqins);
                        }
                    }
                ?>
</main>
</body>
</html>
