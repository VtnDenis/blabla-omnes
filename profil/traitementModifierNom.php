<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nouveau_nom"];

    $sql = "UPDATE profil SET nom = :nom WHERE id = :id_profil;";
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();
    header("Location: ../profil/info-utilisateur.php");
    exit();
}