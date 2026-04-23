<?php
session_start();

    include("../connexion_bdd.php");

    global $bdd;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $date_depart = $_POST['datedepart'];
        $_SESSION['date_depart'] = $date_depart;

        header("Location: heure.php");
        exit();
    }
    
?>