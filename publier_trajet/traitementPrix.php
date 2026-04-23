<?php
session_start();

include("../connexion_bdd.php");

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $prix = $_POST['prix'];
    $_SESSION['prix'] = $prix;

    header("Location: description.php");
    exit();
}

