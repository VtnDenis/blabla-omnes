<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['permission'])){
        $permission = $_POST['permission'];

        $sql = "UPDATE profil SET type = :type WHERE id = :id_profil";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':type', $permission);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->execute();
        header("Location: info-utilisateur.php");
        exit();
    }
}
