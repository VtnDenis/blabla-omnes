<?php
session_start();
include("../connexion_bdd.php");
require_once '../includes/auth.php';
requireAdmin();

global $bdd;

$id_permis = $_GET['id_permis'];

$sql = "SELECT * FROM permis WHERE id = :id_permis";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_permis', $id_permis);
$stmt->execute();
$permis = $stmt->fetch();

echo $permis["id"] . "<br>";
echo htmlspecialchars($permis["num"]) . "<br>";
echo $permis["date"] . "<br>";
echo $permis["valide"] . "<br>";
echo $permis["photo_permis"] . "<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['valider'])){
        // Statut du permis
        // Refusé : 2
        // Validé : 1
        // En attente : 0
        $sql = "UPDATE permis SET valide = 1 WHERE id = :id_permis";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_permis', $id_permis);
        $stmt->execute();
        header("Location: gestionPermis.php");
        exit();
    }
    else if(isset($_POST['refuser'])){
        // Statut du permis
        // Refusé : 2
        // Validé : 1
        // En attente : 0
        $sql = "UPDATE permis SET valide = 2 WHERE id = :id_permis";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_permis', $id_permis);
        $stmt->execute();
        header("Location: gestionPermis.php");
        exit();
    }
}