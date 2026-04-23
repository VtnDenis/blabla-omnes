<?php

    include("traitementDescription.php");
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
    <title>Description</title>
</head>
<body>
<h1 class="text">Quelque chose à ajouter sur votre trajet ?</h1>
<br>
<form method="post">

    <div class="centre">
    <textarea placeholder="Vous êtes flexixble quant au lieu et à l'horaire de rencontre ? Vous ne prenez pas l'autoroute ? L'espace dans votre coffre est limité ? Tenez vos passagers informés !" rows="12" cols="35" name = "description"></textarea>
    <br>
    </div>
    
    <div class="bouton">
        <button type="submit">Soumettre</button>
    </div>
    
</form>

</body>
</html>