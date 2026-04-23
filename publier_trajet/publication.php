<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

$depart_num = $_SESSION['depart_num'];
$depart_type = $_SESSION['depart_type'];
$depart_nom = $_SESSION['depart_nom'];
$depart_ville = $_SESSION['depart_ville'];
$depart_cp = $_SESSION['depart_cp'];
$depart_pays = $_SESSION['depart_pays'];

$arrivee_num = $_SESSION['arrivee_num'];
$arrivee_type = $_SESSION['arrivee_type'];
$arrivee_nom = $_SESSION['arrivee_nom'];
$arrivee_ville = $_SESSION['arrivee_ville'];
$arrivee_cp = $_SESSION['arrivee_cp'];
$arrivee_pays = $_SESSION['arrivee_pays'];

$date_depart = $_SESSION['date_depart'];
$heure = $_SESSION['heure'];
$places = $_SESSION['places'];
$prix = $_SESSION['prix'];
$description = $_SESSION['description'];

$marque = $_SESSION['marque'];
$modele = $_SESSION['modele'];
$num_plaque = $_SESSION['num_plaque'];
$photo_voiture = $_SESSION['photo_voiture'];

echo "Profil:" . $id_profil . "<br>";
echo "depart_num:" . htmlspecialchars($depart_num) . "<br>";
echo "depart_type:" . htmlspecialchars($depart_type) . "<br>";
echo "depart_nom:" . htmlspecialchars($depart_nom) . "<br>";
echo "depart_ville:" . htmlspecialchars($depart_ville) . "<br>";
echo "depart_cp:" . htmlspecialchars($depart_cp) . "<br>";
echo "depart_pays:" . htmlspecialchars($depart_pays) . "<br>";
echo "arrivee_num:" . htmlspecialchars($arrivee_num) . "<br>";
echo "arrivee_type:" . htmlspecialchars($arrivee_type) . "<br>";
echo "arrivee_nom:" . htmlspecialchars($arrivee_nom) . "<br>";
echo "arrivee_ville:" . htmlspecialchars($arrivee_ville) . "<br>";
echo "arrivee_cp:" . htmlspecialchars($arrivee_cp) . "<br>";
echo "arrivee_pays:" . htmlspecialchars($arrivee_pays) . "<br>";
echo "Date:" . $date_depart . "<br>";
echo "Heure:" . $heure . "<br>";
echo "Places:" . $places . "<br>";
echo "Prix:" . $prix . "<br>";
echo "Description:" . htmlspecialchars($description) . "<br>";
echo "Marque:" . htmlspecialchars($marque) . "<br>";
echo "Modele:" . htmlspecialchars($modele) . "<br>";
echo "Num_plaque:" . htmlspecialchars($num_plaque) . "<br>";
echo "Photo:" . $photo_voiture . "<br>";


// Requêtes SQL

$bdd->beginTransaction();

$depart_num = $_SESSION["depart_num"];
$depart_type = $_SESSION["depart_type"];
$depart_nom = $_SESSION["depart_nom"];
$depart_ville = $_SESSION["depart_ville"];
$depart_cp = $_SESSION["depart_cp"];
$depart_pays = $_SESSION["depart_pays"];

// On vérifie si le lieu n'existe pas déjà
$sql = "SELECT id FROM lieu
        WHERE num = :depart_num
        AND type = :depart_type
        AND nom_adresse = :depart_nom
        AND ville = :depart_ville
        AND code_postal = :depart_cp
        AND pays = :depart_pays";

$stmt = $bdd->prepare($sql);
$stmt->bindParam(':depart_num', $depart_num);
$stmt->bindParam(':depart_type', $depart_type);
$stmt->bindParam(':depart_nom', $depart_nom);
$stmt->bindParam(':depart_ville', $depart_ville);
$stmt->bindParam(':depart_cp', $depart_cp);
$stmt->bindParam(':depart_pays', $depart_pays);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    // Le lieu n'existe pas encore, on l'insère
    $sql = "INSERT INTO lieu(num, type, nom_adresse, ville, code_postal, pays)
            VALUES(:num, :type, :adresse, :ville, :cp, :pays)";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':num', $depart_num);
    $stmt->bindParam(':type', $depart_type);
    $stmt->bindParam(':adresse', $depart_nom);
    $stmt->bindParam(':ville', $depart_ville);
    $stmt->bindParam(':cp', $depart_cp);
    $stmt->bindParam(':pays', $depart_pays);
    $stmt->execute();

    $id_depart = $bdd->lastInsertId();
} else {
    // Le lieu existe déjà
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_depart = $result['id'];
}



$arrivee_num = $_SESSION["arrivee_num"];
$arrivee_type = $_SESSION["arrivee_type"];
$arrivee_nom = $_SESSION["arrivee_nom"];
$arrivee_ville = $_SESSION["arrivee_ville"];
$arrivee_cp = $_SESSION["arrivee_cp"];
$arrivee_pays = $_SESSION["arrivee_pays"];

