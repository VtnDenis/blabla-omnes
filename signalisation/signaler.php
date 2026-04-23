<?php
include("traitementSignaler.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signaler un problème</title>
    <link rel="stylesheet" href="css/signaler.css">
</head>
<body>
<div class="container">
    <h1>Signaler un problème</h1>
    <form method="post">
        <label for="reason">Raison du signalement :</label>
        <select id="reason" name="raison" required>
            <option value="">Sélectionnez une raison</option>
            <option value="absence">Absence du conducteur ou du passager</option>
            <option value="comportement">Comportement inapproprié</option>
            <option value="paiement">Problèmes de paiement</option>
            <option value="conditions">Non-respect des conditions du trajet</option>
            <option value="fausse_annonce">Fausse annonce</option>
            <option value="securite">Problèmes de sécurité</option>
            <option value="autre">Autres</option>
        </select>

        <label for="details">Détails supplémentaires :</label>
        <textarea id="details" name="details" placeholder="Décrivez le problème en détail..." required></textarea>

        <input type="submit" value="Envoyer le signalement">
    </form>
</div>
</body>
</html>

