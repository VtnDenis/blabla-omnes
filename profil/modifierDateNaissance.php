<?php
session_start();
include("traitementModifierDateNaissance.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="modif-profil.css">
    <title>Document</title>
</head>

<body>
    <?php include("../partials/header.php"); ?>

    <div class="bloc">
        <span class="pt-10 text-black font-manrope text-2xl font-medium leading-none">Quel est votre date de naissance ?</span>

        <form method="post">
            <div class="formulaire">
                <div class="parametre">
                <input type="date" placeholder="Votre date de naissance" name="nouvelle_date_naissance">
                </div>
                <div class="valider">
                    <button type="submit">Valider</button>
                </div>

            </div>
        </form>


    </div>
</body>

</html>