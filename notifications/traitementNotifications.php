<?php
include("../connexion_bdd.php");
require_once '../includes/auth.php';
$id_profil = requireAuth();

global $bdd;

// On récupère les signalements de l'utilisateur
$sql = "SELECT * FROM signale WHERE id_profil = :id_profil";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_profil', $id_profil);
$stmt->execute();

if($stmt->rowCount() > 0){
    $signalements = $stmt->fetchAll();
    $index = 0;

    foreach($signalements as $signalement){
        if(empty(trim($signalement['commentaire']))){
            // On l'affiche
            echo "<div class='notification'>
                                <a target='_blank' href='../signalisation/defenseSignaler.php?id_plainte=".$signalement['id_plainte']."'><p>URGENT : Litige à défendre</p></a>
                                <span class='notification-time'>Récemment</span>
                            </div>";
            $index++;
        }
    }
    if($index == 0){
        echo "<div class='notification'>
                                <p>Aucune notification</p>
                                <span class='notification-time'>Peut-être plus tard!</span>
                            </div>";
    }
}
