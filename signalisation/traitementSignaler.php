<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;
$id_trajet = $_GET['id_trajet'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["raison"]) && isset($_POST["details"])) {
        //On récupère les données du formulaire
        $raison = $_POST["raison"];
        $details = $_POST["details"];

        //On récupère l'ID du profil du conducteur
        $sql = "SELECT id_profil FROM est_associe_a WHERE id_trajet = :id_trajet AND fonction = 1";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_trajet', $id_trajet);
        $stmt->execute();
        $id_profil_conducteur = $stmt->fetch()['id_profil'];

        // On cherche une plainte en commun entre le conducteur et le passager
        $sql = "SELECT p.id FROM plainte p JOIN signale s ON p.id = s.id_plainte WHERE s.id_profil = :id_profil AND s.id_profil = :id_profil_conducteur";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->bindParam(':id_profil_conducteur', $id_profil_conducteur);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            //Le plaignant a déjà signalé la même personne
            echo "HERE : " . $id_profil_conducteur;
            //header("Location: ../recherche_trajet/accueil.php");
            exit();
        }

        // On insère les details dans la table plainte
        $sql = "INSERT INTO plainte (statut, raison) VALUES (0,:raison)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':raison', $raison);
        $stmt->execute();

        // On récupère l'id de la plainte
        $id_plainte = $bdd->lastInsertId();

        // On vérifie que le signalement n'a pas déjà été fait
        $sql = "SELECT * FROM signale WHERE id_profil = :id_profil AND id_plainte = :id_plainte";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->bindParam(':id_plainte', $id_plainte);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            //Rediriger vers la page d'accueil
            header("Location: ../recherche_trajet/accueil.php");
            exit();
        }

        //On insère le signalement dans la base de données
        $sql = "INSERT INTO signale (id_profil,id_plainte, commentaire) VALUES (:id_profil,:id_plainte, :commentaire)";

        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->bindParam(':commentaire', $details);
        $stmt->bindParam(':id_plainte', $id_plainte);

        $stmt->execute();

        //On insère le signalement dans la base de données pour le conducteur
        $sql = "INSERT INTO signale (id_profil,id_plainte) VALUES (:id_profil,:id_plainte)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_profil', $id_profil_conducteur);
        $stmt->bindParam(':id_plainte', $id_plainte);

        // Le conducteur est informé du signalement et devra remplir le commentaire
        $stmt->execute();

        //Rediriger vers la page d'accueil
        header("Location: ../recherche_trajet/accueil.php");
        exit();
    }
}