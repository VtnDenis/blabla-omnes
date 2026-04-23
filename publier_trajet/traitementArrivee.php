<?php
session_start();

include("../connexion_bdd.php");

global $bdd;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $arrivee_num = $_POST["street_number"];
    $arrivee_type = $_POST["route_type"];
    $arrivee_nom = $_POST["route_name"];
    $arrivee_ville = $_POST["locality"];
    $arrivee_cp = $_POST["postal_code"];
    $arrivee_pays = $_POST["country"];
    
    $_SESSION["arrivee_num"] = $arrivee_num;
    $_SESSION["arrivee_type"] = $arrivee_type;
    $_SESSION["arrivee_nom"] = $arrivee_nom;
    $_SESSION["arrivee_ville"] = $arrivee_ville;
    $_SESSION["arrivee_cp"] = $arrivee_cp;
    $_SESSION["arrivee_pays"] = $arrivee_pays;

    header("Location: dateDepart.php");
    exit();
}
?>
