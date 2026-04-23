<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['depart']) && isset($_POST['arrivee']) && isset($_POST['date']) && isset($_POST['nb_passagers'])){
        $depart = $_POST['depart'];
        $arrivee = $_POST['arrivee'];
        $date = $_POST['date'];
        $nb_passagers = $_POST['nb_passagers'];

        $_SESSION['depart'] = $depart;
        $_SESSION['arrivee'] = $arrivee;
        $_SESSION['date'] = $date;
        $_SESSION['nb_passagers'] = $nb_passagers;

        header("Location: choix-trajet.php");
        exit();
    }

}
include("../connexion_bdd.php");
global $bdd;

$depart = $_SESSION['depart'];
$arrivee = $_SESSION['arrivee'];
$date = $_SESSION['date'];
$nb_passagers = $_SESSION['nb_passagers'];

// On recherche que par ville pour l'instant

$sql = "SELECT id FROM lieu
                WHERE ville = :depart";

$stmt = $bdd->prepare($sql);

$stmt->bindParam(':depart', $depart);
$stmt->execute();

$ids_lieu_depart = $stmt->fetchAll();

$sql = "SELECT id FROM lieu
                WHERE ville = :arrivee";

$stmt = $bdd->prepare($sql);
$stmt->bindParam(':arrivee', $arrivee);

$stmt->execute();
$ids_lieu_arrivee = $stmt->fetchAll();

$ids_trajets = array();

if(empty($ids_lieu_arrivee) || empty($ids_lieu_depart)){
    echo "<h1>Pas de trajet trouvé</h1>";
}

foreach($ids_lieu_depart as $id_depart){
    foreach($ids_lieu_arrivee as $id_arrivee){
        $sql = "SELECT p1.id_trajet
                FROM passe_par p1
                JOIN passe_par p2 ON p1.id_trajet = p2.id_trajet
                WHERE p1.ordre = 1
                  AND p2.ordre = 2
                  AND p1.id_lieu = :id_lieu_depart
                  AND p2.id_lieu = :id_lieu_arrivee;
                ";

        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_lieu_depart', $id_depart['id']);
        $stmt->bindParam(':id_lieu_arrivee', $id_arrivee['id']);

        $stmt->execute();

        $ids_trajet = $stmt->fetchAll();

        foreach ($ids_trajet as $id_trajet) {
            $ids_trajets[] = $id_trajet['id_trajet'];
        }
    }
}

foreach ($ids_trajets as $id_trajet) {

    if(isset($_COOKIE['profil_id'])){
        // On vérifie si le trajet n'est pas déjà reservé par l'utilisateur
        $sql = "SELECT id_profil FROM est_associe_a
            WHERE id_trajet = :id_trajet AND id_profil = :id_profil";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':id_trajet', $id_trajet);
        $stmt->bindParam(':id_profil', $_COOKIE['profil_id']);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            continue;
        }
    }

    // On vérifie si le trajet est complet
    $sql = "SELECT nb_passagers FROM trajet WHERE id = :id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_trajet', $id_trajet);
    $stmt->execute();
    $nb_passagers = $stmt->fetch()['nb_passagers'];
    if($nb_passagers == 0){
        continue;
    }

    // On vérifie si le trajet n'est pas supprimé
    $sql = "SELECT * FROM trajet WHERE id = :id_trajet";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id_trajet', $id_trajet);
    $stmt->execute();
    $statut = $stmt->fetch()['statut'];
    if($statut == 0){
        continue;
    }

    $sql = "SELECT id_profil FROM est_associe_a
WHERE id_trajet = :id_trajet AND fonction= :fonction";

    $stmt = $bdd->prepare($sql);

    $fonction_conducteur = 1;
    $stmt->bindParam(':id_trajet', $id_trajet);
    $stmt->bindParam(':fonction', $fonction_conducteur);
    $stmt->execute();

    $id_conducteur = $stmt->fetch();

    $sql = "SELECT nom, prenom FROM profil WHERE id = :id_profil";
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_profil', $id_conducteur['id_profil']);
    $stmt->execute();

    $conducteur = $stmt->fetch();


    $sql = "SELECT id_voiture, nb_passagers, heure,prix
            FROM trajet
            WHERE id = :id_trajet AND nb_passagers >= :nb_passagers AND date = :date";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_trajet', $id_trajet);
    $stmt->bindParam(':nb_passagers', $nb_passagers);
    $stmt->bindParam(':date', $date);

    $stmt->execute();

    $trajets = $stmt->fetchAll();

    foreach ($trajets as $trajet) {

        echo "<div class='info-block-choix'>
        <span>Date</span>" . $date . "
        
        à ".$trajet['heure']."

        <div class='trajet-et-preferences'>
            <div class='route-choix'>
                <span>Lieu de départ</span>" .

            htmlspecialchars($depart) .

            "
                <svg xmlns='http://www.w3.org/2000/svg' width='8' height='144' viewBox='0 0 8 144' fill='none'>
                    <path d='M3 6L4 136' stroke='black' stroke-width='3' />
                    <circle cx='4' cy='4' r='3.5' fill='black' stroke='black' />
                    <circle cx='4' cy='140' r='3.5' fill='black' stroke='black' />
                </svg>
                <span>Lieu d'arrivée</span>" .

            htmlspecialchars($arrivee) .
            "
            </div>

            <div class='preferences'>
                <div class='profile-choix'>
                    <img src='../img/pngegg (5).png' alt='Conducteur'>
                    <span class='text-sm'>".htmlspecialchars($conducteur['prenom'])." ".htmlspecialchars($conducteur['nom'])."</span>
                </div>

            </div>

        </div>


        <div class='price'>
            Prix du trajet :" . $trajet['prix']*$_SESSION['nb_passagers'] . "€
        </div>

        <div class='bouton-reserver'>";

        if(isset($_COOKIE['profil_id'])){
            echo "<a href='trajetDetails.php?id_trajet=".$id_trajet."&nb_passagers=".$_SESSION['nb_passagers']."'><button type='submit' name='reserver'>Réserver</button></a>
             
        </div>
    </div>";
        }
        else{
            echo "<a href='../compte/compte.php'><button type='submit''>Réserver</button></a>
             
        </div>
    </div>";
        }

    }
}