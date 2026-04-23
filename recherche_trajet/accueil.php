<?php
include("traitementRecherche.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="stylesheet" href="./css/recherche.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars(GOOGLE_MAPS_API_KEY) ?>&libraries=places"></script>
    <script src="js/autocomplete.js"></script>

    <title>Accueil</title>
</head>

<body>
<?php include("../partials/header.php"); ?>

<main>

    <div class="texte-bienvenue">
        <div class="texte-blabla">
            <span class="text-black text-center font-manrope text-4xl font-bold leading-none">Simplifiez vos trajets</span>
            <div class="couleur-omnes">
                <span class="ml-2 font-manrope text-4xl font-bold leading-none"> étudiants !</span>
            </div>

        </div>
        <div class="texte-blabla">
            <span class="text-black text-center font-manrope text-2xl font-medium leading-none">BlaBla Omnes est le service officiel de covoiturage du groupe</span>
            <div class="couleur-omnes">
                <span class="ml-2 font-manrope text-2xl font-medium leading-none"> Omnes Education.</span>
            </div>

        </div>
    </div>


    <div class="bloc-principal">

        <div class="conteneur-formulaire">
            <form class="case-formulaire" method="post">
                <input id="autocomplete_start" type="text" placeholder="Ville de départ" name="depart" required>
                <input type="hidden" id="city_start" name="city_start">

                <input id="autocomplete_end" type="text" placeholder="Ville d'arrivée" name="arrivee" required>
                <input type="hidden" id="city_end" name="city_end">

                <input type="date" placeholder="Date" name="date" required>
                <input type="number" placeholder="Nombre de passagers" name="nb_passagers" required>
                <button type="submit">Recherche</button>
            </form>
        </div>
    </div>

    <div class="campus">
        <span class="py-10 text-black text-center font-manrope text-2xl font-medium leading-none">Découvre nos campus emblématiques</span>
        <div class="photos-campus">
            <div class="ville">
                <a target="_blank" href="https://www.ece.fr/lecole-2/nos-campus/campus-de-paris/"><img class="photo" src="../img/photo-campus-paris.png" alt="Campus Paris"></a>
            </div>
            <div class="ville">
                <a target="_blank" href="https://www.ece.fr/lecole-2/nos-campus/campus-de-lyon/">
                    <img class="photo" src="../img/photo-campus-lyon.png" alt="Campus Lyon"></a>
            </div>
            <div class="ville">
                <a target="_blank" href="https://www.ece.fr/lecole-2/nos-campus/campus-de-bordeaux/">
                    <img class="photo" src="../img/photo-campus-bordeaux.png" alt="Campus Bordeaux"></a>
            </div>
            <div class="ville">
                <a target="_blank" href="https://www.ece.fr/lecole-2/nos-campus/campus-de-rennes/">
                    <img class="photo" src="../img/photo-campus-rennes.png" alt="Campus Rennes"></a>
            </div>
        </div>
    </div>

</main>

<?php include("../partials/footer.php"); ?>

</body>