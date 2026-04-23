<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

$sql = "SELECT valide,id FROM permis WHERE id_profil = :id_profil";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil', $id_profil);
$stmt->execute();
$permis = $stmt->fetch();

if($stmt->rowCount() > 0){
    if($permis["valide"] == 1){
        header("Location: ../publier_trajet/depart.php");
        exit();
    }
    else if($permis["valide"] == 2){
        header("Location: demandeVerifPermis.php?id_permis=".$permis["id"]);
        exit();
    }
    else{
        echo "Votre permis est en attente";
    }
}
else{
    header("Location: demandeVerifPermis.php?id_permis=".$permis["id"]);
    exit();
}
