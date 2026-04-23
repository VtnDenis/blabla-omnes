<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["nouveau_email"];

    $sql = "UPDATE profil SET email = :email WHERE id = :id_profil;";
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();
    header("Location: ../profil/info-utilisateur.php");
    exit();
}