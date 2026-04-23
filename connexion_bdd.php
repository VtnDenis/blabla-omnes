<?php
    require_once __DIR__ . '/config.php';
    try {
        $GLOBALS['bdd'] = new PDO('mysql:host=localhost:3306;dbname=blabla_omnes;charset=utf8', 'root', 'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        error_log('DB connection error: ' . $e->getMessage());
        die('Erreur de connexion à la base de données.');
    }
?>