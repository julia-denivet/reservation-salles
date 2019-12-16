<?php
    
session_start();


$connexion = mysqli_connect("localhost","root", "","reservationsalles");
$requete= "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
$query= mysqli_query($connexion, $requete);
$data = mysqli_fetch_assoc($query);

if (isset($_SESSION['login']))
			{
			
			} else header('location: connexion.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Profil</title>
        <link rel="stylesheet" type="text/css" media="screen" href="reservation1.css">
    </head>
    <body class="bodyprofil">
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
        <section class='sectionprofil'>
            <form class='formprofil' method="post">
            <h1>Profil</h1>
                        
            <label>Login</label>
            <input class='inputprofil' type="text" name="login" placeholder="login" value="<?php echo $data['login']; ?>"  required>
            <br/>

            <label>Password</label>
            <input class='inputprofil' type="password" name="password" placeholder="password" required>
            <br/>

            <input class='inputprofil' id='Validerprofil' name="submit" type="submit" value="Valider">
                                        
        </form>
        </section>
        
        <?php
                

                if (isset($_POST['submit']))
               {
            
                   $mdp = password_hash($_POST['password'], PASSWORD_BCRYPT,array ('cost'=> 12));
                   $login = $_POST['login'];

                  
                //requete update sql
               $sql = "UPDATE utilisateurs SET  login = '$login', password = '$mdp' WHERE login = '".$_SESSION['login']."'";
                mysqli_query($connexion, $sql);
                $_SESSION['login'] = $login;
                header("Refresh:0");
                
               }
               ?>
    
    </body>
</html>