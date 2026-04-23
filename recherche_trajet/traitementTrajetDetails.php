<?php
session_start();
include("../connexion_bdd.php");

global $bdd;

$id_trajet = $_GET['id_trajet'];
$nb_passagers = $_GET['nb_passagers'];
$id_profil = $_COOKIE['profil_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // J'ai besoin de id_profil et id_trajet
    header("Location: ../paiement/paiement.php?id_trajet=".$id_trajet."&nb_passagers=".$nb_passagers);
    exit();
}


// Ce qu'on souhaite : nombre de passagers, date, heure, prix, adresses précises, conducteur, voiture

// On récupère le nombre de passagers, la date, l'heure et le prix
$sql = "SELECT * FROM trajet WHERE id='$id_trajet'";

$stmt = $bdd->prepare($sql);
$stmt->execute();

$result_trajet = $stmt->fetch();

$nb_passagers_autorise = $result_trajet['nb_passagers'];
$date = $result_trajet['date'];
$heure = $result_trajet['heure'];
$prix = $result_trajet['prix']*$_GET['nb_passagers'];
$id_voiture = $result_trajet['id_voiture'];
$commentaire = $result_trajet['commentaire'];

// On récupère les ids des lieux par lequel le trajet passe

$sql = "SELECT id_lieu FROM passe_par WHERE id_trajet = :id_trajet ORDER BY ordre";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_trajet', $id_trajet);
$stmt->execute();

$results_passe_par = $stmt->fetchAll();
$ids_lieux = array();

foreach($results_passe_par as $result){
    $ids_lieux[] = $result['id_lieu'];
}

// On récupère l'adresse précise de chaque lieu

$lieux = array();

foreach($ids_lieux as $id_lieu){
    $sql = "SELECT * FROM lieu WHERE id = :id_lieu";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_lieu', $id_lieu);
    $stmt->execute();
    $result_lieu = $stmt->fetch();

    // Mise en forme de l'adresse
    $lieux[] = $result_lieu['num'] . ' ' . $result_lieu['type'] . ' ' . $result_lieu['nom_adresse']. ', ' . $result_lieu['code_postal'] . ' ' . $result_lieu['ville'] . ', ' . $result_lieu['pays'];

}

// On cherche le conducteur

$sql = "SELECT id_profil FROM est_associe_a WHERE id_trajet = :id_trajet AND fonction = 1";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_trajet', $id_trajet);
$stmt->execute();
$id_profil_conducteur = $stmt->fetch()['id_profil'];

$sql = "SELECT nom, prenom FROM profil WHERE id = :id_profil";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil', $id_profil_conducteur);
$stmt->execute();
$conducteur = $stmt->fetch();

// On cherche la voiture

$sql = "SELECT modele, marque FROM voiture WHERE id = :id_voiture";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(":id_voiture", $id_voiture);
$stmt->execute();
$voiture = $stmt->fetch();

// On affiche toutes les informations

echo "<div class='info-block-choix'>
        <span>Date</span>
        <span>".$date."</span>
        <span>".$nb_passagers_autorise." places disponibles"."</span>
        <span>"."Description : ".htmlspecialchars($commentaire)."</span>
        <span>".htmlspecialchars($voiture['marque'])." ".htmlspecialchars($voiture['modele'])."</span>

        <div class='trajet-et-preferences'>
            <div class='route-choix'>
                <span>Lieu de départ</span>
                <span>".array_shift($lieux)."</span>
                <svg xmlns='http://www.w3.org/2000/svg' width='8' height='144' viewBox='0 0 8 144' fill='none'>
                    <path d='M3 6L4 136' stroke='black' stroke-width='3'/>
                    <circle cx='4' cy='4' r='3.5' fill='black' stroke='black'/>
                    <circle cx='4' cy='140' r='3.5' fill='black' stroke='black'/>
                </svg>
                
                <span>Lieu d'arrivée</span>
                <span>".array_shift($lieux)."</span>
            </div>

            <div class='preferences'>
                <div class='profile-choix'>
                    <img src='../img/pngegg (5).png' alt='Conducteur'>
                    <span class='text-sm'>".htmlspecialchars($conducteur['prenom'])." ".htmlspecialchars($conducteur['nom'])."</span>
                </div>
            </div>
        </div>

        <div class='price'>
            Prix du trajet :".$prix."€
        </div>

        <div class='bouton-reserver'>
            <form method='post'>
                <button type='submit' name='reserver'>Réserver</button>
            </form>
        </div>
    </div>";