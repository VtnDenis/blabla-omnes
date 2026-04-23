<?php
//if(!isset($_COOKIE['id_profil'])){
//    setcookie('id_profil', NULL, time() + 24*3600,
//        "/", null, false, true);
//}
include("traitementRecherche.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/page-d-accueil.css">
    <link rel="stylesheet" href="css/recherche.css">
    <title>Page d'accueil</title>
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
                    <input type="text" placeholder="Ville de départ" name="depart">
                    <input type="text" placeholder="Ville d'arrivée" name="arrivee">
                    <input type="date" placeholder="Date" name="date">
                    <input type="number" placeholder="Nombre de passagers" name="nb_passagers">
                    <button type="submit">Recherche</button>
                </form>
            </div>
        </div>

        <div class="campus">
            <span class="py-10 text-black text-center font-manrope text-2xl font-medium leading-none">Découvre nos campus emblématiques</span>
            <div class="photos-campus">
                <div class="ville">
                    <img class="photo" src="../img/photo-campus-paris.png" alt="Campus Paris">
                </div>
                <div class="ville">
                    <img class="photo" src="../img/photo-campus-lyon.png" alt="Campus Lyon">
                </div>
                <div class="ville">
                    <img class="photo" src="../img/photo-campus-bordeaux.png" alt="Campus Bordeaux">
                </div>
                <div class="ville">
                    <img class="photo" src="../img/photo-campus-rennes.png" alt="Campus Rennes">
                </div>
            </div>
        </div>

    </main>

    <?php include("../partials/footer.php"); ?>

</body>