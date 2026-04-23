<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST["marque"];
    $modele = $_POST["modele"];
    $num_plaque = $_POST["num_plaque"];

    if (isset($_FILES['photoVoiture']) && $_FILES['photoVoiture']['error'] == UPLOAD_ERR_OK) {
        $fileName = $_FILES['photoVoiture']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $filename = $marque."_".$modele."_".$num_plaque."_" . $id_profil . "." .$fileExtension;

        // Définissez le répertoire de destination
        $uploadFileDir = '../img/voitures/';
        $dest_path = $uploadFileDir . $filename;

        // Vérifiez si le répertoire de destination existe, sinon créez-le
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        move_uploaded_file($_FILES['photoVoiture']['tmp_name'], $dest_path);
    }
    
    $_SESSION['marque'] = $marque;
    $_SESSION['modele'] = $modele;
    $_SESSION['num_plaque'] = $num_plaque;
    $_SESSION['photo_voiture'] = $dest_path;

    header("Location: publication.php");
    exit();
}