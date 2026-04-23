<?php

    include("traitementArrivee.php");
include("../partials/header.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="publier_trajet.css">
    <link rel="stylesheet" href="publier_trajet.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars(GOOGLE_MAPS_API_KEY) ?>&libraries=places"></script>
    <script src="js/autocomplete.js"></script>
    <title>Informations arrivée</title>
</head>
<body>
    
<h1 class="text">Où allez-vous ?</h1>
<br>
<form method="post">

    <div class="centre">
        <input id="autocomplete" type="text" placeholder="Numéro de rue" name="arrivee_num" required>
        <input type="hidden" id="street_number" name="street_number">
        <input type="hidden" id="route_type" name="route_type">
        <input type="hidden" id="route_name" name="route_name">
        <input type="hidden" id="locality" name="locality">
        <input type="hidden" id="country" name="country">
        <input type="hidden" id="postal_code" name="postal_code">
    </div>
    <div class="bouton">
        <button type="submit">Soumettre</button>
    </div>
    
</form>

</body>
</html>