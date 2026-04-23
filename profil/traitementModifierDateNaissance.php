<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_naissance = $_POST["nouvelle_date_naissance"];

    $sql = "UPDATE profil SET date_naissance = :date_naissance WHERE id = :id_profil;";
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();
    header("Location: ../profil/info-utilisateur.php");
    exit();
}