<?php
require_once '../connexion_bdd.php';
require_once '../includes/auth.php';
requireAdmin();
include("traitementGestionPlainteDetails.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Signalisation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-item label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .detail-item p {
            margin: 0;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 4px;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Détails de la Signalisation</h1>
    <div class="detail-item">
        <label for="reason">Raison :</label>
        <p id="reason"><?php echo htmlspecialchars($raison); ?></p>
    </div>
    <div class="detail-item">
        <label for="comment">Commentaire de l'accusateur:</label>
        <p id="comment"><?php echo htmlspecialchars($user_comment); ?></p>
    </div>
    <div class="detail-item">
        <label for="comment">Commentaire de l'accusé:</label>
        <p id="comment"><?php echo htmlspecialchars($conducteur_comment); ?></p>
    </div>
    <div class="detail-item">
        <label for="reported-person">Personne concernée :</label>
        <p id="reported-person"><?php echo htmlspecialchars($conducteur_prenom . " " . $conducteur_nom); ?></p>
    </div>
    <div class="detail-item">
        <label for="reporter">Signalé par :</label>
        <p id="reporter"><?php echo htmlspecialchars($user_nom . " " . $user_prenom); ?></p>
    </div>
    <div class="detail-item">
        <label for="date">Date du trajet :</label>
        <p id="date"><?php echo htmlspecialchars($date); ?></p>
    </div>
    <div class="buttons">
        <button onclick="location.href='gestionPlaintes.php';">Revenir en arrière</button>

        <button onclick="location.href='<?php echo "../profil/info-utilisateur.php?id_profil=" . $conducteur_id ?>';">Afficher accusé(e)</button>
        <button onclick="location.href='<?php echo "../profil/info-utilisateur.php?id_profil=" . $utilisateur_id; ?>';">Afficher accusateur</button>
        <form method="post">
            <button type="submit" name="resolu" value="1">Marquer résolu</button>
        </form>
    </div>
</div>
</body>
</html>