// On vérifie si le lieu n'existe pas déjà
$sql = "SELECT id FROM lieu
        WHERE num = :arrivee_num
        AND type = :arrivee_type
        AND nom_adresse = :arrivee_nom
        AND ville = :arrivee_ville
        AND code_postal = :arrivee_cp
        AND pays = :arrivee_pays";

$stmt = $bdd->prepare($sql);
$stmt->bindParam(':arrivee_num', $arrivee_num);
$stmt->bindParam(':arrivee_type', $arrivee_type);
$stmt->bindParam(':arrivee_nom', $arrivee_nom);
$stmt->bindParam(':arrivee_ville', $arrivee_ville);
$stmt->bindParam(':arrivee_cp', $arrivee_cp);
$stmt->bindParam(':arrivee_pays', $arrivee_pays);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    // Le lieu n'existe pas encore, on l'insère
    $sql = "INSERT INTO lieu(num, type, nom_adresse, ville, code_postal, pays)
            VALUES(:num, :type, :adresse, :ville, :cp, :pays)";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':num', $arrivee_num);
    $stmt->bindParam(':type', $arrivee_type);
    $stmt->bindParam(':adresse', $arrivee_nom);
    $stmt->bindParam(':ville', $arrivee_ville);
    $stmt->bindParam(':cp', $arrivee_cp);
    $stmt->bindParam(':pays', $arrivee_pays);
    $stmt->execute();

    $id_arrivee = $bdd->lastInsertId();
} else {
    // Le lieu existe déjà
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_arrivee = $result['id'];
}


// On enregistre la voiture
$sql = "INSERT INTO voiture(id_profil,marque, modele, num_plaque, photo)
        VALUES(:id_profil,:marque, :modele, :num_plaque, :photo_voiture);";

$stmt = $bdd->prepare($sql);

$stmt->bindParam(':id_profil', $id_profil);
$stmt->bindParam(':marque', $marque);
$stmt->bindParam(':modele', $modele);
$stmt->bindParam(':num_plaque', $num_plaque);
$stmt->bindParam(':photo_voiture', $photo_voiture);

$stmt->execute();

$id_voiture = $bdd->lastInsertId();

// On enregistre le trajet
$sql = "INSERT INTO trajet(id_voiture, statut, nb_passagers, date, heure, prix,commentaire)
        VALUES(:id_voiture, :statut, :nb_passagers, :date, :heure, :prix,:commentaire);";

$stmt = $bdd->prepare($sql);

$stmt->bindParam(':id_voiture', $id_voiture);

// Signification des valeurs de statut
// Complété : 2
// En cours : 1
// Annulé : 0

$a_venir = 1;

$stmt->bindParam(':statut', $a_venir);
$stmt->bindParam(':nb_passagers', $places);
$stmt->bindParam(':date', $date_depart);
$stmt->bindParam(':heure', $heure);
$stmt->bindParam(':prix',$prix);
$stmt->bindParam(':commentaire', $description);

$stmt->execute();

$id_trajet = $bdd->lastInsertId();

$sql = "INSERT INTO passe_par(id_lieu, id_trajet, ordre)
        VALUES(:id_lieu, :id_trajet, :ordre);";

$stmt = $bdd->prepare($sql);

$ordre_depart = 1;

$stmt->bindParam(':id_lieu', $id_depart);
$stmt->bindParam(':id_trajet', $id_trajet);
$stmt->bindParam(':ordre', $ordre_depart);

$stmt->execute();

$sql = "INSERT INTO passe_par(id_lieu, id_trajet, ordre)
            VALUES(:id_lieu, :id_trajet, :ordre);";

$stmt = $bdd->prepare($sql);

$ordre_arrivee = 2;

$stmt->bindParam(':id_lieu', $id_arrivee);
$stmt->bindParam(':id_trajet', $id_trajet);
$stmt->bindParam(':ordre', $ordre_arrivee);

$stmt->execute();

$sql = "INSERT INTO est_associe_a(id_trajet, id_profil, fonction)
        VALUES(:id_trajet, :id_profil, :fonction);";

$stmt = $bdd->prepare($sql);

$stmt->bindParam(':id_trajet', $id_trajet);
$stmt->bindParam(':id_profil', $id_profil);

// Signification des valeurs de fonction
// Passager : 0
// Conducteur : 1

$fonction = 1;

$stmt->bindParam(':fonction', $fonction);

$stmt->execute();

// On met à jour les statistiques
$sql = "UPDATE statistique SET nb_trajet_publie = nb_trajet_publie + 1 WHERE id_profil = :id_profil";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil', $id_profil);
$stmt->execute();

$bdd->commit();

echo "<h1>Publication réussie!</h1>";

header("Location: ../recherche_trajet/accueil.php");
exit();

//Problèmes : Extension fichier de la voiture + Duplication de ligne dans la table voiture
// + Revoir les retours en arrière dans les pages + Actualisation des pages
// Rajouter page récapitulatif
// Implémenter header/footer partout
// Relier page d'accueil à tout
// Revoir failles
