<?php
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" media="screen" href="reservation1.css">
</head>
<body class="bodyconnexion">
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
    <section class="sectionco">
        <form class="formconnexion" method="post">

        <div class="text-effect">
            <label class="neon" data-text="Login">Login</label>
            <div class="gradient"></div>
            <div class="spotlight"></div>
        </div>
        
            <input class="inputco" type="text" placeholder="login" name="login">
            <br/>

            <label>Password</label>
            <input class="inputco" type="password" placeholder="password" name="password">
            <br/>
            <div class="box">
                <span class="top"></span>
                <span class="right"></span>
                <span class="left"></span>
                <span class="bottom"></span>
                <input class="inputco Validerco" type="submit" value="valider" name="submit">
            </div>    
        </form>
    </section>
    <?php
        if (isset($_POST['submit']))
            {
                $login = $_POST['login'];
                $password = $_POST ['password'];
                
                
                if ($login && $password)
                    {
                        $connect = mysqli_connect('localhost','root','', 'reservationsalles') or die ('Error');
                        $query = "SELECT*FROM utilisateurs WHERE login = '".$login."'";
                        $reg = mysqli_query ($connect,$query);
                        /*permet de lire/retourner une ligne du tableau, la première par défaut*/
                        $rows = mysqli_fetch_assoc($reg);

                        if ($login == $rows ['login'])
                        {
                            if (password_verify($_POST['password'],$rows['password']))
                            {	
                                session_start();
                                $_SESSION['login']=$login;
                                $_SESSION['password']=$password;
                                $_SESSION['id']=$rows['id'];
                                header('location: index.php');

                            } else echo "<p class = 'alertconnexion'>mot de passe incorrect</p>";

                        } else echo "<p class='alertconnexion'>Login ou Mot de passe incorrect</p>";

                    } else echo "<p class='alertconnexion'>Veuillez saisir tous les champs</p>";
                }
	?>

</body>
</html>








