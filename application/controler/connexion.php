<?php
    error_reporting(E_ALL);
    
 ini_set('display_errors', 0);

    require_once('../model/Bd.php');
    require_once('../model/Membre.php');

    session_start();
    if (isset($_SESSION['email'])) {
        header('Location:../controler/deconnexion.php');
    }
    session_destroy();

    if (isset($_POST["email"]) && isset($_POST["pwd"])) {
        $email = $_POST["email"];
        $password = $_POST["pwd"];
        $co = (new Bd('databasProjetTutore'))->connection() or die("erreur connexion");
        $membre = null;

        $result = mysqli_query($co, "SELECT * FROM Utilisateur
                                    WHERE `email_user` = '$email'
                                    AND `password` = '$password'")
        or die("erreur requete");
        if (mysqli_num_rows($result) == 1) {
            $membre = new Membre($co, $email,$password);
            $membre->startConnection();
            header('Location:../vue/accueil.php');
        }
        else {
            header('Location:../vue/formulaire_inscription.php');
        }
    }
?>
