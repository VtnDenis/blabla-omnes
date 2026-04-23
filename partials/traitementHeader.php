<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include ("../connexion_bdd.php");

global $bdd;

if(isset($_SESSION['profil_id'])){
    $sql = "SELECT pdp FROM profil WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['profil_id']);
    $stmt->execute();
    $pdp = $stmt->fetch()['pdp'];
    if(!empty(trim($pdp))){
        // Il a une pdp
        echo "<a href='../profil/info-utilisateur.php'>
                    <img class='image-profile' src='".$pdp."' alt='profile'>
                </a>";
    }
    else{
        echo "<a href='../profil/info-utilisateur.php'>
                    <img class='image-profile' src='../img/pngegg%20(5).png' alt='profile'>
                </a>";
    }
}
else{
    echo "<a href='../compte/compte.php'>
                    <img class='image-profile' src='../img/pngegg%20(5).png' alt='profile'>
                </a>";
}