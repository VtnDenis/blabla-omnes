<?php
<?php
require_once '../connexion_bdd.php';
require_once '../includes/auth.php';
requireAdmin();
?>
<?php include("traitementGestionPermisDetails.php"); ?>
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../recherche_trajet/css/recherche.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<div class="bg-gray-100 flex flex-col items-center justify-center pt-[50px] pb-[50px]">
    <div class='info-block-choix'>
        <span>Date</span>

        <div class='trajet-et-preferences'>
            <div class='route-choix'>
                <span>Lieu de départ</span>
                <svg xmlns='http://www.w3.org/2000/svg' width='8' height='144' viewBox='0 0 8 144' fill='none'>
                    <path d='M3 6L4 136' stroke='black' stroke-width='3'/>
                    <circle cx='4' cy='4' r='3.5' fill='black' stroke='black'/>
                    <circle cx='4' cy='140' r='3.5' fill='black' stroke='black'/>
                </svg>
                <span>Lieu d'arrivée</span>
            </div>

            <div class='preferences'>
                <div class='profile-choix'>
                    <img src='../img/pngegg (5).png' alt='Conducteur'>
                    <span class='text-sm'></span>
                </div>

            </div>

        </div>


        <div class='price'>
            Prix du trajet :€
        </div>

        <div class='bouton-reserver'>
            <form method="post">
                <button type='submit' name="refuser">Refuser</button>
                <button type='submit' name="valider">Valider</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>