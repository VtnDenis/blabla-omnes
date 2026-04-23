<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["defense"]) && isset($_GET["id_plainte"])){
        //On essaye de se connecter
        $defense = $_POST["defense"];
        $id_signalement = $_GET["id_plainte"];

        //On insère la défense dans la base de données
        $sql = "UPDATE signale SET commentaire = :defense WHERE id_plainte = :id_signalement AND id_profil = :id_profil";

        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->bindParam(':defense', $defense);
        $stmt->bindParam(':id_signalement', $id_signalement);

        $stmt->execute();

        //Rediriger vers la page d'accueil
        header("Location: ../recherche_trajet/accueil.php");
        exit();
    }
}
