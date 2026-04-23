<?php
include("../connexion_bdd.php");

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["prenom"])){
        //On souhaite modifier le prénom
        header("Location: modifierPrenom.php");
        exit();
    }
    else if(isset($_POST["nom"])){
        header("Location: modifierNom.php");
        exit();
    }
    else if(isset($_POST["email"])){
        header("Location: modifierEmail.php");
        exit();
    }
    else if(isset($_POST["date_naissance"])){
        header("Location: modifierDateNaissance.php");
        exit();
    }
    else if(isset($_POST["mdp"])){
        header("Location: modifierMotDePasse.php");
        exit();
    }
    else if(isset($_POST["pdp"])){
        header("Location: modifierPDP.php");
        exit();
    }
    else if(isset($_POST["profil_type"])){
        header("Location: modifierPermission.php");
        exit();
    }
    else if(isset($_POST["preference"])){
        header("Location: modifierPreference.php");
        exit();
    }
    else if(isset($_POST["deconnexion"])){
        setcookie("profil_id", "", time() - 3600,"/");
        unset($_COOKIE['profil_id']);
        $_SESSION['connecte'] = 0;
        header("Location: ../compte/compte.php");
        exit();
    }
}
