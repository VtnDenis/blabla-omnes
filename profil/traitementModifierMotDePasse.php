<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //On vérifie que l'utilisateur connait l'ancien mot de passe
    $ancien_mdp = $_POST["ancien_mdp"];

    $sql = "SELECT * FROM profil WHERE id = :id_profil";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(":id_profil", $id_profil);
    $stmt->execute();

    if($stmt->rowCount() > 0 && password_verify($ancien_mdp, $stmt->fetch()['password'])) {
        //On enregistre le nouveau mot de passe
        $nouveau_mdp = password_hash($_POST["nouveau_mdp"], PASSWORD_BCRYPT);

        $sql = "UPDATE profil SET password = :mdp WHERE id = :id_profil;";
        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':mdp', $nouveau_mdp);
        $stmt->bindParam(':id_profil', $id_profil);

        $stmt->execute();
        header("Location: ../profil/info-utilisateur.php");
        exit();
    }
    else{
        echo "<p>Mot de passe actuel incorrect!</p>\n";
    }
}