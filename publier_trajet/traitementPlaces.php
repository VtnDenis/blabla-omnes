<?php
session_start();

    include("../connexion_bdd.php");

    global $bdd;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $places = $_POST['places'];
        $_SESSION["places"] = $places;

        header("Location: prix.php");
        exit();
    }

    
?>