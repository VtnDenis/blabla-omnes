<?php
session_start();
include("../connexion_bdd.php");
require_once '../includes/auth.php';
requireAdmin();

global $bdd;

$id_plainte = $_GET['id_plainte'];

$conducteur_id = 0;
$conducteur_nom = "";
$conducteur_prenom = "";
$conducteur_comment ="";

$sql = "SELECT * FROM plainte WHERE id = :id_plainte";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_plainte', $id_plainte);
$stmt->execute();
$plainte = $stmt->fetch();

$raison = $plainte["raison"];
$statut = $plainte["statut"];

$sql = "SELECT * FROM signale WHERE id_plainte = $id_plainte";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$signales = $stmt->fetchAll();

$user_nom = "";
$user_prenom = "";
$users_comment = "";
$utilisateur_id = 0;


foreach($signales as $signale){
    $user_id = $signale["id_profil"];

    $sql = "SELECT nom, prenom FROM profil WHERE id = $user_id";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetch();
    $user_nom = $user["nom"];
    $user_prenom = $user["prenom"];

    // On cherche l'id du trajet concerné
    $sql = "SELECT id_trajet FROM est_associe_a WHERE id_profil = $user_id";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $id_trajet = $stmt->fetch()['id_trajet'];

    // On regarde si c'est un conducteur ou un passager
    $sql = "SELECT fonction FROM est_associe_a WHERE id_profil = $user_id AND id_trajet = $id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $fonction = $stmt->fetch()['fonction'];

    if($fonction){

        $conducteur_nom = $user["nom"];
        $conducteur_prenom = $user["prenom"];
        $conducteur_id = $user_id;
        if(empty(trim($signale['commentaire']))){
            $conducteur_comment = "Aucun commentaire";
        }
        else{
            $conducteur_comment = $signale["commentaire"];
        }
    }
    else{
        $utilisateur_id = $user_id;
        $user_comment = $signale["commentaire"];
    }

    $sql = "SELECT date FROM trajet WHERE id = $id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $date = $stmt->fetch()['date'];

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['resolu'])){
        // Statut du litige
        // Nouveau : 0
        // En cours : 1
        // Résolu : 2
        $sql = "UPDATE plainte SET statut = 2 WHERE id = :id_plainte";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_plainte', $id_plainte);
        $stmt->execute();
        header("Location: gestionPlaintes.php");
        exit();
    }
}