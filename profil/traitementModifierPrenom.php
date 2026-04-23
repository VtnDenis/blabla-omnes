<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST["nouveau_prenom"];

    $sql = "UPDATE profil SET prenom = :prenom WHERE id = :id_profil;";
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();
    header("Location: info-utilisateur.php");
    exit();
}