<?php
session_start();

include("../connexion_bdd.php");

global $bdd;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $_SESSION["description"] = $description;

    header("Location: voiture.php");
    exit();
}

