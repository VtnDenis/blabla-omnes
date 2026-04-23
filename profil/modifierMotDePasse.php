<?php
session_start();
include("traitementModifierMotDePasse.php"); ?>
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
        <span class="pt-10 text-black font-manrope text-2xl font-medium leading-none">Quel est votre mot de passe actuel ?</span>

        <form method="post">
            <div class="formulaire">
                <div class="parametre">
                <input type="text" placeholder="Votre mot de passe actuel" name="ancien_mdp">
                </div>
                <div class="parametre">
                <input type="text" placeholder="Votre nouveau mot de passe" name="nouveau_mdp">
                </div>
                <div class="valider">
                    <button type="submit">Valider</button>
                </div>

            </div>
        </form>


    </div>
</body>

</html>