<?php
session_start();
include("../connexion_bdd.php");

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Début de la transaction
    $bdd->beginTransaction();

    // Création du profil
    $sql = "INSERT INTO profil (prenom, nom, email, password, num_tel, date_naissance, date_inscription)
VALUES (:name, :surname, :email_register, :password_register, :phone, :birthdate, NOW());";

    $stmt = $bdd->prepare($sql);

    $name = $_SESSION["name"];
    $surname = $_SESSION["surname"];
    $email_register = $_SESSION["email_register"];
    $password_register = $_SESSION["password_register"];
    $phone = $_SESSION["phone"];
    $birthdate = $_SESSION["birthdate"];


    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email_register', $email_register);
    $stmt->bindParam(':password_register', $password_register);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':birthdate', $birthdate);

    $stmt->execute();

    // Récupération de l'ID du dernier profil créé
    $id_profil = $bdd->lastInsertId();

    // Création des préférences du profil
    $sql = "INSERT INTO preferences (id_profil, fumer, discussion, musique, animaux)
VALUES (:id_profil, :fumer, :discussion, :musique, :animaux);";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_profil', $id_profil);

    $fumer = $_POST['fumer'];
    $discussion = $_POST['discussion'];
    $musique = $_POST['musique'];
    $animaux = $_POST['animaux'];

    $tab = [$fumer, $discussion, $musique, $animaux];

    for ($i = 0; $i < count($tab); $i++) {
        if ($tab[$i] == "oui") {
            $tab[$i] = 2;
        } else if ($tab[$i] == "peutetre") {
            $tab[$i] = 1;
        } else {
            $tab[$i] = 0;
        }
    }

    $stmt->bindParam(':fumer', $tab[0]);
    $stmt->bindParam(':discussion', $tab[1]);
    $stmt->bindParam(':musique', $tab[2]);
    $stmt->bindParam(':animaux', $tab[3]);

    $stmt->execute();

    // Récupération de l'ID de la dernière préférence créée
    $id_preferences = $bdd->lastInsertId();

    // Insertion de l'ID préférence au profil
    $sql = "UPDATE profil
            SET id_preferences = :id_preferences
            WHERE id = :id_profil";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_preferences', $id_preferences);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();

    // Création des dépenses/gains du profil
    $sql = "INSERT INTO argent(id_profil, gains, depenses)
VALUES (:id_profil, 0, 0);";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();

    // Récupération de l'ID du dernier dépenses/gains créé
    $id_argent = $bdd->lastInsertId();

    // Insertion de l'ID argent dans profil
    $sql = "UPDATE profil 
            SET id_argent = :id_argent
            WHERE id = :id_profil;";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_argent', $id_argent);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();

    // Création des statistiques du profil
    $sql = "INSERT INTO statistique(id_profil, nb_trajet_effectue, nb_trajet_publie)
VALUES (:id_profil, 0, 0);";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();

    // Récupération de l'ID de la dernière statistique créée
    $id_statistique = $bdd->lastInsertId();

    // Insertion de l'ID statistique dans profil
    $sql = "UPDATE profil
            SET id_statistique = :id_statistique
            WHERE id = :id_profil;";

    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_statistique', $id_statistique);
    $stmt->bindParam(':id_profil', $id_profil);

    $stmt->execute();

    // Execution de la transaction
    $bdd->commit();

    // On garde la session ouverte jusqu'à la fermeture du navigateur
    setcookie("profil_id", $id_profil,null,"/");

    header("Location: ../recherche_trajet/accueil.php");
    exit();
}

?>


