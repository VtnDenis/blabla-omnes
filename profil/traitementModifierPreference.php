
<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mise à jour des préférences du profil
    $sql = "UPDATE preferences SET fumer = :fumer, discussion = :discussion, musique = :musique, animaux = :animaux
        WHERE id_profil = :id_profil;";

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

    header("Location: info-utilisateur.php");
    exit();
}

?>