<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

include("../partials/header.php");

global $bdd;

// identifier les id_trajet correspondant à l'id profil dans la table est associe a
$sql = "SELECT id_trajet, fonction FROM est_associe_a
        WHERE id_profil = :id_profil
        ORDER BY fonction DESC";

$stmt = $bdd->prepare($sql);

$stmt->bindParam(':id_profil', $id_profil);

$stmt->execute();

$ids_trajet = $stmt->fetchAll();

$var = 0;

foreach ($ids_trajet as $id_trajet) {
    $sql = "SELECT statut, nb_passagers, date, heure, prix
            FROM trajet
            WHERE id = :id_trajet";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_trajet', $id_trajet['id_trajet']);

    $stmt->execute();

    $trajets = $stmt->fetchAll();

    $statut = $trajets[0]['statut'];
    $nb_passagers = $trajets[0]['nb_passagers'];
    $date = $trajets[0]['date'];
    $heure = $trajets[0]['heure'];
    $prix = $trajets[0]['prix'];


    if ($statut == 0) {
        $statut = "Supprimé";
        $stat = "annule";
    } elseif ($statut == 1) {
        $statut = "En cours";
        $stat = "en-cours";
    } elseif ($statut == 2) {
        $statut = "Terminé";
        $stat = "finalise";
    }


    $sql = "SELECT id_lieu, ordre
            FROM passe_par
            WHERE id_trajet = :id_trajet";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_trajet', $id_trajet['id_trajet']);

    $stmt->execute();

    $lieux = $stmt->fetchAll();

    foreach ($lieux as $lieu) {
        if ($lieu['ordre'] == 1) {
            $id_lieu_depart = $lieu['id_lieu'];
        } elseif ($lieu['ordre'] == 2) {
            $id_lieu_arrive = $lieu['id_lieu'];
        }
    }
    $sql = "SELECT ville
            FROM lieu
            WHERE id = :id_lieu_depart";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_lieu_depart', $id_lieu_depart);

    $stmt->execute();

    $ville_depart = $stmt->fetch()['ville'];


    $sql = "SELECT ville
            FROM lieu
            WHERE id = :id_lieu_arrive";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_lieu_arrive', $id_lieu_arrive);

    $stmt->execute();

    $ville_arrive = $stmt->fetch()['ville'];


    $sql = "SELECT p.prenom, p.num_tel, p.pdp, a.fonction
            FROM profil p, est_associe_a a
            WHERE a.id_trajet = :id_trajet AND p.id = a.id_profil";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':id_trajet', $id_trajet['id_trajet']);

    $stmt->execute();

    $passagers = $stmt->fetchAll();

    if ($id_trajet['fonction'] == 1) {
        if($var == 0){
            echo "<br><br>
<p class='mes_trajets'>Mes trajets</p><br><br>";

        }
        $var = 1;
        echo "
        <div class='box'>
        <div class='box_blanche'>

            <div class='prix'>
                <div>
                    <p class='text-prix'>" . $prix . "€</p>
                </div>

                <div class='date'><p class='text-date'>" . $date . "</p></div>

            </div>

            <div class='partie'>
                <p class='texte-depart'>" . $heure . "</p><p class='texte-depart'>" . htmlspecialchars($ville_depart) . "</p>

                <br>

                <div class='point_trait'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='8' height='83' viewBox='0 0 8 83' fill='none'>
                        <line x1='3.5' y1='6.5' x2='3.5' y2='78.5' stroke='black' stroke-width='3'/>
                        <circle cx='4' cy='4.5' r='3.5' fill='black' stroke='black'/>
                        <circle cx='4' cy='78.5' r='3.5' fill='black' stroke='black'/>
                    </svg>
                </div>



                <p class='texte-depart'>01h00 </p><p class='texte-depart'>" . htmlspecialchars($ville_arrive) . "</p>
            </div>
        <div class='partie'>";
        $compteur = 0;
        foreach ($passagers as $passager) {
            if ($passager['fonction'] == 0) {
                $prenom_passager = $passager['prenom'];
                $num_passager = $passager['num_tel'];
                $pdp_passager = $passager['pdp'];
                if($pdp_passager != NULL) {
                    echo "<div class='passager'>
                    <img class='profile-trajet' src='" . $pdp_passager . "' alt='personne'>
                    <p class='texte-user'>" . htmlspecialchars($prenom_passager) . "</p>
                    <img class='personne-trajet' src='pngegg (7).png' alt='personne'>
                    <br class='saut-ligne'>
                    <p class='texte-user'>" . $num_passager . "</p>
                </div>";
                }else {
                    echo "<div class='passager'>
                    <i class='bx bx-user-circle'></i>
                    <p class='texte-user'>" . htmlspecialchars($prenom_passager) . "</p>
                    <img class='personne-trajet' src='pngegg (7).png' alt='personne'>
                    <br class='saut-ligne'>
                    <p class='texte-user'>" . $num_passager . "</p>
                </div>";
                }
                $compteur = $compteur + 1;
            }
        }
        if($compteur == 0){
            echo "<div class='passager'>
                    <br class='saut-ligne'>
                    <p class='texte-user'>Aucun passagers</p>
                </div>";

        }

        echo "</div>
                <div class='box-etat-" . $stat . "'>
                    <div class='etat-" . $stat . "'>
                        <p>" . $statut . "</p>
                    </div>
                </div>";
        if($statut != "Supprimé"){
            echo "
                <form method='post'>
                
                    <div><a class='text-annulation' href='traitementAnnulerTrajet.php?id_trajet=".$id_trajet['id_trajet']."'>Annuler ce trajet</a></div>
                </form>
            </div>
        </div>";
        }

    }elseif($id_trajet['fonction'] == 0){
        if($var == 1){
            echo"<br><p class='mes_trajets'>Mes reservations</p><br><br>";
        }
        $var = 0;
        echo"
        <div class='box'>
        <div class='box_blanche'>

            <div class='prix'>
                <div>
                    <p class='text-prix'>" . $prix . "€</p>
                </div>

                <div class='date'><p class='text-date'>" . $date . "</p></div>

            </div>

            <div class='partie'>
                <p class='texte-depart'>" . $heure . "</p><p class='texte-depart'>" . htmlspecialchars($ville_depart) . "</p>

                <br>

                <div class='point_trait'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='8' height='83' viewBox='0 0 8 83' fill='none'>
                        <line x1='3.5' y1='6.5' x2='3.5' y2='78.5' stroke='black' stroke-width='3'/>
                        <circle cx='4' cy='4.5' r='3.5' fill='black' stroke='black'/>
                        <circle cx='4' cy='78.5' r='3.5' fill='black' stroke='black'/>
                    </svg>
                </div>



                <p class='texte-depart'>01h00 </p><p class='texte-depart'>" . htmlspecialchars($ville_arrive) . "</p>
            </div>
        <div class='partie'>";

        foreach ($passagers as $passager) {
            if ($passager['fonction'] == 1) {
                $prenom_conducteur = $passager['prenom'];
                $num_conducteur = $passager['num_tel'];
                $pdp_conducteur = $passager['pdp'];
                if($pdp_conducteur != NULL) {
                    echo "<div class='passager'>
                    <img class='profile-trajet' src='" . $pdp_conducteur . "' alt='personne'>
                    <p class='texte-user'>" . htmlspecialchars($prenom_conducteur) . "</p>
                    <img class='personne-trajet' src='pngegg (7).png' alt='personne'>
                    <br class='saut-ligne'>
                    <p class='texte-user'>" . $num_conducteur . "</p>
                </div>";
                }else {
                    echo "<div class='passager'>
                    <i class='bx bx-user-circle'></i>
                    <p class='texte-user'>" . htmlspecialchars($prenom_conducteur) . "</p>
                    <img class='personne-trajet' src='pngegg (7).png' alt='personne'>
                    <br class='saut-ligne'>
                    <p class='texte-user'>" . $num_conducteur . "</p>
                </div>";
                }
            }
        }

        echo "</div>
                <div class='box-etat-" . $stat . "'>
                    <div class='etat-" . $stat . "'>
                        <p>" . $statut . "</p>
                    </div>
        
                  
                </div>";
        if($statut != "Supprimé"){
            echo "
                <form method='post'>
                <div><a class='text-annulation' href='../signalisation/signaler.php?id_trajet=".$id_trajet['id_trajet']."'>Signaler ce trajet</a></div>
                    <div><a class='text-annulation' href='traitementAnnulerTrajet.php?id_trajet=".$id_trajet['id_trajet']."'>Annuler cette réservation</a></div>
                </form>
            </div>
        </div>";
        }
            echo "</div>
        </div>";


    }

}