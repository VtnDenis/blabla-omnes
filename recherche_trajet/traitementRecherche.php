<?php
session_start();

include("../connexion_bdd.php");

global $bdd;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $depart = $_POST['city_start'];
    $arrivee = $_POST['city_end'];
    $date = $_POST['date'];
    $nb_passagers = $_POST['nb_passagers'];

    $_SESSION['depart'] = $depart;
    $_SESSION['arrivee'] = $arrivee;
    $_SESSION['date'] = $date;
    $_SESSION['nb_passagers'] = $nb_passagers;

    header("Location: choix-trajet.php");
    exit();
}