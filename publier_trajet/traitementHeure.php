<?php
session_start();

    include("../connexion_bdd.php");
    
    global $bdd;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $heure = $_POST['heure'];
        $_SESSION['heure'] = $heure;

        header("Location: places.php");
        exit();
    }

    
?>
