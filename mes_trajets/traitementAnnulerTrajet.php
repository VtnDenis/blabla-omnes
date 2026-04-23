<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

$sql = "SELECT fonction FROM est_associe_a
        WHERE id_profil = :id_profil
        AND id_trajet = :id_trajet";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil', $id_profil);
$stmt->bindParam(':id_trajet', $_GET['id_trajet']);
$stmt->execute();
$fonction = $stmt->fetch()['fonction'];
if($fonction == 1){
    // Si je suis conducteur
    $sql = "UPDATE trajet
        SET statut = 0
        WHERE id = :id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
    $stmt->execute();
}
else{
    // Si je suis passager
    $sql = "DELETE FROM est_associe_a
        WHERE id_profil = :id_profil
        AND id_trajet = :id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_profil', $id_profil);
    $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
    $stmt->execute();

    $sql = "SELECT nb_passagers
            FROM trajet
            WHERE id = :id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
    $stmt->execute();
    $nb_passagers = $stmt->fetch()['nb_passagers'];

    $nb_passagers++;
    $sql = "UPDATE trajet
            SET nb_passagers = :nb_passagers
            WHERE id = :id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nb_passagers', $nb_passagers);
    $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
    $stmt->execute();

}

header("Location: mes_trajets.php");
exit();


?>