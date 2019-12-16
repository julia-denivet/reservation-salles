<?php
session_start();


?>
<html>
<head>
    <meta charset='utf-8'>
    <title>Inscription</title>
    <link rel='stylesheet' type='text/css' media='screen' href='reservation1.css'>
    
</head>
<body class="bodyinscription">
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
<div class="title">
    <h2 >Inscription</h2>
</div>
<form class="form" method="post">
    
        <label class="labelinscription">Login</label>
        <input class="login entry"  type="text" name="login"  placeholder="Login"><br/>

        <label class="labelinscription">Password</label>
        <input class="password entry" type="password" name="password" placeholder="Mot de passe"><br/>

        <label class="labelinscription">Confirm Password</label>
        <input class="password entry" type="password" name="confirmpassword"  placeholder="Confirmer le mot de passe"><br/><br/>
        
        <input class="submit entry"  name="submit" type="submit" value="Valider"

    

    <div class="shadow"></div>
</form>
<?php
		if (isset($_POST['submit']))
		{
			$login = $_POST['login'];
			
			$confirmpassword = $_POST['confirmpassword'];
			
			if ($login && $_POST['password'] && $_POST['confirmpassword'])
			{
				if ($_POST['password']== $_POST['confirmpassword'])
				{
					
					$connexion = mysqli_connect('localhost','root','','reservationsalles') or die ('Error');
					$requete = "SELECT * FROM utilisateurs WHERE login='".$login."'";
					$query = mysqli_query($connexion, $requete);
					$rows = mysqli_num_rows($query);

					
					if ($rows==0)
					{
						$mdp = password_hash($_POST['password'], PASSWORD_BCRYPT,array ('cost'=> 12));
                        $requete2 = "INSERT INTO utilisateurs (login , password) VALUES ('$login','$mdp')";
						
						mysqli_query($connexion, $requete2);
						mysqli_close($connexion);
						header('location: connexion.php');
						
					} else echo "Ce pseudo est indisponible";
					
				} else echo "Les deux mots de passe doivent être identiques";
				
			} else echo "Veuillez saisir tous les champs";
		} 
	?>
</body>
</body>

</html>
