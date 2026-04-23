<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['nouvelle_PDP']) && $_FILES['nouvelle_PDP']['error'] == UPLOAD_ERR_OK) {

        $fileName = $_FILES['nouvelle_PDP']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "ERREUR : Type de fichier non autorisé";
            exit();
        }

        $filename = $id_profil.".".$fileExtension;

        // Définissez le répertoire de destination
        $uploadFileDir = '../img/profils/';
        $dest_path = $uploadFileDir . $filename;

        // Vérifiez si le répertoire de destination existe, sinon créez-le
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        move_uploaded_file($_FILES['nouvelle_PDP']['tmp_name'], $dest_path);

        $sql = "UPDATE profil SET pdp = :pdp WHERE id = :id_profil;";
        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':pdp', $dest_path);
        $stmt->bindParam(':id_profil', $id_profil);

        $stmt->execute();
        header("Location: info-utilisateur.php");
        exit();

    }

    echo "ERREUR : Fichier pas chargé";
    exit();


}