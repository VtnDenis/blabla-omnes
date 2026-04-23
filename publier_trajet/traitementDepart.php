<?php
session_start();

include("../connexion_bdd.php");


global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $depart_num = $_POST["street_number"];
    $depart_type = $_POST["route_type"];
    $depart_nom = $_POST["route_name"];
    $depart_ville = $_POST["locality"];
    $depart_cp = $_POST["postal_code"];
    $depart_pays = $_POST["country"];

    $_SESSION['depart_num'] = $depart_num;
    $_SESSION['depart_type'] = $depart_type;
    $_SESSION['depart_nom'] = $depart_nom;
    $_SESSION['depart_ville'] = $depart_ville;
    $_SESSION['depart_cp'] = $depart_cp;
    $_SESSION['depart_pays'] = $depart_pays;
    
    header("Location: arrivee.php");
    exit();
}
?>