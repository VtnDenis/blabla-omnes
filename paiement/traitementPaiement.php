<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = $_POST['num'];
    $nom = $_POST['nom'];
    $exp_month = $_POST['exp_month'];
    $exp_year = $_POST['exp_year'];
    $expiration = $exp_year."-".$exp_month."-01";

    // Créer des objets DateTime à partir des mois et des années
    $date1 = DateTime::createFromFormat('Y-m', "$exp_year-$exp_month");

    // Récupérer la date actuelle
    $currentDate = new DateTime();
    $month2 = $currentDate->format('m');
    $year2 = $currentDate->format('Y');
    $date2 = DateTime::createFromFormat('Y-m', "$year2-$month2");

    if ($date1 < $date2) {
        header("Location: paiement.php?id_trajet=".$_GET['id_trajet']."&nb_passagers=".$_GET['nb_passagers']);
        echo "La carte est expirée";
        exit();
    }

    // On regarde si la carte n'existe pas déjà
    $sql = "SELECT * FROM coordonnees_bancaires
            WHERE titulaire = :nom
            AND numero = :num
            AND expiration = :expiration
            AND id_profil = :id_profil";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom',$nom);
    $stmt->bindParam(':num',$num);
    $stmt->bindParam(':expiration',$expiration);
    $stmt->bindParam(':id_profil',$id_profil);
    $stmt->execute();

    if($stmt->rowCount() == 0) {
        // La CB n'est pas enregistrée
        $sql = "INSERT INTO coordonnees_bancaires(numero, expiration, id_profil, titulaire)
                VALUES(:num, :expiration, :id_profil, :titulaire)";

        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':titulaire', $nom);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':expiration', $expiration);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->execute();
    }

    // On regarde si la réservation de trajet existe déjà
    $sql = "SELECT * FROM est_associe_a
            WHERE id_trajet = :id_trajet AND id_profil = :id_profil";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
    $stmt->bindParam(':id_profil', $id_profil);
    $stmt->execute();

    if($stmt->rowCount() == 0) {
        // La réservation n'est pas enregistrée
        $sql = "INSERT INTO est_associe_a(id_trajet, id_profil, fonction) VALUES (:id_trajet, :id_profil, 0)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->execute();

        // On met à jour le nombre de passagers
        $sql = "UPDATE trajet SET nb_passagers = nb_passagers - 1 WHERE id = :id_trajet";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
        $stmt->execute();

        // On met à jour l'argent depensé
        $sql = "SELECT prix FROM trajet WHERE id = :id_trajet";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
        $stmt->execute();
        $prix = $stmt->fetch()['prix'];

        $sql = "UPDATE argent SET depenses = depenses + :prix WHERE id = :id_profil";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->execute();

        // On met à jour le gain du conducteur
        $sql = "SELECT id_profil FROM est_associe_a WHERE id_trajet = :id_trajet AND fonction = 1";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_trajet', $_GET['id_trajet']);
        $stmt->execute();
        $id_conducteur = $stmt->fetch()['id_profil'];

        $sql = "UPDATE argent SET gains = gains + :prix WHERE id = :id_profil";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':id_profil', $id_conducteur);
        $stmt->execute();
    }

    header("Location: ../recherche_trajet/accueil.php");
    exit();
}
?>
