<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/recherche.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars(GOOGLE_MAPS_API_KEY) ?>&libraries=places"></script>
    <script src="js/autocomplete.js"></script>
    <title>Résultats recherche</title>
</head>
<body>
<?php include("../partials/header.php"); ?>

<main>
    <div class="bg-gray-100 flex flex-col items-center justify-center pt-[50px] pb-[50px]">
        <!--- Forme du trajet choisi par l'utilisateur --->
        <div class="conteneur-formulaire">
            <form class="case-formulaire" method="post">
                <input id="autocomplete_start" type="text" placeholder="Ville de départ" name="depart">
                <input type="hidden" id="city_start" name="city_start">
                <input id="autocomplete_end" type="text" placeholder="Ville d'arrivée" name="arrivee">
                <input type="hidden" id="city_end" name="city_end">
                <input type="date" placeholder="Date" name="date">
                <input type="number" placeholder="Nombre de passagers" name="nb_passagers">
                <button type="submit">Recherche</button>
            </form>
        </div>
        <?php
        include("traitementChoixTrajet.php");
        ?>
    </div>
</main>

<?php include("../partials/footer.php"); ?>

</body>
</html>