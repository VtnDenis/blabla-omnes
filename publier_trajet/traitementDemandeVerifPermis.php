<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num = $_POST['num'];
    $exp_month = $_POST['exp_month'];
    $exp_year = $_POST['exp_year'];

    if (isset($_FILES['photo_permis']) && $_FILES['photo_permis']['error'] == UPLOAD_ERR_OK) {

        $fileName = $_FILES['photo_permis']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $filename = $id_profil.".".$fileExtension;

        // Définissez le répertoire de destination
        $uploadFileDir = '../img/permis/';
        $dest_path = $uploadFileDir . $filename;

        // Vérifiez si le répertoire de destination existe, sinon créez-le
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        move_uploaded_file($_FILES['photo_permis']['tmp_name'], $dest_path);

        $sql = "INSERT INTO permis(photo_permis,num,date,valide,id_profil) VALUES(:photo_permis,:num,:date,0,:id_profil);";
        $stmt = $bdd->prepare($sql);

        $date = $exp_year."-".$exp_month."-01";

        $stmt->bindParam(':photo_permis', $dest_path);
        $stmt->bindParam(':id_profil', $id_profil);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':date', $date);

        $stmt->execute();
        header("Location: ../recherche_trajet/accueil.php");
        exit();

    }
}